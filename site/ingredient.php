<?php
require 'database.php';
include 'header.php';
include 'nav.php';

$stmt = $conn->prepare("SELECT * FROM Ingredient");
$stmt->execute();

$ingredienten = $stmt->fetchAll();
/*?id=1*/
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
                    <tr>
                        <td><?php echo $ingredient["naam"] ?></td>
                    </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
<?php include 'footer.php'; ?>