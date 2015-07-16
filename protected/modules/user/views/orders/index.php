<?php 
    $firstTime = $_GET['firsttime'];
    
    $shopId    = Yii::app()->session['userIDm'];
    $myPass    = Yii::app()->session['userIDp'];
    $shop      = ShopsDao::getShopById($shopId);
    $orders    = OrdersDao::getOrdersByShopId($shop->id);
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
    <link href="/themes/frontend/css/bootstrap.min.css" rel="stylesheet"  media="all">
    <link href="/themes/frontend/css/butik.css" rel="stylesheet">
    <link href="/themes/frontend/css/style.css" rel="stylesheet" media='screen, print' type='text/css'> 

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800,700,600,300' rel='stylesheet' type='text/css'>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

  </head>
<!-- NAVBAR
================================================== -->
<body >
    <input id="myPass" hidden value="<?php echo $myPass;?>" />
    <input id="inputUser" hidden value="<?php echo $shop->shop_id;?>" />
    <input id="inputCurrentOrder" hidden value="" />
    <input id="tempDoc" hidden value="" />
    <input id="firstTime" hidden value="<?php echo $firstTime;  ?>" />
    <input id="touchMoveInp" hidden value="0" />
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
        <div class="sideBarBtn active" align="center"  onclick="location.href='/user/orders'"><span class="tool-tip slideIn right" style="width:180px;top:34px">Betala varor / Kontantuttag</span>
            <i id="icons8-cash_register" class="icons8-cash_register size-28 active"  ></i>
        </div>
        <div class="sideBarBtn sideBarToolTip" align="center"  onclick="location.href='/user/bills'"><div class="tool-tip slideIn right" style="top:106px;width:147px">Betala räkningar</div>
            <i id="icons8-bill" class="icons8-bill size-28 " ></i>
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
        
        <div class="sideBarBtn sideBarToolTip iconBottom" align="center" onclick="logoutProfile()"><div class="tool-tip slideIn right" style="width:76px;top:30px;" >Logga ut</div>
            <i id="icons8-cancel" class="icons8-exit size-28 " style="margin-right:0px;margin-left:2px;" ></i>
        </div>

    </section>
        
    <div class="container offsetHeader dashboard">
        <div class="row offsetHeader">
            <div class="column col-xs-8 col-xs-offset-2 responsiveDashboard">
                <p class="title">Betala varor / Kontantuttag</p>
                <p class="titleDesc">Inkommande transaktioner som väntar på behandling. Var god kontrollera att uppgifterna stämmer.</p>
                
                <div id="offerList" style="margin-top:40px;z-index:-1;margin-left:12px;margin-right:12px;margin-bottom:60px" >
                   <!--<p id="textRemove" style="text-align:center;font-size:14px;margin-top:20px">Listan uppdateras om 2 sekunder...</p>-->
                    <div id="textRemove" class="loader"></div>
                </div>
                
            </div>   
        </div>
    </div>
    
    <div id='tool_tip_div' class='tool-tip slideIn top'>Godkänn transaktion</div>
    <div id='tool_tip_div_cancel' class='tool-tip slideIn top'>Avbryt transaktion</div>
    
    <div id="acceptFull" hidden align="center" class="animated bounceInUp">
        <i id="close_acceptFull" class="icons8-cancel size-28 " ></i>
        <div id="msg">
           <p id="title">Godkänn transaktion</p>
           <p id="titleDesc">Är du säker på att du vill godkänna</p>
           <span id="accept_price"> </span>&nbsp; <span id="accept_code"></span> <span class="questionmark">?</span></br>
           <button class="btn btn-accept" onclick="acceptOrder()">Ja</button>
        </div>
        <div class="loader" hidden></div>
        
    </div>
    <div id="cancelFull" hidden align="center" class="animated bounceInUp">
        <i id="close_cancelFull" class="icons8-cancel size-28 " ></i>
        <div id="msg">
           <p id="title">Avbryt transaktion</p>
           <p id="titleDesc">Är du säker på att du vill avbryta</p>
           <span id="cancel_price"> </span>&nbsp; <span id="cancel_code"></span><span class="questionmark">?</span></br>
           <button class="btn btn-accept" onclick="cancelOrder()">Ja</button>
        </div>
        
    </div>
    <div id="receiptFull" hidden align="center" class="animated bounceInDown">
        <!--<i id="close_receiptFull" class="icons8-cancel size-28 " ></i>-->
        <img onclick="PrintElem('#receiptFull')" class="receiptPrintIcon" src="/themes/frontend/gfx/print.png" alt="print" />
        <div id="msg">
           <img id="printLogo" src="/themes/frontend/gfx/login_logo.png" style="display:none" />
           <p id="title">Transaktionen är godkänd</p>
           <p id="receipttitleDesc">&nbsp;</p>
           <p class="totalOrder">Totala beloppet</p>
           <p class="receiptPrice">&nbsp;</p>
           <span id="cancel_price"> </span>&nbsp; <span id="cancel_code"></span></br>
           <button id="receiptBTN" class="btn btn-accept" onclick="closeReceipt()">Klar</button>
        </div>
        
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
    <div id="ssnDiv" hidden align="center" class="animated bounceInUp">
        <i class="icons8-cancel size-28 "  onclick="closessn1()"></i>
           <div id="msg">
                <p id="title">Bekräfta kundens identitet</p>
                <p id="ssnDiv_name"></p>
                <div class="errorPlace">
                    <p id="errorMSG" class="errorMSG" hidden>Personnumret stämmer inte. Var god försök igen.</p>
                </div>
                <div class="ssnChooseReg" align="left">
                    <p id='opt1' data-id='1' class='chooseSp'><i class="icons8-checkmark chooseSq"></i>Svenskt ID-kort</p>
                    <p id='opt2' data-id='2' class='chooseSp '><i class="icons8-checkmark chooseSq"></i>Svenskt körkort</p> 
                    <p id='opt3' data-id='3' class='chooseSp'><i class="icons8-checkmark chooseSq "></i>Svenskt pass</p>
                  
                </div>
                <input id='ssnInp' class='inputEmail' placeholder='Skriv personnummer' maxlength="15"/>
                <button class="btn btn-accept width-360" onclick="closessn()">Bekräfta</button>
           </div>
    </div>
    
    <div id="pop-menu" hidden class="animated2 bounceInLeft">
        <img src="/themes/frontend/gfx/login_logo.png" />
        <h1>QLIRR.</h1>
        <h1>FRAMTIDENS BANK.</h1>
        <div class="menu">
<!--            <div class="menu-row">-->
                <div class="col-xs-6 border-right " align="center">
                    <div class="menu-item" onclick="showPopMenu(0)">
                        <div class="countIcon" id="countOrders-Icon" hidden>0</div>
                        <i id="icons8-cash_register" class="icons8-cash_register size-28"></i>
                        <p>LÅNA PENGAR</p>
                    </div>
                </div>
                <div class="col-xs-6 border-right-no menuline" align="center">
                    <div class="menu-item" onclick="location.href='/user/bills'">
                        <i id="icons8-bill" class="icons8-bill size-28" ></i>
                        <p>BETALA RÄKNINGAR</p>
                    </div>
                    
                </div>
            <!--</div>-->
            <!--<div class="menu-row">-->
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
            <!--</div>-->
            <!--<div class="menu-row">-->
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
            <!--</div>-->
        </div>
    </div>
    <div class="whitescreen" hidden></div>
    <footer class="firstPage">
        <div class="footerLeft">
            <p>© <?php echo date('Y'); ?> All Rights Reserved</p>
        </div>
        <div class="footerRight" align="right">
            <a onclick="showTrainingDiv()">Utbildningar</a><a onclick="showContactDiv()">Kundtjänst</a>
        </div>
    </footer>
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="/themes/frontend/js/bootstrap.min.js"></script>
    <script src="/themes/frontend/js/application.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-52444227-2', 'auto');
  ga('send', 'pageview');

</script>
<script>
       var isMobile = {
        Android: function() {
        return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
        return navigator.userAgent.match(/iPhone|iPod/i); //removed Ipad!!!!
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
    

    
    if( isMobile.any() && !navigator.userAgent.match(/Tablet/i) ) {
        $("#sideBar").hide();
//        $("#pop-menu").show();
        var a = $('#firstTime').val();
        if (a=='true') {
            $('.whitescreen').show();
            $('#touchMoveInp').val("1");
            $("#pop-menu").show();
        }
    }
   
    function logoutProfile() {
        window.location = "/user/profile/logout";
    }

    function acceptOrder() {
//        $('.loader').show();
        order('approve');
    }
    function cancelOrder() {
//        $('.loader').show();
        order('cancel');
    }

    function searchBtn() {
        var a = $('#searchBtn').attr('dataio');
        if (a==="0") {
            $('#searchBtn').attr('dataio', '1');
            $('#searchBtn').addClass('searchBarFull');
            $('#inputSearch').addClass('searchBarInput');
            $('#inputSearch').focus();
            $("#searchBtn").css("cursor", "default");
        }         
    }
    
  
    
    
    var executeSearch;
    var searchbarback;
    $('#inputSearch').on('keypress', function() {
        clearTimeout(executeSearch);
        clearTimeout(searchbarback);
        executeSearch = setTimeout(function(){searchTransactions()}, 1200);  // ------->>>> tek kad se smisli onda izbaci rezultat
    });
    $('#inputSearch').focusout(function() {
        searchbarback = setTimeout(function(){searchBtnBack()},10000); 
    });
    
    function searchTransactions() {
        var a = document.getElementById('inputSearch').value;    
        var b = document.getElementById('inputUser').value;   
        
        $.ajax({
            url: '/user/orders/getSearchListFaktura',
            type: 'post',
            dataType: 'html',
            data: 'data='+a+"|"+b,
            async: false,
            success: function(data) {
                
//                 $("#psearchCondition").html(' - Search: <span style="font-style:italic;color:black">'+a+'</span>');  
                 $(".searchResItem").empty();
                 $(".searchResItem").append(data);
            },
            error:function(data){
             //  alert("Error: "+data);
           } 
        });
    }
    
    function searchBtnBack() {
 
        var a = $('#searchBtn').attr('dataio');
        if (a==="1") {
            $('#searchBtn').attr('dataio', '0');
            $('#searchBtn').removeClass('searchBarFull');
            $('#inputSearch').removeClass('searchBarInput');  
            $("#searchBtn").css("cursor", "pointer");
                
        }
        
    }


    setInterval('refreshList()',2000);
    setTimeout('removeP()', 1800);

    function showMenu(){
        var a = $("#mobileMenu").attr('data-tag');

        if (a==="0") { 
            $("#mobileMenu").addClass('showMenu');
            $("#mobileMenu" ).attr('data-tag', '-130');
            $(".blackMenu").fadeIn('fast');
            $("#test1").removeClass('pullright');
            $("#test1").addClass('pullleft');
            $("#stickyribbon").removeClass('pullright');
            $("#stickyribbon").addClass('pullleft');
            

         } else {
              closeMenu();
         }

    }
    
    function closeMenu() {
        $("#mobileMenu").removeClass('showMenu');
        $("#mobileMenu" ).attr('data-tag', '0');
        $("#stickyribbon").removeClass('pullleft');
        $("#stickyribbon").addClass('pullright');
        $("#test1").removeClass('pullleft');
        $("#test1").addClass('pullright');
        $(".blackMenu").fadeOut('fast');
    }
                
    $('.chooseSp').on('click', function() {
        $('.chooseSp').removeClass('active');
        $(this).addClass('active');
        $('#tempDoc').val( $(this).attr('data-id'));
        
    });             


    function removeP() {
        $("#textRemove").fadeOut("fast");
    }

    
   
    function showPopMenu(dir) {
      
        if( isMobile.any() && !navigator.userAgent.match(/Tablet/i)) {
            if (dir===1) {

                $('body').addClass('no-scrolling');
                $(window).scrollTop();
                $('#touchMoveInp').val("1");
                $("#pop-menu").removeClass('bounceOutLeft');
                $("#pop-menu").addClass('bounceInLeft');
                $("#pop-menu").show();
            } else {
                $('body').removeClass('no-scrolling');
                $('#touchMoveInp').val("0");
                $(".whitescreen").hide();
                $("#pop-menu").removeClass('bounceInLeft');
                $("#pop-menu").addClass('bounceOutLeft');
            }

        } 
    }
        $(document).on("touchmove", function(evt) { 
            var dir = $('#touchMoveInp').val();
            if (dir==="1") {
                return false;
            } else if (dir==="0") {
                return true;
            }
         });
    $( document ).on( "mouseenter", ".icons8-checkmark", function() {
        var el = $(this);
        var pos = el.offset();
        $('#tool_tip_div').css('top', pos.top-58);
        $('#tool_tip_div').css('left', pos.left+el.width()-80);
        $('#tool_tip_div').addClass('tool-tip-hover');
    });
    
    $( document ).on( "mouseenter", "#delete-offer", function() {
        var el = $(this);
        var pos = el.offset();
        $('#tool_tip_div_cancel').css('top', pos.top-58);
        $('#tool_tip_div_cancel').css('left', pos.left+el.width()-80);
        $('#tool_tip_div_cancel').addClass('tool-tip-hover');
    });
    
     $( document ).on( "click", ".icons8-checkmark", function() {
        var el = $(this);
        var data = el.attr('data-holder');
        var datas = data.split("|");
        $("#inputCurrentOrder").val(datas[0]);
        $("#accept_price").html(datas[1]);
        $("#accept_code").html("("+datas[2]+")");
        $(".receiptPrice").html(datas[1]);
        $("#receipttitleDesc").html("Referens "+datas[2]);
        $.ajax({
            url: '/user/orders/checkBuyer',
            type: 'post',
            dataType: 'html',
            data: 'data='+datas[0],
            async: false,
            success: function(data2) {
                var data2S = data2.split('|');
                if(data2S[0] === '#verified') {

                    $('#acceptFull').removeClass('bounceOutDown');
                    $("#acceptFull").addClass('bounceInUp');
                    $("#acceptFull").show();
                } else {
               
                    $('#ssnDiv_name').html(data2S[1]);
                    $('#ssnDiv').removeClass('bounceOutDown');
                    $("#ssnDiv").addClass('bounceInUp');
                    $('#ssnDiv').show();
                }
            },
            error:function(data){
             //  alert("Error: "+data);
           } 
        });
       
        
    });
    
     $( document ).on( "click", ".delete", function() {
        var el = $(this);
        var data = el.attr('data-holder');
        var datas = data.split("|");
        console.log(datas[0]);
        var id = datas[0];
        $("#inputCurrentOrder").val(id.toString());
        $("#cancel_price").html(datas[1]);
        $("#cancel_code").html("("+datas[2]+")");
        $("#cancel_priceReceipt").html(datas[1]);
        $("#cancel_codeReceipt").html("("+datas[2]+")");
        
        $('#cancelFull').removeClass('bounceOutDown');
        $("#cancelFull").addClass('bounceInUp');
        $("#cancelFull").show();
    });
    
    $("#close_acceptFull").click(function() {
       $('#acceptFull').removeClass('bounceInUp');
       $('#acceptFull').addClass('bounceOutDown');
    });
    
    $("#close_cancelFull").click(function() {
       $('#cancelFull').removeClass('bounceInUp');
       $('#cancelFull').addClass('bounceOutDown');
    });
    function closeReceipt() {
       $('#receiptFull').removeClass('bounceInDown'); 
       $('#receiptFull').addClass('bounceOutUp');
//       $('.loader').hide();
       location.href='/user/orders';
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
    
    function closessn1() {
        $('#ssnDiv').removeClass('bounceInUp'); 
        $('#ssnDiv').addClass('bounceOutDown');
    }
    function closessn() {
        var b = $('#tempDoc').val();
        var a = $('#ssnInp').val(); 
        var ssn1     = a.split('-').join('');
        var ssn2     = ssn1.split(' ').join('');
        
        if (ssn2.length === 10) {
            ssn2='19'+ssn2;
        }
        
        if (b.length===0) {
          $('#errorMSG').show();  
        } else {
            $.ajax({
                url: '/user/orders/verifyBuyer',
                type: 'post',
                dataType: 'html',
                data: 'data='+ssn2+'|'+b,
                async: false,
                success: function(data) {
                    if (data==='#ok') {
                        $('#ssnDiv').removeClass('bounceInUp'); 
                        $('#ssnDiv').addClass('bounceOutDown');
                        $('#acceptFull').removeClass('bounceOutDown');
                        $('#acceptFull').addClass('bounceInUp');
                        $('#acceptFull').show();
                    } else {
                        $('#errorMSG').show();
                    }
                },
                error:function(data){
                   alert("Error: "+data);
               } 
            });
        }
    } 
    
     function showContactDiv() {
       $('#contact').removeClass('bounceOutDown'); 
       $('#contact').addClass('bounceInUp');
       $('#contact').show('fast');
    }
    function closeContact() {
       $('#contact').removeClass('bounceInUp'); 
       $('#contact').addClass('bounceOutDown');

    } 
    $("#close_receiptFull").click(function() {
       $('#receiptFull').removeClass('bounceInDown'); 
       $('#receiptFull').addClass('bounceOutUp');
//       $('.loader').hide();
       location.href='/user/orders';
    });
    
    $( document ).on( "mouseleave", ".icons8-checkmark", function() {
        $('#tool_tip_div').removeClass('tool-tip-hover');
    });  
      
    $( document ).on( "mouseleave", ".icons8-cancel", function() {
        $('#tool_tip_div_cancel').removeClass('tool-tip-hover');
    });  
    
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
                
                $('#countOrders').text(jsoncount);
                
//                $('#pcountOrders').fadeIn("fast");
                if (jsoncount > 0) {
                    $("#textRemove").fadeOut("fast");
                    $('#countOrders-Icon').text(jsoncount);
                    $('#countOrders-Icon').show();
                    $.each(data, function(i, item) {
//                        console.log(item.status + ' - ' + item.id);
                       
                        if($("#" + item.id).length === 0) {
                            if (item.status === '1') {
                                var itemData    = item.time.split("|");
                                var dataId      = "<div  id='"+item.id+"' class='row orderListHover'>";
                                var dataPrice   = "<div style='float:left;margin-right:5px;width:78px'><p style='text-align:center;font-size:14px; color:#aaa;padding-top:14px;margin-bottom:0px'>"+itemData[0]+"</p><p style='padding-top:7px;text-align:center;font-size:14px; color:#aaa;'>"+itemData[1]+"</p></div><div style='float:left'><p style='font-size:22px;font-weight:700;color:#00374C;padding-top:10px;margin-bottom:0px;'>"+item.price+"</p><p style='font-size:14px; color: #aaa;'>Ref. "+item.code+"</p></div>";
                                var dataCode    = "<div style='float:right;' class='buttons'><div style='width:50%;float:left;margin-top:12px'><i id='delete-offer' data-holder='"+item.id+"|"+item.price+"|"+item.code+"' class='icons8-cancel delete size-28 ' style='color:rgb(209,3,28);'></i></div><div  style='width:50%;float:left;margin-top:12px'><i id='accept-"+item.id+"' data-holder='"+item.id+"|"+item.price+"|"+item.code+"' class='icons8-checkmark size-28 ' style='color:rgb(112,195,22)'></i></div></div>";
                                var htmlOut     = dataId + dataPrice + dataCode;
                                $(htmlOut).hide().prependTo("#offerList").fadeIn(700);

                            } else if ( item.status==='2') {
                                $.post( "/user/orders/removeFromList/id/"+item.id);
                            } else if (item.status === '3') {
                                $.post( "/user/orders/removeFromList/id/"+item.id);
                            }
                        } else {
                           if (item.status === '2') {
                                $('#'+item.id).remove();
                                $.post( "/user/orders/removeFromList/id/"+item.id);
                            } else if (item.status === '3') {
                                $('#'+item.id).remove();
                                $.post( "/user/orders/removeFromList/id/"+item.id);
                            }

                        }
                    });
                } else if (jsoncount === 0) {
                    $('.loader').fadeOut('fast');
                    $('#countOrders-Icon').hide();
                } else {
                    
                    $("#textRemove").text("Det finns inga nya betalningar.");
                    $("#textRemove").fadeIn("fast");
                }
                
            },
            error:function(data){
             //  alert("Error: "+data);
           } 
        });
     }
     

     
     $(document).ready(function() {
        var pos = $("#offerList").offset();
        $('#tool_tip_div').css('top', pos.top-58);
        $('#tool_tip_div').css('left', pos.left+$("#offerList").width()-88);
        $('#tool_tip_div_cancel').css('top', pos.top-58);
        $('#tool_tip_div_cancel').css('left', pos.left+$("#offerList").width()-138);
            var a = $(window).height();
            var b = window.innerHeight;
            
            if (a===b) {
                $("#pop-menu .menu .menu-item i").addClass('smallMenuIcons'); 
                
            } else {
                $("#pop-menu .menu .menu-item i").removeClass('smallMenuIcons'); 
            }
            if (b < 657) {
                $('.iconBottom').addClass('iconBottomRes');
            } else {
                $('.iconBottom').removeClass('iconBottomRes');
            }

     });
     
     $(window).resize(function(){
        var pos = $("#offerList").offset();
        $('#tool_tip_div').css('top', pos.top-58);
        $('#tool_tip_div').css('left', pos.left+$("#offerList").width()-88);
        $('#tool_tip_div_cancel').css('top', pos.top-58);
        $('#tool_tip_div_cancel').css('left', pos.left+$("#offerList").width()-138);
        
     });
    
    function openView(id) {

        window.location = '/user/orders/view/id/'+id.id;
    }
    
    function countJson(obj) {
        var prop;
        var propCount = 0;

        for (prop in obj) {
          propCount++;
        }
        return propCount;
    }
    
    function order(action) {
        var a = document.getElementById("inputCurrentOrder").value;
        
         $.ajax({
            url: '/user/orders/orderAction',
            type: 'post',
            dataType: 'html',
            data: 'data='+a+"|"+action,
            async: false,
            success: function(data) {
                var dataS = data.split("|");
                if (dataS[0]==='#ok') {
                    if (action==='approve') {
                        $('#acceptFull').removeClass('bounceInUp');
                        $('#acceptFull').addClass('bounceOutDown');
                        $('#receiptFull').removeClass('bounceOutUp');
                        $("#receiptFull").addClass('bounceInDown');
                        $("#receiptFull").show();
                    } else {
                        $('#cancelFull').removeClass('bounceInUp');
                        $('#cancelFull').addClass('bounceOutDown');
                        $('#cancelreceiptFull').removeClass('bounceOutUp');
                        $("#cancelreceiptFull").addClass('bounceInDown');
                        $("#cancelreceiptFull").show();
                    }
//                    window.location = '/user/orders/receipt/id/'+dataS[1];
                } else if (dataS[0]==='#error') {
                    if (dataS[1]==='#approved') {
                        $("#orderPrice").attr('style', 'color:green;text-align:center;margin-top:20px;margin-bottom:0px;font-size:60px;font-weight: 900');
                    } else if(dataS[1]==='#rejected') {
                        $("#orderPrice").attr('style', 'color:red;text-decoration:line-through;text-align:center;margin-top:20px;margin-bottom:0px;font-size:60px;font-weight: 900');
                    }
                    $("#orderCode").text(dataS[2]);
                    setTimeout('getBack()', 2400);
                }
            },
            error:function(data){
               alert("Error: "+data);
           } 
        });
    }


    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write('<html><head><link href="/themes/frontend/css/style.css" rel="stylesheet" type="text/css"><title>my div</title>');
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
        mywindow.close();

        return true;
    }
    $('#ssnInp').keydown(function(event) {

        if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 
            || event.keyCode == 27 || event.keyCode == 109 || event.keyCode == 32 || event.keyCode == 189
            || (event.keyCode == 65 && event.ctrlKey === true) 
            || (event.keyCode >= 35 && event.keyCode <= 39)){
                return;
          } else {
            // If it's not a number stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }

    });
</script>
</body>
</html>