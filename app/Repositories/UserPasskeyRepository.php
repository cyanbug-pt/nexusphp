<?php

namespace App\Repositories;

use App\Models\Passkey;
use Exception;
use lbuchs\WebAuthn\WebAuthn;
use Nexus\Database\NexusDB;
use Nexus\Nexus;
use RuntimeException;

class UserPasskeyRepository extends BaseRepository
{

    public static function createWebAuthn()
    {
        $formats = ['android-key', 'android-safetynet', 'apple', 'fido-u2f', 'packed', 'tpm', 'none'];
        return new WebAuthn(get_setting('basic.SITENAME'), nexus()->getRequestHost(), $formats);
    }

    public static function getCreateArgs($userId, $userName)
    {
        $WebAuthn = self::createWebAuthn();

        $passkey = Passkey::query()->where('user_id', '=', $userId)->get();

        $credentialIds = array_map(function ($item) {
            return hex2bin($item['credential_id']);
        }, $passkey->toArray());

        $createArgs = $WebAuthn->getCreateArgs(bin2hex($userId), $userName, $userName, 60 * 4, true, 'preferred', null, $credentialIds);

        NexusDB::cache_put("{$userId}_passkey_challenge", $WebAuthn->getChallenge(), 60 * 4);

        return $createArgs;
    }

    public static function processCreate($userId, $clientDataJSON, $attestationObject)
    {
        $WebAuthn = self::createWebAuthn();

        $clientDataJSON = !empty($clientDataJSON) ? base64_decode($clientDataJSON) : null;
        $attestationObject = !empty($attestationObject) ? base64_decode($attestationObject) : null;
        $challenge = NexusDB::cache_get("{$userId}_passkey_challenge") ?? null;

        $data = $WebAuthn->processCreate($clientDataJSON, $attestationObject, $challenge, false, true, false);

        self::insertUserPasskey(
            $userId,
            bin2hex($data->AAGUID),
            bin2hex($data->credentialId),
            $data->credentialPublicKey,
            $data->signatureCounter
        );

        return true;
    }

    public static function getGetArgs()
    {
        $WebAuthn = self::createWebAuthn();

        $getArgs = $WebAuthn->getGetArgs(null, 60 * 4, true, true, true, true, true, 'preferred');

        return $getArgs;
    }

    public static function insertUserPasskey($userId, $AAGUID, $credentialId, $publicKey, $counter)
    {
        $params = [
            'user_id' => $userId,
            'AAGUID' => $AAGUID,
            'credential_id' => $credentialId,
            'public_key' => $publicKey,
            'counter' => $counter,
        ];
        Passkey::query()->create($params);
    }

    public static function processGet($challenge, $id, $clientDataJSON, $authenticatorData, $signature, $userHandle)
    {
        $WebAuthn = self::createWebAuthn();

        $clientDataJSON = !empty($clientDataJSON) ? base64_decode($clientDataJSON) : null;
        $id = !empty($id) ? base64_decode($id) : null;
        $authenticatorData = !empty($authenticatorData) ? base64_decode($authenticatorData) : null;
        $signature = !empty($signature) ? base64_decode($signature) : null;
        $userHandle = !empty($userHandle) ? base64_decode($userHandle) : null;
        $challenge = !empty($challenge) ? base64_decode($challenge) : null;

        $passkey = Passkey::query()->where('credential_id', '=', bin2hex($id))->first();
        $credentialPublicKey = $passkey->public_key;

        if ($credentialPublicKey === null) {
            throw new RuntimeException(nexus_trans('passkey.passkey_unknown'));
        }

        if ($userHandle !== bin2hex($passkey->user_id)) {
            throw new RuntimeException(nexus_trans('passkey.passkey_invalid'));
        }

        try {
            $WebAuthn->processGet($clientDataJSON, $authenticatorData, $signature, $credentialPublicKey, $challenge, null, 'preferred');
        } catch (Exception $e) {
            throw new RuntimeException(nexus_trans('passkey.passkey_error') . "\n" . $e->getMessage());
        }

        $user = $passkey->user;
        if (!$user) {
            throw new RuntimeException(nexus_trans('passkey.passkey_user_not_found'));
        }
        $user->checkIsNormal();

        $ip = getip();
        $userRep = new UserRepository();
        $userRep->saveLoginLog($user->id, $ip, 'Web', true);

        logincookie($user->id, $user->auth_key);
        return true;
    }

    public static function delete($userId, $credentialId)
    {
        return Passkey::query()->where('user_id', '=', $userId)->where('credential_id', '=', $credentialId)->delete();
    }

    public static function getList($userId)
    {
        return Passkey::query()->where('user_id', '=', $userId)->get();
    }

    public static function getAaguids()
    {
        return NexusDB::remember("aaguids", 60 * 60 * 24 * 14, function () {
            return json_decode(file_get_contents("https://raw.githubusercontent.com/passkeydeveloper/passkey-authenticator-aaguids/refs/heads/main/combined_aaguid.json"), true);
        });
    }

    private static $passkeyvg = 'data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20216%20216%22%20xml%3Aspace%3D%22preserve%22%3E%3Cg%2F%3E%3Cpath%20style%3D%22fill%3Anone%22%20d%3D%22M0%200h216v216H0z%22%2F%3E%3Cpath%20d%3D%22M172.32%2096.79c0%2013.78-8.48%2025.5-20.29%2029.78l7.14%2011.83-10.57%2013%2010.57%2012.71-17.04%2022.87-12.01-12.82V125.7c-10.68-4.85-18.15-15.97-18.15-28.91%200-17.4%2013.51-31.51%2030.18-31.51%2016.66%200%2030.17%2014.11%2030.17%2031.51m-30.18%204.82c4.02%200%207.28-3.4%207.28-7.6s-3.26-7.61-7.28-7.61-7.28%203.4-7.28%207.61c-.01%204.2%203.26%207.6%207.28%207.6%22%20style%3D%22fill-rule%3Aevenodd%3Bclip-rule%3Aevenodd%3Bfill%3A%23353535%22%2F%3E%3Cpath%20d%3D%22M172.41%2096.88c0%2013.62-8.25%2025.23-19.83%2029.67l6.58%2011.84-9.73%2013%209.73%2012.71-17.03%2023.05v-85.54c4.02%200%207.28-3.41%207.28-7.6%200-4.2-3.26-7.61-7.28-7.61V65.28c16.73%200%2030.28%2014.15%2030.28%2031.6m-52.17%2034.55c-9.75-8-16.3-20.3-17.2-34.27H50.8c-10.96%200-19.84%209.01-19.84%2020.13v25.17c0%205.56%204.44%2010.07%209.92%2010.07h69.44c5.48%200%209.92-4.51%209.92-10.07z%22%20style%3D%22fill-rule%3Aevenodd%3Bclip-rule%3Aevenodd%22%2F%3E%3Cpath%20d%3D%22M73.16%2091.13c-2.42-.46-4.82-.89-7.11-1.86-8.65-3.63-13.69-10.32-15.32-19.77-1.12-6.47-.59-12.87%202.03-18.92%203.72-8.6%2010.39-13.26%2019.15-14.84%205.24-.94%2010.46-.73%2015.5%201.15%207.59%202.82%2012.68%208.26%2015.03%2016.24%202.38%208.05%202.03%2016.1-1.56%2023.72-3.72%207.96-10.21%2012.23-18.42%2013.9-.68.14-1.37.27-2.05.41-2.41-.03-4.83-.03-7.25-.03%22%20style%3D%22fill%3A%23141313%22%2F%3E%3C%2Fsvg%3E';

    public static function renderLogin()
    {
        printf('<p id="passkey_box"><button type="button" id="passkey_login"><img style="width:32px" src="%s" alt="%s"><br>%s</button></p>', self::$passkeyvg, nexus_trans('passkey.passkey'), nexus_trans('passkey.passkey'));
        ?>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                if (Passkey.conditionalSupported()) {
                    Passkey.isCMA().then(async (isCMA) => {
                        if (isCMA) startPasskeyLogin(true);
                    });
                }
                document.getElementById('passkey_login').addEventListener('click', () => {
                    if (!Passkey.supported()) {
                        layer.alert('<?php echo nexus_trans('passkey.passkey_not_supported'); ?>');
                    } else {
                        startPasskeyLogin(false);
                    }
                })
            });
            const startPasskeyLogin = (conditional) => {
                Passkey.checkRegistration(conditional, () => {
                    layer.load(2, {shade: 0.3});
                }).then(() => {
                    if (location.search) {
                        const searchParams = new URLSearchParams(location.search);
                        location.href = searchParams.get('returnto') || '/index.php';
                    } else {
                        location.href = '/index.php';
                    }
                }).catch((e) => {
                    if (e.name === 'NotAllowedError' || e.name === 'AbortError') {
                        return;
                    }
                    layer.alert(e.message);
                }).finally(() => {
                    layer.closeAll('loading');
                });
            }
        </script>
        <?php
    }

    public static function renderList($id)
    {
        $passkeys = self::getList($id);
        printf('<button type="button" id="passkey_create">%s</button><br>%s', nexus_trans('passkey.passkey_create'), nexus_trans('passkey.passkey_desc'));
        ?>
        <table>
            <?php
            if (empty($passkeys)) {
                printf('<tr><td>%s</td></tr>', nexus_trans('passkey.passkey_empty'));
            } else {
                $AAGUIDS = self::getAaguids();
                foreach ($passkeys as $passkey) {
                    ?>
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;padding:4px">
                                <?php
                                $meta = $AAGUIDS[$passkey->AAGUID()];
                                if (isset($meta)) {
                                    printf('<img style="width: 32px" src="%s" alt="%s" /><div style="margin-right:4px"><b>%s</b> (%s)', $meta['icon_dark'], $meta['name'], $meta['name'], $passkey->credential_id);
                                } else {
                                    printf('<img style="width: 32px" src="%s" alt="%s" /><div style="margin-right:4px"><b>%s</b>', self::$passkeyvg, $passkey->credential_id, $passkey->credential_id);
                                }
                                printf('<br><b>%s</b>%s</div>', nexus_trans('passkey.passkey_created_at'), gettime($passkey->created_at));
                                printf('<button type="button" style="margin-left:auto" data-passkey-id="%s">%s</button>', $passkey->credential_id, nexus_trans('passkey.passkey_delete'))
                                ?>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
            } ?>
        </table>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                document.getElementById('passkey_create').addEventListener('click', () => {
                    if (!Passkey.supported()) {
                        layer.alert('<?php echo nexus_trans('passkey.passkey_not_supported'); ?>');
                    } else {
                        layer.load(2, {shade: 0.3});
                        Passkey.createRegistration().then(() => {
                            location.reload();
                        }).catch((e) => {
                            layer.alert(e.message);
                        }).finally(() => {
                            layer.closeAll('loading');
                        });
                    }
                })
                document.querySelectorAll('button[data-passkey-id]').forEach((button) => {
                    button.addEventListener('click', () => {
                        const credentialId = button.getAttribute('data-passkey-id');
                        layer.confirm('<?php echo nexus_trans('passkey.passkey_delete_confirm'); ?>', {}, function () {
                            layer.load(2, {shade: 0.3});
                            Passkey.deleteRegistration(credentialId).then(() => {
                                location.reload();
                            }).catch((e) => {
                                layer.alert(e.message);
                            }).finally(() => {
                                layer.closeAll('loading');
                            });
                        });
                    });
                });
            });
        </script>
        <?php
        Nexus::js('js/passkey.js', 'footer', true);
    }
}
