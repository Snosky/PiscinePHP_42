#!/usr/bin/php
<?php
/* Class user */
class User
{
    public $name;
    public $notes = array();
    public $moulinette;

    public function __construct($name, $note, $noteur)
    {
        $this->name = $name;
        if ($noteur == 'moulinette')
            $this->moulinette = $note;
        else if (!empty($note) || $note == '0')
            $this->addNote($note);
    }

    public function addNote($note)
    {
        if (!empty($note) || $note == '0')
            $this->notes[] = $note;
    }

    public function totalNote()
    {
        return array_sum($this->notes);
    }

    public function nbNote()
    {
        $nb = count($this->notes);
        return $nb;
    }
}

/* Compare function */
function cmp($a, $b)
{
    return (strcmp($a->name, $b->name));
}

/* Function do */
function do_moyenne($users)
{
    $total = 0;
    $div = 0;
    foreach ($users as $user)
    {
        $div += $user->nbNote();
        $total += $user->totalNote();
    }
    echo $total / $div.PHP_EOL;
}

function do_moyenne_user($users)
{
    foreach ($users as $user)
    {
        $div = $user->nbNote();
        if ($div)
            echo $user->name.':'. ($user->totalNote() / $div).PHP_EOL;
    }

}

function do_ecart_moulinette($users)
{
    foreach ($users as $user)
    {
        $dif = 0;
        $mou = $user->moulinette;
        $div = count($user->notes);
        foreach ($user->notes as $note)
            $dif += ($note - $mou);
        if ($div)
            echo $user->name.':'.($dif / $div).PHP_EOL;
    }
}


/* MAIN */
if ($argv && $argc == 2)
{
    if (!in_array($argv[1], array('moyenne', 'moyenne_user', 'ecart_moulinette')))
        return false;

    $handle = fopen('php://stdin', 'r');
    fgets($handle);
    $users = array();
    while (($buffer = fgets($handle)) != false) {
        $tmp = explode(';', $buffer);
        if (isset($users[$tmp[0]]))
        {
            if ($tmp[2] == 'moulinette')
                $users[$tmp[0]]->moulinette = $tmp[1];
            else
                $users[$tmp[0]]->addNote($tmp[1]);
        }
        else
            $users[$tmp[0]] = new User($tmp[0], $tmp[1], $tmp[2]);
    }
    usort($users, 'cmp');
    switch($argv[1])
    {
        case 'moyenne':
            do_moyenne($users);
            break;
        case 'moyenne_user':
            do_moyenne_user($users);
            break;
        case 'ecart_moulinette':
            do_ecart_moulinette($users);
            break;
    }
}
