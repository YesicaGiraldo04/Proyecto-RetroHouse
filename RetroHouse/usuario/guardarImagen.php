<?php
    session_start();

    // (Jose)Preguntamos si hay una sesión iniciada, en caso de que no, enviara al usuario al Login

    if(isset($_SESSION['user_id'])){

        // (Jose) Traemos la conexión a la base de datos
        require '../Database/databaseConn.php';

        // (Jose)Traemos la imagen cargada en la pagina de usuario y la copiamos en la carpeta imagenUsuario  
        copy($_FILES['imagen']['tmp_name'], './imagenUsuario/'.$_SESSION['user_id'].$_FILES['imagen']['name']);

        // (Jose)Almacenamos en $imagen el nombre del archivo de imagen junto con el identifiicador del usuario.
        $imagen = $_SESSION['user_id'].$_FILES['imagen']['name'];

        // (Jose) Iniciamos la variable $_SESSION['imagenPerfil'] para que permita cargar la imagen en el header apenas se execute este archivo.
        $_SESSION['imagenPerfil'] = $imagen;

        // (Jose) Realizamos la sentencia en sql que permite modificar la imagen del usuario para poderla recuperar en el momento de iniciar sesión
        $update = $conn->prepare('UPDATE usuario SET imagenPerfil = ? WHERE documentoCliente = ?');
        $update->execute([$imagen, $_SESSION['user_id']]);

        // (Jose) Se ejecuta una alerta avisando que la consulta salio bien.
        echo "
        <script>
            alert('Imagen actualizada correctamente');
            window.location='./paginaUsuario.php';
        </script>
        $imagen";
    }else{
        echo "
        <script>
            alert('No haz iniciado sesión.');
            window.location='../Login/login.php';
        </script>";
    }
