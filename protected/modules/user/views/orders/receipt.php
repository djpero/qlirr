<?php 
    $orderID = $_GET['id'];

    $shopId   = Yii::app()->session['userIDm'];
    $myPass   = Yii::app()->session['userIDp'];
    $shop     = ShopsDao::getShopById($shopId);
    if (isset(Yii::app()->session['userIDm'])) {
        if (isset(Yii::app()->session['userIDp'])) {
            if ($shop->password !== $myPass) {
                $this->redirect('/user/login');
            } else {
                if (isset($_GET['id'])) {
                    $order = OrdersDao::getOrderAllById($orderID);
                    $shopBank = ShopBankDao::getBankByUserId($order->seller_id);
                } else {
                    $this->redirect('/user/orders');
                }
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Klirrr</title>

    <!-- Bootstrap core CSS -->
    <link href="/themes/frontend/css/bootstrap.min.css" rel="stylesheet">
    <link href="/themes/frontend/css/bootstrap-theme.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900' rel='stylesheet' type='text/css'>
    <link href='http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.css' rel='stylesheet' type='text/css'>

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
  </head>
<!-- NAVBAR
================================================== -->
<body class="full">
    <input id="myPass" hidden value="<?php echo $myPass;?>" />
    <input id="inputUser" hidden value="<?php echo $shop->shop_id;?>" />
    <input id="inputOrder" hidden value="<?php echo $order->id;?>" />
    <div class="container" style='width:100%'>
        <div id="stickyribbon" class="col-md-12 sticky" >
            <div class="row">
                <div class="col-xs-10" align="left" style="padding-left:3px;padding-right:0px;padding-top: 5px">
                    <img src="/themes/frontend/gfx/logo90.png" style='float:left;margin-right:14px'/>
                     <p style="font-size:14px;color:#777;margin-bottom: 0px;font-weight: 900;margin-top:6px"><span style="font-weight: 400;color:#999">Butik: </span><?php echo $shop->name ?></p>
                     <p style="font-size:14px;color:#777;font-weight: 900"><span style="font-weight: 400;color:#999">Butiks-ID: </span><?php echo $shop->shop_id ?></p>
                </div>
                <div class="col-xs-2 mobileMenuIcon" align="right">
                    <i class="fa fa-bars" onclick="showMenu();" style="margin-top:11px"></i>
                </div>
            </div>
        </div>
    </div>
    <div id="content" class="full " style="padding-top:78px;">
     <div class="container" style="height:100%;width:100%">
       <div id="test1"  class="row">
           
           <div class="col-md-12 headerinfo" style="vertical-align: middle">

                   <div class='col-md-8 col-md-offset-2'>
                       <p id="pcountOrdersR" style='margin-top:0px;padding-top:16px'>Betalningen är <span style="font-weight:900">Godkänd.</span></p>
                        <p id="infotext" style="margin-top:0px!important">Referens <?php echo $order->code ?> </p>
                        <div id="receiptIcon"><i class="fa fa-check-circle" ></i></div>
                        <div class='col-xs-6'>
                            <p  class="receiptInfo" >Varubelopp:</p>
                            <p  class="receiptInfo" >Faktureringsavgift:</p>
                            <p  class="receiptInfo" >Totalt:</p>
                        </div>
                        <div class='col-xs-6'>
                            <p class="receiptInfoleft" ><?php echo number_format( $order->price, 2, ",", "."); ?> kr</p>
                            <p class="receiptInfoleft"><?php echo number_format( $order->fee, 2, ",", "."); ?> kr</p>
                            <p class="receiptInfoleft" style="font-weight:900"><?php echo number_format( $order->total_amount, 2, ",", "."); ?> kr</p>
                        </div>
                   </div>

           </div>
           <div class="col-md-8 col-md-offset-2" style="padding-left:0px;">
               <i class="fa fa-caret-down" style="position: relative;top:-33px;color:#5cc6fe;font-size:80px"></i>
               <p style="font-size:18px;font-weight: 900; color:#444;padding-left:22px;position:relative;top:-24px;">Ta emot betalning</p>
           </div>
           <div class="col-md-8 col-md-offset-2" style="padding-top:0px;">
               <div id="offerList" style="margin-top:0px;z-index:-1;margin-left:22px;margin-right:22px" >
                   <p id="textRemove" style="text-align:center;font-size:14px;margin-top:20px">Listan uppdateras om 2 sekunder</p>
                                         <!--OVDJE IDE JSON RESPONSE-->
               </div>
           </div>
       </div>
      </div>
    </div>
    <div onclick='closeMenu()' class="blackMenu"></div>
    <div id="mobileMenu" class="mobileMenu" data-tag="0">
        <div align='right' style='margin-bottom: 30px'><p style='margin-right:14px;font-weight:300;font-size:28px;line-height:48px;cursor:pointer' onclick='closeMenu()'><i class="fa fa-times"></i> </p></div>
        <div style="margin-bottom:4px;margin-left:14px"> <a href="/user/orders" class="active">Ta emot betalning</a></div>
        <div style="margin-bottom:4px;margin-left:14px"> <a href="/user/orders/transactions">Transaktionshistorik</a></div>
        <div style="margin-bottom:4px;margin-left:14px"> <a href="/user/orders/invoices">Fakturor</a></div>
        <div style="margin-bottom:4px;margin-left:14px"> <a href="/user/profile">Profil</a></div>
        <div style="margin-bottom:4px;margin-left:14px"> <a href="/user/profile/logout">Logga ut</a></div>

    </div>
    

    <div class="modal fade" id="offerYesNo" tabindex="-1" role="dialog" aria-labelledby="enter-pin-label" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="">Avbryta affär</h4>
          </div>
          <div class="modal-body">
            <div id="completePin"> 
                <p>Vill du avbryta affär</p>
                <div class="row">
                    <div class="col-md-2 offset2"></div>
                  <div class="col-md-4">
                    <a onclick="cancelOffer();" class="btn btn-primary btn-lg btn-block" id="submit-pin-btn">Ja</a>
                  </div>
                  <div class="col-md-4">
                    <a onclick="$('#offerYesNo').modal('toggle');" class="btn btn-danger btn-lg btn-block" id="submit-pin-btn">Nej</a>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="/themes/frontend/js/bootstrap.min.js"></script>
    <script src="/themes/frontend/js/application.js"></script>
<script>
    
 

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
    
    
    
    
    function removeP() {
        $("#textRemove").fadeOut("fast");
    }
    
    function refreshList() {
        var shopID      = document.getElementById("inputUser").value;
        
        $.ajax({
            url: '/user/orders/getList',
            type: 'post',
            dataType: 'json',
            data: 'data='+shopID,
            async: false,
            success: function(data) {

                jsoncount = countJson(data);
                $('#countOrders').text(jsoncount+ " nya");
                $('#pcountOrders').fadeIn("fast");
                if (jsoncount > 0) {
                    $("#textRemove").fadeOut("fast");
                    $.each(data, function(i, item) {
                        if($("#" + item.id).length === 0) {
                            if (item.status === '1') {
                                var dataId      = "<div onclick='openView(this)' id='"+item.id+"' class='row orderListHover' style='padding-bottom: 8px;padding-left:15px;padding-right:15px;cursor:pointer;color:#444'>";
                                var dataPrice   = "<p style='margin:4px;font-weight: 900;text-align:center;font-size:28px;text-shadow:0px 1px 1px white;margin-top:12px'>"+item.price+"</p>";
                                var dataCode    = "<p style='margin:4px;font-weight: 300;text-align:center;font-size:16px;color:#888;text-shadow:0px 1px 1px white'>Referens: <span style='font-weight:400'>"+item.code+"</span></p></div>";
                                var htmlOut     = dataId + dataPrice + dataCode;
                                $(htmlOut).hide().prependTo("#offerList").fadeIn(700);
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
</script>
</body>
</html>