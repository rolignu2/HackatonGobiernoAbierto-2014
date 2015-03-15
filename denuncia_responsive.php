<?php

   require_once "curl_access.php";
   require_once 'PHPPaging.lib.php';
   require 'body.class.php';
    

   $paging = new PHPPaging();
   $filtro = array();
   $data_b=null;
   $data_c = null;
   $valor = array();
   $auth = new autorizacion("info_denuncias");
   $body = new body();
   session_start();
   
   echo $body->get_head();
   
   if(isset($_REQUEST['busqueda']))
   {
       $data_b= $_REQUEST['busqueda'];
   }

   if(isset($_REQUEST['categoria']))
   {
       $data_c = $_REQUEST['categoria'];
   }
   
   
   if(isset($_REQUEST['estado']))
   {
           $valor = $_SESSION['filtrar_denun']; 
           echo $body->get_menu();
   }
   else{                
        if($data_c != null || $data_b != null)
        {
            if ($data_c != null) {
                $auth->Get_AllBusquedaNumber($data_c, 'delation_institution_id');
            }
            else
                 $auth->Get_AllBusqueda($data_b, 'kind');
        }       

        
        $jason_decode = $auth->Get_Respuesta_JasonDecode(true); 
        
        if(empty($jason_decode))
        {
            echo "No se ha encontrado la institucion " . $data_b;
            return;
        }
        else
            $valor = $jason_decode;
     }
   
   
    $_SESSION['filtrar_denun'] = $valor;
    $i=0;
    foreach($valor as $key=>$value)
    {
        $decode = $value ;
        //print_r($decode);
        foreach($decode as $k=>$v)
        {
            if(!is_array($v)){
                switch ($k)
                {
                    case 'kind':
                        $filtro[$i]['nombre'] = $v;
                        break;
                    case 'phone':
                        $filtro[$i]['telefono'] = $v;
                        break;
                    case 'email':
                        $filtro[$i]['correo']= $v;
                        break;
                    default :
                        break;
                }
            }
        }
        $i++;
    }
   
  
   
    $paging->porPagina(8);  
    $paging->linkAgregar('&estado=1');
    $paging->agregarArray($filtro);
    $paging->ejecutar(); 
    
 
    foreach($paging->fetchTodo() as $key=>$value)
    {
        foreach ($value as $k=>$val)
        {
                switch($k)
                {
                    case 'nombre':
                        echo "<strong>Denuncia: ". $val . "</strong>";   
                        break;
                    case 'telefono':
                         echo "<br>Numero de telefono: ". $val . "<br>";
                        break;
                    case 'correo':
                        echo "Correo para denuncia: ". $val . "<br>";
                        break;
                }  
        }
        
        echo "<br>";
    }
    echo '<br>';
    echo 'Paginas <b>'.$paging->fetchNavegacion() . '</b>';

    echo $body->get_feet();  
   

?>