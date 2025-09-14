<?php

namespace Nexus\Torrent;

class TechnicalInformation
{
    private $mediaInfo;

    private $mediaInfoArr;

    public function __construct(string $mediaInfo)
    {
        $this->mediaInfo = $mediaInfo;
        $this->mediaInfoArr = $this->getMediaInfoArr($mediaInfo);
    }

    public function getMediaInfoArr(string $mediaInfo)
    {
        $arr = preg_split('/[\r\n]+/', $mediaInfo);
        $result = [];
        $parentKey = "";
        foreach ($arr as $key => $value) {
            $value = $this->trim($value);
            if (empty($value)) {
                continue;
            }
            $rowKeyValue = explode(':', $value);
            $rowKeyValue = array_filter(array_map([$this, 'trim'], $rowKeyValue));
            if (count($rowKeyValue) == 1) {
                $parentKey = $rowKeyValue[0];
            } elseif (count($rowKeyValue) == 2) {
                if (empty($parentKey)) {
                    continue;
                }
                $result[$parentKey][$rowKeyValue[0]] = $rowKeyValue[1];
            }
        }
        return $result;

    }

    private function trim(string $value): string
    {
        return trim($value, " \n\r\t\v\0\u{A0}");
    }

    public function getRuntime()
    {
        return $this->mediaInfoArr['General']['Duration'] ?? '';
    }

    public function getResolution()
    {
        $width = $this->mediaInfoArr['Video']['Width'] ?? '';
        $height = $this->mediaInfoArr['Video']['Height'] ?? '';
        $ratio = $this->mediaInfoArr['Video']['Display aspect ratio'] ?? '';
        $result = '';
        if ($width && $height) {
            $result .= $width . ' x ' . $height;
        }
        if ($ratio) {
            $result .= "($ratio)";
        }
        return $result;
    }

    public function getBitrate()
    {
        $result = $this->mediaInfoArr['Video']['Bit rate'] ?? '';
        return $result;
    }

    public function getFramerate()
    {
        $result = $this->mediaInfoArr['Video']['Frame rate'] ?? '';
        return $result;
    }

    public function getProfile()
    {
        $result = $this->mediaInfoArr['Video']['Format profile'] ?? '';
        return $result;
    }

    public function getRefFrame()
    {
        foreach ($this->mediaInfoArr['Video'] ?? [] as $key => $value) {
            if (str_contains($key, 'Reference frames')) {
                return $value;
            }
        }
        return '';
    }

    public function getAudios()
    {
        $result = [];
        $audioIndex = 1;
        foreach ($this->mediaInfoArr as $parentKey => $values) {
            if (strpos($parentKey, 'Audio') === false) {
                continue;
            }
            $audioInfoArr = [];
            if (!empty($values['Language'])) {
                $audioInfoArr[] = $values['Language'];
            }
            if (!empty($values['Title'])) {
                $audioInfoArr[] = $values['Title'];
            }
            if (!empty($values['Format'])) {
                $audioInfoArr[] = $values['Format'];
            }
            if (!empty($values['Channel(s)'])) {
                $audioInfoArr[] = $values['Channel(s)'];
            }
            if (!empty($values['Bit rate'])) {
                $audioInfoArr[]= "@" . $values['Bit rate'];
            }
            if (!empty($audioInfoArr)) {
                // 使用多语言支持的键名
                $result[nexus_trans('torrent.technicalinfo_audio') . $audioIndex] = implode(" ", $audioInfoArr);
                $audioIndex++;
            }
        }
        return $result;
    }

    public function getSubtitles()
    {
        $result = [];
        $subtitleIndex = 1;
        foreach ($this->mediaInfoArr as $parentKey => $values) {
            if (strpos($parentKey, 'Text') === false) {
                continue;
            }
            $subtitlesInfoArr = [];
            if (!empty($values['Language'])) {
                $subtitlesInfoArr[] = $values['Language'];
            }
            if (!empty($values['Title'])) {
                $subtitlesInfoArr[] = $values['Title'];
            }
            if (!empty($values['Format'])) {
                $subtitlesInfoArr[] = $values['Format'];
            }
            if (!empty($subtitlesInfoArr)) {
                // 使用多语言支持的键名
                $result[nexus_trans('torrent.technicalinfo_subtitles') . $subtitleIndex] = implode(" ", $subtitlesInfoArr);
                $subtitleIndex++;
            }
        }
        return $result;
    }

    public function getHDRFormat()
    {
        return $this->mediaInfoArr['Video']['HDR format'] ?? '';
    }

    public function getVideoFormat()
    {
        return $this->mediaInfoArr['Video']['Format'] ?? '';
    }

    public function getBitDepth()
    {
        return $this->mediaInfoArr['Video']['Bit depth'] ?? '';
    }

    public function renderOnDetailsPage()
    {
        global $lang_functions;
//        $videos = [
//            'Runtime' => $this->getRuntime(),
//            'Resolution' => $this->getResolution(),
//            'Bitrate' => $this->getBitrate(),
//            'HDR' => $this->getHDRFormat(),
//            'Bit depth' => $this->getBitDepth(),
//            'Frame rate' => $this->getFramerate(),
//            'Profile' => $this->getProfile(),
//            'Ref.Frames' => $this->getRefFrame(),
//        ];
//        $videos = array_filter($videos);
//        $audios = $this->getAudios();
//        $subtitles = $this->getSubtitles();
        $summaryInfo = $this->getSummaryInfo();
        $videos = $summaryInfo['videos'] ?: [];
        $audios = $summaryInfo['audios'] ?: [];
        $subtitles = $summaryInfo['subtitles'] ?: [];

//        dd($summaryInfo, $videos, $audios, $subtitles);
        if (empty($this->mediaInfo)) { //为空不渲染mediainfo
            return '';
        } else if (empty($videos) && empty($audios) && empty($subtitles)) { // 信息不全显示点击展开
            $rawmediaInfo = sprintf('[spoiler=%s][raw]<pre>%s</pre>[/raw][/spoiler]', nexus_trans('torrent.show_hide_media_info'), $this->mediaInfo);
            return sprintf('<div class="nexus-media-info-raw"><pre>%s</pre></div>', format_comment($rawmediaInfo, false));
        }

        $result = '<table style="border: none;width: 100%"><tbody><tr>';
        $cols = 0;
        if (!empty($videos)) {
            $cols++;
            $result .= $this->buildTdTable($videos);
        }
        if (!empty($audios)) {
            $cols++;
            $result .= $this->buildTdTable($audios);
        }
        if (!empty($subtitles)) {
            $cols++;
            $result .= $this->buildTdTable($subtitles);
        }
        $result .= '</tr>';
        $rawMediaInfo = sprintf('[spoiler=%s][raw]<pre>%s</pre>[/raw][/spoiler]',  nexus_trans('torrent.show_hide_media_info'), $this->mediaInfo);
        $result .= sprintf('<tr><td colspan="%s" class="nexus-media-info-raw">%s</td></tr>', $cols, format_comment($rawMediaInfo, false));
        $result .= '</tbody></table>';
        return $result;
    }

    public function getSummaryInfo(): array
    {
        $videos = [
            nexus_trans('torrent.technicalinfo_duration') => $this->getRuntime(),
            nexus_trans('torrent.technicalinfo_resolution') => $this->getResolution(),
            nexus_trans('torrent.technicalinfo_bit_rate') => $this->getBitrate(),
            'HDR' => $this->getHDRFormat(),
            nexus_trans('torrent.technicalinfo_bit_depth') => $this->getBitDepth(),
            nexus_trans('torrent.technicalinfo_frame_rate') => $this->getFramerate(),
            nexus_trans('torrent.technicalinfo_profile') => $this->getProfile(),
            nexus_trans('torrent.technicalinfo_format') => $this->getVideoFormat(),
            nexus_trans('torrent.technicalinfo_ref_frames') => $this->getRefFrame(),
        ];
        $videos = array_filter($videos) ?: null;
        $audios = $this->getAudios() ?: null;
        $subtitles = $this->getSubtitles() ?: null;
        return compact('videos', 'audios', 'subtitles');
    }

    private function buildTdTable(array $parts)
    {
        $table = '<table style="border: none;"><tbody>';
        
        // 检查是否为音频或字幕数据
        $isAudioOrSubtitle = false;
        $audioOrSubtitleCount = 0;
        $audioPrefix = nexus_trans('torrent.technicalinfo_audio');
        $subtitlePrefix = nexus_trans('torrent.technicalinfo_subtitles');
        foreach ($parts as $key => $value) {
            if (strpos($key, $audioPrefix) === 0 || strpos($key, $subtitlePrefix) === 0) {
                $isAudioOrSubtitle = true;
                $audioOrSubtitleCount++;
            }
        }
        
        $displayCount = 0;
        $hiddenParts = [];
        
        foreach ($parts as $key => $value) {
            $displayCount++;
            
            // 如果是音频或字幕，且超过3条，则隐藏多余的
            if ($isAudioOrSubtitle && $audioOrSubtitleCount > 3) {
                if ($displayCount <= 3) {
                    // 显示前3条
                    $table .= '<tr>';
                    $table .= sprintf('<td style="border: none; padding-right: 5px;padding-bottom: 5px;"><b>%s: </b>%s</td>', $key, $value);
                    $table .= '</tr>';
                } else {
                    // 收集隐藏的部分
                    $hiddenParts[$key] = $value;
                }
            } else {
                // 非音频/字幕数据，或数量不超过3条，正常显示
                $table .= '<tr>';
                $table .= sprintf('<td style="border: none; padding-right: 5px;padding-bottom: 5px;"><b>%s: </b>%s</td>', $key, $value);
                $table .= '</tr>';
            }
        }
        
        // 如果有隐藏的部分，添加spoiler
        if (!empty($hiddenParts)) {
            $hiddenContent = '';
            foreach ($hiddenParts as $key => $value) {
                $hiddenContent .= sprintf('<b>%s: </b>%s<br>', $key, $value);
            }
            $hiddenContent = rtrim($hiddenContent, '<br>');
            
            $spoilerTitle = $isAudioOrSubtitle && strpos(array_keys($parts)[0], $audioPrefix) === 0 
                ? nexus_trans('torrent.collapse_show_more_audio') 
                : nexus_trans('torrent.collapse_show_more_subtitles');
            
            $spoiler = sprintf('[spoiler=%s]%s[/spoiler]', $spoilerTitle, $hiddenContent);
            $table .= '<tr>';
            // 检查format_comment函数是否存在
            if (function_exists('format_comment')) {
                $table .= sprintf('<td style="border: none; padding-right: 5px;padding-bottom: 5px;">%s</td>', format_comment($spoiler, false));
            } else {
                $table .= sprintf('<td style="border: none; padding-right: 5px;padding-bottom: 5px;">%s</td>', $spoiler);
            }
            $table .= '</tr>';
        }
        
        $table .= '</tbody>';
        $table .= '</table>';
        return sprintf('<td style="border: none; padding-right: 5px;padding-bottom: 5px">%s</td>', $table);
    }

}