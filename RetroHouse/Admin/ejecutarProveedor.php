<?php
    require "../Database/databaseConn.php";
    session_start();
    if(!$_SESSION['user_rol'] == 1){
        echo "<script>alert('No tienes los permisos para estar aquí.');
        window.location='../Login/login.php';</script>";
    }

        $nombre = htmlentities($_POST['nombreProveedor']);
        $correo = htmlentities($_POST['email']);
        $telefono = htmlentities($_POST['telefonoProveedor']);

    try{
        $consulta = $conn->prepare("INSERT INTO proveedor SET nombreProveedor = :nombre, correoProveedor = :correo, telefonoProveedor = :telefono, estado = :estado;");
        $resultado = $consulta->execute([":nombre" => $nombre, ":correo" => $correo, ":telefono" => $telefono, ":estado" => 1]);
        if($resultado == true){
            echo "<script> alert('Se ha agregado con éxito el proveedor');
            window.location='./proveedoresAdmin.php';</script>";
        }else{
            echo "<script> alert('No se ha agregado el proveedor con éxito');
            window.location='./proveedoresAdmin.php';</script>";
        }
    }catch(Exception $ex){
        echo "Error: ".$ex;
    }
?>