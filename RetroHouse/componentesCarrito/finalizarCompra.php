<?php

try {
    session_start();

    require("../validaciones/validador.php");
    require "../Database/databaseConn.php";
    require_once('./carritoDB.php');


    $validador = new Validador();
    $db = new CarritoDB();
   
    date_default_timezone_set('America/Bogota');
   
    $fechaActual = date("y-m-d h:i:s");
    $usuario = $_SESSION['user_id'];
    $precioTotal = $_POST['valorTotal'];


    $datos = [$fechaActual, $usuario, $precioTotal];
    $losDatosSonValidos = $validador->validarDatos($datos);


    if (!$losDatosSonValidos) {
     header("location: ./carrito.php?alerta=La compra no pudo ser válida");
      return;

      

    } else {
        $compra = $db->comprarProductoCarrito($fechaActual, $usuario, $precioTotal);

        if(!isset($compra)) {
           header("location: ./carrito.php?alerta=La compra fue rechazada");

        } else {
            $obtener = $db->obtenerRegistrosTablaRegistros($usuario);
            
            foreach($obtener as $obtenido){

                echo'dsfgn';
                $idProducto = $obtenido['idProducto'];

                $consulta = $conn->prepare("SELECT precio FROM producto WHERE idProducto = :idProducto;");
                $consulta->execute([":idProducto" => $idProducto]);
                $precioUnitario = $consulta->fetchColumn();

                $cantidad = $obtenido['cantidad'];

                $agregado =$db->agregarRegistrosTablaRegistros($idProducto, $compra, $cantidad, $precioUnitario);

                $idCarrito = $obtenido['id'];

                $vaciar = $db->cambiarEstadoDelProductoEnElCarrito(3, $idCarrito);

                $eliminar = $db->elimiarCantidad($idProducto, $cantidad);

            }

            header("location: ./factura.php?id=$compra");

        }

    }

} catch (Exception $e) {
    header("Location: ./carrito.php?alerta=Ocurrió un error inesperado");
}

?>