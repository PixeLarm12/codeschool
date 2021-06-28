<?php
session_start();

include_once('../../Database/db.php');
$user = include_once('listByEmail.php');

$idCourse = $_GET["id"];
$status = 'Cursando';

$courses = $database->query("SELECT * FROM classes WHERE id_course = $idCourse AND id_user = " . $user['id'])->fetchAll();
if(!count($courses) > 0){
    try {
        $statement = $database->prepare("INSERT INTO classes (id_user, id_course, status) VALUES (:id_user, :id_course, :status)");
        $params = [
            ":id_user" => $user['id'], 
            ":id_course" => $idCourse, 
            ":status" => $status
        ];
        $statement->execute($params);
    
        header("Location: ../../../views/coursesList.php");
        exit;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
else {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('You have already bought this course!')
        window.location.href='../../../views/home.php';
    </SCRIPT>");
}

