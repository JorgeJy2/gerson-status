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


<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';


$valid_captcha = true;
    if (isset($_POST['submit'])) {
        $to = "jorge.jacobo.francisco.306@gmail.com"; // this is your Email address

        $name = $_POST['name_user'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $commentary  = $_POST['commentary'];
        $capchat = $_POST['capchat'];
        $subject = "Form submission";
        $headers = "From:" . $email;

        //data
        $msg = "Your MSG <br>\n";
        //Headers
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From: <" . $email . ">";
        // if(mail($to,$subject,$msg,$headers)) {
        //     echo "Mail Sent.";
        // }else {
        //     echo "No sent";
        // }

        $codigo_capchat = $_POST['codigo_capchat'];
        $valid_captcha = ($capchat == $codigo_capchat);
        if ($valid_captcha) {

            $subject = "El usuario $email mandó su cometario";
            //data
            $msg = "El usuario dijo lo siguiente:<br>\n $commentary<br><h4>Datos de contacto</h4>Nombre: $name<br>Teléfono: $phone<br>Correo: $email";
            $msg_user = "<center><h1>Gracias por ponerte en contacto<h1></center><br> revisaremos tus comentarios y nos pondremos en contacto contigo.";


            // $headers  = "MIME-Version: 1.0\r\n";
            // $headers .= "Content-type: text/html; charset=UTF-8\r\n";
            // $headers .= "From: <" . $email . ">";

            // if (mail($to, $subject, $msg, $headers)) {
            //     echo "Mail Sent.";
            // } else {
            //     echo "No sent";
            // }
            // if (mail($email, $subject, $msg_user, $headers)) {
            //     echo "Mail Sent.";
            // } else {
            //     echo "No sent";
            // }

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
                    $mail->addAddress($email);     // Add a recipient
                    // Attachments
                    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                    // Content
            
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Gracias por ponerte en contacto';
                    $mail->Body    = $msg_user;
                    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    $mail->send();


                    $mail->addAddress('jorge.jacobo.francisco.306@gmail.com');     // Add a recipient
                    // Attachments
                    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                    // Content
            
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'comentarios acerca de la pagina Founiture store';
                    $mail->Body    = $msg;
                    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                    
                    $mail->send();

                    // echo 'Message has been sent';
                } catch (Exception $e) {
                    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }

        }
    }
    $codigo_captcha = rand(100000, 999999);
?>

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
    <h2 class="">Contactanos</h2>
    <div class="imagen-user-register mt-4">
        <i class="fa fa-phone" aria-hidden="true"></i>
    </div>
    <!-- mt-5 main_login text-center -->

    <?php if (!$valid_captcha) { ?>
        <h1>Capcha invalido...</h1>
        <form class="mt-5 main_login text-center" action="" method="post">
            <div class="form-group row">
                <label for="nameUser" class="col-sm-2 col-form-label">Nombre</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nameUser" value="<?php echo ($name); ?>" placeholder="Nombre del cliente" minlength="3" name="name_user" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label">Teléfono</label>
                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="phone" value="<?php echo ($phone); ?>" placeholder="55-145151515-15" minlength="9" name="phone" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Correo</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" value="<?php echo ($email); ?>" placeholder="correo@gmail.com" minlength="9" name="email" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="comentario" class="col-sm-2 col-form-label">Comentario</label>
                <div class="col-sm-10">
                    <textarea type="text" class="form-control" id="comentario" required minlength="15" name="commentary"><?php echo ($commentary); ?></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="capcha" class="col-sm-2 col-form-label">Ingrese el código</label>
                <div class="col-sm-4">
                    <img src="captcha generado.php?codigo_capcha=<?php echo ($codigo_captcha); ?>">
                </div>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="capcha" minlength="4" name="capchat" required>
                </div>
            </div>
            <input type="hidden" value="<?php echo ($codigo_captcha); ?>" name="codigo_capchat">
            <button type="submit" name="submit" class="btn btn-car-primary-register btn-block">Enviar</button>
        </form>

    <?php } else {  ?>
        <form class="mt-5 main_login text-center" action="" method="post">
            <div class="form-group row">
                <label for="nameUser" class="col-sm-2 col-form-label">Nombre</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nameUser" placeholder="Nombre del cliente" minlength="3" name="name_user" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label">Teléfono</label>
                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="phone" placeholder="55-145151515-15" minlength="9" name="phone" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Correo</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" placeholder="correo@gmail.com" minlength="9" name="email" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="comentario" class="col-sm-2 col-form-label">Comentario</label>
                <div class="col-sm-10">
                    <textarea type="text" class="form-control" id="comentario" required minlength="15" name="commentary"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="capcha" class="col-sm-2 col-form-label">Ingrese el código</label>
                <div class="col-sm-4">
                    <img src="captcha generado.php?codigo_capcha=<?php echo ($codigo_captcha); ?>">
                </div>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="capcha" minlength="4" name="capchat" required>
                    <input type="hidden" value="<?php echo ($codigo_captcha); ?>" name="codigo_capchat">
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-car-primary-register btn-block">Enviar</button>
        </form>
    <?php } ?>
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

</html>