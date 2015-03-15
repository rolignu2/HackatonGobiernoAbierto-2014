<?php

include "curl_access.php";
$auth = new autorizacion("product");
   $registro = array();
   $count = 0;
   $count_m = 0;
   $arreglo_med = array();
   $end = false;
   $pag =1;
   
   set_time_limit(500);
   
   while($end != true){
        $auth->Set_Filtro('?per_page=100&page=' . $pag);
        $jason_decode = $auth->Get_Respuesta_JasonDecode(true); 
        if(!empty($jason_decode))// && $pag!=900)
            
            array_push($arreglo_med, $jason_decode);
        else $end = true;
        $pag++;
   }
   
   $sql="INSERT INTO shoppingestablishment (address,city_id,code,created_at,id,latitude,longitude,name,phone,updated_at) values ";
  
   foreach ($arreglo_med as $k=>$v)
   {
       foreach($v as $key=>$value)
       {
           $sql.="(";
           foreach($value as $kk=>$vv){
               if($kk=="city_id" or $kk=="id")
               $sql.=$vv.",";
               else 
               $sql.="'".addslashes($vv)."',";
           }
           $sql = substr($sql, 0, -1);
           $sql.="),";
           $count_m++;
       }

   }
          $sql = substr($sql, 0, -1);
   echo $sql;
  /* echo "<PRE>";
   print_r($arreglo_med);
   echo "</PRE>";
   */
//include "curl_access.php";
//$productos = new autorizacion("products");
//$Prod_sondeo = new autorizacion("product_probes");
//$establecimientos=new autorizacion("establecimiento");
//$marcasProd=new autorizacion("marcasProd");
//
//
////$Prod_sondeo->Set_Filtro('?per_page=100&page=1');
//
//
////PARA PROBAR PONER ASI /prueba_policia.php?kw=frijol
////SINO ESTA PREDETERMINADO QUE BUSQUE ARROZ POR EL MOMENTO
//
//
////$valor=isset($_GET['kw'])?$_GET['kw']:'1';
//
////$auth->Get_AllBusquedaNumber($valor , 'medicine_category_id');
////$productos->get_Busqueda_Dinamico(array('frijol','azucar'),'name','cont_any');
////$Prod_sondeo->Get_AllBusquedaNumber( '425' , 'product_id');
//$productosJson = $productos->Get_Respuesta_JasonDecode(true); 
//$prodPrecioJson = $Prod_sondeo->Get_Respuesta_JasonDecode(true); 
//$establecJson = $establecimientos->Get_Respuesta_JasonDecode(true); 
//$marcasProdJson = $marcasProd->Get_Respuesta_JasonDecode(true); 
//
//$i=0;
//
///*
//foreach($prodPrecioJson as $key=>$value)
//    {
//        $decode = $value ;
//        
//        foreach($decode as $k=>$v)
//        {
//            if(!is_array($v)){
//                switch ($k) 
//                {
//                    case 'product_id':
//                        $productos->Get_AllBusquedaNumber( $v , 'id');
//                        $name=$productos->Get_Respuesta_JasonDecode(true);
//                        $filtro[$i]['producto'] = $name[0]['name']; 
//                        break;
//                     case 'price':
//                        $filtro[$i]['price'] = $v ;
//                        break;
//                    case 'product_brand_id':
//                        $marcasProd->Get_AllBusquedaNumber( $v , 'id');
//                        $name=$marcasProd->Get_Respuesta_JasonDecode(true);
//                        $filtro[$i]['marca'] = $name[0]['name'];   
//                        break;
//                    case 'shopping_establishment_id':
//                        $establecimientos->Get_AllBusquedaNumber( $v , 'id');
//                        $name=$establecimientos->Get_Respuesta_JasonDecode(true);
//                        $filtro[$i]['establecimiento'] =$name[0]['name'];   
//                        break;
//                     case 'updated_at':
//                        $filtro[$i]['sonde'] = $v;
//                        break;
//                    default :
//                        break;
//                }
//            }
//        }
//        $i++;
//    }
//
//*/
////$jason_encode = $auth->Get_Respuesta_Jason();
//
//echo "<PRE>";
//
//print_r($prodPrecioJson);
//
//echo "</PRE>";
//
////$busqueda = $auth->Get_busqueda_array($jason_decode , 'id' , '100');
////echo "</br ></br ></br >busqueda = " . $busqueda;
//
////echo "</br ></br ></br >total de registros = " . $auth->Get_CountRegistros();
////print_r($jaso_encode);
//echo "</br ></br ></br >";

?>