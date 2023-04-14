<?php
    session_start();
    if ($_SESSION['user_id']) {
        session_unset();
        session_destroy();
        echo "<script> alert('Sesión Cerrada');
        window.location='../Landing/index.php'</script>";
    } else {
        
        echo "<script> alert('No hay una seisón abierta.');
        window.location='../Landing/index.php'</script>";
    }
    