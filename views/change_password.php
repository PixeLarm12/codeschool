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

    <title>Code School - Change Password</title>
    <link rel="stylesheet" href="../public/css/forms.css">

</head>

<body>

    <!-- Main Content -->
    <main>

        <h2>Forgot Password</h2>

        <!-- Form -->
        <form action="../app/Query/User/change_password.php" method="POST">

            <div class="input-field">
                <input type="email" value="<?= !empty($DATA['email']) ? $DATA['email'] : '' ?>" name="email" id="email" placeholder="Enter your email">
                <div class="underline"></div>
                <span><?= !empty($ERROR['email']) ? $ERROR['email'] : "" ?></span>
            </div>

            <div class="input-field">
                <input type="password" name="password" id="password" placeholder="Enter your password">
                <div class="underline"></div>
                <span><?= !empty($ERROR['password']) ? $ERROR['password'] : "" ?></span>
            </div>

            <div class="input-field">
                <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm your password">
                <div class="underline"></div>
                <span><?= !empty($ERROR['confirmPassword']) ? $ERROR['confirmPassword'] : "" ?></span>
            </div>

            <div class="input-field">
                <input type="text" name="token" id="token" placeholder="Enter your token">
                <div class="underline"></div>
            </div>

            <input type="submit" value="Change Password">

        </form>

    </main>

</body>

</html>
