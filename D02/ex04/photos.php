#!/usr/bin/env php
<?php
if (isset($argv) && $argc == 2) {
    $file_content = file_get_contents($argv[1]);

    $dir_name = preg_replace('#^https?://#', '', $argv[1]);
    if (is_dir($dir_name) == false)
        if (mkdir($dir_name, 0777) == false)
        {
            echo "Can't create directory.";
            die();
        }

    preg_match_all('/<img(.*?)src=["|\'](.*?)["|\'](.*?)>/i', $file_content, $matches);
    foreach ($matches[2] as $image)
    {
        $explode = explode('/', $image);
        $image_name = $dir_name.DIRECTORY_SEPARATOR.end($explode);
        if (!file_exists($image_name))
        {
            $ch = curl_init($image);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
            $image_raw = curl_exec($ch);
            curl_close($ch);
            $fp = fopen($image_name, 'x');
            fwrite($fp, $image_raw);
            fclose($fp);
        }
    }
}
?>
