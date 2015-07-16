<?php
    /* @var $this SiteController */
?>
    <meta charset="utf-8">
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.10.0.min.js"></script>   
        <title>Qlirr Login</title>
        <link rel="icon" type="image/png" href="/favicon.png">
        <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css">
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.js"></script>

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/thin-admin.css" />

        <script>
           function goLogin() {
             document.forms["loginForm"].submit();
              
           }
        </script>
        
    <div class="cotainer" style="position:absolute;margin:auto;top: 0; left:0; right:0; bottom: 0;min-height: 470px;">
                 
    <form name="loginForm" action="/site/adminlogin" method="post">
    <div class="row-fluid" style="position:absolute;margin:auto;top: 30%; left:0; right:0; bottom: 0;" align="center">
        
        <img src="/themes/frontend/gfx/logoNew.png"/>
        <p style="font-weight:900;color:white;text-shadow: 0px 0px 3px black;font-size: 16px">shops</p>
        <div class ="row-fluid" style="padding-top:20px">
           <input class="form-control input-transparent" style="text-align:center;width:220px" name="username"  id="inputEmail" type="text" placeholder="E-mail">
        </div>
        <div class ="row-fluid" style="padding-top:2px">
              <input type="password" class="form-control input-transparent" style="width:220px;text-align:center;" name="password"  id="inputPass"  placeholder="Password">
        </div>
        <div class="row-fluid" style="padding-top:10px">
           <!-- <a style="font-size:16px; width:368px; height:20px; padding:16px;" class="buyProcessBuyButton" style="width:390px;" onclick="goLogin();" id="SubmitLink">Log in</a> -->
            <input class="btn btn-large btn-success" type="submit" value="Log in" style="width:220px">
        </div>
        <div class="row-fluid" style="padding-top:10px">
            <a style="font-size:16px; cursor:pointer">Forgot your password?</a>
        </div>
       
    </div>
    </form>
 
</div>
    <p style="position:fixed; right:15px;bottom:0px;font-weight: 700;color:white; text-shadow: 0px 0px 8px red;margin-top:50px;font-size:18px">TEST VERSION</p>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.js"></script>
    <script src="/themes/frontend/js/application.js"></script>
    <script src="/themes/frontend/js/jquery.cookie.js"></script>
    <script src="/themes/frontend/js/bootstrap.min.js"></script>