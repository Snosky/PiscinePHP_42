<?php
class Tyrion extends Lannister
{
    public function sleepWith($q)
    {
        if ($q instanceof Lannister)
            echo 'Not even if I\'m drunk !'.PHP_EOL;
        else
            echo 'Let\'s do this.'.PHP_EOL;
    }
}