<?php

require_once '../config.php';

$token = $_POST['token'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];

//confrontiamo la password inserità

if ($new_password !== $confirm_password) {
    header('Location: ../view/reset.php?error=password_mismatch&token=' . $token);
    die;
}

// controlliamo la validità del token
$sql = 'SELECT * FROM user WHERE token = :token AND expire > NOW()';
$query = $db->prepare($sql);
$query->bindParam(':token', $token);
$query->execute();
$user = $query->fetch(PDO::FETCH_OBJ);

if (!$user) {
    header('Location: ../view/reset.php?error=invalid_token&token=' . $token);
    die;
}

// generiamo il nuovo hash
$salt = substr(md5(uniqid()), 10, 10);
$password = password_hash(PEPPER . $new_password . $salt, PASSWORD_BCRYPT);

// aggiorniamo i dati nel db
$sql = 'UPDATE user SET password = :password, salt = :salt, token = NULL, expire = NULL WHERE id_user = :id_user';
$query = $db->prepare($sql);
$query->bindParam(':password', $password);
$query->bindParam(':salt', $salt);
$query->bindParam(':id_user', $user->id_user);
$query->execute();

// redirect alla pagina di login o alla pagina di successo per avvenuta procedura
header('Location: ../view/login.php');
die;
