<?php 
    session_start();
?>
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
                                <a href="./index.php?category=<?php echo $row['id_categoria']; ?>">
                                    <button class="dropdown-item" ><?php echo $row['categoria']; ?></button>
                                </a>
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
<div class="main_content space_content mt-md-4 fadeIn slow">

    <?php 

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        require 'phpmailer/Exception.php';
        require 'phpmailer/PHPMailer.php';
        require 'phpmailer/SMTP.php';

         //Leer el archivo JSON
        //  $data = file_get_contents("assets/data/articles.json"); 
        //  //Decodificar el JSON en un MAPA
        //  $products = json_decode($data, true);

         $valid_captcha = true;

         if(isset($_GET['id'])){
             $id = $_GET['id'];
         }
         
        // $related_article = array();
        // foreach ($products['articles'] as $product) { 
        //     if($product['id'] == $id){
        //         $selected_article = $product;
        //     }else{
        //         array_push($related_article, $product);
        //     }
        // }

        include('logic/bd/connection.php');
                        
        $query= "SELECT id_producto,producto,preven,descripcion,imagen from t_producto WHERE id_producto=".$id;

        $mysqli->real_query($query);
    
        $query  = $mysqli-> store_result();
        while($row = $query->fetch_assoc()) {  
            $selected_article = $row;
        }

        if(isset($_POST['submit'])){
            $to = "jorge.jacobo.francisco.306@gmail.com"; // this is your Email address
        
            $name = $_POST ['name_user'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $cantidad  = $_POST['cantidad'];
            $capchat = $_POST['capchat'];
            
            $subject = "Form submission";
            $headers = "From:" . $email;
        
            //data
            $msg = "Your MSG <br>\n";       
            //Headers
            $headers  = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=UTF-8\r\n";
            $headers .= "From: <".$email. ">" ;
            // if(mail($to,$subject,$msg,$headers)) {
            //     echo "Mail Sent.";
            // }else {
            //     echo "No sent";
            // }
            
            $codigo_capchat = $_POST['codigo_capchat'];
            $valid_captcha= ($capchat == $codigo_capchat);
        } 
        $codigo_captcha = rand(100000,999999);
    ?>
    <div class="container container_fliudsu">
        <div class="row">
            <div class="col-md-6">
                <img id="main_img_product" class="img-fluid" width="70%" src="<?php echo($selected_article['imagen']); ?>" alt="Product">
            </div>
            <div class="col-md-6">
                <h1><?php echo($selected_article['producto']); ?></h1>
                <p class="description-article-detail"><?php echo($selected_article['descripcion']); ?> </p>
                <div class="container">
                    <!-- <div class="row">
                        <div class="col-md-6">Color</div>
                        <div class="col-md-6"> ...</div>
                    </div> -->

                    <!-- <div class="row mt-3">
                         <div class="col-md-6">Número de productos</div>
                        <div class="col-md-6">
                            <button class="btn"> + </button> 1 <button class="btn"> - </button>
                        </div> -->
                    <!-- </div> -->

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <h3>$<?php echo($selected_article['preven']); ?></h3>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <!-- <a href="./index.php">
                                    <button class="btn btn-car-favorite">Cancelar</button>
                                </a> -->

                                <!-- <a href="details_product.php?id=<?php echo($id);?>&comprar=true"> -->
                                <button type="button" id="btn_add_car" onclick="addArticleToCard(<?php echo $id; ?>)" class="btn btn-car-sale btn-block">Agregar al carrito <i class="fa fa-shopping-cart" aria-hidden="true"></i> </button>
                                <!-- </a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
        <div class="col">
        <?php 
            if(isset($_GET['comprar'])) {
                if(isset($_POST['email'])) {
                    if(!$valid_captcha) {  ?>
                        <form class="col-md-12 form_buy_article" action="" method="post" >
                            <div class="text-center">
                            <h1>captcha invalido</h1>
                            <h3>Datos para realizar la compra</h3>
                            </div>
                            <div class="form-group row mt-md-5">
                                <label for="nameUser" class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nameUser" value="<?php echo($name); ?>"
                                     placeholder="Nombre del cliente" minlength="3" name="name_user" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone" class="col-sm-2 col-form-label">Teléfono</label>
                                <div class="col-sm-10">
                                    <input type="tel" class="form-control" id="phone" value="<?php echo($phone); ?>"
                                    placeholder="55-145151515-15" minlength="9" name="phone" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Correo</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" value="<?php echo($email); ?>"
                                    placeholder="correo@gmail.com" minlength="9" name="email" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="comentario" class="col-sm-2 col-form-label">Cantidad</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="cantidad" min="1" value="<?php echo($cantidad); ?>"
                                     name="cantidad" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="capcha" class="col-sm-2 col-form-label">Ingrese el código</label>
                                <div class="col-sm-4">
                                    <img src="captcha generado.php?codigo_capcha=<?php echo($codigo_captcha); ?>">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="capcha" 
                                    minlength="6" name="capchat" required>
                                </div>
                            </div>

                          

                            <input type="hidden" value="<?php  echo($codigo_captcha);?>" name="codigo_capchat" >
                            <button type="submit"  name="submit" class="btn btn-car-sale btn-block">Enviar</button>
                        </form>
                            
                    <?php }else {          
                        $msg = "El usuario $email quiere comprar el siguiente producto:<br>\n <h4>Datos del producto</h4>Nombre: {$selected_article['name']}<br>Cantidad: $cantidad<br>Precio por unidad: $ {$selected_article['value']}";
                        
                        $msg_user = "<center><h1>Gracias por comprar el producto {$selected_article['producto']}<h1></center><br>Trabajaremos en tu compra.";

                        $mail = new PHPMailer(true);

                        try {
                            //Server settings
                            $mail->SMTPDebug = 0;                      // Enable verbose debug output
                            $mail->isSMTP();                                            // Send using SMTP
                            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                            $mail->Username   = 'marketcart23@gmail.com';                     // SMTP username
                            $mail->Password   = 'Escuela1234';                               // SMTP password
                            $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                            $mail->Port       = 587;                                    // TCP port to connect to
                    
                    
                            //Recipients
                            $mail->setFrom('marketcart23@gmail.com', 'Market car');
                            $mail->addAddress('jorge.jacobo.francisco.306@gmail.com');     // Add a recipient
                            // Attachments
                            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                            // Content
                    
                            $mail->isHTML(true);                                  // Set email format to HTML
                            $mail->Subject = "Compra de producto {$selected_article['producto']}";
                            $mail->Body    = $msg;
                            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
                            $mail->send();
            

            
                            $mail->addAddress($email);     // Add a recipient
                            // Attachments
                            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                            // Content
                    
                            $mail->isHTML(true);                                  // Set email format to HTML
                            $mail->Subject = "compra del producto {$selected_article['producto']} Founiture store";
                            $mail->Body    = $msg_user;
                            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                            
                            $mail->send();
            
                            // echo 'Message has been sent';
                        } catch (Exception $e) {
                            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        }
                        
                        ?>
                        <div class="col text-center">
                            <br><br>
                            <h3>Gracias por tu pedido</h3>
                            <br>
                            <p>trabajaremos en tu pedido</p>
                            <br>
                            <a href="./index.php">
                            
                            <button class="btn btn-car-sale btn-block">
                                Seguir comprando
                            </button>
                            
                            </a>
                            <br><br>
                        </div>
                    <?php  } 
                } else { ?>
                    <div class="row">
                        <form class="col-md-12 form_buy_article" action="" method="post" >
                            <div class="text-center">
                            <h3>Datos para realizar la compra</h3>
                            </div>
                            <div class="form-group row mt-md-5">
                                <label for="nameUser" class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nameUser"  
                                        placeholder="Nombre del cliente" minlength="3" name="name_user" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone" class="col-sm-2 col-form-label">Teléfono</label>
                                <div class="col-sm-10">
                                    <input type="tel" class="form-control" id="phone" 
                                    placeholder="55-145151515-15" minlength="9" name="phone" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Correo</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" 
                                    placeholder="correo@gmail.com" minlength="9" name="email" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="comentario" class="col-sm-2 col-form-label">Cantidad</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="cantidad" min="1" 
                                        value="1" name="cantidad" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="capcha" class="col-sm-2 col-form-label">Ingrese el código</label>
                                <div class="col-sm-4">
                                    <img src="captcha generado.php?codigo_capcha=<?php echo($codigo_captcha); ?>">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="capcha" 
                                    minlength="6" name="capchat" required>
                                </div>
                            </div>
                            <input type="hidden" value="<?php  echo($codigo_captcha);?>" name="codigo_capchat" >
                            <button type="submit"  name="submit" class="btn btn-car-sale btn-block">Enviar</button>
                        </form>
                     </div>

                    
            <?php } ?>         
        <?php } ?>

        </div>


        </div>
        <hr>
        <div class="row">
            <h4>Más fotos</h4>
        </div>

        <div class="row">
            <div class="col-md-2">
                <img class="more_product_img" onclick="chagePhoto('<?php echo($selected_article['imagen']); ?>')" src="<?php echo($selected_article['imagen']); ?>" alt="" srcset="">
            </div>
            <?php 
            
            $query= "SELECT imagen from t_imagenes WHERE id_producto=".$id;

            $mysqli->real_query($query);
        
            $query  = $mysqli-> store_result();
            while($row = $query->fetch_assoc()) {  ?>
                <div class="col-md-2">
                    <img class="more_product_img" onclick="chagePhoto('<?php echo $row['imagen'] ?>')" src="<?php echo $row['imagen'] ?>" alt="" srcset="">
                </div>
            <?php } ?>
        </div>

        <hr>
        <h4>Productos relacionados</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="mt-4">
                    <?php
                        // //Leer el archivo JSON
                        // $data = file_get_contents("assets/data/articles.json"); 
                        // //Decodificar el JSON en un MAPA
                        // $products = json_decode($data, true);

                        $query= "SELECT id_producto,producto,preven,imagen from t_producto WHERE id_producto!=".$id;

                        $mysqli->real_query($query);
                    
                        $query  = $mysqli-> store_result();
                        while($row = $query->fetch_assoc()) { ?>
                            <div class="product-car mx-auto shadow-sm rounded">
                                <div class="row">
                                    <div class="col-md-10">
                                        <strong><?php echo($row['producto']);?></strong>
                                        <p>$<?php echo($row['preven']);?></p>
                                    </div>
                                    <div class="col-md-2 text-right">
                                        <i class="fa fa-shopping-cart" id="ic_car_<?php echo ($row['id_producto']); ?>" onclick="newOrder(<?php echo ($row['id_producto']); ?>)"  aria-hidden="true"></i>
                                    </div>
                                </div>
                                <a href="details_product.php?id=<?php echo($row['id_producto']);?>">
                                    <div class="product-image mt-4 text-center" align="center">
                                        <img src="<?php echo($row['imagen']);?>" align="center">
                                    </div>
                                </a>
                            </div>
                        <?php } //End foreach ?>
                </div>
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

</footer>
<!-- Fin de pie de página -->

<script src="assets/pouch_db/pouchdb-7.1.1.min.js"></script>

<script src="assets/jquery/jquery.slim.min.js"></script>
<script src="assets/tether/tether.min.js"></script>

<script src="assets/b4/js/bootstrap.min.js"></script>

<script src="assets/js/manager_db.js"></script>
<script src="assets/js/manager_car.js"></script>
<script src="assets/js/details_car.js"></script>

</html>