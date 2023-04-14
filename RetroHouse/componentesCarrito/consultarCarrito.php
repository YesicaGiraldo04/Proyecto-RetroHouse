<?php
    try {

     require('./carritoDB.php');
     require('../Database/databaseUtils.php');
   
     if(!empty($_SESSION['user_id'])){
      $idUsuario = $_SESSION['user_id'];

        $db = new CarritoDB();
        $productos = $db->consultarCarrito($idUsuario);

        if(!isset($productos)) {
            header("Location: producto.php?mensaje=Aún no has agregado productos al carrito");
            return;
        }

        $html = "";
        $precioTotal = 0;

        if($productos){
          foreach($productos as $producto) {
            $html .= '<form action="./descartarProductoCarrito.php" method="POST">
            <div class="card shadow mt-4 mb-3 m-auto d-block w-75 p-2" style="border: 2px solid rgb(0, 0, 0)">
            <div class="row g-0">
              <div class="col-md-4">
                <img src="../assets/Images/'.$producto['nombreCategoria']."/".$producto['imagen'].'" class="img-fluid rounded-start" alt="...">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">Nombre: '. $producto['nombreProducto'] .'</h5>
                  <p class="card-text">Cantidad: '.  $producto['cantidad'] .'</p>
                  <p class="card-text">Precio unitario: '.  $producto['precio_unitario'] .'</p>
                  <p class="card-text">Precio total: '.  $producto['precio_total'] .'</p>
                  <input type="text" name="idCarrito" style="display:none" value="'. $producto['id'].'">
                  <button class="btn btn-danger">Eliminar</button>
                </div>
              </div>
            </div>
          </div>
            </form>';


            $precioTotal += $producto['precio_total'];
        }

        $html .= "<div class='precio-container'>
        <div class='precio-carrito'>
        <p>El precio total es $$precioTotal</p>
        <form action='./finalizarCompra.php' method='POST'>
            <div class='form-group'>
                <input type='submit' class='btn btn-success' value='Pagar' style='width: 84px'>
                <input type='text' style='display:none' value='$precioTotal' name='valorTotal'>
            </div>
        </form>
        </div>
        </div>
        ";
        } else{
          $html .= '<div class="card shadow mt-4 mb-3 m-auto d-block w-75 p-2" style="border: 2px solid rgb(0, 0, 0)">
          <div class="row g-0">
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">No tienes productos en el carrito.</h5>
              </div>
            </div>
          </div>
        </div>';
        }

        

        echo $html;
     }else{
      echo"<script>alert('Se requiere iniciar sesión.');window.location='../Login/login.php'</script>";
     }
        
    } catch (Exception $e) {
        header("Location: ../landing/index.php?mensaje=Ocurrió un error inesperado");
    }   
?>