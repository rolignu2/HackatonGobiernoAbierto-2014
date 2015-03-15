<?php
   
   require_once "curl_access.php";
   require_once 'PHPPaging.lib.php';
   require 'body.class.php';
   include "tools.php";

   $paging = new PHPPaging();
   $filtro = array();
   $data_b=null;
   $data_c = null;
   $valor = array();
   $auth = new autorizacion("medicina");
   $body = new body();
   $count = 0;
   $count_m = 0;
   $arreglo_med = array();
   $end = false;
   $meses = 86400 * 186;
   $is_data = false;
   $is_pull = false;
   $pag =1;
   session_start();
   set_time_limit(100);
   echo $body->get_head();
   
   if(isset($_REQUEST['busqueda']))
   {
       $data_b= $_REQUEST['busqueda'];
       if($data_b != null)
        $is_data = true;
   }
   if(isset($_REQUEST['norm']))
   {
       if($_REQUEST['norm'] != null)
                $is_pull = true;
   }
   
   if(isset($_REQUEST['estado']))
   {
           $valor = $_SESSION['filtrar_med']; 
           $arreglo_med=$_SESSION['filtrar_med_bus'];
           $paging->porPagina(10); 
           echo $body->get_menu();
   }
   else{
       
       if($is_pull){
         
         while($end != true){
                
                $auth->Set_Filtro('?per_page=100&page=' . $pag);
                $jason_decode = $auth->Get_Respuesta_JasonDecode(true); 
                //$end=true;
                if (!empty($jason_decode)|| $pag==10) {
                array_push($arreglo_med, $jason_decode);
                } else {
                    $end = true;
                }
                $pag++;
            }
       }
       else
       {
           $auth->Get_AllBusqueda($data_b, 'name');
           $valor = $auth->Get_Respuesta_JasonDecode(true);
           
       }
     }
   
   
    $_SESSION['filtrar_med'] = $valor;
    $_SESSION['filtrar_med_bus'] = $arreglo_med;
    
    if(!empty($valor))
    {
     $paging->porPagina(3); 
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
    }
    else
    {
      $paging->porPagina(3); 
      foreach ($arreglo_med as $k=>$v)
      {
       $date_ok = false;
       $i=0;
       $is_actual = false;
       $filtro_p=array();
       foreach($v as $key=>$value)
       {
           foreach($value as $kk=>$vv){
                switch($kk)
                {
                    case 'updated_at':
                     $fecha_actual = date("d-m-Y");
                     $fecha_actual = strtotime ( '-6 month' , strtotime ( $fecha_actual ) ) ;
                     $fecha_actual = date("d-m-Y" , $fecha_actual);
                     $fecha_medicina =date( "d-m-Y", strtotime($vv) );
                     $total_6month = compararFechas($fecha_medicina , $fecha_actual );
                     if($total_6month >= 0){
                       $is_actual=true;
                       $filtro_p[$i]['fecha']= $vv;  
                     }
                     else 
                     {
                         $is_actual = false;
                     }
                     break;
                     case 'name':
                        $filtro_p[$i]['nombre'] = $vv;
                        break;
                    case 'price':
                        $filtro_p[$i]['precio'] = $vv;
                        break;
                    case 'quantity':
                        $filtro_p[$i]['cantidad']= $vv;
                        break;
                    case 'unit':
                         $filtro_p[$i]['unidad']= $vv;
                }
                
                
           }
           if($is_actual)
           {
                $filtro[$i]['nombre'] = $filtro_p[$i]['nombre'];
                $filtro[$i]['precio'] = $filtro_p[$i]['precio'];
                $filtro[$i]['cantidad']= $filtro_p[$i]['cantidad'];
                $filtro[$i]['unidad']= $filtro_p[$i]['unidad'];
                $filtro[$i]['fecha']=$filtro_p[$i]['fecha'];
           }
               
           $i++;
           
       }
      }
    }

   
     
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