<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/activate.css">
    <title>Simulazione della ricezzione dell'email di attivazione</title>
</head>

<body>
    <div class="container">
        <h1>Benvenuto!</h1>
        <p>Grazie di esserti registrato.Completa la registrazione cliccando su questo link:</p>
        <button>
            <a href="../controller/activate.php?token=<?php echo $_GET['token']; ?>">Attiva Account</a>
        </button>
        <p>Se il bottone non funziona, copia e incolla questo link nel tuo Browser:</p>
        <p>Qui ci va il link di attivazione</p>
        <p>Se non hai richiesto questa registrazine, ingnora questa email.</p>
    </div>
</body>

</html>