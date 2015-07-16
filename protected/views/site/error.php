<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle='Qlirr - Error';
$this->breadcrumbs=array(
	'Error',
);
print_r($error);
?>
<title>Qlirr</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/bootstrap.css" rel="stylesheet" media="screen">
	<!-- Bootstrap Responsive -->
	<link href="<?php echo Yii::app()->theme->baseUrl; ?>/cms/css/style_frontend.css" rel="stylesheet" media="screen">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/style/style.css" rel="stylesheet">
        <meta http-equiv="Content-Type"
content="text/html;charset=UTF-8">
<style>

body {
    font-family:Lato!important;
    font-weight: 300;   
    font-size:16px;
    line-height: 120%;
}
    
</style>
<body>        
        <div style="height:100%;width:100%">   
            <div style="margin:0 auto;position:relative; top: 20%" align='center'>
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/gfx/logoNewBlack.png" alt="">   
                <p style='padding-top:20px;font-size:18px;padding-bottom:10px;'>Error <?php echo "#".$code; ?></p>
                <?php echo CHtml::encode($message); ?>
                <p style="color: #404040;padding-top:20px" id="lblCount">Redirecting in 5 sec.</p>
            </div>
                    
        </div>
     
</body>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bs/jquery.js"></script>
<script> 
var count=5;    
countDown(); 


function countDown(){  
    
    if (count <=1){  
       window.location = '/';  
    }else{  
     count--;  
       setTimeout("countDown()", 1000);
       document.getElementById("lblCount").innerHTML = "Redirect in "+ count+" sec...";
    } 
    
} 
    
</script>