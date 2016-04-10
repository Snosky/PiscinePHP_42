<?php
session_start();

function show_iframe()
{
  echo '<iframe name="chat" src="chat.php" width="100%" height="550px"></iframe>';
  echo '<iframe name="chat" src="speak.php" width="100%" height="50px"></iframe>';
}

if ($_POST['login'] && $_POST['passwd'])
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
  $passwd = hash('whirlpool', $_POST['passwd'].$salt);

  foreach ($data as $user)
  {
    if ($user['login'] == $_POST['login'] && $user['passwd'] == $passwd)
    {
      $_SESSION['loggued_on_user'] = $user['login'];
      show_iframe();
      return TRUE;
    }
  }
  echo 'ERROR'.PHP_EOL;
}
else {
  echo 'ERROR'.PHP_EOL;
}
?>
