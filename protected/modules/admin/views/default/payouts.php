<!DOCTYPE html>
<?php  
    $groupPayouts = PayoutsDao::getGroupList();
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
            <?php  DefaultController::printMenu(3); ?>
       </ul>
    </div>
  </div>
  <div class="page-content">
    <div class="content container">
      <div class="row">
       <div class="col-lg-12">
            <div class="col-lg-6"><h2 class="page-title">Payouts</h2></div>
            <div class="col-lg-6"><h2 class="page-title" style="text-align:right"><span id="tmrWatch"></span></h2></div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="widget">
            <div class="widget-header"> <i class="icon-table"></i>
              <h3>DataTable with Sorting</h3>
            </div>
            <div class="widget-content">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a data-toggle="tab" href="#notPaid">Not Paid</a></li>
                    <li class=""><a data-toggle="tab" href="#paid">Paid</a></li>
                </ul>

              <div class="tab-content" id="myTabContent">
                <div id="notPaid" class="tab-pane fade active in">  
                <div class="example_alt_pagination">
      <div id="container">
        <div class="full_width big"></div>
  <div id="demo">
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
      <thead>
        <tr>
          <th>ID</th>
          <th class="hidden-xs">Shop ID</th>
          <th class="hidden-xs">Shop Name</th>
          <th class="hidden-xs">Total Sum</th>
          <th class="hidden-xs">No. of order</th>
          <th class="hidden-xs">Action</th>
          </tr>
        </thead>
      <tbody>
       
          <?php
          $x=0;
          
          
          while ($x < count($groupPayouts))  
            {
                $shop   = ShopsDao::getShopById($groupPayouts[$x]->user_id);
                $sum    = PayoutsDao::getGroupSumPayouts($shop->id);
                $count  = PayoutsDao::getGroupCountPayouts($shop->id); 
                echo '<tr class="gradeA">'.
                     '<td class="hidden-xs"><a href="">'.$shop->id.'</a></td>'.
                     '<td class="hidden-xs"><a href="">'.$shop->shop_id.'</a></td>'.
                     '<td class="hidden-xs"><a href="">'.$shop->name.'</a></td>'.
                     '<td class="hidden-xs">'.$sum['mySum'].'</td>'.
                     '<td class="hidden-xs">'.$count['mySum'].'</td>'.
                     '<td align="right"><a  onclick="getTableData('.$shop->id.');" class="btn btn-success btn-sm" href="#">View</a></td></tr>';
                $x++;
            }
          
          ?>
        </tbody>
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
<!----------------------------------- OVDJE IDE PO ANALITICI ---------------------------------->
        <div class="example_alt_pagination" style="margin-top:100px">
            <div id="container">
                <div class="full_width big"></div>
                <div id="demo">
                    <table cellpadding="0" cellspacing="0" border="0" class="display" id="example2">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th class="hidden-xs">Verification code</th>
                                <th class="hidden-xs">Amount</th>
                                <th class="hidden-xs">Time</th>
                                <th class="hidden-xs">Select</th>
                            </tr>
                        </thead>
                        <tbody id="tableContainer"></tbody>
                        <tfoot>
                            <tr>
                              <th></th>
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
                <div style="margin-top:100px" align="right">
                   <button id="btnSel" class="btn btn-success" onclick="selectAll()" data-sel="1" style="margin-right:4px;">Select All</button>   
                   <button id="btnSel" class="btn btn-danger" onclick="determine()" data-sel="1">Pay!</button> 
                 </div>
    </div>
              
                  
                 <!----------------------------------ISPLACENO------------------------------------------->  
                 
                 
                   <div id="paid" class="tab-pane fade">

                       
                        <div class="example_alt_pagination">
                              <div id="container">
                                <div class="full_width big"></div>
                          <div id="demo">
                            <table cellpadding="0" cellspacing="0" border="0" class="display" id="example3">
                              <thead>
                                <tr>
                                  <th>ID</th>
                                  <th class="hidden-xs">Shop ID</th>
                                  <th class="hidden-xs">Shop Name</th>
                                  <th class="hidden-xs">Total Sum</th>
                                  <th class="hidden-xs">No. of order</th>
                                  <th class="hidden-xs">Time Paid</th>
                                  </tr>
                                </thead>
                              <tbody>

                                  <?php
                                  $x=0;
                                  $invoices = InvoiceDao::getAllInvoices();

                                  while ($x < count($invoices))  
                                    {
                                        $shop   = ShopsDao::getShopById($invoices[$x]->user_id);

                                        echo '<tr class="gradeA">'.
                                             '<td class="hidden-xs"><a href="">'.$shop->id.'</a></td>'.
                                             '<td class="hidden-xs"><a href="">'.$shop->shop_id.'</a></td>'.
                                             '<td class="hidden-xs"><a href="">'.$shop->name.'</a></td>'.
                                             '<td class="hidden-xs">'.$invoices[$x]->total_amount.'</td>'.
                                             '<td class="hidden-xs">'.$invoices[$x]->count.'</td>'.
                                             '<td class="hidden-xs">'.$invoices[$x]->time_created.'</td></tr>';
                                        $x++;
                                    }

                                  ?>
                                </tbody>
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
  </div>
</div>
    
    <!---------------------------------- MODAL PAYOUT CONFIRMATION ----------------------------------->
    <div  aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button onclick="closeModal();" aria-hidden="true" data-dismiss="modal" class="close" type="button" onclick="closeModal();">x</button>
              <h4 id="myModalLabel" class="modal-title">Payout confirmation <span id="modalTitle" style="font-weight: 900"></span></h4>
            </div>
            <div class="modal-body" >
<!--                <p >Payouts list: </p>
                <p id='payoutList' style='font-weight:700'></p>
                </br>
                <p>Total amount price: <span id='payoutTotal' style='font-weight:700'></span></p>
                <p>Total amount fee: <span id='payoutFee' style='font-weight:700'></span></p>-->
                
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-6">
                                <p style="font-weight: 700">Date and time: <span style="font-weight:400" id='payoutTime'>15.09.2014 15:60</span></p>
                                <p style="font-weight: 700">From account</p>
                                <select id="modalBankName" class="selectpicker" style="height:34px;padding:6px 12px;background-color: white;color:black;width:96%;border: 1px solid #ddd;-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);border-radius: 4px">
                                    <?php   
                                        $shopBank = BanksDao::getAll();
                                        $x=0;
                                        while ($x < count($shopBank))  {
                                            echo '<option id="'.$shopBank[$x]->id.'" value="'.$shopBank[$x]->id.'">'.$shopBank[$x]->full_name.'</option>';
                                            $x++;
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-xs-6">
                                <p style="font-weight: 700">No. invoice: <span style="font-weight: 400">5</span></p>
                                <p style="font-weight: 700">To account</p>
                                <p id="bankTo"></p>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-12">
                                <p style="font-size:18px;font-weight: 400;margin-top:10px;margin-bottom:0px;text-align:right">Total amount<br><span  style="font-weight: 800;font-size:24px;color:#555" id="payoutTotal"></span></p> 
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="modal-footer" style='margin-top:0px'>
                <div id="modalAskSure" >
                    <button class="btn btn-danger" type="button" data-dismiss="modal" onclick="closeModal();">Cancel</button>
                    <button class="btn btn-success" type="button" onclick="Pay();">Pay</button>
                </div>
            </div>
          </div>
          <!-- /.modal-content --> 
        </div>
        <!-- /.modal-dialog --> 
    </div>
    
    
    <input id="inputID" hidden>
    <input id="inputCheckedPayouts" hidden>
    
<div class="bottom-nav footer"><?php  echo date('Y'); ?> &copy; Qlirr </div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/jquery.js"></script> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/smooth-sliding-menu.js"></script>


<script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
    function selectAll() {
        var a = $("#btnSel").attr('data-sel');

        if (a==="0") {
            $('input:checkbox').prop('checked', false);
            $("#btnSel").attr('data-sel', '1');
            $("#btnSel").html('Select All');
        } else {
            $('input:checkbox').prop('checked', true);
            $("#btnSel").attr('data-sel', '0');
            $("#btnSel").html('Unselect All');
        }
    }
    
    function determine() {
        var selectedCh = '';
        $("input:checked").each(function() {
            var label = $(this);
            selectedCh = selectedCh + label.val() + ';';
        });
        sendCheck(selectedCh);
    }
    
    function closeModal() {
        $("#myModal").hide();
    }
    
    function sendCheck(selCh) {
        if(selCh.length==0) {
            alert('No selected transactions!');
        } else {
            document.getElementById("inputCheckedPayouts").value = selCh;
            var str = selCh.substring(0, selCh.length - 1);
            $.ajax({
                url: "/admin/default/selectedPayoutsCheck",
                type: "post",
                dataType: 'html',
                data: "data="+str,
                success: function(data){
                    var dataS = data.split("|");
                    $('#bankTo').text(dataS[0]);
                    $('#modalTitle').text(dataS[1]);
                    $('#payoutList').text(dataS[2]);
                    $('#payoutTotal').text(dataS[3]);
                    $('#payoutFee').text(dataS[4]);
                    $('#myModal').show();
                },
                error:function(data){
                    alert('error');
                }
            }); 
        }
    }
    
    function Pay() {
      var a     = document.getElementById("inputCheckedPayouts").value;
      var b     = $("#modalBankName option:selected").attr("id");
      $.ajax({
            url: "/admin/default/payoutPay",
            type: "post",
            dataType: 'html',
            data: "data="+a+"|"+b,
            success: function(data){
               if (data==='ok') {
                   $("#myModal").hide();
                   $('#example2').dataTable().fnClearTable();
               } else {
                   alert(data);
               }
            },
            error:function(data){
                alert('error');
            }
        });    
    }
    
    
    $(document).ready(function() {
        $('#example').dataTable( {
            "sPaginationType": "full_numbers"
        });
        $('#example2').dataTable( {
            "sPaginationType": "full_numbers"
        });
        $('#example3').dataTable( {
            "sPaginationType": "full_numbers"
        });
    });
    
    startTime();

    function startTime() {
        var today   = new Date();
        var h       = today.getHours();
        var m       = today.getMinutes();
        var s       = today.getSeconds();
        var datum   = today.getDate();
        var mjesec  = today.getMonth()+1;
        var godina  = today.getFullYear();
        // add a zero in front of numbers<10
        m           = checkTime(m);
        s           = checkTime(s);
        mjesec      = checkTime(mjesec);
        datum       = checkTime(datum);
        document.getElementById('tmrWatch').innerHTML=h+":"+m+":"+s+" <small>"+datum+"."+mjesec+"</small>";
        $('#payoutTime').html(godina+"-"+mjesec+"-"+datum+" "+h+":"+m+":"+s);

        t=setTimeout(function(){startTime()},500);
    }

    function checkTime(i) {
        if (i<10)
          {
          i="0" + i;
          }
        return i;
    }
    
    
    function getTableData(optionId) {
        
        $('#example2').dataTable().fnClearTable();
        $.ajax({
            url: "/admin/default/getPayoutsByShop",
            type: "post",
            dataType: 'html',
            data: "data="+optionId,
            success: function(data){
                 var outputData = data.split("|");
                 var x=0;  
                 do {
                    var y=(x*5);
                    var a = $('#example2').dataTable().fnAddData([
                       outputData[y+1],
                       outputData[y+2],
                       outputData[y+3],
                       outputData[y+4],
                       outputData[y+5]
                    ]);
                        var nTr = $('#example2').dataTable().fnSettings().aoData[a[0]].nTr;
                        nTr.className = nTr.className+ " gradeA";
                        x++;
                   } while (x<outputData[0]);
            },
            error:function(data){
                alert('error');
            }
        });  
    }
</script>

</body>
</html>
