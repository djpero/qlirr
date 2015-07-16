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
                    $order = OrdersDao::getOrderFinishedById($orderID);
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
    <div id="content" class="full checkout">
     <div class="container" style="height:100%">
       <div class="row">
           <div class="col-md-6 col-md-offset-3" style="padding-top:10px;border-bottom:1px solid #e2e2e2;margin-bottom: 0px">
               <div class="row">
                   <div class="col-xs-10">
                        <p style="font-size:22px"><span style="font-weight: 900;">Ta emot betalning</p>
                        <p style="font-size:13px;font-weight: 400;color:#555">Referens: <?php echo $order->code ?></p>
                   </div>
                   <div class="col-xs-2 mobileMenuIcon" align="right">
                       <i class="fa fa-arrow-left" onclick="window.location='/user/orders/finished'"></i> 
                   </div>
                   
               </div>
           </div>
           
           <div class="col-md-6 col-md-offset-3" style="padding-top:0px;">
               
               <p id="orderPrice" style="text-align:center;margin-top:80px;margin-bottom:80px;font-size:60px;font-weight: 900"><?php  echo $order->total_amount;  ?>kr</p>
               <!--<p id="orderCode"  style="text-align:center;margin-bottom:20px;font-size:22px;font-weight: 400"><?php  echo $order->code;  ?></p>-->
               <button class="btn btn-lg btn-block btn-primary " onclick="orderStorno()">Storno</button>
               <button class="btn btn-lg btn-block btn-default " onclick="window.location='/user/orders/transactions'">Back</button>
               
           </div>
       </div>
      </div>
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

<script>
    function orderStorno() {
        var a = document.getElementById("inputOrder").value;
        
         $.ajax({
            url: '/user/orders/orderStorno',
            type: 'post',
            dataType: 'html',
            data: 'data='+a,
            async: false,
            success: function(data) {
                var dataS = data.split("|");
                if (dataS[0]==='#ok') {
                    window.location = '/user/orders/finished';
                }
            },
            error:function(data){
               alert("Error: "+data);
           } 
        });
    }
    function getBack() {
        window.location = '/user/orders/finished';
    }
</script>
</body>
</html>