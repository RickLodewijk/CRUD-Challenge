<?php
    require 'connectie.php';
        
    if (isset($_GET['ID'])) {
        $id = $_GET['ID'];
        $sqldelete = "DELETE FROM overzicht WHERE ID = :ID";
        $executeDelete = $conn->prepare($sqldelete);
        $executeDelete->bindParam(':ID', $id);

        $executeDelete->execute();
        $executeDelete->closeCursor();
    }
    
    $conn = null;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
