#!/usr/bin/php
<?php
if ($argv && $argc >= 3)
{
    $subject = $argv[1];
    $argv = array_splice($argv, 2);
    $search = array();
    foreach ($argv as $v)
    {
        $v = explode(':', $v);
        $search[$v[0]] = $v[1];
    }
    foreach ($search as $k => $v)
        if ($subject == (string)$k)
        {
            echo $v.PHP_EOL;
            break ;
        }
}
