<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/agregarProducto.css">
    <!-- toastr -->
    <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
    <title>Modificar producto</title>
</head>
<body>
    <?php
        require '../assets/header.php';
        require '../Database/databaseConn.php';
        
        if(!$_SESSION['user_rol'] == 1){
            echo "<script>alert('No tienes los permisos para estar aquí.');
            window.location='../Login/login.php';</script>";
        }

        if (isset($_POST['idProducto'])){

            $consulta = $conn->prepare("SELECT * FROM producto WHERE idProducto = :idProducto;");
            $consulta->bindparam(':idProducto', $_POST["idProducto"]);
            $consulta->execute();
            $producto = $consulta->fetch(PDO::FETCH_ASSOC);

        };

        
    ?>
    <div class="container my-3 px-3 py-2" style="background-color: rgba(255, 255, 255, 0.8); border-radius: 10px; ">
        <form action="ejecutarModificar.php" method="POST" name="formularioAgregar" enctype="multipart/form-data">
            <input type="text" name="idProducto" value="<?php echo $_POST['idProducto'] ?>" hidden>
            <div class="row">
                <div class="col">
                    <label style="color:#000;"for="nombreProducto">Nombre del producto:</label>
                    <input class="form-control" type="text" id="nombreProducto" name="nombreProducto" value="<?php echo $producto['nombreProducto'] ?>">
                </div>
                <div class="col">
                    <label style="color:#000;"for="cantidad">Cantidad:</label>
                    <input class="form-control" type="text" id="cantidad" name="cantidad" onchange="valNum('cantidad')" value="<?php echo $producto['cantidad'] ?>" disabled>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label style="color:#000;"for="precio">Precio del lp:</label>
                    <input class="form-control" type="text" id="precio" name="precio" onchange="valNum('precio')" value="<?php echo $producto['precio'] ?>" >
                </div>
                <div class="col">
                    <label style="color:#000;"for="categoria">Categoría del lp:</label>
                    <select class="form-select" id="categoria" name="categoria" onchange="valCat()">
                        <option value="N/N">Categoría.</option>
                        <option value="1" <?php if($producto['idCategoria'] == 1){echo "selected";} ?>>Rock</option>
                        <option value="2" <?php if($producto['idCategoria'] == 2){echo "selected";} ?>>Pop</option>
                        <option value="3" <?php if($producto['idCategoria'] == 3){echo "selected";} ?>>Jazz</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col mt-3">
                    <h4 style="color: #000; text-align:center;">Si se desea cambiar la imagen o la música del producto se debe seleccionar el archivo, de lo contrario dejar el campo vacío.</h4>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col">
                    <label style="color:#000;"for="imagenProducto">Imagen del lp:</label>
                    <input class="form-control" type="file" id="imagenProducto" name="imagenProducto" accept=".png,.jpg,.jpeg,.gif" onchange="validarImagen()">
                </div>
                <div class="col">
                    <label style="color:#000;"for="musicaProducto">Demo del lp:</label>
                    <input class="form-control" type="file" id="musicaProducto"  name="musicaProducto" accept=".mp3,.aac,.flac,.wav" onchange="validarMusica()" value="">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label style="color:#000;" for="descipcion">Listado de canciones:</label>
                    <textarea id="texto" class="form-control" placeholder="*" onchange="obtenerInfo()"><?php echo $producto['descripcion'] ?></textarea>
                    <input class="form-control" type="text" id="descripcion" name="descripcion" value="<?php echo $producto['descripcion'] ?>" hidden>
                </div>
            </div>
            <div class="row my-3">
                <div class="col">
                    <button class="btn btn-secondary" type="button" onclick="validarTodo2()">Modificar</button>
                    <input class="btn btn-secondary" type="button" value="Cancelar" onclick="window.location='./productoAdmin.php'">
                </div>
            </div>
        </form>
    </div>
    <!-- Toastr -->
    <script src="../plugins/toastr/toastr.min.js"></script>
    <!-- sweetAlert2 -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="./validarProductos.js"></script>
</body>
</html>