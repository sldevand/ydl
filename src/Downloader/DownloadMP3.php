<?php

namespace App\Downloader;

/**
 * Class DownloadMP3
 */
class DownloadMP3
{

    /**
     * @param $url
     * @return array
     */
    public static function download($url)
    {
        $status = [];
        $out = $_ENV['OUTPUT_PATH'];
        $ydlPath = $_ENV['YDL_PATH'];

        exec("cd $out && $ydlPath -x --audio-format mp3 -o '%(title)s.%(ext)s' $url", $status);

        $result = '';

        foreach ($status as $item) {
            $res = explode(':', $item);
            if ($res[0] === "[ffmpeg] Destination") {
                $result = trim($res[1]);
                break;
            }
        }

        return $result;
    }
}
