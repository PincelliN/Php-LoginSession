<?php

require_once '../config.php';

$id_user = $_SESSION['id_user'];

//dati utente loggato

$sql = 'SELECT * FROM user WHERE id_user=:id_user';
$query = $db->prepare($sql);
$query->bindParam(':id_user', $id_user);
$query->execute();

$user = $query->fetch(PDO::FETCH_OBJ);


$name = $_POST['name'];
$email = $_POST['email'];

//controlliamo se l'email è già utilizzata da un altro utente

$sql = 'SELECT * FROM user WHERE email = :email AND id_user<>:id_user';
$query = $db->prepare($sql);
$query->bindParam(':email', $email);
$query->bindParam(':id_user', $id_user);
$query->execute();

$userEmailExist = $query->fetch(PDO::FETCH_OBJ);

if ($userEmailExist) {
    header('Location: ../view/profile.php? error=email_exists');
    die;
}

$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];
$confirm_new_password = $_POST['confirm_new_password'];

//controlliamo se la password è corretta

if (!password_verify(PEPPER . $current_password . $user->salt, $user->password)) {
    header('Location: ../view/profile.php? error=invalid_current_password');
    die;
}
//controliamo se le nuove password coincidono
if ($new_password !== $confirm_new_password) {
    header('Location: ../view/profile.php? error=password_mismatch ');
    die;
}

//nuovo salt e nuovo hash
$new_salt = substr(md5(uniqid()), 10, 10);
$new_hadhed_password = password_hash(PEPPER . $new_passsword . $new_salt, PASSWORD_BCRYPT);

// aggiorniamo i dati dell'utente
$sql = 'UPDATE user SET name = :name, email = :email, password = :password, salt = :salt WHERE id_user = :id_user';
$query = $db->prepare($sql);
$query->bindParam(':name', $name);
$query->bindParam(':email', $email);
$query->bindParam(':password', $new_hashed_password);
$query->bindParam(':salt', $new_salt);
$query->bindParam(':id_user', $id_user);
$query->execute();

// redirect alla home
header('Location: ../view/home.php');
die;
