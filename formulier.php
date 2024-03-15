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
                return false; // Formulier wordt niet verzonden
            }
            
            return true; // Formulier wordt verzonden
        }
    </script>
</head>
<body>
    <form action='voeg.php' method='post' onsubmit="return validateForm();"> <!-- Changed method to POST -->
        <h1> Nieuwe melding voor een student die te laat is </h1>
        <label for="name"> Naam student </label><br>
        <input type="text" id="name" name="name"><br>
        <label for="klas">Klas:</label><br>
        <select id="klas" name="klas">
            <option value="9A">9A</option>
            <option value="9B">9B</option>
            <option value="9C">9C</option>
            <option value="9D">9D</option>
        </select><br>
        <label for="minuten">minuten:</label><br>
        <input type="number" id="minuten" name="minuten"><br>
        <label for="reden"> Reden van te laat </label><br>
        <input type="text" id="reden" name="reden"><br>
        <input type="submit">
    </form>

    <?php
    session_start(); // Start the PHP session

    if ($_SERVER["REQUEST_METHOD"] == "POST") { // Check for POST method
        $name = $_POST['name']; // Change from $_GET to $_POST
        $klas = $_POST['klas'];
        $minuten = $_POST['minuten'];
        $reden = $_POST['reden'];

        // Store values in session variables
        $_SESSION['name'] = $name;
        $_SESSION['klas'] = $klas;
        $_SESSION['minuten'] = $minuten;
        $_SESSION['reden'] = $reden;
    }
    ?>
</body>
</html>
