

<?php

/**
* script polices responsive
*/  
    include_once 'tools.php';

    if(!isset($_POST['info']))
    {
        echo "Parece que no hay estaciones de Policia cerca de su Ubicaci&oacute;n";
        return;
    }
    
    $valor = $_POST['info'];
    $filtro= array() ;
    $i=0;
    
   /* foreach($valor as $key_=>$value_)
    {
        $decode = objectToArray(json_decode($value_ , true));
         foreach($decode as $k=>$v)
        {
            if($k=='types')
            {
                
                foreach ($v as $kk => $vv) {
                   
                   if ($kk == 0) {
                        if ($vv == 'police') {
                            $is_police = true;
                            break;
                        }
                        else
                        {
                            $is_police = false;
                        }
                   }
               }
               
            }
            if($is_police) break;
        }
    }*/
    
    
    foreach($valor as $key=>$value)
    {
        $decode = objectToArray(json_decode($value , true));
       /* echo "<PRE>";
         print_r($decode);
        echo "</PRE>";*/
        $police = $decode['types'][0];
        if($police == 'police'){
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
    /*  
        <p>Donec mattis enim sit amet nisl faucibus, eu pulvinar nibh facilisis. Aliquam erat volutpat. Vivamus tempus, nisi varius imperdiet molestie, velit mi feugiat felis, sit amet fringilla mi massa sit amet arcu. Mauris dictum nisl id felis lacinia congue. Aliquam lectus nisi, sodales in lacinia quis, lobortis vel sem.
        <br><br><strong>Address:</strong> 123 Thamine Street, Digital Estate, Yangon 10620, Myanmar
         <br><strong>Email:</strong> info@company.com | <strong>Tel:</strong> 010-020-0340</p>*/
    
?>
