<?php

session_start();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code School - Contact</title>
    <link rel="stylesheet" href="../public/css/second-pages.css">
    <link rel="shortcut icon" href="../public/images/favicon.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/1ab94d0eba.js" crossorigin="anonymous"></script>
</head>

<body>
    <main>

        <header>
            <div class="text">
                <h1>Code School</h1>
                <h2>About</h2>
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

                <h2>About Us</h2>

                <div class="text">
                    <p>We are CodeSchool company. We were created by four young developers. The company borned in 2021 and still working with seriousness in our proposal, that are give knowledge through online courses, facilitating the interesteds in learn programming! Our plataform is easy to use and has the newest technologies on the market. The students have whole and concrete access to the courses, being able to access every moment and everywhere. About the knowledge gave we have a big diversity of themes, leaving the student to choose the interesting course, not to mention the affordable price for everyone. Don't lose time, come be part of CodeSchool!</p>
                </div>
            </div>

            <div class="box">

                <h2>About Us</h2>

                <div class="text">
                    <p>
                        The CodeSchool is an online platform that has courses in different areas of programming with affordable prices, aiming to use the technology for students to have access to maximum contents!
                    </p>

                    <br>

                    <p>
                        Our developers team is working constantly to provide the information to our users in a objective and simple way.
                    </p>

                </div>

            </div>

        </div>

        </div>
    </main>
</body>

</html>