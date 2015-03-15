<?php
/**
* SCRIPT HOSPITAL RESPONSIVE OBTIENE LOS DATOS DE LOS HOSPITALES MAS CERCANOS
 * Y SI LOS HOSPITALES MAS CERCANOS SON DEMACIADOS ENTONCES 
 * ESTE MISMO SCRIPT SE ENCARGARA EN PAGINAR LOS HOSPITALES DE 3 EN 3 
*/  
   
  
     require_once 'PHPPaging.lib.php';
     require_once 'tools.php';
     require 'body.class.php';
     
     session_start();
     
     $filtro= array() ;
     $valor = array();
     $body = new body();
     $paging = new PHPPaging();
     
     echo $body->get_head();
   
     
    if(!isset($_POST['info']))
    {
        if(isset($_REQUEST['estado']))
        {
            $filtro = $_SESSION['filtrar']; 
              echo $body->get_menu();
        }
        else{
            echo "Parece que no hay Hospitales cerca de su Ubicaci&oacute;n";
            return;
        }
    }
    else
    {
         $valor = $_POST['info'];
    }
   
    $paging->porPagina(8);                
    $i=0;
    foreach($valor as $key=>$value)
    {
        $decode = objectToArray(json_decode($value , true));
        //print_r($decode);
        foreach($decode as $k=>$v)
        {
            if(!is_array($v)){
                switch ($k)
                {
                    case 'icon':
                        $filtro[$i]['icono'] = $v;
                        break;
                    case 'name':
                        $filtro[$i]['nombre'] = $v;
                        break;
                    case 'vicinity':
                        $filtro[$i]['lugar']= $v;
                        break;
                    default :
                        break;
                }
            }
        }
        $i++;
    }
    
    $_SESSION['filtrar'] = $filtro;
    $paging->linkAgregar('&estado=1');
    $paging->agregarArray($filtro);
    $paging->ejecutar(); 
    
 
    foreach($paging->fetchTodo() as $key=>$value)
    {
        foreach ($value as $k=>$val)
        {
            if($k=='icono')
            {
                echo "<p><img width='30' heigth='30' src='" . $val . "'/>";           
            }
            else{
                if($k=='nombre')
                    echo "<strong>". $val . "</strong>";
                else
                    echo "<br>". $val . "<br></p>";
            }
        }
    }
    echo '<br>';
    echo 'Paginas <b>'.$paging->fetchNavegacion() . '</b>';
    echo $body->get_feet();    
    
   /* foreach($filtro as $key=>$value)
    {
        foreach ($value as $k=>$val)
        {
            if($k=='icono')
            {
                echo "<p><img width='30' heigth='30' src='" . $val . "'/>";           
            }
            else{
                if($k=='nombre')
                    echo "<strong>". $val . "</strong>";
                else
                    echo "<br>". $val . "<br></p>";
                 
            }
        }
    }*/

    
?>
