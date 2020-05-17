<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Carrito de compras</title>

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
<?php
        include 'logic/bd/connection.php';

        $imagen = '';
        if(isset($_REQUEST['eliminar_valor'])){
            $query = "DELETE FROM t_carrusel WHERE id_imagen=".$_REQUEST['eliminar_valor'].";";
            $mysqli->query($query);
        }

        if (isset($_REQUEST['btn'] )) {
            
            $archivo = $_FILES['coursel']['name'];
            $prefijo =  substr(md5(uniqid(rand())),0,6);
            if($archivo != ""){
                $typeImg = explode("/",$_FILES['coursel']['type'])[0];
                if($typeImg == "image") {
                    $archivo = $name ."_". $prefijo;
                    //Guardamos el archivo
                    $porciones = explode(".", $_FILES['coursel']['name']);
                    $destino = "files/ccc_".$archivo.".".$porciones[1];
                    $imagen = $destino;
                     if(copy($_FILES['coursel']['tmp_name'],$destino)){
                        $upload_img = true;
                        //    header('Location: carrusel.php');
                     }else {
                        $upload_img= false;
                         echo "No copiado"; 
                     }
                }else
                    echo "No es una imagen";
            } else 
                echo "No llego la imagen";   


            if ($_REQUEST['btn'] == 'Guardar' && $upload_img) {
                $query = "INSERT INTO t_carrusel(imagen) VALUES ('$destino')";
                $mysqli->query($query);  
                header('Location: carrusel.php');
            } else if($_REQUEST['btn'] == 'Aceptar') {
                $id     = $_REQUEST['id_update'];
                $query = "UPDATE t_carrusel SET  imagen='$destino' WHERE id_imagen=$id";
                $mysqli->query($query);
                header('Location: carrusel.php');
            }   
        } else  if (isset($_REQUEST['edit_valor'])) {
            $mysqli->real_query("SELECT * FROM t_carrusel WHERE id_imagen=" . $_REQUEST['edit_valor'] . ";");
            $query  = $mysqli->store_result();
            $row = $query->fetch_assoc();
            $imagen = ($row['id_imagen'] != null) ?  $row['imagen'] : '';
            $id_update = $row['id_imagen'];
        }
      
      //  $mysqli->real_query("SELECT * FROM t_carrusel");
      //  $query  = $mysqli->store_result();
    ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="admin/pages/menu_admin.html">Admin shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Inicio usuarios</a>
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

    <!-- Inicio de contenido -->
    <div class="container">
    <div class="row mt-4">
      <div class="col-md-12 text-center">
        <h1>Administración de Carrusel</h1><br>
      </div>

      <div class="col-md-12">
        <div id="table_register">
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Imagen</th>
                <th scope="col"></th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
            <?php 

        if(isset($_GET['p'])){       
          $inicio = (intval ($_GET['p'])-1)*5; 
          $mysqli->real_query("SELECT * FROM t_carrusel LIMIT ".$inicio.",5");
          $query  = $mysqli->store_result();
         }else {
          $mysqli->real_query("SELECT * FROM t_carrusel LIMIT 0,5");
          $query = $mysqli->store_result();    
          }
                while($row = $query->fetch_assoc()) {?>
                <tr>
                    <td><?php echo $row['id_imagen'];?></td>
                    <td><img class="imagen_course" src="<?php echo $row['imagen'];?>" alt="" srcset=""></td>
                    
                    <td><a href="carrusel.php?eliminar_valor=<?php echo $row['id_imagen'];?>"><button class="btn  btn-danger">Eliminar</button></a></td>
                    <td><a href="carrusel.php?edit_valor=<?php echo $row['id_imagen'];?>"><button class="btn btn-primary">Editar</button></a></td>
                    
                </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div><!-- Fin parte de la tabla-->
    <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="carrusel.php?p=1">&laquo;</a></li>    
                        <?php
                            $mysqli->real_query("select count(*) as total from t_carrusel");
                            $query = $mysqli->store_result();
                            $row = $query->fetch_assoc();
                            $paginas = (floor(intval ($row['total']) / 5)+1);
                            
                            for($i=1; $i<=$paginas; $i++){
                                echo "<li class='page-item'><a class='page-link' href='carrusel.php?p=".$i."'>".$i."</a></li>";
                            }
                            echo "<li class='page-item'><a class='page-link' href='carrusel.php?p=".$paginas."'>&raquo;</a></li>";
                        ?>
                </ul>
            </nav>
    <!-- Formulario inicio-->
    <div class="row">
      <div class="col-md-12 text-center">
      <hr>

      <h3>Gestión de carrusel</h3>
      <form method="post" action="carrusel.php" enctype="multipart/form-data">
        <label >Imagen:</label>
        <input type="file" name="coursel" accept="image/*" class="form-control" required>
        <br>                
        <?php if ($imagen === '') { ?>
                <input type="submit" name="btn" class="btn btn-success" value="Guardar">
            <?php } else { ?>
                <input type="submit" name="btn" class="btn btn-success" value="Aceptar">
                <input type="hidden" name="id_update" value="<?php echo ($id_update); ?>">
            <?php } ?>
        <input type="button" class="btn btn-danger" value="Cancelar" onClick="window.location='carrusel.php'" />
    </form><br>
      </div>
    </div>


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
   <script src="assets/js/validador.js"></script>
</body>

</html>