<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/forgot.css">
    <title>Password Dimenticata</title>
</head>

<body>

    <div class="forgot-container">
        <h2>Password Dimenticata </h2>
        <?php if (isset($_GET['error'])) { ?>
            <div class="error">
                <?php if ($_GET['error'] == 'email_not_found') { ?>
                    L'email inserita non è stata trovata
                <?php } ?>
            </div>
        <?php } ?>

        <form action="../controller/forgot.php" method="post">
            <div class="form-input">
                <label for="email">Email</label>
                <input type="email" name='email' id='email' placeholder="Email" autocomplete="off">
            </div>
            <button type="submit">Reimposta Password</button>
        </form>
    </div>
</body>

</html>