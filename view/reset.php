<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/reset.css">
    <title>Reimposta Password</title>
</head>

<body>
    <div class="reset-container">
        <h2>Reimposta Password</h2>

        <?php if (isset($_GET['error'])) { ?>
            <div class="error">
                <?php if ($_GET['error'] == 'password_mismatch') { ?>
                    Le password inserite non coincidono
                <?php } ?>

                <?php if ($_GET['error'] == 'invalid_token') { ?>
                    La richiesta è scaduta
                <?php } ?>
            </div>
        <?php } ?>

        <form action="../controller/reset.php" method="POST">
            <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
            <div class="form-group">
                <label>Nuova Password</label>
                <input type="password" name="new_password" required>
            </div>
            <div class="form-group">
                <label>Conferma Nuova Password</label>
                <input type="password" name="confirm_password" required>
            </div>
            <button type="submit">Reimposta Password</button>
        </form>
    </div>

</body>

</html>