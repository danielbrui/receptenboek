<?php
require 'database.php';
include 'nav.php';


$stmt = $conn->prepare("SELECT * FROM Recepten");
$stmt->execute();

$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$myGuests = $stmt->fetchAll();

if (isset($_POST['titel'])) {
    $voornaam = $_POST['titel'];

    $stmt = $conn->prepare("INSERT INTO Recepten (titel)
  VALUES (:titel)");
    $stmt->bindParam(':titel', $titel);

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
    <div class="divclass1">
        <h1>Recepten Opslaan</h1>
        <form id="formReceptOpslaan" method="post">
            <label for="titel">Titel</label></br>
            <input type="text" name="titel" id="titel"></br></br>
            <input type="submit" value="Opslaan">
    </div>
    </form>

</body>

</html>