<!DOCTYPE html>
 
 
<html lang="se" class="js flexbox canvas canvastext webgl no-touch geolocation postmessage websqldatabase no-indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage no-borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio no-localstorage no-sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/favico_full" type="image/x-icon" />
    <link rel="apple-touch-icon" href="/favico_full.png">
    <link rel="apple-touch-icon-precomposed" href="/favico_full.png">

    <!-- This one works for anything below iOS 4.2 -->
    <link rel="apple-touch-icon-precomposed apple-touch-icon" href="/favico_full.png">
    <title>QLIRR</title> 

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
    <input id="address" hidden  />
    <section id="firstFrontPage" align="center">
        <img src="/themes/frontend/gfx/login_logo.png" alt="Qlirr" width="80"/>
        <h1>Det här är QLIRR</h1> 
        <p id="desc1"> Med endast ett mobilnummer kan du enkelt och bekvämt handla, tanka</br>
            bilen, luncha, fixa frisyren eller varför inte hämta ut kontanter och</br>
            betala allt en annan gång. QLIRR hjälper dig även att hålla koll på din</br>
            ekonomi genom att samla alla köp på en och samma faktura.
        </p>
        <p id="desc2">
            För dig som handlare öppnar det upp för nya affärsmöjligheter, konkurrenskraftig service, </br>
            minskad kontanthantering och jämnare handel under hela månaden. Lite mer klirr i kassan,</br>
            helt enkelt.
        </p>
        <button class="btn btn-rounded btn-front" id="btnShowQ">Bli ett ombud</button>
        <img class="downArrow trigger" src="/themes/frontend/gfx/arrowDown.png" alt="Arrow Down" width="30" />
    </section>
    <section id="secondFrontPage">
        <div class="content container" align="center">
            <div class="section1">
                <img class="first_img imgBorder" alt="1st" src="/themes/frontend/gfx/01.png" />
                <img class="second_img imgBorder" alt="1st" src="/themes/frontend/gfx/02.png" />
            </div>
            <div class="section2">
                <img class="third_img  imgBorder" alt="1st" src="/themes/frontend/gfx/03.png" />
            </div>
            <div class="section3">
                <img class="fourth_img imgBorder" alt="1st" src="/themes/frontend/gfx/04.png" />
                <img class="fiveth_img imgBorder" alt="1st" src="/themes/frontend/gfx/05.png" />
            </div>
        </div>
    </section>
    <section id="thirdFrontPage">
        <div class="container">
            <div class="row" style="margin-top:65px">
                <div class="col-xs-6">
                    <p class="title">Så här fungerar det</p>
                    <h2>Testa själv hur enkelt det är att betala en annan gång eller göra kontantuttag. Börja med att skriva ditt mobilnummer i telefonen till höger. </h2>
                </div>
                <div class="col-xs-6" align="center">
                    <div>
                        <img class="demoIphone" src="/themes/frontend/gfx/iphone2.png" alt="mobile"/>
                        <iframe class="demoProcess" src="http://m.qlirr.com/demo/index"></iframe>
                        <div class="fix"> s</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="fourthFrontPage">
        <div class="container" style="margin-top:65px;padding-bottom:100px">
            <div class="row" align="center">
                <div class="col-xs-12">
                    <p class="title">Här finns vi</p>
                    <h3>QLIRR har som mål att finnas nära dig. Saknar du ett ombud i din närhet, så</br> tipsa oss om det genom att maila oss på <span>support@qlirr.com</span></h3>
                    <div class="searchBarShops" align="left">
                        <input id="searchShops" type="text"  placeholder="Skriv stad ombud eller postnummer" />
                        <i id="searchBtn" class="icons8-search size-28 " onclick="searchBtnBack();"></i>
                    </div>
                        <div id="searchResults" class="row shopSearch">
                   
                        </div>
                    <p onclick="window.open('/site/shopmap')" id="downInputSearch">Visa ombud nära mig <span><img src="/themes/frontend/gfx/point.png" width="28" alt="point"/></span></p>
                </div>
            
            </div>
            
        </div>
    </section>
    <section id="fifthFrontPage">
        <div class="container" style="padding-top:65px;padding-bottom:100px;">
            <div class="row" align="center">
                <p class="title">Frågor & Svar</p>
            </div>
            <div class="row">
                <div class="col-xs-8 col-xs-offset-2 responsive">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default orderListHover " style="border:none">
                          <div class="panel-heading" style="background-color: white;height: 63px;">
                            <h4 class="panel-title">
                                <div class="col-xs-11" >
                                    <p class="titleCollapse">Maste man betala sina rakningar med kotanter?</p>
                                </div>
                                <div class="col-xs-1" >
                                    <p class="arrowDown" data-toggle="collapse" data-parent="#accordion" data-target="#collapseOne" >
                                        <img data-value="0" src="/themes/frontend/gfx/arrowDownBlack.png" alt="arrowdown" width="28"/>
                                    </p>
                                </div>
                              
                                
                            </h4>
                          </div>
                          <div id="collapseOne" class="panel-collapse collapse ">
                            <div class="panel-body" style="border-top:none;padding-left:30px;padding-right:32px;padding-top:0px;color:rgba(0,0,0,0.5);font-size:17px;letter-spacing: 0.2px">
                                Med endast ett mobilnummer kan du enkelt och bekvamt handla, tanka bilen,<br> luncha, fixa
                            </div>
                          </div>
                        </div>
                        <div class="panel panel-default orderListHover " style="border:none">
                          <div class="panel-heading" style="background-color: white;height: 63px;">
                            <h4 class="panel-title">
                                <div class="col-xs-11" >
                                    <p class="titleCollapse">Var kostar det att nyttja Qlirr?</p>
                                </div>
                                <div class="col-xs-1" >
                                    <p class="arrowDown" data-toggle="collapse" data-parent="#accordion" data-target="#collapseTwo" >
                                        <img  data-value="0"  src="/themes/frontend/gfx/arrowDownBlack.png" alt="arrowdown" width="28"/>
                                    </p>
                                </div>
                              
                                
                            </h4>
                          </div>
                          <div id="collapseTwo" class="panel-collapse collapse ">
                            <div class="panel-body" style="border-top:none;padding-left:30px;padding-right:32px;padding-top:0px;color:rgba(0,0,0,0.5);font-size:17px;letter-spacing: 0.2px">
                                Med endast ett mobilnummer kan du enkelt och bekvamt handla, tanka bilen,<br> luncha, fixa
                            </div>
                          </div>
                        </div>
                        <div class="panel panel-default orderListHover " style="border:none">
                          <div class="panel-heading" style="background-color: white;height: 63px;">
                            <h4 class="panel-title">
                                <div class="col-xs-11" >
                                    <p class="titleCollapse">Kan jag skicka pengar till utlandet?</p>
                                </div>
                                <div class="col-xs-1" >
                                    <p class="arrowDown" data-toggle="collapse" data-parent="#accordion" data-target="#collapseThree" >
                                        <img  data-value="0" src="/themes/frontend/gfx/arrowDownBlack.png" alt="arrowdown" width="28"/>
                                    </p>
                                </div>
                              
                                
                            </h4>
                          </div>
                          <div id="collapseThree" class="panel-collapse collapse ">
                            <div class="panel-body" style="border-top:none;padding-left:30px;padding-right:32px;padding-top:0px;color:rgba(0,0,0,0.5);font-size:17px;letter-spacing: 0.2px">
                                Med endast ett mobilnummer kan du enkelt och bekvamt handla, tanka bilen,<br> luncha, fixa
                            </div>
                          </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        
    </section>
    <section id="footer">
        <div class="container" style="padding-right:0px;">
            <div class="row " style="margin-top:46px;margin-bottom:29px">
                <div class="col-xs-6">
                    <p class="rights">© 2014. All Rights Reserved.</p>
                </div>
                <div class="col-xs-6">
                    <a class="links">Allmanna villkor</a>
                    <a class="links">FAQ</a>
                    <a class="links" href="/user/login">Logga in</a>
                    <a class="links" style="margin-right:0px;">Ansök om att bli ombud</a>   
                </div>
            </div>
        </div>
    </section>
    <div id="showQDiv" hidden align="center" class="animated bounceInUp">
        <i id="close_acceptFull" class="icons8-cancel size-28 " onclick="closeQDiv()"></i>
        <div id="msg">
           <p id="title">Bli ett ombud</p>
           <p id="titleDesc">Driver du en tobakshandel, en livsmedelsaffär, en bensinstation eller <br> liknande publik verksamhet, då är du också som klippt och skuren for<br>att bli ombud för QLIRR.</p>
           <!--<span id="accept_price"> </span>&nbsp; <span id="accept_code"></span> <span class="questionmark"></span></br>-->
           <div class="formEmail">
               <input id='form_content_1' class="inputEmail" placeholder="Organisationsnummer">
               <input id='form_content_2'  class="inputEmail" placeholder="Besöksadress">
               <input id='form_content_3'  class="inputEmail" placeholder="Kontaktperson">
               <input id='form_content_4'  class="inputEmail" placeholder="Telefonnummer">
               <input id='form_content_5'  class="inputEmail" placeholder="E-postadress">
           </div>
           <button class="btn btn-accept" onclick="sendMail()">Ansök</button>
        </div>
        <div class="loader" hidden></div>
        
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="/themes/frontend/js/bootstrap.min.js"></script>

    
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
    
   var isiPad = navigator.userAgent.match(/iPad/i) != null;
   var isTablet = navigator.userAgent.match(/Tablet/i) != null;

    if( isMobile.any() && !isiPad && !isTablet) {
         window.location = 'http://m.qlirr.com';

    }
    
        function resizeSections() {
            vpw = $(window).width();
            vph = $(window).height();
            $('#firstFrontPage').height(vph-65);
            $('#fourthFrontPage').height(vph); 
        }
        resizeSections(); 
        $(window).resize(function() {
            resizeSections();
        });
        var executeSearch;
        function searchTransactions() {
            var a = document.getElementById('searchShops').value;    
    
            var c = $('#searchOption').val();
            $.ajax({
                url: '/user/orders/getShopsList', 
                type: 'post',
                dataType: 'html',
                data: 'data='+a,
                async: false,
                success: function(data) {

                     $("#searchResults").empty();
                     $("#searchResults").append(data);
                },
                error:function(data){
                 //  alert("Error: "+data);
               } 
            });
        }
        $('#searchShops').on('keyup', function(e) {
        clearTimeout(executeSearch);

        if ($(this).val()!=='') {
            if(e.which !== 13) {
                executeSearch = setTimeout(function(){searchTransactions()}, 200);  // ------->>>> tek kad se smisli onda izbaci rezultat
            }
        } else {
            $("#searchResults").empty();
        }
    });
    
    $("#searchResults").on('click', '.searchItem', function() {
        var shopId = $(this).attr('data-content');

        $.ajax({
            url: '/user/orders/getShopData',
            type: 'post',
            dataType: 'html',
            data: 'data='+shopId,
            async: false,
            success: function(data) { 
                var dataS = data.split('|');
                $('#searchShops').attr('placeholder',dataS[1]);
                $('#searchShops').val(''); 
                $('#searchResults').empty();
                window.open('http://www.google.se/maps/?q='+dataS[0], '_blank');
               
            },
            error:function(data){
             //  alert("Error: "+data);
           } 
        });
    }); 
    $(document).mouseup(function(event){
         $('#searchShops').attr('placeholder','Skriv stad ombud eller postnummer');
    });
    $("#btnShowQ").click(function() {
       $('#showQDiv').removeClass('bounceOutDown');
       $('#showQDiv').addClass('bounceInUp');
       $('#showQDiv').show();
    });
    function closeQDiv() {
       $('#showQDiv').removeClass('bounceInUp');
       $('#showQDiv').addClass('bounceOutDown');

    }
    
    function sendMail() {
        var a = $('#form_content_1').val();
        var b = $('#form_content_2').val();
        var c = $('#form_content_3').val();
        var d = $('#form_content_4').val();
        var e = $('#form_content_5').val();
        var content = a+'|'+b+'|'+c+'|'+d+'|'+e;
        $.ajax({
            url: '/user/orders/sendMail',
            type: 'post',
            dataType: 'html',
            data: 'data='+content,
            async: false,
            success: function(data) { 
                alert(data);
            },
            error:function(data){
             //  alert("Error: "+data);
           } 
        });
    }
    
    $('.arrowDown').click(function() {
        
       var a = $(this).children().attr('data-value');
       if (a==='0') {
            $('.arrowDown').children('*').css( "transform", "rotateX(0deg)" );
            $(this).children().css( "transform", "rotateX(180deg)" );
            $('.arrowDown').children('*').attr('data-value', '0');
            $(this).children().attr('data-value', '1');
        } else {
            $(this).children().css( "transform", "rotateX(0deg)" );
            $(this).children().attr('data-value', '0');
        }

        
    });
    </script>
    
</body>
</html>