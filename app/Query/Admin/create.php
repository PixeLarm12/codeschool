<?php
session_start();

include_once('../../Database/db.php');

$name = $_POST["name"];
$value = $_POST["value"];
$description = $_POST["description"];
$image = $_FILES["image"];
$category = $_POST["category"];


unset($_SESSION['ERROR']);

$_SESSION['OLD_DATA']['name'] = $name;
$_SESSION['OLD_DATA']['value'] = $value;
$_SESSION['OLD_DATA']['description'] = $description;

//NAME VALIDATIONS
if (empty($name)) {
    $_SESSION['ERROR'] = [
        'name' => 'The <b>Name</b> field is required.'
    ];
    header("Location: ../../../views/Admin/create.php");
    exit;
}

if (strlen($name) < 3 || strlen($name) > 50) {
    $_SESSION['ERROR'] = [
        'name' => 'The <b>Name</b> field must have a min of 3 characters and max of 50 characters.'
    ];

    header("Location: ../../../views/Admin/create.php");
    exit;
}


//VALUE VALIDATIONS
if (empty($value)) {
    $_SESSION['ERROR'] = [
        'value' => 'The <b>Value</b> field is required.'
    ];

    header("Location: ../../../views/Admin/create.php");
    exit;
}


//PASSWORD VALIDATIONS
if (empty($description)) {
    $_SESSION['ERROR'] = [
        'description' => 'The <b>Description</b> field is required.'
    ];

    header("Location: ../../../views/Admin/create.php");
    exit;
}

if (strlen($description) < 3 || strlen($description) > 255) {
    $_SESSION['ERROR'] = [
        'description' => 'The <b>Description</b> field must have a min of 3 characters and max of 255 characters.'
    ];

    header("Location: ../../../views/Admin/create.php");
    exit;
}


//CATEGORY VALIDATIONS
if (empty($category)) {
    $_SESSION['ERROR'] = [
        'category' => 'The <b>Category</b> field is required.'
    ];

    header("Location: ../../../views/Admin/create.php");
    exit;
}


//FORMATTING IMAGE NAME
if(!$image['name'] == ""){
    $ext = strtolower(substr($image['name'], -4));
    $imageName = rand(0, 999999) . $ext;
    $dir = '../../../public/Courses/images/';
    
    move_uploaded_file($image['tmp_name'], $dir.$imageName);
} else {
    $imageName = 'null.png';
}

if ($_SESSION['ERROR'] === null) {
    try {
        $statement = $database->prepare("INSERT INTO courses (name, value, description, image, category) VALUES (:name, :value, :description, :image, :category)");
        $params = [
            ':name' => $name,
            ':value' => $value,
            ':description' => $description,
            ':image' => $imageName,
            ':category' => $category,
        ];

        $statement->execute($params);
        header("Location: ../../../views/Admin/list.php"); 
        exit;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

header("Location: ../../../views/Admin/create.php");
exit;
