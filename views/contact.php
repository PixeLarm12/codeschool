<?php

session_start();
if (isset($_SESSION['isAuth'])) {
    header("Location: home.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code School - Contact</title>

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
                <h2>Contact</h2>
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

            <!-- Felipe Box -->
            <div class="box">
                <img src="https://avatars.githubusercontent.com/u/69355764?s=400&u=4ca7cc86aca8d0824d542afaf4b49adfdcdae97f&v=4" alt="Felipe Stevannato">

                <h2>Felipe</h2>

                <!-- Text -->
                <div class="text">Hello, I am Felipe, I started programming at 15 years old because of my love for computers, for this project, I helped with its design and icons, not quite a web developer yet, but studying and seeking out to be one.</div>

                <!-- GitHub -->
                <a href="https://github.com/FelipeEstevanatto">
                    <div class="github-button">
                        <i class="fab fa-github-square"></i> GitHub
                    </div>

                </a>

                <!-- GitLab -->
                <a href="https://gitlab.com/Felipe_estevanatto">
                    <div class="gitlab-button">
                        <i class="fab fa-gitlab"></i> GitLab
                    </div>
                </a>

                <!-- Instagram -->
                <a href="https://www.instagram.com/felipeestevanatto/">
                    <div class="instagram-button">
                        <i class="fab fa-instagram-square"></i> Instagram
                    </div>
                </a>
            </div>

            <!-- Lucas Box -->
            <div class="box">
                <img src="https://gitlab.com/uploads/-/system/user/avatar/5477435/avatar.png?width=400" alt="Lucas Ramos Domingues">

                <h2>Lucas</h2>

                <!-- Text -->
                <div class="text">Hello, I am Lucas Domingues, 18 years old started programming with 14 years old. Nowadays I am a full stack web developer and, of course, studying all the time to improve my codding skill!</div>

                <!-- GitHub -->
                <a href="https://github.com/PixeLarm12">
                    <div class="github-button">
                        <i class="fab fa-github-square"></i> GitHub
                    </div>
                </a>

                <!-- GitLab -->
                <a href="https://gitlab.com/PixeLarm12">
                    <div class="gitlab-button">
                        <i class="fab fa-gitlab"></i> GitLab
                    </div>
                </a>

                <!-- Instagram -->
                <a href="https://www.instagram.com/lucasramosdomingues/">
                    <div class="instagram-button">
                        <i class="fab fa-instagram-square"></i> Instagram
                    </div>
                </a>
            </div>

            <!-- Gabriel Box -->
            <div class="box">
                <img src="https://avatars.githubusercontent.com/u/69210720?s=400&u=73f6d79b12ce7bd7d1304cb9fe68332a22cbf1af&v=4" alt="Gabriel Gomes Nicolim">

                <h2>Gabriel</h2>

                <!-- Text -->
                <div class="text">My name is Gabriel. I started programming in 2020 when I entered a technical computer course and fell in love with the area. I am currently taking my first steps in the universe of the web front-end.</div>

                <!-- GitHub -->
                <a href="https://github.com/GabrielNicolim">
                    <div class="github-button">
                        <i class="fab fa-github-square"></i> GitHub
                    </div>
                </a>

                <!-- GitLab -->
                <a href="https://gitlab.com/GabrielNicolim">
                    <div class="gitlab-button">
                        <i class="fab fa-gitlab"></i> GitLab
                    </div>
                </a>

                <!-- Instagram -->
                <a href="https://www.instagram.com/gabrielnicolim/">
                    <div class="instagram-button">
                        <i class="fab fa-instagram-square"></i> Instagram
                    </div>
                </a>
            </div>
        </div>
    </main>
</body>

</html>