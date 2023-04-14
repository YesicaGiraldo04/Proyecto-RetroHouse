<?php
session_start();
if (isset($_SESSION['user_id']) ) {
    if ($_SESSION['user_rol'] !== 1) {
        echo "<script> alert('No puedes estar en esta página.');
        window.location='../Landing/index.php'</script>";
    }
}
require '../Database/databaseConn.php';


// if (isset($_POST['status'])) {
//     // Checkbox marcado, cambia el estado del usuario a "activo"
//     $estado = "1";
//   } else {
//     // Checkbox no marcado, cambia el estado del usuario a "inactivo"
//     $estado = "0";
//   }
  
//   // Ejecutar la consulta SQL para actualizar el estado del usuario
//   $sql = "UPDATE usuario SET estado = :estado WHERE documentoCliente = :id";
//   $stmt = $conn->prepare($sql);
//   $stmt->bindParam(':estado', $estado);
//   $stmt->bindParam(':id', $id);
//   $stmt->execute();

if (isset($_POST['sendINfo'])) {
        $status = $_POST['status'];
        foreach ($status as $id) {
        // Obtener el estado actual del usuario
        $sql = "SELECT estado FROM usuarios WHERE documentoCliente = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $estado_actual = $stmt->fetchColumn();
    
        // Cambiar el estado del usuario
        if ($estado_actual == "1") {
            $estado = "0";
        } else {
            $estado = "1";
        }
        $sql = "UPDATE usuario SET estado = :estado WHERE documentoCliente = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            echo 'Hola';
        }
        }
}

