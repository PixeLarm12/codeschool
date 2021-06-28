<?php
session_start();

include_once('../../Database/db.php');

$id = $_POST['id'];
$imageNameOld = $_POST['imageName'];

try {
    $statement = $database->query("DELETE FROM courses WHERE id = $id");
    
    if($imageNameOld !== 'null.png'){
        $dir = '../../../public/Courses/images/';
        unlink($dir.$imageNameOld);
    }

    header("Location: ../../../views/Admin/list.php");
    exit;
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
