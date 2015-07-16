<!DOCTYPE html>

<?php
     $orderStatus = OrderStatusDao::getAllStatuses('1');
?>
<html>
<head>
<title>Qlirr Admin Area</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8"> 
<!-- Bootstrap -->
<link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/thin-admin.css" rel="stylesheet" media="screen">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/font-awesome.css" rel="stylesheet" media="screen">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/style/style.css" rel="stylesheet">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/style/dashboard.css" rel="stylesheet">

<link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/demo_page.css" rel="stylesheet">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/demo_table.css" rel="stylesheet">
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<div class="container">
  <div class="top-navbar header b-b"> <a data-original-title="Toggle navigation" class="toggle-side-nav pull-left" href="#"><i class="icon-reorder"></i> </a>
    <div class="brand pull-left"> <a href="/admin/default"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/gfx/logoNew.png"></a></div>
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
            <?php  DefaultController::printMenu(4); ?>
       </ul>
    </div>
  </div>
  <div class="page-content">
    <div class="content container">
      <div class="row">
       <div class="col-lg-12">
            <div class="col-lg-6"><h2 class="page-title">Orders</h2></div>
            <div class="col-lg-6"><h2 class="page-title" style="text-align:right"><span id="tmrWatch"></span></h2></div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="widget">
            <div class="widget-header"> <i class="icon-table"></i>
              <h3>Package list</h3>
            </div>
            <div class="widget-content">
         
<div class="example_alt_pagination">
      <div id="container">
        <div class="full_width big"></div>
  <div id="demo">
      <div style="padding:20px; margin-bottom: 20px;background: rgba(0,0,0,0.2 ); border-radius: 6px;">
            
            <select id="packageSel" class="selectpicker" style="margin:5px;width:120px;height:30px;background-color: rgba(0,0,0,0.2);color:white;border:none">
                <?php   
                    $x=0;
                    while ($x < count($orderStatus))  {
                        echo '<option id="'.$orderStatus[$x]->id.'" value="'.$orderStatus[$x]->id.'">'.$orderStatus[$x]->name.'</option>';
                        $x++;
                    }
                ?>
            </select>
          
     
            <a onclick="getTableData();" class="btn btn-s-md btn-success btn-sm" href="#" style='vertical-align: 1px;margin:5px'>Update</a>
      </div>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
      <thead>
            <tr>
                <th class="hidden-xs" style="width:80px">ID</th>
                <th class="hidden-xs">Buyer</th>
                <th class="hidden-xs">Seller</th>
                <th class="hidden-xs">Article name</th>
                <th class="hidden-xs" style="width:180px">Tracking no</th>
                <th class="hidden-xs" style="width:140px" >Amount (kr)</th>
                <th class="hidden-xs" style="width:100px">Status</th>
                <th class="hidden-xs" style="width:140px">Date accepted</th>
                <th class="hidden-xs" style="width:140px">Due date</th>
            </tr>
        </thead>

       <!--ovdje ide container sa tabelom-->
       
      <tbody id="tableContainer"></tbody>

      <tfoot>
        <tr>
          <th> </th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          </tr>
        </tfoot>
  </table>
    </div>
        
        
      
        </div>
    </div>
    
    
            </div>
          </div>
        </div>
      </div>
      
      
      
      
      
    </div>
  </div>
</div>
<div class="bottom-nav footer"><?php    echo date('Y'); ?> &copy; Qlirr </div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/jquery.js"></script> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/smooth-sliding-menu.js"></script>


<script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
            $('#example').dataTable( {
                    "sPaginationType": "full_numbers"
            } );
    } );
    
    startTime();

    function startTime()
    {
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

    function checkTime(i)
    {
    if (i<10)
      {
      i="0" + i;
      }
    return i;
    }
    var giCount = 1;                    
    function getTableData() {
        var optionId = $("#packageSel option:selected").attr("id");
        $('#example').dataTable().fnClearTable();
        $.ajax({
            url: "/admin/default/getOrdersTableData",
            type: "post",
            dataType: 'html',
            data: "data="+optionId,
            success: function(data){
                 var outputData=data.split("|");
                 var x=0;  
                 
                 do{
                  var y=(x*9);
                  var a = $('#example').dataTable().fnAddData([
                       outputData[y+1],
                       outputData[y+2],
                       outputData[y+3],
                       outputData[y+4],
                       outputData[y+5],
                       outputData[y+6],
                       outputData[y+7],
                       outputData[y+8],
                       outputData[y+9]
                   ]);
                        
                        var nTr = $('#example').dataTable().fnSettings().aoData[a[0]].nTr;
                        nTr.className = nTr.className+ " gradeA";

                        giCount++;
                        x++;

                   }while( x < outputData[0] );
                 
            },
            error:function(data){
                alert('error');

            }
        });  
        
        
        
    }
</script>




</body>
</html>
