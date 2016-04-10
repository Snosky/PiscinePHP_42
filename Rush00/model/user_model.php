<?php

/**
 * Retourne un user par son ID
 * @param $id
 */
function db_findUserById($id)
{
    global $db;

    $sql = "SELECT * FROM t_user WHERE usr_id=".(int)$id;
    if (!($data = mysqli_query($db, $sql)))
        return FALSE;
    $return = mysqli_fetch_assoc($data);
    mysqli_free_result($data);
    return $return;
}

/**
 * Retourne un array contenant les data d'utilisateurs par son username
 * @param $username
 * @return array|bool|null
 */
function db_findUserByUsername($username, $usr_id = 0)
{
    global $db;

    $sql = "SELECT * FROM t_user WHERE usr_name='".mysqli_real_escape_string($db, $username)."'";
    if ($usr_id)
        $sql .= " AND usr_id <> ".(int)$usr_id;
    if (!($data = mysqli_query($db, $sql)))
        return FALSE;
    $return = mysqli_fetch_assoc($data);
    mysqli_free_result($data);
    return $return;
}

/**
 * Retourne un array users par son email
 * @param $email
 * @return array|bool|null
 */
function db_findUserByEmail($email, $usr_id = 0)
{
    global $db;

    $sql = "SELECT * FROM t_user WHERE usr_email='".mysqli_real_escape_string($db, $email)."'";
    if ($usr_id)
        $sql .= " AND usr_id <> ".(int)$usr_id;
    if (!($data = mysqli_query($db, $sql)))
        return FALSE;
    $return = mysqli_fetch_assoc($data);
    mysqli_free_result($data);
    return $return;
}

/**
 * Retourne tous les utilisateurs
 * @return array|null
 */
function db_getAllUsers()
{
    global $db;

    $sql = "SELECT * FROM t_user";
    if (!($result = mysqli_query($db, $sql)))
        return array();
    $return = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $return;
}

/**
 * Insert new user in databse, return 1 if success or 0 if failed
 * @param $data
 * @return bool|mysqli_result
 */
function db_addUser($data)
{
    global $db;

    $data = array(
        'usr_name'      => mysqli_real_escape_string($db, $data['username']),
        'usr_password'  => $data['password'],
        'usr_email'     => mysqli_real_escape_string($db, $data['email']),
        'usr_salt'      => $data['salt'],
        'usr_role'      => mysqli_real_escape_string($db, $data['usr_role']),
    );

    $sql = "INSERT INTO t_user (usr_name, usr_email, usr_password, usr_salt, usr_role) VALUES ('{$data['usr_name']}', '{$data['usr_email']}', '{$data['usr_password']}', '{$data['usr_salt']}', '{$data['usr_role']}')";
    return mysqli_query($db, $sql);
}

/**
 * Upate a existing user
 * @param $data
 * @return bool|mysqli_result
 */
function db_editUser($data)
{
    global $db;

    $d = array(
        'usr_name'      => mysqli_real_escape_string($db, $data['usr_name']),
        'usr_email'     => mysqli_real_escape_string($db, $data['usr_email']),
        'usr_role'      => mysqli_real_escape_string($db, $data['usr_role']),
    );


    $sql = "UPDATE t_user SET usr_name='{$d['usr_name']}', usr_email='{$d['usr_email']}', usr_role='{$d['usr_role']}' ";
    if (isset($data['usr_password']))
        $sql .= ", usr_password='{$data['usr_password']}' ";
    $sql .= "WHERE usr_id=".(int)$data['usr_id'];
    return mysqli_query($db, $sql);
}

/**
 * Delete user by his id
 * @param $usr_id
 * @return bool|mysqli_result
 */
function db_deleteUser($usr_id)
{
    global $db;

    $sql = "DELETE FROM t_user WHERE usr_id=".(int)$usr_id;
    return mysqli_query($db, $sql);
}
