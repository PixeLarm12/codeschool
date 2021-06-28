<?php
session_start();

include_once('db.php');

$id = $_POST['id'];
$imageNameOld = $_POST['imageName'];

try {
    $statement = $database->query("DELETE FROM users WHERE id = $id");
    
    if($imageNameOld !== 'null.png'){
        $dir = '../../../public/Users/images/';
        unlink($dir.$imageNameOld);
    }

    header("Location: ../Auth/logout.php");
    exit;
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
