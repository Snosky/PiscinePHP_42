<?php
function    ft_is_sort($array)
{
    $sort_order = -1;
    foreach ($array as $k => $v)
        if ($array[$k + 1])
        {
            $cmp = strcmp($v, $array[$k + 1]);
            if ($cmp < 0 && ($sort_order == 1 || $sort_order == -1))
                $sort_order = 1;
            else if ($cmp > 0 && ($sort_order == 0 || $sort_order == -1))
                $sort_order = 0;
            else if ($cmp != 0)
                return false;
        }
    return true;
}
?>
