<?php
session_start();


?>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/f57beba7b3.js" crossorigin="anonymous"></script>
</head>
<header>
        <div class="title">
            <a href="../Landing/index.php" style="text-decoration:none; color:#fff; padding-left: 0px;">
            <h1>RetroHouse</h1>
            </a>
        </div>
        <div class="user-icon">
        <a class="" href="../componentesCarrito/carrito.php" style="font-size: 36px; text-decoration:none">🛒</a>
            <?php
            if (!empty($_SESSION['user_id'])){
                if(!empty($_SESSION['user_rol']) && $_SESSION['user_rol'] == 1){
                    echo '
                    <a id="campana" href="../Admin/productoAdmin.php" style="text-decoration:none;"></a>
                    <a href="../Admin/dashboard.php" style="text-decoration:none;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36px" height="36px" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);"><path d="M21.993 7.95a.96.96 0 0 0-.029-.214c-.007-.025-.021-.049-.03-.074-.021-.057-.04-.113-.07-.165-.016-.027-.038-.049-.057-.075-.032-.045-.063-.091-.102-.13-.023-.022-.053-.04-.078-.061-.039-.032-.075-.067-.12-.094-.004-.003-.009-.003-.014-.006l-.008-.006-8.979-4.99a1.002 1.002 0 0 0-.97-.001l-9.021 4.99c-.003.003-.006.007-.011.01l-.01.004c-.035.02-.061.049-.094.073-.036.027-.074.051-.106.082-.03.031-.053.067-.079.102-.027.035-.057.066-.079.104-.026.043-.04.092-.059.139-.014.033-.032.064-.041.1a.975.975 0 0 0-.029.21c-.001.017-.007.032-.007.05V16c0 .363.197.698.515.874l8.978 4.987.001.001.002.001.02.011c.043.024.09.037.135.054.032.013.063.03.097.039a1.013 1.013 0 0 0 .506 0c.033-.009.064-.026.097-.039.045-.017.092-.029.135-.054l.02-.011.002-.001.001-.001 8.978-4.987c.316-.176.513-.511.513-.874V7.998c0-.017-.006-.031-.007-.048zm-10.021 3.922L5.058 8.005 7.82 6.477l6.834 3.905-2.682 1.49zm.048-7.719L18.941 8l-2.244 1.247-6.83-3.903 2.153-1.191zM13 19.301l.002-5.679L16 11.944V15l2-1v-3.175l2-1.119v5.705l-7 3.89z"/></svg>
                    </a>';
                }
                if(!empty($_SESSION['imagenPerfil'])){
                    echo '
                    <a href="../usuario/paginaUsuario.php" style="text-decoration: none;">
                        <img width="40" height="40" style="clip-path: circle(50% at 50% 50%);" src="../usuario/imagenUsuario/'.$_SESSION['imagenPerfil'].'" id="user_image">
                    </a>';
                }else{
                    echo '<a href="../usuario/paginaUsuario.php" style="text-decoration: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);"><path d="M12 2a5 5 0 1 0 5 5 5 5 0 0 0-5-5zm0 8a3 3 0 1 1 3-3 3 3 0 0 1-3 3zm9 11v-1a7 7 0 0 0-7-7h-4a7 7 0 0 0-7 7v1h2v-1a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v1z"></path></svg>
                    </a>';
                }
                echo '
                <a href="../Database/logout.php" style="text-decoration:none; color:#fff;" style="text-decoration: none;">
                <svg width="36px" height="36px" viewBox="0 0 24.00 24.00" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M16 16.9998L21 11.9998M21 11.9998L16 6.99982M21 11.9998H9M12 16.9998C12 17.2954 12 17.4432 11.989 17.5712C11.8748 18.9018 10.8949 19.9967 9.58503 20.2571C9.45903 20.2821 9.31202 20.2985 9.01835 20.3311L7.99694 20.4446C6.46248 20.6151 5.69521 20.7003 5.08566 20.5053C4.27293 20.2452 3.60942 19.6513 3.26118 18.8723C3 18.288 3 17.5161 3 15.9721V8.02751C3 6.48358 3 5.71162 3.26118 5.12734C3.60942 4.3483 4.27293 3.75442 5.08566 3.49435C5.69521 3.29929 6.46246 3.38454 7.99694 3.55503L9.01835 3.66852C9.31212 3.70117 9.45901 3.71749 9.58503 3.74254C10.8949 4.00297 11.8748 5.09786 11.989 6.42843C12 6.55645 12 6.70424 12 6.99982" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                </a>';
            }else{
                echo '<a href="../Login/login.php" style="text-decoration: none;">
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);"><path d="M12 2a5 5 0 1 0 5 5 5 5 0 0 0-5-5zm0 8a3 3 0 1 1 3-3 3 3 0 0 1-3 3zm9 11v-1a7 7 0 0 0-7-7h-4a7 7 0 0 0-7 7v1h2v-1a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v1z"></path></svg>
                </a>';
            }
            ?>
        </div>
    </header>
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