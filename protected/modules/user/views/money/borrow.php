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
            <div class="sideBarBtn sideBarToolTip active" align="center"  onclick="location.href = '/user/money/borrow'" ><div class="tool-tip slideIn right" style="width:136px;top:251px">Ansöka om banklån </div>
                <i id="icons8-museum" class="icons8-museum size-28 active " ></i>
            </div>
            <div class="sideBarBtn sideBarToolTip" align="center"  onclick="location.href = '/user/money/send'" ><div class="tool-tip slideIn right" style="width:156px;top:325px">Skicka / Ta emot pengar </div>
                <i id="icons8-data_in_both_directions" class="icons8-data_in_both_directions size-28 " ></i>
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
                    <p class="title">Ansöka om banklån</p>

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
                        <p id="gpos0" class="title active">Vad ska du använda pengarna till?</p>
                        <div id="dPos0" class="row no-margin active group">
                            <div class="circlePin" id="cir1"><div class="pin">1/12</div></div>
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="0" data-sel="0" data-box-value="Samla lån">
                                    <p>Samla lån</p>
                                    <img src="/themes/frontend/gfx/cash_receiving-50.png" data-value="cash_receiving-50"  alt="" />
                                </div> 
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="0" data-sel="0" data-box-value="Bil">
                                    <p>Bil</p>
                                    <img src="/themes/frontend/gfx/cars-50.png" data-value="cars-50"  alt="" />
                                </div> 
                            </div>  
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="0" data-sel="0" data-box-value="Renovering">
                                    <p>Renovering</p>
                                    <img src="/themes/frontend/gfx/broom-50.png" data-value="broom-50" alt="" />
                                </div> 
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="0" data-sel="0" data-box-value="Båt">
                                    <p>Båt</p>
                                    <img src="/themes/frontend/gfx/yacht-50.png" data-value="yacht-50" alt="" />
                                </div>  
                            </div>  
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="0" data-sel="0"  data-box-value="Resa">
                                    <p>Resa</p>
                                    <img src="/themes/frontend/gfx/beach_umbrella-50.png" data-value="beach_umbrella-50" alt="" />
                                </div>  
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box popup" data-pos="0" data-sel="0" data-other="1"  data-box-value="Övrigt">
                                    <p>Övrigt</p>
                                    <img src="/themes/frontend/gfx/medium_priority-50" data-value="medium_priority-50" alt="" />
                                </div>  
                            </div>  
                        </div>
                        <p id="gpos1" class="title">Hur mycket vill du låna?</p>
                        <div id="dPos1" class="row no-margin group">
                            <div class="circlePin" id="cir2"><div class="pin"></div></div>
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="1"  data-box-value="10000">
                                    <p class="middle">10 000</p>

                                </div> 
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="1" data-box-value="50000">
                                    <p class="middle">50 000</p>
                                    
                                </div> 
                            </div>  
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="1" data-box-value="75000">
                                    <p class="middle">75 000</p>

                                </div> 
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="1"  data-box-value="100000">
                                    <p class="middle">100 000</p>
                                  
                                </div>  
                            </div>  
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="1" data-box-value="150000">
                                    <p class="middle">150 000</p>
                                    
                                </div>  
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box popup" data-pos="1" data-box-value="0">
                                    <p class="middle">Övrigt</p>
                                        
                                </div>  
                            </div>  
                        </div>
                        <p id="gpos2" class="title">Hur lång tid vill du låna pengarna?</p>
                        <div id="dPos2" class="row no-margin group">
                            <div class="circlePin"  id="cir3"><div class="pin"></div></div>
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="2"  data-box-value="1">
                                    <p class="middle ">1 år</p>

                                </div> 
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="2"  data-box-value="2">
                                    <p class="middle">2 år</p>
                                    
                                </div> 
                            </div>  
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="2"  data-box-value="3">
                                    <p class="middle">3 år</p>

                                </div> 
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="2"  data-box-value="5">
                                    <p class="middle">5 år</p>
                                  
                                </div>  
                            </div>  
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="2"  data-box-value="7">
                                    <p class="middle">7 år</p>
                                    
                                </div>  
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box popup" data-pos="2"  data-box-value="0">
                                    <p class="middle">Övrigt</p>
                                        
                                </div>  
                            </div>  
                        </div>
                        <p id="gpos3" class="title">Vad jobbar du med?</p>
                        <div id="dPos3" class="row no-margin group">
                            <div class="circlePin" id="cir4"><div class="pin"></div></div>
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="3" data-check="1"  data-box-value="Tillsvidareanställd">
                                    <p class="middle small">Tillsvidareanställd</p>

                                </div> 
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="3" data-check="1" data-box-value="Egen företagare">
                                    <p class="middle small">Egen företagare</p>
                                    
                                </div> 
                            </div>  
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="3" data-check="1" data-box-value="Projektanställd">
                                    <p class="middle small">Projektanställd</p>

                                </div> 
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="3" data-check="0" data-box-value="Pensionär">
                                    <p class="middle small">Pensionär</p>
                                  
                                </div>  
                            </div>  
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="3" data-check="0"  data-box-value="Sjukpensionär">
                                    <p class="middle small">Sjukpensionär</p>
                                    
                                </div>  
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="3"  data-box-value="Student">
                                    <p class="middle small" data-check="0">Student</p>
                                        
                                </div>  
                            </div>  
                        </div>
                        <p id="gpos4" class="title" style="display:none">Hur länge har du jobbat där?</p>
                        <div id="dPos4" class="row no-margin group" hidden>
                            <div class="circlePin" id="cir5"><div class="pin"></div></div>
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="4"  data-box-value="1">
                                    <p class="middle">1 år</p>

                                </div> 
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="4"  data-box-value="2">
                                    <p class="middle">2 år</p>
                                    
                                </div> 
                            </div>  
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="4"  data-box-value="3">
                                    <p class="middle">3 år</p>

                                </div> 
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="4"  data-box-value="5">
                                    <p class="middle">5 år</p>
                                  
                                </div>  
                            </div>  
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="4" data-box-value="7">
                                    <p class="middle">7 år</p>
                                    
                                </div>  
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box popup" data-pos="4"  data-box-value="0">
                                    <p class="middle">Övrigt</p>
                                        
                                </div>  
                            </div>  
                        </div>
                        <p id="gpos5" class="title" style="display:none">Vad heter företaget du jobbar för?</p>
                        <div id="dPos5" class="inputBox2 form-group group" hidden>
                           <div class="circlePin" id="cir6"><div class="pin"></div></div>
                           <input id="inpEmp" type="text" class="form-control" disabled data-pos="5" /> 
                        </div>
                        <p id="gpos6" class="title" style="display:none">Vad är telefonnumret till företaget?</p>
                        <div id="dPos6" class="inputBox2 form-group group" hidden>
                            <div class="circlePin" id="cir7"><div class="pin"></div></div>
                            <input id="inpEmpTel" type="text" class="form-control" disabled data-pos="6" />
                        </div>
                        <p id="gpos7" class="title">Bor du i…</p>
                        <div id="dPos7" class="row no-margin group">
                            <div class="circlePin" id="cir8"><div class="pin"></div></div>
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="7"  data-box-value="Hyresrätt">
                                    <p class="middle small">Hyresrätt</p>

                                </div> 
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="7"  data-box-value="Villa eller radhus">
                                    <p class="middle small">Villa eller radhus</p>
                                    
                                </div> 
                            </div>  
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="7" data-box-value="Bostadsrätt">
                                    <p class="middle small">Bostadsrätt</p>

                                </div> 
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="7" data-box-value="Inneboende">
                                    <p class="middle small">Inneboende</p>
                                  
                                </div>  
                            </div>  
                           
                        </div>
                        <p id="gpos8" class="title">Är du…</p>
                        <div id="dPos8" class="row no-margin group">
                            <div class="circlePin" id="cir9"><div class="pin"></div></div>
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="8"  data-box-value="Ensamstående">
                                    <p class="middle small">Ensamstående</p>

                                </div> 
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="8" data-box-value="Sambo">
                                    <p class="middle small">Sambo</p>
                                    
                                </div> 
                            </div>  
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="8" data-box-value="Gift">
                                    <p class="middle small">Gift</p>

                                </div> 
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="8" data-box-value="Skild">
                                    <p class="middle small">Skild</p>
                                  
                                </div>  
                            </div>  
                           
                        </div>  
                        <p id="gpos9" class="title">Vad tjänar du i månaden? (Före skatt)</p>
                        <div id="dPos9" class="inputBox2 form-group group">
                            <div class="circlePin" id="cir10"><div class="pin"></div></div>
                           <input id="inpSallaryNoVat" type="text" class="form-control" disabled data-pos="9" /> 
                        </div>
                        <p id="gpos10" class="title">Vad har du för boendekostnad per månad?</p>
                        <div id="dPos10" class="inputBox2 form-group group">
                            <div class="circlePin" id="cir11"><div class="pin"></div></div>
                            <input id="inpCosts" type="text" class="form-control" disabled  data-pos="10" />
                        </div>
                        <p id="gpos11" class="title">Hur många barn har du att försörja?</p>
                        <div id="dPos11" class="row no-margin group">
                            <div class="circlePin" id="cir12"><div class="pin"></div></div>
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="11" data-box-value="0">
                                    <p class="middle">0</p>

                                </div> 
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="11" data-box-value="1">
                                    <p class="middle">1</p>
                                    
                                </div> 
                            </div>  
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="11" data-box-value="2">
                                    <p class="middle">2</p>

                                </div> 
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="11" data-box-value="3">
                                    <p class="middle">3</p>
                                  
                                </div>  
                            </div>  
                           <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="11" data-box-value="4">
                                    <p class="middle">4</p>
                                  
                                </div>  
                            </div>  
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="11" data-box-value="5">
                                    <p class="middle">5</p>
                                  
                                </div>  
                            </div>  
                        </div> 
                        <p id="gpos12" class="title">Vill du öka dina chanser till lån, genom att lägga till medsökande?</p>
                        <div id="dPos12" class="row no-margin group">
                            <div class="circlePin" id="cir13"><div class="pin"></div></div>
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="12" data-box-value="Ja">
                                    <p class="middle">Ja</p>

                                </div> 
                            </div>    
                            <div class="col-sm-2 no-padding">
                                <div class="box" data-pos="12" data-box-value="Nej">
                                    <p class="middle">Nej</p>
                                    
                                </div> 
                            </div>  
                            
                        </div> 
                        <p id="gpos13" class="title">Mobilnummer</p>
                        <div id="dPos13" class="inputBox2 form-group group">

                            <div class="circlePin" id="cir14"><div class="pin"></div></div>
                           <input id="inpMobile" type="text" class="form-control" disabled data-pos="13" placeholder="Mobilenummer"/> 
                        </div>
                        <p id="gpos14" class="title" style="display:none">Pinkod</p>
                        <div id="dPos14" class="inputBox2 form-group group" hidden>
                            <div class="circlePin" id="cir15"><div class="pin"></div></div>
                            <input id="inpPin" type="text" class="form-control" disabled  data-pos="14" placeholder="Pinkod"/>
                        </div>                     
                        <button id="gpos15" onclick="sendBank();" class="btn btn-login" style="width:30%;margin-top:50px;margin-bottom: 50px" data-value="pin">Skicka pinkod</button>
                        <div style="height:400px;width:1px;">&nbsp;</div> 
                    </div>
                    

                    <!------------------------------------------------------------------------------------->
                    <!------------------------------------------------------------------------------------->
                    <!------------------------------------------------------------------------------------->


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
        <div id="tnxPage" hidden align="center" class="animated bounceInUp">
            <i class="icons8-cancel size-28 "  onclick="closetnxPage()"></i>
            <div id="msg" style="top:10%">
                <p id="title" style="margin-bottom:8px">Ansök om banklån</p>
                <p style="margin-bottom: 40px;color:rgba(255,255,255,0.5)">Är du säker på att du vill ansöka om detta lån?</p>
                <div id="tnxPageResult">
                    
                </div>
                <button id="otherBTN" class="btn btn-accept" onclick="closeSaveOther()">Berkrafta</button>
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
        
        <input id="boxVal0"  class="boxValClass"  hidden />
        <input id="boxVal1"  class="boxValClass"  hidden />
        <input id="boxVal2"  class="boxValClass"  hidden />
        <input id="boxVal3"  class="boxValClass"  hidden />
        <input id="boxVal4"  class="boxValClass"  hidden />
        <input id="boxVal5"  class="boxValClass"  hidden />
        <input id="boxVal6"  class="boxValClass"  hidden />
        <input id="boxVal7"  class="boxValClass"  hidden />
        <input id="boxVal8"  class="boxValClass"  hidden />
        <input id="boxVal9"  class="boxValClass"  hidden />
        <input id="boxVal10" class="boxValClass"  hidden />
        <input id="boxVal11" class="boxValClass"  hidden />
        <input id="boxVal12" class="boxValClass"  hidden />
        <input id="boxVal13" class="boxValClass"  hidden />
        <input id="boxVal14" class="boxValClass"  hidden />
        <input id="boxVal15" class="boxValClass"  hidden />
        
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
                    function showtnxPage() {
                        var append='';
                        $('.boxValClass').each(function(index,item) {
                            if (index<14) {
                                append+='<tr style="width:100%"><td align="right" style="width:50%"><p class="tnxPageQ">'+$("#gpos"+index).html()+'</p></td><td style="width:50%"><p id="res'+index+'">'+$(item).val()+'</p></td>';
                            }
                        });
                        $("#tnxPageResult").html('<table>'+append+'</table>');
                        $('#res5').html($("#inpEmp").val());
                        $('#res6').html($("#inpEmpTel").val());
                        $('#res9').html($("#inpSallaryNoVat").val());
                        $('#res10').html($("#inpCosts").val());
                        $('#res13').html($("#inpMobile").val());
                        
                        
                        $('#tnxPage').removeClass('bounceOutDown');
                        $('#tnxPage').addClass('bounceInUp');
                        $('#tnxPage').show();
                     
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
                    function closeSaveOther() {
                        if ($('#otherInp').val().length > 0) {
                            $('#other').removeClass('bounceInUp');
                            $('#other').addClass('bounceOutDown');
                            var body = $("html, body");
                            var cPos = $('#inpTempcPos').val();
                            var nPos = $('#gpos'+cPos).offset().top; 
                            var inpVal = $('#otherInp').val();
                            $('#dPos'+(cPos-1)+' .box.popup p').html(addCommas(inpVal));
                            $('#dPos'+(cPos-1)+' .box.popup').attr('data-box-value', inpVal);
                            // heres
                            $('#boxVal'+(cPos-1)).val(inpVal);
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
                    $('#otherInp').focus(function() {
                       $(this).removeClass('error');
                    });
                    function showContactDiv() {
                        $('#contact').removeClass('bounceOutDown');
                        $('#contact').addClass('bounceInUp');
                        $('#contact').show();
                    }
                    $('#inpEmpTel').focusout(function() {
                       var body = $("html, body");
                       var cPos = parseInt($(this).attr('data-pos'))+1;
                       var nPos = $('#gpos'+cPos).offset().top; 
                       $('#gpos'+cPos).addClass('active');
                       $('#dPos'+cPos).addClass('active');
                       $('.circlePin').removeClass('active');
                       $('#cir'+(cPos+1)).addClass('active');
                       body.animate({scrollTop:nPos-73}, 800, 'easeInOutCirc');

                    });
                    $('#inpEmpTel').keypress(function(e) {
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
                    $('#inpCosts').focusout(function() {
                       var body = $("html, body");
                       var cPos = parseInt($(this).attr('data-pos'))+1;
                       var nPos = $('#gpos'+cPos).offset().top; 
                       $('#gpos'+cPos).addClass('active');
                       $('#dPos'+cPos).addClass('active');
                       $('.circlePin').removeClass('active');
                       $('#cir'+(cPos+1)).addClass('active');
                       body.animate({scrollTop:nPos-73}, 800, 'easeInOutCirc');
                       
                    });
                    $('#inpCosts').keypress(function(e) {
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
                    $('#inpSallaryNoVat').on('keydown', function(e) {
                        
                        var code = e.which || e.keyCode;
                        if(code == 13 || code ==9) {
                            if (code==9) {
                                e.preventDefault();
                            }
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
                    $('#inpMobile').on('keydown', function(e) {
                        
//                        var code = e.which || e.keyCode;
//                        if(code == 13 || code ==9) {
//                            if (code==9) {
//                                e.preventDefault();
//                            }
//                            if ($(this).val().length > 0){
//                                var body = $("html, body");
//                                var cPos = parseInt($(this).attr('data-pos'))+1;
//                                var nPos = $('#gpos'+cPos).offset().top; 
//                                $('#gpos'+cPos).addClass('active');
//                                $('#dPos'+cPos).addClass('active');
//                                $('.circlePin').removeClass('active');
//                                $('#cir'+(cPos+1)).addClass('active');
//                                $('#dPos'+cPos+' input').removeAttr('disabled').focus();
//                                body.animate({scrollTop:nPos-73}, 800, 'easeInOutCirc'); 
//                            }
//
// 
//                        }
                         $('#gpos15').removeAttr('disabled');
                    });
                    $('#inpEmp').on('keydown', function(e) {
                        
                        var code = e.which || e.keyCode;
                        if(code == 13 || code ==9) {
                            if (code==9) {
                                e.preventDefault();
                            }
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
                                $("body").scrollTop(0);
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
                        var cPins = $(".pin");
                        cPins.each(function(index, element) {
                            $(element).html((index+1)+'/'+$(cPins).length);
                        });
                    }
                    function pin1() {
                        $('#cir1 .pin').html('1/12');
                        $('#cir2 .pin').html('2/12');
                        $('#cir3 .pin').html('3/12');
                        $('#cir4 .pin').html('4/12');
                        $('#cir8 .pin').html('5/12');
                        $('#cir9 .pin').html('6/12');
                        $('#cir10 .pin').html('7/12');
                        $('#cir11 .pin').html('8/12');
                        $('#cir12 .pin').html('9/12');
                        $('#cir13 .pin').html('10/12');
                        $('#cir14 .pin').html('11/12');
                        $('#cir15 .pin').html('12/12');
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
                        var f = parseInt($('#dPos13').offset().top) + parseInt($('#dPos13').height()/2);
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
                    
                    //-------------------------------------------------------------------------
                    // --------------------------------- MAIN ---------------------------------
                    //-------------------------------------------------------------------------
                    
                    $(document).on('click', '.active .box', function(e) {
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
                           $('#dPos'+cPos+' input').removeAttr('disabled');
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
                       if (cPos===5) {
                          $('#inpEmp').focus();
                       }
                   
                       if (cPos === 4) {
                           if ($(this).attr('data-check') == "1"){
                               $('#gpos4').fadeIn(400);
                               $('#dPos4').fadeIn(400);
                               $('[id^=gpos5]').fadeIn(400);
                               $('[id^=dPos5]').fadeIn(400);
                               $('[id^=gpos6]').fadeIn(400);
                               $('[id^=dPos6]').fadeIn(400);
                         
                               nPos = $('#gpos4').offset().top;
                               pin2();
                           } else {
                               $('#gpos4').fadeOut(400);
                               $('#dPos4').fadeOut(400);
                               $('[id^=gpos5]').fadeOut(400);
                               $('[id^=gpos6]').fadeOut(400);
                               $('[id^=dPos5]').fadeOut(400);
                               $('[id^=dPos6]').fadeOut(400, function() {
                                   nPos = $('#gpos7').offset().top;
                                   $('#gpos7').addClass('active');
                                   $('#dPos7').addClass('active');
                               });
                               pin1();
                           }
                       }
                       if (cPos==9) {
                           $('#gpos9').addClass('active');
                           $('#dPos9').addClass('active');
                           $('#inpSallaryNoVat').removeAttr('disabled').focus();
                       }
                       if (cPos===13) {
                           $('[id=gpos13]').addClass('active');
                           $('[id=dPos13]').addClass('active');
                           if ($('#dPos'+(cPos)+' input').length) {
                              $('#dPos'+(cPos)+' input').removeAttr('disabled').focus();
                           }
                           $('#cir'+(cPos+1)).addClass('active');
                       
                       }
                       if (cPos===14) {
                           $('#gpos15').removeAttr('disabled');
                       } else {
                           if ($(this).hasClass('popup')) {
                                showOther(cPos);
                                
                            } else {
                                body.animate({scrollTop:nPos-73}, 800, 'easeInOutCirc');
                                //$('.timeline .progress').height($("#cir"+cPos).position().top+($(this).height()/2)+10);
                                var a = $('.box').height();
                                var e = $('.box').first().offset().top;
                                var f = parseInt($('#dPos13').offset().top) + parseInt($('#dPos13').height()/2);
                                $('#dTimeLine').css('top', (e+(a/2))+'px');
                                $('#dTimeLine').css('height', f - (e+(a/2))+10+'px');
                            }
                       }
                       
                       // upisivanje u text-box odabranih vrijednosti
                    
                            var boxPos = $(this).attr('data-pos');
                            var boxVal = $(this).attr('data-box-value');
                            $("#boxVal"+boxPos).val(boxVal);
                        
                       
                       //-------------------------------------------------------------------------
                       // --------------------------------- MAIN ---------------------------------
                       //-------------------------------------------------------------------------
                       
                    });
                    
                    function boxResize() {
                        var a = $('.box').width();
                        $('.box').height(a - 10);
                        $('#cir1').addClass('active');
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
                            $('#dPos14').fadeIn(200);
                            $('#gpos14').fadeIn(200);
                            $('#dPos14 input').removeAttr('disabled').focus();
                                var a = $('.box').height();
                                var e = $('.box').first().offset().top;
                                var f = parseInt($('#dPos14').offset().top) + parseInt($('#dPos14').height()/2);
                                $('#dTimeLine').css('top', (e+(a/2))+'px');
                                $('#dTimeLine').css('height', f - (e+(a/2))+10+'px');
                                $('.circlePin').removeClass('active');
                                $('#cir15').addClass('active');
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