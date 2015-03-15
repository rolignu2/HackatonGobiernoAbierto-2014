<?php

$latitude=isset($_POST["lat"])?$_POST["lat"]:0;
$longitude=isset($_POST["lon"])?$_POST["lon"]:0;

require_once('MysqlConexion.class.php');
$bdd = new Consulta();
	
     $sql = "select se.name estalecimiento, se.latitude,se.longitude from productprobe pp 
inner join product p on pp.product_id=p.id
inner join productbrand pb on pp.product_brand_id=pb.id
inner join productpresentation ppr on pp.product_presentation_id=ppr.id
inner join shoppingestablishment se on pp.shopping_establishment_id=se.id
where (se.latitude>$latitude and se.latitude<($latitude + 0.1) ) and (se.longitude<$longitude and se.longitude>($longitude - 0.1)) and  (se.name like '%Despensa%' or se.name like '%Selectos%' or se.name like '%Super' or se.name like '%Walmart%' or se.name like '%Wallmart%')
group by se.id";
	
	
	$resultado=$bdd->GetConsulta($sql);
	$array_prod=array();
      
        $i=0;
        $array= "[";
	while ($a = $bdd->Resultado()) {
            $array.="[";
            foreach ($a as $key => $value) {
            $array.= "'".$value."',";
            }
             $array = substr($array, 0, -1);
            $array.= "],";
	}
        $array = substr($array, 0, -1);
        $array .="]";
	$bdd->CloseConection();
echo $array;
       
       
?>