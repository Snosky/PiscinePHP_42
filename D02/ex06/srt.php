#!/usr/bin/env php
<?php
date_default_timezone_set('Europe/Paris');
class Srt
{
    public $id;
    public $start;
    public $end;
    public $content;
    public $where = 1;

    public function set($line)
    {
      switch ($this->where)
      {
        case 1:
          $this->id = $line;
          break;
        case 2:
          $this->setTime($line);
          break;
        default:
          $this->addContent($line);
      }
      $this->where++;
    }

    private function setTime($time)
    {
      $time = explode(' --> ', $time);
      $this->start = $time[0];
      $this->end = $time[1];
    }

    public function addContent($content)
    {
      if (empty($this->content))
        $this->content = $content;
      else
        $this->content .= PHP_EOL.$content;
    }
}

function cmp($a, $b)
{
  $a_array = explode(',', $a->end);
  $b_array = explode(',', $b->start);

  $a = strtotime($a_array[0]);
  $b = strtotime($b_array[0]);

  $a = $a * 1000 + $a_array[1];
  $b = $b  * 1000 + $b_array[1];

  return $a > $b;
}

if (isset($argv) && $argc == 2)
{
  if (end(explode('.', $argv[1])) != 'srt')
    exit();
  if (($handle = @fopen($argv[1], 'r')) !== FALSE)
  {
      $lines = array();
      $srt = new Srt();
      while (($l = fgets($handle)) !== FALSE)
      {
        if ($l == PHP_EOL)
        {
          $lines[] = $srt;
          $srt = new Srt();
        }
        else
          $srt->set(trim($l));
      }
      $lines[] = $srt;
      usort($lines, 'cmp');
      foreach ($lines as $k => $line)
      {
        if ($k)
          echo PHP_EOL;
        echo ($k + 1).PHP_EOL;
        echo $line->start . ' --> ' . $line->end.PHP_EOL;
        echo $line->content.PHP_EOL;
      }
  }
}
?>
