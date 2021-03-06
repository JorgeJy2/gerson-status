<?php
    session_start();
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
    <!-- css principal para el carrito -->
    <link rel="stylesheet" href="assets/css/carrito.css">
</head>

<body>
<!--Base de datos-->
<?php
include 'logic/bd/connection.php';
if(isset($_REQUEST['eliminar_valor'])){
    $query = "DELETE FROM t_carrito WHERE id_carrito=".$_REQUEST['eliminar_valor'].";";
    $mysqli->query($query);
   // echo "Correctamente eliminado";
}
?> 

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
                    <a class="nav-link" href="quienes_somos.html">Acerca</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categorías
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php 
                            include('logic/bd/connection.php');
                            $query= "SELECT id_categoria,categoria from t_categorias";
                            $mysqli->real_query($query);
                            $query  = $mysqli->store_result();
                            while($row = $query->fetch_assoc()) { ?>
                                <button class="dropdown-item" onclick="selectCategory('<?php echo $row['id_categoria']; ?>')"><?php echo $row['categoria']; ?></button>
                            <?php } ?>
                        <div class="dropdown-divider"></div>
                        <button class="dropdown-item" onclick="selectAllProducts()">Mostrar todos...</button>
                    </div>
                </li>

              
                <!-- <li class="nav-item">
                    <a class="nav-link" href="index.php">Nuevos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contacto.php">Contactanos</a>
                </li> -->
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Configuración
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="proveedores.php">Proveedores</a>
                        <a class="dropdown-item" href="almacen.php">Almacén</a>
                        <a class="dropdown-item" href="producto.php">Productos</a>
                        <a class="dropdown-item" href="categorias.php">Categorías</a>
                        <a class="dropdown-item" href="MenuDirecciones.php">Direcciones</a>
                        <a class="dropdown-item" href="#">Compras</a>
                        
                    </div>
                </li> -->
            </ul>
            <form action="search.php" class="form-inline my-2 my-lg-0 mr-5" method="get">
                <li class="nav-item">
                    <input type="text" name="value" id="input_search_nav" class="nav-link" placeholder="Nombre de producto" onkeyup="searchProduct(event)" >
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button> </a>
                </li>
                </form>

            <div class="form-inline my-2 my-lg-0 mr-5">
                <ul class="navbar-nav mr-auto">
                    <?php 
                        if( ! empty ($_SESSION['id_user'])) {
                         
                                $id_user = $_SESSION['id_user'];
                                $query = "SELECT cliente FROM t_cliente WHERE id_usuario=$id_user";
                                $result_login =  $mysqli->query($query);
                                $info_user = $result_login->fetch_assoc(); ?>
                                <li class="nav-item dropdown">
                                    <div class="nav-link dropdown-toggle" id="navbarDropdownUser" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php echo $info_user['cliente'];?>
                                    </div>
                                    
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownUser">
                                        <a href="./profile_user.php">
                                            <button class="dropdown-item">Ver pefil  <i class="fa fa-eye" aria-hidden="true"></i></button>
                                        </a>    
                                        <a href="./history_buy.php">
                                            <button class="dropdown-item">Historial  <i class="fa fa-history" aria-hidden="true"></i></button>
                                        </a>
                                        <a href="logout.php">
                                            <button class="dropdown-item logout-menu">Cerrar sesión <i class="fa fa-power-off" aria-hidden="true"></i></button>
                                        </a>
                                    </div>
                                </li> 
                           
                    <?php }else  { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.html">Iniciar sesión</a>
                        </li>
                    <?php } ?>

                    <li class="nav-item">
                        <a id="price_article_in_car" class="nav-link">$1050</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="carrito.php"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> </a>
                    </li>
                    <li class="nav-item">
                        <p id="number_articles_in_car">0</p>
                    </li>
                </ul>
                    </div>
        </div>
    </nav>


<!-- Inicio de contenido -->
<!-- color rgb(235, 235, 235) -->

<div class="container mt-4 fadeIn slow text-center" id="result_buy">
   
</div>


<div id="car_view" >

    <div class="container mt-4 fadeIn slow text-center">
        <img src='assets/images/usuarios/user.png' class='imgRedonda' /><br><br>
        <label >Carrito del usuario</label><br><br><br>
        <div class="navcarrito">
       
    </div>

    <div class="slidecontainer">
    <input type="range" min="1" max="100" value="50" class="slider" id="myRange">
    </div>

    <!--Inicio tabla carrito-->

    <div class="row mt-4">
        <div class="col-md-12">
            <div id="table_register">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Producto</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Total</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody id="container_orders">
            
                </tbody>
            </table>
            </div>
        </div>
        </div>
        <div class="col-md-12">
            <h4>Total: </h4> <h5 id="total_car_price">0</h5>
        </div>


        <div class="col-md-12">
            <?php
                if (isset($_SESSION['id_user'])) { ?> 
                    <div id="btn_buy_enable_to">
                        <button id="btn-access-login" class="btn btn-car-primary-register btn-block  mt-3" onclick="buy_car(<?php echo $_SESSION['id_user'] ?>)">Comprar ahora</button>
                    </div>
                <?php }else { ?>
                <a href="login_user.php?page=carrito.php">
                    <button id="btn-access-login" class="btn btn-block btn-danger  mt-3">Inicia sesión para comprar</button>
                </a>
                    <?php } ?> 
        </div>

    <!--Fin tabla carrito-->
    </div>

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

<script src="assets/pouch_db/pouchdb-7.1.1.min.js"></script>
<script src="assets/jquery/jquery.slim.min.js"></script>
<script src="assets/tether/tether.min.js"></script>

<script src="assets/b4/js/bootstrap.min.js"></script>
<script src="assets/js/manager_db.js"></script>
<script src="assets/js/manager_car.js"></script>

<script src="assets/js/manager_order.js"></script>
<script src="assets/js/car.js"></script>
</body>
</html>