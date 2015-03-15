<?php
class Autorizacion
{
    
    private $CABEZERAS = array();
    private $CURL_=null;
    private $RESPUESTA=null;
    private $ID=null;
    
    /*arreglo */
    private $URL = array(
        "delegacion"=>'http://api.gobiernoabierto.gob.sv/delegations',
        "delegacion_info"=> 'http://api.gobiernoabierto.gob.sv/delegation_infos',
        "comunitario"=>'http://api.gobiernoabierto.gob.sv/food_establishment_health_communities',
        "salud"=>'http://api.gobiernoabierto.gob.sv/health_establishments',
        "medicina_categorias"=>'http://api.gobiernoabierto.gob.sv/medicine_categories',
        "salud_establecimiento"=>'http://api.gobiernoabierto.gob.sv/health_establishments',
        "albergue"=>'http://api.gobiernoabierto.gob.sv/health_establishments',
        "hidrocarburos"=>'http://api.gobiernoabierto.gob.sv/hydro_prices',
        "hidrocarburos_referencia"=>'http://api.gobiernoabierto.gob.sv/hydro_references',
        "medicina"=>'http://api.gobiernoabierto.gob.sv/medicines',
        "product_probes"=>'http://api.gobiernoabierto.gob.sv/product_probes',
        "products"=>'http://api.gobiernoabierto.gob.sv/products',
        "establecimiento"=>'http://api.gobiernoabierto.gob.sv/shopping_establishments',
        "marcasProd"=>'http://api.gobiernoabierto.gob.sv/product_brands',
        "info_denuncias"=>'http://api.gobiernoabierto.gob.sv/delation_infos',
        "inst_denuncias"=>'http://api.gobiernoabierto.gob.sv/delation_institutions',

		
    );
    

    /**
     * @param string $ext_param opcional establece un nuevo identificador a buscar dentro de la api
     */
    private function Load($ext_param = null)
    {
        
        $this->CURL_ = curl_init();
        
        if ($ext_param != null) {
            curl_setopt($this->CURL_, CURLOPT_URL, $ext_param);
        } else {
            curl_setopt($this->CURL_, CURLOPT_URL, $this->URL[$this->ID]);
        }

        curl_setopt($this->CURL_, CURLOPT_POST, 1);
        curl_setopt( $this->CURL_, CURLOPT_HTTPHEADER, array( 'Authorization: Token token=' . 'd535ad0b9c2227cf05713d9864d6b4ba') );
        curl_setopt($this->CURL_, CURLOPT_RETURNTRANSFER, 1);
        $this->RESPUESTA = curl_exec($this->CURL_);
        curl_close($this->CURL_);
    }
    
    /**
     * @param string $IDENTIFICADOR establece el parametro inicial que sera una key en el array URL
     * @access public
     * @example auth=new Autorizacion('delegacion')
     */
    public function __construct($IDENTIFICADOR) 
    {
        $this->ID = $IDENTIFICADOR;
        $this->Load();
    }
    
    
    /**
     * @name $PARAMETRO 
     * @todo establece un nuevo parametro de busqueda a la direccion curl 
     * @example $auth = new autorizacion("delegacion");
                $auth->Set_Filtro('?per_page=3&page=1');
     */
    public function Set_Filtro($PARAMETRO)
    {
        $extP =$this->URL[$this->ID] . $PARAMETRO;
        $this->load($extP);
		
    }
     /**
     * @name $PARAMETRO 
     * @todo establece un nuevo parametro de busqueda a la direccion curl 
     * @example $auth = new autorizacion("products");
                $auth->Get_Busqueda('arroz');
     */
     public function Get_Busqueda($PARAMETRO)
    {
        $extP =$this->URL[$this->ID] .'?&q[name_cont_any]='.$PARAMETRO;
        $this->load($extP);
		
    }
    
    public function set_or()
    {
        $extP =$this->URL[$this->ID] .'?&q[name_or]';
        $this->load($extP);
		
    }
     /**
     * @name $PARAMETRO 
     * @todo establece un nuevo parametro de busqueda a la direccion curl 
     * @example $auth = new autorizacion("products");
                $auth->Get_Busqueda('arroz');
     */
    public function get_Busqueda_Dinamico($PARAMETRO , $CATEGORIA, $PREDICADO)
    {
        $v=count($PARAMETRO);
        if($v>1){        
        $extP =$this->URL[$this->ID].'?&q[' .$CATEGORIA. '_'.$PREDICADO.'][]='.$PARAMETRO[0];
        for($i=1;$i<$v;$i++){
            $extP.='&q[' .$CATEGORIA. '_'.$PREDICADO.'][]='.$PARAMETRO[$i];
        }
        }else{
        $extP =$this->URL[$this->ID].'?&q[' .$CATEGORIA. '_'.$PREDICADO.'][]='.$PARAMETRO;    
        }
        
              
        $this->load($extP);
    }
     /**
     * @name $PARAMETRO 
     * @name $CATEGORIA 
     * @todo establece un nuevo parametro de busqueda a la direccion curl 
     * @example $auth = new autorizacion("products");
                $auth->Get_Busqueda(1 , 'id');
     */
    public function Get_AllBusquedaNumber($PARAMETRO , $CATEGORIA)
    {
        $extP =$this->URL[$this->ID] .'?&q[' .$CATEGORIA. '_eq]='.$PARAMETRO;
        $this->load($extP);
    }
    
    
       /**
     * @name $PARAMETRO 
     * @name $CATEGORIA 
     * @todo establece un nuevo parametro de busqueda a la direccion curl 
     * @example $auth = new autorizacion("products");
                $auth->Get_Busqueda('arroz' , 'id');
     */
    
     public function Get_AllBusqueda($PARAMETRO , $CATEGORIA)
    {
        $extP =$this->URL[$this->ID] .'?&q[' .$CATEGORIA. '_cont_any]='.$PARAMETRO ;
        $this->load($extP);
    }
    
    /**
     * @todo Obtiene los registros de forma nativa JSON 
     */
    public function Get_Respuesta_Jason()
    {
        return $this->RESPUESTA;
    }
    
    /**
     * @todo Obtiene los registros decodificados en forma de array multidimensional
     */
    public function Get_Respuesta_JasonDecode($assoc = false)
    {
        return json_decode($this->RESPUESTA , $assoc);
    }
    
    /**
     * @todo Obtiene el numero de registros
     */
    public function Get_CountRegistros()
    {
        return count($resp = $this->Get_Respuesta_JasonDecode());    
    }
    
    
    /**
     * @param array $array array de registros
     * @param string $attr atributo o llave que acompa�a el registro a buscar
     * @param string $val el valor a buscar dentro del registro
     * @todo obtiene el valor de la llave si en caso existe en dado caso se retornara null
     */
    function Get_busqueda_array ($array, $attr, $val, $sti = FALSE) {

        if (!is_array($array)) {
            return FALSE;
        }
        foreach ($array as $key => $inner) {
                if (!is_array($inner)) {
                return FALSE;
            }
            if (!isset($inner[$attr])) {
                continue;
            }
            if ($sti) {
                            if ($inner[$attr] === $val) {
                               return $key;
                }
            } else {
                        if ($inner[$attr] == $val) {
                            return $key;
                }
            }
  }
  return NULL;
}
    
    
}
?>
