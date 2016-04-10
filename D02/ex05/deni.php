#!/usr/bin/env php
<?php
if ($argv && $argc == 3)
{
  if (end(explode('.', $argv[1])) != 'csv')
    exit();
  // On recupere les infos du fichier avec des variable dynamique (si colonne prenom on creer une var $prenom etc...)
  if (($handle = @fopen($argv[1], 'r')) !== FALSE)
  {
    $first_line = fgets($handle);
    $first_line = explode(';', trim($first_line));
    if (($main_key = array_search($argv[2], $first_line)))
    foreach ($first_line as $v)
      $$v = array();
    while (($line = fgets($handle)) !== FALSE)
    {
      $line = explode(';', trim($line));
      foreach ($first_line as $k => $key)
		  $tab[$key] = $line[$k];

      foreach ($first_line as $k => $key)
      {
          $var =& $$key;
          //print_r($k);
          $var[$tab[$argv[2]]] = $tab[$key];
      }
    }
    fclose($handle);
    if ($main_key)
    {
      while (1)
      {
        echo 'Entrez votre commande: ';
        $handle = fopen('php://stdin', 'r');
        $line = fgets($handle);
        if ($line === FALSE)
          break;
        eval(trim($line));
      }
    }
  }
  // Fin recuperation variable
}
?>
