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
    <title>Registro Proveedor</title>
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
        <form action="ejecutarProveedor.php" method="POST" name="proveedor">
            <div class="row">
                <div class="col-sm-12">
                    <label style="color:#000;" for="nombreProveedor">Nombre del proveedor:</label>
                    <input class="form-control" type="text" id="nombreProveedor" name="nombreProveedor" placeholder="*" >
                </div>
                <div class="col-sm-12">
                    <label style="color:#000;" for="telefono">Teléfono del proveedor: </label>
                    <input class="form-control" type="text" id="teléfono" name="telefonoProveedor" placeholder="*" minlength="10" maxlength="15" onchange="validarNumero('teléfono')">
                </div>
                <div class="col-sm-12">
                    <label style="color:#000;" for="email">Correo Electrónico</label>
                    <input class="form-control" type="text" id="correoProveedor" name="email" placeholder="*" onchange="validarEmail()">
                </div>
                
            <div class="row my-3">
                <div class="col">
                    <button class="btn btn-secondary" type="button" onclick="validarTodo3()">Registrar</button>
                    <input class="btn btn-secondary" type="button" value="Cancelar" onclick="window.location='./proveedoresAdmin.php'">
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="./validarProductos.js"></script>
    <!-- Toastr -->
    <script src="../plugins/toastr/toastr.min.js"></script>
</body>
</html>