<?php
   include "curl_access.php";
   include "tools.php";
   
   $auth = new autorizacion("medicina");
   $registro = array();
   $count = 0;
   $count_m = 0;
   $arreglo_med = array();
   $end = false;
   $pag =1;
   
   set_time_limit(100);
   
   while($end != true){
        $auth->Set_Filtro('?per_page=100&page=' . $pag);
        $jason_decode = $auth->Get_Respuesta_JasonDecode(true); 
        if(!empty($jason_decode))
            array_push($arreglo_med, $jason_decode);
        else $end = true;
        $pag++;
   }
   
   //1 dia=86400
   $meses = 86400 * 186;
   

   
   foreach ($arreglo_med as $k=>$v)
   {
       foreach($v as $key=>$value)
       {
           foreach($value as $kk=>$vv){
                if($kk=='updated_at')
                {
                     $fecha_actual = date("d-m-Y");
                     $fecha_actual = strtotime ( '-6 month' , strtotime ( $fecha_actual ) ) ;
                     $fecha_actual = date("d-m-Y" , $fecha_actual);
                     $fecha_medicina =date( "d-m-Y", strtotime( $vv) );
                     $total_6month = compararFechas($fecha_medicina , $fecha_actual );
                     if($total_6month >= 0)
                         $count++;
                     
                     $fecha_actual = date("d-m-Y");
                     $fecha_actual = strtotime ( '-1 month' , strtotime ( $fecha_actual ) ) ;
                     $fecha_actual = date("d-m-Y" , $fecha_actual);
                     $total_month = compararFechas($fecha_medicina , $fecha_actual );
                     
                   if($total_month >= 0)
                         $count_m++;
                }
           }
       }
   }

   echo "+6 Meses (" . $count . ") Actualizaciones";
   echo "<br>(" . $count_m . ") Recientes";
   
?>

