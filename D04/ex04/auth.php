<?php
function auth($login, $passwd)
{
  if (!file_exists('../private/passwd'))
    return FALSE;
  if (($data = file_get_contents()) === FALSE)
    return FALSE;
  $data = unserialize($data);

  $salt = hash('whirlpool', 'my_random_value');
  $passwd = hash('whirlpool', $passwd.$salt);

  foreach ($data as $user)
  {
    if ($user['login'] == $login && $user['passwd'] == $passwd)
      return TRUE;
  }
  return FALSE;
}
