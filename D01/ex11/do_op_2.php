#!/usr/bin/php
<?php
function divide($fn, $sn)
{
    if ($sn)
        echo $fn / $sn;
    else
        echo "Syntax error: division by zero.";
}

function remove_space($line)
{
  $tab = explode(' ', trim($line));
  $tab = array_filter($tab);
  $tab = implode(' ', $tab);
  return $tab;
}

if ($argv && $argc == 2)
{
    $calc = remove_space($argv[1]);
    if (!preg_match('/^([\-|+]?[0-9]+)([*+\-\/\%])([\-|+]?[0-9]+)$/', $calc, $match))
    {
        echo "Syntax Error".PHP_EOL;
        return false;
    }
    $fn = (int)$match[1];
    $op = $match[2];
    $sn = (int)$match[3];

    switch ($op)
    {
        case '+':
            echo $fn + $sn;
            break;
        case '-':
            echo $fn - $sn;
            break;
        case '*':
            echo $fn * $sn;
            break;
        case '/':
            divide($fn, $sn);
            break;
        case '%':
            echo $fn % $sn;
            break;
    }
}
else
    echo 'Incorrect Parameters';
echo PHP_EOL;
