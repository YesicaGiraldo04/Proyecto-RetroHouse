
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
    <title>Agregar producto</title>
</head>
<body>
    <?php
        require '../assets/header.php';
        if(!$_SESSION['user_rol'] == 1){
            echo "<script>alert('No tienes los permisos para estar aquí.');
            window.location='../Login/login.php';</script>";
        }
    ?>
    <div class="container my-3 px-3 py-2" style="background-color: rgba(255, 255, 255, 0.8); border-radius: 10px; ">
        <form action="ejecutarAgregar.php" method="POST" name="formularioAgregar" enctype="multipart/form-data">
            <div class="row">
                <div class="col">
                    <label style="color:#000;" for="nombreProducto">Nombre del producto:</label>
                    <input class="form-control" type="text" id="nombreProducto" name="nombreProducto" placeholder="*" >
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label style="color:#000;" for="precio">Precio del lp:</label>
                    <input class="form-control" type="text" id="precio" name="precio" placeholder="*" onchange="valNum('precio')">
                </div>
                <div class="col">
                    <label style="color:#000;" for="categoria">Categoría del lp:</label>
                    <select class="form-select" id="categoria" name="categoria" onchange="valCat()">
                        <option value="N/N" selected>Categoría.</option>
                        <option value="1">Rock</option>
                        <option value="2">Pop</option>
                        <option value="3">Jazz</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label style="color:#000;" for="imagenProducto">Imagen del lp:</label>
                    <input class="form-control" type="file" id="imagenProducto" name="imagenProducto" accept=".png,.jpg,.jpeg,.gif" onchange="validarImagen()">
                </div>
                <div class="col">
                    <label style="color:#000;" for="musicaProducto">Demo del lp:</label>
                    <input class="form-control" type="file" id="musicaProducto"  name="musicaProducto" accept=".mp3,.aac,.flac,.wav" onchange="validarMusica()">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label style="color:#000;" for="descipcion">Listado de canciones:</label>
                    <textarea id="texto" class="form-control" placeholder="*" onchange="obtenerInfo()"></textarea>
                    <input class="form-control" type="text" id="descripcion" name="descripcion" hidden>
                </div>
            </div>
            <div class="row my-3">
                <div class="col">
                    <button class="btn btn-secondary" type="button" onclick="validarTodo()">Registrar</button>
                    <input class="btn btn-secondary" type="button" value="Cancelar" onclick="window.location='./productoAdmin.php'">
                </div>
            </div>
        </form>
    </div>
    <script src="./validarProductos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <!-- Toastr -->
    <script src="../plugins/toastr/toastr.min.js"></script>
</body>
</html>
