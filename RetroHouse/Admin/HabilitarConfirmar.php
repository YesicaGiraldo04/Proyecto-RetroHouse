<?php
    require '../Database/databaseConn.php';
    session_start();
    if(!$_SESSION['user_rol'] == 1){
        echo "<script>alert('No tienes los permisos para estar aquí.');
        window.location='../Login/login.php';</script>";
    }

    if (isset($_POST['idProducto']) && !empty($_POST['idProducto'])){
        $eliminar = $conn->prepare("UPDATE producto SET estado = 1 WHERE idProducto = :idProducto ;");
        $eliminar->bindparam(':idProducto',$_POST['idProducto']);
        $resultado = $eliminar->execute();
        if ($resultado){
            echo '
                <script>
                    alert("Producto habilitado exitosamente");
                    window.location="./productoAdmin.php";
                </script>
            ';
        }
    }else if(isset($_POST['idProveedor']) && !empty($_POST['idProveedor'])){
        $eliminar = $conn->prepare("UPDATE proveedor SET estado = 1 WHERE idProveedor = :idProveedor ;");
        $eliminar->bindparam(':idProveedor',$_POST['idProveedor']);
        $resultado = $eliminar->execute();
        if ($resultado){
            echo '
                <script>
                    alert("Proveedor habilitado exitosamente");
                    window.location="proveedoresAdmin.php";
                </script>
            ';
        }
    }
?>

