<?php

session_start();
if (!$_SESSION['isAdm'] || !isset($_SESSION['isAuth'])) {
    header("Location: ../home.php");
}

include_once('../../app/Database/db.php');

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <?php include "../Components/header.html"; ?>
    <?php (isset($_SESSION['ERROR'])) ? $ERROR = $_SESSION['ERROR'] : $ERROR = "" ?>
    <?php (isset($_SESSION['OLD_DATA'])) ? $DATA = $_SESSION['OLD_DATA'] : $DATA = "" ?>

    <title>Code School - Admin</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../../public/css/normalize.css">
    <link rel="stylesheet" href="../../public/css/admin.css">

    <link rel="shortcut icon" href="../../public/images/favicon.png" type="image/x-icon">

</head>

<body id="register-body">
    <header>
        <nav>
            <a href="list.php"><div class="list">List Courses</div></a>
            <a href="create.php"><div class="register">Register Courses</div></a>
        </nav>

        <div class="close"><a href="../../app/Query/Auth/logout.php"><img src="../../public/images/close-icon.svg" alt="close button"></a></div>
    </header>

    <div class="main">

        <form action="../../app/Query/Admin/create.php" method="POST" enctype="multipart/form-data">

            <input type="text" value="<?= !empty($DATA['name']) ? $DATA['name'] : '' ?>" name="name" placeholder="Title"><br>
            <span><?= !empty($ERROR['name']) ? $ERROR['name'] : "" ?></span><br>
            <input type="text" value="<?= !empty($DATA['value']) ? $DATA['value'] : '' ?>" name="value" placeholder="Price"><br>
            <span><?= !empty($ERROR['value']) ? $ERROR['value'] : "" ?></span><br>
            <textarea name="description" placeholder="Description"><?= !empty($DATA['description']) ? $DATA['description'] : '' ?></textarea><br>
            <span><?= !empty($ERROR['description']) ? $ERROR['description'] : "" ?></span><br>
            <select name="category">

                <option value="" selected>Select a category</option>
                <option value="CSS">CSS</option>
                <option value="JavaScript">JAVASCRIPT</option>
                <option value="PHP">PHP</option>
                <option value="DESIGN">DESIGN</option>
                <option value="DATABASE">DATABASE</option>
                <option value="FRONT-END">FRONT-END</option>
                <option value="BACK-END">BACK-END</option>
                <option value="WEB">WEB</option>

            </select>
            <br>
            <span><?= !empty($ERROR['category']) ? $ERROR['category'] : "" ?></span><br>

            <input type="file" name="image" id="image">
            <br>

            <br>

            <input type="submit" value="Submit">
        </form>

    </div>

</body>

</html>
