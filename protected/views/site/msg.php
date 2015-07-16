
<!DOCTYPE html>
<?php 
$get = $_GET['id'];
if ($get=='seller') {
    $label = 'sälja';
} elseif ($get=='buyer') {
    $label = 'köpa';
} else {
    $this->redirect('/');
}
?>
<html lang="se">
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

    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700' rel='stylesheet' type='text/css'>

    <!-- [if ie 9]>
    <link href="css/ie9.css" rel="stylesheet">
    <![endif]-->

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
<head>
    
</head>
    <body>
        
        <div style="position:fixed; top:0; left:0;width:100%;height:100%; background: red; opacity:0.7;" align="center">
           
        </div>
        <div style="top: 16%;position:absolute;margin:0 auto; width:100%" align="center">
            <h1 style="color:white; font-size:80px;text-align:center;font-weight:900!important">Ooops!</h1>
            <h2 style="color:white;letter-spacing: 0;font-weight:300;font-size:24px">Du uppfyllde visst inte våra krav.</h2>
            <p style="font-size:16px;color:white;margin-top:20px">Anser du att vi gjort en felbedömning är du </br>välkommen att höra av dig till oss via</br> <b>support@peydo.com</b> </br>så ser vi gärna över ditt ärende en gång till.</p> 
            <img style="position:fixed;z-index:-1;top:0;right:0;left:0;min-width: 100%;min-height: 100%" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/gfx/msg.jpg"  onclick="closeDiv();">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/gfx/error_circle.png" style="cursor:pointer;margin-top:10px;margin-bottom:30px" onclick="returnHome();">
        </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="/themes/frontend/js/bootstrap.min.js"></script>
    <script src="/themes/frontend/js/application.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bs/html2canvas.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bs/jquery.plugin.html2canvas.js"></script>
  </body>
<script>
function returnHome() {
    window.location = "/";
}
</script>
</body>
</html>