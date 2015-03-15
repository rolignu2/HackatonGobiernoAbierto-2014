<?php
//para ver al detalle la utilizacion de esta libreria puede ingresar a
//http://phppaging.phperu.net/basico/
//WWW.djcharlie.tk
require_once 'PHPPaging.lib.php';
require_once "servidor.php";
require_once "class.conexion.php";

$con = new MysqlConexion($ArrayServer);
$con->Conectar();

$paging = new PHPPaging($con->GetConexion());
      

        $relativo = $paging->agregarConsulta("select * from fuentebdd");
		//echo $relativo;
        
        // Ejecutamos la paginaci�n
        $paging->ejecutar();  



	while($f=$paging->fetchResultado ()) {
		echo $f['nombre'].'<br>';
	}
	echo 'Paginas '.$paging->fetchNavegacion();
	
	
	
	?>