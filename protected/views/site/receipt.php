<?php 


    $myMobile = Yii::app()->session['userIDm'];
    $user     = UsersDao::getUserByMobile($myMobile);
    $tempCode = Yii::app()->session['code'];
    $order    = OrdersDao::getOrderById(Yii::app()->session['order']);
    $shop     = ShopsDao::getShopById(Yii::app()->session['shop']);
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
     <input id="myMobile" hidden value="<?php echo $myMobile;?>" />
     <input id="inputUser" hidden value="<?php echo $user->id;?>" />

    <div id="content" class="full checkout">
      
      <div class="container" style="height:100%">

        <div class="row">
            <div class="col-md-6 col-md-offset-3" style="padding-top:10px;border-bottom:2px solid #ddd;margin-bottom: 0px">
                <p style="font-size:22px;font-weight: 900"><?php echo $user->name. ' '. $user->surname; ?></p>
                <p style="font-size:15px;font-weight: 300">Saldo: <?php echo $user->creditLimit_remaining; ?> kr</p>
                <button class="btn btn-default" style="position:absolute; top:22px;right:15px;color:#999" onclick="location.href='/site/loginout'">Avsluta</button>
            </div>
        </div>
           <p style="text-align: center;color:#78A043;margin-top:20px"><i style="font-size:80px" class="fa fa-check-circle"></i></p>
        <div class="row">
            <div class="col-md-6 col-md-offset-3" style="padding-top:0px;padding-bottom:16px;border-bottom:2px solid #ddd;">
                <p style="text-align:center; font-weight: 900;margin-top:5px;font-size:24px">Betalningen är skickad</p>
                <p style="text-align:center;font-size:14px">och ska bekräftas av mottagaren.</p>
<!--                <p style="text-align:center;font-size:14px;color:#777">Direkten Ljura: <?php echo $shop->shop_id; ?></p>
                <p style="text-align:center;font-size:14px;color:#777">Referens: <?php echo $tempCode; ?></p>-->
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <p style="text-align:left;padding-left:15px;font-weight: 700;margin-top:20px;margin-bottom:0px;font-size:15px;color:#888">Totalt att betala</p>
                <p style="text-align:left;padding-left:15px;font-weight: 900;margin-top:0px;font-size:36px"><?php echo number_format($order->total_amount, 2, ',', '.'); ?> kr</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
            <p style="text-align:left;padding-left:15px;font-weight: 700;margin-top:20px;margin-bottom:0px;font-size:15px;color:#888">Mottagare: <span style="font-weight: 400"><?php echo $shop->shop_id; ?></span></p>
            <p style="text-align:left;padding-left:15px;font-weight: 700;margin-top:0px;font-size:15px;color:#888">Referensnr: <span style="font-weight: 400"><?php echo $order->code; ?></span></p>
            </div>
        </div>
        <div class="row" style="margin-bottom:30px">
            <div class="col-md-6 col-md-offset-3">
                <button class="btn btn-block btn-lg btn-primary" onclick="window.location='/site/checkout'">Ny betalning</button>
                
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
    <script src="/themes/frontend/js/application.js"></script>
<script>

    
    $('#inputPrice').keydown(function(event) {
        // Allow special chars + arrows 
        if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 
            || event.keyCode == 27 || event.keyCode == 110 || event.keyCode == 190
            || (event.keyCode == 65 && event.ctrlKey === true) 
            || (event.keyCode >= 35 && event.keyCode <= 39)){
                $(this).attr('style', 'background-color:rgba(255, 251, 171, 0.23);font-weight: 900;font-style: italic ');
                return;
        } else if (event.keyCode==13) {
            saveOrder();
        }else {
            // If it's not a number stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }

    });
    $('#inputShopId').keydown(function(event) {
        // Allow special chars + arrows 
        if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 
            || event.keyCode == 27 || event.keyCode == 110 || event.keyCode == 190
            || (event.keyCode == 65 && event.ctrlKey === true) 
            || (event.keyCode >= 35 && event.keyCode <= 39)){
                $(this).attr('style', 'font-style:italic');
                return;
        } else if (event.keyCode==13) {
            checkPhone();
        }else {
            // If it's not a number stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }
       
    });


    function saveOrder() {
        var a = document.getElementById("inputPrice").value;
        var b = document.getElementById("inputShopId").value;
        var c = document.getElementById("inputUser").value;
        
        $.ajax({
            url: '/site/checkoutSaveOrder',
            type: 'post',
            dataType: 'html',
            data: 'data='+a+"|"+b+"|"+c,
            async: false,
            success: function(data) {
                var dataS = data.split("|");
                if (dataS[0]==="#error") {
                    if (dataS[1]==='noshop') {
                        $('#inputShopId').attr('style', 'border-color:red');
                        $('#inputShopId').focus();
                    } else if (dataS[1]==='over500') {
                        $('#inputPrice').attr('style', 'border-color:red');
                        $('#inputPrice').focus();
                    } else if (dataS[1]==='creditlow') {
                        $('#inputPrice').attr('style', 'border-color:red');
                        $('#inputPrice').focus();
                    }
                } else if ( dataS[0]==="#ok") {
                    alert('receipt');
                }
            },
            error:function(data){
               alert("Error: "+data);
           } 
        });
    }


</script>
</body>
</html>