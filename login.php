
<?php

 
 require_once('MysqlConexion.class.php');
 
 $usuario = null;
 $pass = null;
 $conn = new Consulta();

 if(isset($_POST['user']))
 {
     $usuario = $_POST['user'];
     $pass = $_POST['pass'];
 }
 else
 {
     redirect();
 }
 
  $sql = "SELECT usuarios.id_usuario as id , usuarios.nombre as nombre , "
          . "usuarios.email as email , usuarios.facebook as fb ,"
         . " usuarios.twitter as tw , usuarios.foto as foto FROM login"
         . " INNER JOIN usuarios ON login.id_login=usuarios.id_login"
         . " WHERE login.usuario LIKE '$usuario' AND login.password LIKE '$pass'";
 
 if ($usuario == null || $pass == null) {
    return;
} else {
    $conn = new Consulta();
    $conn->GetConsulta($sql);
    $result = $conn->Resultado();
    
    if($conn->RowsNums() <=0)
    {
         $sql = "SELECT usuarios.id_usuario as id , usuarios.nombre as nombre , "
          . "usuarios.email as email , usuarios.facebook as fb ,"
         . " usuarios.twitter as tw , usuarios.foto as foto FROM login"
         . " INNER JOIN usuarios ON login.id_login=usuarios.id_login"
         . " WHERE usuarios.email LIKE '$usuario' AND login.password LIKE '$pass'";
         
         $conn->GetConsulta($sql);
         $result = $conn->Resultado();
         if($conn->RowsNums() >=1){
              $conn->CloseConection();
               ControlLog($result);
         }
         else
         {
             redirect();
         }
        
    }
    else if ($conn->RowsNums() >= 1)
    {
        $conn->CloseConection();
        ControlLog($result);
    }
    else{
        redirect();
    }
}

?>

<?php

function ControlLog($result = array())
{
        session_start();
        foreach($result as $key=>$value)
        {
            switch ($key)
            {
                case "id":
                    $_SESSION['id']=$value;
                    break;
                case "nombre":
                    $_SESSION['nombre']=$value;
                    break;
                case "email":
                    $_SESSION['email']=$value;
                    break;
                case "fb":
                    if($value !='null'){
                        $_SESSION['facebook']=true;
                        $_SESSION['twitter']=false;
                    }
                    else{
                        $_SESSION['facebook']=false;
                        $_SESSION['twitter']=true;
                    }
                    break;
                case "foto":
                    $_SESSION['imagen']=$value;
                    break;
            }
        }
        header('Location:index.php');
}


function redirect()
{
    header("Location:index.php?log_err=true");
    return;
}



?>