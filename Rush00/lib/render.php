<?php
function render($filename, $data = array(), $layout = 'layout.php')
{
    extract($data);
    ob_start();
    if (file_exists(ROOT.DS.'view'.DS.$filename))
        include ROOT.DS.'view'.DS.$filename;
    $content_for_layout = ob_get_clean();
    include_once ROOT.DS.'view'.DS.$layout;
    
}