<?php
$stmt = $conn->prepare('SELECT COUNT(id) as count FROM Recepten');

$stmt->execute();
$result = $stmt->fetch();
echo '<h2>Totaal aantal recepten: ' . $result['count'] . '</h2>';
?>
