<?php
require('./make_pdf/fpdf.php');

try {
    
    $archivo="./pdfs/factura-skdk.pdf";
    $archivo_de_salida=$archivo;

    $pdf=new FPDF();  //crea el objeto
    $pdf->AddPage();  //añadimos una página. Origen coordenadas, esquina superior izquierda, posición por defeto a 1 cm de los bordes.

    $id_client =$_REQUEST['id_client'];

    include 'logic/bd/connection.php';

    $query = "SELECT cliente,telefono1,correo1,
    (SELECT codpos FROM t_codpos WHERE id_codpos =t_cliente.id_codpos) AS codigo_postal,
    (SELECT estado FROM t_estado WHERE id_estado =t_cliente.id_estado) AS nombre_estado,
    (SELECT colonia FROM t_colonias WHERE id_colonia =t_cliente.id_colonia) AS nombre_colonia
    
     FROM t_cliente WHERE id_usuario = $id_client";

    $select_user =  $mysqli->query($query);
    $info_user = $select_user->fetch_assoc();

    //logo de la tienda
    $pdf->Image('./make_pdf/logo_tienda.png' , 30 ,15, 30 , 13,'PNG', 'http://marketcarrito.epizy.com');

    // Encabezado de la factura
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(190, 10, "Factura de la tienda market", 0, 2, "C");
    $pdf->SetFont('Arial','B',10);
    $pdf->MultiCell(190,5, utf8_decode("Número de factura: 01"."\n"."Fecha: 5 de noviembre del 2019") , 0, "C", false);
    $pdf->Ln(2);

    // Datos de la tienda
    $pdf->SetFont('Arial','B',12);
    $top_datos=45;
    $pdf->SetXY(40, $top_datos);
    $pdf->Cell(190, 10, "Emisor", 0, 2, "J");
    $pdf->SetFont('Arial','',10);
    $pdf->MultiCell(190, //posición X
    5, //posición Y
    utf8_decode(
        "Tienda: Market.com\n".
        "Dirección: México  \n".
        "Población: Estado de méxico \n".
        "Provincia: Tecámac\n".
        "Código Postal: 8784154 \n".
        "Teléfono: (55)-12-34-33-23\n".
        "Indentificación Fiscal:\n85-64456454587445-15"
    )
    ,
    0, // bordes 0 = no | 1 = si
    "J", // texto justificado 
    false);

    // Datos del cliente
    $pdf->SetFont('Arial','B',12);
    $pdf->SetXY(125, $top_datos);
    $pdf->Cell(190, 10, "Receptor:", 0, 2, "J");
    $pdf->SetFont('Arial','',10);
    $pdf->MultiCell(
    190, //posición X
    5, //posicion Y
    utf8_decode(
        "Nombre: ".$info_user['cliente']." \n".
        "Correo: ".$info_user['correo1']."\n".
        "Teléfono: ".$info_user['telefono1']."\n".
        "Estado: ".$info_user['nombre_estado']."\n".
        "Colonia: ".$info_user['nombre_colonia']."\n".
        "Código Postal: ".$info_user['codigo_postal']."\n".
        "Identificación Fiscal:\n455151515484-62656"
    ), 
    0, // bordes 0 = no | 1 = si
    "J", // texto justificado
    false);
    //Salto de línea
    $pdf->Ln(15);
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(180, 0, "Productos comprados", 0, 1, "C");

    //Creación de la tabla de los detalles de los productos productos
    $top_productos = 118;
    $pdf->SetFont('Arial','B',12);

    $start_line = 2;
    $pdf->SetXY($start_line+ (1*35), $top_productos);
    $pdf->Cell(40, 5, 'Cantidad', 0, 1, 'C');
    $pdf->SetXY($start_line+ (2*35), $top_productos);
    $pdf->Cell(40, 5, 'Producto', 0, 1, 'C');
    $pdf->SetXY($start_line+ (3*35), $top_productos);
    $pdf->Cell(40, 5, 'Precio unitario', 0, 1, 'C');    
    $pdf->SetXY($start_line+ (4*35), $top_productos);
    $pdf->Cell(40, 5, 'Total', 0, 1, 'C');
   

    $e_productos = 5;

    $y = $top_productos+7; // variable para la posición top desde la cual se empezarán a agregar los datos

    $query = "SELECT pe.cantidad,
    (SELECT producto FROM t_producto WHERE id_producto =pe.id_producto) AS nombre_producto,
    (SELECT preven FROM t_producto WHERE id_producto =pe.id_producto) AS precio_producto 
    FROM t_pedido pe";
    $products = $mysqli->query($query);
    $total_venta = 0;
    while($row = $products->fetch_assoc())
    {
        $pdf->SetFont('Arial','',9);
        $pdf->SetXY($start_line+ (1*35), $y);
        $pdf->Cell(40, 5, $row['cantidad'], 0, 1, 'C');
        $pdf->SetXY($start_line+ (2*35), $y);
        $pdf->Cell(40, 5, $row['nombre_producto'], 0, 1, 'C');
        $pdf->SetXY($start_line+ (3*35), $y);
        $pdf->Cell(40, 5, "$ ".$row['precio_producto'], 0, 1, 'C');
        $pdf->SetXY($start_line+ (4*35), $y);
        $total = $row['cantidad'] *$row['precio_producto'];
        $total_venta += $total;
        $pdf->Cell(40, 5, "$ ".$total, 0, 1, 'C');

    // aumento del top 5 cm
    $y = $y + 5;
    }
    
    $pdf->Ln(10);
    $pdf->SetFont('Arial','B',10);
    $precio_envio = 200;
    $pdf->Cell(190, 5, utf8_decode("Gastos de envío: $ ".$precio_envio), 0, 1, "C");
    $pdf->Cell(190, 5, "I.V.A (20 %) : $ ".($total_venta * 0.20), 0, 1, "C");
    $pdf->Cell(190, 5, utf8_decode("Total venta : $ ".($total_venta )), 0, 1, "C");
    $pdf->Cell(190, 5, utf8_decode("Subtotal: $ ".($total_venta + $precio_envio )), 0, 1, "C");
    $pdf->Cell(190, 5, "TOTAL: $ ".($total_venta + $precio_envio + ($total_venta * 0.20)), 0, 1, "C");
    $pdf->Line(30,40,190,40); //Linea principal amisor
    $pdf->Line(30,103,190,103);
    $pdf->Output($archivo, 'F',true);//cierra el objeto pdf

} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}

?>