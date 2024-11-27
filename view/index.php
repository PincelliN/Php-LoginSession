<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/index.css">
    <title>Registrazione</title>
</head>

<body>
    <div class="register-container">
        <h1>Registrazione</h1>
        <form action="../controller/register.php" method="post">
            <div class="form-input">
                <label for="name">Nome </label>
                <input type="text" id="name" name="name" placeholder="Nome" autocomplete="off">
            </div>
            <div class="form-input">
                <label for="email">Email</label>
                <input type="email" id="email" name='email' placeholder="Inserisci la tua Email" autocomplete="off">
            </div>
            <div class="form-input">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password">
            </div>
            <div class="form-input">
                <label for="confirm-password">Conferma Password</label>
                <input type="password" id="confirm-password" name="confirm-password">
            </div>
            <button type="submit" class="register-button">Registrati</button>
        </form>
        <div class="login-link">
            <p>Hai già un account ? <a href="../view/login.php">Accedi</a></p>
        </div>
    </div>
</body>

</html>