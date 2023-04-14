<?php
    session_start();
    if(!$_SESSION['user_rol'] == 1){
        echo "<script>alert('No tienes los permisos para estar aquí.');
        window.location='../Login/login.php';</script>";
    }
    if(isset($_SESSION['numInput'])){
        require "../Database/databaseConn.php";
        try{
            $arregloMaster = array();
            $idProveedor = htmlentities($_POST['proveedor']);
            for($i = 1 ; $i<=$_SESSION['numInput'];$i++){
                if(!empty($_POST['select'.$i.'']) && !empty($_POST['cantidad'.$i.'']) && !empty($_POST['precio'.$i.''])){
                    $idProducto = htmlentities($_POST['select'.$i.'']);
                    $cantidad = htmlentities($_POST['cantidad'.$i.'']);
                    $precioUnitario = htmlentities($_POST['precio'.$i.'']);

                    $arregloMaster[] = ["idProducto" => $idProducto, "cantidad" => $cantidad, "precioUnitario" => $precioUnitario];
                }else{
                    continue;
                }
            }
            $total = 0;
            foreach($arregloMaster as $x => $x_values){
                $subtotal = $x_values['precioUnitario'] * $x_values['cantidad'];
                $total += $subtotal; 
            }
            date_default_timezone_set("America/Bogota");
            $fechaActual = date("Y-m-d h:i:s");

            $consulta = $conn->prepare("INSERT INTO compra(`fechaCompra`,`totalCompra`,`idProveedor`) VALUES (:fecha,:total,:idProveedor);");
            $consulta->execute([":fecha" => $fechaActual,":total" => $total, ":idProveedor" => $idProveedor]);

            $consulta = $conn->prepare("SELECT idCompra FROM compra WHERE fechaCompra = :fechaActual;");
            $consulta->execute([":fechaActual" => $fechaActual]);
            $idCompra = $consulta->fetch(PDO::FETCH_ASSOC);

            foreach($arregloMaster as $x => $x_values){
                try{
                    $consulta = $conn->prepare("INSERT INTO detallecompra(`cantidad`,`precioUnitario`,`idCompra`,`idProducto`) VALUES (:cantidad,:precioUnitario,:idCompra,:idProducto)");
                    $consulta->execute([":cantidad" => $x_values['cantidad'],":precioUnitario" => $x_values['precioUnitario'],":idCompra" => $idCompra['idCompra'],":idProducto" => $x_values['idProducto']]);
                }catch(Exception $ex){
                    echo $ex;
                }
                try{
                    $consulta = $conn->prepare("UPDATE producto SET cantidad = cantidad + :suma WHERE idProducto = :idProducto;");
                    $consulta->execute([":suma" => $x_values['cantidad'], ":idProducto" => $x_values['idProducto']]);
                }catch(Exception $ex){
                    echo $ex;
                }
            }

            unset($_SESSION['numInput']);

            echo "<script>
                alert('Se ha realizado la compra con éxito')
                window.location='./comprasAdmin.php';
            </script>";

        }catch(Exception $ex){
            echo $ex;
        }
    }else{
        echo"
        <script>alert('No hay nada');window.location='comprasAdmin.php'</script>;
        ";
    }
    
?>