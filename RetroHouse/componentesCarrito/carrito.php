<?php
//require './Database/databaseConn.php';
try {
    require '../assets/header.php';
} catch(Exception $e) {
    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/carrito.css" type="text/css">
    <title>RetroHouse</title>
</head>
<body>
    <a href="../Landing/index.php" class=" btn btn-dark m-2">Regresar</a>
    
        <?php
         require("./consultarCarrito.php");

         if(isset($_GET["mensaje"])){
            $mensaje = $_GET["mensaje"];
            echo "<script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

                $alerta = "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Proceso completado exitosamente',
                        text: '$mensaje',
                    })
                </script>";

            echo $alerta;
        }

        if(isset($_GET["alerta"])){
            $mensaje = $_GET["alerta"];
            echo "<script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

            $alerta = "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Ocurrió un error',
                    text: '$mensaje',
                })
            </script>";

            echo $alerta;
        }
         
         ?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>