#!/usr/bin/php
<?php
if (isset($argv) && $argc > 1)
{
    $a = explode(' ', $argv[1]);
    $a = array_filter($a);
    $t = array_splice($a, 1);
    foreach ($t as $q)
        echo $q.' ';
    echo $a[0].PHP_EOL;
}
