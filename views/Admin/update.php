<?php

session_start();
include_once('../../app/Query/Admin/listById.php');

if (isset($_GET['id'])) {
    $_SESSION['courseId'] = $_GET['id'];
    $course = searchById($_GET['id']);
} else {
    $course = searchById($_SESSION['courseId']);
}

if (!$_SESSION['isAdm'] || !isset($_SESSION['isAuth'])) {
    header("Location: ../home.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <?php include "../Components/header.html"; ?>
    <?php (isset($_SESSION['ERROR'])) ? $ERROR = $_SESSION['ERROR'] : $ERROR = "" ?>

    <title>Code School - Admin</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="../../public/css/normalize.css">
    <link rel="stylesheet" href="../../public/css/admin.css">

    <link rel="shortcut icon" href="../../public/images/favicon.png" type="image/x-icon">

</head>

<body id="register-body">
    <header id="edit-header">
        <div class="name">Data update</div>
        <div class="close"><a href="list.php"><img src="../../public/images/return-icon-white.svg" alt="close button"></a></div>
    </header>

    <div class="main">

        <h1></h1>

        <form action="../../app/Query/Admin/update.php" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?= $course['id'] ?>"><br>
            <input type="hidden" name="imageName" value="<?= $course['image'] ?>"><br>

            <input type="text" name="name" value="<?= $course['name'] ?>"><br>
            <span><?= !empty($ERROR['name']) ? $ERROR['name'] : "" ?></span><br>
            <input type="text" name="value" value="<?= $course['value'] ?>"><br>
            <span><?= !empty($ERROR['value']) ? $ERROR['value'] : "" ?></span><br>
            <textarea name="description"><?= $course['description'] ?></textarea>
            <span><?= !empty($ERROR['description']) ? $ERROR['description'] : "" ?></span><br>

            <select name="category">

                <option value="<?= $course['category'] ?>" selected><?= $course['category'] ?></option>
                <option value="CSS">CSS</option>
                <option value="JavaScript">JAVASCRIPT</option>
                <option value="PHP">PHP</option>
                <option value="DESIGN">DESIGN</option>
                <option value="DATABASE">DATABASE</option>
                <option value="FRONT-END">FRONT-END</option>
                <option value="BACK-END">BACK-END</option>
                <option value="WEB">WEB</option>

            </select>
            <span><?= !empty($ERROR['category']) ? $ERROR['category'] : "" ?></span><br>
            
            <br>

            <input type="file" name="image" id="image">

            <br><br>

            <input type="submit" value="Enviar">

        </form>

        <form action="../../app/Query/Admin/delete.php" method="POST" id="delete">
            <input type="hidden" name="id" value="<?= $course['id'] ?>"><br>
            <input type="hidden" name="imageName" value="<?= $course['image'] ?>"><br>
            
            <input type="submit" value="Delete" onclick="return confirm('Are you sure that wants to delete this? Once confirmed, the action cannot be undone')">
        </form>

    </div>

</body>

</html>