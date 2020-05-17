<?php 
    if(isset($_GET['page']))
        $page = $_GET['page'];
    else 
        $page = "index.php";
    
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Carrito de compras</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="favicon.svg">

    <link rel="stylesheet" type="text/css" href="assets/b4/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <!-- libreria de animaciones -->
    <link rel="stylesheet" type="text/css" href="assets/animate/animate.css">
    <!-- font awesome libreria de iconos -->
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <!-- css principal para los productos -->
    <link rel="stylesheet" href="assets/css/car_main.css">
</head>

<!-- Inicio de pie de página -->
<nav class="navbar navbar-expand-lg space_content navbar-light">
    <a class="navbar-brand" href="index.php"> <i class="fa fa-cubes" aria-hidden="true"></i> Market</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    <div class="collapse navbar-collapse ml-5" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Inicio<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="quienes_somos.html">Acerca de</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categorías
                    </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Casa</a>
                    <a class="dropdown-item" href="#">Sala</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Otras</a>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php">Ofertas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">Nuevos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contacto.php">Contactanos</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-search" aria-hidden="true"></i> </a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0 mr-5">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item">
                    <a class="nav-link" href="login.html">Iniciar sesión</a>
                </li>
                <li class="nav-item">
                    <a id="price_article_in_car" class="nav-link">$1050</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> </a>
                </li>
                <li class="nav-item">
                    <p id="number_articles_in_car">1</p>
                </li>
            </ul>
        </form>
    </div>
</nav>

<!-- fin de pie de página  -->

<!-- Inicio de contenido -->
<!-- color rgb(235, 235, 235) -->
<div class="container mt-4 fadeIn slow text-center">
    <h2 class="">Iniciar sesión</h2>
    <div class="imagen-user-register mt-4">
        <i class="fa fa-user" aria-hidden="true"></i>
    </div>
    <!-- this is a form realy -->
    <form action="login.php" method="POST" class="mt-5 main_login text-center">

        <br>
        <div class="form-group">
            <label for="email">Correo</label>
            <input name="user" type="email" class="form-control" id="email" placeholder="Nombre completo">
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input name="password" type="password" class="form-control" id="password" onkeyup="check_input(event)" placeholder="Nombre completo">
            <small>Mínimo 5 caracteres al menos 1 alfabeto en mayúsculas, 1 alfabeto en minúsculas, 1 número y 1 carácter especial:</small>
        </div>

        <input type="hidden" name="page" value="<?php echo $page;?>" id="">

        <input class="form-content mt-3" type="checkbox">Recordar usuario.
        <p><a class="forgot_password" href="registro.html">Registrar usuario</a></p>
        <button id="btn-access-login" class="btn btn-car-primary-register btn-block  mt-3" disabled>Ingresar</button>

    </form>

</div>
<!-- Fin de contenido principal -->

<!-- Inicio de píe de página -->
<footer class="page-footer font-small mdb-color pt-4">
    <div class="container text-center text-md-left">
        <div class="row text-center text-md-left mt-3 pb-3">
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3 text-center">
                <h6 class="text-uppercase mb-4 font-weight-bold">Productos</h6>
                <p>
                    <a href="#!">Frutas</a>
                </p>
                <p>
                    <a href="#!">Bebidas</a>
                </p>
                <p>
                    <a href="#!">Relojs</a>
                </p>
                <p>
                    <a href="#!">Mesas</a>
                </p>
            </div>

            <hr class="w-100 clearfix d-md-none">

            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3 text-center">
                <h6 class="text-uppercase mb-4 font-weight-bold">Marcas</h6>
                <p>
                    <a href="#!">Apple</a>
                </p>
                <p>
                    <a href="#!">Samnsung</a>
                </p>
                <p>
                    <a href="#!">Sony</a>
                </p>
                <p>
                    <a href="#!">Phips</a>
                </p>
            </div>

            <hr class="w-100 clearfix d-md-none">

            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3 text-center">
                <h6 class="text-uppercase mb-4 font-weight-bold">Contactos</h6>
                <p>
                    <a href="#!"><i class="fa fa-phone" aria-hidden="true"></i> 0100 40 55 222</a>
                </p>
                <p>
                    <a href="#!"><i class="fa fa-address-book" aria-hidden="true"></i> sales@market.com</a>
                </p>
                <p class="mt-3">
                    <a href="#!"><i class="fa fa-facebook-f" aria-hidden="true"></i> </a> &nbsp &nbsp

                    <a href="#!"><i class="fa fa-twitter" aria-hidden="true"></i> </a> &nbsp &nbsp
                    <a href="#!"><i class="fa fa-google" aria-hidden="true"></i> </a> &nbsp &nbsp
                    <a href="#!"><i class="fa fa-pinterest" aria-hidden="true"></i> </a>
                </p>

            </div>

            <hr class="w-100 clearfix d-md-none">

            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3 text-center">
                <h6 class="text-uppercase mb-4 font-weight-bold">Formas de pago</h6>
                <p>
                    <a href="#!"><i class="fa fa-cc-visa" aria-hidden="true"></i> </a> &nbsp
                    <a href="#!"><i class="fa fa-cc-mastercard" aria-hidden="true"></i> </a> &nbsp
                    <a href="#!"><i class="fa fa-cc-mastercard" aria-hidden="true"></i> </a> &nbsp
                    <a href="#!"><i class="fa fa-cc-paypal" aria-hidden="true"></i> </a>
                </p>
                <p>
                    <a href="#!"><i class="fa fa-cc-mastercard" aria-hidden="true"></i> </a> &nbsp
                    <a href="#!"><i class="fa fa-cc-amex" aria-hidden="true"></i> </a> &nbsp
                    <a href="#!"><i class="fa fa-cc-paypal" aria-hidden="true"></i> </a> &nbsp
                    <a href="#!"><i class="fa fa-cc-visa" aria-hidden="true"></i> </a>
                </p>
            </div>

        </div>

        <hr>

        <div class="row d-flex">
            <div class="col-md col-lg">
                <p class="text-center">© 2019 Copyright:
                    <a href="#">
                        <strong> Mi carrito</strong>
                    </a>
                </p>
            </div>
        </div>

</footer>
<!-- Fin de pie de página -->


<script src="assets/jquery/jquery.slim.min.js"></script>
<script src="assets/tether/tether.min.js"></script>

<script src="assets/b4/js/bootstrap.min.js"></script>
<script src="assets/js/login.js"></script>

</html>