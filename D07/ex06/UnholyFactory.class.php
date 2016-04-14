<?php
class UnholyFactory
{
    protected $fighters = array();

    /**
     * @param $fighter Fighter
     */
    public function absorb($fighter)
    {
        if (!$fighter instanceof Fighter)
            echo "(Factory can't absorb this, it's not a fighter)".PHP_EOL;
        else if (isset($this->fighters[$fighter->getFighterType()]))
            echo "(Factory already absorbed a fighter of type {$fighter->getFighterType()})".PHP_EOL;
        else
        {
            $this->fighters[$fighter->getFighterType()] = $fighter;
            echo "(Factory absorbed a fighter of type {$fighter->getFighterType()})".PHP_EOL;
        }
    }

    public function fabricate($request_figher)
    {
        if (isset($this->fighters[$request_figher]))
        {
            echo "(Factory fabricates a fighter of type {$request_figher})" . PHP_EOL;
            return $this->fighters[$request_figher];
        }
        else
            echo "(Factory hasn't absorbed any fighter of type {$request_figher})".PHP_EOL;
    }
}