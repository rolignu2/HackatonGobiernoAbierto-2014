<?php


require_once 'curl_access.php';

$auth = new autorizacion("medicina");

$auth->Set_Filtro('?per_page=100&page=15');


//$auth->Set_Filtro('?lt=id&gt=3');
//$jason_encode = $auth->Get_AllBusquedaDate('updated_at' , '2013');
$jason_decode = $auth->Get_Respuesta_JasonDecode(true); 
$jason_encode = $auth->Get_Respuesta_Jason();

echo "<PRE>";
print_r($jason_decode);
echo "</PRE>";

//$busqueda = $auth->Get_busqueda_array($jason_decode , '' , '100');
//echo "</br ></br ></br >busqueda = " . $busqueda;

echo "</br ></br ></br >total de registros = " . $auth->Get_CountRegistros();
//print_r($jaso_encode);
echo "</br ></br ></br >";
?>

<!-- / <html>
<head>
    <title>API de Google Maps - Lo b�sico</title>
    <meta charset="utf-8">
     <style>
      html, body, #map-canvas {
        height: 75%;
        margin: 50px;
        padding: 40px
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
    <script type="text/javascript" src="js/geolocalizacion.js"></script>
    <script type="text/javascript" src="js/ajax.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.0.js"></script>
    <script src="js/jquery-1.8.2.min.js"></script>

    
    <script>
    set_tipo('police');
    initialize();

</script>
</head>
<body>
    <div id="informacion-police">
       
    </div>
    <div id="map-canvas-p" ></div>
</body>
</html>-->

<html>
<head>
    <meta charset="UTF-8">
    <title>Basic CRUD Application - jQuery EasyUI CRUD Demo</title>
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
    <script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
     <link rel="stylesheet" type="text/css" href="css/style1.css" />
</head>
<body>


    <table id="dg" title="Categoria" class="easyui-datagrid" style="width:700px;height:250px"
            url="medicina_responsive.php"
            toolbar="#toolbar" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="id" width="50">Codigo</th>
                <th field="name" width="50">Nombre</th>
            </tr>
        </thead>
    </table>
    <style type="text/css">
        #fm{
            margin:0;
            padding:10px 30px;
        }
        .ftitle{
            font-size:14px;
            font-weight:bold;
            padding:5px 0;
            margin-bottom:10px;
            border-bottom:1px solid #ccc;
        }
        .fitem{
            margin-bottom:5px;
        }
        .fitem label{
            display:inline-block;
            width:80px;
        }
       
    </style>
</body>
</html>

