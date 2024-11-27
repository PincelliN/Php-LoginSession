<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/welcome.css">
    <title>Accont Attivato</title>
</head>

<body>
    <div class="container">
        <div class="success-icon">✓</div>
        <h1>Account Attivato con Successo!</h1>
        <p>Grazie per aver confermato il tuo indirizzo email.</p>
        <p>Tra <span>5</span> secondi sarai reindirizzato nella piattaforma</p>

    </div>

    <script>
    let second = 5;
    let time = document.querySelector('span');

    const countDown = setInterval(() => {
        second--;
        if (second == 0) {
            clearInterval(countDown);
            location.href = '../view/home.php';
        }
        time.innerHTML = second;
    }, 1000);
    </script>
</body>

</html>