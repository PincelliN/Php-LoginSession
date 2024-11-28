<?php

require_once '../config.php';

$email = $_POST['email'];

//dati utente

$sql = 'SELECT * FROM user WHERE email=:email';
$query = $db->prepare($sql);
$query->bindParam(':email', $email);
$query->execute();
$user = $query->fetch(PDO::FETCH_OBJ);

if (!$user) {
    header('Location: ../view/forgot.php? error=email_not_found');
    die;
}

//generiamo il token per il reset
/*
random_bytes(32): Questa parte del codice genera una sequenza di 32 byte casuali 
bin2hex(): un byte diventa una stringa di due caratteri esadecimali.  byte quindi ottenendo una stringa di 64 caratteri esadecimali. 
 */

$token = bin2hex(random_bytes(32));

//salviamo il token e impostiamo un timer per la disponibilità

$sql =
    'UPDATE user SET token=:token,  expire = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE id_user = :id_user';
$query = $db->prepare($sql);
$query->bindParam(':token', $token);
$query->bindParam(':id_user', $user->id_user);
$query->execute();

// inviamo l'email con il link per raggiungere la pagina di reset password (in questo caso simuliamo l'invio)
header('Location: ../view/reset.php?token=' . $token);
