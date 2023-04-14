<?php 
    // (Jose) Traemos la conexión a la base de datos
    require '../Database/databaseConn.php';

    // (Jose) Preguntamos sí hay un id de usuario para poder modificar, en caso contrario lo manda nuevamente a la pagina de usuario.

    if(!empty ($_POST['idUsuario'])){
        // (Jose) Guardamos todos los datos del formulario en variables que vamos a utilizar más adelante.
        $emailGuia = htmlentities($_POST['emailH']);
        $documentoUsuario = htmlentities($_POST['idUsuario']);
        $ciudad = htmlentities($_POST['city']);
        $nombreUsuario = htmlentities($_POST['name']);
        $direccion = htmlentities($_POST['direccion']);
        $numero = htmlentities($_POST['number']);
        $email = htmlentities($_POST['email']);

        $coincidenciaEmail = false;
        $coincidenciaDocumento = false;

        // (Jose) Realizamos una consulta para verificar que el correo y el documento que se cambia no exista en otro usuario.
        $consulta = $conn->prepare("SELECT email FROM usuario WHERE email = :email;");
        $consulta->execute([":email" => $email]);
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

        // (Jose) Verificamos si se desea cambiar el correo
        if($emailGuia == $email){
            try{
                $update = $conn->prepare('UPDATE usuario SET nombreCompleto = :nombreCompleto, celular = :celular, email = :email, ciudad= :ciudad, direccion = :direccion WHERE documentoCliente = :documentoCliente');
                $update->execute(array(':nombreCompleto'=> $nombreUsuario,':celular'=> $numero,':ciudad'=>$ciudad,':direccion'=>$direccion, ":email" => $email,':documentoCliente'=>$documentoUsuario));
                echo"<script>alert('Se han modificado los datos correctamente.');
                window.location='./paginaUsuario.php';</script>;";
            } catch (Exception $ex){
                echo "$ex";
            }
        }else{
            if(isset($resultado['email']) && $resultado['email'] == $email){
                echo"<script>alert('El correo ingresado ya está registrado.');
                window.location='./paginaUsuario.php';</script>";
            }else{
                try{
                    $update = $conn->prepare('UPDATE usuario SET nombreCompleto = :nombreCompleto, celular = :celular, email = :email, ciudad= :ciudad, direccion = :direccion WHERE documentoCliente = :documentoCliente');
                    $update->execute(array(':nombreCompleto'=> $nombreUsuario,':celular'=> $numero,':ciudad'=>$ciudad,':direccion'=>$direccion, ":email" => $email,':documentoCliente'=>$documentoUsuario));
                    echo"<script>alert('Se han modificado los datos correctamente.');
                    window.location='./paginaUsuario.php';</script>";
                } catch (Exception $ex){
                    echo "$ex";
                }
            }
        }
    }else{
       echo '
        <script>
            alert("No se ha detectado un usuario para modificar");
            window.location="./paginaUsuario.php";
        </script>
       '; 
    }