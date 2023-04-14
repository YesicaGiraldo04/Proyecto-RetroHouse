<?php
require '../Database/databaseConn.php';
$message = "";

if (!empty($_POST['name']) && !empty($_POST['DNI']) && !empty($_POST['city']) && !empty($_POST['address']) && !empty($_POST['number']) && !empty($_POST['email']) && !empty($_POST['password'])){
    $DNI = $_POST['DNI'];
    $DNI = htmlentities($DNI);
    $email = $_POST['email'];
    $email = htmlentities($email);
    $querySelect = $conn->prepare("SELECT * FROM usuario WHERE documentoCliente = :documentoCliente UNION SELECT * FROM usuario WHERE email = :email");
    $execute = $querySelect->execute(['documentoCliente' => $DNI,
                                        'email' => $email]);
    $results = $querySelect->fetch();
    if(!empty($results)){
        if($results['documentoCliente'] == $DNI){
            $message = "El usuario ya existe.";
            echo "<script> alert('".$message."')
            </script>";
        }elseif ($results['email'] == $email) {
            $message = "Ya existe un usuario con ese correo electrónico.";
            echo "<script> alert('".$message."')
            </script>";
            
        }
    }else{
        $user = htmlentities($_POST['name']);

        $documento = htmlentities($_POST['DNI']);

        $city = htmlentities($_POST['city']);
        
        $address = htmlentities($_POST['address']);
        
        $number = htmlentities($_POST['number']);
        
        $email = htmlentities($_POST['email']);

        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $password = htmlentities($password);

        $sql = "INSERT INTO usuario (documentoCliente, nombreCompleto, ciudad, direccion, celular, password, email, idRol, estado) VALUES (:documentoCliente, :nombreCompleto, :ciudad, :direccion, :celular, :password, :email, 1, 1);";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':documentoCliente', $documento);
        $stmt->bindParam(':nombreCompleto', $user);
        $stmt->bindParam(':ciudad', $city);
        $stmt->bindParam(':direccion', $address);
        $stmt->bindParam(':celular', $number);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            $message = "Usuario creado con éxito";
            echo "<script> alert('".$message."')
            window.location='../Landing/index.php'
            </script>";
        } else {
            $message = "Lo sentimos, error al registrarse.";
            echo "<script> alert('".$message."')</script>";
        }
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Creear Cuenta</title>
    <!-- toastr -->
    <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
<link rel="stylesheet" href="../css/registro.css">
<link href="https://fonts.googleapis.com/css?family=Poppins:400,800,900" rel="stylesheet">
</head>
<body>
<?php
    require '../assets/header.php';
?>
<div class="container" id="advanced-search-form">
    <form action="./aggAdmin.php" method="post" name="formRegistro" id="form" onsubmit="return validarTodo()">
            <div class="form">
                <h1>Crear Cuenta</h1>
                <div class="grupo">
                    <input type="text" name="name" id="name" onchange="validarNombre()" required><span class="barra"></span>
                    <label>Nombre completo</label>
                </div>
                <div class="grupo">
                    <input type="text" name="DNI" onchange=" validarNumero()" id="dni" maxlength="11" required><span class="barra"></span>
                    <label>Documento</label>
                </div>
                <div class="grupo">
                    <p style="margin-left: 5px; font-size:110%;">Ciudad</p>
                    <select name="city" id="city" style="position:relative;">
                        <option value="N/N" selected>Seleccionar</option>
                        <option value="Medellín">Medellín</option>
                        <option value="Bello">Bello</option>
                        <option value="Itagüí">Itagüí</option>
                        <option value="Sabaneta">Sabaneta</option>
                        <option value="La estrella">La estrella</option>
                        <option value="Envigado">Envigado</option>
                    </select>
                </div>
                <div class="grupo">
                    <input type="text" name="address" id="address" required><span class="barra"></span>
                    <label>Dirección</label>
                </div>
                <div class="grupo">
                    <input type="text" name="number" onchange="validarNumero2()" id="number" maxlength="10" required><span class="barra"></span>
                    <label>Celular</label>
                </div>
                <div class="grupo">
                    <input type="email" name="email" id="email" onchange="validarEmail()" required><span class="barra"></span>
                    <label class="email">Correo Electrónico</label>
                </div>
                <div class="grupo">
                    <input type="password" name="password" id="pwd" required> <span class="barra"></span>
                    <label>Contraseña</label>
                </div>
                <div class="grupo">
                    <p class="mensaje"></p>
                </div>
                <div class="grupo">
                    <input type="password" name="" id="confirmPwd" required oninput="verifyToAddStyles()" ><span class="barra"></span>
                    <label id="labelPwd">Confirmar Contraseña</label>
                </div>
                <div class="checkbox">
                    <p style="color:black;padding-left:20px;"><input style="opacity:1;" type="checkbox" required name="terminos">Aceptar los <a style="color:blue;" href="#">Términos y Condiciones</a></p>
                </div>
                
                <button type="submit" id="enviar">Crear Cuenta</button>
                <button type="button"><a href="../Admin/modUsuario.php" style="text-decoration: none; color: #fff;">Cancelar</a></button>
            </div>
        </form>
</div>
    <!-- Toastr -->
    <script src="../plugins/toastr/toastr.min.js"></script>
<script src="./main.js"></script>
</body>
</html>