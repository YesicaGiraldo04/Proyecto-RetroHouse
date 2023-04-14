<?php


    class CarritoDB {
        public function agregarProductoAlCarrito($idUsuario, $idProducto, $cantidad) {
            require_once "../Database/databaseUtils.php";

            $query = "INSERT INTO carrito (idUsuario, idProducto, cantidad, idEstado) VALUES(?,?,?,?)";
            $data = [$idUsuario, $idProducto, $cantidad, 1];
            $db = new DatabaseUtils();
            return $db->insertar($query, $data);
        }
       

        // public function consultarStock($idProducto){
        //     $query = "SELECT cantidad FROM producto WHERE idProducto = :idProducto;";
        //     $data = [":udProducto" => $idProducto];
        //     $db = new DatabaseUtils();
        //     return $db->recogerColumna($query, [$data]);
        // }


        public function consultarCarrito($idUsuario) {
            require_once "../Database/databaseUtils.php";
            $query = "  SELECT c.id , c.idProducto, p.nombreProducto, c.cantidad, p.precio as 'precio_unitario' ,(p.precio * c.cantidad) as 'precio_total', p.imagen, ca.nombreCategoria FROM carrito as c JOIN producto as p on c.idProducto = p.idProducto JOIN categoria as ca ON p.idCategoria = ca.idCategoria WHERE c.idUsuario = ? and c.idEstado = 1";

                $db = new DatabaseUtils();
                return $db->consultarListaConCondicion($query, [$idUsuario]);
            
        }

        public function cambiarEstadoDelProductoEnElCarrito ($idEstado ,$idCarrito)
        {            
           require_once "../Database/databaseUtils.php";
            $query = "UPDATE carrito set idEstado = ? WHERE id = ?";
            $db = new DatabaseUtils();
            return $db->actualizar($query, [$idEstado, $idCarrito]);
        }
    
        public function comprarProductoCarrito($fechaActual, $usuario, $precioTotal){
            require_once "../Database/databaseUtils.php";
            $query= "INSERT INTO venta (fecha, documentoUsuario, total, estado) VALUES(?,?,?,?)";
            $data = [$fechaActual, $usuario, $precioTotal, 1];
            $db = new DatabaseUtils();
            return $db->insertar($query, $data);


        }
    
     
        public function obtenerRegistrosTablaRegistros($idUsuario){
            require_once "../Database/databaseUtils.php";
            $query= "SELECT idProducto, id, cantidad FROM carrito WHERE idEstado = ? and idUsuario = ?";
            $db = new DatabaseUtils();
            echo "<br>" . $idUsuario;
            return $db->consultarListaConCondicion($query, [1, $idUsuario]);
        }

        public function agregarRegistrosTablaRegistros($idProducto, $idVenta, $cantidad, $precioUnitario){
            require_once "../Database/databaseUtils.php";
            $query= "INSERT INTO detalleVenta (idProducto, idVenta, cantidad, precioUnitario) VALUES(?,?,?,?)";
            $data = [$idProducto, $idVenta, $cantidad, $precioUnitario];
            $db = new DatabaseUtils();
            return $db->insertar($query, $data);
        }

        public function elimiarCantidad($idProducto, $cantidad){
            $query="UPDATE producto SET cantidad = cantidad - ? where idProducto = ?";
            $db = new DatabaseUtils();
            return $db->actualizar($query, [$cantidad, $idProducto]);

        }



    }

?>



