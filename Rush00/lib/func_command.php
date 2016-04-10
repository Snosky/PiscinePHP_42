<?php
function command_extract_quantity($command)
{
    if (!empty($command))
        return unserialize($command['com_data']);
    return array();
}
