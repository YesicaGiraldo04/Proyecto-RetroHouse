<?php
    try {
     
        require("../validaciones/validador.php");
       
        require("./carritoDB.php");
  
       $validador = new validador();
        $db = new CarritoDB();

        
        $idCarrito = $_POST["idCarrito"];
         $datos = [$idCarrito];   
         $losDatosSonValidos = $validador->validarDatos($datos);

        if (!$losDatosSonValidos) {
            header("Location: ./carrito.php?alerta=Ocurrió un error al eliminar el producto del carrito");
            return;
            
       } else {
             $resultado = $db->cambiarEstadoDelProductoEnElCarrito(2,$idCarrito);
             if($resultado == true) {
                header("Location: ./carrito.php?mensaje=Se eliminó el producto del carrito");
             }else{
              header("Location: ./carrito.php?error=No se eliminó el producto del carrito");
             }
        } 
             
        exit();
 
    } catch (Exception $e){
        header("Location: ./carrito.php?error=Ocurrió un error inesperado");
    }
?>

