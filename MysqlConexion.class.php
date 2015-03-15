<?php

/*
 * 
 * Rolando Arriaza
 * 
 * 
 * 
 * 
 * 
 * 
 * */
 
 /*
  * EJEMPLO DE USO DE LA CLASE 
  * 
  * require_once('class.ConsultaSql.inc.php');

	$bdd = new Consulta();
	
	 $sql = "UPDATE  User_login  SET username ='herberth" .
	 "',email='null".
	 "',password='linux".
	 "',estado=1" .
	 ",tipo='root' where iduser=5";
	 
	$sql2 = "SELECT * FROM User_login";
	
	$bdd->GetConsulta($sql);
    $bdd->Resultado();
		
	echo "NUMERO DE FILAS AFECTADAS EN LA CONSULTA 1 = " . $bdd->RowsNums();
	echo "<BR><BR>";
	


	$bdd->GetConsulta($sql2);
	
	$bdd->Resultado();
	while ($a = $bdd->Resultado()) {
	
	foreach ($a as $key => $value) {
	echo $key . "  " . $value . "<br>";
	}
	
	echo "//////////////////////////////////<br>";
	}
	
	echo "**************CANTIDAD DE FILAS ENCONTRADAS ****************";
	echo "<br>TOTAL: ". $bdd->RowsNums();
	
	$bdd->CloseConection();
  * 
  * 
  * 
  * */


 class Consulta
 {
 	
	
	/**
	 * @param variables privadas que nos permitira acceder a todas las funciones
	 * @return none 
	 */
	 
	private $conexion;
	private $result;
	private $arreglo;
	private $rowsnums;
	private $fieldsnums;
	
	private $Error = array( 
	 0 => 'Error al iniciar el servidor'  ,
	 1 => 'Error al Realizar esta consulta' ,
	 2 => 'Consulta no valida revisar sintaxis',
	 3 => 'No se econtro nada en la consulta');
	 
	private $senderror = NULL;
	 
	private $tokens = array(
	0 => 'CREATE' , 
	1=> 'UPDATE' ,
	2=>'INSERT' ,
	3=>'ALTER' ,
	4 => 'DELETE');
	
	private $bandera = FALSE;

    /**
	 * @param inicializa la base de datos mediante un constructor 
	 * @return ninguno
	 */
	
	public function __construct()
	{
		$this->Conection();
	}

     /**
	  * @param Obtenemos la conexion del objeto para consultas externas
	  * @return $conexion
	  */
	  
     public function GetConection()
	 {
	 	return $this->conexion;
	 }
	
	
	/**
	 * @param $query , realiza la consulta dada por el identificador , verifica los tokens relacionados para seleccionar caso
	 * @return ERROR SI EXISTE LA CONSULTA PUEDE QUE TENGA PROBLEMAS DE SINTAXIS
	 */
	 
	public function GetConsulta($query)
	{
		
		$this->bandera = FALSE;
		
		$sql = strtoupper($query);
		$arreglo = explode(" ", $sql);
		
		foreach ($arreglo as $key => $value) {
			
		 if($this->bandera == FALSE)
		 {
		 	foreach ($this->tokens as $xkey => $xvalue) 
		 	{
			   if($value == $xvalue)
			   {
			   	 $this->bandera = TRUE;
				 break;
			   }
			   else
			   	  $this->bandera = FALSE;
		     }
		 }
		 else
		 	break;	
		}
		
		$this->result = mysql_query($query, $this->conexion);
		if(!$this->result) return $this->VerificarError(2);
		
	}
	
	/**
	 * @param Resultado de la consulta 
	 * @return  array() DEVUELVE UN ARRAY ASOCIADO 
	 * @return  string DEVUELVE UN ERROR SI EXISTE
	 * @return  FALSE devuelve si la consulta no encontro nada 
	 * 
	 * */
	
	public function Resultado()
	{
		
		switch ($this->bandera) {
			case FALSE:
				if(mysql_num_rows($this->result) >= 1)
				{
					$this->rowsnums = mysql_num_rows($this->result);
					$this->fieldsnums =  mysql_num_fields($this->result);
					
				 	return mysql_fetch_array($this->result , MYSQL_ASSOC);
				}
				else 
					return FALSE;
			case TRUE:
				if(mysql_affected_rows($this->conexion) <=0)
				   return FALSE;
				else 
					$this->rowsnums = mysql_affected_rows($this->conexion);
			default:
				   return $this->VerificarError(3);
				break;
		}
		
	}
	
	
	
	/**
	 * @param Reconecta si la conexion se cerro anteriormente
	 * 
	 * */
	
	public function Reconexion()
	{
		$this->Conection();
	}
	
	
	/**
	 *@param cantidad de filas afectadas o cantidad de filas encontradas
	 *@return int $rowsnums 
	 * */
	
	public function RowsNums()
	{
		return $this->rowsnums;
	}
	
	/**
	 *@param cantidad de columnas encontradas
	 *@return int $fieldsnums
	 * */
	
	public function FieldNums()
	{
		return $this->fieldsnums;
	}
	
	/**
	 *@param verifica el ultimo error encontrado en la bdd
	 *@return string $senderror
	 * */
	
	public function GetLastError()
	{
		return $this->senderror;
	}
	
	/**
	 *@param Cierra una conexion abierta 
	 * */
	
	public function CloseConection()
	{
		mysql_close($this->conexion);
	}
	
	
	/**
	 * 
	 * verifica errores por medio de parametros otorgados
	 * 
	 */
	
	private function VerificarError($estatus)
	{
		foreach ($this->Error as $key => $value) {
			if($key == $value)
			{
				$this->senderror = $value;
				return $value;
			}
		}
	}
	
	
	/*
	 * nos conecta a la base de datos 
	 * mediante una archivo de configuracion.php
	 * 
	 * */
	
	
	private function Conection()
	{
		 
		include 'configuracion.php';
			
		$this->conexion = mysql_connect(
		$servidor['localhost'] ,
		$servidor['user'] ,
                $servidor['password']);
		
		mysql_select_db($servidor['database'] , $this->conexion);
		
		if(mysql_errno($this->conexion) >= 1)
				return $this->VerificarError(0);
		else	
			return;
	}
	
 }


?>