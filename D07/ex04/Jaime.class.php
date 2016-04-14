<?php
class Jaime extends Lannister
{
    public function sleepWith($q)
    {
        if ($q instanceof Cersei)
            echo 'With pleasure, but only in a tower in Winterfell, then.'.PHP_EOL;
        else if ($q instanceof Tyrion)
            echo 'Not even if I\'m drunk !'.PHP_EOL;
        else
            echo 'Let\'s do this.'.PHP_EOL;
    }
}