<?php
function db_findCategoryById($id)
{
    global $db;

    $sql = "SELECT * FROM t_category WHERE cat_id=".(int)$id;
    if (!($data = mysqli_query($db, $sql)))
        return FALSE;
    $return = mysqli_fetch_assoc($data);
    mysqli_free_result($data);
    return $return;
}

/**
 * Find a category bi name
 * @param $name
 * @param int $id
 * @return array|bool|null
 */
function db_findCategoryByName($name, $id = 0)
{
    global $db;

    $sql = "SELECT * FROM t_category WHERE cat_name='".mysqli_real_escape_string($db, $name)."'";
    if ($id)
        $sql .= " AND cat_id <> ".(int)$id;
    if (!($data = mysqli_query($db, $sql)))
        return FALSE;
    $return = mysqli_fetch_assoc($data);
    mysqli_free_result($data);
    return $return;
}

/**
 * Return all categories
 * @return array|null
 */
function db_getAllCategory()
{
    global $db;

    $sql = "SELECT * FROM t_category";
    if (!($result = mysqli_query($db, $sql)))
        return array();
    $return = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $return;
}

/**
 * Add a category
 * @param $data
 * @return bool|mysqli_result
 */
function db_addCategory($data)
{
    global $db;

    $sql = "INSERT INTO t_category (cat_name) VALUES ('".mysqli_real_escape_string($db, $data['name'])."')";
    return mysqli_query($db, $sql);
}

/**
 * Update a category
 * @param $data
 * @return bool|mysqli_result
 */
function db_editCategory($data)
{
    global $db;

    $sql = "UPDATE t_category SET cat_name='".mysqli_real_escape_string($db, $data['cat_name'])."' WHERE cat_id=".(int)$data['cat_id'];
    return mysqli_query($db, $sql);
}

/**
 * Delete category by his id
 * @param $cat_id
 * @return bool|mysqli_result
 */
function db_deleteCategory($cat_id)
{
    global $db;

    $sql = "DELETE FROM t_category WHERE cat_id=".(int)$cat_id;
    return mysqli_query($db, $sql);
}