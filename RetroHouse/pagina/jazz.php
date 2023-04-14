
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/jazz.css">
    <script src="https://kit.fontawesome.com/f57beba7b3.js" crossorigin="anonymous"></script>
    <title>Productos Jazz</title>
</head>
<body>
    <?php
        require '../assets/header.php';
        require '../Database/databaseConn.php';

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

        try{    
            
            $consulta = $conn->prepare("SELECT * FROM producto WHERE idCategoria = :idCategoria AND estado = :estado");
            $consulta->execute([":idCategoria" => 3, ":estado" =>1]);
            $productos = $consulta->fetchAll(PDO::FETCH_ASSOC);

        }catch(Exception $ex){
            echo 'Error en los producto'.$ex;
        }
    ?>
    <main>
        <div class="category.jazz">
            <h2>JAZZ</h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <input type="text" id="nombreBuscar" name="nombre" class="form-control" placeholder="Buscar producto" onkeyup="productoBuscar()">
                </div>
            </div>
            <div id="divProductos" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mt-3">
                <?php
                    $formNum = 0;
                    foreach($productos as $x => $x_values){
                        echo'
                            <div id="productos" class="col">
                                <div class="card shadow p-2 mb-5 bg-white rounded" style="height:100%; border: 2px solid rgb(181, 141, 79)">
                                    <img src="../assets/Images/Jazz/'.$x_values['imagen'].'">
                                    <div class="card-body" style="height:50px;">
                                        <h5 class="card-title" style="text-align:center;">'.$x_values['nombreProducto'].'</h5>   
                                    </div>
                                    <div class="ps-4">
                                        <p >Disponible: '.$x_values['cantidad'].'</p>
                                        <p class="card-precio">Precio: $'.$x_values['precio'].'</p>
                                    </div>
                                    <div class="d-flex mx-auto pb-3 gap-5 ">
                                        <form action="./detalleProducto.php" method="POST">
                                            <input name="idProducto" value="'.$x_values['idProducto'].'" hidden>
                                            <button class="btn btn-primary">Detalles</button>
                                        </form>
                                
                                        <form  action="../componentesCarrito/agregarProductoCarrito.php" onsubmit="return validar()" method="POST">
                                        <input name="idProducto" value="'.$x_values['idProducto'].'" hidden>
                                        <input name="nombreFormulario" value="jazz" hidden>
                                        <label for="number">Cantidad: </label>
                                        <input type="number" id="number" name="cantidad" onchange="validar()">
                                            <button class="btn btn-success" onclick="validarTodo(".$formName.")">Agregar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                ?>
            </div>
        </div>
    </main>
                    
    <div class="contenedor">
        <input type="checkbox" id="btn-mas">
        <div class="redes">
            <img src="../images/guitar-svgrepo-com.svg" alt="" id="toRock">
            <img src="../images/microphone-svgrepo-com.svg" alt="" id="toPop">
        </div>
        <div class="btn-mas">
            <label for="btn-mas" class="fa fa-plus"></label>
        </div>
    </div>
    <script>
        function validar(){
            let valor = document.getElementById('number').value;
            let pattern = /^[0-9]+$/;
            if(!pattern.test(valor)){
                alert("No se permiten números negativos, ni letras en cantidad.");
                return false;
            }
            return true;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="./jazz.js"></script>
</body>
</html>