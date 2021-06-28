<!DOCTYPE html>
<html lang="pt-br">

<?php session_start();
(isset($_SESSION['ERROR'])) ? $ERROR = $_SESSION['ERROR'] : $ERROR = "";
(isset($_SESSION['OLD_DATA'])) ? $DATA = $_SESSION['OLD_DATA'] : $DATA = ""
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code School - Support</title>

    <!-- CSS -->
    <link rel="stylesheet" href="public/css/normalize.css">
    <link rel="stylesheet" href="../public/css/second-pages.css">

    <link rel="shortcut icon" href="../public/images/favicon.png" type="image/x-icon">

    <script src="https://kit.fontawesome.com/1ab94d0eba.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Main Content -->
    <main>
        <!-- Header -->
        <header>
            <div class="text">
                <h1>Code School</h1>
                <h2>Support</h2>
            </div>

            <div class="return">
                <?php

                if (!isset($_SESSION['isAuth'])) {
                    echo "<a href='../index.php'>Return To Home</a>";
                } else if ($_SESSION['isAdm']) {
                    echo "<a href='Admin/home.php'>Return To Home</a>";
                } else {
                    echo "<a href='home.php'>Return To Home</a>";
                }

                ?>

            </div>
        </header>

        <div class="container">

            <div class="box">
                <h2>Get Support</h2>
                <div class="text">
                    <p>
                        You can count on our team of highly skilled customer experience service experts who take personal prince in giving top notch service and every customer.
                    </p>
                    <p>
                        Please note, we are able to respond much faster during our normal support hours of 5am-5pm.
                    </p>
                </div>

                <!-- Form -->
                <form action="../app/Query/Support/create.php" method="POST">
                    <br>

                    <!-- Left -->
                    <div class="left">
                        <h3>Problems:</h3>

                        <label><div class="check"><input type="radio" name="problem" value="courses" checked> Courses</div></label>
                        <label><div class="check"><input type="radio" name="problem" value="site"> Site</div></label>
                        <label><div class="check"><input type="radio" name="problem" value="login"> Login</div></label>
                        <label><div class="check"><input type="radio" name="problem" value="register"> Register</div></label>
                        <span><?= !empty($ERROR['problem']) ? $ERROR['problem'] : "" ?></span>
                        <br>

                        <div class="personal-data">
                            <h3>Username</h3>
                            <input type="text" value="<?= !empty($DATA['username']) ? $DATA['username'] : '' ?>" name="username" id="username" placeholder="Enter Your Username">
                            <span><?= !empty($ERROR['username']) ? $ERROR['username'] : "" ?></span>

                            <br>

                            <h3>E-mail</h3>
                            <input type="email" value="<?= !empty($DATA['email']) ? $DATA['email'] : '' ?>" name="email" id="email" placeholder="Enter Your Email">
                            <span><?= !empty($ERROR['email']) ? $ERROR['email'] : "" ?></span>
                        </div>

                    </div>

                    <!-- Right -->
                    <div class="right">
                        <h3>Comments:</h3>
                        <textarea name="comments"><?= !empty($DATA['comments']) ? $DATA['comments'] : '' ?></textarea>
                        <span><?= !empty($ERROR['comments']) ? $ERROR['comments'] : "" ?></span>
                    </div>

                    <div class="clear"></div> <!-- Clear Div -->

                    <br>

                    <!-- Submit Button -->
                    <div class="submit-button">
                        <input type="submit" value="Submit">
                    </div>
                </form>

            </div>
        </div>
    </main>
</body>

</html>