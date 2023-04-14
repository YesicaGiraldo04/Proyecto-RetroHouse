<?php

    $mensaje = $_GET["alerta"];

    if(!isset($mensaje)) return;

    echo "<script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

    $alerta = "<script>
        Swal.fire({
            icon: 'error',
            title: 'Ocurrió un error',
            text: '$mensaje',
        })
    </script>";

    echo $alerta;
?>