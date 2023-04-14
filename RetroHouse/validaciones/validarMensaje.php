<?php

    $mensaje = $_GET["mensaje"];

    if(!isset($mensaje)) return;

    echo "<script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

    $alerta = "<script>
        Swal.fire({
            icon: 'success',
            title: 'Proceso completado exitosamente',
            text: '$mensaje',
        })
    </script>";

    echo $alerta;
?>