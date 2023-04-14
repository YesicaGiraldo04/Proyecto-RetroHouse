<?php
    if(!empty($_POST['function'])){
        require '../Database/databaseConn.php';

        $consulta = $conn->prepare('SELECT cantidad, nombreProducto, idProducto FROM producto WHERE cantidad <= :cantidad');
        $consulta->execute([":cantidad" => 1]);
        $productos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        
        if($productos == true){

            foreach($productos as $key => $value){
                $producto = $value['idProducto'];
                if($value['cantidad'] <= 0){
                    $queryUpdate = $conn->prepare("UPDATE producto SET estado = 0 WHERE idProducto = :idProducto");
                    $queryUpdate->execute(['idProducto' => $producto]);
                }
            }
            echo
            '
            <svg xmlns="http://www.w3.org/2000/svg" width="36px" height="36px" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);"><path d="m5.705 3.71-1.41-1.42C1 5.563 1 7.935 1 11h1l1-.063C3 8.009 3 6.396 5.705 3.71zm13.999-1.42-1.408 1.42C21 6.396 21 8.009 21 11l2-.063c0-3.002 0-5.374-3.296-8.647zM12 22a2.98 2.98 0 0 0 2.818-2H9.182A2.98 2.98 0 0 0 12 22zm7-7.414V10c0-3.217-2.185-5.927-5.145-6.742C13.562 2.52 12.846 2 12 2s-1.562.52-1.855 1.258C7.184 4.073 5 6.783 5 10v4.586l-1.707 1.707A.996.996 0 0 0 3 17v1a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-1a.996.996 0 0 0-.293-.707L19 14.586z"/></svg>
            ';
        }else{
            
        }
    }else{
    }
?>