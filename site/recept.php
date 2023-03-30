<?php
require 'database.php';
include 'header.php';
include 'nav.php';
$id = $_GET['id'];

$sql = "SELECT * FROM Recepten WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$recepten = $stmt->fetchAll();

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
    <h1>Recepten</h1>
    <div class="divclass3">
        <?php foreach ($recepten as $recept) : ?>
            <div>
                <?php echo $recept['titel'] ?></br>
                <img src="images/<?php echo $recept['afbeelding'] ?>" style="width: 100%"></img></a></br>
                Duur koken recept: <?php echo $recept['duur'] ?></br>
                Menugang: <?php echo $recept['menugang'] ?></br>
                Moeilijkheidsgraad gerecht: <?php echo $recept['moeilijkheidsgraad'] ?></br>
                Aantal ingredienten: <?php echo $recept['aantal_ingredienten'] ?></br>
            </div>
        <?php endforeach ?>
    </div>
</body>

</html>
<?php include 'footer.php'; ?>