<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Natlia</title>
    
    <!-- core CSS -->
    <link href="<?php echo $this->webroot; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $this->webroot; ?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo $this->webroot; ?>css/animate.min.css" rel="stylesheet">
    <link href="<?php echo $this->webroot; ?>css/prettyPhoto.css" rel="stylesheet">
    <link href="<?php echo $this->webroot; ?>css/main.css" rel="stylesheet">
    <link href="<?php echo $this->webroot; ?>css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <link rel="stylesheet" type="text/css" href="css/default.css" />
    <link rel="stylesheet" type="text/css" href="css/component.css" />
    <script src="<?php echo $this->webroot; ?>js/modernizr.custom.js"></script>
    </head>
    <body>
  <div class="container">
            <header class="clearfix">

            </header>   
            
            
            <div class="main">
           <div class="center wow fadeInDown">
           <br>               
                <img class="active" src="images/slider/splash.png" height="150" width="400">
                <a href="<?php echo $this->Html->url(array('controller' => "Home", 'action'=>"index" ));?>">ENTER SITE</a>
            </div>
              </div>
                <ul id="cbp-bislideshow" class="cbp-bislideshow">
                    <li><img src="images/slider/bg4.jpg" alt="image01"/></li>
                    <li><img src="images/slider/bg5.jpg" alt="image02"/></li>
                    <li><img src="images/slider/bg4.jpg" alt="image03"/></li>
                </ul>
                <div id="cbp-bicontrols" class="cbp-bicontrols">
                    
                </div>
    </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <!-- imagesLoaded jQuery plugin by @desandro : https://github.com/desandro/imagesloaded -->
        <script src="js/jquery.imagesloaded.min.js"></script>
        <script src="js/cbpBGSlideshow.min.js"></script>
        <script>
            $(function() {
                cbpBGSlideshow.init();
            });
        </script>
    </body>