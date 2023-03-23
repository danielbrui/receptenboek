<?php
require 'database.php';
include 'nav.php';


$stmt = $conn->prepare("SELECT * FROM Gebruikers");
$stmt->execute();

$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$myGuests = $stmt->fetchAll();

if (isset($_POST['voornaam'])) {
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];

    // prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO Gebruikers (voornaam, achternaam, email, wachtwoord)
  VALUES (:voornaam, :achternaam, :email, :wachtwoord)");
    $stmt->bindParam(':voornaam', $voornaam);
    $stmt->bindParam(':achternaam', $achternaam);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':wachtwoord', $wachtwoord);

    // insert a row
    $stmt->execute();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<div class="vak">
    <h1>Registreren</h1>
    <form id="FormRegister" method="post">
        <label for="voornaam">Voornaam</label></br>
        <input type="text" name="voornaam" id="voornaam"></br>
        <label for="achternaam">Achternaam</label></br>
        <input type="text" name="achternaam" id="achternaam"></br>
        <label for="email">Email</label></br>
        <input type="email" name="email" id="email"></br>
        <label for="wachtwoord">Wachtwoord</label></br>
        <input type="password" name="wachtwoord" id="wachtwoord"></br></br>
        <input type="submit" value="Registreer">
</div>
    </form>

</body>

</html>