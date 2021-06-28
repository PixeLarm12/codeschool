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

    <title>Code School - Login</title>
    <link rel="stylesheet" href="../public/css/forms.css">

</head>

<body>

    <!-- Main Content -->
    <main>

        <!-- Return -->
        <a href="../index.php">
            <img src="../public/images/seta.png" alt="arrow">
        </a>

        <h2>Login</h2>

        <!-- Form -->
        <form action="../app/Query/Auth/login.php" method="POST">

            <div class="input-field">
                <input type="email" value="<?= !empty($DATA['email']) ? $DATA['email'] : '' ?>" name=" email" id="email" placeholder="Enter your email">
                <div class="underline"></div>
                <span><?= !empty($ERROR['email']) ? $ERROR['email'] : "" ?></span>
            </div>

            <div class="input-field">
                <input type="password"  name="password" id="password" placeholder="Enter your password">
                <div class="underline"></div>
                <span><?= !empty($ERROR['password']) ? $ERROR['password'] : "" ?></span>
            </div>

            <input type="submit" value="Continue">
        </form>

        <span class="forgot-password"><a href="forgot_password.php"><i>Forgot your password?</i></a></span>

        <!-- Footer -->
        <div class="footer">
            <span>Or connect with social media</span>

            <?php require "Components/socialMedias.html"; ?>

            <span>Or register your account</span>

            <a href="register.php">
                <div class="register">
                    <i class="fas fa-user-plus"></i>
                    Sign up
                </div>
            </a>

        </div>
    </main>
</body>

</html>