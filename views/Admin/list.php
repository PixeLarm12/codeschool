<?php

session_start();
include_once('../../app/Query/Admin/list.php');
if (!$_SESSION['isAdm'] || !isset($_SESSION['isAuth'])) {
    header("Location: ../home.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <?php include "../Components/header.html"; ?>

    <title>Code School - Admin</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../../public/css/normalize.css">
    <link rel="stylesheet" href="../../public/css/admin.css">

    <link rel="shortcut icon" href="../../public/images/favicon.png" type="image/x-icon">

</head>

<body id="list-body">
    <header>
        <nav>
            <a href="list.php"><div class="list">List Courses</div></a>
            <a href="create.php"><div class="register">Register Courses</div></a>
        </nav>

        <div class="close"><a href="../../app/Query/Auth/logout.php"><img src="../../public/images/close-icon.svg" alt="close button"></a></div>
    </header>

    <div class="main">

        <ul>

            <?php
            if (!empty($courses)) {
                foreach ($courses as $course) {
            ?>
                    <li>
                        <div class="course"><div class="course-name"><?= $course['name'] ?></div><a href="update.php?id=<?= $course['id'] ?>"><div class="course-edit">Edit</div></a>
                    </li>

                <?php

                }
            } else {
                ?>

                <h2>We don't have courses yet!</h2>

            <?php

            }
            ?>

        </ul>

    </div>

</body>

</html>