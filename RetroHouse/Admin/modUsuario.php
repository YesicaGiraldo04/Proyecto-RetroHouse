<?php
session_start();
    if ($_SESSION['user_rol'] == 2) {
        echo "<script> alert('No puedes estar en esta página.');
        window.location='../Landing/index.php'</script>";
    }
require '../Database/databaseConn.php';

$messageAdmin = "";
$messageUser = "";

$querySelect = $conn->prepare('SELECT * FROM usuario');
$queryCount = $conn->prepare('SELECT COUNT(*) as total FROM usuario WHERE idRol = 1');
$queryCount2 = $conn->prepare('SELECT COUNT(*) as total FROM usuario WHERE idRol = 2');

// (Mateo y Yesica) Ejecutamos la consulta de todos los usuarios registrados sin importar su rol
$querySelect->execute();
$results = $querySelect->fetchAll(PDO::FETCH_ASSOC);

// (Mateo y Yesica) Ejecutamos la consulta de la cantidad de administradores en la base de datos
$queryCount->execute();
$resultsCount = $queryCount->fetch(PDO::FETCH_ASSOC);

if (count($resultsCount) > 0) {
    $total = $resultsCount['total'];
    $messageAdmin = 'Administradores: '.$total;
} else {
    $messageAdmin = 'No se encontraron usuarios con el rol de Administrador.';
}

// (Mateo y Yesica) Ejecutamos la consulta de la cantidad de Clientes en la base de datos.
$queryCount2->execute();
$resultsCount2 = $queryCount2->fetch(PDO::FETCH_ASSOC);

if (count($resultsCount2) > 0) {
    $total = $resultsCount2['total'];
    $messageUser = 'Clientes: '.$total;
} else {
    $messageUser = 'No se encontraron usuarios con el rol de Cliente.';
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/dashboard.css">
    <!-- JqueryCampana -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

</head>

<body>

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
                <div class="row justify-content-center align-content-center">
                    <div class="columna col-lg-10">
                    <div class="card mask-custom">
                                <div class="table-responsive p-3">
                                    <div class="contadores">
                                        <div class="admin">
                                        <?php
                                        echo $messageAdmin;
                                        ?>
                                        </div>
                                    <div class="users" style="text-decoration: none">
                                        <?php
                                        echo $messageUser;
                                        ?>
                                    </div>
                                    </div>
                        <button type="button" class="btn btn-success m-2"><a href="./aggAdmin.php" style="text-decoration: none; color:#000; margin-bottom: 8px">Agregar Administrador</a></button>
                    <table class="table mb-0 " id="usuarios" style="color:#fff;">
                        <thead>
                        <tr>
                            <th scope="col">Documento</th>
                            <th scope="col">Nombre Completo</th>
                            <th scope="col">Ciudad</th>
                            <th scope="col">Celular</th>
                            <th scope="col">Correo Electrónico</th>
                            <th scope="col">Rol</th>
                            <th scope="col">Acciones</th>
                        </tr>
                        </thead>
                            <?php foreach ($results as $key => $value) { ?>
                            <tbody>
                            <?php
                            if($value['estado'] == 1){
                                echo '<td>'.$value['documentoCliente']. '</td>';
                                echo '<td>'.$value['nombreCompleto']. '</td>';
                                echo '<td>'.$value['ciudad']. '</td>';
                                echo '<td>'.$value['celular']. '</td>';
                                echo '<td>'.$value['email']. '</td>';
                                if ($value['idRol'] == 1) {
                                    echo '<td>Administrador</td>';
                                } else {
                                    echo '<td>Cliente</td>';
                                }
                                echo '
                                <td>
                                    <form action="../Admin/editarUsuario.php" method="POST">
                                    <input type="number" name="id" value="'.$value['documentoCliente'].'" hidden>
                                    <button class= "btn btn-warning" type=-"submit" style=" width: 100%; margin-bottom: 2%;">Modificar</button>
                                    </form>
                                    <form action="../Database/eliminarUsuario.php" method="POST">
                                        <input type="number" name="idUsuarioD" value="'.$value['documentoCliente'].'" hidden>
                                        <button class= "btn btn-danger" type=-"submit" style=" width: 100%;">Deshabilitar</button>
                                    </form>
                                </td>';
                                echo '</tr>';
                            }else{
                                echo '<td>'.$value['documentoCliente']. '</td>';
                                echo '<td>'.$value['nombreCompleto']. '</td>';
                                echo '<td>'.$value['ciudad']. '</td>';
                                echo '<td>'.$value['celular']. '</td>';
                                echo '<td>'.$value['email']. '</td>';
                                if ($value['idRol'] == 1) {
                                    echo '<td>Administrador</td>';
                                } else {
                                    echo '<td>Cliente</td>';
                                }
                                echo '
                                <td>
                                <a href="./editarUsuario.php?id='.$value['documentoCliente'].'" style="text-decoration:none; color: #000s; width: 100%; margin-bottom: 3px" class="btn btn-warning">Editar</a>
                                    <form action="../Database/eliminarUsuario.php" method="POST">
                                        <input type="number" name="idUsuarioH" value="'.$value['documentoCliente'].'" hidden>
                                        <button class= "btn btn-success" type=-"submit" style=" width: 100%;">Habilitar</button>
                                    </form>
                                </td>';
                                echo '</tr>';
                            }
                            
                            ?>
                                <?php } ?>
                            </tbody>
                        </table>
                                </div>
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
    <!-- Custom JS -->
    <script>
        
        let dataTable;
        let dataTableIsInitialized = false;

        if (dataTableIsInitialized){
            tadaTable.destroy();
        }

        dataTable = $("#usuarios").DataTable({});

        dataTableIsInitialized = true;
    </script>
</body>

</html>