<?php
    require "../Database/databaseConn.php";
    session_start();
    if(!$_SESSION['user_rol'] == 1){
        echo "<script>alert('No tienes los permisos para estar aquí.');
        window.location='../Login/login.php';</script>";
    }

        $nombre = htmlentities($_POST['nombreProveedor']);
        $correo = htmlentities($_POST['correoProveedor']);
        $telefono = htmlentities($_POST['telefonoProveedor']);

    try{
        $consulta = $conn->prepare("UPDATE proveedor SET nombreProveedor = :nombre, correoProveedor = :correo, telefonoProveedor = :telefono WHERE idProveedor = :id;");
        $resultado = $consulta->execute([":nombre" => $nombre, ":correo" => $correo, ":telefono" => $telefono, ":id" => $_POST['idProveedor']]);
        if($resultado == true){
            echo "<script> alert('Se ha modificado con éxito el proveedor');
            window.location='./proveedoresAdmin.php';</script>";
        }else{
            echo "<script> alert('No se ha podido modificar el proveedor');
            window.location='./proveedoresAdmin.php';</script>";
        }
    }catch(Exception $ex){
        echo "Error: ".$ex;
    }
?>