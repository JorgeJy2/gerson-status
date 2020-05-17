<?php 
    //Crear captchat
    $imagen = imagecreate(80,40);
    $fondo = imagecolorallocate($imagen, 242, 99, 75);
    if(isset($_GET['codigo_capcha'])){
        $codigo_capcha = $_GET ['codigo_capcha'];
    }
    $texto = imagecolorallocate($imagen, 255,255,255);
    ImageFill($imagen, 50, 0 ,$fondo);
    imagestring($imagen, 100,10,10, $codigo_capcha, $texto);
    header('Content-type: image/png');
    imagepng($imagen);
?>