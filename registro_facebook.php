

<?php

$pass_bad = false;
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
        
        $id = $_GET['nl_id'];
        $nombre = $_GET['nl_nombre'];
        $mail = $_GET['nl_email'];
        $genero = $_GET['nl_genero'];
        $pais = $_GET['nl_pais'];
        $facebook =  $_GET['nl_fb'];
        $nacimiento = $_GET['nl_birthday'];
        $usuario =  $_GET['nl_usuario'];
        $imagen =  $_GET['cmdimg'];
        
        $conn = new Consulta();
        
        
         $sql = "INSERT INTO login (id_login , usuario , password , estado)"
                    . " VALUES('$id' ,'$usuario' ,'$pass' ,1)";
        

  
        $conn->GetConsulta($sql);
        $conn->Resultado();
        if( $conn->RowsNums() >= 1)
        {
            $sql = "INSERT INTO  usuarios (id_usuario, id_login,email, nombre, pais,facebook,genero,nacimiento,twitter,foto)"
                . " VALUES ('$id' , '$id' ,'$mail', '$nombre' , '$pais' , '$facebook' , '$genero' , '$nacimiento' , 'null' , '$imagen'  )";
            
            $conn->GetConsulta($sql);
            $conn->Resultado();
            if($conn->RowsNums() >= 1)
            {
                session_start();
                $_SESSION['id'] = $id;
                $_SESSION['user'] = $usuario;
                $_SESSION['nombre'] = $nombre;
                $_SESSION['facebook'] = true;
                $_SESSION['twitter'] = false;
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
            header('Location:registro_facebook.php');
        }
        
        $conn->CloseConection();
      
        
        return;
    }
}

include 'body.class.php';
$cuerpo = new body();
$script = "<script>
  window.fbAsyncInit = function() {
  FB.init({
    appId      : '142489082613367', 
    status     : true, 
    cookie     : true, 
    xfbml      : true
  });

  FB.Event.subscribe('auth.authResponseChange', function(response) {
    if (response.status === 'connected') {
      DatosFacebook();
    } else if (response.status === 'not_authorized') {
      FB.login();
    } else {
      FB.login();
    }
  });
  };

  (function(d){
    var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement('script'); js.id = id; js.async = true;
    js.src = '//connect.facebook.net/en_US/all.js';
    ref.parentNode.insertBefore(js, ref);
  }(document));

 
  function DatosFacebook() {
    FB.api('/me', function(response) {
      document.getElementById('nl_id').value = response.id;
      document.getElementById('nl_nombre').value = response.name;
      document.getElementById('nl_email').value = response.email;
      document.getElementById('nl_genero').value = response.gender;
      document.getElementById('nl_pais').value = response.location.name;
      document.getElementById('nl_fb').value = response.link;
      document.getElementById('nl_birthday').value = response.birthday;
      document.getElementById('nl_usuario').value = response.username;
      var imagen='https://graph.facebook.com/'+ response.username + '/picture';
      document.getElementById('cmdimg').value = imagen;
      document.images['img'].src= imagen;
    });
  }
 
</script>
<style>
input
{
  box-shadow:inset 0 0 2px 2px #888;
}

.error {
       font-family:Arial, Helvetica, sans-serif; 
       font-size:13px;
       border: 1px solid;
       margin: 10px 0px;
       padding:15px 10px 15px 50px;
       background-repeat: no-repeat;
       background-position: 10px center;
}

.error {
       color: #D8000C;
       background-color: #FFBABA;
}

</style>

";


echo $cuerpo->get_head($script);
echo $cuerpo->get_menu();

?>

<form method="get" action="#" id="frm" >
<table width="752" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  <input type="hidden" name="cmdimg" id="cmdimg" value="" />
  <input type="hidden" name="nl_id" id="nl_id" value="" />
  </tr>
  <tr>
    <td  class="auto-style1" style="height: 38px">	<br />
        <span>&nbsp;DATOS DEL USUARIO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </span></td>
  </tr>
  <tr>
    <td style="height: 117px">
    <br />
     <div id="seccion_facebook" style="position: absolute; width: 279px; height: 74px; z-index: 1; left: 219px; top: 90px">
	 	<span class="green button" style="left: 315px; top: 225px; width: 174px">
	 <?php
	    echo '<fb:login-button show-faces="false" width="600" scope="user_location" max-rows="1"></fb:login-button>';
	 	echo "</span>";
	 ?>
	</div>
        
        <?php
            echo "<p align='center'><img src='images/todo/no_img.jpg' alt='imgregistro' width='96' height='106' name='img' /></p><br/>";
        ?>
	<br />
    </td>
    </tr>
    <tr>
        <td>
          <?php
            if($pass_bad == true)
                echo '<div class="error">Opps!! ha escrito mal la contraseña intentelo denuevo</div>';
          ?>
          
      </td>
    </tr>
   <tr>
    <td style="height: 56px">
 
	  <b class="welcome">Correo Electronico</b> 
      <input name="nl_email" type="text" id="nl_email" value="" style="width: 400px"/>
       </td>
  </tr>
    <tr>
    
    <td style="height: 56px">
   	  <b class="welcome">Nombre y Apellido</b>&nbsp; 
      <input name="nl_nombre" type="text"  id="nl_nombre" value="" style="width: 400px"/></td>
    </tr>
    <tr>
    <td style="height: 56px">
   	  <b>Genero&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b>&nbsp; 
        <input name="nl_genero" type="text"  id="nl_genero" value="" style="width: 134px"/></td>
    </tr>
    <tr>
    <td style="height: 56px">
   	  <b class="welcome">Pais o Region</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
      <input name="nl_pais" type="text"  id="nl_pais" value="" style="width: 400px"/></td>
    </tr>
    <tr>
    <td style="height: 56px">
   	  <b class="welcome">Facebook</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
      <input name="nl_fb" type="text"  id="nl_fb" value="" style="width: 400px"/></td>
    </tr>
    <tr>
    <td style="height: 56px">
   	  <b class="welcome">Nacimiento&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
              <input name="nl_birthday" type="datetime"  id="nl_birthday" value="" style="width: 137px"/></b>&nbsp; 
      </td>
    </tr>
  <tr>
   <td style="height: 44px">
   	 <b class="welcome">Usuario&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>&nbsp;
     <input name="nl_usuario" type="text"  id="nl_usuario" onkeyup="" value="" style="width: 400px"/>    
     <strong id="request"></strong>	 
   </td>
  <tr>
    <td style="height: 52px"><b class="welcome">Contrase&ntilde;a&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
      <input required name="pass" type="password" id="nl_pass" value="" style="width: 200px" />	  
    </td>
  </tr>
   <tr>
    <td height="52"><p><b class="welcome">Repetir contrase&ntilde;a </b>
        <input required name="rep_pass" type="password"  id="nl_rep_pass" value="" style="width: 200px" />
        <strong id="validar"></strong></p>      </td>
  </tr>
  <tr>
   <td align="center">
  </td>
    </tr>
   <tr>
    <td height="52" align="center">
      <p>
          <input name="cmdregistrar" type="submit"  id="cmdregistrar" value="Registrarse" />
      </p>
      </td>
  </tr>
    <td><div class="ic"></div>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</form>

 
<?php

    echo $cuerpo->get_feet();
?>

