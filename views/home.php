<?php
session_start();

if(isset($_SESSION['courses'])){
    $courses = $_SESSION['courses'];
}

else {
    include_once('../app/Query/User/list.php');
}

if($courses !== 0){
    $countCourse = count($courses);
}
else {
    $countCourse = 0;
}

$user = include_once('../app/Query/User/listByEmail.php');

if (!isset($_SESSION['isAuth'])) {
    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code School - Main</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../public/css/normalize.css">
    <link rel="stylesheet" href="../public/css/main.css">

    <link rel="shortcut icon" href="../public/images/favicon.png" type="image/x-icon">

    <script src="https://kit.fontawesome.com/1ab94d0eba.js" crossorigin="anonymous"></script>

</head>

<body>
    <!-- Header -->
    <header>
        <!-- Left -->
        <div class="left">
            <img src="../public/images/favicon.png" alt="">
            <div class="text">Code School - Courses</div>
        </div>

        <!-- Right -->
        <div class="right">

        <div class="text"> <a href="coursesList.php"> See courses </a> </div>

            <!-- Avatar Image -->
            <div class="avatar">
                <a href="update.php">
                    <img src="../public/Users/images/<?= $user['image'] ?>" width="64px" height="32px" alt="<?= $user['name'] ?>">
                </a>
            </div>
        </div>
    </header>

    <!-- Top Div -->
    <div class="search">
        <!-- Courses Count -->
        <div class="courses">
            <?php 
               if($countCourse > 1) {
            ?>
            
               <div class="text"><?=$countCourse?> Cursos No Total</div>

            <?php
             }
               else {
            ?>
            
               <div class="text"><?=$countCourse?> Curso No Total</div>

            <?php
               }
                 
            ?>
            
            
        </div>

        <!-- Div And Button -->
        <div class="filter">
            <form id="form-filter" action="../app/Query/User/search.php" method="POST">

                <select name="order" id="order">
                    <option value="" selected>ORDER BY</option>
                    <option value="asc">LOWEST PRICE</option>
                    <option value="desc">BIGGEST PRICE</option>
                </select>

                <select name="filter" id="filter">
                    <option value="" selected>FILTERS</option>
                    <option value="CSS">CSS</option>
                    <option value="JavaScript">JAVASCRIPT</option>
                    <option value="PHP">PHP</option>
                    <option value="DESIGN">DESIGN</option>
                    <option value="DATABASE">DATABASE</option>
                    <option value="FRONT-END">FRONT-END</option>
                    <option value="BACK-END">BACK-END</option>
                    <option value="WEB">WEB</option>
                </select>

                <input name="name" type="text" id="name" placeholder="search by name">

                <button type="submit" form="form-filter">
                    <i class="fas fa-filter"></i>
                </button>

            </form>
        </div>
    </div>

    <!-- Courses Box Container -->
    <div class="conteiner">

        <?php if($courses == 0) {
        ?>

            <h1>Sorry, we didn't find a course with this filters!</h1>

        <?php
            } 
            else {
            foreach ($courses as $course) {
        ?>

            <!-- Course box -->
            <article class="course">
                <!-- Course header -->
                <div class="course-header">
                    <img id='course-image' src="../public/Courses/images/<?= $course['image'] ?>" width="50px" height="50px" alt="<?= $course['name'] ?>">
   
                    <div class='course-name'><?= $course['name'] ?></div>
                </div>

                <!-- Course content -->
                <div class="course-content">
                    <p>Description: <?= $course['description'] ?></p>
                    <p>Category: <?= $course['category'] ?></p>
                    <p>Value: $ <?= $course['value'] ?></p>

                 </div>
                <a href="../app/Query/User/linkCourse.php?id=<?= $course['id']?>"><div class='purchase'>$ Purchase course</div></a>
            </article>

        <?php
            }
        }
        ?>

    </div>

    <!-- Footer -->
    <footer>
        <!-- Left -->
        <div class="left">
            &copy; 2021 Code School, Inc.
        </div>
        <!-- Right -->
        <div class="right">

            <?php
                if (isset($_SESSION['isAuth'])) {
                    echo "<a href='../app/Query/Auth/logout.php'>Logout</a> |";
                } ?>

            <a href="support.php">Support</a> |
            <a href="contact.php">Contact</a> |
            <a href="about.php">About</a>
        </div>
    </footer>

</body>

</html>