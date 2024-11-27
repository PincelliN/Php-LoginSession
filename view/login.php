<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/login.css">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <h1>Login</h1>
        <?php if (isset($_GET['error'])) { ?>
        <div class="error">
            <?php if ($_GET['error'] == 'invalid_user') { ?>
            <p>Verifica il tuo indirizzo email</p>
            <?php } ?>
            <?php if ($_GET['error'] == 'wrong_credential') { ?>
            <p>Le credenziali non sono valide</p>
            <?php } ?>
            <?php } ?>
            <form action="../controller/login.php" method="post">
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
                <a href="" class="forgot-password">Password dimenticata?</a>
                <button type="submit" class="login-button">accedi</button>
            </form>
            <div class="register-link">
                Non hai un account? <a href="../view/index.php">Registrati</a>
            </div>
        </div>



    </div>
</body>

</html>