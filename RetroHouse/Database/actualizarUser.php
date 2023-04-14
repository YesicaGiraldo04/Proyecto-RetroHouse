<?php
session_start();
if (isset($_SESSION['user_id']) ) {
    if ($_SESSION['user_rol'] == 2) {
        echo "<script> alert('No puedes estar en esta página.');
        window.location='../Landing/index.php'</script>";
    }
}
require '../Database/databaseConn.php';

    // (Jose) Traemos la conexión a la base de datos
    require '../Database/databaseConn.php';

    // (Jose) Preguntamos sí hay un id de usuario para poder modificar, en caso contrario lo manda nuevamente a la pagina de usuario.

        // (Jose) Guardamos todos los datos del formulario en variables que vamos a utilizar más adelante.
        $emailGuia = htmlentities($_POST['emailG']);
        $documentoUsuario = htmlentities($_POST['DNI']);
        $ciudad = htmlentities($_POST['city']);
        $nombreUsuario = htmlentities($_POST['name']);
        $direccion = htmlentities($_POST['address']);
        $numero = htmlentities($_POST['number']);
        $email = htmlentities($_POST['email']);

        $coincidenciaEmail = false;
        $coincidenciaDocumento = false;

        // (Jose) Realizamos una consulta para verificar que el correo y el documento que se cambia no exista en otro usuario.
        $consulta = $conn->prepare("SELECT email FROM usuario WHERE email = :email;");
        $consulta->execute([":email" => $email]);
        $resultado = $consulta->fetchColumn();

        // (Jose) Verificamos si se desea cambiar el correo
        if($emailGuia == $email){
            try{
                $update = $conn->prepare('UPDATE usuario SET nombreCompleto = :nombreCompleto, celular = :celular, email = :email, ciudad= :ciudad, direccion = :direccion WHERE documentoCliente = :documentoCliente');
                $update->execute(['nombreCompleto'=> $nombreUsuario,'celular'=> $numero,'ciudad'=>$ciudad,'direccion'=>$direccion, "email" => $email,'documentoCliente'=>$documentoUsuario]);
                echo"<script>alert('Se han modificado los datos correctamente.');
                window.location='../Admin/modUsuario.php';</script>";
            } catch (Exception $ex){
                echo "$ex";
            }
        }else{
            if($resultado == $email){
                echo"<script>alert('El correo ingresado ya está registrado.');
                window.location='../Admin/editarUsuario.php';</script>";
            }else{
                try{
                    $update = $conn->prepare('UPDATE usuario SET nombreCompleto = :nombreCompleto, celular = :celular, email = :email, ciudad= :ciudad, direccion = :direccion WHERE documentoCliente = :documentoCliente');
                    $update->execute(['nombreCompleto'=> $nombreUsuario,'celular'=> $numero,'ciudad'=>$ciudad,'direccion'=>$direccion, "email" => $email,'documentoCliente'=>$documentoUsuario]);
                    echo"<script>alert('Se han modificado los datos correctamente.');
                    window.location='../Admin/modUsuario.php';</script>";
                } catch (Exception $ex){
                    echo "$ex";
                }
            }
        }

?>