<?php
include_once('db.php');

try {
    $courses = $database->query("SELECT id, name, value, description, image, category FROM courses ORDER BY name")->fetchAll();

    return $courses;
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
