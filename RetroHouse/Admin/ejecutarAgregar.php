<?php
    session_start();
    require '../Database/databaseConn.php';

    if(!$_SESSION['user_rol'] == 1){
        echo "<script>alert('No tienes los permisos para estar aquí.');
        window.location='../Login/login.php';</script>";
    }

    if($_SESSION['user_rol'] == 1){

        $nombreProducto = htmlentities($_POST['nombreProducto']);
        $descripcion = htmlentities($_POST['descripcion']);
        $precio = htmlentities($_POST['precio']);
        $categoria = htmlentities($_POST['categoria']);
        $imagen = htmlentities($_FILES['imagenProducto']['name']);
        $musica = htmlentities($_FILES['musicaProducto']['name']);

        try{
            if($categoria == 1){
                copy($_FILES['imagenProducto']['tmp_name'],'../assets/Images/Rock/'.$_FILES['imagenProducto']['name']);
                copy($_FILES['imagenProducto']['tmp_name'],'../assets/Music/Rock/'.$_FILES['musicaProducto']['name']);
            }else if($categoria == 2){
                copy($_FILES['imagenProducto']['tmp_name'],'../assets/Images/Pop/'.$_FILES['imagenProducto']['name']);
                copy($_FILES['imagenProducto']['tmp_name'],'../assets/Music/Pop/'.$_FILES['musicaProducto']['name']);
            }else{
                copy($_FILES['imagenProducto']['tmp_name'],'../assets/Images/Jazz/'.$_FILES['imagenProducto']['name']);
                copy($_FILES['imagenProducto']['tmp_name'],'../assets/Music/Jazz/'.$_FILES['musicaProducto']['name']);
            }
            
        }catch(Exception $ex){
            echo $ex;
        }

        try{
            $agregar = $conn->prepare('INSERT INTO producto(nombreProducto,descripcion,cantidad,precio,imagen,musica,idCategoria,estado) VALUES (:nombre,:descripcion,:cantidad,:precio,:imagen,:musica,:categoria, :estado);');
            $agregar->execute([':nombre'=>$nombreProducto,':descripcion'=>$descripcion,':cantidad'=>0,':precio'=>$precio,':imagen'=>$imagen,':musica'=>$musica,':categoria'=>$categoria,':estado'=>0]);

            echo "
            <script>
                alert('Se ha registrado con éxito el producto');
                window.location='./productoAdmin.php';
            </script>";
        }catch(Exception $ex){
            echo"<script>alert($ex)</script>";
        }
    }else{
        echo '
        <script>
            alert("No tienes permisos para esta página")
            window.location="../Landing/index.php"
        </script>';
    }
