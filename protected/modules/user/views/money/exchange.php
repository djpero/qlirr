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
        <div class="sideBarBtn sideBarToolTip" align="center"  onclick="location.href='/user/bills'"><div class="tool-tip slideIn right" style="top:106px;width:147px">Betala räkningar</div>
            <i id="icons8-bill" class="icons8-bill size-28 " ></i>
        </div>
        <div class="sideBarBtn sideBarToolTip active" align="center"  onclick="location.href='/user/money/exchange'" ><div class="tool-tip slideIn right" style="width:136px;top:179px">Växla valuta </div>
            <i id="icons8-money_exchange" class="icons8-money_exchange size-28 active" ></i>
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
                    <p class="title">Växla valuta </p>

                </div>   
            </div>
        
            <!-------------       HERE TIMELINE             ------------->
                     
               <div class="formBorrow" style="display: block">
                <div class="bPage1">
<!--                    <div class="col-sm-4 col-sm-offset-4" align="center">
                        <div class="inputBox form-group ">
                            <input id="inpMobile" placeholder="Ditt mobilenummer" type="tel" class="form-control" style="text-align:center"/>
                        </div>
                        <div class="inputBox form-group">
                            <input id="inpPin" placeholder="Fyll i din pinkod" type="tel" class="form-control" style="text-align:center"/>

                        </div>
                        <button id="btnCheckLogin" onclick="checkLogin();" class="btn btn-login" data-value="0">Send PIN</button>
                    </div>
                    <div class="loaderForm" style="display: none;">
                        <div class="loader"></div>
                    </div>-->

                    <!--                <div id="tool_tip_div" class="tool-tip slideIn bottom" >Växla valuta </div>-->


                    <!------------------------------------------------------------------------------------->
                    <!------------------   HERE IS GOING MAIN FORM FOR BANK OFFER SUBMIT ------------------>
                    <!------------------------------------------------------------------------------------->
                    <div id="dTimeLine" class="timeline">
                        <div class="progress"></div>
                    </div>
                    <div class="mainForm col-sm-10 col-sm-offset-1" hidden>
                        
                        <p id="gpos0" class="title">Välj valuta</p>
                        
                        <div id="dPos0" class="row no-margin group active">
                            <div class="circlePin"  id="cir1"><div class="pin">1/4</div></div>
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="0" data-val="EUR" data-sign="€">
                                    <p class=" ">Euro (EUR)</p>
                                    <img src="/themes/frontend/gfx/flags-mini/EU.png" data-value="ba"  alt="" />
                                </div> 
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="0" data-val="CHF" data-sign="fr">
                                    <p class="">Swiss Franc (CHF)</p>
                                    <img src="/themes/frontend/gfx/flags-mini/CH.png" data-value="cro"  alt="" />
                                </div> 
                            </div>  
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="0" data-val="GBP"  data-sign="£">
                                    <p class="">British pound (GBP)</p>
                                    <img src="/themes/frontend/gfx/flags-mini/GB.png" data-value="ser"  alt="" />
                                </div> 
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="0" data-val="USD"  data-sign="$">
                                    <p class="">US Dollar (USD)</p>
                                    <img src="/themes/frontend/gfx/flags-mini/US.png" data-value="slo"  alt="" />
                                </div>  
                            </div>  
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="0" data-val="SEK"  data-sign="kr">
                                    <p class="">Swedish Krona (SEK)</p>
                                    <img src="/themes/frontend/gfx/flags-mini/SE.png" data-value="swe"  alt="" />
                                </div>  
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box country" data-pos="0" style="text-overflow: ellipsis;white-space: nowrap;overflow:hidden">
                                    <p class="" >Övrigt</p>
                                    <img id="imgCountry" src="/themes/frontend/gfx/medium_priority-50.png" data-value="medium_priority-50"  alt="" />    
                                </div>  
                            </div>  
                        </div>
                        <p id="gpos1" class="title">Jag vill växla SEK</p>
                        <div id="dPos1" class="row no-margin group">
                            <div class="circlePin" id="cir2"><div class="pin"></div></div>
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="1" data-val="500">
                                    <p class="middle">500</p>

                                </div> 
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="1" data-val="1000">
                                    <p class="middle">1 000</p>
                                    
                                </div> 
                            </div>  
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="1" data-val="2000">
                                    <p class="middle">2 000</p>

                                </div> 
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="1" data-val="3000">
                                    <p class="middle">3 000</p>
                                  
                                </div>  
                            </div>  
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="1" data-val="5000">
                                    <p class="middle">5 000</p>
                                    
                                </div>  
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box popup" data-pos="1">
                                    <p id="getConvRes" class="middle">Övrigt</p>
                                        
                                </div>  
                            </div> 
                        </div>
                                               
                        <p id="gpos2" class="title">Jag vill köpa</p>
                        <div id="dPos2" class="inputBox2 form-group group" >
                            <div class="circlePin" id="cir3"><div class="pin"></div></div>
                             <input id="inpResult" type="text" class="form-control" disabled data-pos="2" maxlength="8"/> 
                             <div id="resultSign"></div>
                        </div>
                        <p id="gpos3" class="title" >SSN</p>
                        <div id="dPos3" class="inputBox2 form-group group">
                           <div class="circlePin" id="cir4"><div class="pin"></div></div>
                           <input id="inpRSurName" type="text" class="form-control" disabled data-pos="3" /> 
                        </div>
                        <p id="gpos4" class="title" >Mobilnummer</p>
                        <div id="dPos4" class="inputBox2 form-group group">
                           <div class="circlePin" id="cir5"><div class="pin"></div></div>
                           <input id="inpRMobile" type="text" class="form-control" disabled data-pos="4" /> 
                        </div>
                        <p id="gpos5" class="title active" style="display:none">Avsändarens pinkod</p>
                        <div id="dPos5" class="inputBox2 form-group group active" hidden>
                           <div class="circlePin" id="cir6"><div class="pin"></div></div>
                           <input id="inpRPin" type="text" class="form-control" data-pos="5" /> 
                        </div>
                        
                       
                        <button id="gpos15" onclick="sendBank();" class="btn btn-login" style="width:30%;margin-top:50px;margin-bottom: 50px" data-value="pin" disabled>Skicka PIN</button>
                        <div style="height:400px;width:1px;">&nbsp;</div> 
                    </div>
<!--                    <div id="receivingmoney" hidden>
                        <p id="gpos1" class="title">Skriv personnummer</p>
                        <div id="dPos1" class="inputBox2 form-group group" >
                            <div class="circlePin" id="cir2"><div class="pin"></div></div>
                             <input id="inpSSNR" type="text" class="form-control" disabled data-pos="1" /> 
    
                        </div>
                        <p id="gpos2" class="title" >Skriv transaktionnummer</p>
                        <div id="dPos2" class="inputBox2 form-group group">
                           <div class="circlePin" id="cir3"><div class="pin"></div></div>
                           <input id="inpTransaction" type="text" class="form-control" disabled data-pos="2" /> 
                        </div>
                        <button id="gpos15" onclick="confirmTrans();" class="btn btn-login" style="width:30%;margin-top:50px;margin-bottom: 50px" data-value="pin" disabled>Confirm</button>
                        <div style="height:400px;width:1px;">&nbsp;</div> 
                    </div>-->

                    <!------------------------------------------------------------------------------------->
                    <!------------------------------------------------------------------------------------->
                    <!------------------------------------------------------------------------------------->

                    </div>
                </div>
            </div>       
                     
                     
                     
                     
            <!-------------       HERE TIMELINE             ------------->
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
    <div id="country" hidden align="center" class="animated bounceInUp">
        <i class="icons8-cancel size-28 "  onclick="closeCountry()"></i>
        <div id="msg">
            <p id="title">Country List</p>
            <!--<p id="receipttitleDesc">var1</p>-->
            <input id="countryInp" type="text" class="popup" placeholder="" />
            <div id="searchResults" class="countryResult"> </div> 
            <button id="otherBTN" class="btn btn-accept" onclick="closesaveCountry()">Skicka</button>
        </div>
    </div>
    <div id="other" hidden align="center" class="animated bounceInUp">
        <i class="icons8-cancel size-28 "  onclick="closeOther()"></i>
        <div id="msg">
            <p id="title">var</p>
            <!--<p id="receipttitleDesc">var1</p>-->
            <input id="otherInp" type="text" class="popup" placeholder="" maxlength="8" />
            <button id="otherBTN" class="btn btn-accept" onclick="closeSaveOther()">Skicka</button>
        </div>
    </div>
    <div id="tnxPage" hidden align="center" class="animated bounceInUp">
        <i class="icons8-cancel size-28 "  onclick="closesavetnx()"></i>
        <div id="msg" >
            <p id="title" style="margin-bottom:8px">Växla valuta</p>
            <p style="margin-bottom: 40px;color:rgba(255,255,255,0.5)">Är du säker på att du vill genomföra följande transaktion?</p>

            <button id="otherBTN" class="btn btn-accept" onclick="closesavetnx()">Berkrafta</button>
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
                    <div class="menu-item" onclick="location.href='/user/bills'">
                        <i id="icons8-bill" class="icons8-bill size-28" ></i>
                        <p>BETALA RÄKNINGAR</p>
                    </div>
                    
                </div>
  
           
                <div class="col-xs-6 border-right no-menuline" align="center">
                    <div class="menu-item" onclick="showPopMenu(0)">
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
    <input id="inpTempcPos" hidden val="0" />
    <input id="curr" hidden val="0" />
    <input id="currA" hidden val="0" />
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="/themes/frontend/js/bootstrap.min.js"></script>
    <script src="/js/jquery.easing.1.3.js" type="text/javascript"></script>
    <script src="/themes/frontend/js/application.js"></script>

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
    function closesavetnx() {
       $('#tnxPage').removeClass('bounceInUp'); 
       $('#tnxPage').addClass('bounceOutDown');        
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
        if( isMobile.any() ) {
            if (dir===1) {
                $("#pop-menu").removeClass('bounceOutLeft');
                $("#pop-menu").addClass('bounceInLeft');
                $("#pop-menu").show();
            } else {
                $("#pop-menu").removeClass('bounceInLeft');
                $("#pop-menu").addClass('bounceOutLeft');
            }
            
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
        $('.mainForm').fadeIn(300, function () {
            $('.box').fadeIn(500);
            boxResize();

            boxImageResize();
            pin1();
            $(document).scrollTop(0);
        }); 
     });    
     
                    
                    $(document).on('click', '.active .box', function(e) {
                        
                        
                        if ($(this).attr('data-pos')=="0") {
                            $('#curr').val($(this).attr('data-val'));
                            if ($(this).not('.country')) {
                                $('#curr').attr('data-sign', $(this).attr('data-sign'));
                            }
 
                        } else if($(this).attr('data-pos')=="1") {
                            $('#currA').val($(this).attr('data-val'));
                            
                            var a = $('#currA').val();
                            var b = $('#curr').val();
                            var c = $('#curr').attr('data-sign');
                            if ($(this).hasClass('popup')) {
                               
                            } else {
                                getConvert(a,b,c);
                            }
                            
                        }
                        var body = $("html, body");
                        $(this).closest('.active').children().children().removeClass('selected');
                        $(this).addClass('selected');
                        var cPos = parseInt($(this).attr('data-pos'))+1;
                        var nPos = $('#gpos'+cPos).offset().top; 
                        var a = $(this).children('p').css('font-size');
                        var b = parseInt(a.replace('px', ''));
                        var c = $(this).children('p').css('top');
                        var d = parseInt(c.replace('px', ''));
                       $('[id=gpos'+cPos+']').addClass('active');
                       $('[id=dPos'+cPos+']').addClass('active');
                       $('.circlePin').removeClass('active');
                       $('#cir'+(cPos+1)).addClass('active');
                       if ($('#dPos'+cPos+' input').length) {
                            $('#dPos'+cPos+' input').removeAttr('disabled').focus();
                       }
                       
                       $('.active .box:not(.selected)').each(function(index,el) {
                          if($(el).attr('data-sel')=='1') {
                                var e = $(el).children('img').css('top');
                                var f = parseInt(e.replace('px', ''));
                                $(el).children('img').attr('src', '/themes/frontend/gfx/'+$(el).children('img').attr('data-value')+'.png');
                                $(el).children('p').css('font-size', (b - 3) + 'px');
                                $(el).children('p').css('top', (d + 10) + 'px');
                                $(el).children('img').css('top', (f + 10) + 'px'); 
                          } 
                       });
                       $('.active .box').attr('data-sel', "0");
                       $(this).attr('data-sel', "1");
        

                       if (cPos===2) {
                           if ($(this).hasClass('popup')){
                                
                           } else {
//                               alert('here');
                                $('[id=gpos3]').addClass('active');
                                $('[id=dPos3]').addClass('active');
                                if ($('#dPos'+(cPos)+' input').length) {
                                   $('#dPos'+(cPos)+' input').removeAttr('disabled').focus();
                                }

                                $('.circlePin').removeClass('active');
                                $('#cir'+(cPos+1)).addClass('active');
                           }
                           
                        }
                       if (cPos===14) {
                           $('#gpos15').removeAttr('disabled');
                       } else {
                           if ($(this).hasClass('popup')) {
                                showOther(cPos);
                                
                            } else if($(this).hasClass('country')) {
      
                                showCountry(cPos);
                            } else if($(this).hasClass('person')) {
                                showPerson(cPos);
                            } else if($(this).hasClass('receive')) {
                                $('#sendingmoney').empty();
                                $('#receivingmoney').fadeIn(200);
                                pin2();
                                var a = $('.box').height();
                                var e = $('.box').first().offset().top;
                                var f = parseInt($('#dPos2').offset().top) + parseInt($('#dPos2').height()/2);
                                $('#dTimeLine').css('top', (e+(a/2))+'px');
                                $('#dTimeLine').css('height', f - (e+(a/2))+10+cPos+'px');
                                $('#inpSSNR').focus();
                                body.animate({scrollTop:nPos-73}, 800, 'easeInOutCirc');
                            } else {
                                body.animate({scrollTop:nPos-73}, 800, 'easeInOutCirc');
                                //$('.timeline .progress').height($("#cir"+cPos).position().top+($(this).height()/2)+10);
                                var a = $('.box').height();
                                var e = $('.box').first().offset().top;
                                var f = parseInt($('#dPos4').offset().top) + parseInt($('#dPos4').height()/2);
                                $('#dTimeLine').css('top', (e+(a/2))+'px');
                                $('#dTimeLine').css('height', f - (e+(a/2))+10+cPos+'px');
                                
                            }
                            pin2();
                       }
                       
                       //----------------------------------------------
                       
                    });
     
     $('#inpRSurName').focusout(function() {
        var body = $("html, body");
        var cPos = parseInt($(this).attr('data-pos'))+1;
        var nPos = $('#gpos'+cPos).offset().top; 
        $('#gpos'+cPos).addClass('active');
        $('#dPos'+cPos).addClass('active');
        $('.circlePin').removeClass('active');
        $('#cir'+(cPos+1)).addClass('active');
        $('#dPos'+cPos+' input').removeAttr('disabled').focus();
        body.animate({scrollTop:nPos-73}, 800, 'easeInOutCirc');

     });
     $('#inpRSurName').keypress(function(e) {
         if(e.which == 13) {
             if ($(this).val().length > 0){
                 var body = $("html, body");
                 var cPos = parseInt($(this).attr('data-pos'))+1;
                 var nPos = $('#gpos'+cPos).offset().top; 
                 $('#gpos'+cPos).addClass('active');
                 $('#dPos'+cPos).addClass('active');
                 $('.circlePin').removeClass('active');
                 $('#cir'+(cPos+1)).addClass('active');
                 $('#dPos'+cPos+' input').removeAttr('disabled').focus();
                 body.animate({scrollTop:nPos-73}, 800, 'easeInOutCirc'); 
             }

         }
     });
     $('#inpResult').focusout(function() {
        var body = $("html, body");
        var cPos = parseInt($(this).attr('data-pos'))+1;
        var nPos = $('#gpos'+cPos).offset().top; 
        $('#gpos'+cPos).addClass('active');
        $('#dPos'+cPos).addClass('active');
        $('.circlePin').removeClass('active');
        $('#cir'+(cPos+1)).addClass('active');
        $('#dPos'+cPos+' input').removeAttr('disabled').focus();
        body.animate({scrollTop:nPos-73}, 800, 'easeInOutCirc');

     });
     $('#inpResult').keypress(function(e) {
         if(e.which == 13) {
             if ($(this).val().length > 0){
                 var body = $("html, body");
                 var cPos = parseInt($(this).attr('data-pos'))+1;
                 var nPos = $('#gpos'+cPos).offset().top; 
                 $('#gpos'+cPos).addClass('active');
                 $('#dPos'+cPos).addClass('active');
                 $('.circlePin').removeClass('active');
                 $('#cir'+(cPos+1)).addClass('active');
                 $('#dPos'+cPos+' input').removeAttr('disabled').focus();
                 body.animate({scrollTop:nPos-73}, 800, 'easeInOutCirc'); 
             }
            
         }
     });
     
     $("#inpResult").keyup(function(e) {
            var a = $('#currA').val();
            var b = $('#curr').val();
            var c = $('#curr').attr('data-sign');
            getConvert2($(this).val(),b,c);      
     });
     $('#inpRMobile').focus(function() {
            $('#gpos15').removeAttr('disabled');

      });
     function pin2(){
        $('#cir1 .pin').html('1/6');
        $('#cir2 .pin').html('2/6');
        $('#cir3 .pin').html('3/6');
        $('#cir4 .pin').html('4/6');
        $('#cir5 .pin').html('5/6');
        $('#cir6 .pin').html('6/6');
    }
    function pin1() {
        $('#cir1 .pin').html('1/6');
        $('#cir2 .pin').html('2/6');
        $('#cir3 .pin').html('3/6');
        $('#cir4 .pin').html('4/6');
        $('#cir5 .pin').html('5/6');
        $('#cir6 .pin').html('6/6');
    }
    function showOther(cPos) {
                        
        $('#other p').html($('#gpos'+(cPos-1)).html());
        $('#other').removeClass('bounceOutDown');
        $('#other').addClass('bounceInUp');
        $('#other').show();
        $('#inpTempcPos').val(cPos);
    }
     function showCountry(cPos) {
                        
        $('#country p').html($('#gpos'+(cPos-1)).html());
        $('#country').removeClass('bounceOutDown');
        $('#country').addClass('bounceInUp');
        $('#country').show();
        $('#inpTempcPos').val(cPos);
    }
    function closeCountry() {
        $('#country').removeClass('bounceInUp');
        $('#country').addClass('bounceOutDown');

    }
    function closeSaveOther() {
        if ($('#otherInp').val().length > 0) {
            $('#other').removeClass('bounceInUp');
            $('#other').addClass('bounceOutDown');
            var body = $("html, body");
            var cPos = $('#inpTempcPos').val();
            var nPos = $('#gpos'+cPos).offset().top; 
            var inpVal = $('#otherInp').val();
            $('#currA').val(inpVal);
            
            $('#dPos'+(cPos-1)+' .box.popup p').html(addCommas(inpVal));
            var a = $('#currA').val();
            var b = $('#curr').val();
            var c = $('#curr').attr('data-sign');
            getConvert(a,b,c);
            
            $('#otherInp').val('');
            body.delay(1000).animate({scrollTop:nPos-73}, 800, 'easeInOutCirc');
            //$('.timeline .progress').height($("#cir"+cPos).position().top+($(this).height()/2)+10);
            var a = $('.box').height();
            var e = $('.box').first().offset().top;
            var f = parseInt($('#dPos14').offset().top) + parseInt($('#dPos14').height()/2);
            $('#dTimeLine').css('top', (e+(a/2))+'px');
            $('#dTimeLine').css('height', f - (e+(a/2))+10+'px');
       
        } else {
            $('#otherInp').addClass('error');
        }
    }
    function addCommas(nStr)
    {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ' ' + '$2');
            }
            return x1 + x2;
    }
    // --------------------------- Countries search -----------------
        var executeSearch;
        function searchTransactions() {
         var a = document.getElementById('countryInp').value;    
    
         
            $.ajax({
                url: '/user/orders/getCountryListValute', 
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
        $('#countryInp').on('keyup', function(e) {
            clearTimeout(executeSearch);

            if ($(this).val()!=='') {
                if(e.which !== 13) {
                    executeSearch = setTimeout(function(){searchTransactions()}, 400);  // ------->>>> tek kad se smisli onda izbaci rezultat
                }
            } else {
                $("#searchResults").empty();
            }
        });
    $(document).on('click', '.searchItem', function(){
        var a = $(this).attr('data-content'); 
        var b = $(this).attr('data-img'); 
        var c = $(this).attr('data-valute'); 
        var d = $(this).attr('data-sign'); 
        $('#countryInp').val(a);
        $('#countryInp').attr('data-val',b);
        $('#countryInp').attr('data-valute', c);
        $('#countryInp').attr('data-sign', d);
        
        $("#searchResults").empty();
    });
    
    function closesaveCountry() {
        if ($('#countryInp').val().length > 0) {
             $('#country').removeClass('bounceInUp');
             $('#country').addClass('bounceOutDown');
             var body = $("html, body");
             var cPos = $('#inpTempcPos').val();
             var nPos = $('#gpos'+cPos).offset().top; 
             var inpVal = $('#countryInp').val();
             
             var dataImg = $('#countryInp').attr('data-val');
             $('#dPos'+(cPos-1)+' .box.country p').html(shorten(inpVal,16));
             $('#dPos'+(cPos-1)+' .box.country').attr('data-val', $('#countryInp').attr('data-valute'));
             $('#dPos'+(cPos-1)+' .box.country').attr('data-sign', $('#countryInp').attr('data-sign'));
             $('#curr').val($('#countryInp').attr('data-valute'));
             $('#curr').attr('data-sign', $('#countryInp').attr('data-sign'))
             $('#imgCountry').attr('src', '/themes/frontend/gfx/flags-mini/'+dataImg+'.png');
             $('#countryInp').val('');
             body.delay(1000).animate({scrollTop:nPos-73}, 800, 'easeInOutCirc');
             //$('.timeline .progress').height($("#cir"+cPos).position().top+($(this).height()/2)+10);
             var a = $('.box').height();
             var e = $('.box').first().offset().top;
             var f = parseInt($('#dPos4').offset().top) + parseInt($('#dPos4').height()/2);
             $('#dTimeLine').css('top', (e+(a/2))+'px');
             $('#dTimeLine').css('height', f - (e+(a/2))+10+'px');
         } else {
             $('#countryInp').addClass('error');
         } 
     }
     
    
     function shorten(text, maxLength) {
        var ret = text;
        if (ret.length > maxLength) {
            ret = ret.substr(0,maxLength-3) + "...";
        }
        return ret;
    }
    function boxResize() {
        var a = $('.box').width();
        $('.box').height(a - 10);
        $('#cir1').addClass('active');
    }
    function boxImageResize() {
        var b = $('.box img').width();
        var a = $('.box').height();
        var c = $('.box img').height();
        var d = $('.box p').height();
        var e = $('.box').first().offset().top;
        var f = parseInt($('#dPos4').offset().top) + parseInt($('#dPos4').height()/2);
        $('.box img').css('left', 'calc(50% - ' + b / 2 + 'px)');
        $('.box img').css('top', (a / 2) - (c + 6) + 'px');
        $('.box p').css('top', (a - (d + 6)) + 'px');
        $('.box p.middle').css('top', (a/2 - (d - 6)) + 'px');
        $('.box p').css('font-size', a / 10);
        $('.box p.middle').css('font-size', a / 6);
        $('.box p.middle.small').css('font-size', a / 10);
        //------------------------------------------------------

        $('#dTimeLine').css('top', (e+(a/2))+'px');
        $('#dTimeLine').css('height', f - (e+(a/2))+10+'px');
        $('#dTimeLine').fadeIn(500, function() {


        });
    }
    function sendBank() {
        var x = $('#gpos15').attr('data-value');
        if (x==='pin') {
            $('#gpos15').attr('data-value', 'send');
            $('#gpos15').html('Skicka pengar');
            $('#dPos5').fadeIn(200);
            $('#gpos5').fadeIn(200);
                var a = $('.box').height();
                var e = $('.box').first().offset().top;
                var f = parseInt($('#dPos5').offset().top) + parseInt($('#dPos5').height()/2);
                $('#dTimeLine').css('top', (e+(a/2))+'px');
                $('#dTimeLine').css('height', f - (e+(a/2))+10+'px');
                $('.circlePin').removeClass('active');
                $('#cir6').addClass('active');
                $('#inpRPin').focus();
        } else {
            showtnxPage();
        }
    }
    
    function showtnxPage() {

        $('#tnxPage').removeClass('bounceOutDown');
        $('#tnxPage').addClass('bounceInUp');
        $('#tnxPage').show();

    }


    function getConvert(num, valute, sign) {
        var api_site = "http://www.freecurrencyconverterapi.com/api/v3/convert?q=SEK_";
        var ender    = "&compact=y";

        $.ajax({
                url: api_site+valute+ender, 
                type: 'post',
                dataType: 'jsonp',
                async: false,
                success: function(data) {
                   var result = (num * data['SEK_'+valute].val);
                   showResultConvert("inpResult", result, sign);
                 
                },
                error:function(data){
                 //  alert("Error: "+data);
               } 
            });
        
    }
    
    function getConvert2(num, valute, sign) {
        var api_site = "http://www.freecurrencyconverterapi.com/api/v3/convert?q=";
        var ender    = "_SEK&compact=y";

        $.ajax({
                url: api_site+valute+ender, 
                type: 'post',
                dataType: 'jsonp',
                async: false,
                success: function(data) {
                   var result = (num * data[valute+'_SEK'].val);
                   showResultConvert2("getConvRes", result, sign);
                 
                },
                error:function(data){
                 //  alert("Error: "+data);
               } 
            });
        
    }
    function showResultConvert(where, what, sign) {
        
        $("#"+where).val(what.toFixed(2)).focus();
        $('#resultSign').html(sign);
        
    }
    function showResultConvert2(where, what, sign) {
        
        $("#"+where).html('SEK '+what.toFixed(2)).focus();
        
        
    }
    
    
</script>
</body>
</html>