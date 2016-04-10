<?php
function add_to_cart($item, $quantity)
{
    if ($quantity && ($item['itm_quantity'] == -1 || $quantity <= $item['itm_quantity']))
    {
        if (isset($_SESSION['cart']['item'][$item['itm_id']]) && (get_cart()[$item['itm_id']] + $quantity) < $item['itm_quantity'])
            $_SESSION['cart']['item'][$item['itm_id']] += $quantity;
        else
            $_SESSION['cart']['item'][$item['itm_id']] = $quantity;
    }
}

function get_nb_item_cart()
{
    $count = 0;
    if (isset($_SESSION['cart']['item']))
        foreach ($_SESSION['cart']['item'] as $v)
            $count += $v;
    return $count;
}

function get_cart()
{
    return $_SESSION['cart']['item'];
}

function cart_get_total($cart)
{
    $total = 0;
    foreach ($cart as $v)
    {
        $total += ($v['itm_quantity'] * $v['itm_price']);
    }
    return $total;
}

function delete_item_from_cart($item, $quantity)
{
    if ($quantity == 'all')
        unset($_SESSION['cart']['item'][$item['itm_id']]);
    else if (is_numeric($quantity) && $quantity > 0)
    {
        if (isset($_SESSION['cart']['item'][$item['itm_id']]) && $_SESSION['cart']['item'][$item['itm_id']] < $quantity)
            unset($_SESSION['cart']['item'][$item['itm_id']]);
        else if (isset($_SESSION['cart']['item'][$item['itm_id']]))
            $_SESSION['cart']['item'][$item['itm_id']] -= $quantity;
        if (!$_SESSION['cart']['item'][$item['itm_id']])
            unset($_SESSION['cart']['item'][$item['itm_id']]);
    }
}

function destroy_cart()
{
    unset($_SESSION['cart']);
}