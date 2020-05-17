<?php 
    $type_admin = 1;
    $type_secretary = 2;
    $type_user = 3;

    if (isset($_POST['user']) && isset($_POST['password'])){
        $user = $_POST['user'];
        $password = sha1($_POST['password']);

        if($user != '' && $password != ""){        
            include ('logic/bd/connection.php');
            $query = "SELECT id_usuario,nevel,status FROM t_usuarios WHERE correo = '".$user."' AND contrapass = '".$password."' AND status = 1;";
            $mysqli -> real_query($query);
            $query = $mysqli->store_result();
            $result = $query -> fetch_assoc();

            if(isset($result['id_usuario'])) {     
                switch ($result['nevel']) {
                    case 1: 
                        echo "<script> alert('Eres admin');</script>";
                        header('Location:admin/pages/menu_admin.html');
                    break;
                    case 2:
                        echo "<script> alert('Eres secretaria');</script>";
                        header('Location:admin/pages/menu_secretary.html');
                    break;
                    case 3:
                        echo "<script> alert('Eres usuario');</script>";
                        session_start();
                        $_SESSION['id_user'] = $result['id_usuario'];
                        if(isset($_POST['page'])){
                            header("Location:".$_POST['page']);
                        }else {
                            header("Location:index.php");
                        }
                    break;
                }
            }else {
                echo 'Usuario no encontrado..';
            }
        }else 
            echo 'uno de los valores password y user están vacios';        
    }else  
        echo 'Usuario no recibido';
?>
