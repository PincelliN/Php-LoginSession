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

if ($user) {
    //throw lancia un eccezione e gestisce l'errore
    throw new Exception('L \' email inserit\à esiste gi\à');
}
if ($password != $passwordConfirm) {
    throw new Exception('Le password non corrispondono');
}

//rendiamo robusto l'hash
//generiamo un id unico (uniqid()) calcoliamo l'hash (md5) che generera una stringa di 32 caratteri e successivamente prenderemo una sottostringa che iniziera dal carattere in posizone 10 e avra una lenght di 10
$salt = substr(md5(uniqid()), 10, 10);
//sha1 genera un l' hash  di 40 caratteri al posto dei 32 di (md5)
$token = sha1(uniqid());
//PASSWORD_BCRYPT è un algoritmo di hashing  per la criptografia delle password che è volutamente lento e costoso computazionalmente 
$password = password_hash(PEPPER . $password . $salt, PASSWORD_BCRYPT);

//inseriamo il nuovo utente nel db

$sqlUser = 'INSERT INTO user(name,email,password,salt,token)VALUE(:name,:email,:password,:salt,:token)';
$query = $db->prepare($sqlUser);
$query->bindParam(':name', $name);
$query->bindParam(':email', $email);
$query->bindParam(':password', $password);
$query->bindParam(':salt', $salt);
$query->bindParam(':token', $token);
$query->execute();

//invio l'email con il link per raggiungere la pagina diattivazione
header('Location:../view/activate.php?token=' . $toke);