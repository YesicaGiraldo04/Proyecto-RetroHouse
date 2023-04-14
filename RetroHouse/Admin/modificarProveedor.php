<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/agregarProducto.css">
    <!-- toastr -->
    <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
    <title>Modificar Proveedor</title>
</head>
<body>
    <?php 
        require "../assets/header.php";
        if(!empty($_SESSION['user_rol']) && $_SESSION['user_rol'] == 1){
            require "../Database/databaseConn.php";
            if(!empty($_POST['idProveedor'])){
                try{
                    $consulta = $conn->prepare("SELECT * FROM proveedor WHERE idProveedor = :idProveedor");
                    $consulta->execute([":idProveedor" => $_POST['idProveedor']]);
                    $proveedor = $consulta->fetch(PDO::FETCH_ASSOC);

                }catch(Exception $ex){
                    echo 'Error:'.$ex;
                }
            }else{
                echo"<script> alert('Error al detectar el id')
                    window.location='./proveedoresAdmin.php';
                </script>";
            }
        }else{
            echo"<script> alert('No tienes permisos para estar aquí.')
                window.location='./proveedoresAdmin.php';
            </script>";
        }

    ?>
    <div class="container" style="background-color: rgba(255, 255, 255, 0.8); margin-top: 3%;">
        <form action="./ejecutarModPro.php" method="POST" name="proveedor">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 my-3">
                    <input type="text" name="idProveedor" value="<?php echo $proveedor['idProveedor']; ?>" hidden>
                    <label class="form-label" for="nombreProveedor" style="color:#000;">Nombre del proveedor:</label>
                    <input class="form-control" type="text" id="nombreProveedor" name="nombreProveedor" value="<?php echo $proveedor['nombreProveedor'];?>">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 my-3">
                    <label class="form-label" for="telefono" style="color:#000;">Teléfono del proveedor:</label>
                    <input class="form-control" type="text" id="teléfono" name="telefonoProveedor" value="<?php echo $proveedor['telefonoProveedor'];?>" maxlength="15" onchange="validarNumero('teléfono')">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 my-3">
                    <label class="form-label" for="correoProveedor" style="color:#000;">Email del proveedor:</label>
                    <input class="form-control" type="email" id="correoProveedor" name="correoProveedor" value="<?php echo $proveedor['correoProveedor'];?>" required onchange="validarEmail()">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 my-3">
                    <button class="btn btn-secondary" type="button" onclick="validarTodo3()">Modificar</button>
                    <button class="btn btn-secondary" type="button" onclick="window.location='./proveedoresAdmin.php'">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
    <!-- Toastr -->
    <script src="../plugins/toastr/toastr.min.js"></script>
    <!-- sweetAlert2 -->
    <script src="validarProductos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>