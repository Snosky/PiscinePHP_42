#!/usr/bin/env php
<?php
$month_fr = array(
  '/janvier/i',
  '/frevier/i',
  '/mars/i',
  '/avril/i',
  '/mai/i',
  '/juin/i',
  '/juillet/i',
  '/aout/i',
  '/septembre/i',
  '/octobre/i',
  '/novembre/i',
  '/decembre/i'
);

$month_nu = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);

if ($argv && $argc == 2)
{
  date_default_timezone_set('Europe/Paris');
  $pattern = "/^([lundi|mardi|mercredi|jeudi|vendredi|samedi|dimanche]+[ ])?([0-9][0-9]?) ([janvier|fevrier|mars|avril|mai|juin|juillet|aout|septembre|octobre|novembre|decembre]+) ([0-9][0-9][0-9][0-9]) ?([0-9][0-9]:[0-9][0-9]:?[0-9]?[0-9]?)?$/i";
  if (preg_match($pattern, $argv[1], $match))
  {
    $date = $match[2].'.'.preg_replace($month_fr, $month_nu, $match[3]).'.'.$match[4].' '.$match[5];
    echo strtotime($date);
  }
  else
    echo "Wrong Format";
  echo PHP_EOL;
}
?>
