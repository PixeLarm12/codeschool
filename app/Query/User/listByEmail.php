<?php
include_once('db.php');

$email = "'" . $_SESSION['userEmail'] . "'";

return $database->query("SELECT id, name, email, image FROM users WHERE email = $email")->fetch();