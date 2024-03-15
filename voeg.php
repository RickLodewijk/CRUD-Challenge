<?php
$servername = "localhost";
$database = "teLaat";
$username = "root";
$password = "";

$naam = $_POST['name'];
$klas = $_POST['klas'];
$minuten = $_POST['minuten'];
$reden = $_POST['reden'];

$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

$sql = "INSERT INTO telaat.overzicht (naam, klas, minuten, reden) VALUES (:naam, :klas, :minuten, :reden)";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':naam', $naam);
$stmt->bindParam(':klas', $klas);
$stmt->bindParam(':minuten', $minuten);
$stmt->bindParam(':reden', $reden);

$stmt->execute();
$conn = null;

$doelpagina = "eindopdracht.php";

header("Location: " . $doelpagina);
?>
