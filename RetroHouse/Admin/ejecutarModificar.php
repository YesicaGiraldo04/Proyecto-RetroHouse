<?php
    session_start();
    require '../Database/databaseConn.php';

    $idProducto = htmlentities($_POST['idProducto']);
    $nombreProducto = htmlentities($_POST['nombreProducto']);
    $descripcion = htmlentities($_POST['descripcion']);
    $precio = htmlentities($_POST['precio']);
    $categoria = htmlentities($_POST['categoria']);
    $imagen = htmlentities($_FILES['imagenProducto']['name']);
    $musica = htmlentities($_FILES['musicaProducto']['name']);

    if($_SESSION['user_rol'] == 1){
        if(!empty($_FILES['imagenProducto']['name']) && !empty($_FILES['musicaProducto']['name'])){
            try{
                if($categoria == 1){
                    copy($_FILES['imagenProducto']['tmp_name'],'../assets/Images/Rock/'.$_FILES['imagenProducto']['name']);
                    copy($_FILES['musicaProducto']['tmp_name'],'../assets/Music/Rock/'.$_FILES['musicaProducto']['name']);
                }else if($categoria == 2){
                    copy($_FILES['imagenProducto']['tmp_name'],'../assets/Images/Pop/'.$_FILES['imagenProducto']['name']);
                    copy($_FILES['musicaProducto']['tmp_name'],'../assets/Music/Pop/'.$_FILES['musicaProducto']['name']);
                }else{
                    copy($_FILES['imagenProducto']['tmp_name'],'../assets/Images/Jazz/'.$_FILES['imagenProducto']['name']);
                    copy($_FILES['musicaProducto']['tmp_name'],'../assets/Music/Jazz/'.$_FILES['musicaProducto']['name']);
                }
            }catch(Exception $ex){
                echo $ex;
            }
            try{
                $actualizar = $conn->prepare('UPDATE producto SET nombreProducto = :nombreProducto, descripcion = :descripcion, precio = :precio, imagen = :imagen, musica = :musica, idCategoria = :idCategoria WHERE idProducto = :idProducto');
                $actualizar->execute([":nombreProducto" => $nombreProducto, ":descripcion" => $descripcion, ":precio" => $precio, ":imagen" => $imagen, ":musica" => $musica, ":idCategoria" => $categoria, ":idProducto" => $idProducto]);
    
                echo "
                <script>
                    alert('Se ha actualizado con éxito el producto');
                    window.location='./productoAdmin.php';
                </script>";
            }catch(Exception $ex){
                echo"<script>alert($ex)</script>";
            }
        }else if(!empty($_FILES['imagenProducto']['name'])){
            try{
                if($categoria == 1){
                    copy($_FILES['imagenProducto']['tmp_name'],'../assets/Images/Rock/'.$_FILES['imagenProducto']['name']);
                }else if($categoria == 2){
                    copy($_FILES['imagenProducto']['tmp_name'],'../assets/Images/Pop/'.$_FILES['imagenProducto']['name']);
                }else{
                    copy($_FILES['imagenProducto']['tmp_name'],'../assets/Images/Jazz/'.$_FILES['imagenProducto']['name']);
                }
            }catch(Exception $ex){
                echo $ex;
            }
            try{
                $actualizar = $conn->prepare('UPDATE producto SET nombreProducto = :nombreProducto, descripcion = :descripcion, precio = :precio, imagen = :imagen, idCategoria = :idCategoria WHERE idProducto = :idProducto');
                $actualizar->execute([":nombreProducto" => $nombreProducto, ":descripcion" => $descripcion, ":precio" => $precio, ":imagen" => $imagen, ":idCategoria" => $categoria, ":idProducto" => $idProducto]);
    
                echo "
                <script>
                    alert('Se ha actualizado con éxito el producto');
                    window.location='./productoAdmin.php';
                </script>";
            }catch(Exception $ex){
                echo"<script>alert($ex)</script>";
            }
        }else if(!empty($_FILES['musicaProducto']['name'])){
            try{
                if($categoria == 1){
                    copy($_FILES['musicaProducto']['tmp_name'],'../assets/Music/Rock/'.$_FILES['musicaProducto']['name']);
                }else if($categoria == 2){
                    copy($_FILES['musicaProducto']['tmp_name'],'../assets/Music/Pop/'.$_FILES['musicaProducto']['name']);
                }else{
                    copy($_FILES['musicaProducto']['tmp_name'],'../assets/Music/Jazz/'.$_FILES['musicaProducto']['name']);
                }
            }catch(Exception $ex){
                echo $ex;
            }
            try{
                $actualizar = $conn->prepare('UPDATE producto SET nombreProducto = :nombreProducto, descripcion = :descripcion, precio = :precio, musica = :musica, idCategoria = :idCategoria WHERE idProducto = :idProducto');
                $actualizar->execute([":nombreProducto" => $nombreProducto, ":descripcion" => $descripcion, ":precio" => $precio, ":musica" => $musica, ":idCategoria" => $categoria, ":idProducto" => $idProducto]);
    
                echo "
                <script>
                    alert('Se ha actualizado con éxito el producto');
                    window.location='./productoAdmin.php';
                </script>";
            }catch(Exception $ex){
                echo"<script>alert($ex)</script>";
            }
        }else{
            try{
                $actualizar = $conn->prepare('UPDATE producto SET nombreProducto = :nombreProducto, descripcion = :descripcion, precio = :precio, idCategoria = :idCategoria WHERE idProducto = :idProducto');
                $actualizar->execute([":nombreProducto" => $nombreProducto, ":descripcion" => $descripcion, ":precio" => $precio,  ":idCategoria" => $categoria, ":idProducto" => $idProducto]);
    
                echo "
                <script>
                    alert('Se ha actualizado con éxito el producto');
                    window.location='./productoAdmin.php';
                </script>";
            }catch(Exception $ex){
                echo"<script>alert($ex)</script>";
            }
        }
    }else{
        echo '
        <script>
            alert("No tienes permisos para esta página")
            window.location="../Landing/index.php"
        </script>';
    }
