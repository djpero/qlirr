<?php 


    $myMobile = Yii::app()->session['userIDm'];
    $user     = UsersDao::getUserByMobile($myMobile);
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
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800,700,600,300' rel='stylesheet' type='text/css'>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

  </head>
<!-- NAVBAR
================================================== -->
<body>
    <input id="myMobile" hidden value="<?php echo $myMobile;?>" />
    <input id="inputUser" hidden value="<?php echo $user->id;?>" />
    <div id="content" class="vertical-align-center" style="border-bottom:none" align="center">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/gfx/login_logo.png" width="80" height="80"/>
        <div class="container "  align="center">
            
            <div class="row" >
                <div class="col-md-4 col-md-offset-4 " align="center">
                    <div class="backWhite">
                        <form>
                            <div class="form-group" style="margin-bottom:2px">
                                <label for="inputUserName">Butiksnamn</label></br>
                                <input type="text" class="form-control" id="inputUserName" placeholder="" style="font-style: normal;text-align:center;margin-bottom:10px">
                            </div>
                            <div class="form-group no-margin-bottom" style="margin-top:16px;margin-bottom: 30px">
                                <label for="inputPassword">Lösenord</label></br>
                                <input type="password"  class="form-control" id="inputPassword" placeholder="" style="font-style: normal;text-align:center">
                            </div>
                        </form>
                        <div class="form-group">
                            <button onclick="checkLogin();" class="btn btn-login">Logga in</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <footer class="login">
        <div class="footerFull">
            <p>© <?php echo date('Y'); ?> All Rights Reserved</p>
        </div>

    </footer>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="/themes/frontend/js/bootstrap.min.js"></script>

<script>

    
      $(document).ready(function(){
        $("input").keypress(function(e){
            if(e.which == 13) {
                checkLogin();
            }
        });
      });

    function checkLogin() {
        
        var a = document.getElementById("inputUserName").value;
        var b = document.getElementById("inputPassword").value;

        
        $.ajax({
            url: '/user/login/checkLogin',
            type: 'post',
            dataType: 'html',
            data: 'data='+a+"|"+b,
            async: false,
            success: function(data) {
               var dataS = data.split("|");
               if (dataS[0]==='#error') {
                   alert(dataS[1]);
               } else {
                   window.location = dataS[1];
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