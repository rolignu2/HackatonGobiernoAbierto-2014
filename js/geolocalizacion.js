var placeTypes = [
'accounting',
'airport',
'amusement_park',
'aquarium',
'art_gallery',
'atm',
'bakery',
'bank',
'bar',
'beauty_salon',
'bicycle_store',
'book_store',
'bowling_alley',
'bus_station',
'cafe',
'campground',
'car_dealer',
'car_rental',
'car_repair',
'car_wash',
'casino',
'cemetery',
'church',
'city_hall',
'clothing_store',
'convenience_store',
'courthouse',
'dentist',
'department_store',
'doctor',
'electrician',
'electronics_store',
'embassy',
'establishment',
'finance',
'fire_station',
'florist',
'food',
'funeral_home',
'furniture_store',
'gas_station',
'general_contractor',
'grocery_or_supermarket',
'gym',
'hair_care',
'hardware_store',
'health',
'hindu_temple',
'home_goods_store',
'hospital',
'insurance_agency',
'jewelry_store',
'laundry',
'lawyer',
'library',
'liquor_store',
'local_government_office',
'locksmith',
'lodging',
'meal_delivery',
'meal_takeaway',
'mosque',
'movie_rental',
'movie_theater',
'moving_company',
'museum',
'night_club',
'painter',
'park',
'parking',
'pet_store',
'pharmacy',
'physiotherapist',
'place_of_worship',
'plumber',
'police',
'post_office',
'real_estate_agency',
'restaurant',
'roofing_contractor',
'rv_park',
'school',
'shoe_store',
'shopping_mall',
'spa',
'stadium',
'storage',
'store',
'subway_station',
'synagogue',
'taxi_stand',
'train_station',
'travel_agency',
'university',
'veterinary_care',
'zoo'];


var iconos =[
    'images/google_icon/hospital.png',
    'images/google_icon/policia.png',
    'images/google_icon/supmarket.png',
    'images/google_icon/parking.png',
    'images/google_icon/pets.png',
    'images/google_icon/escuelas.png',
    'images/google_icon/shopping.png',
    'images/google_icon/restaurant.png',
    'images/google_icon/farmacia.png',
    'images/google_icon/trabajo.png',
    'images/google_icon/trabajo.png',
    'images/google_icon/trabajo.png',
    'images/google_icon/office.png',
    'images/google_icon/trabajo.png',
    'images/google_icon/gas.png',
     'images/google_icon/restaurant.png'
];

/*
        

        case 'night_club':
            i=10;
            break;
        case 'movie_theater':
            i=11;
            break;
        case 'local_government_office':
            i=12;
            break;
        case 'gym':
            i=13;
            break;
        case 'gas_station':
            i=14;
            break;
        case 'food':
            i=15;
            break;*/


var rutas= [
    'police_responsive.php',
    'hospital_responsive.php',
    'food_market_responsive.php',
    'localizar_responsive.php'
];

var map;
var infowindow;
var latitud;
var longitud;
var tipo = '';
var ruta = '';
var marker=[];

function set_tipo(t)
{
    window.tipo=t;
}

function set_request()
{
    return window.tipo;
}

function get_localizacion() {
    
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(mostrar_coordenadas);
    } else {
        
    }
}


function set_prod_alimentos(locations,lat,long) { 
   
    var map = new google.maps.Map(document.getElementById('map-canvas-fprod'), {
      zoom: 11,
      center: new google.maps.LatLng(lat, long),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;
var imagen = new google.maps.MarkerImage(iconos[2],
    new google.maps.Size(100,50)
   ); 
    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
         icon:imagen
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
    
}
    /*
function set_prod_alimentos(lat,long) {
  var myLatlng = new google.maps.LatLng(lat,long);
  var imagen = new google.maps.MarkerImage(iconos[2],
    new google.maps.Size(100,50)
   ); 
  var mapOptions = {
    zoom: 15,
    center: myLatlng
  }
  var map = new google.maps.Map(document.getElementById('map-canvas-fprod'), mapOptions);

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Markup',
      icon:imagen
  });
}
*/
function mostrar_coordenadas(position) {

   
  latitud = position.coords.latitude;
  longitud = position.coords.longitude;
  var pyrmont = new google.maps.LatLng(latitud,longitud);
  
 
document.getElementById('coordLong').value=longitud;   
document.getElementById('coordLat').value=latitud;   
  switch(window.tipo)
    {
        case 'police':
                map = new google.maps.Map(document.getElementById('map-canvas-p'), {
                center: pyrmont,
                zoom: 15
            });    
            break;
        case 'hospital':
                 map = new google.maps.Map(document.getElementById('map-canvas-h'), {
                center: pyrmont,
                zoom: 15
            });
            break;
          case 'grocery_or_supermarket':
                map = new google.maps.Map(document.getElementById('map-canvas-f'), {
                center: pyrmont,
                zoom: 15
            });    
            break;
        default:
                map = new google.maps.Map(document.getElementById('map-localizar'), {
                center: pyrmont,
                zoom: 15
            });    
            break;
         
    }

 
  
  //keyword: 'best view' para ver los mejores segun google

  var request = {
  
    location: pyrmont,
    radius: 1000,
    types: [tipo]
    
  };
  

  
  infowindow = new google.maps.InfoWindow();
   
  var service = new google.maps.places.PlacesService(map);
  service.nearbySearch(request, callback);
 
}


function initialize() {
  get_localizacion();
}


var objeto = [];
function callback(results, status) {
  if (status === google.maps.places.PlacesServiceStatus.OK) {
     for (var i = 0; i < results.length; i++) {
      createMarker(results[i]);
      objeto[i] = results[i];
    }
  }else{
     //INICIALIZA EL ARREGLO DE INFORMACION
     objeto = []; 
  }
  
  get_informacion(objeto);
}

var object__ = new Array();
function get_informacion(objeto)
{   //INICIALIZA EL ARREGLO DE INFORMACION
    if(objeto.length==0) object__ = new Array();
     var string_jason = '';
     for (var i = 0; i < objeto.length; i++){
             string_jason +=JSON.stringify(objeto[i]);
             object__[i]= JSON.stringify(objeto[i]);
           
        }
     
    var estatus =0;
    switch(window.tipo)
    {
        case 'police':
            estatus=0;
            window.ruta=window.rutas[0];
            break;
        case 'hospital':
            estatus=1;
            window.ruta=window.rutas[1];
            break;
        case 'grocery_or_supermarket':
            estatus=2;
            window.ruta=window.rutas[2];
            break;
        default:
            estatus=100;
            window.ruta=window.rutas[3];
            break;
        
    }
 
    realizaProceso(object__ , window.ruta , estatus);
}

function get_informacion_jsoncode()
{
    return object__;
}


//creacion del canvas o lienzo tambien edicion de la imagen o icono
function createMarker(place) {
   
   var i=0;
   switch(tipo)
   {
       case 'hospital':
           i=0;
           break;
       case 'police':
           i=1;
           break;
       case 'grocery_or_supermarket':
            i=2;
            break;
        case 'parking':
            i=3;
            break;
        case 'veterinary_care':
            i=4;
            break;
        case 'school':
            i=5;
            break;
        case 'shopping_mall':
            i=6;
            break;
        case 'restaurant':
            i=7;
            break;
        case 'pharmacy':
            i=8;
            break;
        case 'place_of_worship':
            i=9;
            break;
        case 'night_club':
            i=10;
            break;
        case 'movie_theater':
            i=11;
            break;
        case 'local_government_office':
            i=12;
            break;
        case 'gym':
            i=13;
            break;
        case 'gas_station':
            i=14;
            break;
        case 'food':
            i=15;
            break;
       default:
           break;
   }

   var imagen = new google.maps.MarkerImage(iconos[i],
    new google.maps.Size(100,50)
   ); 
    
   window.marker = new google.maps.Marker({
        map: map,
        position: place.geometry.location,
        icon:imagen
   });

  google.maps.event.addListener(marker, 'click', function() {
    infowindow.setContent(place.name);
    infowindow.open(map, this);
  });
}

  
   function realizaProceso(informacion , r , estatus){
        var parametros = {
                'info' : informacion
        };
        $.ajax({
                data:  parametros,
                url:    r,
                type:  'post',
                beforeSend: function () {
                    if(estatus===0){
                        $("#informacion-police").html("Procesando, espere por favor...");
                    }
                    else if (estatus===1)
                         $("#informacion-hospital").html("Procesando, espere por favor...");
                      else if (estatus===2)
                         $("#informacion-food").html("Procesando, espere por favor...");
                     else
                          $("#informacion-localizar").html("Procesando, espere por favor...");
                        
                },
                success:  function (response) {
                     if(estatus===0){
                        $("#informacion-police").html('');
                        $("#informacion-police").html(response);
                    }
                    else if (estatus===1){
                         $("#informacion-hospital").html('');
                        $("#informacion-hospital").html(response);
                    }else if (estatus===2){
                         $("#informacion-food").html('');
                        $("#informacion-food").html(response);
                    }
                    else
                    {
                         $("#informacion-localizar").html('');
                        $("#informacion-localizar").html(response);
                    }
                }
       });
       
}
