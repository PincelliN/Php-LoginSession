<?php

require_once '../config.php';

$email = $_POST['email'];
$password = $_POST['password'];

//cerchiamo l'email nel db

$sql = 'SELECT * FROM user WHERE email = :email';
$query = $db->prepare($sql);
$query->bindParam(':email', $email);
$query->execute();

$user = $query->fetch(PDO::FETCH_OBJ);

//se l'account non è attivo gestiamo l'errore 
if ($user && $user->active == 0) {
    header('Location: ../view/login.php? error=invalid_user');
    die;
}
/*  verifichiamo se l'hash presente nel db è stato creato con
    la password che abbiamo ricevuto dal form di login
    se c'è corrispondenza, creaiamo una sessione con l'id dell'utente
    e redirecto alla pagina Home */


if (password_verify(PEPPER . $password . $user->salt, $user->password)) {
    $_SESSION['id_user'] = $user->id_user;
    header('Location: ../view/home.php');
    die;
}

header('Location: ../view/login.php?error=wrong_credential');
die;
