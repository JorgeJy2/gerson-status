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


<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/Exception.php';
    require 'phpmailer/PHPMailer.php';
    require 'phpmailer/SMTP.php';

    include('logic/bd/connection.php');

    $msg = "<h1>Nueva compra realizada</h1>";
    $msg .= "EL usuario con el nombre: <br>";
    
    $query = "SELECT pe.cantidad,
    (SELECT producto FROM t_producto WHERE id_producto =pe.id_producto) AS nombre_producto,
    (SELECT preven FROM t_producto WHERE id_producto =pe.id_producto) AS precio_producto 
    FROM t_pedido pe ";

    $products = $mysqli->query($query);

    $msg .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
    $msg .= "<tr style='background: #eee;'><td><strong>Producto:</strong></td><td>Precio</td><td>Cantidad</td><td>Total</td></tr>";
    
    while($row = $products->fetch_assoc())
    {
        $msg .= "<tr><td>".$row['nombre_producto']."</td><td> $ ".$row['precio_producto']."</td><td>".$row['cantidad']." </td><td>0</td></tr>";
    }
    $msg .= "</table>";
    $msg.= "Total :<br> ";
    $msg.= "Factura : <a href='http://localhost/carrito_compras/pdfs/factura_a2b11d.pdf'>Ver factura</a>";

    $msg_user = "<center><h1>Gracias por comprar el producto producto<h1></center><br>Trabajaremos en tu compra.";

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
        $mail->setFrom('marketcart23@gmail.com', 'Market car');
        $mail->addAddress('jorge.jacobo.francisco.306@gmail.com');     // Add a recipient
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "Compra de producto {$selected_article['producto']}";
        $mail->Body    = $msg;
        $responseemail = $mail->send();
        echo ($responseemail);

        // $mail->addAddress($email);     // Add a recipient
        // $mail->isHTML(true);                                  // Set email format to HTML
        // $mail->Subject = "compra del producto {$selected_article['producto']} Founiture store";
        // $mail->Body    = $msg_user;
        // // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        // $mail->send();
        // echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
?>



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