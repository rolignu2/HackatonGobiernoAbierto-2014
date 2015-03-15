<body bgcolor="#000000" >
	
<script>
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
    js.src = "//connect.facebook.net/en_US/all.js";
    ref.parentNode.insertBefore(js, ref);
  }(document));

 
  function DatosFacebook() {
    FB.api('/me', function(response) {
      document.getElementById('nl_nombre').value = response.name;
      document.getElementById('nl_email').value = response.email;
      document.getElementById('nl_genero').value = response.gender;
      document.getElementById('nl_pais').value = response.location.name;
      document.getElementById('nl_fb').value = response.link;
      document.getElementById('nl_birthday').value = response.birthday;
      document.getElementById('nl_usuario').value = response.username;
      var imagen="https://graph.facebook.com/" + response.username +"/picture";
      document.getElementById('cmdimg').value = imagen;
      document.images['img'].src= imagen;
    });
  }
  
 
 
</script>



<form method="get" action="EnvioRegistroFacebook.php">
<table width="752" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="images/top.gif" width="752" height="12" /></td>
  </tr>
  <tr>
  	
  </tr>
  <tr>
    <td class="auto-style1" style="height: 38px">	<br />
	<span class="Estilo1">&nbsp;DATOS DEL USUARIO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="orange button" style="left: -136px; top: 54px"><a href="index.php">Salir a principal</a></span></td>
  </tr>
  <tr>
    <td style="height: 117px">
    <br />
     <div id="seccion_facebook" style="position: absolute; width: 279px; height: 74px; z-index: 1; left: 219px; top: 90px">
	 	<span class="green button" style="left: 315px; top: 225px; width: 174px">
	 <?php
	    echo '<fb:login-button show-faces="false" width="300" scope="user_location" max-rows="1"></fb:login-button>';
	 	echo "</span>";
	 ?>
	</div>

    <?php
      	echo "<img src='images/no_img_man.gif' alt='imgregistro' width='96' height='106' name='img' /><br/>";
    ?>
  
   
	<br />
    </td>
    </tr>
	<tr>
    <td style="height: 56px">
 
	  <b class="welcome">Correo Electronico</b> 
      <input name="nl_email" type="text" class="tb5" id="nl_email" value=""/>
       </td>
  </tr>
    <tr>
     <input type="hidden" name="cmdimg" id="cmdimg" value="" />
    <td style="height: 56px">
   	  <b class="welcome">Nombre y Apellido</b>&nbsp; 
      <input name="nl_nombre" type="text" class="tb5" id="nl_nombre" value=""/></td>
    </tr>
    <tr>
    <td style="height: 56px">
   	  <b class="welcome">Genero&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b>&nbsp; 
      <input name="nl_genero" type="text" class="tb5" id="nl_genero" value="" style="width: 134px"/></td>
    </tr>
    <tr>
    <td style="height: 56px">
   	  <b class="welcome">Pais o Region</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
      <input name="nl_pais" type="text" class="tb5" id="nl_pais" value=""/></td>
    </tr>
    <tr>
    <td style="height: 56px">
   	  <b class="welcome">Facebook</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
      <input name="nl_fb" type="text" class="tb5" id="nl_fb" value=""/></td>
    </tr>
    <tr>
    <td style="height: 56px">
   	  <b class="welcome">Nacimiento&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
      <input name="nl_birthday" type="text" class="auto-style2" id="nl_birthday" value="" style="width: 137px"/></b>&nbsp; 
      </td>
    </tr>
  <tr>
   <td style="height: 44px">
   	 <b class="welcome">Usuario&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>&nbsp;
     <input name="nl_usuario" type="text" class="tb5" id="nl_usuario" onkeyup="" value=""/>    <strong id="request"></strong>	 </td>
  <tr>
    <td style="height: 52px"><b class="welcome">Contrase&ntilde;a&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
      <input name="nl_pass" type="password" class="tb5" id="nl_pass" value="" />	  </td>
  </tr>
   <tr>
    <td height="52"><p><b class="welcome">Repetir contrase&ntilde;a </b>
        <input name="nl_rep_pass" type="password" class="tb5" id="nl_rep_pass" value="" onkeyup="GetRequest__(this.value , '&nl_pass=' , document.getElementById('nl_pass').value , 'validar' , 'validarpassword.php?nl_rep_pass=')" />
        <strong id="validar"></strong></p>      </td>
  </tr>
  <tr>
   <td align="center">
  </td>
    </tr>
   <tr>
    <td height="52" align="center">
      <p>
        <input name="cmdregistrar" type="submit" class="button medium red" id="cmdregistrar" value="Registrarse"/>
      </p>
      <p class="Estilo4">
	
	  </p>      </td>
  </tr>
    <td><div class="ic"></div>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
    <table width="100%" height="135" border="0" align="center" cellpadding="0" cellspacing="0" class="footer">
  <tr>
    <td align="center"><table width="752" height="88" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top" align="left" class="welcome">Copyright &copy; 2013 <a href="index.php" class="Estilo1">www.wildsoft.webuda.com</a><br/>
          <br/>
          
          <br/>
          <br/>
          <br/>
          <span class="Estilo1"><a href="index.php">Inicio</a> | <a href="Foro.php">Foro</a> | <a href="Descargas.php">Descargas</a> </span></td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="100%" height="50" border="0" align="center" cellpadding="0" cellspacing="0" class="bottom_footer">
  <tr>
    <td align="center"><table width="752" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><a href="http://www.apache.org"
				onmouseover="changeImages('apache', 'images/apache-over.gif'); return true;"
				onmouseout="changeImages('apache', 'images/apache.gif'); return true;"
				onmousedown="changeImages('apache', 'images/apache-over.gif'); return true;"
				onmouseup="changeImages('apache', 'images/apache-over.gif'); return true;" target="_blank" title="Apache powered">
				<img name="apache" src="images/apache.gif" width="80" height="15" border="0"></a> <a href="http://www.php.net"
				onmouseover="changeImages('php', 'images/php-over.gif'); return true;"
				onmouseout="changeImages('php', 'images/php.gif'); return true;"
				onmousedown="changeImages('php', 'images/php-over.gif'); return true;"
				onmouseup="changeImages('php', 'images/php-over.gif'); return true;" target="_blank" title="PHP powered">
				<img name="php" src="images/php.gif" width="80" height="15" border="0"></a> <a href="http://www.mysql.com"
				onmouseover="changeImages('mysql', 'images/mysql-over.gif'); return true;"
				onmouseout="changeImages('mysql', 'images/mysql.gif'); return true;"
				onmousedown="changeImages('mysql', 'images/mysql-over.gif'); return true;"
				onmouseup="changeImages('mysql', 'images/mysql-over.gif'); return true;" target="_blank" title="MySQL powered">
				<img name="mysql" src="images/mysql.gif" width="80" height="15" border="0"></a></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>