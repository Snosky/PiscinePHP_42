#!/usr/bin/env php
<?php
$handle = fopen('/var/run/utmpx', 'r');
$who = array();
date_default_timezone_set('Europe/Paris');
while ($content = fread($handle, 628))
{
  $content = unpack("a256user/a4id/a32line/ipid/itype/I2time/a256host/i16pad", $content);
  if ($content['type'] == 7)
    $who[$content['line']] = array(
      'user'  => trim($content['user']),
      'line'  => trim($content['line']),
      'date'  => trim($content['time1']),
    );
}
ksort($who);

$size = array('user' => 0, 'line' => 0);
foreach ($who as $v)
{
  if (strlen($v['user']) > $size['user'])
    $size['user'] = strlen($v['user']);
  if (strlen($v['line']) > $size['line'])
    $size['line'] = strlen($v['line']);
}

foreach ($who as $v)
{
  $format = "%-{$size['user']}s   %-{$size['line']}s  %s".PHP_EOL;
  printf($format, $v['user'], $v['line'], date("M  j H:i", $v['date']));
}
?>
