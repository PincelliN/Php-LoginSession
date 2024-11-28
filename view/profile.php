<?php
require_once '../config.php';

$id_user = $_SESSION['id_user'];

//recuperiamo i dati del utente

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
    <link rel="stylesheet" href="./style/profile.css">
    <title>Modifica profilo</title>
</head>

<body>

    <div class="profile-container">
        <h2>Modifica Profilo</h2>

        <?php if (isset($_GET['error'])) { ?>
            <div class="error">
                <?php if ($_GET['error'] == 'email_exists') { ?>
                    L'email inserita già esistente
                <?php } ?>

                <?php if ($_GET['error'] == 'invalid_current_password') { ?>
                    La password attuale non è corretta
                <?php } ?>

                <?php if ($_GET['error'] == 'password_mismatch') { ?>
                    Le password sono diverse
                <?php } ?>
            </div>
        <?php } ?>
        <form action="../controller/profile.php" method="post">
            <div class="form-input">
                <label for="name">Nome </label>
                <input type="text" id="name" name="name" value="<?php echo $user->name; ?>" autocomplete="off">
            </div>
            <div class="form-input">
                <label for="email">Email</label>
                <input type="email" id="email" name='email' value='<?php echo $user->email; ?>' autocomplete="off">
            </div>
            <div class="password-section">
                <div class="form-input">
                    <label for="password">Password Attuale</label>
                    <input type="password" name="current_password" required>
                </div>
                <div class="form-input">
                    <label for="confirm-password">Nuova Password</label>
                    <input type="password" name="new_password" required>
                </div>
                <div class="form-input">
                    <label for="confirm-password">Conferma Password</label>
                    <input type="password" name="confirm_new_password" required>
                </div>
            </div>
            <button type="submit" class="update-button">Aggiorna Profilo</button>

        </form>
    </div>


</body>

</html>