<?php
if ($_POST['login'] && $_POST['oldpw'] && $_POST['newpw'] && $_POST['submit'] == "OK")
{
  if (!file_exists('../private/passwd'))
  {
    echo 'ERROR'.PHP_EOL;
    return;
  }
  if (($file = file_get_contents('../private/passwd')) === FALSE)
  {
    echo 'ERROR'.PHP_EOL;
    return;
  }
  $data = unserialize($file);

  $salt = hash('whirlpool', 'my_random_value');
  $oldpass = hash('whirlpool', $_POST['oldpw'].$salt);
  $newpass = hash('whirlpool', $_POST['newpw'].$salt);

  $user = array('login' => $_POST['login'], 'passwd' => $oldpass);

  foreach ($data as $k => $v)
  {
    if ($v['login'] == $user['login'] && $v['passwd'] == $user['passwd'])
    {
      $data[$k]['passwd'] = $newpass;
      $data = serialize($data);
      if (file_put_contents('../private/passwd', $data) === FALSE)
        break;
      else
      {
        echo 'OK'.PHP_EOL;
        return;
      }
    }
  }
  echo 'ERROR'.PHP_EOL;
  return;
}
else {
  echo 'ERROR'.PHP_EOL;
}
?>
