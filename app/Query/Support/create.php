<?php
session_start();

include_once('../../Database/db.php');

$problem = $_POST['problem'];
$username = $_POST['username'];
$email = $_POST['email'];
$comments = $_POST['comments'];

$teste = [
    'problem' => $problem,
    'username' => $username,
    'email' => $email,
    'comments' => $comments,
];

unset($_SESSION['ERROR']);

$_SESSION['OLD_DATA']['username'] = $username;
$_SESSION['OLD_DATA']['email'] = $email;
$_SESSION['OLD_DATA']['comments'] = $comments;

//PROBLEM VALIDATION
if (empty($problem)) {
    $_SESSION['ERROR'] = [
        'problem' => 'The <b>Problem</b> field is required.'
    ];
    header("Location: ../../../views/support.php");
    exit;
}


//USERNAME VALIDATION
if (empty($username)) {
    $_SESSION['ERROR'] = [
        'username' => 'The <b>Username</b> field is required.'
    ];
    header("Location: ../../../views/support.php");
    exit;
}

if (strlen($username) < 3 || strlen($username) > 50) {
    $_SESSION['ERROR'] = [
        'username' => 'The <b>Username</b> field must have a min of 3 characters and max of 50 characters.'
    ];

    header("Location: ../../../views/support.php");
    exit;
}


//EMAIL VALIDATION
if (empty($email)) {
    $_SESSION['ERROR'] = [
        'email' => 'The <b>E-mail</b> field is required.'
    ];
    header("Location: ../../../views/support.php");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['ERROR'] = [
        'email' => 'The <b>E-mail</b> field must have a valid e-mail.'
    ];

    header("Location: ../../../views/support.php");
    exit;
}


//COMMENTS VALIDATION
if (empty($comments)) {
    $_SESSION['ERROR'] = [
        'comments' => 'The <b>Comments</b> field is required.'
    ];
    header("Location: ../../../views/support.php");
    exit;
}

if (strlen($comments) < 3 || strlen($comments) > 255) {
    $_SESSION['ERROR'] = [
        'comments' => 'The <b>Comments</b> field must have a min of 3 characters and max of 255 characters.'
    ];

    header("Location: ../../../views/support.php");
    exit;
} else if ($_SESSION['ERROR'] === null) {
    try {
        $statement = $database->prepare("INSERT INTO messages (name, email, problem, comments) VALUES (:name, :email, :problem, :comments)");
        $params = [
            ':name' => $username,
            ':email' => $email,
            ':problem' => $problem,
            ':comments' => $comments,
        ];
        $statement->execute($params);
        unset($_SESSION['OLD_DATA']);
        header("Location: ../../../index.php");
        exit;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

header("Location: ../../../views/support.php");
exit;
