<?php
session_start();

include_once('db.php');

$id = $_POST['id'];

try {
    $statement = $database->query("DELETE FROM classes WHERE id = $id");
    
    if($imageNameOld !== 'null.png'){
        $dir = '../../../public/Users/images/';
        unlink($dir.$imageNameOld);
    }

    header("Location: ../../../views/home.php");
    exit;
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
