<?php

function searchById($id)
{
    include_once('../../app/Database/db.php');
    return $database->query("SELECT id, name, value, description, image, category FROM courses WHERE id = $id")->fetch();
}
