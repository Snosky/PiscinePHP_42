<?php
/**
 * Hash a password with salt
 * @param $password
 * @param $salt
 * @return string
 */
function hash_pwd($password, $salt)
{
    return hash('whirlpool', $password.$salt);
}
