#!/usr/bin/php
<?php
echo 'Entrez un nombre: ';
$handle = fopen('php://stdin', 'r');
$line = trim(fgets($handle));

if (is_numeric($line))
{
    if ((int)$line % 2)
        echo "Le chiffre $line est Impair";
    else
        echo "Le chiffre $line est Pair";
}
else
    echo "'$line' n'est pas un chiffre";
echo PHP_EOL;
?>