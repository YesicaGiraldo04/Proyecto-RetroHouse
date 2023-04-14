<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/detalleProducto.css">
    <title>Detalle del Producto</title>
</head>
<body>
    <?php
        require '../assets/header.php';
        require '../Database/databaseConn.php';

        try{

            $consulta = $conn->prepare("SELECT producto.*, categoria.nombreCategoria FROM producto INNER JOIN categoria ON producto.idCategoria = categoria.idCategoria WHERE idProducto = :idProducto");
            $consulta->execute([":idProducto" => $_POST['idProducto']]);
            $producto = $consulta->fetch(PDO::FETCH_ASSOC);

            if($producto['idCategoria'] == 1){
                $categoria = 'Rock/';
                $srcImg = $producto['imagen'];
                $srcMp3 = $producto['musica'];
                $regreso = './rock.php';
            }else if($producto['idCategoria'] == 2){
                $categoria = 'Pop/';
                $srcImg = $producto['imagen'];
                $srcMp3 = $producto['musica'];
                $regreso = './pop.php';
            }else if($producto['idCategoria'] == 3){
                $categoria = 'Jazz/';
                $srcImg = $producto['imagen'];
                $srcMp3 = $producto['musica'];
                $regreso = './jazz.php';
            }else{
                echo 
                "<script>
                    alert('No se ha detectado ninguna categoría');
                </script>
                ";
            }
            
            $info = new SplFileInfo($producto['musica']);
            $extension = $info->getExtension();

        }catch(Exception $ex){
            echo $ex;
        }
    ?>
    <div class="container" style="background-color: rgba(24, 24, 16, .2); backdrop-filter: blur(15px); border-radius:5px; color:#fff; padding-left:7px; padding-bottom:7px; padding-top:7px; margin-top:5%;">
        <div class="row mb-3">
            <div class="col-sm-12 col-md-4 col-lg-4">
                <img src="../assets/Images/<?php echo $categoria.$srcImg ?>" alt="No se a encontrado la imagen de este producto." id="idImagenProducto">
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4">
                <h3>Género: <?php echo $producto['nombreCategoria']?></h3>
                <p><?php echo $producto['descripcion']?></p>
                <p>Demo del album:</p>
                <audio controls height="100" width="100">
                    <source src="../assets/Music/<?php echo $categoria.$srcMp3 ?>" type="audio/<?php echo $extension?>">
                </audio>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-12 col-md-4 col-lg-4">
                <h3><?php echo $producto['nombreProducto']?></h3>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4">
                <h3>Precio: $ <?php echo $producto['precio']?></h3>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-4 col-md-4 col-lg-4">
                <a href="<?php echo$regreso?>" class="btn btn-secondary">Regresar</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>