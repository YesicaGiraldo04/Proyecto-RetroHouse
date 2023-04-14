<?php

require './databaseConn.php';
if (isset($_POST['idUsuarioD'])) {
    $querySelect = $conn->prepare("UPDATE usuario SET estado = 2 WHERE documentoCliente = :id");
    $querySelect->bindParam('id',$_POST['idUsuarioD']);
    if($querySelect->execute()){
    echo "<script>alert('Usuario deshabilitado con éxito'); window.location = '../Admin/modUsuario.php'  </script>";
    } else {
        echo "<script> alert('Hubo un error')</script>";
    }
}else if(isset($_POST['idUsuarioH'])){
    $querySelect = $conn->prepare("UPDATE usuario SET estado = 1 WHERE documentoCliente = :id");
    $querySelect->bindParam('id',$_POST['idUsuarioH']);
    if($querySelect->execute()){
    echo "<script>alert('Usuario actualizado con éxito'); window.location = '../Admin/modUsuario.php'  </script>";
    } else {
        echo "<script> alert('Hubo un error')</script>";
    }

}




?>