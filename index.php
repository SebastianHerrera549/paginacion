<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelicula</title>
    <link rel="stylesheet" href="main.css" >
</head>
<body>
    <?php
    include 'peliculas.php';
    ////////////////////////
    $cantPelicula =3; //Cantidad de Peliculas 
    ///////////////////////

    $peliculas =new Peliculas($cantPelicula);

    ?>
    <div id="container">
        
        <div id="peliculas">
            <?php  $peliculas->mostrarPeliculas();  ?>
        </div>
        <div id="paginas">
        <?php  $peliculas->mostrarPaginas();  ?>  
        </div>
    </div>
</body>
</html>