<?php
$servername = "localhost";
$database = "teLaat";
$username = "root";
$password = "";

$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

$naam = $_POST['name'];
$klas = $_POST['klas'];
$minuten = $_POST['minuten'];
$reden = $_POST['reden'];
$ID = $_POST['ID']; 

$sql = "UPDATE overzicht SET naam = :naam, klas = :klas, minuten = :minuten, reden = :reden WHERE ID = :ID"; // Use UPDATE instead of INSERT INTO

$stmt = $conn->prepare($sql);
$stmt->bindParam(':naam', $naam);
$stmt->bindParam(':klas', $klas);
$stmt->bindParam(':minuten', $minuten);
$stmt->bindParam(':reden', $reden);
$stmt->bindParam(':ID', $ID);

$stmt->execute();

$doelpagina = "eindopdracht.php";

header("Location: " . $doelpagina);
?>
