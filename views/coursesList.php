<?php
session_start();

$courses = include_once('../app/Query/User/coursesByUser.php');

if (!isset($_SESSION['isAuth'])) {
    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <?php include "Components/header.html"; ?>

    <title>Code School - Courses</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../public/css/normalize.css">
    <link rel="stylesheet" href="../public/css/admin.css">
    <link rel="stylesheet" href="../public/css/courses.css">

    <link rel="shortcut icon" href="../public/images/favicon.png" type="image/x-icon">

</head>

<body id="list-body">
    <header>
        <nav>
            <a href=""><div class="list">List Courses</div></a>
        </nav>

        <div class="close"><a href="home.php"><img src="../public/images/return-icon-white.svg" alt="close button"></a></div>
    </header>

    <div class="main">

        <ul>

            <?php
            if (!empty($courses)) {
                foreach ($courses as $course) {
            ?>
                    <li>
                        <div class="course"><div class="course-name"><?= $course['name'] ?>

                        <br>

                            <form action="../app/Query/User/deleteCourse.php" method="POST">
                            
                                <input type="hidden" name="id" value="<?= $course['id']?>">
                                <button onclick="return confirm('Are you sure that wants to delete this? Once confirmed, the action cannot be undone')">Delete Course</button>

                            </form>                    
                            <br>
                            <form action="../app/Query/User/changeCourseStatus.php" method="POST">
                            
                                <input type="hidden" name="id" value="<?= $course['id']?>">
                                <input type="hidden" name="status" value="<?= $course['status']?>">

                                <?php ($course['status'] == 'Cursando') ? $changedStatus = 'Finalizado' : $changedStatus = 'Cursando'?>

                                <button onclick="return confirm('Are you sure that wants to change the current course status? The current status <?= $course['status'] ?> will be changed to <?=$changedStatus?> ')" >Change Course Status</button>
                                <!-- onclick="return confirm('Are you sure that wants to change the current course status? The current status '<?= $course['status'] ?>' will be changed to '<?=$changedStatus?>')" -->
                            </form>                    
                        
                        </div>

                        <?php ($course['status'] == 'Cursando') ? $color = 'blue' : $color = 'red' ?>

                        <div class="course-edit" style="background-color: <?= $color ?>;">
                            <?= $course['status']?>
                        </div>
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