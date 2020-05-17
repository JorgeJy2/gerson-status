<!doctype html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>


  <link rel="stylesheet" type="text/css" href="../../assets/b4/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../../assets/css/main.css">
  <!-- libreria de animaciones -->
  <link rel="stylesheet" type="text/css" href="../../assets/animate/animate.css">
  <!-- font awesome libreria de iconos -->
  <link rel="stylesheet" href="../../assets/font-awesome/css/font-awesome.min.css">
  <!-- css principal para los productos -->
  <link rel="stylesheet" href="../../assets/css/car_main.css">

  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

</head>


<body>
    
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../../index.php">Admin shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="../../index.php">Inicio usuarios</a>
            </li>
            <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tablas
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="proveedores.php">Proveedores</a>
                        <a class="dropdown-item" href="almacen.php">Almacén</a>
                        <a class="dropdown-item" href="producto.php">Productos</a>
                        <a class="dropdown-item" href="categorias.php">Categorías</a>
                        <a class="dropdown-item" href="MenuDirecciones.php">Direcciones</a>
                        <a class="dropdown-item" href="compra.php">Compras</a>
                                
                    </div>
                </li>
            </ul>
        </div>
    </nav>


<script src="../../assets/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="../../assets/jquery/jquery.slim.min.js"></script>
    <script src="../../assets/tether/tether.min.js"></script>

    <script src="../../assets/b4/js/bootstrap.min.js"></script>
    


    <!-- Inicio de contenido -->
   <?php
    include '../../logic/bd/connection.php';
   
    if(isset($_REQUEST['valor'])){
        include '../../logic/bd/connection.php';
        $query = "DELETE FROM t_codpos where id_codpos=".$_REQUEST['valor']."";
        $mysqli->query($query);
        //echo "Dato eliminado";
        
    }
    
    
    if(isset($_GET['p'])){        
        $inicio = (intval ($_GET['p'])-1)*5;
        $mysqli->real_query("select id_codpos,c.id_colonia,codpos,colonia from t_codpos cp inner join t_colonias c on cp.id_colonia=c.id_colonia LIMIT ".$inicio.",5");
        $query = $mysqli->store_result();
    }else {
        $mysqli->real_query("select id_codpos,c.id_colonia,codpos,colonia from t_codpos cp inner join t_colonias c on cp.id_colonia=c.id_colonia LIMIT 0,5");
        $query = $mysqli->store_result();    
    }
    
    

    ?>
    
    <!--Fin de paginación-->
    
    <div class="container">
         
        <div class="col-md-12 text-center">
            <h1>Código Postal</h1><br>
    <table class="table">
        <thead class="thead-dark">
        <tr>
        <td><a href="ins_cp.php">Nueva código postal</a></td>
        </tr>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Código Postal</th>
        <th scope="col">Colonia</th>
        <th scope="col">Opciones</th>
        <th scope="col"></th>
        </tr>
        </thead>
    <?php
        while($row = $query->fetch_assoc()){
            ?>
        <tr>
            <td><?php echo $row['id_codpos'];?></td>
            <td><?php echo $row['codpos'];?></td>
            <td><?php echo $row['colonia'];?></td>
            <td>
                <a href="cp.php?valor=<?php echo $row['id_codpos'];?>"> 
                <input type="submit" class="btn btn-danger" value="Eliminar"/>
                </a>
                
            </td>
            <td>
            <a href="mod_cp.php?valor=<?php echo $row['id_codpos'];?>"> 
                <input type="submit" class="btn btn-primary" value="Editar"/>
                </a>
            </td>
        </tr>
        <?php }?>
        
    </table>
            
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="cp.php?p=1">&laquo;</a></li>    
                        <?php
                            $mysqli->real_query("select count(*) as total from t_codpos");
                            $query = $mysqli->store_result();
                            $row = $query->fetch_assoc();
                    
                            //echo (floor(intval ($row['total']) / 5)+1);
                    
                            $paginas = (floor(intval ($row['total']) / 5)+1);
                            
                            for($i=1; $i<=$paginas; $i++){
                                echo "<li class='page-item'><a class='page-link' href='cp.php?p=".$i."'>".$i."</a></li>";
                            }
                            echo "<li class='page-item'><a class='page-link' href='cp.php?p=".$paginas."'>&raquo;</a></li>";
                        ?>
                </ul>
            </nav>
            
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

    <script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="assets/jquery/jquery.slim.min.js"></script>
    <script src="assets/tether/tether.min.js"></script>

    <script src="assets/b4/js/bootstrap.min.js"></script>
</body>

</html>