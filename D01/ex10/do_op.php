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


if ($argv && $argc == 4)
{
    $argv = array_splice($argv, 1);
    $line = implode('', $argv);
    $line = remove_space($line);
    if (!preg_match('/^([\-|+]?[0-9]+)([*+\-\/\%])([\-|+]?[0-9]+)$/', $line, $match))
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
    echo "Incorrect Parameters";
echo PHP_EOL;
