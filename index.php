<?php
session_start();
unset($_SESSION['ERROR']);
unset($_SESSION['OLD_DATA']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code School - Home</title>

    <!-- CSS -->
    <link rel="stylesheet" href="public/css/normalize.css">
    <link rel="stylesheet" href="public/css/index.css">

    <link rel="shortcut icon" href="public/images/favicon.png" type="image/x-icon">

</head>

<body>
    <!-- Main Content -->
    <main>
        <!-- Will Be Used For Mobile -->
        <div class="img-responsive">
            <img src="public/images/icon.png" alt="Code School Icon">
        </div>

        <div class="content">
            <h1>Code School</h1>
            <p>Better Devs, Better Applications,</p>
            <p>A Better World!</p>

            <div class="buttons">
                <a href="views/login.php"><button id="sign-in">Sign In</button></a>
                <a href="views/register.php"><button id="register">Register</button></a>
            </div>
        </div>

        <!-- Icon Image -->
        <div class="img">
            <img src="public/images/icon.png" alt="">
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="left">
            &copy; 2021 Code School, Inc.
        </div>
        <div class="right">

            <?php
            if (isset($_SESSION['isAuth'])) {
                echo "<a href='app/Query/Auth/logout.php'>Logout</a> |";
            } ?>

            <a href="views/support.php">Support</a> |
            <a href="views/contact.php">Contact</a> |
            <a href="views/about.php">About</a>
        </div>
    </footer>
</body>

</html>