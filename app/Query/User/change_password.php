<?php

session_start();
include_once('../../Database/db.php');

$email = $_POST["email"];
$password = $_POST["password"];
$confirmPassword = $_POST["confirmPassword"];
$token = $_POST["token"];

unset($_SESSION['ERROR']);
$_SESSION['OLD_DATA']['token'] = $token;
$_SESSION['OLD_DATA']['email'] = $email;


//EMAIL VALIDATIONS
if (empty($email)) {
    $_SESSION['ERROR'] = [
        'email' => 'The <b>E-mail</b> field is required.'
    ];

    header("Location: ../../../views/change_password.php");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['ERROR'] = [
        'email' => 'The <b>E-mail</b> field must have a valid e-mail.'
    ];

    header("Location: ../../../views/change_password.php");
    exit;
}


//PASSWORD VALIDATIONS
if (empty($password)) {
    $_SESSION['ERROR'] = [
        'password' => 'The <b>Password</b> field is required.'
    ];

    header("Location: ../../../views/change_password.php");
    exit;
}

if (strlen($password) < 8 || strlen($password) > 50) {
    $_SESSION['ERROR'] = [
        'password' => 'The <b>Password</b> field must have a min of 8 characters and max of 50 characters.'
    ];

    header("Location: ../../../views/change_password.php");
    exit;
}


//CONFIRM PASSWORD VALIDATIONS
if (empty($confirmPassword)) {
    $_SESSION['ERROR'] = [
        'confirmPassword' => 'The <b>Confirm password</b> field is required.'
    ];

    header("Location: ../../../views/change_password.php");
    exit;
}

if ($confirmPassword !== $password) {
    $_SESSION['ERROR'] = [
        'confirmPassword' => "The <b>Confirm password</b> field doesn't match with Password field."
    ];

    header("Location: ../../../views/change_password.php");
    exit;
} 


    try {
        $statement = $database->prepare("SELECT * FROM users WHERE email=:email");
        $params = [
            ':email' => $email,
        ];
    
        $statement->execute($params);
    
        $user = $statement->fetch();

        if(!$user){
            $_SESSION['ERROR'] = [
                'email' => 'The <b>Email</b> does not match.'
            ];

            header("Location: ../../../views/change_password.php");
            exit; 
        }

        if($email === $user['email'] && $token === $user['token']) {
            $statement = $database->prepare("UPDATE users SET password = :password, token = :token WHERE email = :email");
            $params = [
                ':password' => password_hash($password, PASSWORD_DEFAULT),
                ':token' => null,
                ':email' => $email,
            ];
            $statement->execute($params);

            $_SESSION['username'] = $user['name'];
            $_SESSION['isAuth'] = true;
            $_SESSION['isAdm'] = false;
            unset($_SESSION['OLD_DATA']);

            header("Location: ../../../views/home.php");
            exit;
        } else {
            $_SESSION['ERROR'] = [
                'email' => 'The <b>Email</b> or <b>Token</b> does not match.'
            ];
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

header("Location: ../../../views/change_password.php");
exit;
