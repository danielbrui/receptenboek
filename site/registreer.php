<?php
require 'database.php';

$stmt = $conn->prepare("SELECT * FROM Gebruikers");
$stmt->execute();

$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$myGuests = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Registreren</h1>
    <form id="FormRegister" method="post">
        <label for="voornaam">Voornaam</label></br>
        <input type="text" name="voornaam" id="voornaam"></br>
        <label for="achternaam">Achternaam</label></br>
        <input type="text" name="achternaam" id="achternaam"></br>
        <label for="email">Email</label></br>
        <input type="email" name="email" id="email"></br>
        <label for="wachtwoord">Wachtwoord</label></br>
        <input type="password" name="wachtwoord" id="wachtwoord"></br>
        <input type="submit" value="Registreer">
    </form>
</body>

</html>