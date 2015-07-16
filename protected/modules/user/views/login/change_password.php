<?php 


    $shop = Yii::app()->session['userIDm'];

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
    <link href="/themes/frontend/css/butik.css" rel="stylesheet">
    <link href="/themes/frontend/css/bootstrap-theme.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800,700,600,300' rel='stylesheet' type='text/css'>

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

     <input id="inputUser" hidden value="<?php echo $shop;?>" />

    <div id="content" class="full checkout">
      
      <div class="container" style="height:100%">

        <div class="row">
            <h1 style="text-align:center;font-size:27px;padding-top: 20px;padding-bottom: 20px;">Please change password for your security</h1>
            <div class="col-md-4 col-md-offset-4" style="padding-top:0px;">
              <div class="form-group" style="margin-bottom:2px">
                <label for="newPassword1" style="font-weight: 900;padding-left:10px;font-size:14px;padding-top:4px">Password</label>
                <input type="password" class="form-control" id="newPassword1" placeholder="New Password" style="font-style: normal" onkeydown="checkInput(this)"  onblur='checkPass(this);'>
              </div>
              <div class="form-group" style="margin-bottom:2px">
                <label for="newPassword2" style="font-weight: 900;padding-left:10px;font-size:14px;padding-top:4px">Repeat password</label>
                <input type="password" class="form-control" id="newPassword2" placeholder="Repeat Password" style="font-style: normal" onkeydown ="checkInput(this)" onblur='checkPass(this);'>
              </div>
              
            </div>
            
        </div>
            <div class="row" >
                <div class="col-md-4 col-md-offset-4" style="margin-top:26px">
                    <div class="form-group">
                        <a onclick="changePass();" class="btn btn-primary btn-block btn-lg">Save</a>
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
    
    function checkPass(id) {

        if ($("#"+id.id).val()==='') {
            $("#"+id.id).attr('style','border-color:red');
        }

    } 
    
    function checkInput(id) {
        $("#"+id.id).attr('style', 'border:2px solid rgba(0,0,0,0.2)');
    }
 
    function changePass() {
        
        var a = document.getElementById("newPassword1").value;
        var b = document.getElementById("newPassword2").value;
        var c = document.getElementById("inputUser").value;
        if (a === b) {
            $.ajax({
                url: '/user/login/changePass',
                type: 'post',
                dataType: 'html',
                data: 'data='+a+"|"+b+"|"+c,
                async: false,
                success: function(data) {
                   
                   var dataS = data.split("|");
                   if (dataS[0]==='#error') {
                       alert(dataS[1]);
                   } else if (dataS[0]==="#ok") {
                       window.location = dataS[1];
                   }
                },
                error:function(data){
                   alert("Error: "+data);
               } 
            });
        } else {
            $("#newPassword1").attr('style', 'border-color:red');
            $("#newPassword2").attr('style', 'border-color:red');
        }
    }


</script>
</body>
</html>