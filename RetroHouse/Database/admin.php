<?php
require './databaseConn.php';
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT documentoCliente, email, password, idRol FROM usuario WHERE email=:email;');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    // Va a recorrer toda la consulta y lo almacena en una variable
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = "";
  // Va a verificar la contraseña del formulario con la de la base de datos
    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      // Almacenar el id del usuario como user_id
        $_SESSION['user_id'] = $results['documentoCliente'];
        echo $_SESSION['user_id'];
    }else {
        $message = 'Usuario y/o contraseña incorrecta, Vuelve a intentarlo o selecciona <span style="color: #393f81">"¿Olvidaste tu contraseña?" </span> para cambiarla.';
    }
}
