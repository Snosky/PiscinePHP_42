#!/usr/bin/php
<?php
if (isset($argv) && $argc > 1)
{
    $argv = array_splice($argv, 1);
    $ret = array();
    foreach ($argv as $a)
    {
        $a = explode(' ', $a);
        $ret = array_merge($ret, $a);
    }
    $ret = array_filter($ret);
    sort($ret, SORT_STRING);
    foreach ($ret as $a)
        echo $a.PHP_EOL;
}
?>
