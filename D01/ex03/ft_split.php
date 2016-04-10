<?php
function    ft_split($string)
{
    $tab = explode(' ', trim($string));
    sort($tab, SORT_STRING);
    return $tab;
}
