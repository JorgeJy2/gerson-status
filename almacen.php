<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Carrito de compras</title>

    <link rel="icon" type="image/x-icon" href="favicon.svg">

    <link rel="stylesheet" type="text/css" href="assets/b4/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <!-- libreria de animaciones -->
    <link rel="stylesheet" type="text/css" href="assets/animate/animate.css">
    <!-- font awesome libreria de iconos -->
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <!-- css principal para los productos -->
    <link rel="stylesheet" href="assets/css/car_main.css">

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>

<body>
<!-- Consulta -->
<?php
        include 'logic/bd/connection.php';
        $producto = '';
        $entrada='';
        $salida='';
        $fecha='';
        if(isset($_REQUEST['eliminar_valor'])){
            $query = "DELETE FROM t_almacen WHERE id_almacen=".$_REQUEST['eliminar_valor'].";";
            $mysqli->query($query);
            echo "Correctamente eliminado";
        }

       

        if (isset($_REQUEST['txtproducto'])) {
            $producto = $_REQUEST['txtproducto'];
            $entrada = $_REQUEST['txtentrada'];
            $salida = $_REQUEST['txtsalida'];
            $fecha = $_REQUEST['txtfecha'];
            
            if ($_REQUEST['btn'] == 'Guardar') {
                $query = "INSERT INTO t_almacen(id_producto,entrada,salida,fecha) VALUES (".$producto.",".$entrada.",".$salida.",'".$fecha."')";
                $mysqli->query($query);
                echo "Registro guardado";
                header('Location: almacen.php');
            } else if($_REQUEST['btn'] == 'Aceptar') {
                $id     = $_REQUEST['id_update'];
                $query = "UPDATE t_almacen SET entrada=".$entrada.",salida=".$salida.",fecha='".$fecha."' WHERE id_almacen=".$id.";";
                $mysqli->query($query);
                echo "Registro actualizado";
                header('Location: almacen.php');

            }   
        } else  if (isset($_REQUEST['edit_valor'])) {
            $mysqli->real_query("SELECT * FROM t_almacen INNER JOIN t_producto ON t_almacen.id_producto=t_producto.id_producto WHERE id_almacen=" . $_REQUEST['edit_valor'] . ";");
            $query  = $mysqli->store_result();
            $row = $query->fetch_assoc();
            $producto = ($row['id_almacen'] != null) ?  $row['producto'] : '';
            $entrada = ($row['id_almacen'] != null) ?  $row['entrada'] : '';
            $salida = ($row['id_almacen'] != null) ?  $row['salida'] : '';
            $fecha = ($row['id_almacen'] != null) ?  $row['fecha'] : '';
            $id_update = $row['id_almacen'];
        
        }

       // $mysqli->real_query("SELECT * FROM t_producto");
       // $query  = $mysqli->store_result();
      
      //  $mysqli->real_query("SELECT * FROM t_categorias
      //  INNER JOIN t_producto WHERE t_categorias.id_categoria=t_producto.id_categoria ");
      //  $query  = $mysqli->store_result();
       // $query = $mysqli -> query ("SELECT * FROM t_categorias");
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
                    <a class="nav-link" href="quienes_somos.html">Acerca de</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categorías
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Caballeros</a>
                        <a class="dropdown-item" href="#">Damas</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="categorias.php">Todas...</a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="details_product.php?id=<?php echo(random_int(1,6)); ?>">Ofertas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="details_product.php?id=<?php echo(random_int(1,6)); ?>">Nuevos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contacto.php">Contactanos</a>
                </li>
                <li class="nav-item dropdown">
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

    <!-- Inicio de contenido -->
    <div class="main_content space_content mt-md-5 fadeIn slow">
        <div class="row container_fliudsu">
        
        

        <?php if ($producto === '') { ?>
            <form method="post" action="almacen.php">
        <label >Elige un producto:</label>
        <select name ="txtproducto" require>
        <option value="0" selected="true" disabled="disabled">Seleccione:</option>
        <?php
           
        $mysqli->real_query("SELECT * FROM t_producto;");
        $query  = $mysqli->store_result();
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[id_producto].'">'.$valores[producto].'</option>';
          }
        ?>
      </select><br>
        <label >Cantidad entrada:</label>
        <input type="text" value="<?php echo ($entrada); ?>" class="form-control" name="txtentrada" require/><br>
        <label >Cantidad salida:</label>
        <input type="text" value="<?php echo ($salida); ?>" class="form-control" name="txtsalida" require/><br>
        <label >Fecha:</label>
        <input type="date" value="<?php echo ($fecha); ?>" class="form-control" name="txtfecha" require/><br>


                <input type="submit" name="btn" class="btn btn-success" value="Guardar">
            <?php } else { ?>
        <form method="post" action="almacen.php">
        <label >Producto:</label>
        <input type="text" value="<?php echo ($producto); ?>" class="form-control" name="txtproducto" readonly /><br>
        <label >Cantidad entrada:</label>
        <input type="text" value="<?php echo ($entrada); ?>" class="form-control" name="txtentrada" require/><br>
        <label >Cantidad salida:</label>
        <input type="text" value="<?php echo ($salida); ?>" class="form-control" name="txtsalida" require/><br>
        <label >Fecha:</label>
        <input type="date" value="<?php echo ($fecha); ?>" class="form-control" name="txtfecha" require/><br>


                <input type="submit" name="btn" class="btn btn-success" value="Aceptar">
                <input type="hidden" name="id_update" value="<?php echo ($id_update); ?>">
            <?php } ?>
        <input type="button" class="btn btn-danger" value="Cancelar" onClick="window.location='almacen.php'" />
    </form><br>
        <table class="table">
            <thead>
                <tr>
                   <td><h4>Id Almacen</h4></td>
                    <td><h4>Producto</h4></td> 
                    <td><h4>Entrada</h4></td>
                    <td><h4>Salida</h4></td>
                    <td><h4>Fecha</h4></td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
           
            <?php 
            
            
        $mysqli->real_query("  SELECT * FROM t_almacen
        INNER JOIN t_producto WHERE t_almacen.id_producto=t_producto.id_producto ");
        $query  = $mysqli->store_result();
          
            
                while($row = $query->fetch_assoc()) {?>
                <tr>
                    <td><?php echo $row['id_almacen'];?></td>
                    <td><?php echo $row['producto'];?></td>
                    <td><?php echo $row['entrada'];?></td>
                    <td><?php echo $row['salida'];?></td>
                    <td><?php echo $row['fecha'];?></td>
                    <td><a href="almacen.php?edit_valor=<?php echo $row['id_almacen'];?>"><button class="btn btn-success">Editar</button></a></td>
                    <td><a href="almacen.php?eliminar_valor=<?php echo $row['id_almacen'];?>"><button class="btn  btn-danger">Eliminar</button></a></td>
                    
                </tr>
            <?php } ?>
            
        </table>
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
        </div>
    </footer>
    <!-- Fin de pie de página -->

    <script src="assets/jquery/jquery.slim.min.js"></script>
    <script src="assets/tether/tether.min.js"></script>

    <script src="assets/b4/js/bootstrap.min.js"></script>
</body>

</html>