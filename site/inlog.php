<?php
require 'database.php';
session_start();
include 'header.php';
include 'nav.php';



if (isset($_POST['email']) && !empty($_POST['email'])) {
    $email = $_POST['email'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Fout email formaat.";
        //exit;
    }

    $stmt = $conn->prepare("SELECT email, wachtwoord, rol FROM Gebruikers WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    //$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (is_array($user) && count($user) > 0) {

        if (isset($_POST['wachtwoord']) && !empty($_POST['wachtwoord'])) {
            $wachtwoord = $_POST['wachtwoord'];

            if ($user['wachtwoord'] == $wachtwoord) {
                echo "Je bent ingelogd als ";
                //code om de pagina te laden
                $_SESSION = $user;
                $_SESSION['email'] = $email;
                if ($user['rol'] == 'admin') {
                    echo "administrator.";
                    $_SESSION["rol"] = "admin";
                } else {
                    echo "klant.";
                }
            } else {
                echo "Uw wachtwoord is verkeerd.";
                exit;
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receptenboek | Inloggen</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="divclass1">
        <h1>Inloggen</h1>
        <form id="formLogin" method="post">
            <label for="email">Email</label></br>
            <input type="email" name="email" id="email"></br>
            <label for="wachtwoord">Wachtwoord</label></br>
            <input type="password" name="wachtwoord" id="wachtwoord"></br></br>
            <input type="submit" value="Inloggen">
        </form>
    </div>

</body>

</html>
<?php include 'footer.php'; ?>