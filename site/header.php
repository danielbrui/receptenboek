<?php
require 'database.php';

$stmt = $conn->prepare("SELECT COUNT(id)
FROM Recepten");
$stmt->execute();
$conn = $stmt->fetchAll();
echo $conn;
