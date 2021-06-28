<?php
session_start();

include_once('../../Database/db.php');

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirmPassword = $_POST["confirmPassword"];
$role = 'student';

unset($_SESSION['ERROR']);
$_SESSION['OLD_DATA']['name'] = $name;
$_SESSION['OLD_DATA']['email'] = $email;


//NAME VALIDATIONS
if (empty($name)) {
    $_SESSION['ERROR'] = [
        'name' => 'The <b>Full name</b> field is required.'
    ];

    header("Location: ../../../views/register.php");
    exit;
}

if (strlen($name) < 3 || strlen($name) > 50) {
    $_SESSION['ERROR'] = [
        'name' => 'The <b>Full name</b> field must have a min of 3 characters and max of 50 characters.'
    ];

    header("Location: ../../../views/register.php");
    exit;
}


//EMAIL VALIDATIONS
if (empty($email)) {
    $_SESSION['ERROR'] = [
        'email' => 'The <b>E-mail</b> field is required.'
    ];

    header("Location: ../../../views/register.php");
    exit;
}

// $statement = $database->query("SELECT email FROM users");
$users = $database->query("SELECT email FROM users")->fetchAll();
// $users = $statement->fetch();

foreach ($users as $user) {
    if ($email === $user['email']) {
        $_SESSION['ERROR'] = [
            'email' => 'The <b>E-mail</b> already exists.'
        ];

        header("Location: ../../../views/register.php");
        exit;
    }
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['ERROR'] = [
        'email' => 'The <b>E-mail</b> field must have a valid e-mail.'
    ];

    header("Location: ../../../views/register.php");
    exit;
}

$users = $database->query("SELECT * FROM users")->fetchAll();
foreach($users as $user){
    if($user['email'] === $email){
        $_SESSION['ERROR'] = [
            'email' => 'The <b>E-mail</b> is already registered!'
        ];
    
        header("Location: ../../../views/register.php");
        exit;
    }
}


//PASSWORD VALIDATIONS
if (empty($password)) {
    $_SESSION['ERROR'] = [
        'password' => 'The <b>Password</b> field is required.'
    ];

    header("Location: ../../../views/register.php");
    exit;
}

if (strlen($password) < 8 || strlen($password) > 50) {
    $_SESSION['ERROR'] = [
        'password' => 'The <b>Password</b> field must have a min of 8 characters and max of 50 characters.'
    ];

    header("Location: ../../../views/register.php");
    exit;
}


//CONFIRM PASSWORD VALIDATIONS
if (empty($confirmPassword)) {
    $_SESSION['ERROR'] = [
        'confirmPassword' => 'The <b>Confirm password</b> field is required.'
    ];

    header("Location: ../../../views/register.php");
    exit;
}

if ($confirmPassword !== $password) {
    $_SESSION['ERROR'] = [
        'confirmPassword' => "The <b>Confirm password</b> field doesn't match with Password field."
    ];

    header("Location: ../../../views/register.php");
    exit;
} else if ($_SESSION['ERROR'] === null) {
    try {
        $statement = $database->prepare("INSERT INTO users (name, email, password, role, image) VALUES (:name, :email, :password, :role, :image)");
        $params = [
            ':name' => $name,
            ':email' => $email,
            ':password' => md5($password),
            ':role' => $role,
            ':image' => 'null.png',
        ];
        $statement->execute($params);

        $_SESSION['username'] = $name;
        $_SESSION['userEmail'] = $email;
        $_SESSION['isAuth'] = true;
        $_SESSION['isAdm'] = false;
        unset($_SESSION['OLD_DATA']);

        header("Location: ../../../views/home.php");
        exit;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

header("Location: ../../../views/register.php");
exit;
