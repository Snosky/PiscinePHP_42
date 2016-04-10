<?php
session_start();
date_default_timezone_set('Europe\Paris');
if ($_SESSION['loggued_on_user'] && $_POST['msg'] && $_POST['submit'] == OK)
{
  $data = array();
  if (!file_exists('../private/chat'))
    file_put_contents('../private/chat', '');
  $handle = fopen('../private/chat', 'r+');
  if (flock($handle, LOCK_SH | LOCK_NB))
  {
    if (($file = file_get_contents('../private/chat')) === FALSE)
    {
        echo 'ERROR'.PHP_EOL;
        flock($handle, LOCK_UN);
        fclose($handle);
        return;
    }
    flock($handle, LOCK_UN);
  }
  $data = unserialize($file);
  fclose($handle);

  $message = array('login' => $_SESSION['loggued_on_user'], 'time' => time(), 'msg' => $_POST['msg']);
  $data[] = $message;
  $data = serialize($data);

  $handle = fopen('../private/chat', 'rw');
  if (flock($handle, LOCK_EX | LOCK_NB))
  {
      if ((file_put_contents('../private/chat', $data, LOCK_EX)) === FALSE)
        echo 'ERROR'.PHP_EOL;
      flock($handle, LOCK_UN);
  }
  fclose($handle);
}
?>
<form class="" method="post">
  <input type="text" name="msg" value="" />
  <input type="submit" name="submit" value="OK"/>
</form>
