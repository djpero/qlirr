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
                    $order = OrdersDao::getOrderById($orderID);
                    $buyer = UsersDao::getUserById($order->buyer_id);
                    if ($buyer->verification_document==='0') {
                        $modalStart = 1;
                    } else {
                        $modalStart = 0;
                    }
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
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900' rel='stylesheet' type='text/css'>

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
    <input id="inputModalStart" hidden value="<?php echo $modalStart;?>" />
    <input id="inputBuyer" hidden value="<?php echo $buyer->id;?>" />
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
                <div class='col-md-4 col-md-offset-4'>
                    <p id="infotextV" >Referens <?php echo $order->code ?> </p>
                    <p id="pcountOrdersV" ><?php echo number_format($order->total_amount, 2, ",", "."); ?> kr</span></p>
                    <button class='btn btn-primary btn-lg btn-block' onclick='order("approve");'>Godkänn</button>
                </div>
           </div>
           <div class="col-md-8 col-md-offset-2" style="padding-left:0px;">
               <i class="fa fa-caret-down" style="position: relative;top:-33px;color:#5cc6fe;font-size:80px"></i>
               <p style="font-size:18px;font-weight: 900; color:#444;padding-left:22px;position:relative;top:-24px;">Ta emot betalning</p>
           </div>
           <div class="col-md-8 col-md-offset-2" style="padding-top:0px;">
               <div id="offerList" style="margin-top:0px;z-index:-1;margin-left:22px;margin-right:22px" >
                   <p id="textRemove" style="text-align:center;font-size:14px;margin-top:20px">Listan uppdateras om 2 sekunder...</p>
                                         <!--OVDJE IDE JSON RESPONSE-->
               </div>
           </div>
       </div>
      </div>
    </div>
    <div onclick='closeMenu()' class="blackMenu"></div>
    <div id="mobileMenu" class="mobileMenu" data-tag="0">
        <div align='right' style='margin-bottom: 30px'><p style='margin-right:22px;font-weight:300;font-size:43px;line-height:54px;margin-top:10px;cursor:pointer' onclick='closeMenu()'><i class="fa fa-times"></i> </p></div>
        <div style="margin-bottom:4px;margin-left:14px"> <a href="/user/orders" class="active">Ta emot betalning</a></div>
        <div style="margin-bottom:4px;margin-left:14px"> <a href="/user/orders/transactions">Transaktionshistorik</a></div>
        <div style="margin-bottom:4px;margin-left:14px"> <a href="/user/orders/invoices">Fakturor</a></div>
        <div style="margin-bottom:4px;margin-left:14px"> <a href="/user/profile">Profil</a></div>
        <div style="margin-bottom:4px;margin-left:14px"> <a href="/user/profile/logout">Logga ut</a></div>

    </div>
    

    <div class="modal" id="documentModal" tabindex="-1" role="dialog" aria-labelledby="enter-pin-label" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="" style="font-weight:300"><span style="font-weight:900">Bekräfta</span> kundens identitet</h4>
          </div>
          <div class="modal-body" >

              <p style="text-align: left;margin-bottom: 10px;font-size:14px">Namn: <span style="font-weight:900"><?php echo $buyer->name.' '.$buyer->surname; ?></span></p>
              <p style="text-align: left;font-size:14px">Personnummer: <span style="font-weight:900"><?php echo $buyer->personal_number; ?></span></p>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3" align="left" style="margin-bottom:30px;padding-left:40px">
                        <p style="margin-bottom: 0px"><label onclick="enableSell();"><input style="transform: scale(1.4);margin-right:5px" type="radio" id="inputVerification1" name="inputVerify" value="2" /> Svenskt <span style="font-weight: 900">ID-kort</span> </label></p>
                        <p style="margin-bottom: 0px"><label onclick="enableSell();"><input style="transform: scale(1.4);margin-right:5px" type="radio" id="inputVerification2" name="inputVerify" value="3"  /> Svenskt <span style="font-weight: 900">Körkort</span> </label></p>
                        <p style="margin-bottom: 0px"><label onclick="enableSell();"><input style="transform: scale(1.4);margin-right:5px" type="radio" id="inputVerification3" name="inputVerify" value="1"  /> Svenskt <span style="font-weight: 900">Pass</span> </label></p>
                        <p style="margin-bottom: 0px"><label onclick="enableSell();"><input style="transform: scale(1.4);margin-right:5px" type="radio" id="inputVerification3" name="inputVerify" value="99"  /> ID-handling <span style="font-weight: 900">Ej godkänd</span> </label></p>
                    </div>

                </div>
              
                <div class="row">
                  <div class="col-md-8 col-md-offset-2">
                    <a onclick="verifyBuyer();" class="btn btn-primary btn-lg btn-block" id="submit-pin-btn" disabled="true">Bekräfta</a>
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
   
<script>


  $( document ).ready(function() {
      var a = document.getElementById('inputModalStart').value;
      if (a==='1') {
          $('#documentModal').fadeIn('fast');
      }
      
  });

  function enableSell() {
     $("#submit-pin-btn").attr('disabled', false);
  }
  
  function verifyBuyer() {
      var a = document.getElementById('inputBuyer').value;
      var b = $('input[name="inputVerify"]:checked').val();
      
      $.ajax({
            url: '/user/orders/verifyBuyer',
            type: 'post',
            dataType: 'html',
            data: 'data='+a+'|'+b,
            async: false,
            success: function(data) {
                if (data==='#ok') {
                    location.reload();
                }
               
            },
            error:function(data){
               alert("Error: "+data);
           } 
        });
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
    
    
    function order(action) {
        var a = document.getElementById("inputOrder").value;
        
         $.ajax({
            url: '/user/orders/orderAction',
            type: 'post',
            dataType: 'html',
            data: 'data='+a+"|"+action,
            async: false,
            success: function(data) {
                var dataS = data.split("|");
                if (dataS[0]==='#ok') {
                    window.location = '/user/orders/receipt/id/'+dataS[1];
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
    function getBack() {
        window.location = '/user/orders';
    }
</script>
</body>
</html>