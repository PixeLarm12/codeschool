<?php

session_start();

include_once('../../Database/db.php');

$email = $_POST['email'];
$password = $_POST['password'];

unset($_SESSION['ERROR']);
unset($_SESSION['OLD_DATA']);

$_SESSION['OLD_DATA']['email'] = $email;

//EMAIL
if (empty($email)) {
    $_SESSION['ERROR'] = [
        'email' => 'The <b>E-mail</b> field is required.'
    ];

    header("Location: ../../../views/login.php");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['ERROR'] = [
        'email' => 'The <b>E-mail</b> field must have a valid e-mail.'
    ];

    header("Location: ../../../views/login.php");
    exit;
}

//PASSWORD
if (empty($password)) {
    $_SESSION['ERROR'] = [
        'password' => 'The <b>Password</b> field is required.'
    ];

    header("Location: ../../../views/login.php");
    exit;
}

if (strlen($password) < 8 || strlen($password) > 50) {
    $_SESSION['ERROR'] = [
        'password' => 'The <b>Password</b> field must have a min of 8 characters and max of 50 characters.'
    ];

    header("Location: ../../../views/login.php");
    exit;
}

try {
    $statement = $database->prepare("SELECT * FROM users WHERE email = :email");
    $params = [
        ':email' => $email,
    ];

    if ($email === 'adm@adm.com.br' && $password === 'qwe123QWE') {
        $_SESSION['username'] = 'Administrator';
        $_SESSION['isAuth'] = true;
        $_SESSION['isAdm'] = true;

        header("Location: ../../../views/Admin/list.php");
        exit;
    }

    $statement->execute($params);

    if($statement->rowCount() == 1){
        $user = $statement->fetch();

        if(md5($password) === $user['password']){

            $_SESSION['username'] = $user['name'];
            $_SESSION['userEmail'] = $email;
            $_SESSION['isAuth'] = true;
            $_SESSION['isAdm'] = false;
            unset($_SESSION['OLD_DATA']);
            
            header("Location: ../../../views/home.php");
            exit;
        }
        else{
            $_SESSION['ERROR'] = [
                'email' => "<b>E-mail</b> or <b>Password</b> doesn't match!"
            ];
        
            header("Location: ../../../views/login.php");
            exit;
        }       
    }
    else {
        $_SESSION['ERROR'] = [
            'email' => "User not found!"
        ];
    
        header("Location: ../../../views/login.php");
        exit;
    }
    
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
