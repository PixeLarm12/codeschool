<?php
session_start();

include_once('../../Database/db.php');

$id = $_POST["id"];
$name = $_POST["name"];
$value = $_POST["value"];
$description = $_POST["description"];
$image = $_FILES["image"];
$category = $_POST["category"];
$imageNameOld = $_POST['imageName'];

unset($_SESSION['ERROR']);


//NAME VALIDATIONS
if (empty($name)) {
    $_SESSION['ERROR'] = [
        'name' => 'The <b>Name</b> field is required.'
    ];
    header("Location: ../../../views/Admin/update.php");
    exit;
}

if (strlen($name) < 3 || strlen($name) > 50) {
    $_SESSION['ERROR'] = [
        'name' => 'The <b>Name</b> field must have a min of 3 characters and max of 50 characters.'
    ];

    header("Location: ../../../views/Admin/update.php");
    exit;
}


//VALUE VALIDATIONS
if (empty($value)) {
    $_SESSION['ERROR'] = [
        'value' => 'The <b>Value</b> field is required.'
    ];

    header("Location: ../../../views/Admin/update.php");
    exit;
}


//PASSWORD VALIDATIONS
if (empty($description)) {
    $_SESSION['ERROR'] = [
        'description' => 'The <b>Description</b> field is required.'
    ];

    header("Location: ../../../views/Admin/update.php");
    exit;
}

if (strlen($description) < 3 || strlen($description) > 255) {
    $_SESSION['ERROR'] = [
        'description' => 'The <b>Description</b> field must have a min of 3 characters and max of 255 characters.'
    ];

    header("Location: ../../../views/Admin/update.php");
    exit;
}


//CONFIRM PASSWORD VALIDATIONS
if (empty($category)) {
    $_SESSION['ERROR'] = [
        'category' => 'The <b>Category</b> field is required.'
    ];

    header("Location: ../../../views/Admin/update.php");
    exit;
}

//FORMATTING IMAGE NAME
if(!$image['name'] == ""){
    $ext = strtolower(substr($image['name'], -4));
    $imageName = rand(0, 999999) . $ext;
    $dir = '../../../public/Courses/images/';
    
    move_uploaded_file($image['tmp_name'], $dir.$imageName);

    if($imageNameOld !== 'null.png'){
        unlink($dir.$imageNameOld);
    }
} else {
    $imageName = $imageNameOld;
}

if ($_SESSION['ERROR'] === null) {
    try {
        $statement = $database->prepare("UPDATE courses SET name = :name, value = :value, description = :description, image = :image, category = :category WHERE id = $id");
        $params = [
            ':name' => $name,
            ':value' => $value,
            ':description' => $description,
            ':image' => $imageName,
            ':category' => $category,
        ];

        $statement->execute($params);
        unset($_SESSION['courseId']);
        header("Location: ../../../views/Admin/list.php");
        exit;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

header("Location: ../../../views/Admin/update.php");
exit;
