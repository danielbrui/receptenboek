<?php
session_start();
if ($_SESSION['rol'] != "admin") {
    //header('index.php');
    exit;
}
require 'database.php';
include 'header.php';
include 'nav.php';
error_reporting(0);

$id = $_GET['id'];
$stmt->bindParam(':id', $id);

$stmt = $conn->prepare("SELECT * FROM Recepten");
$stmt->execute();
$recepten = $stmt->fetchAll();

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

/*if (isset($_POST['Toon'])) {
    $id = $_POST['AlleRecepten'];
    $stmt = $conn->prepare("SELECT  FROM Recepten ORDER BY id ASC WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}*/

if (isset($_POST['UpdateButton'])) {
    $id = $_POST['AlleRecepten'];
    var_dump($id);
    var_dump($titel);
    $stmt = $conn->prepare("UPDATE Recepten SET titel=:titel, afbeelding=:afbeelding, duur=:duur, menugang=:menugang, moeilijkheidsgraad=:moeilijkheidsgraad, aantal_ingredienten=:aantal_ingredienten WHERE id=:id");
    $stmt->bindParam(':id', $id);
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
        </table></br>
        <form id="formReceptOpslaan" method="post">
            <label for="titel">Sorteer bij:</label></br>
            <input type="submit" value="welk gerecht het langst duurt om te maken" name="Toon">
            <input type="submit" value="welk gerecht het makkelijkst is om te maken" name="Toon3">
            <input type="submit" value="welk gerecht de meeste ingrediënten heeft" name="Toon2">
        </form>
<?php
$sql = "SELECT * FROM Recepten ORDER BY duur DESC LIMIT 1";
$result = $conn->query($sql);

if (isset($_POST['Toon'])) {
if ($result->rowCount() > 0) {  
    echo "<table>";
    echo "<tr><th>id</th><th>titel</th><th>afbeelding</th></th><th>duur</th><th>menugang</th><th>Moeilijkheidsgraad</th><th>aantal ingredienten</th>"; 
    foreach($result as $row) {
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['titel']."</td>";
        echo "<td>".$row['afbeelding']."</td>";
        echo "<td>".$row['duur']."</td>";
        echo "<td>".$row['menugang']."</td>";
        echo "<td>".$row['moeilijkheidsgraad']."</td>";
        echo "<td>".$row['aantal_ingredienten']."</td>";
        echo "</tr>";
    }
    echo "</table>";

}
}
?>

<?php
$sql = "SELECT * FROM Recepten ORDER BY moeilijkheidsgraad DESC LIMIT 1";
$result = $conn->query($sql);

if (isset($_POST['Toon3'])) {
    if ($result->rowCount() > 0) {  
        echo "<table>";
        echo "<tr><th>id</th><th>titel</th><th>afbeelding</th></th><th>duur</th><th>menugang</th><th>Moeilijkheidsgraad</th><th>aantal ingredienten</th>"; 
        foreach($result as $row) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['titel']."</td>";
            echo "<td>".$row['afbeelding']."</td>";
            echo "<td>".$row['duur']."</td>";
            echo "<td>".$row['menugang']."</td>";
            echo "<td>".$row['moeilijkheidsgraad']."</td>";
            echo "<td>".$row['aantal_ingredienten']."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    }
    ?>
    
    <?php
    $sql = "SELECT * FROM Recepten ORDER BY aantal_ingredienten DESC LIMIT 1";
    $result = $conn->query($sql);

if (isset($_POST['Toon2'])) {
if ($result->rowCount() > 0) {  
    echo "<table>";
    echo "<tr><th>id</th><th>titel</th><th>afbeelding</th></th><th>duur</th><th>menugang</th><th>Moeilijkheidsgraad</th><th>aantal ingredienten</th>"; 
    foreach($result as $row) {
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['titel']."</td>";
        echo "<td>".$row['afbeelding']."</td>";
        echo "<td>".$row['duur']."</td>";
        echo "<td>".$row['menugang']."</td>";
        echo "<td>".$row['moeilijkheidsgraad']."</td>";
        echo "<td>".$row['aantal_ingredienten']."</td>";
        echo "</tr>";
    }
    echo "</table>";

}
}
?>
    </div>
</body>

</html>
<?php include 'footer.php'; ?>

