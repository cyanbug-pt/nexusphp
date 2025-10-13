<?php

namespace App\Services\Captcha\Drivers;

use App\Services\Captcha\CaptchaDriverInterface;
use App\Services\Captcha\Exceptions\CaptchaValidationException;

class ImageCaptchaDriver implements CaptchaDriverInterface
{
    protected array $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function isEnabled(): bool
    {
        return true;
    }

    public function render(array $context = []): string
    {
        $labels = $context['labels'] ?? [];
        $imageLabel = $labels['image'] ?? 'Security Image';
        $codeLabel = $labels['code'] ?? 'Security Code';
        $secret = $context['secret'] ?? '';

        $imagehash = $this->issue();
        $imageUrl = htmlspecialchars(sprintf('image.php?action=regimage&imagehash=%s&secret=%s', $imagehash, $secret ?? ''), ENT_QUOTES, 'UTF-8');

        return implode("\n", [
            sprintf('<tr><td class="rowhead">%s</td><td align="left"><img src="%s" border="0" alt="CAPTCHA" /></td></tr>', htmlspecialchars($imageLabel, ENT_QUOTES, 'UTF-8'), $imageUrl),
            sprintf('<tr><td class="rowhead">%s</td><td align="left"><input type="text" autocomplete="off" style="width: 100%%; min-width: 180px; border: 1px solid gray; box-sizing: border-box" name="imagestring" value="" /><input type="hidden" name="imagehash" value="%s" /></td></tr>', htmlspecialchars($codeLabel, ENT_QUOTES, 'UTF-8'), htmlspecialchars($imagehash, ENT_QUOTES, 'UTF-8')),
        ]);
    }

    public function verify(array $payload, array $context = []): bool
    {
        $imagehash = trim((string) ($payload['imagehash'] ?? ''));
        $imagestring = trim((string) ($payload['imagestring'] ?? ''));

        if ($imagehash === '' || $imagestring === '') {
            throw new CaptchaValidationException('Missing captcha parameters.');
        }

        $query = sprintf(
            "SELECT dateline FROM regimages WHERE imagehash='%s' AND imagestring='%s'",
            mysql_real_escape_string($imagehash),
            mysql_real_escape_string($imagestring)
        );

        $sql = sql_query($query);
        $imgcheck = mysql_fetch_array($sql);

        $this->deleteByHash($imagehash);

        if (empty($imgcheck['dateline'])) {
            throw new CaptchaValidationException('Invalid captcha response.');
        }

        return true;
    }

    public function issue(): string
    {
        $random = random_str();
        $imagehash = md5($random);
        $dateline = time();

        $sql = sprintf(
            "INSERT INTO `regimages` (`imagehash`, `imagestring`, `dateline`) VALUES ('%s', '%s', '%s')",
            mysql_real_escape_string($imagehash),
            mysql_real_escape_string($random),
            mysql_real_escape_string((string) $dateline)
        );

        sql_query($sql);

        return $imagehash;
    }

    public function outputImage(string $imagehash): void
    {
        $query = sprintf(
            "SELECT imagestring FROM regimages WHERE imagehash=%s",
            sqlesc($imagehash)
        );

        $sql = sql_query($query);
        $regimage = mysql_fetch_array($sql);
        $imagestring = $regimage['imagestring'] ?? '';

        if ($imagestring === '') {
            $this->renderFallback();
            return;
        }

        $characters = implode(' ', str_split($imagestring));

        if (!function_exists('imagecreatefrompng')) {
            $this->renderFallback();
            return;
        }

        $fontwidth = imageFontWidth(5);
        $fontheight = imageFontHeight(5);
        $textwidth = $fontwidth * strlen($characters);
        $textheight = $fontheight;

        $randimg = rand(1, 5);
        $imagePath = ROOT_PATH . "public/pic/regimages/reg{$randimg}.png";

        if (!is_file($imagePath)) {
            $this->renderFallback();
            return;
        }

        $im = imagecreatefrompng($imagePath);
        $imgheight = imagesy($im);
        $imgwidth = imagesx($im);
        $textposh = (int) floor(($imgwidth - $textwidth) / 2);
        $textposv = (int) floor(($imgheight - $textheight) / 2);

        $dots = (int) floor($imgheight * $imgwidth / 35);
        for ($i = 1; $i <= $dots; $i++) {
            imagesetpixel($im, rand(0, $imgwidth - 1), rand(0, $imgheight - 1), imagecolorallocate($im, rand(0, 255), rand(0, 255), rand(0, 255)));
        }

        $textcolor = imagecolorallocate($im, 0, 0, 0);
        imagestring($im, 5, $textposh, $textposv, $characters, $textcolor);

        header('Content-type: image/png');
        imagepng($im);
        imagedestroy($im);
    }

    protected function deleteByHash(string $imagehash): void
    {
        if ($imagehash === '') {
            return;
        }

        $delete = sprintf(
            "DELETE FROM regimages WHERE imagehash='%s'",
            mysql_real_escape_string($imagehash)
        );

        sql_query($delete);
    }

    protected function renderFallback(): void
    {
        http_response_code(404);
    }
}
