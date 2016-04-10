<?php
$users = array('zaz' => 'jaimelespetitsponeys');

if (!$_SERVER['PHP_AUTH_USER'] || $users[$_SERVER['PHP_AUTH_USER']] != $_SERVER['PHP_AUTH_PW'])
{
    header('WWW-Authenticate: Basic realm="Test Authentication System"');
    header('HTTP/1.0 401 Unauthorized');
    echo '<html><body>Cette zone est accessible uniquement aux membres du site</body></html>'.PHP_EOL;
  //error();
}
else
{
echo '<html><body>
Bonjour '.$_SERVER['PHP_AUTH_USER'].'<br />
<img src=\'data:image/png;base64,'.base64_encode(file_get_contents('../img/42.png')).'\'>
</body></html>';
}
 ?>
