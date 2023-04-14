<?php
    require "../Database/databaseConn.php";
    if (empty($_POST['nombre'])){
        $consulta = $conn->prepare("SELECT * FROM producto WHERE idCategoria = :idCategoria AND estado = :estado");
        $consulta->execute([":idCategoria" => 1, ":estado" =>1]);
        $productos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        foreach($productos as $x => $x_values){
            echo'
                <div class="col">
                    <div class="card shadow p-3 mb-5 bg-white rounded"  style="height:100%; border: 2px solid rgba(217, 104, 1, .6)">
                        <img src="../assets/Images/Rock/'.$x_values['imagen'].'">
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
                                <input name="nombreFormulario" value="rock" hidden>
                                <label for="number">Cantidad: </label>
                                <input type="number" id="number" name="cantidad" onchange="validar()">
                                <button class="btn btn-success">Agregar</button>
                            </form>
                        </div>
                    </div>
                </div>
            ';
        }
    }else{
        $nombreProducto = $_POST['nombre'];
        $consulta = $conn->prepare("SELECT * FROM producto WHERE idCategoria = :idCategoria AND estado = :estado AND nombreProducto LIKE '%$nombreProducto%'");
        $consulta->execute([":idCategoria" => 1, ":estado" =>1]);
        $productos = $consulta->fetchAll(PDO::FETCH_ASSOC);

        if($productos == true){
            foreach($productos as $x => $x_values){
                        echo'
                            <div class="col">
                                <div class="card shadow p-3 mb-5 bg-white rounded"  style="height:100%; border: 2px solid rgba(217, 104, 1, .6)">
                                    <img src="../assets/Images/Rock/'.$x_values['imagen'].'">
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
                                            <input name="nombreFormulario" value="rock" hidden>
                                            <label for="number">Cantidad: </label>
                                            <input type="number" id="number" name="cantidad" onchange="validar()">
                                            <button class="btn btn-success">Agregar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
        }else{
            echo "No se encontro nada";
        }
    }
?>