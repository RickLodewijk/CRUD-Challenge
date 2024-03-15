<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="STYLESHEET" href="eindopdracht.css" type="text/css">

    <script>
        function bevestigVerwijdering() {
            return confirm("Weet je zeker dat je dit record wilt verwijderen?");
        }
    </script>
</head>
<body>

<?php
require 'connectie.php';
$sql = "SELECT * FROM `overzicht`";
$stmt = $conn->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(); 

echo "<table>";
echo "<tr class='lichtgrijs'>";
echo "<th>Naam</th>";
echo "<th>Klas</th>";
echo "<th>Minuten te laat</th>";
echo "<th>Reden te laat</th>";
echo "</tr>";

$rijnummer = 0;
foreach ($results as $result) { 
    $rijnummer++;
    $klasse = ($rijnummer % 2 == 0) ? '' : 'oneven-rij';
    echo '<tr class="' . $klasse . '">';
    echo "<td>" . $result['naam'] . "</td>";
    echo "<td>" . $result['klas'] . "</td>";
    echo "<td>" . $result['minuten'] . "</td>";
    echo "<td>" . $result['reden'] . "</td>";            
    echo "<td>";
    echo "<form action='Delete.php' method='get' onsubmit='return bevestigVerwijdering();'>
        <input type='hidden' name='ID' value='" . $result["ID"] . "'>
        <input type='submit' value='Verwijderen' class='verwijder'>
        </form>";
    echo "</td>";
    echo "<td><form action='update-form.php' method='get'>
        <input type='hidden' name='ID' value='".$result["ID"]."'>
        <input type='submit' value='update' class='update'>
        </form></td>";
    echo "</tr>";
}

echo "</table>";

echo "<td><form action='formulier.php' method='get'>
        <input type='submit' value='Weer eentje' class='voegtoe'>
        </form></td>";

require 'connectie.php';
$sql = "SELECT SUM(minuten) AS total_minutes FROM `overzicht`";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();
$totalMinutes = $result['total_minutes'];

require 'connectie.php';
$sql = "SELECT MAX(minuten) AS hoogste FROM `overzicht`";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();
$hoogste_minuten = $result['hoogste'];

require 'connectie.php';
$sql = "SELECT ROUND (AVG(minuten)) AS gemiddelde FROM `overzicht`";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();
$gemiddelde_minuten = $result['gemiddelde'];

echo "<h1>Statistieken</h1>";
echo "<p>Hoeveel minuten in totaal ". $totalMinutes. "</p>";
echo "<p class='lichtgrijs'>Gemiddeld aantal minuten te laat ". $gemiddelde_minuten. "</p>";
echo "<p>hoogste aantal minuten te laat ". $hoogste_minuten. "</p>";
?>
</body>
</html>
