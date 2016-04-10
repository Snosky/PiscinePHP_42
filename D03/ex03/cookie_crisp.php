<?php
function do_cookie($tab)
{
    if ($tab['action'] == 'set')
    {
        if ($tab['name'] != NULL &&  $tab['value'] != NULL)
            setcookie($tab['name'], $tab['value'], time() + 3600);
    }
    else if ($tab['action'] == 'get')
    {
        if ($tab['name'] != NULL && $_COOKIE[$tab['name']])
            echo($_COOKIE[$tab['name']].PHP_EOL);
    }
    else if ($tab['action'] == 'del')
    {
        if ($tab['name'] != NULL)
            setcookie($tab['name'], NULL, -1);
    }
}


$tab = array(
    'action'    => NULL,
    'name'      => NULL,
    'value'     => NULL,
);
foreach ($_GET as $k => $v)
{
    if ($k == 'action' && $tab['action'] === NULL)
        switch ($v) {
            case 'set':
                $tab['action'] = 'set';
                break;
            case 'get':
                $tab['action'] = 'get';
                break;
            case 'del':
                $tab['action'] = 'del';
                break;
        }
    else if ($k == 'name' && $tab['name'] === NULL)
        $tab['name'] = $v;
    else if ($k == 'value' && $tab['value'] === NULL)
        $tab['value'] = $v;
}
do_cookie($tab);
?>
