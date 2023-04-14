<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/pop.css">
    <script src="https://kit.fontawesome.com/f57beba7b3.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Productos Pop</title>
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
            $consulta->execute([":idCategoria" => 2, ":estado" =>1]);
            $productos = $consulta->fetchAll(PDO::FETCH_ASSOC);

        }catch(Exception $ex){
            echo 'Error en los producto'.$ex;
        }
    ?>
    <div class="category-pop">
        <h2>POP</h2>
    </div>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <input type="text" id="nombreBuscar" name="nombre" class="form-control" placeholder="Buscar producto" onkeyup="productoBuscar()">
                </div>
            </div>
            <div id="divProductos" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mt-3">
                <?php
                    foreach($productos as $x => $x_values){
                        echo'
                            <div class="col">
                                <div class="card shadow p-3 mb-5 bg-white rounded"  style="height:100%; border: 2px solid #4C1D7A">
                                    <img src="../assets/Images/Pop/'.$x_values['imagen'].'">
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
                                
                                        <form action="../componentesCarrito/agregarProductoCarrito.php" onsubmit="return validar()" method="POST">
                                        <input name="idProducto" value="'.$x_values['idProducto'].'" hidden>
                                        <input name="nombreFormulario" value="pop" hidden>
                                        <label for="number">Cantidad: </label>
                                        <input type="number" id="number" name="cantidad" onchange="validar()">
                                            <button class="btn btn-success">Agregar</button>
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
    <div class="contenedor">
        <input type="checkbox" id="btn-mas">
        <div class="redes">
            <img src="../images/jazz-jazz-svgrepo-com.svg" alt="" id="toJazz">
            <img src="../images/guitar-svgrepo-com.svg" alt="" id="toRock">
        </div>
        <div class="btn-mas">
            <label for="btn-mas" class="fa fa-plus"></label>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="./pop2.js"></script>
</body>
</html>