<?php
session_start();

include_once('db.php');

$id = $_POST["id"];
$name = $_POST["name"];
$email = $_POST["email"];
$image = $_FILES["image"];
$imageNameOld = $_POST['imageName'];

unset($_SESSION['ERROR']);


//NAME VALIDATIONS
if (empty($name)) {
    $_SESSION['ERROR'] = [
        'name' => 'The <b>Full name</b> field is required.'
    ];
    header("Location: ../../../views/update.php");
    exit;
}

if (strlen($name) < 3 || strlen($name) > 50) {
    $_SESSION['ERROR'] = [
        'name' => 'The <b>Full name</b> field must have a min of 3 characters and max of 50 characters.'
    ];

    header("Location: ../../../views/update.php");
    exit;
}


//EMAIL VALIDATIONS
if (empty($email)) {
    $_SESSION['ERROR'] = [
        'email' => 'The <b>E-mail</b> field is required.'
    ];

    header("Location: ../../../views/update.php");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['ERROR'] = [
        'email' => 'The <b>E-mail</b> field must have a valid e-mail.'
    ];

    header("Location: ../../../views/update.php");
    exit;
}

//FORMATTING IMAGE NAME
if(!$image['name'] == ""){
    $ext = strtolower(substr($image['name'], -4));
    $imageName = rand(0, 999999) . $ext;
    $dir = '../../../public/Users/images/';
    
    move_uploaded_file($image['tmp_name'], $dir.$imageName);

    if($imageNameOld !== 'null.png'){
        unlink($dir.$imageNameOld);
    }
} else {
    $imageName = $imageNameOld;
}

if ($_SESSION['ERROR'] === null) {
    try {
        $statement = $database->prepare("UPDATE users SET name = :name, email = :email, image = :image WHERE id = $id");
        $params = [
            ':name' => $name,
            ':email' => $email,
            ':image' => $imageName
        ];

        $_SESSION['userEmail'] = $email;

        $statement->execute($params);
        header("Location: ../../../views/home.php");
        exit;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

header("Location: ../../../views/update.php");
exit;
