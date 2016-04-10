#!/usr/bin/env php
<?php
if ($argv && $argc == 2)
{
  echo preg_replace('/\s+/', ' ', trim($argv[1])).PHP_EOL;
}
 ?>
