<?php

session_start();
$user = include_once('../app/Query/User/listByEmail.php');

if (!isset($_SESSION['isAuth'])) {
    header("Location: home.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <?php include "Components/header.html"; ?>
    <?php (isset($_SESSION['ERROR'])) ? $ERROR = $_SESSION['ERROR'] : $ERROR = "" ?>
    <?php (isset($_SESSION['OLD_DATA'])) ? $DATA = $_SESSION['OLD_DATA'] : $DATA = "" ?>

    <title>Code School - Update</title>
    <link rel="stylesheet" href="../public/css/normalize.css">
    <link rel="stylesheet" href="../public/css/forms.css">

</head>

<body>

    <!-- Main Content -->
    <main>

        <!-- Return -->
        <a href="home.php">
            <img src="../public/images/seta.png" alt="arrow">
        </a>

        <h2>Edit - <?=$_SESSION['username']?></h2>

        <!-- Form -->
        <form action="../app/Query/User/update.php" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?= $user['id'] ?>"><br>
            <input type="hidden" name="imageName" value="<?= $user['image'] ?>"><br>

            <div class="input-field">
                <input type="text" value="<?= $user['name'] ?>" name="name" id="name">
                <div class="underline"></div>
                <span><?= !empty($ERROR['name']) ? $ERROR['name'] : "" ?></span>
            </div>

            <div class="input-field">
                <input type="email" value="<?= $user['email'] ?>" name="email" id="email">
                <div class="underline"></div>
                <span><?= !empty($ERROR['email']) ? $ERROR['email'] : "" ?></span>
            </div>

            <div class="input-field">
                <input type="file" name="image" id="image" style="display: none;">
                <input type="button" value="Browse..." onclick="document.getElementById('image').click();" />
                <div class="underline"></div>
            </div>

            <input type="submit" value="Continue">
        </form>

        <form action="../app/Query/user/delete.php" method="POST" id="delete">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
            <input type="hidden" name="imageName" value="<?= $user['image'] ?>">
            
            <input type="submit" value="Delete" onclick="return confirm('Are you sure that wants to delete this? Once confirmed, the action cannot be undone')">
        </form>
    </main>
</body>

</html>