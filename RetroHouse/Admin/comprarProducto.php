<?php
    require "../Database/databaseConn.php";
    session_start();
    if(!$_SESSION['user_rol'] == 1){
        echo "<script>alert('No tienes los permisos para estar aquí.');
        window.location='../Login/login.php';</script>";
    }
    $_SESSION['numInput'] = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/dashboard.css">
    <!-- toastr -->
    <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
    <title>Comprar Porducto</title>
</head>
<body>
    <?php
        try{
            $consulta = $conn->prepare("SELECT * FROM proveedor WHERE estado = 1");
            $consulta->execute();
            $proveedores = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $ex){
            echo $ex;
        }
        if(!empty($_POST['selectCategoria'])){
            try{
                $consulta = $conn->prepare("SELECT nombreProducto, idProducto FROM producto WHERE idCategoria = ".$_POST['selectCategoria'].";");
                $consulta->execute();
                $productos = $consulta->fetchALL(PDO::FETCH_ASSOC);
            }catch(Exception $ex){
                echo $ex;
            }
        }else{
            try{
                $consulta = $conn->prepare("SELECT nombreProducto, idProducto FROM producto;");
                $consulta->execute();
                $productos = $consulta->fetchALL(PDO::FETCH_ASSOC);
            }catch(Exception $ex){
                echo $ex;
            }
        }
    ?>
    <div class="container-fluid">
        <div class="row justify-content-center align-content-center">
            <div class="col-8 barra">
                <a href="../Landing/index.php"><h4 class="text-light">RetroHouse</h4></a>
                
            </div>
            <div class="col-4 text-right barra">
                <ul class="navbar-nav mr-auto">
                    <li>
                        <a id="campana" href="./productoAdmin.php"></a>
                        <?php
                        if(!empty($_SESSION['imagenPerfil'])){
                            echo '<a href="#" class="px-3 text-light perfil dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img width="40" height="40" style="clip-path: circle(50% at 50% 50%);" src="../usuario/imagenUsuario/'.$_SESSION['imagenPerfil'].'" id="user_image"></a>';
                        }else{
                            echo'<a href="#" class="px-3 text-light perfil dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle user"></i></a>';
                        }
                        ?>

                        <div class="dropdown-menu" aria-labelledby="navbar-dropdown">
                            <a class="dropdown-item menuperfil cerrar" href="../Database/logout.php"><i class="fas fa-sign-out-alt m-1"></i>Cerrar Sesión
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="barra-lateral col-12 col-sm-1">
                <nav class="menu d-flex d-sm-block justify-content-center flex-wrap">
                    <a href="../Admin/dashboard.php"><i class="fas fa-home"></i><span>Inicio</span></a>
                    <a href="../Admin/modUsuario.php"><i class="fas fa-user"></i><span>Usuarios</span></a>
                    <a href="../Admin/productoAdmin.php"><i class="fas fa-compact-disc"></i><span>Productos</span></a>
                    <a href="../Admin/proveedoresAdmin.php"><i class="fas fa-home"></i><span>Proveedores</span></a>
                    <a href="../Admin/comprasAdmin.php"><i class="fas fa-home"></i><span>Compras</span></a>
                    <a href="../Admin/ventasAdmin.php"><i class="fas fa-home"></i><span>Ventas</span></a>
                </nav>
            </div>
            <main class="main col">
                <div class="row justify-content-center align-content-center" style="color: #fff">
                    <div class="columna col-lg-10">
                        <div class="tablas" style="padding: 2%;">
                            <form class="formularioCompra" id="formularioCompra" name="formularioCompra" action="ejecutarComprar.php" method="POST">
                                <button type="button" style="margin-top: 2%; margin-right:2%; font-size: large; width: 20%; height: 45px; border-radius: 0.375rem; background-color: #6c757d; color: #fff; border-style: none; margin-bottom: 1%;" onclick="Input()">Agregar producto</button>
                                <label for="proveedor" style="font-size: 120%;">Proveedor:</label>
                                <select style="border-radius: 5px; height:100%; width:30%; font-size:large; margin-bottom:2%" name="proveedor" id="proveedor">
                                    <option value="N/N" selected>Seleccionar Proveedor</option>
                                    <?php
                                        foreach($proveedores as $x => $x_value){
                                            echo "
                                                <option value='".$x_value['idProveedor']."'>".$x_value['nombreProveedor']."</option>
                                            ";
                                        }
                                    ?>
                                </select>
                                <div id="inputProducto">
                                    <div id='div1'>
                                        <br>
                                        <label for="selectCategoria">Categoría: </label>
                                        <select name="selectCategoria" id="selectCategoria">
                                            <option value="todo"></option>
                                        </select>
                                        <label style='font-size: 120%;' for='select1'>Producto: </label>
                                        <select style='border-radius: 5px; height:100%; width:30%; font-size:large;' name='select1' id='select1'>
                                        <option value="N/A" selected>Seleccionar Producto</option>
                                        <?php foreach($productos as $x => $x_values){
                                            echo"<option value='".$x_values['idProducto']."'>".$x_values['nombreProducto']."</option>";
                                        }?>
                                        </select>
                                        <label style='font-size: 120%;' for='cantidad1'>Cantidad: </label>
                                        <input style='border-radius: 5px; height:100%; width:10%; font-size:large;' type='text' name='cantidad1' id='cantidad1' maxlength="9">
                                        <label style='font-size: 120%;' for='precio1'>Precio unitario: </label>
                                        <input style='border-radius: 5px; height:100%; width:10%; font-size:large;' type='text' name='precio1' id='precio1' maxlength="9">
                                    </div>
                                </div>
                                <button type="button" style="margin-top: 2%; margin-right:2%; font-size: large; width: 100px; height: 45px; border-radius: 0.375rem; background-color: #28a745; color: #fff; border-style: none; margin-bottom: 1%;" onclick="validarTodo()">Comprar</button>
                                <button type="button" style="margin-top: 2%; margin-right:0; font-size: large; width: 100px; height: 45px; border-radius: 0.375rem; background-color: #6c757d; color: #fff; border-style: none; margin-bottom: 1%;" onclick="window.location='comprasAdmin.php'">Regresar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    <div>

    </div>
    <!-- jQuery, bootstrap y fontawesome -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/646c794df3.js"></script>
    <!-- script .ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        let numinputs = 1;
        function Input(){
            $.ajax({
                data:{"agregar" : true},
                url:"./comprarAjax.php",
                method: "POST",
                success: function(mensaje){
                    $("#inputProducto").append(mensaje);
                    numinputs += 1;
                }
            });
        }
        function validarTodo(){
            let vacios = false;
            let letras = false;
            let pattern = /^[0-9]+$/;
            let inputCantidad = "";
            let inputPrecio = "";
            let selectProveedor="";
            let selectProducto = "";
            let producto = false;
            let proveedor = false;
            let cero = false;
            let con = 0;
            let num = "";
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
            for(let i = 1; i<= numinputs; i++){
            num = i.toString();
            let can = "cantidad"+num;
            let pre = "precio"+num;
            let sel = "select"+num;
            if(document.getElementById(can) != null){
                inputCantidad = document.getElementById(can).value;
                inputPrecio = document.getElementById(pre).value;
                selectProveedor = document.getElementById("proveedor").value;
                selectProducto = document.getElementById(sel).value;

                if(inputCantidad.trim() == "" || inputCantidad == "" || inputPrecio == "" || inputPrecio.trim() == ""){
                    vacios = true;
                    break;
                }else if(!(pattern.test(inputCantidad)) || !(pattern.test(inputPrecio))){
                    letras = true;
                    break;
                }else if(selectProveedor == "N/N"){
                    proveedor = true;
                    break;
                }else if(selectProducto == "N/A"){
                    producto = true;
                    break;
                }else if(inputCantidad == 0){
                    cero = true;
                    break
                }else{
                    continue;
                }
            }else{
                continue;
            }
            
            }
            if(vacios){
                toastr['info']('No se permite ningún campo vacío.');
            }else if(letras){
                toastr['info']('No se permiten letras en cantidad o precio.');
            }else if(proveedor){
                toastr['info']('Seleccionar un proveedor');
            }else if(producto){
                toastr['info']('Seleccionar los productos');
            }else if(cero){
                toastr['info']('No se permite tener 0 en cantidad');
            }else{
                document.formularioCompra.submit();
            }
        }
        function eliminarInput(input){
            $(input).remove();
        }
    </script>
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
    <!-- Toastr -->
    <script src="../plugins/toastr/toastr.min.js"></script>
</body>
</html>