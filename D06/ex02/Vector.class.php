<?php
require_once 'Vertex.class.php';

class Vector
{
    /**
     * @var float
     * Vector x magnitude
     */
    private $_x;

    /**
     * @var float
     * Vector y magnitude
     */
    private $_y;

    /**
     * @var float
     * Vector y magnitude
     */
    private $_z;

    /**
     * @var float
     * Vector coordinate
     */
    private $_w;

    /**
     * @var bool
     * Activate or Deactive debug text
     */
    static public $verbose = TRUE;

    static public function doc()
    {
        if (file_exists('Vector.doc.txt'))
            $str =  file_get_contents('Vector.doc.txt').PHP_EOL;
        else
        {
            $str = '<- Vector ---------------------------------------------------------------------'.PHP_EOL;
            $str .= 'Doc file is missing.'.PHP_EOL;
            $str .= '--------------------------------------------------------------------- Vector ->'.PHP_EOL;
        }
        return $str;
    }

    public function __construct(Array $data)
    {
        $orig = new Vertex(array('x' => 0, 'y' => 0, 'z' => 0, 'w' => 1));
        if (key_exists('orig', $data) && get_class($data['dest']) == 'Vertex')
            $orig = $data['orig'];

        if (key_exists('dest', $data) && get_class($data['dest']) == 'Vertex')
        {
            $dest = $data['dest'];
            $this->_x = $dest->getX() - $orig->getX();
            $this->_y = $dest->getY() - $orig->getY();
            $this->_z = $dest->getZ() - $orig->getZ();
            $this->_w = 0;
        }
        else
            return;

        if (self::$verbose === TRUE)
            echo "$this constructed".PHP_EOL;
    }

    public function __destruct()
    {
        if (self::$verbose === TRUE)
            echo "$this destructed".PHP_EOL;
    }

    public function __toString()
    {
        return sprintf('Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f )', $this->getX(), $this->getY(), $this->getZ(), $this->getW());
    }

    /**
     * @return float
     * Return vector length
     */
    public function magnitude()
    {
        $a = $this->getX() * $this->getX() + $this->getY() * $this->getY() + $this->getZ() * $this->getZ();
        return sqrt($a);
    }

    public function normalize()
    {
        if ($this->getW() != 0)
        {
          $vertex = new Vertex(array(
            'x' => $this->getX() / $this->getW(),
            'y' => $this->getY() / $this->getW(),
            'z' => $this->getZ() / $this->getW(),
          ));
        }
        else
        {
          $vertex = new Vertex(array(
            'x' => $this->getX() / $this->magnitude(),
            'y' => $this->getY() / $this->magnitude(),
            'z' => $this->getZ() / $this->magnitude(),
          ));
        }
        return new Vector(array('dest' => $vertex));
    }

    public function add(Vector $rhs)
    {
        $vertex = new Vertex(array(
            'x' => $this->getX() + $rhs->getX(),
            'y' => $this->getY() + $rhs->getY(),
            'z' => $this->getZ() + $rhs->getZ(),
        ));
        return new Vector(array('dest' => $vertex));
    }

    public function sub(Vector $rhs)
    {
        $vertex = new Vertex(array(
            'x' => $this->getX() - $rhs->getX(),
            'y' => $this->getY() - $rhs->getY(),
            'z' => $this->getZ() - $rhs->getZ(),
        ));
        return new Vector(array('dest' => $vertex));
    }

    public function opposite()
    {
        $vertex = new Vertex(array(
            'x' => $this->getX() * -1,
            'y' => $this->getY() * -1,
            'z' => $this->getZ() * -1,
        ));
        return new Vector(array('dest' => $vertex));
    }

    public function scalarProduct($k)
    {
        $k = (int)$k;
        $vertex = new Vertex(array(
            'x' => $this->getX() * $k,
            'y' => $this->getY() * $k,
            'z' => $this->getZ() * $k,
        ));
        return new Vector(array('dest' => $vertex));
    }

    public function dotProduct(Vector $rhs)
    {
        $a = $rhs->getX() * $this->getX() + $rhs->getY() * $this->getY() + $rhs->getZ() * $this->getZ();
        return $a;
    }

    public function cos(Vector $rhs)
    {
        return $this->dotProduct($rhs) / ($this->magnitude() * $rhs->magnitude());
    }

    public function crossProduct(Vector $rhs)
    {
        $vertex = new Vertex(array(
            'x' => $this->getY() * $rhs->getZ() - $this->getZ() * $rhs->getY(),
            'y' => $this->getZ() * $rhs->getX() - $this->getX() * $rhs->getZ(),
            'z' => $this->getX() * $rhs->getY() - $this->getY() * $rhs->getX(),
        ));
        return new Vector(array('dest' => $vertex));
    }


    /**
     * @return float
     */
    public function getX()
    {
        return $this->_x;
    }

    /**
     * @return float
     */
    public function getY()
    {
        return $this->_y;
    }

    /**
     * @return float
     */
    public function getZ()
    {
        return $this->_z;
    }

    /**
     * @return float
     */
    public function getW()
    {
        return $this->_w;
    }
}
