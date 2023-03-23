<?php
require 'database.php';
include 'nav.php';

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

</body>

</html>