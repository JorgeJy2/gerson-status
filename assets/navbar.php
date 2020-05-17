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
                                        <button class="dropdown-item">Ver pefil  <i class="fa fa-eye" aria-hidden="true"></i></button>
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
