<?php

$latitude=isset($_POST["lat"])?$_POST["lat"]:0;
$longitude=isset($_POST["lon"])?$_POST["lon"]:0;

require_once('MysqlConexion.class.php');
$bdd = new Consulta();
	
     $sql = "select p.name producto,pb.name marca,ppr.name presentacion,
pp.price precio,pp.offer_price ofer_precio,se.name establecimiento,pp.probe_date sondeo,
se.latitude,se.longitude
from productprobe pp 
inner join product p on pp.product_id=p.id
inner join productbrand pb on pp.product_brand_id=pb.id
inner join productpresentation ppr on pp.product_presentation_id=ppr.id
inner join shoppingestablishment se on pp.shopping_establishment_id=se.id
where (se.latitude>$latitude and se.latitude<($latitude + 0.1) ) and (se.longitude<$longitude and se.longitude>($longitude - 0.1)) and  (se.name like '%Despensa%' or se.name like '%Selectos%' or se.name like '%Super' or se.name like '%Walmart%' or se.name like '%Wallmart%')
order by  pp.probe_date desc, pp.price";

	
	$resultado=$bdd->GetConsulta($sql);
	$array_prod=array();
        
        while($bdd->Resultado()) {
            array_push($array_prod, $bdd->Resultado());
        }
        $bdd->CloseConection();
        foreach($array_prod as $key=>$value)
    {
        $decode = $value ;
        foreach($decode as $k=>$v)
        {
            if(!is_array($v)){
                switch ($k)
                {
                    case 'producto':
                        echo "<strong>Producto: $v </strong><br>";
                        break;
                    case 'marca':
                        echo "Marca: $v <br>";
                        break;
                    case 'precio':
                        echo "Precio: $v <br>";
                        break;
                    case 'presentacion':
                         echo "$v <br>";
                        break;
                    case 'ofer_precio':
                         echo "Precio de Venta: $v <br>";
                        break;
                    case 'establecimiento':
                         echo "<b> $v </b><br>";
                        break;
                    case 'sondeo':
                         echo "Fecha Sondeo: $v <br>";
                        break;
                }
                
            }
           
        }
         echo "<hr>";
    }
        
       
?>