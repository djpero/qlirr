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
        <div class=" col-xs-3" style="padding-left:0px">
            <div id="headerLogo" style="float:left">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/gfx/login_logo.png" width="73" height="73"/>
            </div>
            <div class="butik" style="float:left;margin-left:15px;">
                <p id="name"><?php echo $shop->name ?></p>
                <p id="cid"><?php echo $shop->shop_id ?></p>
            </div>
        </div>
        <div class=" col-xs-6" align="center">
            <p id="pcountOrders" onclick="location.href='/user/orders'">Du har <span id="countOrders"><?php echo count($orders); ?></span> nya transaktioner. </p>
        </div>    
        <div class=" col-xs-3" style="padding-right:0px" align="right">
            
        </div>  
<!--        <div id="searchBtn" class="searchIcon"  onclick="searchBtn();" dataio="0">
                <i id="icons8-search" class="icons8-search size-28 "  ></i>
                <input id="inputSearch" type="search" placeholder="Sök med hjälp av referensnummer, datum eller belopp" />
        </div>-->
    </section>
    <section id="sideBar">
        <div class="sideBarBtn" align="center"  onclick="location.href='/user/orders'"><span class="tool-tip slideIn right" style="width:180px;top:34px">Betala varor / Kontantuttag</span>
            <i id="icons8-cash_register" class="icons8-cash_register size-28"  ></i>
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
        <div class="sideBarBtn sideBarToolTip active" align="center"  onclick="location.href='/user/profile/'" ><div class="tool-tip slideIn right" style="width:136px;top:470px">Företagsprofil </div>
            <i id="icons8-info" class="icons8-info size-28 active" ></i>
        </div>
        <!--------------------------- NOVE IKONE kraj ---------------------->
        <div class="sideBarBtn sideBarToolTip iconBottom" align="center" onclick="logoutProfile()"><div class="tool-tip slideIn right" style="width:76px;top:30px;" >Logga ut</div>
            <i id="icons8-cancel" class="icons8-exit size-28 " style="margin-right:0px;margin-left:2px;" ></i>
        </div>

    </section>
    
    <div class="container offsetHeader dashboard">
           <div class="row offsetHeader">
            <div class="column col-xs-8 col-xs-offset-2">
                <p class="title">Företagsprofil</p>
                <p class="titleDesc">Om ändringar ska göras, var vänlig kontakta oss via support@qlirr.com</p>
                
                <div class=" col-lg-10 col-lg-offset-1">
                    <div class="row profilContainer">
                        <?php  
                         $shopAddress = ShopAddressDao::getAddressByShopId($shop->id);
                         if ($shop->invoice === '1') {
                             $installments = 'Faktura';
                             if ($shop->installments === '1') {
                                 $installments = $installments.', Delbetalning';
                             }
                         } else {
                             if ($shop->installments === '1') {
                                 $installments = 'Delbetalning';
                             } else {
                                 $installments = '&nbsp;';     
                             }
                         }

                         $shopBank = ShopBankDao::getBankByUserId($shop->id);
                         $conList = $shop->mobile_number;


                         $x=0;
                         $contacts = ShopContacts::model()->findAllByAttributes(array('shop_id'=>$shop->id));
                         if (count($contacts)>0) {
                             do {
                                 $conList = $conList.', '.$contacts[$x]->phone;
                                 $x++;
                             } while ($x<count($contacts));
                         }

                   ?>
<!--                    <div class="col-xs-6" align="right">
                        <p style="font-weight: 900">Handelsnamn:</p>
                        <p style="font-weight: 900">Besöksadress:</p>
                        <p style="font-weight: 900">Butiks-ID:</p>
                        <p style="font-weight: 900">Tjänster:</p>
                        <p style="font-weight: 900">Firmatecknare:</p>
                        <p style="font-weight: 900">Kontakt:</p>
                        <p style="font-weight: 900">Organisationsnummer:</p>
                        <p style="font-weight: 900">Utbetalningskonto:</p>
                    </div>
                    <div class="col-xs-6 profilText">
                        <p > <?php echo $shop->name; ?></p>
                        <input type="text" value="<?php echo $shopAddress->street.', '.$shopAddress->post_code.' '.$shopAddress->city; ?>" /> 
                        <p > <?php echo $shop->shop_id; ?></p>
                        <p > <?php echo $installments; ?></p>
                        <input type="text" value="<?php echo $shop->owner1; ?>" /> 
                        <p > <?php echo $conList; ?></p>
                        <p > <?php echo $shop->ssn; ?></p>
                        <p > <?php echo $shop->bank_account; ?></p>
                    </div>-->

                    <div class="col-xs-12 ">
                        <table style="width:100%;">
                            <tr>
                                <td align="right" class="profilTableLeft"><p>Handelsnamn:</p></td>
                                <td class="profilTableRight"><p><?php echo $shop->name; ?></p></td>
                            </tr>
                            <tr>
                                <td align="right" class="profilTableLeft"><p>Besöksadress:</p></td>
                                <td class="profilTableRight"><p><?php echo $shopAddress->street.', '.$shopAddress->post_code.' '.$shopAddress->city; ?></p> </td>
                            </tr>
                            <tr>
                                <td align="right" class="profilTableLeft"><p>Mottagarnummer:</p></td>
                                <td class="profilTableRight"><p > <?php echo $shop->shop_id; ?></p></td>
                            </tr>
                            <tr>
                                <td align="right" class="profilTableLeft"><p>Firmatecknare:</p></td>
                                <td class="profilTableRight"><p ><?php echo $shop->owner1; ?></p></td>
                            </tr>
                            <tr>
                                <td align="right" class="profilTableLeft"><p>Telefon:</p></td>
                                <td class="profilTableRight"><p><?php echo $conList; ?> </p></td>
                            </tr>
                            <tr>
                                <td align="right" class="profilTableLeft"><p>Organisationsnummer:</p></td>
                                <td class="profilTableRight"><p><?php echo $shop->ssn; ?> </p></td>
                            </tr>
                            <tr>
                                <td align="right" class="profilTableLeft"><p>E-mail:</p></td>
                                <td class="profilTableRight"><p><?php echo $shop->email; ?> </p></td>
                            </tr>
                        </table>
                    </div>
                 <!--~~~~~~~~~~~~~~~~~~~~ ovdje ide profil ~~~~~~~~~~~~~~~~~~~~~~-->
                </div>                       
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

    <script src="/themes/frontend/js/application.js"></script>

<script>
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

</script>
</body>
</html>