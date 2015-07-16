<?php 

    $shopId   = Yii::app()->session['userIDm'];
    $myPass   = Yii::app()->session['userIDp'];
    $shop     = ShopsDao::getShopById($shopId);
    $orders   = OrdersDao::getOrdersByShopId($shop->id);
    if (isset(Yii::app()->session['userIDm'])) {
        if (isset(Yii::app()->session['userIDp'])) {
            if ($shop->password !== $myPass) {
                $this->redirect('/user/login');
            }
        } else {
            $this->redirect('/user/login');
        }
    } else {
        $this->redirect('/user/login');
    }

?>
<!DOCTYPE html>
<html lang="se" class="full">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />

    <title>Qlirr</title>

    <!-- Bootstrap core CSS -->
    <link href="/themes/frontend/css/bootstrap.min.css" rel="stylesheet">
    <link href="/themes/frontend/css/butik.css" rel="stylesheet">
    <link href="/themes/frontend/css/style.css" rel="stylesheet">
    
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800,700,600,300' rel='stylesheet' type='text/css'>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

  </head>
<!-- NAVBAR
================================================== -->
<body class="full">
    <input id="myPass" hidden value="<?php echo $myPass;?>" />
    <input id="inputUser" hidden value="<?php echo $shop->shop_id;?>" />
    <input id="inputCurrentOrder" hidden value="" />
    <section id="header">
        <div class=" col-xs-3 header1" style="padding-left:0px" >
            <div id="headerLogo" style="float:left">
                <img onclick="showPopMenu(1)" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/gfx/login_logo.png" width="73" height="73"/>
            </div>
            <div class="butik" style="float:left;margin-left:15px;" >
                <p id="name"><?php echo $shop->name ?></p>
                <p id="cid"><?php echo $shop->shop_id ?></p>
                <p id="pcountOrdersMobile" onclick="location.href='/user/orders'">Du har <span id="countOrders"><?php echo count($orders); ?></span> nya transaktioner. </p>
            </div>
        </div>
        <div class=" col-xs-6 header2" align="center">
            <p id="pcountOrders"  onclick="location.href='/user/orders'">Du har <span id="countOrders"><?php echo count($orders); ?></span> nya transaktioner. </p>
        </div>    
        <div class=" col-xs-3 header3" style="padding-right:0px" align="right">
            
        </div>  

    </section>
    <section id="sideBar">
       <div class="sideBarBtn" align="center"  onclick="location.href='/user/orders'"><span class="tool-tip slideIn right" style="width:180px;top:34px">Betala varor / Kontantuttag</span>
            <i id="icons8-cash_register" class="icons8-cash_register size-28"  ></i>
        </div>
        <div class="sideBarBtn sideBarToolTip active" align="center"  onclick="location.href='/user/bills'"><div class="tool-tip slideIn right" style="top:106px;width:147px">Betala räkningar</div>
            <i id="icons8-bill" class="icons8-bill size-28 active" ></i>
        </div>
        <div class="sideBarBtn sideBarToolTip" align="center"  onclick="location.href='/user/money/exchange'" ><div class="tool-tip slideIn right" style="width:136px;top:179px">Växla valuta </div>
            <i id="icons8-money_exchange" class="icons8-money_exchange size-28 " ></i>
        </div>
        <!--------------------------- NOVE IKONE ---------------------->
        <div class="sideBarBtn sideBarToolTip" align="center"  onclick="location.href='/user/money/borrow'" ><div class="tool-tip slideIn right" style="width:136px;top:251px">Ansöka om banklån </div>
            <i id="icons8-museum" class="icons8-museum size-28 " ></i>
        </div>
        <div class="sideBarBtn sideBarToolTip" align="center"  onclick="location.href='/user/money/send'" ><div class="tool-tip slideIn right" style="width:156px;top:325px">Skicka / Ta emot pengar </div>
            <i id="icons8-data_in_both_directions" class="icons8-data_in_both_directions size-28 " ></i>
        </div>
        <div class="sideBarBtn sideBarToolTip" align="center"  onclick="location.href='/user/orders/transactions'" ><div class="tool-tip slideIn right" style="width:136px;top:397px">Transaktionhistorik </div>
            <i id="icons8-clock" class="icons8-clock size-28 " ></i>
        </div>
        <div class="sideBarBtn sideBarToolTip" align="center"  onclick="location.href='/user/profile/'" ><div class="tool-tip slideIn right" style="width:136px;top:470px">Företagsprofil </div>
            <i id="icons8-info" class="icons8-info size-28 " ></i>
        </div>
        <!--------------------------- NOVE IKONE kraj ---------------------->
        <div class="sideBarBtn sideBarToolTip iconBottom" align="center" onclick="logoutProfile()"><div class="tool-tip slideIn right" style="width:76px;top:30px;" >Logga ut</div>
            <i id="icons8-cancel" class="icons8-exit size-28 " style="margin-right:0px;margin-left:2px;" ></i>
        </div>

    </section>
    
    <div class="container offsetHeader dashboard">
           <div class="row offsetHeader">
                <div class="column col-xs-8 col-xs-offset-2">
                    <p class="title">Betala räkningar</p>

                </div>   
            </div>
<!--        <div align="center" style="margin-top:15px;">
            <span id="profileChangeBtn" class="profilChangeBtn">Ändra inställningar</span>
            <button id="profileSaveBtn" class="btn btn-login profilSave">Spara ändringar</button>
        </div>-->
    </div>
    <div id="training" hidden align="center" class="animated bounceInUp">
        <i class="icons8-cancel size-28 " onclick="closeTraining()" ></i>
        <div id="msg">
           <p id="title">Utbildningar</p>
           <p id="receipttitleDesc">Kontrollera ID-handlingarn <span style="padding-left:8px;"><img src="/themes/frontend/gfx/pdf.png" alt="pdf" width="22"/></span></p>
           <p id="receipttitleDesc">AML - Penningtvätt & finansiering av terrorism <span style="padding-left:8px;"><img src="/themes/frontend/gfx/pdf.png" alt="pdf" width="22"/></span</p>
           <!--<p class="totalOrder">Totala</p>-->
           <!--<p class="receiptPrice">&nbsp;</p>-->
           <span id="cancel_priceReceipt"> </span>&nbsp; <span id="cancel_codeReceipt"></span></br>
           <!--<button class="btn btn-accept" onclick="closeTraining()">Klar</button>-->
        </div>
        
    </div>
    <div id="contact" hidden align="center" class="animated bounceInUp">
       <i class="icons8-cancel size-28 "  onclick="closeContact()"></i>
       <div id="msg">
          <p id="title">Kundtjänst</p>
          <p id="receipttitleDesc">support@qlirr.com  <span style="padding-left:8px;"><img src="/themes/frontend/gfx/email.png" alt="pdf" width="22"/></span</p>
          <!--<p class="totalOrder">Totala</p>-->
          <!--<p class="receiptPrice">&nbsp;</p>-->
          <span id="cancel_priceReceipt"> </span>&nbsp; <span id="cancel_codeReceipt"></span></br>
          <!--<button class="btn btn-accept" onclick="closeContact()">Klar</button>-->
       </div>
    </div>
    <div id="pop-menu" hidden class="animated2 bounceInLeft">
        <img src="/themes/frontend/gfx/login_logo.png" />
        <h1>QLIRR.</h1>
        <h1>FRAMTIDENS BANK.</h1>
        <div class="menu">
        
                <div class="col-xs-6 border-right" align="center">
                    <div class="menu-item" onclick="location.href='/user/orders'">
                        <div class="countIcon" id="countOrders-Icon" hidden>0</div>
                        <i id="icons8-cash_register" class="icons8-cash_register size-28"></i>
                        <p>LÅNA PENGAR</p>
                    </div>
                </div>
                <div class="col-xs-6 border-right-no menuline" align="center">
                    <div class="menu-item" onclick="showPopMenu(0)">
                        <i id="icons8-bill" class="icons8-bill size-28" ></i>
                        <p>BETALA RÄKNINGAR</p>
                    </div>
                    
                </div>
     
         
                <div class="col-xs-6 border-right no-menuline" align="center">
                    <div class="menu-item" onclick="location.href='/user/money/exchange'">
                        <i id="icons8-money_exchange" class="icons8-money_exchange size-28"></i>
                        <p>VÄXLA VALUTA</p>
                    </div>
                </div>
                <div class="col-xs-6 border-right-no menuline" align="center">
                    <div class="menu-item" onclick="location.href='/user/money/borrow'">
                        <i id="icons8-museum" class="icons8-museum size-28" ></i>
                        <p>ANSÖK OM BANKLÅN</p>
                    </div>
                    
                </div>
 
            
                <div class="col-xs-6 border-right" align="center">
                    <div class="menu-item" onclick="location.href='/user/money/send'">
                        <i id="icons8-data_in_both_directions" class="icons8-data_in_both_directions size-28"></i>
                        <p>SKICKA PENGAR</p>
                    </div>
                </div>
                <div class="col-xs-6 border-right-no" align="center">
                    <div class="menu-item" onclick="logoutProfile()">
                        <i id="icons8-exit" class="icons8-exit size-28" ></i>
                        <p>LOGGA UT</p>
                    </div>
                </div>
   
        </div>
    </div>
    <footer>
        <div class="footerLeft">
            <p>© <?php echo date('Y'); ?> All Rights Reserved</p>
        </div>
        <div class="footerRight" align="right">
            <a onclick="showTrainingDiv()">Utbildningar</a><a  onclick="showContactDiv()">Kundtjänst</a>
        </div>
    </footer>
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="/themes/frontend/js/bootstrap.min.js"></script>

<script>
    setInterval('refreshList()',2000);
    var isMobile = {
        Android: function() {
        return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
        return navigator.userAgent.match(/iPhone|iPod/i);
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
    
    
    
    if( isMobile.any() ) {
        $("#sideBar").hide();
//        $("#pop-menu").show();
    }
   
    function logoutProfile() {
        window.location = "/user/profile/logout";
    }
    
    function searchBtn() {
        var a = $('#searchBtn').attr('dataio');
        if (a==="0") {
            $('#searchBtn').attr('dataio', '1');
            $('#searchBtn').addClass('searchBarFull');
            $('#inputSearch').addClass('searchBarInput');
            $('#inputSearch').focus();
            $("#searchBtn").css("cursor", "default");
        } else {
            $('#searchBtn').attr('dataio', '0');
            $('#searchBtn').removeClass('searchBarFull');
            $('#inputSearch').removeClass('searchBarInput');  
            $("#searchBtn").css("cursor", "pointer");
        }
        
    }
     function showTrainingDiv() {
      $('#training').removeClass('bounceOutDown'); 
       $('#training').addClass('bounceInUp');
       $('#training').show();
    }
    function closeTraining() {
       $('#training').removeClass('bounceInUp'); 
       $('#training').addClass('bounceOutDown');

    }  
     function closeContact() {
       $('#contact').removeClass('bounceInUp'); 
       $('#contact').addClass('bounceOutDown');

    }  
     function showContactDiv() {
      $('#contact').removeClass('bounceOutDown'); 
       $('#contact').addClass('bounceInUp');
       $('#contact').show();
    }
    
    $("#profileChangeBtn").click(function() {
        $('.profilTableRight input').removeClass('profilInputReadOnly');
        $('.profilTableRight input').attr({'readonly': false, 'disabled': false});
        
        $(this).fadeOut('fast', function() {
            $(this).hide();
            $('#profileSaveBtn').fadeIn('fast');
        });    
    });
     $("#profileSaveBtn").click(function() {
        $('.profilTableRight input').addClass('profilInputReadOnly');
        $('.profilTableRight input').attr({'readonly': 'readonly', 'disabled': 'disabled'});
        
        $(this).fadeOut('fast', function() {
             $(this).hide();
             $('#profileChangeBtn').fadeIn('fast');
        });    
    });
    
    function logoutProfile() {
        window.location = "/user/profile/logout";
    }
    
//     --------------------------- SAVE PROFILE SETTINGS --------------------------

    function order(action) {
        var a = document.getElementById("inputCurrentOrder").value;
        
         $.ajax({
            url: '/user/profile/saveProfile',
            type: 'post',
            dataType: 'html',
            data: 'data='+a+"|"+action,
            async: false,
            success: function(data) {
                
            },
            error:function(data){
               alert("Error: "+data);
           } 
        });
    }
    function showPopMenu(dir) {
        if (dir===1) {
            $("#pop-menu").removeClass('bounceOutLeft');
            $("#pop-menu").addClass('bounceInLeft');
            $("#pop-menu").show();
        } else {
            $("#pop-menu").removeClass('bounceInLeft');
            $("#pop-menu").addClass('bounceOutLeft');
        }
    }
    
    function refreshList() {
        var shopID      = document.getElementById("inputUser").value;
        
        $.ajax({
            url: '/user/orders/getList',
            type: 'post',
            dataType: 'json',
            data: 'data='+shopID,
            async: true,
            success: function(data) {
                jsoncount = countJson(data);
                if (jsoncount > 0) {
                    $('#countOrders-Icon').text(jsoncount);
                    $('#countOrders-Icon').show();
                } else if (jsoncount === 0) {
                   
                    $('#countOrders-Icon').hide();
                }
            },
            error:function(data){
             //  alert("Error: "+data);
           } 
        });
     }
    function countJson(obj) {
        var prop;
        var propCount = 0;

        for (prop in obj) {
          propCount++;
        }
        return propCount;
    }
    $( window ).resize(function() {
       
       var a = $(window).height();
       var b = window.innerHeight;
       if (a===b) {
           $("#pop-menu .menu .menu-item i").addClass('smallMenuIcons'); 
       } else {
           $("#pop-menu .menu .menu-item i").removeClass('smallMenuIcons'); 
       }

   });
    $(document).ready(function() {
        var a = $(window).height();
        var b = window.innerHeight;
        if (a===b) {
            $("#pop-menu .menu .menu-item i").addClass('smallMenuIcons'); 

        } else {
            $("#pop-menu .menu .menu-item i").removeClass('smallMenuIcons'); 
        }

     });
    
</script>
</body>
</html>