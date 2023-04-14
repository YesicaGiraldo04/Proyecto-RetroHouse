<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/registro.css" type="text/css">
    <!-- toastr -->
    <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
    <title>Página de usuario</title>
</head>
<body>
    <?php
        require '../assets/header.php';
        // (Jose) verificando que se haya iniciado sesión para poder acceder a la pesta y a la información del usuario
        
        if(!empty($_SESSION['user_id'])){
            require '../Database/databaseConn.php';
            // (Jose) Recogemos los datos del usuario

            $records = $conn->prepare('SELECT * FROM usuario WHERE documentoCliente = :documentoCliente');
            $records->bindParam(':documentoCliente',$_SESSION['user_id']);
            $records->execute();

            // (Jose) almacenamos todos los datos recogidos de la busqueda

            $results = $records->fetch(PDO::FETCH_ASSOC);

        }else{ // (Jose) en caso de no haberse iniciado sesión lo mandara para el login
            echo '<script>alert("Inicia sesión para acceder a esta página.");
            window.location="../Login/login.php" </script>';
        }
    ?>

    
    <div style="display:flex;" class="container" id="advanced-search-form">
        <form  action="./guardarImagen.php" method="POST" name="formImagen" enctype="multipart/form-data">
                <h1 style="margin-left: 30%; margin-right: 30%; margin-top:5%; margin-bottom: 0%;">Foto de perfil</h1>
                <img style="width: 50%; clip-path:circle(30% at 50% 50%); margin: 0% 25%;" id="imagenUsuario" src="./imagenUsuario/<?php echo $results['imagenPerfil'] ?>" alt="No encontrada">
                <input type="file" id="imagen" name="imagen" accept=".png,.jpg,.jpeg,.gif" style="border: solid; border-radius: 10px;border-color: #5c5c5c; background-color:#5c5c5c; width: 70%; margin: 0% 15%;" onchange="validarImagen()">
                <button type="button" onclick="validarImagen()">Actualizar</button>
        </form>
        <form form action="./modificar.php"  method="POST" name="formulario1">
            <input style="display:none;" type="text" name="emailH" id="emailH" value="<?php echo $results['email'];?>" readonly>
            <div class="form">
                <h1>Modificar datos</h1>
                <div class="grupo">
                    <input type="text" id="name" name="name" value="<?php echo $results['nombreCompleto'];?>" onchange="validarNombre()"><span class="barra">
                    </span><label for="name">Nombre</label>
                </div>
                <div class="grupo">
                    <p style="margin-left: 5px; font-size:110%;">Documento</p>
                    <input type="text" id="documento" name="idUsuario" value='<?php echo $_SESSION["user_id"];?>'  maxlength="11" readonly onclick="validarDocumento()"><span class="barra"></span>
                    
                </div>
                <div class="grupo">
                    <p style="margin-left: 5px; font-size:110%;">Ciudad</p>
                    <select name="city" id="city" style="position:relative">
                        <option value="Medellín" <?php if($results['ciudad'] == "Medellín"){ echo "selected";}?>>Medellín</option>
                        <option value="Bello" <?php if($results['ciudad'] == "Bello"){ echo "selected";}?>>Bello</option>
                        <option value="Itagüí" <?php if($results['ciudad'] == "Itagüí"){ echo "selected";}?>>Itagüí</option>
                        <option value="Sabaneta" <?php if($results['ciudad'] == "Sabaneta"){ echo "selected";}?>>Sabaneta</option>
                        <option value="La estrella" <?php if($results['ciudad'] == "La estrella"){ echo "selected";}?>>La estrella</option>
                        <option value="Envigado" <?php if($results['ciudad'] == "Envigado"){ echo "selected";}?>>Envigado</option>
                    </select>
                </div>
                <div class="grupo">
                    <input type="text" id="direccion" name="direccion" value="<?php echo $results['direccion'];?>"><span class="barra"></span>
                    <label for="direccion">Dirección</label>
                </div>
                <div class="grupo">
                    <input type="text" id="celular" name="number" value="<?php echo $results['celular'];?>" maxlength="10" onchange="validarNumero('celular')"><span class="barra"></span>
                    <label for="number">Celular:</label>
                </div>
                <div class="grupo">
                    <input type="text" id="email" name="email" value="<?php echo $results['email'];?>" onchange="validarEmail()"><span class="barra"></span>
                    <label for="email">Email</label>
                </div>
                <button type="button" onclick="validarTodo()">Modificar</button>
                <button type="button" onclick="window.location='../Landing/index.php'">Regresar</button>
            </div>
        </form>
    </div>
    <script src="verificacion.js"></script>
    <!-- Toastr -->
    <script src="../plugins/toastr/toastr.min.js"></script>
</body>
</html>