<?php
session_start();
if (isset($_SESSION['user_id']) ) {
    if ($_SESSION['user_rol'] == 2) {
        echo "<script> alert('No puedes estar en esta página.');
        window.location='../Landing/index.php'</script>";
    }
}
require '../Database/databaseConn.php';

    $id = $_POST['id'];
    $querySelect = $conn->prepare("SELECT * FROM usuario WHERE documentoCliente = :documentoCliente");
    $querySelect->execute(['documentoCliente' => $id]);
    $results = $querySelect->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar</title>
    <link rel="stylesheet" href="../css/registro.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,800,900" rel="stylesheet">
    <!-- toastr -->
    <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
    <!-- JqueryCampana -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    
</head>

<body>
    <header>
        <div class="title">
            <h1>RetroHouse</h1>
        </div>
        <div style="display: flex;">
            <a id="campana" href="./productoAdmin.php"></a>
            <?php
            if(!empty($_SESSION['imagenPerfil'])){
                echo '<a href="#" class="px-3 text-light perfil dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img width="40" height="40" style="clip-path: circle(50% at 50% 50%); margin-right: 1%;" src="../usuario/imagenUsuario/'.$_SESSION['imagenPerfil'].'" id="user_image"></a>';
            }else{
                echo'<a href="#" style="margin-right: 10px;" class="px-3 text-light perfil dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle user"></i></a>';
            }
            ?>

            <div class="dropdown-menu" aria-labelledby="navbar-dropdown">
                <a href="../Database/logout.php" style="margin-left: 20%; margin-right:10%; text-decoration:none; color:#fff;" style="text-decoration: none;">
                <svg width="36px" height="36px" viewBox="0 0 24.00 24.00" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M16 16.9998L21 11.9998M21 11.9998L16 6.99982M21 11.9998H9M12 16.9998C12 17.2954 12 17.4432 11.989 17.5712C11.8748 18.9018 10.8949 19.9967 9.58503 20.2571C9.45903 20.2821 9.31202 20.2985 9.01835 20.3311L7.99694 20.4446C6.46248 20.6151 5.69521 20.7003 5.08566 20.5053C4.27293 20.2452 3.60942 19.6513 3.26118 18.8723C3 18.288 3 17.5161 3 15.9721V8.02751C3 6.48358 3 5.71162 3.26118 5.12734C3.60942 4.3483 4.27293 3.75442 5.08566 3.49435C5.69521 3.29929 6.46246 3.38454 7.99694 3.55503L9.01835 3.66852C9.31212 3.70117 9.45901 3.71749 9.58503 3.74254C10.8949 4.00297 11.8748 5.09786 11.989 6.42843C12 6.55645 12 6.70424 12 6.99982" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                </a>
            </div>
        </div>
    </header>
    <div class="container" id="advanced-search-form">
        <form action="../Database/actualizarUser.php" method="post" name="formRegistro" id="form" onsubmit="return validarTodo2()">
            <div class="form">
                <h1>Actualizar Datos</h1>
                <div class="grupo">
                    <input type="text" name="name" id="name" value="<?php echo $results['nombreCompleto'];?>" onchange="validarNombre()" required><span class="barra"></span>
                    <label>Nombre completo</label>
                </div>
                <div class="grupo">
                    
                <p style="margin-left: 5px; font-size:110%;">Ciudad</p>
                    <input type="text" name="DNI" value="<?php echo $results['documentoCliente'];?>" readonly onchange=" validarNumero()" id="dni" maxlength="11"><span class="barra"></span>
                    
                </div>
                <div class="grupo">
                    <p style="margin-left: 5px; font-size:110%;">Ciudad</p>
                    <select name="city" id="city" style="position:relative;">
                        <option value="Medellín" <?php if($results['ciudad'] == "Medellín"){ echo "selected";}?>>Medellín</option>
                        <option value="Bello" <?php if($results['ciudad'] == "Bello"){ echo "selected";}?>>Bello</option>
                        <option value="Itagüí" <?php if($results['ciudad'] == "Itagüí"){ echo "selected";}?>>Itagüí</option>
                        <option value="Sabaneta" <?php if($results['ciudad'] == "Sabaneta"){ echo "selected";}?>>Sabaneta</option>
                        <option value="La estrella" <?php if($results['ciudad'] == "La estrella"){ echo "selected";}?>>La estrella</option>
                        <option value="Envigado" <?php if($results['ciudad'] == "Envigado"){ echo "selected";}?>>Envigado</option>
                    </select>
                </div>
                <div class="grupo">
                    <input type="text" name="address" id="address" value="<?php echo $results['direccion'];?>" required><span class="barra"></span>
                    <label>Dirección</label>
                </div>
                <div class="grupo">
                    <input type="text" name="number" value="<?php echo $results['celular'];?>" onchange="validarNumero2()" id="number" maxlength="10" required><span class="barra"></span>
                    <label>Celular</label>
                </div>
                <div class="grupo">
                    <input type="email" name="email" id="email" value="<?php echo $results['email'];?>" onchange="validarEmail()" required><span class="barra"></span>
                    <label class="email">Correo Electrónico</label>
                </div>
                <input type="email" name="emailG" value="<?php echo $results['email'];?>" hidden style="display: none;">
                
                <button type="submit" id="enviar">Guardar Cambios</button>
        </form>
                
                <button type="button" onclick="window.location = '../Admin/modUsuario.php'">Regresar</button>
            </div>
    </div>
    <!-- Toastr -->
    <script src="../plugins/toastr/toastr.min.js"></script>

    <script>
        // document.getElementById('enviar').addEventListener('click', () =>{
        //     alert("It works")
        // })
        function verifyToAddStyles() {
        let confirmPassword = document.getElementById('confirmPwd').value;
        let password = document.getElementById('pwd').value;
        let label = document.getElementById('labelPwd');
        if (password !== confirmPassword) {
            label.style.color = "#F00";
        }else{
            label.style.color = "#302d04";
        }
        }

        function validarNombre() {
        let nombre = document.getElementById('name').value;
        const patternName = /^[a-zA-ZáéíóúñÑÁÉÍÓÚ\s]+$/;
        toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }
        if (!patternName.test(nombre)) {
        nombre.value = "*";
        toastr['info']("El nombre ingresado no es válido", "Nombre Completo")
        return false
        }
        }

        function validarNumero() {
        let dni = document.getElementById('dni').value;
        toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }
        const patternNumber = /^[0-9]+$/;
        if (!patternNumber.test(dni)) {
        toastr['info']("El documento no puede contener letras.", "Documento");
        return false;
        }
        if(dni.length < 6){
        toastr['info']("El documento debe de tener mínimo seis dígitos.", "Documento")
        }else{
            return true;
        }
        }

        function validarNumero2() {
        let celular = document.getElementById('number').value;
        toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }


        const patron = /^[0-9]+$/;
        if (!patron.test(celular)) {
        toastr['info']("El celular no puede contener letras.", "Celular");
        return false;
        }else if(celular.length < 10){
        toastr['info']("El celular debe tener mínimo 10 números", "Celular");
        return false;
        }else{
        return true;
        }

        }

        function validarPassword() {
        const password = form.elements.pwd.value;
        const confirmPwd = form.elements.confirmPwd.value;
        toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }
        if (password.length < 8) {
        toastr['info']("La contraseña debe de contener mínimo 8 caracteres.", "Contraseña")
        return false;
        }else if(password !== confirmPwd){
        toastr['info']("Las contraseñas deben de coincidir.", "Confirmar Contraseña")
        return false;
        }

        return true;
        }



        function validarTodo2(){
            let email = form.elements.email.value;
            let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        let celular = document.getElementById('number').value;
        let dni = document.getElementById('dni').value;
        let nombre = document.getElementById('name').value;
        let ciudad = document.getElementById('city').value;
        const patternName = /^[a-zA-ZáéíóúñÑÁÉÍÓÚ\s]+$/;

        // Configuramos los estilos de las alertas
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        if (!patternName.test(nombre)) {
            nombre.value = "*";
            toastr['info']("El nombre ingresado no es válido", "Nombre Completo")
            return false
        }
        const patternNumber = /^[0-9]+$/;
        if (!patternNumber.test(dni)) {
            toastr['info']("El documento no puede contener letras.", "Documento");
            return false;
        }
        if(dni.length < 6){
            toastr['info']("El documento debe de tener mínimo seis dígitos.", "Documento")
            return false
            }
        const patron = /^[0-9]+$/;
        if (!patron.test(celular)) {
            toastr['info']("El celular no puede contener letras.", "Celular");
            return false;
        }else if(celular.length < 10){
            toastr['info']("El celular debe tener mínimo 10 números", "Celular");
            return false;
        }
        if (password.length < 8) {
            toastr['info']("La contraseña debe de contener mínimo 8 caracteres.", "Contraseña")
            return false;
        }
        if(password !== confirmPwd){
            toastr['info']("Las contraseñas deben de coincidir.", "Confirmar Contraseña")
            return false;
        }
        if(ciudad == "N/N"){
            toastr['info']("Seleccionar una ciudad", "Ciudad");
            return false;
        }
        if(!emailRegex.test(email)){
        toastr['info']("El Email ingresado es inválido", "Correo Electrónico");
        return false;
        }

        return true;
        };


        function validarEmail() {
        // Expresión regular para validar el formato del email
        const email = form.elements.email.value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if(!emailRegex.test(email)){
        toastr['info']("El Email ingresado es inválido", "Correo Electrónico");
        return;
        }
        }
    </script>
    <!-- Campana -->
    <script>
        $.ajax({
                data:{function: "1"},
                url:"../assets/prueba.php",
                method:"POST",
                success:function(message){
                    $("#campana").html(message);
                }
            });
        setInterval(function(){
            $.ajax({
                data:{function: "1"},
                url:"../assets/prueba.php",
                method:"POST",
                success:function(message){
                    $("#campana").html(message);
                }
            });
            }, 5000)
    </script>
</body>

</html>