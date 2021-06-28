<?php
session_start();

unset($_SESSION['isAuth']);

header("Location: ../../../index.php");
exit;
