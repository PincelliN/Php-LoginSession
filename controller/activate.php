<?php

require_once '../config.php';

//leggiamo il Token dal Url
$token = $_GET['token'];

//cerchiamo l'utente in base al token
$sql = 'SELECT * FROM user WHERE token = :token';
$query = $db->prepare($sql);
$query->bindParam(':token', $token);
$query->execute();

$user = $query->fetch(PDO::FETCH_OBJ);

//se user non esiste genero i messaggio
if (!$user) {
    throw new Exception('Utente non trovato');
}
//se user esiste setto active a 1 e cancello il token di attivazione
$sql = 'UPDATE user SET active=1,token=NULL WHERE token = :token';
$query = $db->prepare($sql);
$query->bindParam(':token', $token);
$query->execute();

//creiamo una sessione con l'id utente
$_SESSION['id_user'] = $user->id_user;

//redirect nella pagina home
header('Location:../view/welcome.php');