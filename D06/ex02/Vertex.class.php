<?php
require_once 'Color.class.php';

class Vertex
{
    /**
     * @var float
     * Vertex abscissa
     */
    private $_x;

    /**
     * @var float
     * Vertex ordinate
     */
    private $_y;

    /**
     * @var float
     * Vertex Depth
     */
    private $_z;

    /**
     * @var float
     * Vertex Homogeneous coordinates
     */
    private $_w = 1.0;

    /**
     * @var Color
     * Vertex color
     */
    private $_color;

    /**
     * @var bool
     * Activate or Deactive debug text
     */
    static public $verbose = FALSE;

    static public function doc()
    {
        if (file_exists('Vertex.doc.txt'))
            $str =  file_get_contents('Vertex.doc.txt').PHP_EOL;
        else
        {
            $str = '<- Vertex ---------------------------------------------------------------------'.PHP_EOL;
            $str .= 'Doc file is missing.'.PHP_EOL;
            $str .= '--------------------------------------------------------------------- Vertex ->'.PHP_EOL;
        }
        return $str;
    }


    public function __construct(Array $data)
    {
        $this->setColor(new Color(array('rgb' => 0xFFFFFF)));

        if (key_exists('x', $data) && key_exists('y', $data) && key_exists('z', $data)) {
            $this->setX($data['x']);
            $this->setY($data['y']);
            $this->setZ($data['z']);
        }
        else
            return;

        if (key_exists('w', $data))
            $this->setW($data['w']);
        if (key_exists('color', $data) && get_class($data['color']) == 'Color')
            $this->setColor($data['color']);

        if (self::$verbose === TRUE)
            echo "$this constructed".PHP_EOL;
    }

    public function __destruct()
    {
        if (self::$verbose == TRUE)
            echo "$this destructed".PHP_EOL;
    }

    public function __toString()
    {
        if (self::$verbose == TRUE)
            return sprintf('Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, %s )', $this->getX(), $this->getY(), $this->getZ(), $this->getW(), $this->getColor());
        return sprintf('Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f)', $this->getX(), $this->getY(), $this->getZ(), $this->getW());
    }

    /**
     * @return float
     */
    public function getX()
    {
        return $this->_x;
    }

    /**
     * @param float $x
     */
    public function setX($x)
    {
        $this->_x = $x;
    }

    /**
     * @return float
     */
    public function getY()
    {
        return $this->_y;
    }

    /**
     * @param float $y
     */
    public function setY($y)
    {
        $this->_y = $y;
    }

    /**
     * @return float
     */
    public function getZ()
    {
        return $this->_z;
    }

    /**
     * @param float $z
     */
    public function setZ($z)
    {
        $this->_z = $z;
    }

    /**
     * @return float
     */
    public function getW()
    {
        return $this->_w;
    }

    /**
     * @param float $w
     */
    public function setW($w)
    {
        $this->_w = $w;
    }

    /**
     * @return Color
     */
    public function getColor()
    {
        return $this->_color;
    }

    /**
     * @param Color $color
     */
    public function setColor(Color $color)
    {
        $this->_color = $color;
    }
}
