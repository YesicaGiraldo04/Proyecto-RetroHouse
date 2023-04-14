<?php
    $server = 'localhost';

    $userName = 'root';

    $password = '';

    $dataBase = 'retrohouse';

    // Conexión a la base de datos
    try {
        $conn = new PDO("mysql:host=$server;dbname=$dataBase", $userName, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "La conexión falló: " . $e->getMessage();
    }
?>