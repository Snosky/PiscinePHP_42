<?php
class Color
{
    /**
     * Red value
     * @var integer
     */
    public $red;

    /**
     * Green value
     * @var integer
     */
    public $green;

    /**
     * Blue value
     * @var integer
     */
    public $blue;

    /**
     * @var bool
     * Activate or Deactive debug text
     */
    static public $verbose = FALSE;

    /**
     * Color constructor.
     * @param array $color
     *
     * If this::$verbose === TRUE
     * echo Debug text
     */
    public function __construct(Array $color)
    {
        if (key_exists('rgb', $color))
        {
            $this->red = intval($color['rgb']) >> 16 & 0xFF;
            $this->green = intval($color['rgb']) >> 8 & 0xFF;
            $this->blue = intval($color['rgb']) & 0xFF;
        }
        else if (key_exists('red', $color) && key_exists('green', $color) && key_exists('blue', $color))
        {
            $this->red = abs((int)$color['red']);
            $this->green = abs((int)$color['green']);
            $this->blue = abs((int)$color['blue']);
        }

        $this->red = ($this->red > 255) ? 255 : $this->red;
        $this->green = ($this->green > 255) ? 255 : $this->green;
        $this->blue = ($this->blue > 255) ? 255 : $this->blue;

        if (self::$verbose === TRUE)
            echo "$this constructed.".PHP_EOL;
    }

    /**
     * If this::$verbose === TRUE
     * echo Debug text
     */
    public function __destruct()
    {
        if (self::$verbose === TRUE)
            echo "$this destructed.".PHP_EOL;
    }

    /**
     * @return string
     * Color( red: $this->red, green: $this->green, blue: $this->blue )
     */
    public function __toString()
    {
        return sprintf("Color( red: %3d, green: %3d, blue: %3d )", $this->red, $this->green, $this->blue);
    }

    /**
     * @return string
     * Return class documentation
     */
    static public function doc()
    {
        if (file_exists('Color.doc.txt'))
            $str =  file_get_contents('Color.doc.txt').PHP_EOL;
        else
        {
            $str = '<- Color ----------------------------------------------------------------------'.PHP_EOL;
            $str .= 'Doc file is missing.'.PHP_EOL;
            $str .= '---------------------------------------------------------------------- Color ->'.PHP_EOL;
        }
        return $str;
    }

    /**
     * @param Color $color
     * @return Color
     *
     * Return a new color who is the result of $this added to $color
     */
    public function add(Color $rhs)
    {
        $c = array();
        $c['red'] = $this->red + $rhs->red;
        $c['green'] = $this->green + $rhs->green;
        $c['blue'] = $this->blue + $rhs->blue;
        return new Color($c);
    }

    /**
     * @param Color $color
     * @return Color
     *
     * Return a new color who is the result of $color sub to $this
     */
    public function sub(Color $rhs)
    {
        $c = array();
        $c['red'] = $this->red - $rhs->red;
        $c['green'] = $this->green - $rhs->green;
        $c['blue'] = $this->blue - $rhs->blue;
        return new Color($c);
    }

    /**
     * @param $mult
     * @return Color
     *
     * Return a new color who is the result of $this->red, $this->green and $this->blue multiply by $mult
     */
    public function mult($f)
    {
        $c = array();
        $c['red'] = $this->red * (int)$f;
        $c['green'] = $this->green * (int)$f;
        $c['blue'] = $this->blue * (int)$f;
        return new Color($c);
    }
}
