<?php
include_once('db.php');
$user = include_once('listByEmail.php');

return $database->query("SELECT * FROM courses, classes WHERE classes.id_user = " . $user['id'] . " AND courses.id = classes.id_course")->fetchAll();