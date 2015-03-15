<?php

   require_once "curl_access.php";
   require_once 'PHPPaging.lib.php';
   require 'body.class.php';
    

   $paging = new PHPPaging();
   $filtro = array();
   $data_b=null;
   $data_c = null;
   $valor = array();
   $auth = new autorizacion("medicina");
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
           $valor = $_SESSION['filtrar_med']; 
           echo $body->get_menu();
   }
   else{                
        if($data_c != null || $data_b != null)
        {
            if ($data_c != null) {
                $auth->Get_AllBusquedaNumber($data_c, 'medicine_category_id');
            }
            else
                 $auth->Get_AllBusqueda($data_b, 'name');
        }       

        
        $jason_decode = $auth->Get_Respuesta_JasonDecode(true); 
        
        if(empty($jason_decode))
        {
            echo "No se ha encontrado la medicina " . $data_b;
            return;
        }
        else
            $valor = $jason_decode;
     }
   
   
    $_SESSION['filtrar_med'] = $valor;
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
                    case 'name':
                        $filtro[$i]['nombre'] = $v;
                        break;
                    case 'price':
                        $filtro[$i]['precio'] = $v;
                        break;
                    case 'quantity':
                        $filtro[$i]['cantidad']= $v;
                        break;
                    case 'unit':
                         $filtro[$i]['unidad']= $v;
                    case 'updated_at':
                         $filtro[$i]['fecha']= $v;  
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
                        echo "<strong>MEDICAMENTO: ". $val . "</strong>";   
                        break;
                    case 'precio':
                         echo "<br>Precio: $". $val . "<br>";
                        break;
                    case 'cantidad':
                        echo "Cantidad: ". $val . "<br>";
                        break;
                    case 'unidad':
                         echo "Unidad: ". $val . "<br>";
                        break;  
                     case 'fecha':
                         echo "Actualizacion: ".date( 'o-W', strtotime( $val) )  . "<br>";
                        break;  
                }  
        }
        
        echo "<br>";
    }
    echo '<br>';
    echo 'Paginas <b>'.$paging->fetchNavegacion() . '</b>';

    echo $body->get_feet();  
   

?>