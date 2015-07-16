<?php
$shopId = Yii::app()->session['userIDm'];
$myPass = Yii::app()->session['userIDp'];
$shop = ShopsDao::getShopById($shopId);
$orders = OrdersDao::getOrdersByShopId($shop->id);
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
        <input id="myPass" hidden value="<?php echo $myPass; ?>" />
        <input id="inputUser" hidden value="<?php echo $shop->shop_id; ?>" />
        <input id="inputCurrentOrder" hidden value="" />
        <section id="header">
            <div class=" col-xs-3 header1" style="padding-left:0px" >
                <div id="headerLogo" style="float:left">
                    <img onclick="showPopMenu(1)" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/gfx/login_logo.png" width="73" height="73"/>
                </div>
                <div class="butik" style="float:left;margin-left:15px;" >
                    <p id="name"><?php echo $shop->name ?></p>
                    <p id="cid"><?php echo $shop->shop_id ?></p>
                    <p id="pcountOrdersMobile" onclick="location.href = '/user/orders'">Du har <span id="countOrders"><?php echo count($orders); ?></span> nya transaktioner. </p>
                </div>
            </div>
            <div class=" col-xs-6 header2" align="center">
                <p id="pcountOrders"  onclick="location.href = '/user/orders'">Du har <span id="countOrders"><?php echo count($orders); ?></span> nya transaktioner. </p>
            </div>    
            <div class=" col-xs-3 header3" style="padding-right:0px" align="right">

            </div>  

        </section>
        <section id="sideBar">
            <div class="sideBarBtn" align="center"  onclick="location.href = '/user/orders'"><span class="tool-tip slideIn right" style="width:180px;top:34px">Betala varor / Kontantuttag</span>
                <i id="icons8-cash_register" class="icons8-cash_register size-28"  ></i>
            </div>
            <div class="sideBarBtn sideBarToolTip" align="center"  onclick="location.href = '/user/bills'"><div class="tool-tip slideIn right" style="top:106px;width:147px">Betala räkningar</div>
                <i id="icons8-bill" class="icons8-bill size-28 " ></i>
            </div>
            <div class="sideBarBtn sideBarToolTip" align="center"  onclick="location.href = '/user/money/exchange'" ><div class="tool-tip slideIn right" style="width:136px;top:179px">Växla valuta </div>
                <i id="icons8-money_exchange" class="icons8-money_exchange size-28 " ></i>
            </div>
            <!--------------------------- NOVE IKONE ---------------------->
            <div class="sideBarBtn sideBarToolTip" align="center"  onclick="location.href = '/user/money/borrow'" ><div class="tool-tip slideIn right" style="width:136px;top:251px">Ansöka om banklån </div>
                <i id="icons8-museum" class="icons8-museum size-28  " ></i>
            </div>
            <div class="sideBarBtn sideBarToolTip active" align="center"  onclick="location.href = '/user/money/send'" ><div class="tool-tip slideIn right" style="width:156px;top:325px">Skicka / Ta emot pengar </div>
                <i id="icons8-data_in_both_directions" class="icons8-data_in_both_directions size-28 active" ></i>
            </div>
            <div class="sideBarBtn sideBarToolTip" align="center"  onclick="location.href = '/user/orders/transactions'" ><div class="tool-tip slideIn right" style="width:136px;top:397px">Transaktionhistorik </div>
                <i id="icons8-clock" class="icons8-clock size-28 " ></i>
            </div>
            <div class="sideBarBtn sideBarToolTip" align="center"  onclick="location.href = '/user/profile/'" ><div class="tool-tip slideIn right" style="width:136px;top:470px">Företagsprofil </div>
                <i id="icons8-info" class="icons8-info size-28 " ></i>
            </div>
            <!--------------------------- NOVE IKONE kraj ---------------------->
            <div class="sideBarBtn sideBarToolTip iconBottom" align="center" onclick="logoutProfile()"><div class="tool-tip slideIn right" style="width:76px;top:30px;" >Logga ut</div>
                <i id="icons8-cancel" class="icons8-exit size-28 " style="margin-right:0px;margin-left:2px;" ></i>
            </div>

        </section>

        <div class="container offsetHeader dashboard">
            <div class="row offsetHeader">
                <div class="column col-sm-8 col-sm-offset-2">
                    <p class="title">Skicka / Ta emot pengar</p>

                </div>
            </div>
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
                        <p id="gpos0" class="title active">Vad vill du göra?</p>
                        <div id="dPos0" class="row no-margin active group">
                            <div class="circlePin" id="cir1"><div class="pin">1/12</div></div>
                            <div class="col-sm-2 no-padding">
                                <div class="box send" data-pos="0" data-sel="0">
                                    <p>Skicka</p>
                                    <img src="/themes/frontend/gfx/send_cash.png" data-value="send_cash"  alt="" />
                                </div> 
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box receive" data-pos="0" data-sel="0">
                                    <p>Ta emot</p>
                                    <img src="/themes/frontend/gfx/cash_receiving-50.png" data-value="cash_receiving-50"  alt="" />
                                </div> 
                            </div>  

                        </div>
                        <div id="sendingmoney">
                        <p id="gpos1" class="title">Skriv avsändarens personnummer</p>
                        <div id="dPos1" class="inputBox2 form-group group">
                            <div class="circlePin" id="cir2"><div class="pin"></div></div>
                            <input id="inpSSN" type="text" class="form-control" disabled data-pos="1" /> 
                        </div>
                        <p id="gpos2" class="title">Till vilket land vill du skicka?</p>
                        
                        <div id="dPos2" class="row no-margin group">
                            <div class="circlePin"  id="cir3"><div class="pin"></div></div>
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="2">
                                    <p class=" ">Bosnia</p>
                                    <img src="/themes/frontend/gfx/ba.png" data-value="ba"  alt="" />
                                </div> 
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="2">
                                    <p class="">Croatia</p>
                                    <img src="/themes/frontend/gfx/cro.png" data-value="cro"  alt="" />
                                </div> 
                            </div>  
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="2">
                                    <p class="">Serbia</p>
                                    <img src="/themes/frontend/gfx/ser.png" data-value="ser"  alt="" />
                                </div> 
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="2">
                                    <p class="">Slovenia</p>
                                    <img src="/themes/frontend/gfx/slo.png" data-value="slo"  alt="" />
                                </div>  
                            </div>  
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="2">
                                    <p class="">Sweden</p>
                                    <img src="/themes/frontend/gfx/swe.png" data-value="swe"  alt="" />
                                </div>  
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box country" data-pos="2" style="text-overflow: ellipsis;white-space: nowrap;overflow:hidden">
                                    <p class="" >Övrigt</p>
                                    <img id="imgCountry" src="/themes/frontend/gfx/medium_priority-50.png" data-value="medium_priority-50"  alt="" />    
                                </div>  
                            </div>  
                        </div>
                        <p id="gpos3" class="title">Vilket belopp vill du skicka?</p>
                        <div id="dPos3" class="row no-margin group">
                            <div class="circlePin" id="cir4"><div class="pin"></div></div>
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="3">
                                    <p class="middle">500</p>

                                </div> 
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="3">
                                    <p class="middle">1 000</p>
                                    
                                </div> 
                            </div>  
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="3">
                                    <p class="middle">2 000</p>

                                </div> 
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="3">
                                    <p class="middle">3 000</p>
                                  
                                </div>  
                            </div>  
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="3">
                                    <p class="middle">5 000</p>
                                    
                                </div>  
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box popup" data-pos="3">
                                    <p class="middle">Övrigt</p>
                                        
                                </div>  
                            </div> 
                        </div>
                        
                        <p id="gpos4" class="title">Har du skickat till denna mottagare tidigare?</p>
                        <div id="dPos4" class="row no-margin group">
                            <div class="circlePin" id="cir5"><div class="pin"></div></div>
                            <div class="col-sm-2 no-padding">
                                <div class="box person" data-pos="4">
                                    <p class="middle">Ja</p>

                                </div> 
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="4">
                                    <p class="middle">No</p>
                                    
                                </div> 
                            </div>  
  
                        </div>
                        
                        <p id="gpos5" class="title">Mottagarens förnamn</p>
                        <div id="dPos5" class="inputBox2 form-group group" >
                            <div class="circlePin" id="cir6"><div class="pin"></div></div>
                             <input id="inpRName" type="text" class="form-control" disabled data-pos="5" /> 
    
                        </div>
                        <p id="gpos6" class="title" >Mottagarens efternamn</p>
                        <div id="dPos6" class="inputBox2 form-group group">
                           <div class="circlePin" id="cir7"><div class="pin"></div></div>
                           <input id="inpRSurName" type="text" class="form-control" disabled data-pos="6" /> 
                        </div>
                        <p id="gpos7" class="title" >Avsändarens mobilnummer</p>
                        <div id="dPos7" class="inputBox2 form-group group">
                           <div class="circlePin" id="cir8"><div class="pin"></div></div>
                           <input id="inpRMobile" type="text" class="form-control" disabled data-pos="7" /> 
                        </div>
                        <p id="gpos8" class="title active" style="display:none">Avsändarens pinkod</p>
                        <div id="dPos8" class="inputBox2 form-group group active" hidden>
                           <div class="circlePin" id="cir9"><div class="pin"></div></div>
                           <input id="inpRPin" type="text" class="form-control" data-pos="8" /> 
                        </div>
                        
                       
                        <button id="gpos15" onclick="sendBank();" class="btn btn-login" style="width:30%;margin-top:50px;margin-bottom: 50px" data-value="pin" disabled>Skicka PIN</button>
                        <div style="height:400px;width:1px;">&nbsp;</div> 
                    </div>
                    <div id="receivingmoney" hidden>
                        <p id="gpos9" class="title">Skriv transaktionnummer</p>
                        <div id="dPos9" class="inputBox2 form-group group" >
                            <div class="circlePin" id="cir10"><div class="pin"></div></div>
                             <input id="inpSSNR" type="text" class="form-control" disabled data-pos="9" /> 
    
                        </div>
                        <p id="gpos10" class="title" >Skriv personnummer</p>
                        <div id="dPos10" class="inputBox2 form-group group">
                           <div class="circlePin" id="cir11"><div class="pin"></div></div>
                           <input id="inpTransaction" type="text" class="form-control" disabled data-pos="10" /> 
                        </div>
                        <button id="gpos14" onclick="confirmTrans();" class="btn btn-login" style="width:30%;margin-top:50px;margin-bottom: 50px" data-value="pin" disabled>Confirm</button>
                        <div style="height:400px;width:1px;">&nbsp;</div> 
                    </div>

                    <!------------------------------------------------------------------------------------->
                    <!------------------------------------------------------------------------------------->
                    <!------------------------------------------------------------------------------------->

                    </div>
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
        <div id="other" hidden align="center" class="animated bounceInUp">
            <i class="icons8-cancel size-28 "  onclick="closeOther()"></i>
            <div id="msg">
                <p id="title">var</p>
                <!--<p id="receipttitleDesc">var1</p>-->
                <input id="otherInp" type="text" class="popup" placeholder="" maxlength="8" />
                <button id="otherBTN" class="btn btn-accept" onclick="closeSaveOther()">Skicka</button>
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
        <div id="person" hidden align="center" class="animated bounceInUp">
            <i class="icons8-cancel size-28 "  onclick="closePerson()"></i>
            <div id="msg">
                <p id="title">Person List</p>
                <!--<p id="receipttitleDesc">var1</p>-->
                <!--<input id="personInp" type="text" class="popup" placeholder="Oste Popovic" disabled value="Oste Popovic"/>-->
                <p class="personChoose" onclick="closesavePerson()">Oste Popovic</p>
                <!--<button id="otherBTN" class="btn btn-accept" onclick="closesavePerson()">Skicka</button>-->
            </div>
        </div>
        <div id="tnxPage" hidden align="center" class="animated bounceInUp">
            <i class="icons8-cancel size-28 "  onclick="closetnxPage()"></i>
            <div id="msg" >
                <p id="title" style="margin-bottom:8px">Skicka pengar</p>
                <p style="margin-bottom: 40px;color:rgba(255,255,255,0.5)"> Är du säker på att du vill genomföra följande transaktion?</p>

                <button id="otherBTN" class="btn btn-accept" onclick="location.reload()">Berkrafta</button>
            </div>
        </div>
        <div id="pop-menu" hidden class="animated2 bounceInLeft">
            <img src="/themes/frontend/gfx/login_logo.png" />
            <h1>QLIRR.</h1>
            <h1>FRAMTIDENS BANK.</h1>
            <div class="menu">

                <div class="col-xs-6 border-right" align="center">
                    <div class="menu-item" onclick="location.href = '/user/orders'">
                        <div class="countIcon" id="countOrders-Icon" hidden>0</div>
                        <i id="icons8-cash_register" class="icons8-cash_register size-28"></i>
                        <p>LÅNA PENGAR</p>
                    </div>
                </div>
                <div class="col-xs-6 border-right-no menuline" align="center">
                    <div class="menu-item" onclick="location.href = '/user/bills'">
                        <i id="icons8-bill" class="icons8-bill size-28" ></i>
                        <p>BETALA RÄKNINGAR</p>
                    </div>

                </div>

                <div class="col-xs-6 border-right no-menuline" align="center">
                    <div class="menu-item" onclick="location.href = '/user/money/exchange'">
                        <i id="icons8-money_exchange" class="icons8-money_exchange size-28"></i>
                        <p>VÄXLA VALUTA</p>
                    </div>
                </div>
                <div class="col-xs-6 border-right-no menuline" align="center">
                    <div class="menu-item" onclick="showPopMenu(0)">
                        <i id="icons8-museum" class="icons8-museum size-28" ></i>
                        <p>ANSÖK OM BANKLÅN</p>
                    </div>

                </div>

                <div class="col-xs-6 border-right" align="center">
                    <div class="menu-item" onclick="location.href = '/user/money/send'">
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
        <input id="inpTempcPos" hidden val="0" />
        <input id="maxPos" hidden val="10" />
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
        <script src="/js/jquery.easing.1.3.js" type="text/javascript"></script>

        <script src="/themes/frontend/js/application.js"></script>

        <script>
                    setInterval('refreshList()', 2000);
                    var isMobile = {
                        Android: function () {
                            return navigator.userAgent.match(/Android/i);
                        },
                        BlackBerry: function () {
                            return navigator.userAgent.match(/BlackBerry/i);
                        },
                        iOS: function () {
                            return navigator.userAgent.match(/iPhone|iPod/i);
                        },
                        Opera: function () {
                            return navigator.userAgent.match(/Opera Mini/i);
                        },
                        Windows: function () {
                            return navigator.userAgent.match(/IEMobile/i);
                        },
                        any: function () {
                            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
                        }
                    };

                    if (isMobile.any()) {
                        $("#sideBar").hide();
                    }

                    function searchBtn() {
                        var a = $('#searchBtn').attr('dataio');
                        if (a === "0") {
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
                    function showOther(cPos) {
                        
                        $('#other p').html($('#gpos'+(cPos-1)).html());
                        $('#other').removeClass('bounceOutDown');
                        $('#other').addClass('bounceInUp');
                        $('#other').show();
                        $('#inpTempcPos').val(cPos);
                    }
                    function showPerson(cPos) {
                        
                        $('#person p.title').html($('#gpos'+(cPos-1)).html());
                        $('#person').removeClass('bounceOutDown');
                        $('#person').addClass('bounceInUp');
                        $('#person').show();
                        $('#inpTempcPos').val(cPos);
                    }
                    function showCountry(cPos) {
                        
                        $('#country p').html($('#gpos'+(cPos-1)).html());
                        $('#country').removeClass('bounceOutDown');
                        $('#country').addClass('bounceInUp');
                        $('#country').show();
                        $('#inpTempcPos').val(cPos);
                    }
                    function closeTraining() {
                        $('#training').removeClass('bounceInUp');
                        $('#training').addClass('bounceOutDown');

                    }
                    function closeContact() {
                        $('#contact').removeClass('bounceInUp');
                        $('#contact').addClass('bounceOutDown');

                    }
                    function closeOther() {
                        $('#other').removeClass('bounceInUp');
                        $('#other').addClass('bounceOutDown');

                    }
                    function closetnxPage() {
                        $('#tnxPage').removeClass('bounceInUp');
                        $('#tnxPage').addClass('bounceOutDown');

                    }
                    function closeCountry() {
                        $('#country').removeClass('bounceInUp');
                        $('#country').addClass('bounceOutDown');

                    }
                    function closePerson() {
                        $('#person').removeClass('bounceInUp');
                        $('#person').addClass('bounceOutDown');

                    }
                    function closeSaveOther() {
                        if ($('#otherInp').val().length > 0) {
                            $('#other').removeClass('bounceInUp');
                            $('#other').addClass('bounceOutDown');
                            var body = $("html, body");
                            var cPos = $('#inpTempcPos').val();
                            var nPos = $('#gpos'+cPos).offset().top; 
                            var inpVal = $('#otherInp').val();
                            $('#dPos'+(cPos-1)+' .box.popup p').html(addCommas(inpVal));
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
                            $('#imgCountry').attr('src', '/themes/frontend/gfx/flags-mini/'+dataImg+'.png');
                            $('#countryInp').val('');
                            body.delay(1000).animate({scrollTop:nPos-73}, 800, 'easeInOutCirc');
                            //$('.timeline .progress').height($("#cir"+cPos).position().top+($(this).height()/2)+10);
                            var a = $('.box').height();
                            var e = $('.box').first().offset().top;
                            var f = parseInt($('#dPos14').offset().top) + parseInt($('#dPos14').height()/2);
                            $('#dTimeLine').css('top', (e+(a/2))+'px');
                            $('#dTimeLine').css('height', f - (e+(a/2))+10+'px');
                        } else {
                            $('#countryInp').addClass('error');
                        } 
                    }
                     function closesavePerson() {
                       
                            $('#person').removeClass('bounceInUp');
                            $('#person').addClass('bounceOutDown');
                            $('#inpRName').val('Oste');
                            $('#inpRSurName').val('Popovic');
                            $('#inpRMobile').val('0722940514');
                            $('#inpRMobile').removeAttr('disabled').focus();
                            var body = $("html, body");
                            var cPos = $('#inpTempcPos').val();
                            var nPos = $('#gpos'+(cPos+3)).offset().top; 
                            var inpVal = $('#personInp').val();
                            var dataImg = $('#personInp').attr('data-val');
                            //$('#dPos'+(cPos-1)+' .box.person p').html(shorten(inpVal,16));
                            //$('#imgCountry').attr('src', '/themes/frontend/gfx/flags-mini/'+dataImg+'.png');
                            $('#personInp').val('');
                            body.delay(1000).animate({scrollTop:nPos-73}, 800, 'easeInOutCirc');
                            //$('.timeline .progress').height($("#cir"+cPos).position().top+($(this).height()/2)+10);
                            updateTimeLine();
                    }
                    
                    function updateTimeLine() {
                        var a = $('.box').height();
                        var e = $('.box').first().offset().top;
                        var f = parseInt($('#dPos8').offset().top) + parseInt($('#dPos8').height()/2);
                        $('#dTimeLine').css('top', (e+(a/2))+'px');
                        $('#dTimeLine').css('height', f - (e+(a/2))+10+'px');
                          
                    }
                    function shorten(text, maxLength) {
                        var ret = text;
                        if (ret.length > maxLength) {
                            ret = ret.substr(0,maxLength-3) + "...";
                        }
                        return ret;
                    }
                    function confirmTrans() {
                       showtnxPage();
                    }
                    function showtnxPage() {
                        
                        $('#tnxPage').removeClass('bounceOutDown');
                        $('#tnxPage').addClass('bounceInUp');
                        $('#tnxPage').show();
                     
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
                    $('#otherInp').focus(function() {
                       $(this).removeClass('error');
                    });
                    function showContactDiv() {
                        $('#contact').removeClass('bounceOutDown');
                        $('#contact').addClass('bounceInUp');
                        $('#contact').show();
                    }
                    $('#inpSSN').focusout(function() {
                       var body = $("html, body");
                       var cPos = parseInt($(this).attr('data-pos'))+1;
                       var nPos = $('#gpos'+cPos).offset().top; 
                       $('#gpos'+cPos).addClass('active');
                       $('#dPos'+cPos).addClass('active');
                       $('.circlePin').removeClass('active');
                       $('#cir'+(cPos+1)).addClass('active');
                       body.animate({scrollTop:nPos-73}, 800, 'easeInOutCirc');

                    });
                    $('#inpSSN').keypress(function(e) {
                        if(e.which == 13) {
                            if ($(this).val().length > 0){
                                var body = $("html, body");
                                var cPos = parseInt($(this).attr('data-pos'))+1;
                                var nPos = $('#gpos'+cPos).offset().top; 
                                $('#gpos'+cPos).addClass('active');
                                $('#dPos'+cPos).addClass('active');
                                $('.circlePin').removeClass('active');
                                $('#cir'+(cPos+1)).addClass('active');
                                body.animate({scrollTop:nPos-73}, 800, 'easeInOutCirc'); 
                            }

                        }
                    });
                    $('#inpRName').focusout(function() {
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
                    $('#inpRMobile').focus(function() {
                         $('#gpos15').removeAttr('disabled');

                    });
                    $('#inpTransaction').focus(function() {
                         $('#gpos14').removeAttr('disabled');

                    });
                    $('#inpRName').keypress(function(e) {
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
                    
                    $('#inpSSNR').focusout(function() {
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
                    $('#inpSSNR').keypress(function(e) {
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
                    
                     $('#inpPin').focus(function() {
                         $('#gpos15').removeAttr('disabled');

                    });
                    $("#profileChangeBtn").click(function () {
                        $('.profilTableRight input').removeClass('profilInputReadOnly');
                        $('.profilTableRight input').attr({'readonly': false, 'disabled': false});

                        $(this).fadeOut('fast', function () {
                            $(this).hide();
                            $('#profileSaveBtn').fadeIn('fast');
                        });
                    });
                    $("#profileSaveBtn").click(function () {
                        $('.profilTableRight input').addClass('profilInputReadOnly');
                        $('.profilTableRight input').attr({'readonly': 'readonly', 'disabled': 'disabled'});

                        $(this).fadeOut('fast', function () {
                            $(this).hide();
                            $('#profileChangeBtn').fadeIn('fast');
                        });
                    });

                    function logoutProfile() {
                        window.location = "/user/profile/logout";
                    }
                    
                    
                    $( document ).ready(function() {
                       $('.mainForm').fadeIn(300, function () {
                            $('.box').fadeIn(500);
                            boxResize();

                            boxImageResize();
                            pin1();
                            $(document).scrollTop(0);
                            $('#cir1').addClass('active');
                        }); 
                        
                    });
                    
                    //     --------------------------- SAVE PROFILE SETTINGS --------------------------

                    function order(action) {
                        var a = document.getElementById("inputCurrentOrder").value;

                        $.ajax({
                            url: '/user/profile/saveProfile',
                            type: 'post',
                            dataType: 'html',
                            data: 'data=' + a + "|" + action,
                            async: false,
                            success: function (data) {

                            },
                            error: function (data) {
                                alert("Error: " + data);
                            }
                        });
                    }
                    pin1();
                    function pin2(){
                        $('#cir1 .pin').html('1/3');
                        $('#cir10 .pin').html('2/3');
                        $('#cir11 .pin').html('3/3');
                    }
                    function pin1() {
                        $('#cir1 .pin').html('1/9');
                        $('#cir2 .pin').html('2/9');
                        $('#cir3 .pin').html('3/9');
                        $('#cir4 .pin').html('4/9');
                        $('#cir5 .pin').html('5/9');
                        $('#cir6 .pin').html('6/9');
                        $('#cir7 .pin').html('7/9');
                        $('#cir8 .pin').html('8/9');
                        $('#cir9 .pin').html('9/9');
//                        $('#cir12 .pin').html('9/12');
//                        $('#cir13 .pin').html('10/12');
//                        $('#cir14 .pin').html('11/12');
//                        $('#cir15 .pin').html('12/12');
                    }
                    function showPopMenu(dir) {
                        if (isMobile.any()) {
                            if (dir === 1) {
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
                        var shopID = document.getElementById("inputUser").value;

                        $.ajax({
                            url: '/user/orders/getList',
                            type: 'post',
                            dataType: 'json',
                            data: 'data=' + shopID,
                            async: true,
                            success: function (data) {
                                jsoncount = countJson(data);
                                if (jsoncount > 0) {
                                    $('#countOrders-Icon').text(jsoncount);
                                    $('#countOrders-Icon').show();
                                } else if (jsoncount === 0) {

                                    $('#countOrders-Icon').hide();
                                }
                            },
                            error: function (data) {
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


                    function checkLogin() {
                        $('.inputBox').fadeOut(300);
                        $('#btnCheckLogin').fadeOut(300);
                        $('.loaderForm').fadeIn(300);
                        $('.loaderForm').fadeOut(300, function () {
                            $('.mainForm').fadeIn(300, function () {

                                boxResize();
                                $('.box').fadeIn(100);
                                boxImageResize();
                            });
                        });
                    }
                    function boxImageResize() {
                        var b = $('.box img').width();
                        var a = $('.box').height();
                        var c = $('.box img').height();
                        var d = $('.box p').height();
                        var e = $('.box').first().offset().top;
                        var f = parseInt($('#dPos7').offset().top) + parseInt($('#dPos7').height()/2);
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

                    $(document).on('click', '.active .box', function(e) {
                        var body = $("html, body");
                        $(this).closest('.active').children().children().removeClass('selected');
                        $(this).addClass('selected');
                        var cPos = parseInt($(this).attr('data-pos'))+1;
                        var nPos = $('#gpos'+cPos).offset().top; 
                        console.log("npos prvi:"+nPos+" - cpos:"+cPos);
                        if($(this).hasClass('receive')) {
                            cPos=9;
                        }
                                                
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
//                       if (cPos===5) {
//                          $('#cir'+(cPos+2)).addClass('active'); 
//                       }
                       if (cPos===9) {
                          //$('#cir'+(cPos+2)).addClass('active'); 
                       }

                       if (cPos===13) {
                           $('[id=gpos14]').addClass('active');
                           $('[id=dPos14]').addClass('active');
                           if ($('#dPos'+(cPos+1)+' input').length) {
                              $('#dPos'+(cPos+1)+' input').removeAttr('disabled');
                           }
                           $('#cir'+(cPos+1)).addClass('active');
                           $('#cir'+(cPos+2)).addClass('active');
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
                                $('#sendingmoney').hide();
                                $('#receivingmoney').fadeIn(200);
                                pin2();
                                nPos = $('#gpos'+cPos).offset().top; 
                                var a = $('.box').height();
                                var e = $('.box').first().offset().top;
                                var f = parseInt($('#dPos10').offset().top) + parseInt($('#dPos10').height()/2);
                                $('#dTimeLine').css('top', (e+(a/2))+'px');
                                $('#dTimeLine').css('height', f - (e+(a/2))+10+cPos+'px');
                                console.log(nPos);
                                $('#inpSSNR').focus();
                                $('#maxPos').val("10");
                                body.animate({scrollTop:nPos-73}, 800, 'easeInOutCirc');
                            } else if ($(this).hasClass('send')) {
                                $('#receivingmoney').hide();
                                $('#sendingmoney').fadeIn(200);
                                pin1();
                                nPos = $('#gpos'+cPos).offset().top; 
                                var a = $('.box').height();
                                var e = $('.box').first().offset().top;
                                var f = parseInt($('#dPos7').offset().top) + parseInt($('#dPos7').height()/2);
                                $('#dTimeLine').css('top', (e+(a/2))+'px');
                                $('#dTimeLine').css('height', f - (e+(a/2))+10+cPos+'px');
                                $('#inpSSN').focus();
                                body.animate({scrollTop:nPos-73}, 800, 'easeInOutCirc');
                                console.log('send:'+nPos);
                                $('#maxPos').val("7");
                            } else {
                                
                                //$('.timeline .progress').height($("#cir"+cPos).position().top+($(this).height()/2)+10);
                                var a = $('.box').height();
                                var e = $('.box').first().offset().top;
                                var f = parseInt($('#dPos7').offset().top) + parseInt($('#dPos7').height()/2);
                                $('#dTimeLine').css('top', (e+(a/2))+'px');
                                $('#dTimeLine').css('height', f - (e+(a/2))+10+cPos+'px');
                                body.animate({scrollTop:nPos-73}, 800, 'easeInOutCirc'); 
                            }
                            
                       }
                       
                       //----------------------------------------------
                       
                    });
                    
                    function boxResize() {
                        var a = $('.box').width();
                        $('.box').height(a - 10);
                        //$('#cir1').addClass('active');
                    }
                    $('.brwA').click(function () {
                        if ($(this).attr('data-value') !== '') {
                            $('#inpBorrowAmount').val($(this).attr('data-value'));
                        }
                        $('.brwA').addClass('inactive');
                        $(this).removeClass('inactive');
                    });
                    $('.brwY').click(function () {
                        if ($(this).attr('data-value') !== '') {
                            $('#inpYears').val($(this).attr('data-value'));
                        }
                        $('.brwY').addClass('inactive');
                        $(this).removeClass('inactive');
                    });
                    $('.brwN').click(function () {
                        if ($(this).attr('data-value') !== '') {
                            $('#inpCouse').val($(this).attr('data-value'));
                        }
                        $('.brwN').addClass('inactive');
                        $(this).removeClass('inactive');
                    });
                    $('.brwO').click(function () {
                        $('.brwO').addClass('inactive');
                        $(this).removeClass('inactive');
                        var a = $(this).attr('data-value');
                        if (a == '1' || a == '2' || a == '3') {
                            $('#formInputs').fadeIn(200);
                        } else {
                            $('#formInputs').fadeOut(200);
                        }
                        $('#brwOA').val($(this).attr('data-value'));
                    });
                    $('.brwJ').click(function () {
                        if ($(this).attr('data-value') !== '') {
                            $('#inpYearsJ').val($(this).attr('data-value'));
                        }
                        $('.brwJ').addClass('inactive');
                        $(this).removeClass('inactive');
                    });
                    $('.brwR').click(function () {
                        $('.brwR').addClass('inactive');
                        $(this).removeClass('inactive');
                    });
                    $('.brwM').click(function () {
                        $('.brwM').addClass('inactive');
                        $(this).removeClass('inactive');
                    });
                    $('.brwD').click(function () {
                        $('.brwD').addClass('inactive');
                        $(this).removeClass('inactive');
                    });
                    $('.brwV').click(function () {
                        $('.brwV').addClass('inactive');
                        $(this).removeClass('inactive');
                    });
                    $('#inpBorrowAmount').focus(function () {
                        $('.brwA').addClass('inactive');
                    });
                    $('#inpYears').focus(function () {
                        $('.brwY').addClass('inactive');
                    });

                    $(document).on("mouseenter", ".brwN", function () {
                        var el = $(this);
                        var pos = el.offset();
                        var a = ["Samla lån", "Bil", "Renovering", "Båt", "Resa", "Övrigt"];
                        $('#tool_tip_div').html(a[$(this).attr('data-value') - 1]);
                        $('#tool_tip_div').css('top', pos.top + 85);
                        $('#tool_tip_div').css('left', pos.left + el.width() - 120);
                        $('#tool_tip_div').addClass('tool-tip-hover');
                    });
                    $(document).on("mouseenter", ".active .box", function () {
                        if ($(this).attr('data-sel')=="0") {
                            var a = $(this).children('p').css('font-size');
                            var b = parseInt(a.replace('px', ''));
                            var c = $(this).children('p').css('top');
                            var d = parseInt(c.replace('px', ''));
                            if ($(this).children('img').length) {
                                var e = $(this).children('img').css('top');
                                var f = parseInt(e.substr(0,c.length-2));
                                $(this).children('img').css('top', (f - 10) + 'px');
                                $(this).children('img').attr('src', '/themes/frontend/gfx/'+$(this).children('img').attr('data-value')+'b.png');
                                $(this).children('p').css('font-size', (b + 3) + 'px');
                                $(this).children('p').css('top', (d - 10) + 'px');
                            }
                        }

                    });
                    $(document).on("mouseleave", ".active .box", function () {
                        if ($(this).attr('data-sel')==="0") {
                            var a = $(this).children('p').css('font-size');
                            var b = parseInt(a.replace('px', ''));
                            var c = $(this).children('p').css('top');
                            var d = parseInt(c.replace('px', ''));
                            if ($(this).children('img').length) {
                                var e = $(this).children('img').css('top');
                                var f = parseInt(e.replace('px', ''));
                                $(this).children('p').css('font-size', (b - 3) + 'px');
                                $(this).children('p').css('top', (d + 10) + 'px');
                                $(this).children('img').css('top', (f + 10) + 'px'); 
                                $(this).children('img').attr('src', '/themes/frontend/gfx/'+$(this).children('img').attr('data-value')+'.png');
                            }
                        }
                    });

                    
                    $(document).on("mouseleave", ".brwN", function () {
                        $('#tool_tip_div').removeClass('tool-tip-hover');
                    });
                    function sendBank() {
                        var x = $('#gpos15').attr('data-value');
                        if (x==='pin') {
                            $('#gpos15').attr('data-value', 'send');
                            $('#gpos15').html('Skicka pengar');
                            $('#dPos8').fadeIn(200);
                            $('#gpos8').fadeIn(200);
                            $("#inpRPin").focus();
                                var a = $('.box').height();
                                var e = $('.box').first().offset().top;
                                var f = parseInt($('#dPos8').offset().top) + parseInt($('#dPos8').height()/2);
                                $('#dTimeLine').css('top', (e+(a/2))+'px');
                                $('#dTimeLine').css('height', f - (e+(a/2))+10+'px');
                                $('.circlePin').removeClass('active');
                                $('#cir9').addClass('active');
                        } else {
                            showtnxPage();
                        }
                    }

                    function confirmSendToBank() {
                        location.reload();
                    }

                    $(window).on('resize', function () {
                        boxResize();
                        boxImageResize();
                        var z = $('#maxPos').val();
                        var a = $('.box').height();
                        var e = $('.box').first().offset().top;
                        var f = parseInt($('#dPos'+z).offset().top) + parseInt($('#dPos'+z).height()/2);
                        $('#dTimeLine').css('top', (e+(a/2))+'px');
                        $('#dTimeLine').css('height', f - (e+(a/2))+10+'px');
                        
                    });
                    
                    
                    
        
    
        // --------------------------- Countries search -----------------
        var executeSearch;
        function searchTransactions() {
         var a = document.getElementById('countryInp').value;    
    
         
            $.ajax({
                url: '/user/orders/getCountryList', 
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
            $('#countryInp').val(a);
            $('#countryInp').attr('data-val',b);
            $("#searchResults").empty();
        });
        </script>
        <script>
            function startHere() {

                var inputVal = $('#inpMobile');


                if (inputVal.val().length < 7) {
                    $('#inpMobile').css('border', '2px solid red');
                    $('#errorDiv').show(200);
                    $("body").css("overflow", "hidden");
                } else {
                    if (inputVal.val().substring(0, 2) === '07') {

                        checkPhone(inputVal.val());

                    } else {
                        $('#inpMobile').css('border', '2px solid red');
                        $('#errorDiv').show(200);
                        $("body").css("overflow", "hidden");
                    }
                }
                return false;
            }


            // $('.loaderForm').fadeOut(300, function() {
            //    $('.mainForm').fadeIn(300);
            // });
        </script>

    </body>
</html>