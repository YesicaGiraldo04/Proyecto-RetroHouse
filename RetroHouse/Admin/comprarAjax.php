<?php

    session_start();
    if(!$_SESSION['user_rol'] == 1){
        echo "<script>alert('No tienes los permisos para estar aquí.');
        window.location='../Login/login.php';</script>";
    }
    if(isset($_POST['agregar']) && $_POST['agregar'] == true){
        require "../Database/databaseConn.php";
        try{
            $consulta = $conn->prepare("SELECT nombreProducto, idProducto FROM producto;");
            $consulta->execute();
            $productos = $consulta->fetchALL(PDO::FETCH_ASSOC);
        }catch(Exception $ex){
            echo $ex;
        }
        if(isset($_SESSION['numInput']) && !empty($_SESSION['numInput'])){
            $inputNum = $_SESSION['numInput'];
            $_SESSION['numInput'] = $inputNum + 1;
            $int = strval($_SESSION['numInput']);
            $can = "cantidad".$int;
            $pre = "precio".$int;
            echo"
            <div id='div".$_SESSION['numInput']."'>
            <br>
            <label style='font-size: 120%;' for='select".$_SESSION['numInput']."'>Producto: </label>
            <select style='border-radius: 5px; height:100%; width:30%; font-size:large;' name='select".$_SESSION['numInput']."' id='select".$_SESSION['numInput']."'>
            <option value='N/A' selected>Seleccionar Producto</option>
            ";foreach($productos as $x => $x_values){
                echo"<option value='".$x_values['idProducto']."'>".$x_values['nombreProducto']."</option>";
            }echo"</select>
            <label style='font-size: 120%;' for='cantidad".$_SESSION['numInput']."'>Cantidad: </label>
            <input style='border-radius: 5px; height:100%; width:10%; font-size:large;' type='text' name='cantidad".$_SESSION['numInput']."' id='cantidad".$_SESSION['numInput']."' maxlength='9'>
            <label style='font-size: 120%;' for='precio".$_SESSION['numInput']."'>Precio unitario: </label>
            <input style='border-radius: 5px; height:100%; width:10%; font-size:large;' type='text' name='precio".$_SESSION['numInput']."' id='precio".$_SESSION['numInput']."' maxlength='9'>
            <button style='margin-left:2%; font-size: large; width: 100px; height: 35px; border-radius: 0.375rem; background-color: #c82333; color: #fff; border-style: none; margin-bottom: 1%;' type='button' onclick='eliminarInput(".'div'.$_SESSION['numInput'].")'>Eliminar</button></div>";
        }else{
        }
    }else{

    }
?>