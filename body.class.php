
<?php

class body
{
    
    public function __construct(){}
    
    
    
    public function get_head($param = null)
    {
        $cabecera = '
            <!DOCTYPE html>
            <!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
            <!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <![endif]-->
            <!--[if IE 8]><html class="no-js lt-ie9"> <![endif]-->
            <!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
        <head>
        <meta charset="utf-8">
        <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
        <title>Hackaton - Info Util El Salvador</title>

        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/templatemo_misc.css">
        <link rel="stylesheet" href="css/templatemo_style.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
     

        <script type="text/javascript" src="js/ajax.js"></script>
        <script src="js/jquery-1.8.2.min.js"></script>
        <script src="js/jqueryfunciones.js"></script>
        

        <script>
          function regresar(){
                window.location="index.php";
            }
           
        </script> ' 
                . $param .
                '</head><body>';
        
        return $cabecera;
    }
    
    public function get_feet()
    {
        
        $comilla ="'";
        $pie = '
            </div></div></div>
<script src="js/vendor/jquery-1.10.1.min.js"></script>
                <script>window.jQuery || document.write(' . $comilla . '<script src="js/vendor/jquery-1.10.1.min.js"><\/script>' .$comilla .')</script>
                <script src="js/jquery.easing-1.3.js"></script>
                <script src="js/bootstrap.js"></script>
                <script src="js/plugins.js"></script>
                <script src="js/main.js"></script>
                <script type="text/javascript">
            
			jQuery(function ($) {

                $.supersized({

                    // Functionality
                    slide_interval: 3000, 
                    transition: 1, 
                    transition_speed: 700, 
                   
                    slide_links: "blank", 
                    slides: [ // Slideshow Images
                        {
                            image: "images/templatemo-slide-1.jpg"
                        }, {
                            image: "images/templatemo-slide-2.jpg"
                        }, {
                            image: "images/templatemo-slide-3.jpg"
                        }, {
                            image: "images/templatemo-slide-4.jpg"
                        }
                    ]

                });
            });
            
    </script>
    
      
        </body>
        </html>';
        
        return $pie;
    }
    
    public function get_menu( $param = null)
    {
        $menu =' 
             <div class="container-fluid">
                <div class="col-md-4 col-sm-12">
                <div class="sidebar-menu">
                    
                    <div class="logo-wrapper">
                        <h1 class="logo">
                            <a rel="nofollow" href="http://infoutil.gobiernoabierto.gob.sv"><img src="images/logo2.png" alt="GoodInfo">
                           
                        </h1>
                    </div> <!-- /.logo-wrapper -->
                    
                    <div class="menu-wrapper">
                        <ul class="menu">
                            <li><a class="homebutton" href="index.php" onclick="regresar();">REGRESAR</a></li>
                        </ul> <!-- /.menu -->
                        <a href="#" class="toggle-menu"><i class="fa fa-bars"></i></a>
                    </div> <!-- /.menu-wrapper -->

                    <!--Arrow Navigation-->
                    <a id="prevslide" class="load-item"><i class="fa fa-angle-left"></i></a>
                    <a id="nextslide" class="load-item"><i class="fa fa-angle-right"></i></a>

                </div> <!-- /.sidebar-menu -->
            </div> <!-- /.col-md-4 -->
             <div class="col-md-8 col-sm-12">
                <div class="toggle-content" id="tab1">'
                ;
        return $menu;
    }
    
    
}

?>
