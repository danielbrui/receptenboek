<?php
session_start();
if ($_SESSION['rol'] != "admin") {
    //header('index.php');
    exit;
}
require 'database.php';
include 'header.php';
include 'nav.php';

$id = $_GET['id'];
$stmt->bindParam(':id', $id);
$stmt = $conn->prepare("SELECT * FROM Gebruikers");
$stmt->execute();
$recepten = $stmt->fetchAll();
if (isset($_POST['Opslaan'])) {
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];
    $rol = $_POST['rol'];
    $stmt = $conn->prepare("INSERT INTO Gebruikers (voornaam, achternaam, email, wachtwoord, rol)
VALUES (:voornaam, :achternaam, :email, :wachtwoord, :rol)");
    $stmt->bindParam(':voornaam', $voornaam);
    $stmt->bindParam(':achternaam', $achternaam);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':wachtwoord', $wachtwoord);
    $stmt->bindParam(':rol', $rol);
    $stmt->execute();
}
if (isset($_POST['del'])) {
    $id = $_POST['AlleRecepten'];
    $stmt = $conn->prepare("DELETE FROM Gebruikers WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}
if (isset($_POST['UpdateButton'])) {
    $id = $_POST['AlleRecepten'];
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];
    $rol = $_POST['rol'];

    $stmt = $conn->prepare("UPDATE Gebruikers SET voornaam=:voornaam, achternaam=:achternaam, email=:email, wachtwoord=:wachtwoord, rol=:rol WHERE id=:id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':voornaam', $voornaam);
    $stmt->bindParam(':achternaam', $achternaam);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':wachtwoord', $wachtwoord);
    $stmt->bindParam(':rol', $rol);
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
        <h1>Lijst gebruikers</h1>
        <table class="tabel">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">voornaam</th>
                    <th scope="col">achternaam</th>
                    <th scope="col">email</th>
                    <th scope="col">wachtwoord</th>
                    <th scope="col">rol</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recepten as $recept) : ?>
                    <tr>
                        <td><?php echo $recept["id"] ?></td>
                        <td><?php echo $recept["voornaam"] ?></td>
                        <td><?php echo $recept["achternaam"] ?></td>
                        <td><?php echo $recept["email"] ?></td>
                        <td><?php echo $recept["wachtwoord"] ?></td>
                        <td><?php echo $recept["rol"] ?></td>
                        <?php /*<td><input type="submit" value="Bewerk recept <?php echo $recept['id'] ?>" name="<?php echo $recept['id'] ?>"></td> */ ?>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        </br>
        <h1>Gebruikers bewerken</h1>
        <form id="recepedelete" method="post">
            <label for="voornaam">Selecteer een gebruiker.</label></br>
            <select name="AlleRecepten" id="AlleRecepten">
                <?php foreach ($recepten as $recept) : ?>
                    <option value="<?= $recept['id'] ?>"><?= $recept['voornaam'] ?></option>
                <?php endforeach ?>
            </select>
            <input type="submit" value="Verwijder" name="del"></br></br>
        </form>
        <form id="formReceptOpslaan" method="post">
            <h3 class="h3">Gebruikers toevoegen</h3></br>
            <label for="voornaam">voornaam</label></br>
            <input type="text" name="voornaam" id="voornaam"></br>
            <label for="voornaam">achternaam</label></br>
            <input type="text" name="achternaam" id="achternaam"></br>
            <label for="voornaam">email</label></br>
            <input type="text" name="email" id="email"></br>
            <label for="voornaam">wachtwoord</label></br>
            <input type="text" name="wachtwoord" id="wachtwoord"></br>
            <label for="voornaam">rol</label></br>
            <input type="text" name="rol" id="rol"></br></br>
            <input type="submit" name="Opslaan" value="Opslaan als nieuwe gebruiker"></br></br>
            <input type="submit" name="UpdateButton" value="Bewerk bestaande gebruiker">
            <select name="AlleRecepten" id="AlleRecepten">
                <?php foreach ($recepten as $recept) : ?>
                    <option value="<?= $recept['id'] ?>"><?= $recept['voornaam'] ?></option>
                <?php endforeach ?>
            </select>


        </form>
    </div>
</body>

</html>
<?php include 'footer.php'; ?>