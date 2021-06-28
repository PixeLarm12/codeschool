<?php session_start();

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

    <title>Code School - Forgot Password</title>
    <link rel="stylesheet" href="../public/css/forms.css">

</head>

<body>

    <!-- Main Content -->
    <main>
        <!-- Return -->
        <a href="login.php">
            <img src="../public/images/seta.png" alt="arrow">
        </a>

        <h2>Forgot Password</h2>

        <!-- Form -->
        <form action="../app/Mail/send_email_password.php" method="POST">

            <div class="input-field">
                <input type="email" value="<?= !empty($DATA['email']) ? $DATA['email'] : '' ?>" name=" email" id="email" placeholder="Enter your email">
                <div class="underline"></div>
                <span><?= !empty($ERROR['email']) ? $ERROR['email'] : "" ?></span>
            </div>

            <input type="submit" value="Continue">

        </form>

        <br>
        
        <div>

            <span> <i> We will send an email password validation and you are able to change your password. </i> </span>

        </div>
    </main>

</body>

</html>
