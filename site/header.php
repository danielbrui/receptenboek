<?php
$stmt = $conn->prepare('SELECT COUNT(id) as count FROM Recepten');

$stmt->execute();
$result = $stmt->fetch();
echo '<div class="CenterText"><h1 class="HeaderText">Finse Recepten<span>Totaal aantal recepten: ' . $result['count'] . '</span></h1></div>';
?>