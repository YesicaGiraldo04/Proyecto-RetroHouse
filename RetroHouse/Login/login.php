<?php
session_start();
// Preguntamos si ya inició la sesión
if (isset($_SESSION['user_id'])) {
  echo "<script> alert('Ya iniciaste sesión, vuelve al inicio');
  window.location='../Landing/index.php'</script>";
}

require '../Database/databaseConn.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
  // (Jose) Creamos un try por si acaso el cliente no se ha registrado
    $records = $conn->prepare('SELECT documentoCliente, email, estado, password, idRol, imagenPerfil FROM usuario WHERE email=:email;');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    // Va a recorrer toda la consulta y lo almacena en una variable
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = "";
    if($results == true && $results['estado'] == 1){
          // Va a verificar la contraseña del formulario con la de la base de datos
        if ($results == true && count($results) > 0 && (password_verify($_POST['password'],$results['password'])) && $results['idRol'] == 1) { // (Jose) agrego la desencriptación para verificar que si sean las mismas contraseñas
          // Almacenar el id del usuario como user_id
            $_SESSION['user_id'] = $results['documentoCliente'];
          // (Jose) Almacenar el rol del usuario como  user_rol
            $_SESSION['user_rol'] = $results['idRol'];
          //(Jose) Guardamos la imagen de perfil si la hay
            $_SESSION['imagenPerfil']= $results['imagenPerfil'];
            header('Location: ../Landing/index.php');
        }elseif ( $results == true && count($results) > 0 && (password_verify($_POST['password'],$results['password'])) && $results['idRol'] == 2) {
            $_SESSION['user_id'] = $results['documentoCliente'];
            $_SESSION['user_rol'] = $results['idRol'];
            $_SESSION['imagenPerfil']= $results['imagenPerfil'];
            header('Location: ../Landing/index.php');
        }
        else {
            $message = 'Usuario y/o contraseña incorrecta, Vuelve a intentarlo o selecciona <span style="color: #393f81">"¿Olvidaste tu contraseña?" </span> para cambiarla.';
        }
    }else{
      echo '<script> 
        alert("No puedes ingresar, usuario deshabilitado");
      </script>';
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <title>RetroHouse</title>
</head>
<body>
  <?php
  require '../assets/headerLogin.php';
  ?>
    <section class="login" >
        <div class="container py-5 h-75 pt-1" >
          <div class="row d-flex justify-content-center align-items-center">
            <div class="col col-xl-10">
              <div class="card  p-2" style="border-radius: 1rem;" id="form-container">
                <div class="row g-0">
                  <div class=" col-md-12 col-lg-12 d-flex align-items-center justify-content-center">
                    <div class="card-body p-2 p-lg-1 text-black text-center">
                      <form method="POST" action="./login.php">
                        <div class="d-flex align-items-center justify-content-center mb-3 pb-1">
                          <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                          <span class="h1 fw-bold mb-0">RetroHouse</span>
                        </div>
      
                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Iniciar Sesión</h5>
      
                        <div class="form-outline mb-4">
                          <label class="form-label" for="form2Example17">Correo electrónico</label>
                          <input type="email" id="email" name="email" class="form-control form-control-lg w-75 d-block m-auto" />
                        </div>
      
                        <div class="form-outline mb-4">
                          <label class="form-label" for="form2Example27">Contraseña</label>
                          <input type="password" id="password" name="password" class="form-control form-control-lg w-75 d-block m-auto" />
                        </div>
                        <?php
                        if (!empty($message)) {
                            echo '<p class="mb-5 pb-lg-2" style="color: #f00;">', $message, '</p>';
                        }
                        ?>
      
                        <div class="pt-1 mb-4">
                          <input class="btn btn-dark btn-lg btn-block" type="submit" value="Iniciar Sesión">
                          <input class="btn btn-dark btn-lg btn-block" type="button" onclick="window.location='../Landing/index.php'" value="Cancelar">
                        </div>

                        <p class="mb-5 pb-lg-2" style="color: #393f81;">¿No tienes una cuenta? <a href="../Registro/registro.php"
                            style="color: #393f81;">¡Regístrate aquí!</a></p>
                      </form>
      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>
</html>