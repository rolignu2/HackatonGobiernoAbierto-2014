
<?php

$script = "

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

require("twitter/twitteroauth.php");
require 'body.class.php';
$cuerpo = new body();
echo $cuerpo->get_head($script);
echo $cuerpo->get_menu();
session_start();

define('YOUR_CONSUMER_KEY', 'P1dgvLCGfGbpNtvrIRtJAbUZO');
define('YOUR_CONSUMER_SECRET', 'xGkSfbIEKafjrDlAkRxpLsCw2ZCJg9BN7oLLh416tp6WAkiStm');

if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {
    $twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
    $access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
    $_SESSION['access_token'] = $access_token;
    $user_info = $twitteroauth->get('account/verify_credentials');
    /*echo '<pre>';
    print_r($user_info);
    echo '</pre><br/>';*/
    if (isset($user_info->error)) {  
        header('Location: index.php');
    } else {
	   $twitter_otoken=$_SESSION['oauth_token'];
	   $twitter_otoken_secret=$_SESSION['oauth_token_secret'];
           
           $id = $user_info->id_str;
           $username = $user_info->name;
           $screen_name = $user_info->screen_name;
           $imagen = $user_info->profile_image_url;
           
    }
} else {
    header('Location: index.php');
}


?>

<form method="get" action="twitter_reg.php">
<table width="752" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  <input type="hidden" name="id_twitter" id="id_twitter" value="<?php echo $id; ?>" />
  <input type="hidden" name="cmdimg" id="cmdimg" value="<?php echo $imagen; ?>" />
  </tr>
  <tr>
    <td  class="auto-style1" style="height: 38px">	<br />
        <span>&nbsp;DATOS DEL USUARIO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </span></td>
  </tr>
  <tr>
    <td style="height: 117px">
    <br />

        <?php
            echo "<p align='center'><img src='$imagen' alt='imgregistro' width='150' height='150' name='img' /></p><br/>";
        ?>
	<br />
    </td>
    </tr>
	<tr>
    <td style="height: 56px">
 
	  <b class="welcome">Correo Electronico</b> 
          <input required name="email" type="email" id="email" value="" style="width: 400px"/>
       </td>
  </tr>
  <tr>
    <td style="height: 56px">
   	  <b class="welcome">Nombre y Apellido</b>&nbsp; 
      <input name="nombre" type="text"  id="nombre" value="<?php echo $username; ?>" style="width: 400px"/></td>
    </tr>
    <tr>
    <td style="height: 56px">
   	  <b>Genero&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b>&nbsp; 
          <select required id="genero" name="genero" >
              <option selected value="male">Masculino</option>
              <option selected value="male">Femenino</option>
          </select>
    </td>
    </tr>
    <tr>
    <tr>
    <td style="height: 56px">
   	  <b class="welcome">Nacimiento&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
              <input required name="birthday" type="date"  id="birthday" value="" style="width: 137px"/></b>&nbsp; 
      </td>
    </tr>
  <tr>
   <td style="height: 44px">
   	 <b class="welcome">Usuario&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>&nbsp;
     <input name="usuario" type="text"  id="usuario" onkeyup="" value="<?php echo $screen_name; ?>" style="width: 400px"/>    
     <strong id="request"></strong>	 
   </td>
  <tr>
    <td style="height: 52px"><b class="welcome">Contrase&ntilde;a&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
      <input required name="pass" type="password" id="pass" value="" style="width: 200px" />	  
    </td>
  </tr>
   <tr>
    <td height="52"><p><b class="welcome">Repetir contrase&ntilde;a </b>
        <input required name="rep_pass" type="password"  id="rep_pass" value="" style="width: 200px" />
        <strong id="validar"></strong></p>      </td>
  </tr>
  <tr>
   <td align="center">
  </td>
    </tr>
   <tr>
    <td height="52" align="center">
      <p>
        <input name="cmdregistrar" type="submit"  id="cmdregistrar" value="Registrarse"/>
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
