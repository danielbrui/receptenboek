<?php
session_start();
if ($_SESSION['rol'] != "admin") {
    //header('index.php');
    exit;
}
if ($_SESSION['email'] != $email) {
    exit;
}
require 'database.php';
include 'header.php';
include 'nav.php';
$id = $_GET['id'];

$sql = "SELECT * FROM Ingredient WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$ingredienten = $stmt->fetchAll();

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
    <h1>Ingredienten</h1>
    <div class="divclass2">
        <table class="tabel">
            <thead>
                <tr>
                    <th scope="col">Naam ingredient</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ingredienten as $ingredient) : ?>
                    <tr>
                        <td><?php echo $ingredient["naam"] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</body>

</html>
<?php include 'footer.php'; ?>