<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/factura.css">
    <title>Document</title>
</head>
<body>
    <?php
        require '../Database/databaseConn.php';
        require "../assets/header.php";

        if (isset($_GET['id'])) {
            $querySelect = $conn->prepare("SELECT venta.*, usuario.nombreCompleto, producto.nombreProducto, detalleventa.* FROM detalleventa INNER JOIN producto ON detalleventa.idProducto = producto.idProducto INNER JOIN venta ON detalleventa.idVenta = venta.idVenta INNER JOIN usuario ON venta.documentoUsuario = usuario.documentoCliente WHERE detalleventa.idVenta = :idVenta ");
            $results = $querySelect->execute(['idVenta' => $_GET['id']]);
            $results = $querySelect->fetchAll(PDO::FETCH_ASSOC);

            $idVenta = "";
            $nombre = "";
            $documento = "";
            $fecha = "";
            $total ="";

            foreach($results as $key => $value){ 
                $idVenta = $value['idVenta'];
                $nombre = $value['nombreCompleto'];
                $documento = $value['documentoUsuario'];
                $fecha = $value['fecha'];
                $total = $value['total'];
            }
        } 
    ?>
    <div class="containerFactura">
        <fieldset>
            <legend><h1>Factura: <?php echo $idVenta?></h1></legend>
            <h2>Comprador: <?php echo $nombre?></h2>
            <h2>Documento: <?php echo $documento ?></h2>
            <h2>Fecha y hora: <?php echo $fecha ?></h2>
            <div class="productos">
                <table>
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php foreach($results as $key => $value) { ?>
                        <tr>
                            <td><?php echo $value['nombreProducto'] ?></td>
                            <td><?php echo $value['cantidad']?></td>
                            <td><?php echo $value['precioUnitario'] ?></td>
                        </tr>
                            <?php } ?>
                    </tbody>
                </table>

                <h2>Total: $ <?php echo $total ?></h2>
            </div>
            <div class="row">
                <div class="col">
                    <button class="regresar" id="regresar" type="button" style="cursor:pointer; ">Regresar</button>
                </div>
            </div>
    </fieldset>
    </div>
    
</body>
</html>
<script>
    document.getElementById('regresar').addEventListener('click', () => {
        window.location = '../componentesCarrito/carrito.php';
    })
</script>