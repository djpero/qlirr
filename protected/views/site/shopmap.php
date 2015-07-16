<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<!DOCTYPE html>

 
<html lang="se" class="js flexbox canvas canvastext webgl no-touch geolocation postmessage websqldatabase no-indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage no-borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio no-localstorage no-sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />

    <title>Qlirr Shop Map</title>

    <!-- Bootstrap core CSS -->
    <link href="/themes/frontend/css/bootstrap.min.css" rel="stylesheet">
    <link href="/themes/frontend/css/butik.css" rel="stylesheet">
    <link href="/themes/frontend/css/style.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800,700,600,300' rel='stylesheet' type='text/css'>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

  </head>
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
  <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-54899443-1', 'auto');
        ga('send', 'pageview');
</script>

<body> 
    <div id="map-canvas" style="width:100%;height:700px"></div>
</body>   


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="/themes/frontend/js/bootstrap.min.js"></script>
    <script src="/themes/frontend/js/application.js"></script>
    
    <script>
    $(document).ready(function() {

            var dataS='';
 
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat_lng = position.coords.latitude+'|'+position.coords.longitude;
      
                    $.ajax({
                        url: '/site/getShopLocations',
                        type: 'post',
                        dataType: 'html',
                        data: 'data='+lat_lng,
                        async: false,
                        success: function(data) {
      
                            dataS = data.split('|');
                        },
                        error:function(data){

                        } 
                    });
                    var locations = new Array();

                    for (var i = 0; i < dataS.length; i++) {
                       var dataS1 = dataS[i].split('~');
                       locations.push([dataS1[0], dataS1[1], dataS1[2], dataS1[3], dataS1[4], dataS1[5]]);
                    }
                    var options = {
                         zoom: 12, 
                         center: new google.maps.LatLng(position.coords.latitude,position.coords.longitude ),
                         mapTypeId: google.maps.MapTypeId.ROADMAP,
                         mapTypeControl: false
                    };
                    
                    var map = new google.maps.Map(document.getElementById('map-canvas'), options);
                    var image = {
                        url: 'http://qlirr.com/themes/frontend/gfx/map_icon.png',
                        size: new google.maps.Size(32, 36),
                        // The origin for this image is 0,0.
                        origin: new google.maps.Point(0,0),
                        // The anchor for this image is the base of the flagpole at 0,32.
                        anchor: new google.maps.Point(0, 36)
                    };
                     var shape = {
                        coords: [1, 1, 1, 32, 32, 32, 32 , 1],
                        type: 'poly'
                    };
                    for (var i = 0; i < locations.length; i++) {
                    // init markers
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(locations[i][3], locations[i][4]),
                        map: map,
                        title: 'Butik',
                        shape: shape,
                        icon: image
                    });
                    var infowindow = null;
                    // process multiple info windows
                    (function(marker, i) {
                        // add click event
                        google.maps.event.addListener(marker, 'click', function() {
                            if (infowindow) {
                                infowindow.close();
                            }
                             infowindow = new google.maps.InfoWindow({
                                content: '<div class="infoWindow">'+locations[i][0]+locations[i][1]+locations[i][2]+'</div>'
                            });
                            infowindow.open(map, marker);
                        });
                    })(marker, i);
                    }
   
                });
        });

    </script>
  

</html>