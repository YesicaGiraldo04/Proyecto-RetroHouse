<!DOCTYPE html>
<?php
    require '../Database/databaseConn.php';
    session_start();

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
    <!-- JqueryCampana -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>Proveedores</title>
</head>
<body>
    <?php
    
        if(isset($_SESSION['user_rol']) && $_SESSION['user_rol'] == 1){
            $consulta = $conn->prepare("SELECT * FROM proveedor");
            $consulta->execute();
            $inventario = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }else{
            echo "
            <script>
                alert('No tienes permisos.');
                window.location='../Landing/index.php';
            </script";
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
                    <a href="../Admin/proveedoresAdmin.php"><i class="fas fa-user"></i><span>Proveedores</span></a>
                    <a href="../Admin/comprasAdmin.php"><i class="fas fa-tag"></i><span>Compras</span></a>
                    <a href="../Admin/ventasAdmin.php"><i class="fas fa-tag"></i><span>Ventas</span></a>
                </nav>
            </div>
            <main class="main col">
                <div class="row justify-content-center align-content-center" style="color: #fff">
                    <div class="columna col-lg-10">
                        
        <div class="tablas p-3">
        <div class="row">
            <div class="col d-grid gap-2">
                <button class="btn btn-success my-3" onclick="window.location='registrarProveedor.php'">Registrar nuevo proveedor</button>
            </div>
            <div class="col d-grid gap-2">
                <button class="btn btn-secondary my-3" onclick="window.location='../Landing/index.php'">Regresar</button>
            </div>
        </div>
            <table id="proveedores" class="table my-3" style="color:#fff;">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($inventario as $x => $x_value){
                            if($x_value['estado'] == 1){
                                echo "
                                <tr>
                                    <td>".$x_value['idProveedor']."</td>
                                    <td>".$x_value['nombreProveedor']."</td>
                                    <td>".$x_value['correoProveedor']."</td>
                                    <td>".$x_value['telefonoProveedor']."</td>
                                    <td>
                                        <form action='modificarProveedor.php' method='POST'>
                                            <input type='number' name='idProveedor' value='".$x_value['idProveedor']."'hidden>
                                            <button class= 'btn btn-warning' type='submit' style=' width: 100%; margin-bottom: 2%;'>Modificar</button>
                                        </form>
                                        <form action='eliminarConfirmar.php' method='POST'>
                                            <input type='number' name='idProveedor' value='".$x_value['idProveedor']."' hidden>
                                            <button class= 'btn btn-danger' type='submit' style=' width: 100%;'>Deshabilitar</button>
                                        </form>
                                    </td>
                                </tr>
                                ";
                            }else{
                                echo "
                                <tr>
                                    <td>".$x_value['idProveedor']."</td>
                                    <td>".$x_value['nombreProveedor']."</td>
                                    <td>".$x_value['correoProveedor']."</td>
                                    <td>".$x_value['telefonoProveedor']."</td>
                                    <td>
                                        <form action='modificarProducto.php' method='POST'>
                                            <input type='number' name='idProveedor' value='".$x_value['idProveedor']."'hidden>
                                            <button class= 'btn btn-warning' type='submit' style=' width: 100%; margin-bottom: 2%;'>Modificar</button>
                                        </form>
                                        <form action='habilitarConfirmar.php' method='POST'>
                                            <input type='number' name='idProveedor' value='".$x_value['idProveedor']."' hidden>
                                            <button class= 'btn btn-success' type='submit' style=' width: 100%;'>Habilitar</button>
                                        </form>
                                    </td>
                                </tr>
                                ";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
                    </div>

                </div>

            </main>
        </div>
    </div>
    <!-- Campana -->
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
    <!-- jQuery, bootstrap y fontawesome -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/646c794df3.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>
    <!-- funsion javascript dataTable -->
    <script>
        let dataTable;
        let dataTableIsInitialized = false;
        
        const dataTableOptions = {
    destroy: true,
    language: {
        lengthMenu: "Mostrar _MENU_ registros por página",
        zeroRecords : "Ningun usuario encontrado",
        info: "Mostrando de _START_ a _END_ de un total de _TOTAL_ registros ",
        infoEmpty: "Ningún encontrado",
        infoFiltered: "(filtrados desde _MAX_ registros totales) ",
        search: "Buscar",
        loadingRecords: "Cargando ... ",
        paginate: {
            first: " Primero",
            last: "Último",
            next: "Siguiente",
            previous : "Anterior"
        }
    }

}

        if (dataTableIsInitialized){
            tadaTable.destroy();
        }

        dataTable = $("#proveedores").DataTable(dataTableOptions);

        dataTableIsInitialized = true;
    </script>
</body>
</html>