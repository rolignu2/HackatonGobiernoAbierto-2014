<?php

if(isset($_GET['cmdregistrar']))
{
    $pass = $_GET['pass'];
    $rep_pass = $_GET['rep_pass'];
    if(strcmp($pass, $rep_pass) !== 0 )
    {
        $pass_bad = true;
    }
    else{
        require_once('MysqlConexion.class.php');
        
        $id_t = $_GET['id_twitter'];
        $nombre = $_GET['nombre'];
        $mail = $_GET['email'];
        $genero = $_GET['genero'];
        $nacimiento = $_GET['birthday'];
        $usuario =  $_GET['usuario'];
        $imagen =  $_GET['cmdimg'];
        $twitter = "https://twitter.com/$usuario";
        
        $conn = new Consulta();
        
        
         $sql = "INSERT INTO login (id_login , usuario , password , estado)"
                    . " VALUES('$id_t' ,'$usuario' ,'$pass' ,1)";
        

  
        $conn->GetConsulta($sql);
        $conn->Resultado();
        if( $conn->RowsNums() >= 1)
        {
            $sql = "INSERT INTO  usuarios (id_usuario, id_login,email, nombre, pais,facebook,genero,nacimiento,twitter,foto)"
                . " VALUES ('$id_t' , '$id_t' ,'$mail', '$nombre' , 'null' , 'null' , '$genero' , '$nacimiento' , '$twitter' , '$imagen'  )";
            
            $conn->GetConsulta($sql);
            $conn->Resultado();
            if($conn->RowsNums() >= 1)
            {
                session_start();
                $_SESSION['id'] = $id_t;
                $_SESSION['user'] = $usuario;
                $_SESSION['nombre'] = $nombre;
                $_SESSION['facebook'] = false;
                $_SESSION['twitter'] = true;
                $_SESSION['imagen'] = $imagen;
                $_SESSION['email'] = $mail;
                header('Location:index.php');
            }
            else
            {
                echo "error " . $conn->RowsNums();
            }
        }
        else
        {
            header('Location:index.php');
            
        }
        
        $conn->CloseConection();
      

        return;
    }
}
?>
