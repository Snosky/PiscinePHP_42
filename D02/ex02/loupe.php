#!/usr/bin/env php
<?php
if (isset($argv) && $argc == 2)
{
    if (end(explode('.', $argv[1])) != 'html')
      exit();
    $file = '';
    $handle = fopen($argv[1], "r") or die('Impossible de lire le fichier');
    while (($buffer = fgets($handle)) != false)
        $file .= $buffer;
    $link_subject = '/<a (href=[\S]+)? (title="(.*)"?)?>([\s\S]*[\w\W]*[\d\D]*)<\/a>/iU';
    preg_match_all('/<a(.*?)>(.*?)<\/a>/si', $file, $match);

    foreach ($match[2] as $k => $v)
    {
        preg_match_all('/\<([^>]+)\>/', $v, $lnk);
        $file = str_replace($v, strtoupper($v), $file);
        foreach ($lnk[1] as $c)
            $file = str_replace(strtoupper($c), strtolower($c), $file);
    }
    foreach ($match[0] as $k => $v)
    {
        preg_match_all('/title="(.*?)"/', $v, $title);
        foreach ($title[1] as $c)
            $file = str_replace(strtolower($c), strtoupper($c), $file);
    }
    echo $file;
}
?>
