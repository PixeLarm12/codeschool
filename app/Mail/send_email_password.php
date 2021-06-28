<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
include_once('../Database/db.php');

$email = $_POST['email'];

unset($_SESSION['ERROR']);
unset($_SESSION['OLD_DATA']);

$_SESSION['OLD_DATA']['email'] = $email;

//EMAIL
if (empty($email)) {
    $_SESSION['ERROR'] = [
        'email' => 'The <b>E-mail</b> field is required.'
    ];

    header("Location: ../../views/forgot_password.php");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['ERROR'] = [
        'email' => 'The <b>E-mail</b> field must have a valid e-mail.'
    ];

    header("Location: ../../views/forgot_password.php");
    exit;
}

    $statement = $database->prepare("SELECT * FROM users WHERE email=:email");
    $params = [
        ':email' => $email,
    ];

    $statement->execute($params);

    $user = $statement->fetch();

    unset($_SESSION['OLD_DATA']);

    $token = rand(0000, 9999);
    $statement = $database->prepare("UPDATE users SET token = :token WHERE id = :id");
        $params = [
            ':token' => $token,
            ':id' => $user['id'],
        ];

    $statement->execute($params);
    
    $mail = new PHPMailer(true);
    
try {
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = '';                     
    $mail->Password   = '';                              
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        
    $mail->Port       = 587;   

    $mail->setFrom('', 'Code School');
    $mail->addAddress($user['email'], $user['name']);

    $mail->isHTML(true);
    $mail->Subject = 'Recuperacao de Senha - ' . $user['name'];
    $mail->Body = '
    
    <h1>Recuperar senha - Code School</h1>

<p style="font-size: 11px;"> <i>Se voce nao contatou nossos servicos, apenas ignore esse email</i> </p>

Seu token de autenticacao e: <b>' . $token . '</b>

Clique no link abaixo para ser redirecionado para a aba de alteracao de senha e guarde o codigo para autenticacao 

<a href="http://localhost/codeschool/views/change_password.php?token=$token"> Alterar senha </a>

    ';

    $mail->send();

    header("Location: ../../views/change_password.php");
    exit;
} catch (Exception $e) {
    echo "Email could not be sent. Mailer error: {$mail->ErrorInfo}";
}
