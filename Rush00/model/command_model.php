<?php
function db_addCommand($data)
{
    global $db;

    $data['usr_id'] = mysqli_real_escape_string($db, $data['usr_id']);
    $data['com_data'] = mysqli_real_escape_string($db, $data['com_data']);
    $data['com_status'] = mysqli_real_escape_string($db, $data['com_status']);
    $sql = "INSERT INTO t_command (usr_id, com_data, com_status, com_date) VALUES ('{$data['usr_id']}', '{$data['com_data']}', '{$data['com_status']}', NOW())";
    return mysqli_query($db, $sql);
}

function db_findCommandByUser($usr_id)
{
    global $db;

    $sql = "SELECT * FROM t_command WHERE usr_id=".(int)$usr_id." ORDER BY com_id DESC";
    if (!($data = mysqli_query($db, $sql)))
        return FALSE;
    $return = mysqli_fetch_all($data, MYSQLI_ASSOC);
    mysqli_free_result($data);
    return $return;
}

function db_findCommandById($com_id)
{
    global $db;

    $sql = "SELECT * FROM t_command WHERE com_id=".(int)$com_id;
    if (!($data = mysqli_query($db, $sql)))
        return FALSE;
    $return = mysqli_fetch_assoc($data);
    mysqli_free_result($data);
    return $return;
}

function db_getAllCommand()
{
    global $db;

    $sql = "SELECT * FROM t_command ORDER BY com_id DESC";
    if (!($data = mysqli_query($db, $sql)))
        return FALSE;
    $return = mysqli_fetch_all($data, MYSQLI_ASSOC);
    mysqli_free_result($data);
    return $return;
}

function db_validCommand($com_id)
{
    global $db;

    $sql = "UPDATE t_command SET com_status=1 WHERE com_id=".(int)$com_id;
    return mysqli_query($db, $sql);
}

function db_cancelCommand($com_id)
{
    global $db;

    $sql = "UPDATE t_command SET com_status=0 WHERE com_id=".(int)$com_id;
    return mysqli_query($db, $sql);
}

