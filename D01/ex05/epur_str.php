#!/usr/bin/php
<?php
if ($argv && $argc == 2)
{
  $tab = explode(' ', trim($argv[1]));
  $tab = array_filter($tab);
  $tab = implode(' ', $tab);
  echo $tab.PHP_EOL;
}
?>
