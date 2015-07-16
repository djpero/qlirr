<?php 


    $myMobile = Yii::app()->session['userIDm'];
    $user     = UsersDao::getUserByMobile($myMobile);
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
            </div>
            <div class="col-md-6 col-md-offset-3" style="padding-top:40px;">
              <div class="form-group" style="margin-bottom:2px">
                <label for="inputShopId" style="font-weight: 900;padding-left:10px;font-size:14px;padding-top:4px">Mottagare</label>
                <input type="tel" class="form-control addButik" id="inputShopId" placeholder="Mottagarnummer">
                
              </div>
              <div class="form-group" style="margin-top:20px">
                <label for="inputPrice" style="font-weight: 900;padding-left:10px;font-size:14px">Belopp</label>
                <input type="tel" class="form-control addKr" id="inputPrice" placeholder="0,00" style="font-size:50px;height:72px">
                
                <p style="font-size:12px;padding-left:8px">Totalt att betala: <span id="totalBetala" style="font-weight: 900">0,00 kr</span></p>
              </div>
              
            </div>
            
        </div>
            <div class="row" >
                <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                        <a onclick="saveOrder();" class="btn btn-primary btn-block btn-lg" style="font-size:26px;height:68px;padding-top:15px">Betala</a>
                    </div>
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
                $(this).attr('style', 'font-size:50px;height:72px');
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
    
    $('#inputPrice').keyup(function(event) {
        var a = $("#inputPrice").val();
        if (a>0) {
            var b = parseFloat(a)+29;
            $("#totalBetala").html(b.toFixed(2)+' kr');
        } else {
            $("#totalBetala").html('0,00 kr');
        }
    });
    
    $('#inputShopId').keydown(function(event) {
        // Allow special chars + arrows 
        if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 
            || event.keyCode == 27 || event.keyCode == 110 || event.keyCode == 190
            || (event.keyCode == 65 && event.ctrlKey === true) 
            || (event.keyCode >= 35 && event.keyCode <= 39)){
                $(this).attr('style', '');
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
        if (checkPrice(a)) {
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
                            $('#inputShopId').attr('style', 'border-color:red;');
                            $('#inputShopId').focus();
                        } else if (dataS[1]==='over500') {
                            $('#inputPrice').attr('style', 'border-color:red;font-size:50px;height:72px');
                            $('#inputPrice').focus();
                        } else if (dataS[1]==='creditlow') {
                            $('#inputPrice').attr('style', 'border-color:red;font-size:50px;height:72px');
                            $('#inputPrice').focus();
                        }
                    } else if ( dataS[0]==="#ok") {
                        window.location = '/site/receipt';

                    }
                },
                error:function(data){
                   alert("Error: "+data);
               } 
            });
        } else {
                $('#inputPrice').attr('style', 'border-color:red;font-size:50px;height:72px');
                $('#inputPrice').focus();
        }
    }
    function checkPrice(price) {
        if (price>0) {
            return true;
        } else {
            return false;
        }
    }

</script>
</body>
</html>