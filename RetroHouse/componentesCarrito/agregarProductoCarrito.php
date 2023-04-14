


<?php

try {
    session_start();

    require "../Database/databaseConn.php";
    require("../validaciones/validador.php");
    require_once('./carritoDB.php');


    $validador = new Validador();

    $usuario = $_SESSION['user_id'];
    $idProducto = $_POST["idProducto"];
    $cantidad = $_POST["cantidad"];

    $nombreFormulario = $_POST["nombreFormulario"];
    // $db = new CarritoDB();
    // $stock = $db->consultarStock($idProducto);

    $consulta = $conn->prepare("SELECT cantidad FROM producto WHERE idProducto = :idProducto;");
    $consulta->execute([":idProducto" => $idProducto]);
    $stock = $consulta->fetchColumn();

    $datos = [$idProducto, $cantidad];
    $losDatosSonValidos = $validador->validarDatos($datos);

    $validarUsuario = [$usuario];
    $usuarioValido = $validador->validarDatos($validarUsuario);

    if(!$usuarioValido){
        header("Location: ../pagina/$nombreFormulario.php?alerta=Debes iniciar sesión para agregar un producto");
        return;

    }else if($stock < $cantidad){
        header("Location: ../pagina/$nombreFormulario.php?alerta=No existen suficientes productos para agregar al carrito.");
        return;
    }else{

                if (!$losDatosSonValidos) {
                    header("Location: ../pagina/$nombreFormulario.php?alerta=Asegurate de ingresar la cantidad deseada poder agregar el producto al carrito");
                    return;
                }

                require_once "../Database/databaseUtils.php";
                $query = "SELECT cantidad from producto where idProducto = ?";
                $db = new DatabaseUtils();
                $resultadoProducto = $db->consultarListaConCondicion($query, [$idProducto]);

                if (isset($resultadoProducto) && $resultadoProducto[0]['cantidad'] > 0) {
                    $dbc = new CarritoDB();
                    $dbc->agregarProductoAlCarrito($usuario, $idProducto, $cantidad);


                    header("Location: ../pagina/$nombreFormulario.php?mensaje=Se agregó el producto al carrito");
                } else {
                    header("Location: ../pagina/$nombreFormulario.php?alerta=Error al agregar el producto");
                }
        }
} catch (Exception $e) {
    header("Location: ../pagina/$nombreFormulario.php?alerta=Ocurrió un error inesperado");
}
?>