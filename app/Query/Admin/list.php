<?php
include_once('../../app/Database/db.php');

try {
    $courses = $database->query("SELECT id, name, value, description, category FROM courses ORDER BY name")->fetchAll();

    return $courses;
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
