<!DOCTYPE html>
<html>
<head>
<title>Qlirr Admin Area - SHOPS</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8"> 
<!-- Bootstrap -->
<link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/thin-admin.css" rel="stylesheet" media="screen">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/font-awesome.css" rel="stylesheet" media="screen">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/style/style.css" rel="stylesheet">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/style/dashboard.css" rel="stylesheet">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<div class="container">
  <div class="top-navbar header b-b"> <a data-original-title="Toggle navigation" class="toggle-side-nav pull-left" href="#"><i class="icon-reorder"></i> </a>
      <div class="brand pull-left"> <a href="/admin/default"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/gfx/logoNewMobile.png"></a> </div>
    <ul class="nav navbar-nav navbar-right  hidden-xs">
      <li class="dropdown user  hidden-xs"> <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <i class="icon-male"></i> <span class="username"><?php echo $this->user->name.' '.$this->user->surname; ?></span> <i class="icon-caret-down small"></i> </a>
        <ul class="dropdown-menu">
           
          <li><a href="/admin/default/logout"><i class="icon-key"></i> Log Out</a></li>
        </ul>
      </li>
    </ul>

  </div>
</div>
<div class="wrapper">
  <div class="left-nav">
    <div id="side-nav">
      <ul id="nav">
        <?php  DefaultController::printMenu(0); ?>
      </ul>
    </div>
  </div>
  <div class="page-content">
    <div class="content container">
      <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6"><h2 class="page-title">Dashboard <small>Statistics and more</small></h2></div>
            <div class="col-lg-6"><h2 class="page-title" style="text-align:right"><span id="tmrWatch"></span></h2></div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-3 col-xs-12 col-sm-6"> <a href="#" class="stats-container" onclick="document.location='/admin/default/payouts'">
              <div class="stats-heading"><i class="icon-signout"></i> Waiting payout</div>
              <div class="stats-body-alt"> 
               
                  <div class="text-center"><span class="text-top">kr</span><span id="spanTotalWaitingPayout">0</span></div>
                <small>to <span id="spanTotalWaitingPayoutCount"></span> shops</small> </div>
              <div class="stats-footer">more info</div>
              </a> </div>
            <div class="col-md-3 col-xs-12 col-sm-6"> <a href="#" class="stats-container">
              <div class="stats-heading"><i class="icon-signin"></i> WAITING PAYIN</div>
              <div class="stats-body-alt"> 
               
                <div class="text-center"><span class="text-top">kr</span><span id="spanTotalWaitingPayin">0</span></div>
                <small>from <span id="spanTotalWaitingPayinCount"></span> transactions</small> </div>
              <div class="stats-footer">more info</div>
              </a> </div>

            <div class="col-md-3 col-xs-12 col-sm-6"> <a href="#" class="stats-container">
              <div class="stats-heading"><i class="icon-paperclip"></i> Contracted Orders</div>
              <div class="stats-body-alt"> 
             
                <div class="text-center"><span class="text-top"></span><span id="spanTotalOrdersContractedCount">-</span></div>
                <small><span id="spanTotalOrdersContracted"></span> kr</small> </div>
              <div class="stats-footer">more info</div>
              </a> </div>
                <div class="col-md-3 col-xs-12 col-sm-6"> <a href="#" class="stats-container">
              <div class="stats-heading"><i class="icon-bell"></i> Late</div>
              <div class="stats-body-alt"> 
               
                  <div class="text-center"><span class="text-top"></span><span id="spanTotalOrdersNotPaidCount">-</span></div>
                <small><span id="spanTotalOrdersNotPaid"></span> kr</small> </div>
              <div class="stats-footer">more info</div>
              </a> </div>
          </div>
        </div>
      </div>
        
    <div class="row">
        <div class="col-md-12">
          <div class="row">

              <div class="col-md-3 col-xs-12 col-sm-6"> <a href="/admin/default/orderRemindersSend" class="stats-container">
              <div class="stats-heading"><i class="icon-barcode"></i> REMINDERS FOR SENDING</div>
              <div class="stats-body-alt"> 
               
                  <div class="text-center"><span class="text-top"></span><span id="spanTotalOrdersTrackingCount">-</span></div>
                <small><span id="spanTotalOrdersTracking"></span>&nbsp; </small> </div>
              <div class="stats-footer">more info</div>
              </a> </div>

          </div>

            
        </div>
      </div>

        <div class="row">
        <div class="col-md-12">
          <div class="row">
                

          </div>
        </div>
        </div>
        
    </div>
  </div>
</div>
<div class="bottom-nav footer"><?php  echo date('Y'); ?> &copy; Qlirr </div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/jquery.js"></script> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/smooth-sliding-menu.js"></script> 
<script class="include" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/javascript/jquery191.min.js"></script> 
<script class="include" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/javascript/jquery.jqplot.min.js"></script> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/select-checkbox.js"></script> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/to-do-admin.js"></script> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/assets/sparkline/jquery.sparkline.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/assets/sparkline/jquery.customSelect.min.js" ></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/assets/sparkline/sparkline-chart.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/assets/sparkline/easy-pie-chart.js"></script>


<!--switcher html start-->


<!--switcher html end--> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/assets/switcher/switcher.js"></script> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/assets/switcher/moderziner.custom.js"></script>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/assets/switcher/switcher.css" rel="stylesheet">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/assets/switcher/switcher-defult.css" rel="stylesheet">

<script type="text/javascript">
    
    setInterval("getData('totalAmountWaitingPayout','spanTotalWaitingPayout')", 2000); 
    setInterval("getData('totalAmountWaitingPayin','spanTotalWaitingPayin')", 2000);
    setInterval("getData('totalAmountOrdersContracted','spanTotalOrdersContracted')", 2000);
    setInterval("getData('totalAmountOrdersNotPaid','spanTotalOrdersNotPaid')", 2000);
    setInterval("getData('totalAmountOrdersNewTrackings','spanTotalOrdersTracking')", 2000);
    startTime();
    
    function getData(what, where) {
         $.ajax({
            url: "/admin/default/getData",
            type: "post",
            dataType: 'html',
            data: "data="+what,
            success: function(data){
                var datas = data.split("|");
                var rTotal = datas[0];
                if(rTotal.length==0) {
                   var rTotal = '0';
                }
                $('#'+where).text(rTotal);
                $('#'+where+'Count').text(datas[1]); 
            },
            error:function(data){
                $('#'+where).text('Error');
                $('#'+where+'Count').text('Err');
            }
        });
    }

    
    function startTime() {
        var today=new Date();
        var h=today.getHours();
        var m=today.getMinutes();
        var s=today.getSeconds();
        var datum = today.getDate();
        var mjesec = today.getMonth()+1;
        var godina = today.getYear();
        // add a zero in front of numbers<10
        m=checkTime(m);
        s=checkTime(s);
        document.getElementById('tmrWatch').innerHTML=h+":"+m+":"+s+" <small>"+datum+"."+mjesec+"</small>";
        t=setTimeout(function(){startTime()},500);
    }

    function checkTime(i) {
        if (i<10) {
          i="0" + i;
        }
        return i;
    }
</script>

</body>
</html>
