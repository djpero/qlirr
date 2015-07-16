<!DOCTYPE html>


<html lang="en" class="js flexbox canvas canvastext webgl no-touch geolocation postmessage websqldatabase no-indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage no-borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio no-localstorage no-sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--<meta name="viewport" content="width=device-width,user-scalable=no">-->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Qlirr">
    <!--<meta name="viewport" content="minimal-ui, width=320" >-->
    <title>Qlirr Demo</title>

    <!-- Bootstrap core CSS -->
    
    <link href="/themes/frontend/css/bootstrap.css" rel="stylesheet">
    <link href="/themes/frontend/css/bootstrap-theme.css" rel="stylesheet">
    <link href="/themes/frontend/css/animate.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/modernizr.custom.70700.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800,700,600,300' rel='stylesheet' type='text/css'>


  </head>
  <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-54899443-1', 'auto');
        ga('send', 'pageview');

  </script>
<!-- NAVBAR
================================================== -->    
<body style="">
    <input id="curDate" value="<?php echo date('m/d/Y');  ?>" hidden />
    <div id="pageid_1"> 
<!--    <header>
        <div  align="right">
          <img src="/themes/frontend/gfx/icon_menu.png" alt="menu"  /> 
        </div>
    </header>-->
    
    <section id="middle">
        <div class="container">
            <div class="row clearfix">
                <div id="headerContainer" class="column col-xs-10 col-xs-offset-1" >
                    <h5>Det är lugnt! Du kan</h5>
                    <h5>betala en annan gång.</h5>
                </div>
            </div>
            <div class="row clearfix" style="margin-top:8px">
                <div id="middleContainer" class="column col-xs-10 col-xs-offset-1" align="center" style="background-color: rgba(0,55,76,0.8);padding-bottom: 30px">
                    <img src="/themes/frontend/gfx/logowhite.png" alt="logo" style="width:52px;height:52px;margin-top: 14px" />
                    <p style="margin-top:10px">Fyll i ditt mobilnummer</p>
                    <input id="inpMobile" class="mask" type="tel" placeholder="07X - XXX XX XX"  />
                </div>
            </div>    
        </div>
        
        
    </section>
   <footer class="demoFooter">
        <button class="btn btnRnd" type="button" onclick="sendPinCode();">Bekräfta mobilnummer</button>
        <p class="privacyText" style="color:white">Genom att använda tjänsten godkänner du <span style="color:white">avtalet.</span></p>
    </footer>
</div>       
 
<div id="pageid_2" hidden>
    <header>
        <div class="column col-xs-2">
            <img src="/themes/frontend/gfx/icon_arrow.png" alt="back" onclick="location.href='/demo/index'" /> 
        </div>
        <div class="column col-xs-8">
            <p>Bekräfta </p>
        </div>
        <div class="column col-xs-2">

        </div>
    </header>
    <section id="middle">
        <div class="column col-xs-10 col-xs-offset-1">
            <h3>VERIFIERA DIG MED HJÄLP AV</h3>
            <h3 style="margin-top:0px">PINKODEN DU FÅTT VIA SMS.</h3>
        </div>
        <div class="row clearfix">
            <div class="column col-xs-10 col-xs-offset-1" align="center">
                <p>Fyll i din pinkod</p>
                <input id="inpPin" type="tel" placeholder="XXXX" maxlength="4" />
            </div>
        </div> 
    </section>
    <footer class="demoFooter">
         <button class="btn btnRnd bottom10" type="button" onclick="pullPage2()">Bekräfta pinkod</button>
    </footer >
       
</div> 
<!--<div id="pageid_3" hidden>
    <header>
        <div class="column col-xs-2">
            <img src="/themes/frontend/gfx/icon_arrow.png" alt="back"  /> 
        </div>
        <div class="column col-xs-8">
            <p>Legitimering</p>
        </div>
        <div class="column col-xs-2">

        </div>
    </header>
    <section id="middle">
        <div class="column col-xs-10 col-xs-offset-1">
            <h3>EFTER GENOMFÖRD TRANSAKTION BEHÖVER</h3>
            <h3 style="margin-top:0px">DU UPPVISA GILTIGT LEGITIMATION.</h3>
        </div> 
        <div class="row clearfix">
            <div class="column col-xs-10 col-xs-offset-1" align="center">
                <p>Fyll i ditt personnummer </p>
                <input id="inpSsn" type="tel" class="mask" placeholder="ÅÅ MM DD - XXXX" data-inputmask="'mask':'99 99 99 - 9999'" />
            </div>
        </div> 
    </section>
    <footer class="demoFooter">
         <button class="btn btnRnd bottom10" type="button" onclick="pullPage3()">Bekräfta personnummer</button>
    </footer >
       
</div> -->
    
    
    
<div id="pageid_3" hidden>
    <header>
       
            <div class="column col-xs-2">
                <!--<img src="/themes/frontend/gfx/icon_arrow.png" alt="back"  />--> 
            </div>
            <div class="column col-xs-8">
                <p>Demo Demosson</p>
            </div>
            <div class="column col-xs-2">
                &nbsp;
            </div>
   
    </header>
    <section id="saldo">
        <div class="column col-xs-12">
            <p>Saldo: 2000 kr</p> 
        </div> 
          
    </section>
    <section id="middle"> 
        <div class="row clearfix" style="margin-left:0;margin-right:0">
            <div class="column col-xs-10 col-xs-offset-1"  style="margin-top:6px;" align="center">
                <p>Jag befinner mig hos</p>
                <input id="inpShop" style="font-size:16px;" type="tel"  placeholder="My Way Rosta Spel & Tobak" onfocus="pullPageUp()" readonly="" data-call="89932" />
            </div>
        </div> 
        <div id="paySection" class="row clearfix" style="margin-left:0;margin-right:0">
            <div class="column col-xs-10 col-xs-offset-1" align="center">
                <p>Belopp </p>
                <input id="inpAmount" type="tel" placeholder="0,00 kr" />
            </div>
        </div> 
        <div class="row clearfix" >
            <div class="column col-xs-4">
                <p class="priceTag" id="pay50">50 kr</p>
            </div>
            <div class="column col-xs-4">
                <p class="priceTag" id="pay200">200 kr</p>
            </div>
            <div class="column col-xs-4">
                <p class="priceTag" id="pay500">500 kr</p>
            </div>
        </div>
    </section>
    <footer class="demoFooter">
         <button class="btn btnRnd" type="button" onclick="pullPage3()">Genomför transaktion</button>
         <p id="chDesc" class="privacyText" >Oss tillhanda: 50 kr den 2 okt 2014 </p>
    </footer >
       
</div>     
    
    
<div id="pageid_4" hidden>
    <header>
       
        <div class="column col-xs-2">
            <!--<img src="/themes/frontend/gfx/icon_arrow.png" alt="back"  />--> 
        </div>
        <div class="column col-xs-8">
            <p>Demo Demosson</p>
        </div>
        <div class="column col-xs-2">
            &nbsp;
        </div>
   
    </header>
    <section id="saldo">
        <div class="column col-xs-12">
            <p>Saldo: <span id="tnxPageSaldo"></span> kr</p> 
        </div> 
        
    </section>
    <section id="middle">
        <div class="container">
            <div class="row clearfix">
                <div class="column col-xs-10 col-xs-offset-1" align="center">
                    <img src="/themes/frontend/gfx/logo128.png" alt="logo"  /> 
                </div>
            </div>
            <div class="row clearfix">
                <div class="column col-xs-10 col-xs-offset-1" align="center">
                    <p>Transaktionen är</br>genomförd och ska</br>bekräftas av mottagaren </p>
                    <h3 id="shopdescText">RESTAURANG & PIZZERIA MOCKFJÄRD</br>REFERENSNUMMER: AU1338 </h3>
                    <h1 id="tnxPageAmount" style=""></h1> 
                </div>
            </div>    
        </div>
        
        
    </section>
    <footer class="demoFooter">
         <button class="btn btnRnd bottom10" type="button" onclick="pullPage2()">Ny transaktion</button>
    </footer >
       
</div> 
    
<div id="pageUp" hidden> 
    <header>
       
        <div class="column col-xs-2">
            
        </div>
        <div class="column col-xs-8">
            <p>Senaste</p>
        </div>
        <div class="column col-xs-2" align="right">
            <img src="/themes/frontend/gfx/icon_exit.png" alt="back" onclick="pullPageDown()" /> 
        </div>
   
    </header>
    <section id="saldo" style="background-color: rgb(248,248,248);height:60px;">
        <div class="column col-xs-12">
            <p id="skriv" onclick="Skriv()">Skriv mottagarnummer</p> 
        </div> 
        
    </section>
    <section id="middle">
        <div id="shopList" class="column col-xs-10 col-xs-offset-1" onclick="shopDesc(1)">
            <p>Grillköket Örebro</p>
            <h4>17749</h4>
        </div>
        <div id="shopList" class="column col-xs-10 col-xs-offset-1" onclick="shopDesc(2)">
            <p>My Way Rosta Spel & Tobak</p>
            <h4>89932</h4>
        </div>
        <div id="shopList" class="column col-xs-10 col-xs-offset-1" onclick="shopDesc(3)">
            <p>Candylicious</p>
            <h4>66388</h4>
        </div>
        <div id="shopList" class="column col-xs-10 col-xs-offset-1" onclick="shopDesc(4)">
            <p>Ica Nära Pettersberg</p>
            <h4>92872</h4>
        </div>
    </section>
 </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
    <script src="/themes/frontend/js/jquery.inputmask.min.js"></script> 
    <script src="/themes/frontend/js/application.js"></script>
    <script src="/themes/frontend/js/jquery.cookie.js"></script>
    <script src="/themes/frontend/js/bootstrap.min.js"></script>
       <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bs/peydoGeneralScripts.js"></script>     
    <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

    <script>
        
        $( document ).ready(function() {
            //pullPage1();    
        });
        
        function shopDesc(id) {
            if (id==1) {
                $("#inpShop").attr('placeholder', 'Frissan Kalufsen');
                $("#inpShop").attr('data-id', '0006');
                pullPageDown();
            } else if (id==2) {
                $("#inpShop").attr('placeholder', 'Butiken Nara Dig'); 
                $("#inpShop").attr('data-id', '0008');
                pullPageDown();
            } else if (id==3) {
                $("#inpShop").attr('placeholder', 'Restaurang Lunchen'); 
                $("#inpShop").attr('data-id', '0009');
                pullPageDown();
            } else if (id==4) {
                $("#inpShop").attr('placeholder', 'Restaurang Lunchen'); 
                $("#inpShop").attr('data-id', '0012');
                pullPageDown();
            }
        }
        
        function Skriv() {
            $("#inpShop").attr('readonly', false);
            $("#inpShop").attr('data-call', '999999');
            $("#inpShop").attr('placeholder', '');
            $("#inpShop").focus();
            $("#inpShop").css('font-size', '20px');
            pullPageDown();
        }
        
        function DateFromString(str){
            str = str.split(/\D+/);
            str = new Date(str[2],str[0]-1,(parseInt(str[1])+14));
            return str;
        }

        function Add14Days() {
            var monthNames = [ "jan", "feb", "mar", "apr", "may", "jun",
            "jul", "aug", "sep", "oct", "nov", "dec" ];
            var date = $('#curDate').val();
            var ndate = DateFromString(date);
                var day = ndate.getDate();
                var month = ndate.getMonth() + 1;
                var year = ndate.getFullYear();
                return day+' '+monthNames[month]+' '+year;
        }
        
        $("#payCash").mouseup(function() {
           $(this).attr('data-tag', 'selected');
           $(this).css({'background-color':'#d9d9d9'});    
           $("#payGoods").css({'background-color':'#f6f6f6'});
           $("#checkoutTitle").html('TA UT KONTANTER HOS'); 
           
        });
        $("#payGoods").mouseup(function() {
           $(this).attr('data-tag', 'selected');
           $(this).css({'background-color':'#d9d9d9'});
           $("#payCash").css({'background-color':'#f6f6f6'});
           $("#checkoutTitle").html('BETALA TILL'); 
        });
        
//        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        
        $("#inpAmount").keyup(function() {
           updatechDesc(); 
        });
        $("#inputSeller").keyup(function() {
           $('#sellerCID').html('Mottagare: '+$(this).val()); 
        });
        
        $("#chDesc").html('Oss tillhanda: 0 kr den '+Add14Days());
        
        $("#pay50").mouseup(function() {
           $(this).attr('data-tag', 'selected');
           $(this).removeClass('priceTag').addClass('priceTagActive');
           $("#pay200").removeClass('priceTagActive').addClass('priceTag');
           $("#pay500").removeClass('priceTagActive').addClass('priceTag');
           $("#inpAmount").val('50');
           updatechDesc();
        });  
        $("#pay200").mouseup(function() {
           $(this).attr('data-tag', 'selected');
           $(this).removeClass('priceTag').addClass('priceTagActive');
           $("#pay50").removeClass('priceTagActive').addClass('priceTag');
           $("#pay500").removeClass('priceTagActive').addClass('priceTag');
           $("#inpAmount").val('200');
           updatechDesc();
        }); 
        $("#pay500").mouseup(function() {
           $(this).attr('data-tag', 'selected');
           $(this).removeClass('priceTag').addClass('priceTagActive');
           $("#pay200").removeClass('priceTagActive').addClass('priceTag');
           $("#pay50").removeClass('priceTagActive').addClass('priceTag');
           $("#inpAmount").val('500');
           updatechDesc();
        }); 
//        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~  

    function updatechDesc() {
        var a = document.getElementById("inpAmount").value;
        var fee = 0;
        var result = 0;
        if (a>49) {
            fee=29;
        } else {
            fee = 0;
        }
        result = (parseInt(a));
        if (a==="") {
            result = 0;
        }
        $("#chDesc").html('Oss tillhanda: '+result+' kr den '+Add14Days());
        $("#tnxPageAmount").html(result+' kr');
        var c = (2000 - parseInt(result));
        $("#tnxPageSaldo").html(c);
        var info = $("#inpShop").attr('data-call');
        
        var shopid = $("#inpShop").attr('data-id');
        var text = $("#inpShop").attr('placeholder');
        $("#shopdescText").html(text+'<br>'+'REFERENSNUMMER: '+shopid);
       
        
    }
    window.addEventListener('touchmove', function(event) {                                                                                                                                                                                                               
            // Prevent scrolling on this element                                                                                                                                                                                                                              
            //event.preventDefault();                                                                                                                                                                                                                                           
        }, false); 
    
        $( document ).ready(function() {
            $(function() { $('.mask').inputmask(); });
        });
    
        $('#inpMobile').keydown(function(event) {
            
            if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 
                || event.keyCode == 27 
                || (event.keyCode == 65 && event.ctrlKey === true) 
                || (event.keyCode >= 35 && event.keyCode <= 39)){
                    return;
            } else if (event.keyCode==13) {
                sendPinCode();
            } else {
                // If it's not a number stop the keypress
                if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                    event.preventDefault(); 
                }   
            }
            
        });
        
 
        
 </script>
 <script>
//      -------------------------------------------------------------------------------------------------
//      -------------------------------------------------------------------------------------------------     
          
        var currentPath = $(location).attr('hash');
        var pageWidth = $("#pageid_1").width();
        var pageHeight = window.screen.height;
        
        if (pageHeight<pageWidth) {
           var leftPosition = pageWidth;
           var upPosition = pageHeight;
        } else {
           var leftPosition = pageHeight; 
           var upPosition = pageWidth;
        }
//        alert(pageWidth+':'+pageHeight);
        $("#pageid_2").css({'left':leftPosition});
        $("#pageid_3").css({'left':leftPosition*2});
        $("#pageid_4").css({'left':leftPosition*3});
//        $("#pageid_5").css({'left':pageWidth*4});
        $("#pageUp").css({'top':upPosition});
        
//      -------------------------------------------------------------------------------------------------        
//      ------------------------------------------------------------------------------------------------- 

        function pullPage1() {
            
            var pageWidth = $("#pageid_1").width();
            var pageHeight = window.screen.height;
        
            if (pageHeight<pageWidth) {
               var leftPosition = pageWidth;
            } else {
               var leftPosition = pageHeight; 
            }

            $("#pageid_1").animate({left:"-"+leftPosition+"px"},900,'easeOutExpo');
            $("#pageid_2").show();     
            $("#pageid_2").animate({left:"0"},900,'easeOutExpo');
           
            $("#pageid_3").animate({left:leftPosition},900,'easeOutExpo');
            $("#pageid_4").animate({left:(leftPosition*2)},900,'easeOutExpo');
//            $("#pageid_5").animate({left:(pageWidth*3)},900,'easeOutExpo');
            history.pushState('Qlirr.com', 'nav', '/demo/#/pincode');
        }
        function pullPage2() {
            var pageWidth = $("#pageid_2").width();
            $("#header").addClass("headerRelative");
            $("#pageid_1").animate({left:"-"+(pageWidth*2)+"px"},900,'easeOutExpo');
            $("#pageid_2").animate({left:"-"+pageWidth+"px"},900,'easeOutExpo');
            $("#pageid_3").show();
            $("#pageid_3").animate({left:"0"},900,'easeOutExpo');
            $("#pageid_4").animate({left:pageWidth},900,'easeOutExpo');
//            $("#pageid_5").animate({left:pageWidth*2},900,'easeOutExpo');
            history.pushState('Qlirr.com', 'nav', '/demo/#/pay');
        }
        function pullPage3() {
            var pageWidth = $("#pageid_3").width();
            $("#header").addClass("headerRelative");
            $("#pageid_1").animate({left:"-"+(pageWidth*3)+"px"},900,'easeOutExpo');
            $("#pageid_2").animate({left:"-"+(pageWidth*2)+"px"},900,'easeOutExpo');
            $("#pageid_3").animate({left:"-"+pageWidth},900,'easeOutExpo');
            $("#pageid_4").show();
            $("#pageid_4").animate({left:"0"},900,'easeOutExpo');
//            $("#pageid_5").animate({left:pageWidth},900,'easeOutExpo');
            history.pushState('Qlirr.com', 'nav', '/demo/#/tnx');
            updatechDesc();
            sendInvoice();
        }
        function pullPage4() {
            var pageWidth = $("#pageid_3").width();
            $("#header").addClass("headerRelative");
            $("#pageid_1").animate({left:"-"+(pageWidth*4)+"px"},900,'easeOutExpo');
            $("#pageid_2").animate({left:"-"+(pageWidth*3)+"px"},900,'easeOutExpo');
            $("#pageid_3").animate({left:"-"+(pageWidth*2)+"px"},900,'easeOutExpo');
            $("#pageid_4").animate({left:"-"+(pageWidth)+"px"},900,'easeOutExpo');
//            $("#pageid_5").show();
//            $("#pageid_5").animate({left:"0"},900,'easeOutExpo');
            history.pushState('Qlirr.com', 'nav', '/demo/#/over');
            
           
        }    
        function pullPageUp() {
          var a = $("#inpShop").attr('data-call');
          if (a==='999999') {
            
          } else {
            $("#pageUp").show();
            $("#pageUp").animate({top:"0"},900,'easeOutExpo');
          }
        }
         function pullPageDown() {
            var pageHeight = $("#pageid_3").height();
            $("#pageUp").animate({top:pageHeight},900,'easeOutExpo', function() {
                $("#pageUp").hide();
            });
        }
        
        $(window).on('hashchange', function() {
            var currentPath = $(location).attr('hash');
//            alert(currentPath);
            if (currentPath==="#/pincode") {
                pullPage1();
            } else if (currentPath==="#/pay") {
                pullPage2();
            } else if (currentPath==="#/tnx") {
                pullPage3();
            }
         });
        
        function sendPinCode() {
            var mobile  = document.getElementById("inpMobile").value;
            var mob     = mobile.replace("-", "");
            var mob1    = mob.replace("_", "");
            mobile      = mob1.replace(/ /g,"");
          
            $.ajax({
                url: '/site/demosendpin',
                type: 'post',
                dataType: 'html',
                data: 'data='+mobile,
                async: true,
                success: function(data) {
                    if(data==="ok") {
                         pullPage1();
                    } else {
                        alert("ERROR:"+data);
                    }
                },
                error: function(data) {
                    alert("ERROR:"+data);
                }});
        }
        function sendInvoice() {
            var mobile   = document.getElementById("inpMobile").value;
            var amount   = document.getElementById("inpAmount").value;
            var curDate  = document.getElementById("curDate").value;
            
            var mob     = mobile.replace("-", "");
            var mob1    = mob.replace("_", "");
            mobile      = mob1.replace(/ /g,"");
            
            $.ajax({
                url: '/site/demosendinvoice',
                type: 'post',
                dataType: 'html',
                data: 'data='+mobile+'|'+amount+'|'+curDate,
                async: true,
                success: function(data) {
                    if(data==="ok") {
                         pullPage1();
                    }
             }});
        }
    

    </script>
</body>
</html>
