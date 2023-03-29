<?php
require 'database.php';
include 'header.php';
include 'nav.php';


$stmt = $conn->prepare("SELECT * FROM Recepten");
$stmt->execute();

$recepten = $stmt->fetchAll();


//voeg rollen toe aan database.


if (isset($_POST['titel'])) {
    $titel = $_POST['titel'];
    $afbeelding = $_POST['afbeelding'];
    $duur = $_POST['duur'];
    $menugang = $_POST['menugang'];
    $moeilijkheidsgraad = $_POST['moeilijkheidsgraad'];
    $aantal_ingredienten = $_POST['aantal_ingredienten'];

    $stmt = $conn->prepare("INSERT INTO Recepten (titel, afbeelding, duur, menugang, moeilijkheidsgraad, aantal_ingredienten)
  VALUES (:titel, :afbeelding, :duur, :menugang, :moeilijkheidsgraad, :aantal_ingredienten)");
    $stmt->bindParam(':titel', $titel);
    $stmt->bindParam(':afbeelding', $afbeelding);
    $stmt->bindParam(':duur', $duur);
    $stmt->bindParam(':menugang', $menugang);
    $stmt->bindParam(':moeilijkheidsgraad', $moeilijkheidsgraad);
    $stmt->bindParam(':aantal_ingredienten', $aantal_ingredienten);


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
        <h1>Lijst Recepten</h1>
        <table class="tabel">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">titel</th>
                    <th scope="col">afbeelding</th>
                    <th scope="col">duur</th>
                    <th scope="col">menugang</th>
                    <th scope="col">moeilijkheidsgraad</th>
                    <th scope="col">aantal ingredienten</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recepten as $recept) : ?>
                    <tr>
                        <td><?php echo $recept["id"] ?></td>
                        <td><?php echo $recept["titel"] ?></td>
                        <td><?php echo $recept["afbeelding"] ?></td>
                        <td><?php echo $recept["duur"] ?></td>
                        <td><?php echo $recept["menugang"] ?></td>
                        <td><?php echo $recept["moeilijkheidsgraad"] ?></td>
                        <td><?php echo $recept["aantal_ingredienten"] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        </br>


        <h1>Recepten Opslaan</h1>

        <label for="titel">Selecteer een recept.</label></br>
        <select name="AlleRecepten" id="AlleRecepten">
            <?php foreach ($recepten as $recept) : ?>
                <option value="<?= $recept['id'] ?>"><?= $recept['titel'] ?></option>
            <?php endforeach ?>
        </select>
            <input type="submit" value="Select">

            <input type="submit" value="Verwijder recept"></br></br>

            <form id="formReceptOpslaan" method="post">
                <h3 class="h3">Bewerk gegevens</h3></br>
                <label for="titel">Titel</label></br>
                <input type="text" name="titel" id="titel"></br>
                <label for="titel">Afbeelding</label></br>
                <input type="text" name="afbeelding" id="afbeelding"></br>
                <label for="titel">Duur</label></br>
                <input type="text" name="duur" id="duur"></br>
                <label for="titel">Menugang</label></br>
                <input type="text" name="menugang" id="menugang"></br>
                <label for="titel">Moeilijkheidsgraad</label></br>
                <input type="text" name="moeilijkheidsgraad" id="moeilijkheidsgraad"></br>
                <label for="titel">Aantal Ingredienten</label></br>
                <input type="text" name="aantal_ingredienten" id="aantal_ingredienten"></br></br>
                <input type="submit" value="Opslaan">
    </div>
    </form>

</body>

</html>
<?php include 'footer.php'; ?>