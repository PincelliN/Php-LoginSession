<?php

require_once '../config.php';

//recuperiamo i dati

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$passwordConfirm = $_POST['confirm-password'];

//controlliamo se l'email esiste già nel nostro database
//:email rappresenta una variabile a cui verra associato un valore effettivo
$sqlEmail = 'SELECT * FROM user WHERE email = :email ';
//la query viene preparata sal db a ricevere le variabili bind(:email)
$query = $db->prepare($sqlEmail);
// associamo al segnaposto :email il valore relativo
$query->bindParam(':email', $email);
//eseguiamo la query una volta che i parametri sono stati associati
$query->execute();


//fetch metodo che recupera il primo risultato della query eseguita
//PDO::FETCH_OBJ specifica che il risultato sarà un oggetto che utilizzera i nomi delle colonne propietà del oggetto restituito  
$user = $query->fetch(PDO::FETCH_OBJ);