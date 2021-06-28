<?php

session_start();
if (isset($_SESSION['isAuth'])) {
    header("Location: home.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <?php include "Components/header.html"; ?>
    <?php (isset($_SESSION['ERROR'])) ? $ERROR = $_SESSION['ERROR'] : $ERROR = "" ?>
    <?php (isset($_SESSION['OLD_DATA'])) ? $DATA = $_SESSION['OLD_DATA'] : $DATA = "" ?>

    <title>Code School - Register</title>
    <link rel="stylesheet" href="../public/css/forms.css">

</head>

<body>

    <!-- Main Content -->
    <main>

        <!-- Return -->
        <a href="../index.php">
            <img src="../public/images/seta.png" alt="arrow">
        </a>

        <h2>Register</h2>

        <!-- Form -->
        <form action="../app/Query/User/create.php" method="POST">

            <div class="input-field">
                <input type="text"  value="<?= !empty($DATA['name']) ? $DATA['name'] : '' ?>" name="name" id="name" placeholder="Enter your full name">
                <div class="underline"></div>
                <span><?= !empty($ERROR['name']) ? $ERROR['name'] : "" ?></span>
            </div>

            <div class="input-field">
                <input type="email" value="<?= !empty($DATA['email']) ? $DATA['email'] : '' ?>" name="email" id="email" placeholder="Enter your e-mail">
                <div class="underline"></div>
                <span><?= !empty($ERROR['email']) ? $ERROR['email'] : "" ?></span>
            </div>

            <div class="input-field">
                <input type="password"  name="password" id="password" placeholder="Enter your password">
                <div class="underline"></div>
                <span><?= !empty($ERROR['password']) ? $ERROR['password'] : "" ?></span>
            </div>

            <div class="input-field">
                <input type="password"  name="confirmPassword" id="confirm-password" placeholder="Confirm Your Password">
                <div class="underline"></div>
                <span><?= !empty($ERROR['confirmPassword']) ? $ERROR['confirmPassword'] : "" ?></span>
            </div>

            <input type="submit" value="Continue">
        </form>

        <!-- Footer -->
        <div class="footer">
            <span>Or register with social media</span>

            <?php require "Components/socialMedias.html"; ?>

            <span>If you already have an account</span>

            <a href="login.php">
                <div class="register">
                    <i class="fas fa-sign-in-alt"></i>
                    Sign in
                </div>
            </a>
        </div>
    </main>
</body>

</html>