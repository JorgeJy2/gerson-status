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
    <link rel="stylesheet" href="assets/css/product.css">

    

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>

<body>
<!-- Consulta -->
<?php
        include 'logic/bd/connection.php';
        $name = '';
        $precompra='';
        $preventa='';
        $descripcion='';
        $imagen='';
        $categoria='';
        $actualizar = false;

        if(isset($_REQUEST['eliminar_valor'])){
            $actualizar = false;
            $query = "DELETE FROM t_producto WHERE id_producto=".$_REQUEST['eliminar_valor'].";";
            $mysqli->query($query);
            echo "Correctamente eliminado";
        }
        if (isset($_REQUEST['txtproducto'])) {
            $name = $_REQUEST['txtproducto'];
            $precompra = $_REQUEST['txtprecom'];
            $preventa = $_REQUEST['txtventa'];
            $descripcion = $_REQUEST['txtdescripcion'];
           // $imagen = $_REQUEST['txtimagen'];
            $categoriaop = $_REQUEST['optioncatego'];
            
            if ($_REQUEST['btn'] == 'Guardar') {
                $actualizar = false;
               // $tamano = $_FILES['txtimagen']['size'];
               // $tipo = $_FILES['txtimagen']['type'];          
               
                $archivo = $_FILES['txtimagen']['name'];
                $prefijo =  substr(md5(uniqid(rand())),0,6);
                if($archivo != ""){
                    $typeImg = explode("/",$_FILES['txtimagen']['type'])[0];
                    if($typeImg == "image") {
                        $archivo = $name ."_". $prefijo;
                        //Guardamos el archivo
                        $porciones = explode(".", $_FILES['txtimagen']['name']);
                        $destino = "files/p_".$archivo.".".$porciones[1];
                        $imagen = $destino;
                       
                         if(copy($_FILES['txtimagen']['tmp_name'],$destino)){
                             $query = "INSERT INTO t_producto(producto,precom,preven,descripcion,imagen,id_categoria) VALUES ('".$name."',".$precompra.",".$preventa.",'".$descripcion."','".$imagen."',".$categoriaop.")";
                             if ($mysqli->query($query) === TRUE) {
                                 $id_insert_new = $mysqli->insert_id;
                              
                                 $total = count($_FILES['files']['name']);
                                for( $i=0 ; $i < $total ; $i++ ) {
                                     $archivo = $_FILES['files']['name'][$i];
                                     $prefijo =  substr(md5(uniqid(rand())),0,6);
                                     if($archivo != ""){
                                        $typeImg = explode("/",$_FILES['files']['type'][$i])[0];
                                        if($typeImg == "image") { 
                                            $archivo = $name ."_". $prefijo;
                                            //Guardamos el archivo
                                            $porciones = explode(".", $_FILES['files']['name'][$i]);
                                            $destino = "files/sub_img/s_".$archivo.".".$porciones[1];
                                            $imagen = $destino;
                                            if(copy($_FILES['files']['tmp_name'][$i],$destino)){
                                                $query = "INSERT INTO t_imagenes (imagen,id_producto,tipo,status) VALUES ('".$imagen."',".$id_insert_new.",2,1);";
                                                $mysqli->query($query);
                                            } else {
                                                $status = "Error al subir el archivo";
                                            }
                                        }else {
                                            echo '<h1> Solo se permiten archivos tipo imagen.. </h1><br> <h3>intente de nuevo</h3>';
                                        }
                                        
                                     }else {
                                         $status = "Error al subir la foto.";
                                     } 
                                 }    
                             } else {
                                 echo "Error: " . $sql . "<br>" . $conn->error;
                             }
                         } else { //end copy file
                             $status = "Error al subir el archivo";
                         }
                    }else {
                        echo '<h1> Solo se permiten archivos tipo imagen.. </h1><br> <h3>intente de nuevo</h3>';
                    }
                }else {
                    $status = "Error al subir la foto.";
                } 
            } else if($_REQUEST['btn'] == 'Aceptar') { //end save
                $actualizar = true;
                $id     = $_REQUEST['id_update'];
                $archivo = $_FILES['txtimagen']['name'];
                $prefijo =  substr(md5(uniqid(rand())),0,6);
                if($archivo != ""){
                    $typeImg = explode("/",$_FILES['txtimagen']['type'])[0];
                    if($typeImg == "image") {
                        $archivo = $name ."_". $prefijo;
                        //Guardamos el archivo
                        $porciones = explode(".", $_FILES['txtimagen']['name']);
                        $destino = "files/p_".$archivo.".".$porciones[1];
                        $imagen = $destino;
                        if(copy($_FILES['txtimagen']['tmp_name'],$destino)){
                            $query = "UPDATE t_producto SET  producto='".$name."',precom=".$precompra.",preven=".$preventa.",descripcion='".$descripcion."',imagen='".$imagen."',id_categoria=".$categoriaop." WHERE id_producto=".$id.";";
                        }
                    }else {
                        echo '<h1> Solo se permiten archivos tipo imagen.. </h1><br> <h3>intente de nuevo</h3>';
                    }
                }else {
                    $query = "UPDATE t_producto SET  producto='".$name."',precom=".$precompra.",preven=".$preventa.",descripcion='".$descripcion."',id_categoria=".$categoriaop." WHERE id_producto=".$id.";";
                }
                $mysqli->query($query);
                echo "Registro actualizado";
                header('Location: producto.php');


                $id_insert_new = $id;
                            
                $total = count($_FILES['files']['name']);

                for( $i=0 ; $i < $total ; $i++ ) {
                    $archivo = $_FILES['files']['name'][$i];
                    $prefijo =  substr(md5(uniqid(rand())),0,6);
                    if($archivo != ""){
                        $typeImg = explode("/",$_FILES['files']['type'][$i])[0];
                        if($typeImg == "image") {  
                            $archivo = $name ."_". $prefijo;
                            //Guardamos el archivo
                            $porciones = explode(".", $_FILES['files']['name'][$i]);
                            $destino = "files/sub_img/s_".$archivo.".".$porciones[1];
                            $imagen = $destino;
                            if(copy($_FILES['files']['tmp_name'][$i],$destino)){
                                $query = "INSERT INTO t_imagenes (imagen,id_producto,tipo,status) VALUES ('".$imagen."',".$id_insert_new.",2,1);";
                                $mysqli->query($query);
                            } else {
                                $status = "Error al subir el archivo";
                            }
                        }else {
                            echo '<h1> Solo se permiten archivos tipo imagen.. </h1><br> <h3>intente de nuevo</h3>';
                        }
                       
                    }else {
                        $status = "Error al subir la foto.";
                    } 
                }  

                // header('Location: producto.php');
            }   
        } else  if (isset($_REQUEST['edit_valor'])) {
            
            $actualizar = true;
            if(isset($_REQUEST['img_delete'])){
                echo 'llegó';
                $query = "DELETE FROM t_imagenes WHERE id_imagenes=".$_REQUEST['img_delete'];
                $mysqli->query($query);
            }
            $actualizar = true;
            $mysqli->real_query("SELECT * FROM t_producto WHERE id_producto=" . $_REQUEST['edit_valor'] . ";");
            $query  = $mysqli->store_result();
            $row = $query->fetch_assoc();
            $name = ($row['id_producto'] != null) ?  $row['producto'] : '';
            $precompra = ($row['id_producto'] != null) ?  $row['precom'] : '';
            $preventa = ($row['id_producto'] != null) ?  $row['preven'] : '';
            $descripcion = ($row['id_producto'] != null) ?  $row['descripcion'] : '';
            $imagen = ($row['id_producto'] != null) ?  $row['imagen'] : '';
            $categoria = ($row['id_producto'] != null) ?  $row['id_categoria'] : '';
            $id_update = $row['id_producto'];
            
        }

       // $mysqli->real_query("SELECT * FROM t_producto");
       // $query  = $mysqli->store_result();
      
        $mysqli->real_query("SELECT * FROM t_categorias
        INNER JOIN t_producto WHERE t_categorias.id_categoria=t_producto.id_categoria ");
        $query  = $mysqli->store_result();
       // $query = $mysqli -> query ("SELECT * FROM t_categorias");
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
                        <a class="dropdown-item" href="admin/pages/proveedores.php">Proveedores</a>
                        <a class="dropdown-item" href="admin/pages/almacen.php">Almacén</a>
                        <a class="dropdown-item" href="admin/pages/producto.php">Productos</a>
                        <a class="dropdown-item" href="admin/pages/categorias.php">Categorías</a>
                        <a class="dropdown-item" href="admin/pages/MenuDirecciones.php">Direcciones</a>
                        <a class="dropdown-item" href="admin/pages/compra.php">Compras</a>
                                
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <br>
    <div class="col-md-12 text-center">
                <h1>Productos</h1>
    </div>
    <!-- Inicio de contenido -->
    <div class="main_content space_content mt-md-5 fadeIn slow">
    <div class="content">
        <div class="row">
            
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Precio compra</th>
                            <th scope="col">Precio venta</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Opciones</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <?php 
                    if(isset($_GET['p'])){       
                        $inicio = (intval ($_GET['p'])-1)*5; 
                        $mysqli->real_query("SELECT * FROM t_categorias
                        INNER JOIN t_producto WHERE t_categorias.id_categoria=t_producto.id_categoria LIMIT ".$inicio.",5");
                        $query  = $mysqli->store_result();
                       }else {
                        $mysqli->real_query("SELECT * FROM t_categorias
                        INNER JOIN t_producto WHERE t_categorias.id_categoria=t_producto.id_categoria LIMIT 0,5");
                        $query = $mysqli->store_result();    
                        }

                    while($row = $query->fetch_assoc()) {?>
                        <tr>
                            <td><?php echo $row['id_producto'];?></td>
                            <td><?php echo $row['producto'];?></td>
                            <td><?php echo $row['precom'];?></td>
                            <td><?php echo $row['preven'];?></td>
                            <td><?php echo $row['descripcion'];?></td>
                            <td>
                                <img class="imagen_product_main" src="<?php echo $row['imagen'];?>" alt="" srcset="">
                            </td>
                            <td><?php echo $row['categoria'];?></td>
                            <td><a href="producto.php?edit_valor=<?php echo $row['id_producto'];?>"><button class="btn btn-primary">Editar</button></a></td>
                            <td><a href="producto.php?eliminar_valor=<?php echo $row['id_producto'];?>"><button class="btn  btn-danger">Eliminar</button></a></td>
                            
                        </tr>
                    <?php } ?>
                    
                </table>
            </div>
        </div>
        <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="producto.php?p=1">&laquo;</a></li>    
                        <?php
                            $mysqli->real_query("select count(*) as total from t_producto");
                            $query = $mysqli->store_result();
                            $row = $query->fetch_assoc();
                    
                            //echo (floor(intval ($row['total']) / 5)+1);
                    
                            $paginas = (floor(intval ($row['total']) / 5)+1);
                            
                            for($i=1; $i<=$paginas; $i++){
                                echo "<li class='page-item'><a class='page-link' href='producto.php?p=".$i."'>".$i."</a></li>";
                            }
                            echo "<li class='page-item'><a class='page-link' href='producto.php?p=".$paginas."'>&raquo;</a></li>";
                        ?>
                </ul>
            </nav>
        <hr>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <h2>Gestión de productos</h2>

                </div>
                <form method="post" action="producto.php" enctype="multipart/form-data">
                    <label >Producto:</label>
                    <input type="text" value="<?php echo ($name); ?>" class="form-control validarAlfabetico" name="txtproducto" required/>
                    <label >Precio compra:</label>
                    <input type="text" value="<?php echo ($precompra); ?>" class="form-control validarNumerico" name="txtprecom" required/>
                    <label >Precio venta:</label>
                    <input type="text" value="<?php echo ($preventa); ?>" class="form-control validarNumerico" name="txtventa" required/>
                    <label >Descripción:</label>
                    <input type="text" value="<?php echo ($descripcion); ?>" class="form-control validarAlfaNumerico" name="txtdescripcion" required/>
                    <label >Elige nueva categoria:</label>

                    <select class="form-control" name ="optioncatego">
                        <option value="0" selected="true"  disabled="disabled">Seleccione:</option>
                        <?php
                            $mysqli->real_query("SELECT * FROM t_categorias;");
                            $query  = $mysqli->store_result();
                            while ($valores = mysqli_fetch_array($query)) { ?>
                                <option value="<?php echo $valores['id_categoria'];?>" 
                                <?php
                                                                    if ($actualizar) {
                                                                      if ($valores['id_categoria'] == $categoria) {
                                                                        echo 'selected';
                                                                      }
                                                                    }
                                                                    ?>    
                                >
                                    <?php echo $valores['categoria'];?>    
                                </option>
                            <?php } ?>
                    </select>
                    <br>
                    <label >Foto principal:</label>   
                        <input type="file" accept="image/*" class="form-control" name="txtimagen" <?php 
                            if(!$actualizar) {
                                echo 'required';
                            }
                        ?>/>
                    <br>
                    <label >Más fotos:</label>   
                    <input name="files[]" id="file-upload" class="form-control" type="file" accept="image/*"  multiple/>
                    <br>
                    <div class="text-center">
                        <?php if ($name === '') { ?>
                            <input type="submit" name="btn" class="btn btn-success" value="Guardar">
                        <?php } else { ?>
                            <input type="submit" name="btn" class="btn btn-success" value="Aceptar">
                            <input type="hidden" name="id_update" value="<?php echo ($id_update); ?>">
                        <?php } ?>
                        <input type="button" class="btn btn-danger" value="Cancelar" onClick="window.location='producto.php'" />
                    </div>
                   
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                <div id="carouselExampleControls" class="carousel slide course_data" data-ride="carousel">
                    <div class="carousel-inner" id="file-preview-zone">
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    

        <div class="row">
            <div class="col-md-12">
                <?php 
                    if($actualizar) { ?>
                        <div class="text-center">
                            <hr>
                            <h3>Más fotos</h3>
                            <br>
                        </div>
                        
                        <?php
                            $mysqli->real_query("  SELECT id_imagenes,imagen FROM t_imagenes WHERE id_producto=".$id_update);
                            $query  = $mysqli->store_result();
                            while($row = $query->fetch_assoc()) {?>
                                   
                                <img class="img-fluid secundary_img_product" src="<?php echo $row['imagen'];?>" alt="" srcset="">
                                <a href="producto.php?edit_valor=<?php echo $id_update;?>&img_delete=<?php echo $row['id_imagenes'];?>">
                                <button class="btn btn-danger">
                                    <i class="fa fa-trash" aria-hidden="true"></i> 
                                </button></a>
                            <?php } ?>
                       
                <?php }?>
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
    <script src="assets/js/producto.js"></script>
    <script src="assets/js/validador.js"></script>
</body>

</html>