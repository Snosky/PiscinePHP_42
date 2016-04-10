<?php
session_start();
if ($_GET['login'] && $_GET['passwd'])
{
  $_SESSION['loggued_on_user'] = "";
  if (!file_exists('../private/passwd'))
  {
    echo 'ERROR'.PHP_EOL;
    return FALSE;
  }
  if (($data = file_get_contents('../private/passwd')) === FALSE)
  {
    echo 'ERROR'.PHP_EOL;
    return FALSE;
  }
  $data = unserialize($data);

  $salt = hash('whirlpool', 'my_random_value');
  $passwd = hash('whirlpool', $_GET['passwd'].$salt);

  foreach ($data as $user)
  {
    if ($user['login'] == $_GET['login'] && $user['passwd'] == $passwd)
    {
      $_SESSION['loggued_on_user'] = $user['login'];
      echo 'OK'.PHP_EOL;
      return TRUE;
    }
  }
  echo 'ERROR'.PHP_EOL;
}
else {
  echo 'ERROR'.PHP_EOL;
}
?>
