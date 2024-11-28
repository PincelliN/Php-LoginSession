<?php
require_once '../config.php';
/* 
da fare in tutte le pagine protette da login
leggere l'id utente dalla sessione
cercare l'utente nel db
se non esiste, redirect alla pagina di login
*/

$id_user = $_SESSION['id_user'];

$sql = 'SELECT * FROM user WHERE id_user = :id_user';
$query = $db->prepare($sql);
$query->bindParam(':id_user', $id_user);
$query->execute();

$user = $query->fetch(PDO::FETCH_OBJ);

if (!$user) {
    header('Location: ../view/login.php');
    die;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/home.css">
    <title>Benvenuto</title>
</head>

<body>
    <div class="container">
        <h1>Benvenuto
            <!-- <?php echo $user->name; ?> -->
        </h1>
        <a class="button profile" href="">Modifica il profilo</a>
        <a class="button logout" href="../controller/logout.php">Logout</a>
    </div>

</body>

</html>