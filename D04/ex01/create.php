<?php
if ($_POST['login'] && $_POST['passwd'] && $_POST['submit'] == "OK")
{
  if (!file_exists('../private/'))
    mkdir('../private/', 0755);

  $data = array();
  if (file_exists('../private/passwd'))
  {
    if (($file = file_get_contents('../private/passwd')) === FALSE)
    {
        echo 'ERROR'.PHP_EOL;
        return;
    }
    $data = unserialize($file);
  }

  $salt = hash('whirlpool', 'my_random_value');
  $pass = hash('whirlpool', $_POST['passwd'].$salt);

  $user = array('login' => $_POST['login'], 'passwd' => $pass);
  foreach ($data as $duser)
  {
    if ($duser['login'] == $user['login'])
    {
      echo 'ERROR'.PHP_EOL;
      return;
    }
  }
  $data[] = $user;
  $data = serialize($data);
  if (file_put_contents('../private/passwd', $data) === FALSE)
  {
    echo 'ERROR'.PHP_EOL;
    return;
  }
  echo 'OK'.PHP_EOL;
}
else {
  echo 'ERROR'.PHP_EOL;
}
?>
