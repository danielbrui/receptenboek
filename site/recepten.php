<?php
require 'database.php';
include 'nav.php';

$stmt = $conn->prepare("SELECT * FROM Recepten");
$stmt->execute();

//$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
//$myGuests = $stmt->fetchAll();

$recepten = $stmt->fetchAll();

/*if (isset($_POST['voornaam'])) {
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
}*/






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
    <h1>test</h1>
    <?php foreach ($recepten as $recept) : ?>
        <div class="divclass2">
            <?php echo $recept['titel'] ?></br>
            <img src="images/<?php echo $recept['afbeelding'] ?>" style="width: 10%"></img></a></br>
        </div>
    <?php endforeach ?>
</body>

</html>