<?php

require_once 'curl_access.php';
$auth = new autorizacion("inst_denuncias");
$auth->Set_Filtro('?per_page=100&page=1');
$jason_decode = $auth->Get_Respuesta_JasonDecode(true); 
$filtro = array();
$i=0;
foreach($jason_decode as $key=>$arr)
{
   foreach($arr as $k=>$value)
   {
       switch($k)
       {
           case 'id':
               $filtro[$i]['id'] = $value;
               break;
           case 'name':
               $filtro[$i]['nombre'] = $value;
               break;
       }
   }
   $i++;
}

 echo "<option value='null'>Seleccione una institucion</option>";
foreach($filtro as $k=>$v)
{
    $id = null;
    $name = 'nul';
    foreach($v as $key=>$value)
    {
        switch($key)
       {
           case 'id':
               $id = $value;
               break;
           case 'nombre':
               $name = $value;
               break;
       }
    }
     echo "<option value='$id'>$name</option>";
}

?>