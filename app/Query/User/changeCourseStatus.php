<?php
session_start();

include_once('db.php');

$id = $_POST["id"];
$status = ($_POST["status"] == "Cursando") ? 'Finalizado' : 'Cursando';

try {
    $statement = $database->prepare("UPDATE classes SET status = :status WHERE id = $id");
    $params = [
        ':status' => $status
    ];

    $statement->execute($params);
    header("Location: ../../../views/home.php");
    exit;
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

header("Location: ../../../views/coursesList.php");
exit;
