<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="eindopdracht.css">
    <script>
        function validateForm() {
            var minutenInput = document.getElementById("minuten");
            var minutenValue = minutenInput.value;
            
            if (minutenValue <= 0) {
                alert("De ingevoerde aantal minuten kloppen niet!");
                return false;
            }
            
            return true;
        }
    </script>
</head>
<body>

<?php
$servername = "localhost";
$database = "telaat";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['ID'])) {
        $student_id = $_GET['ID'];

        $sql = "SELECT * FROM overzicht WHERE ID = :student_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':student_id', $student_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $student_name = $row['naam'];
            $student_class = $row['klas'];
            $student_minutes = $row['minuten'];
            $student_reason = $row['reden'];
        } else {
            echo "Geen gegevens gevonden voor deze ID";
        }
    } else {
        echo "Geen ID gevonden in de URL";
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Geen expliciete close() nodig, de verbinding wordt automatisch gesloten bij het vernietigen van het PDO-object.
?>

<form action='update.php' method='post' onsubmit="return validateForm();">
    <input type="hidden" name="ID" value="<?php echo $student_id; ?>">
    <h1> Update de gegevens </h1>
    <label for="name"> Naam student </label><br>
    <input type="text" id="name" name="name" value="<?php echo $student_name; ?>"><br>
    <label for="klas">Klas:</label><br>
    <select id="klas" name="klas">
        <option value="9A" <?php if ($student_class == '9A') echo 'selected'; ?>>9A</option>
        <option value="9B" <?php if ($student_class == '9B') echo 'selected'; ?>>9B</option>
        <option value="9C" <?php if ($student_class == '9C') echo 'selected'; ?>>9C</option>
        <option value="9D" <?php if ($student_class == '9D') echo 'selected'; ?>>9D</option>
    </select><br>
    <label for="minuten">minuten:</label><br>
    <input type="number" id="minuten" name="minuten" value="<?php echo $student_minutes; ?>"><br>
    <label for="reden"> Reden van te laat </label><br>
    <input type="text" id="reden" name="reden" value="<?php echo $student_reason; ?>"><br>
    <input type="submit">
</form>


    <?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        $name = $_POST['name']; 
        $klas = $_POST['klas'];
        $minuten = $_POST['minuten'];
        $reden = $_POST['reden'];
        $ID = $_POST['ID'];

        $_SESSION['name'] = $name;
        $_SESSION['klas'] = $klas;
        $_SESSION['minuten'] = $minuten;
        $_SESSION['reden'] = $reden;
        $_SESSION['ID'] = $ID;
    }
    ?>
</body>
</html>
