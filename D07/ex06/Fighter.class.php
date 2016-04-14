<?php
abstract class Fighter
{
    protected $fighter_type;

    public function __construct($fighter_type = 'fighter')
    {
        $this->fighter_type = $fighter_type;
    }

    abstract public function fight($target);

    /**
     * @return string
     */
    public function getFighterType()
    {
        return $this->fighter_type;
    }
}