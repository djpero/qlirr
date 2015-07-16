<!DOCTYPE html>

<?php
     $reminderStatus = RemiDao::getList();
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
    <input id="inputID" hidden />
<div class="container">
  <div class="top-navbar header b-b"> <a data-original-title="Toggle navigation" class="toggle-side-nav pull-left" href="#"><i class="icon-reorder"></i> </a>
    <div class="brand pull-left"> <a href="/admin/default"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/gfx/logoNewMobile.png"></a></div>
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
              <h3>Reminders list for sending</h3>
            </div>
            <div class="widget-content">
         
<div class="example_alt_pagination">
      <div id="container">
        <div class="full_width big"></div>
  <div id="demo">
      <div style="padding:20px; margin-bottom: 20px;background: rgba(0,0,0,0.2 ); border-radius: 6px;">
            
            <select id="reminderSel" class="selectpicker" style="margin:5px;width:120px;height:30px;background-color: rgba(0,0,0,0.2);color:white;border:none">
                <option id="0">For sending</option>
                <option id="1">Sent</option>
                <option id="2">Canceled</option>
            </select>
          
     
            <a onclick="getTableData();" class="btn btn-s-md btn-success btn-sm" href="#" style='vertical-align: 1px;margin:5px'>Update</a>
      </div>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
      <thead>
            <tr>
                <th class="hidden-xs" style="width:80px">Order ID</th>
                <th class="hidden-xs">Name</th>
                <th class="hidden-xs">Address</th>
                <th class="hidden-xs">Name</th>
                <th id="dateLBL" class="hidden-xs" style="width:180px">Date created</th>
                <th class="hidden-xs" style="width:140px">Action</th>

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
    
    
     <!---------------------------------- MODAL PAYIN DELETE CONFIRMATION ----------------------------------->
    <div  aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal fade" id="sendModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
              <h4 id="delModalLabel" class="modal-title">Reminder confirmation</h4>
            </div>
            <div class="modal-body" >
                <p style="font-size:16px;text-align:center;font-weight: 300;margin-top:24px"> Are you sure to send this reminder?</p>
                
            </div>
            <div class="modal-footer">
                <div id="modalAskSure" >
                    <button class="btn btn-danger" type="button" data-dismiss="modal">No</button>
                    <button class="btn btn-success" type="button" onclick="sendReminder();">Yes</button>
                </div>
            </div>
           </div>
          <!-- /.modal-content --> 
         </div>
        <!-- /.modal-dialog --> 
     </div>
    
          <!---------------------------------- MODAL PAYIN DELETE CONFIRMATION ----------------------------------->
    <div  aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal fade" id="delModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button onclick="closeModal();" aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
              <h4 id="delModalLabel" class="modal-title">Reminder confirmation</h4>
            </div>
            <div class="modal-body" >
                <p style="font-size:16px;text-align:center;color:red;font-weight: 700;margin-top:24px"> Are you sure to cancel this reminder?</p>
                
            </div>
            <div class="modal-footer">
                <div id="modalAskSure" >
                    <button class="btn btn-danger" type="button" data-dismiss="modal">No</button>
                    <button class="btn btn-success" type="button" onclick="cancelReminder();">Yes</button>
                </div>
            </div>
           </div>
          <!-- /.modal-content --> 
         </div>
        <!-- /.modal-dialog --> 
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
        var optionId = $("#reminderSel option:selected").attr("id");
        if (optionId==1) {
            $('#dateLBL').html('Date sent');
        } else if(optionId ==2) {
            $('#dateLBL').html('Date canceled');
        } else {
             $('#dateLBL').html('Date created');
        }
        $('#example').dataTable().fnClearTable();
        $.ajax({
            url: "/admin/default/getRemindersForSendTableData",
            type: "post",
            dataType: 'html',
            data: "data="+optionId,
            success: function(data){
                 var outputData=data.split("|");
                 var x=0;  
                 
                 do{
                  var y=(x*6);
                  var a = $('#example').dataTable().fnAddData([
                       outputData[y+1],
                       outputData[y+2],
                       outputData[y+3],
                       outputData[y+4],
                       outputData[y+5],
                       outputData[y+6]

                   ]);
                        var nTr = $('#example').dataTable().fnSettings().aoData[a[0]].nTr;
                        nTr.className = nTr.className+ " gradeA";
                        giCount++;
                        x++;
                   }while( x < outputData[0] );
                 
            },
            error:function(data){
                alert('error: '+data);

            }
        });  
        
        
        
    }
    $(document).on("mousedown", ".sendBTN", function() {
        document.getElementById("inputID").value = $(this).attr('id');
    });
    $(document).on("mousedown", ".canBTN", function() {
        document.getElementById("inputID").value = $(this).attr('id');
    });
    function sendReminder() {
       
        var a = document.getElementById("inputID").value;
 
        $.ajax({
            url: "/admin/default/reminderSend",
            type: "post",
            dataType: 'html',
            data: "data="+a,
            success: function(data){
               closeModal();
               location.reload();
            },
            error:function(data){
                alert('error: '+data);
            }
        });
    
    }
    
    function cancelReminder() {
       
        var a = document.getElementById("inputID").value;
 
        $.ajax({
            url: "/admin/default/cancelreminderSend",
            type: "post",
            dataType: 'html',
            data: "data="+a,
            success: function(data){
               closeModal();
               location.reload();
            },
            error:function(data){
                alert('error: '+data);
            }
        });
    
    }
    
     function closeModal() {
        $('#sendModal').fadeOut('fast');
    }
</script>




</body>
</html>
