<?php
session_start();
unset($_SESSION['courses']);
include_once('db.php');

$order = $_POST['order'];
$filter = $_POST['filter'];
$name = $_POST['name'];

$coursesSearch = [];


if($name == "" && $filter == ""){
    $where = "";
}
else if($name !== "" && $filter == ""){
    $where = "WHERE LOWER(name) LIKE '%" . strtolower($name) . "%'";
}
else if($name == "" && $filter !== ""){
    $where = "WHERE LOWER(ategory) LIKE '%" . strtolower($filter) . "%'";
}
else {
    $where = "WHERE LOWER(name) LIKE '%" . strtolower($name) . "%' AND LOWER(category) LIKE '%" . strtolower($filter) . "%'";
}

if($order !== ""){
    $order = "ORDER BY CAST(value AS Float) " . $order;
}
else{
    $order = "ORDER BY CAST(value AS Float) asc";
}

$coursesSearch = $database->query("SELECT id, name, value, description, image, category FROM courses " . $where . " " . $order)->fetchAll();

if(count($coursesSearch) > 0){
    $_SESSION['courses'] = $coursesSearch;
}

if(count($coursesSearch) == 0){
    $_SESSION['courses'] = 0;
}

header("Location: ../../../views/home.php");
exit;
