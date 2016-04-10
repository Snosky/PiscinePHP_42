<?php
/**
 * find an item by his id
 * @param $id
 * @return array|bool|null
 */
function db_findItemById($id)
{
    global $db;

    $id = (int)$id;
    $sql = "SELECT
            t_item.*, GROUP_CONCAT(convert(t_join.cat_id, CHAR(8))) as cats_id
            FROM t_item
            NATURAL JOIN t_category_has_t_item as t_join
            WHERE t_item.itm_id = {$id}
            GROUP BY t_item.itm_id";
    if (!($data = mysqli_query($db, $sql)))
        return FALSE;
    $return = mysqli_fetch_assoc($data);
    mysqli_free_result($data);
    return $return;
}

/**
 * Count items in one category
 * @param $cat_id
 * @return bool
 */
function db_countItemByCategory($cat_id)
{
    global $db;

    //$sql = "SELECT COUNT(*) FROM t_item WHERE cat_id=".(int)$cat_id;
    $sql = "SELECT COUNT(*)
            FROM t_item
            NATURAL JOIN t_category_has_t_item as t_join
            WHERE t_join.cat_id=".(int)$cat_id;
    if (!($result = mysqli_query($db, $sql)))
        return FALSE;
    $return = mysqli_fetch_row($result);
    mysqli_free_result($result);
    return $return[0];
}

function db_findItemByCategory($cat_id)
{
    global $db;

    //$sql = "SELECT * FROM t_item WHERE cat_id=".(int)$cat_id;
    $sql = 'SELECT t_item.*
            FROM t_item
            NATURAL JOIN t_category_has_t_item as t_join
            WHERE t_join.cat_id='.(int)$cat_id;
    if (!($data = mysqli_query($db, $sql)))
        return FALSE;
    $return = mysqli_fetch_all($data, MYSQLI_ASSOC);
    mysqli_free_result($data);
    return $return;
}

/**
 * Return all items
 * @return array|null
 */
function db_getAllItem()
{
    global $db;

    $sql = "SELECT * FROM t_item";
    if (!($result = mysqli_query($db, $sql)))
        return array();
    $return = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $return;
}

function db_deleteItemCatJoinByItemId($id)
{
    global $db;

    $sql = 'DELETE FROM t_category_has_t_item WHERE itm_id='.$id;
    return mysqli_query($db, $sql);
}

/**
 * Add an item
 * @param $data
 * @return bool|mysqli_result
 */
function db_addItem($data)
{
    global $db;

    $data['itm_name'] = mysqli_real_escape_string($db, $data['itm_name']);
    $data['itm_description'] = mysqli_real_escape_string($db, $data['itm_description']);

    $sql = "INSERT INTO t_item (itm_name, itm_description, itm_quantity, itm_price) VALUES (
    '{$data['itm_name']}', 
    '{$data['itm_description']}', 
    '{$data['itm_quantity']}', 
    '{$data['itm_price']}' 
    )";

    if (mysqli_query($db, $sql))
    {
        $id = mysqli_insert_id($db);
        db_deleteItemCatJoinByItemId($id);
        foreach ($data['cat_id'] as $cat)
        {
            $cat = mysqli_real_escape_string($db, $cat);
            $sql = "INSERT INTO t_category_has_t_item (cat_id, itm_id) VALUES ('$cat', '$id')";
            if (!mysqli_query($db, $sql))
                return false;
        }

    }
    else
        return false;
    return true;
}

/**
 * Update an item
 * @param $data
 * @return bool|mysqli_result
 */
function db_editItem($data)
{
    global $db;

    $data['itm_name'] = mysqli_real_escape_string($db, $data['itm_name']);
    $data['itm_description'] = mysqli_real_escape_string($db, $data['itm_description']);

    $sql = "UPDATE t_item SET
    itm_name='{$data['itm_name']}', 
    itm_description='{$data['itm_description']}', 
    itm_quantity='{$data['itm_quantity']}', 
    itm_price='{$data['itm_price']}' 
    WHERE itm_id=".(int)$data['itm_id'];

    if (mysqli_query($db, $sql))
    {
        $id = $data['itm_id'];
        db_deleteItemCatJoinByItemId($id);
        if (isset($data['cats_id']))
            $data['cat_id'] = explode(',', $data['cats_id']);
        foreach ($data['cat_id'] as $cat)
        {
            $cat = mysqli_real_escape_string($db, $cat);
            $sql = "INSERT INTO t_category_has_t_item (cat_id, itm_id) VALUES ('$cat', '$id')";
            if (!mysqli_query($db, $sql))
                return false;
        }
    }
    else
        return false;
    return true;
}

function db_deleteItem($itm_id)
{
    global $db;

    db_deleteItemCatJoinByItemId($itm_id);
    $sql = "DELETE FROM t_item WHERE itm_id=".(int)$itm_id;
    return mysqli_query($db, $sql);
}