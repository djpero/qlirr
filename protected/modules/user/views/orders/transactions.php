<?php 
    $orderID = $_GET['id'];

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
    <input id="searchOption" hidden value="" />
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
            <p id="pcountOrders"  onclick="location.href='/user/orders'">Du har <span id="countOrders"><?php echo count($orders); ?></span> nya transaktioner. </p>
        </div>    
        <div class=" col-xs-3" style="padding-right:0px" align="right">
            
        </div>  
        <div id="searchBtn" class="searchIcon" data-io="0" style="padding-top:0px;">
                <i id="icons8-search" class="icons8-search size-28 " onclick="searchBtnBack();"></i>
                <input id="inputSearch" type="search" placeholder="Sök med hjälp av referensnummer, datum eller belopp" autocomplete="off"/>
                
        </div>
    </section>
    <div id="searchResults" class="row searchResult" style="top:0px;margin-top:0px;left:74px">
                   
     </div>
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
        <div class="sideBarBtn sideBarToolTip active" align="center"  onclick="location.href='/user/orders/transactions'" ><div class="tool-tip slideIn right" style="width:136px;top:397px">Transaktionhistorik </div>
            <i id="icons8-clock" class="icons8-clock size-28 active" ></i>
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
            <div class="column col-xs-8 col-xs-offset-2">
                <p class="title">Transaktionshistorik </p> 
                <div class="row">
                    <div class=" col-xs-6 col-xs-offset-3 transactionFilter">
                        <div style="width:33.3333%" align="center">
                            <p id="filterPaid">Utbetalda</p>
                        </div>
                        <div style="width:33.3333%" align="center">
                            <p id="filterAll" style="margin-left:25%;margin-right: 25%" class="active">Alla</p>
                        </div>
                        <div style="width:33.3333%" align="center">
                            <p id="filterUnPaid">Ej utbetalda</p>
                        </div>

                    </div>
                    
                </div>
                <p id="filterTransCount"></p>
                <!--------------------------- THERE IS FILTER LIST ---------------------------->
                <div align="right" class="selectBox ">
                    <div align='center'>
                        <span data-id='1' class="markOrders">Markera alla</span>
                    </div>
                    <div align='center'>
                        <span  data-id='2' class="markOrders active">  Avmarkera alla</span>
                    </div>
                    <div align='center' style='width:60px;' >
                        <img class='printiconTrans' src="/themes/frontend/gfx/print_black.png"  style="margin-left:10px;cursor:pointer" title="Generate PDF" onclick="printTransaktion();"/>
                    </div>
                    
                </div>
                <div id="offerList" style="margin-top:4px;z-index:-1;margin-left:32px;margin-right:32px;margin-bottom:60px;" >
                    <div id="textRemove" class="loader"></div>
                </div>
                <!--------------------------- THERE IS FILTER LIST ---------------------------->

            </div>
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
    <footer>
        <div class="footerLeft">
            <p>© <?php echo date('Y'); ?> All Rights Reserved</p>
        </div>
        <div class="footerRight" align="right">
            <a onclick="showTrainingDiv()">Utbildningar</a><a  onclick="showContactDiv()">Kundtjänst</a>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript
    =================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="/themes/frontend/js/bootstrap.min.js"></script>
<script>
   
//    AUTOSTARTUP LOADING FINISHED TRANSACTIONS
        var refreshlist = setTimeout(function(){refreshList('2')},2000);

//    ---------------------------------------------

    
    $('#filterAll').click(function() {
       $('#filterPaid').removeClass('active'); 
       $('#filterUnPaid').removeClass('active');
       $(this).addClass('active');
       refreshList('2');
       $("#searchResults").empty();
       $('#inputSearch').val('');
       $('#searchOption').val('2');
    });
    $('#filterPaid').click(function() {
       $('#filterAll').removeClass('active'); 
       $('#filterUnPaid').removeClass('active');
        $(this).addClass('active');
        refreshList('1');
        $("#searchResults").empty();
        $('#searchOption').val('1');
    });
    $('#filterUnPaid').click(function() {
       $('#filterPaid').removeClass('active'); 
       $('#filterAll').removeClass('active');
       $(this).addClass('active');
       refreshList('0');
       $("#searchResults").empty();
       $('#searchOption').val('0');
    });

    
    if(window.innerHeight > window.innerWidth){
        $('.transactionFilter').removeClass('col-xs-offset-3');
        $('.transactionFilter').removeClass('col-xs-6');
        $('.transactionFilter').addClass('col-xs-8');
        $('.transactionFilter').addClass('col-xs-offset-2');
        
    }
    
    
    var executeSearch;

    $('#inputSearch').on('keyup', function(e) {
        clearTimeout(executeSearch);
        clearTimeout(refreshlist);
        if ($(this).val()!=='') {
            if(e.which !== 13) {
                $('#offerList').empty();
                $('#filterTransCount').text('0 transaktion med totalbelopp på 0,00 kr');
                executeSearch = setTimeout(function(){searchTransactions()}, 200);  // ------->>>> tek kad se smisli onda izbaci rezultat
            }
        } else {
            $("#searchResults").empty();
        }
    });
    $('#inputSearch').keypress(function(e) {
        if(e.which == 13) {
            clearTimeout(refreshlist);
            $("#searchResults").empty();
            searchOnEnter();
        }
    });

    $('.markOrders').click(function() {
        var a = $(this).attr('data-id');
        if (a==='2') {
            $('.orderCheckbox').removeClass('active');
            $('.markOrders').removeClass('active');
            $('.orderCheckbox').attr('data-selected', '0');
            $(this).addClass('active');
        } else {
            $('.orderCheckbox').addClass('active');
            $('.orderCheckbox').attr('data-selected', '1');
            $('.markOrders').removeClass('active');
            $(this).addClass('active');
        }
    });
    $(document).on('click', '.orderCheckbox', function() {
       var a = $(this).attr('data-selected');
       if (a==='0') {
           $(this).attr('data-selected', '1');
           $(this).addClass('active');
           $('.markOrders').removeClass('active');
       } else {
           $(this).attr('data-selected', '0');
           $(this).removeClass('active');
           $('.markOrders').removeClass('active');
       }
    });
    function searchTransactions() {
        var a = document.getElementById('inputSearch').value;    
        var b = document.getElementById('inputUser').value;   
        var c = $('#searchOption').val();
        $.ajax({
            url: '/user/orders/getSearchList',
            type: 'post',
            dataType: 'html',
            data: 'data='+a+"|"+b+"|"+c,
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
    
    function searchBtnBack() {
    
        var a = $('#searchBtn').attr('data-io');
       
        if (a==="0") {
            $('#searchBtn').attr('data-io', '1');
            $('#searchBtn').addClass('searchBarFull');
            $('#inputSearch').addClass('searchBarInput');
            $('#inputSearch').focus();
            $("#searchBtn").css("cursor", "default");
        } else if (a==='1'){
            $('#searchResults').empty();
            $('#searchBtn').attr('data-io', '0');
            $('#searchBtn').removeClass('searchBarFull');
            $('#inputSearch').removeClass('searchBarInput');  
            $("#searchBtn").css("cursor", "pointer");
            $('#inputSearch').attr('placeholder', 'Sök med hjälp av referensnummer, datum eller belopp');
            $('#inputSearch').val('');  
        }
        
    }
  
  function refreshList(action) {
        var shopID      = document.getElementById("inputUser").value;
        var a=0;
        $.ajax({
            url: '/user/orders/getListFinished',
            type: 'post',
            dataType: 'json',
            data: 'data='+shopID+"|"+action,
            async: true,
            success: function(data) {
                $("#offerList").empty();
                
                var jsoncount = countJson(data);
                $('#pcountOrders').fadeIn("fast");
                $('.markOrders').fadeIn("fast");
                $('.printiconTrans').fadeIn("fast");
                if (jsoncount > 0) {
                    $("#textRemove").fadeOut("fast");
                    var total = 0;
                    $.each(data, function(i, item) {
                        
                        if (item.status === '2') {
                            var itemData    = item.time.split("|");
                            var dataId      = "<div  id='"+item.id+"' class='row orderListHover'>";
                            var dataPrice   = "<div style='float:left;margin-right:5px;width:78px'><p style='text-align:center;font-size:14px; color:#aaa;padding-top:14px;margin-bottom:0px'>"+itemData[0]+"</p><p style='padding-top:7px;text-align:center;font-size:14px; color:#aaa;'>"+itemData[1]+"</p></div><div style='float:left'><p style='font-size:22px;font-weight:700;color:#00374C;padding-top:10px;margin-bottom:0px;'>"+item.price+"</p><p style='font-size:14px; color: #aaa;'>Ref. "+item.code+"</p></div>";
                            var dataCode    = "<div style='float:right;margin-right:6px;width:100px;' align='right' ><div style='width:50%;float:left;margin-top:17px'></div><div style='width:50%;float:left;margin-top:17px'></div><i data-selected='0' data-order='"+item.id+"' class='icons8-checkmark orderCheckbox'></i></div>";
                            var htmlOut     = dataId + dataPrice + dataCode;
                            total += parseInt(item.total_amount);
                            a++;
                            $('#filterTransCount').text(a+' transaktioner med totalbelopp på '+total+' kr');
                            $(htmlOut).hide().prependTo("#offerList").fadeIn(700);
                            
                        }
                        
                    });

                } else {
                    $("#textRemove").text("Det finns inga nya betalningar.");
                    $("#textRemove").fadeIn("fast");
                }
            },
            error:function(data){
            
           } 
        });
     }
     
     
    function searchOnEnter() {
        var shopID      = document.getElementById("inputUser").value;
        var phrase      = document.getElementById("inputSearch").value;
        
        $.ajax({
            url: '/user/orders/getSearchEnter',
            type: 'post',
            dataType: 'json',
            data: 'data='+phrase+"|"+shopID,
            async: true,
            success: function(data) {

                $("#offerList").empty();
                var jsoncount = countJson(data);
                $('#pcountOrders').fadeIn("fast");
                if (jsoncount > 0) {
//                    $("#textRemove").fadeOut("fast");
                    var total = 0;
                    $.each(data, function(i, item) {
                        if (item.status === '2') {
                            var itemData    = item.time.split("|");
                            var dataId      = "<div  id='"+item.id+"' class='row orderListHover'>";
                            var dataPrice   = "<div style='float:left;margin-right:5px;width:78px'><p style='text-align:center;font-size:14px; color:#aaa;padding-top:14px;margin-bottom:0px'>"+itemData[0]+"</p><p style='padding-top:7px;text-align:center;font-size:14px; color:#aaa;'>"+itemData[1]+"</p></div><div style='float:left'><p style='font-size:22px;font-weight:700;color:#00374C;padding-top:10px;margin-bottom:0px;'>"+item.price+"</p><p style='font-size:14px; color: #aaa;'>Ref. "+item.code+"</p></div>";
                            var dataCode    = "<div style='float:right;margin-right:6px;width:100px;' align='right'><div style='width:50%;float:left;margin-top:17px'></div><div  style='width:50%;float:left;margin-top:17px'></div><i data-selected='0' data-order='"+item.id+"' class='icons8-checkmark orderCheckbox'></i></div>";
                            var htmlOut     = dataId + dataPrice + dataCode;
                            total += parseInt(item.total_amount);
                            $('#filterTransCount').text(jsoncount+' transaktioner med totalbelopp på '+total+' kr');
                            $(htmlOut).hide().prependTo("#offerList").fadeIn(700);

                        }
                    });
                } else {
                    $("#textRemove").text("Det finns inga nya betalningar.");
                    $("#textRemove").fadeIn("fast");
                }
            },
            error:function(data){
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
    
    $("#searchResults").on('click', '.searchItem', function() {
        var orderId = $(this).attr('data-content');

        $.ajax({
            url: '/user/orders/getOrderData',
            type: 'post',
            dataType: 'html',
            data: 'data='+orderId,
            async: false,
            success: function(data) {
                $("#searchResults").empty();
                var itemData    = data.split(" ");
                $("#inputSearch").val('');
                $("#inputSearch").attr('placeholder', itemData[1]+' '+itemData[3]+' '+itemData[2]);
                $("#offerList").empty();
                $('#filterTransCount').text('1 transaktion med totalbelopp på '+itemData[3]+' kr');
                clearTimeout(refreshlist);
                
                
                
                var dataId      = "<div class='row orderListHover'>";
                var dataPrice   = "<div style='float:left;margin-right:5px;width:78px'><p style='text-align:center;font-size:14px; color:#aaa;padding-top:14px;margin-bottom:0px'>"+itemData[0]+"</p><p style='padding-top:7px;text-align:center;font-size:14px; color:#aaa;'></p></div><div style='float:left'><p style='font-size:22px;font-weight:700;color:#00374C;padding-top:10px;margin-bottom:0px;'>"+itemData[3]+"</p><p style='font-size:14px; color: #aaa;'>Ref. "+itemData[2]+"</p></div>";
                var dataCode    = "<div style='float:right;margin-right:6px;width:100px;'><div style='width:50%;float:left;margin-top:12px'></div><div  style='width:50%;float:left;margin-top:12px'></div></div>";
                var htmlOut     = dataId + dataPrice + dataCode;
               
                $(htmlOut).hide().prependTo("#offerList").fadeIn(700);
                
            },
            error:function(data){
             //  alert("Error: "+data);
           } 
        });
    }); 
    function printTransaktion() {
        var sum='';
        $('.orderCheckbox').each(function(){
            if ($(this).attr('data-selected')==='1') {
                sum += $(this).attr('data-order')+'|';
            }
        });
        
        if (sum.length > 0) {
         
            $.ajax({
                url: '/user/orders/printTransactions',
                type: 'post',
                dataType: 'html',
                data: 'data='+sum,
                async: false,
                success: function(data) {
                   window.open(data, '_blank');
                },
                error:function(data){
                 //  alert("Error: "+data);
               } 
            });
        }
    }
 

</script>
</body>
</html>