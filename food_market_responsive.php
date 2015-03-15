

<?php

/**
* script polices responsive
*/  
    include_once 'tools.php';

    if(!isset($_POST['info']))
    {
        echo "Parece que no hay Establecimientos o Supermercados cerca de su Ubicaci&oacute;n";
        return;
    }
    
    $valor = $_POST['info'];
    $filtro= array() ;
    $i=0;

    
    foreach($valor as $key=>$value)
    {
        $decode = objectToArray(json_decode($value , true));

        $food_market = $decode['types'][0];
        if($food_market == 'grocery_or_supermarket'){
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
        }
        $i++;
    }
    
    foreach($filtro as $key=>$value)
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
   
?>
