<!DOCTYPE html>


<html lang="se" class="js flexbox canvas canvastext webgl no-touch geolocation postmessage websqldatabase no-indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage no-borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio no-localstorage no-sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="AMC Walking Dead Story Sync">
    <meta name="viewport" content="minimal-ui, width=320" >
    <title>Klirrr</title>

    <!-- Bootstrap core CSS -->
    <link href="/themes/frontend/css/bootstrap.min.css" rel="stylesheet">
    <link href="/themes/frontend/css/bootstrap-theme.css" rel="stylesheet">
    <link href="/themes/frontend/css/animate.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/modernizr.custom.70700.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900' rel='stylesheet' type='text/css'>


  </head>
<!-- NAVBAR
================================================== -->    
<body style="">


    <div id="pageid_2" style="height:100%;left:0;position:absolute;top:0px">
        <div id="header" >
           <div class="container ">
               <div class="row" align="center">
                   <div class="col-xs-2" align="left">
                       <img class="iconLeft" src="/themes/frontend/gfx/arrowBack.png" onclick="location.href='/';" />
                   </div>
                   <div class="col-xs-8">
                       <img class="logo" src="/themes/frontend/gfx/logoNewBlackMobile2.png" />
                   </div>
                   <div class="col-xs-2">
                      
                   </div>
               </div>
            </div>
         </div> 
   
    </div>
        <div id="front">
            <div class="container help">

                <a href="/demo/index">START DEMO</a>
            </div>
        </div>
        
   
     
     <div id="errorDiv" hidden>   
        <div style="position:fixed; top:0; left:0; ;width:100%;height:100%; background: red; opacity:0.92;z-index:1200;">   
        </div>
        <div style="top: 38%;position:fixed;margin:0 auto; width:100%;z-index:9999;overflow-y: hidden" align="center">
            <p id="errorTitle" style="color:white; text-align:center;">Felaktig mobilnummer</p>

            <img src="themes/frontend/gfx/error_circle.png" style="margin-top:50px; cursor:pointer" onclick="closeDiv();">
        </div>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.js"></script>
    <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="/themes/frontend/js/application.js"></script>
    <script src="/themes/frontend/js/jquery.cookie.js"></script>
    <script src="/themes/frontend/js/bootstrap.min.js"></script>
    <script src="/themes/frontend/js/jquery.scrollTo.min.js"></script>
    <script src="/themes/frontend/js/bootstrap-scrollspy.js"></script> 
    <script src="/themes/frontend/js/jquery.inputmask.min.js"></script>  
    
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bs/peydoGeneralScripts.js"></script>

    
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-52444227-2', 'auto');
        ga('send', 'pageview');

    </script>
    <!------D E T E C T   M O B I L E    B R O W S E R-----> 
    <script>
  
     var isMobile = {
        Android: function() {
        return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };
//        if( isMobile.any() ) alert('Mobile');

    </script>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 
</body>
</html>