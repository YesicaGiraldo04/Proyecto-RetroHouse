<?php
require '../Database/databaseConn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css" type="text/css">
    <link href="https://fonts.cdnfonts.com/css/fh-space" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/macro" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/darker-grotesque" rel="stylesheet">
                
                
                
                
    <title>RetroHouse</title>
</head>
<body>
    <?php
    require '../assets/header.php'
    ?>
    <div class="container-slider">
        <div class="slider">
            <ul>
                <li>
                    <img src="../images/1.png" alt="">
                </li>
                <li>
                    <img src="../images/2.png" alt="">
                </li>
                <li>
                    <img src="../images/3.png" alt="">
                </li>
                <li>
                    <img src="../images/4.png" alt="">
                </li>
            </ul>
        </div>
    </div>

    <section class="info-container">
        <div class="info">
        <div>
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Error voluptas possimus dolor accusamus sint deleniti autem, mollitia officia eaque tempora ad in ipsam provident laudantium nisi voluptatibus nam necessitatibus sed.
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Porro repudiandae excepturi fugit ullam inventore nemo perferendis facilis voluptas amet velit ipsa dignissimos natus nam laborum voluptatum, eius ratione aliquid aspernatur!     
        </div>
        <div>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad perspiciatis qui molestiae distinctio hic unde adipisci labore, dignissimos cum eos aspernatur earum quo repellat iste tempore nostrum sunt! Sequi, alias.
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nulla consequatur amet nemo quod dolorem neque iste maxime ipsam quibusdam, sed, ipsum minima, laboriosam optio eligendi doloremque minus. Tempore, eaque aliquam?
        </div>
        </div>
    </section>
    
    <div class="card-container">
        <div class="card" id="jazz" onclick="window.location = '../Pagina/jazz.php'" style="cursor:pointer">
            <div class="content">
                <h2>Jazz</h2>
            </div>
        </div>
    
        <div class="card" id="rock" onclick="window.location = '../Pagina/rock.php'" style="cursor:pointer">
            <div class="content">
                <h2>Rock</h2>
            </div>
        </div>
    
        <div class="card" id="pop" onclick="window.location = '../Pagina/pop.php'" style="cursor:pointer">
            <div class="content">
                <h2>Pop</h2>
            </div>
        </div>
    </div>




    <?php
    include_once '../assets/footer.php';
    ?>
    <!-- sweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>