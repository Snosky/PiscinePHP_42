#!/usr/bin/php
<?php
if ($argv)
{
    $argv = array_splice($argv, 1);
    foreach ($argv as $a)
        echo $a . PHP_EOL;
}
?>
