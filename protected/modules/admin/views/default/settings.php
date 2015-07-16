<!DOCTYPE html>
<?php 

$valuebtnSms = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'smsEnabled'));
if ($valuebtnSms->setting_value=='0') {
    $stylebntSms='btn-danger';
    $textbtnSms = 'OFF';
} else {
    $stylebntSms='btn-success';
    $textbtnSms = 'ON';
}

$valuebtnRem = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'remindersEnabled'));
if ($valuebtnRem->setting_value=='0') {
    $stylebntRem='btn-danger';
    $textbtnRem = 'OFF';
} else {
    $stylebntRem='btn-success';
    $textbtnRem = 'ON';
}

$valueBisnode           = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'bisGateMinProc'));
$valuegrossTaxIncome    = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'bisGateMinIncome'));
$valuecreditLimit       = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'newUserCreditLimit'));
$valuecreditLimitS      = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'newUserCreditLimitS'));
$valuetimeReturnLimitS  = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'timeReturnLimitS'));
$listBanks              = ApplicationSettings::model()->findAllByAttributes(array('setting_type' => '101'));
$valueCancelOffer       = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'timecancelOffer'));


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
<link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>

<link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/demo_page.css" rel="stylesheet">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/demo_table.css" rel="stylesheet">
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->

</head>
<style>
    .errorDIV {
        position: absolute;
        top:0;
        left:0;
        width:100%;
        height:100%;
        background-color: rgba(245,20,20,0.8);
    }
    .errorDIV h1 {
        position:relative;
        font-weight: 300;
        font-size:70px;
        text-shadow: 1px 2px 1px black;
        text-align:center;
        top:35%;
    }
    .errorDIV p {
        position:relative;
        top:38%;
        text-align:center;
        text-shadow: 1px 0px 0px black;
        font-size:22px;
        font-weight:300;
    }
    
    
</style>


<body>
    <input id="inputID" value="" hidden />
    <input id="inputID2" value="" hidden />
    <input id="inputID3" value="" hidden />
    <input id="inputID4" value="" hidden />
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
        <?php  DefaultController::printMenu(8); ?>
      </ul>
    </div>
  </div>
  <div class="page-content">
    <div class="content container">
      <div class="row">
       <div class="col-lg-12">
            <div class="col-lg-6"><h2 class="page-title">Settings</h2></div>
            <div class="col-lg-6"><h2 class="page-title" style="text-align:right"><span id="tmrWatch"></span></h2></div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="widget">
            <div class="widget-header"> <i class="icon-table"></i>
              <h3>Settings list</h3>
            </div>
            <div class="widget-content">
                <!-------------------------------------------- SADRZAJ -------------------------------------------->
                <ul class="nav nav-tabs" id="myTab">

                    <li class="active"><a data-toggle="tab" href="#advanced">Advanced</a></li>
                    <li class=""><a data-toggle="tab" href="#reminders">Reminders</a></li>
                    <li class=""><a data-toggle="tab" href="#banks">Banks</a></li>
                    <li class=""><a data-toggle="tab" href="#service_fee">Service fee</a></li>

                </ul>
                <div class="tab-content" id="myTabContent">

                    <div id="advanced" class="tab-pane fade active in">
                         <table style="width:38%;margin-top:30px;">
                            <tr style="height:40px;">
                                <td >SMS messages:</td>
                                <td align="center" style="width:160px;font-weight: bold; padding-left:4px"><a onclick="btnClick(this.id);" id="btnSMS" class="btn btn-sm <?php echo $stylebntSms; ?>" value="<?php echo $valuebtnSms->setting_value; ?>"><?php echo $textbtnSms; ?></a></td> 
                              <td></td>
                            </tr>
                            <tr style="height:40px;">
                                <td >Reminders messages:</td>
                                <td align="center" style="width:160px;font-weight: bold; padding-left:4px"><a onclick="btnClick(this.id);" id="btnReminder" class="btn btn-sm <?php echo $stylebntRem; ?>" value="<?php echo $valuebtnRem->setting_value; ?>"><?php echo $textbtnRem; ?></a></td> 
                              <td></td>
                            </tr>
                             <tr  style="height:40px;">
                              <td >Bissnode min% user approvment:</td>
                              <td style="font-weight: bold; padding-left:4px"><input onblur="inputOut(this.id)" id="inputBisPerc" type="tel" class="form-control input-transparent" value="<?php echo $valueBisnode->setting_value ?>" style="text-align:right" /></td> 
                              <td></td>
                            </tr>
                             <tr  style="height:40px;">
                              <td >Bissnode min <i>GrossTaxEarnedInc</i>:</td>
                              <td style="font-weight: bold; padding-left:4px"><input onblur="inputOut(this.id)" id="inputBisGross" type="tel" class="form-control input-transparent" value="<?php echo $valuegrossTaxIncome->setting_value ?>" style="text-align:right" /></td> 
                              <td></td>
                            </tr>
                            <tr  style="height:40px;">
                              <td >New User Credit Limit <i>BUYER</i>:</td>
                              <td style="font-weight: bold; padding-left:4px"><input onblur="inputOut(this.id)" id="inputCreditLimit" type="tel" class="form-control input-transparent" value="<?php echo $valuecreditLimit->setting_value ?>" style="text-align:right" /></td> 
                              <td></td>
                            </tr>
                            <tr  style="height:40px;"> 
                              <td >Time for automatic offer cancel <i>BUYER</i> [h]:</td>
                              <td style="font-weight: bold; padding-left:4px"><input onblur="inputOut(this.id)" id="inputCancelOffer" type="tel" class="form-control input-transparent" value="<?php echo $valueCancelOffer->setting_value ?>" style="text-align:right" /></td> 
                              <td></td>
                            </tr>
                        </table>
                    </div>
                    <div id="reminders" class="tab-pane fade">
                        
                        <div style="margin:20px;margin-bottom: 35px" align="right">
                            <button id="btnnewPayin" data-backdrop="false" data-target="#myModal" data-toggle="modal" class="btn btn-s-md  btn-default btn-sm" type="button">New Reminder</button>
                        </div>
                         <div class="example_alt_pagination">
                            <div id="container">
                              <div class="full_width big"></div>
                        <div id="demo">
                          <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                            <thead>
                                <tr>
                                    <th class="hidden-xs">Name</th>
                                    <th class="hidden-xs">Days</th>
                                    <th class="hidden-xs" style="text-align:right">Value (kr)</th>
                                    <th class="hidden-xs">Valid from</th>
                                    <th class="hidden-xs">Action</th>
                                </tr>
                              </thead>
                            <tbody>

                                <?php
                                $x=0;
                                $reminders = RemiDao::getList();
                                while ($x < count($reminders))  
                                  {
                                    
                                      echo '<tr class="gradeA">'.
                                           '<td class="hidden-xs">'.$reminders[$x]->name.'</td>'.
                                           '<td class="hidden-xs">'.$reminders[$x]->value.'</td>'.
                                           '<td class="hidden-xs" style="text-align:right">'.$reminders[$x]->value2.'</td>'.
                                           '<td class="hidden-xs">'.$reminders[$x]->created_at.'</td>'.
                                           '<td class="hidden-xs"></td></tr>';
                                          
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
                    <div id="banks" class="tab-pane fade">
                        <table style="width:38%;margin-top:30px;">
                            <tr style="height:40px;">
                                <td >Handelsbanken:</td>
                                <td style="font-weight: bold; padding-left:4px"><input onblur="inputOut(this.id)" id="inputBank1" type="tel" class="form-control input-transparent" value="<?php echo $listBanks[0]->setting_value ?>" style="text-align:right" /></td> 
                              <td></td>
                            </tr>
                             <tr  style="height:40px;">
                              <td >Nordea:</td>
                              <td style="font-weight: bold; padding-left:4px"><input onblur="inputOut(this.id)" id="inputBank2" type="tel" class="form-control input-transparent" value="<?php echo $listBanks[1]->setting_value ?>" style="text-align:right" /></td> 
                              <td></td>
                            </tr>
                             <tr  style="height:40px;">
                              <td >SEB:</td>
                              <td style="font-weight: bold; padding-left:4px"><input onblur="inputOut(this.id)" id="inputBank3" type="tel" class="form-control input-transparent" value="<?php echo $listBanks[2]->setting_value ?>" style="text-align:right" /></td> 
                              <td></td>
                            </tr>
                            <tr  style="height:40px;">
                              <td >Swedbank:</td>
                              <td style="font-weight: bold; padding-left:4px"><input onblur="inputOut(this.id)" id="inputBank4" type="tel" class="form-control input-transparent" value="<?php echo $listBanks[3]->setting_value ?>" style="text-align:right" /></td> 
                              <td></td>
                            </tr>
                            <tr  style="height:40px;">
                              <td >Danske Bank:</td>
                              <td style="font-weight: bold; padding-left:4px"><input onblur="inputOut(this.id)" id="inputBank5" type="tel" class="form-control input-transparent" value="<?php echo $listBanks[4]->setting_value ?>" style="text-align:right" /></td> 
                              <td></td>
                            </tr>
                            <tr  style="height:40px;">
                              <td >Skandiabanken:</td>
                              <td style="font-weight: bold; padding-left:4px"><input onblur="inputOut(this.id)" id="inputBank6" type="tel" class="form-control input-transparent" value="<?php echo $listBanks[5]->setting_value ?>" style="text-align:right" /></td> 
                              <td></td>
                            </tr>
                            <tr  style="height:40px;">
                              <td >ICA Banken:</td>
                              <td style="font-weight: bold; padding-left:4px"><input onblur="inputOut(this.id)" id="inputBank7" type="tel" class="form-control input-transparent" value="<?php echo $listBanks[6]->setting_value ?>" style="text-align:right" /></td> 
                              <td></td>
                            </tr>
                        </table>
                    </div>
                    <div id="service_fee" class="tab-pane fade">
                        <div class="col-lg-12" style="padding-left:0; margin-top:30px;">
                            <div class="col-lg-6" style="padding-left:0">
                                <p style="font-size:20px;">Buyer service fee</p>
                            </div>

                            <div class="col-lg-6" align="right">
                                <button id="btnnewService" data-backdrop="false" data-id="3" data-target="#newServiceModal" data-toggle="modal" class="btn btn-s-md  btn-default btn-sm newBTN" type="button">New Service</button>
                            </div>
                         </div>
                        
                        

                        <div class="example_alt_pagination" style="margin-top:50px!important">
                            <div id="container">
                              <div class="full_width big"></div>
                        <div id="demo">
                          <table cellpadding="0" cellspacing="0" border="0" class="display" id="example3">
                            <thead>
                                <tr>
                                    <th class="hidden-xs">Service</th>
                                    <th class="hidden-xs">From</th>
                                    <th class="hidden-xs" >To</th>
                                    <th class="hidden-xs">Fixed</th>
                                    <th class="hidden-xs">Percent</th>
                                    <th class="hidden-xs">Action</th>
                                </tr>
                              </thead>
                            <tbody>

                                <?php
                                $y=0;
                                $servicesS = ServiceFeesDao::getServecesList(9);
                                while ($y < count($servicesS))  
                                  {
                                      $serviceName = ServiceDao::getServiceData($servicesS[$y]->service_id);
                                      echo '<tr class="gradeA">'.
                                           '<td class="hidden-xs">'.$serviceName->internal_name.'</td>'.
                                           '<td class="hidden-xs">'.$servicesS[$y]->from.'</td>'.
                                           '<td class="hidden-xs">'.$servicesS[$y]->to.'</td>'.
                                           '<td class="hidden-xs">'.$servicesS[$y]->fixed.'</td>'.
                                           '<td class="hidden-xs">'.$servicesS[$y]->percentage.'</td>'.
                                           '<td class="hidden-xs"><button data-id="'.$servicesS[$y]->id.'" type="button" class="btn btn-danger btn-xs delBTN" data-backdrop="false" data-target="#delModal" data-toggle="modal">Delete</button> '.
                                              '<button data-id="'.$servicesS[$y]->id.'" data-type="9" data-edit="'.$servicesS[$y]->from.'|'.$servicesS[$y]->to.'|'.$servicesS[$y]->fixed.'|'.$servicesS[$y]->percentage.'|'.'" type="button" class="btn btn-warning btn-xs editBTN" data-backdrop="false" data-target="#newServiceModal" data-toggle="modal">Edit</button>'.
                                              '</td></tr>';
                                          
                                      $y++;
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
                <!-------------------------------------------- SADRZAJ -------------------------------------------->
            </div>
          </div>
        </div>
      </div>
      
       <div style="display: none;" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal fade" id="myModal">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
                  <h4 id="myModalLabel" class="modal-title">New reminder</h4>
                </div>
                <div class="modal-body" >
                    <table style="width:520px;margin-top:10px;">
                        <tr style="height: <?php echo $tableHeight.'px' ?>;">
                          <td>Name:</td>
                          <td style="font-weight: bold"><input id="inputName" type="text" placeholder=""  onkeyup="checkInputVal('inputName')" style="width:97%;background-color: white;color:black;margin:3px;border: 1px solid #dee4ea;text-align:right"></td> 
                          <td></td>
                        </tr>
                        <tr style="height: <?php echo $tableHeight.'px' ?>;">
                          <td>Days</td>
                          <td style="font-weight: bold"><input id="inputDays" type="text" placeholder=""  onkeyup="checkInputVal('inputDays')" style="width:97%;background-color: white;color:black;margin:3px;border: 1px solid #dee4ea;text-align:right"></td> 
                          <td></td>
                        </tr>
                        <tr style="height: <?php echo $tableHeight.'px' ?>;">
                          <td>Value (kr)</td>
                          <td style="font-weight: bold"><input id="inputValue"  type="text" placeholder=""  onkeyup="checkInputVal('inputValue')" style="width:97%;background-color: white;color:black;margin:3px;border: 1px solid #dee4ea;text-align:right"></td> 
                          <td></td>
                        </tr>
                    </table>
                    
                </div>
                  
                <div class="modal-footer">
                    <div id="modalSave">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                        <button class="btn btn-primary" type="button" onclick="askYouSure(true);">Save&New</button>
                    </div>
                    <div id="modalAskSure" hidden>
                        <button class="btn btn-danger" type="button" data-dismiss="modal">No</button>
                        <button class="btn btn-success" type="button" onclick='saveNewReminder();'>Yes</button>
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
              <h4 id="delModalLabel" class="modal-title">Service fee confirmation</h4>
            </div>
            <div class="modal-body" >
                <p style="font-size:16px;text-align:center;color:red;font-weight: 300;margin-top:24px"> Are you sure to delete this service fee?</p>
                
            </div>
            <div class="modal-footer">
                <div id="modalAskSure" >
                    <button class="btn btn-danger" type="button" data-dismiss="modal">No</button>
                    <button class="btn btn-success" type="button" onclick="delService();">Yes</button>
                </div>
            </div>
           </div>
          <!-- /.modal-content --> 
         </div>
        <!-- /.modal-dialog --> 
     </div>  
        
    <!---------------------------------- MODAL service new CONFIRMATION ----------------------------------->
    <div  aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal fade" id="newServiceModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button  aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
              <h4 id="newModalLabel" class="modal-title">New service fee</h4>
            </div>
            <div class="modal-body" >
                <table style="width:520px;margin-top:10px;">
                        <tr style="height: <?php echo $tableHeight.'px' ?>;">
                          <td>From:</td>
                          <td style="font-weight: bold"><input id="inputNewFrom" type="text" placeholder=""  style="width:97%;background-color: white;color:black;margin:3px;border: 1px solid #dee4ea;text-align:right"></td> 
                          <td></td>
                        </tr>
                        <tr style="height: <?php echo $tableHeight.'px' ?>;">
                          <td>To:</td>
                          <td style="font-weight: bold"><input id="inputNewTo" type="text" placeholder=""   style="width:97%;background-color: white;color:black;margin:3px;border: 1px solid #dee4ea;text-align:right"></td> 
                          <td></td>
                        </tr>
                        <tr style="height: <?php echo $tableHeight.'px' ?>;">
                          <td>Fixed:</td>
                          <td style="font-weight: bold"><input id="inputNewFixed"  type="text" placeholder=""  onkeyup="checkInputVal('inputValue')" style="width:97%;background-color: white;color:black;margin:3px;border: 1px solid #dee4ea;text-align:right"></td> 
                          <td></td>
                        </tr>
                        <tr style="height: <?php echo $tableHeight.'px' ?>;">
                          <td>Percent:</td>
                          <td style="font-weight: bold"><input id="inputNewPercent"  type="text" placeholder=""  onkeyup="checkInputVal('inputValue')" style="width:97%;background-color: white;color:black;margin:3px;border: 1px solid #dee4ea;text-align:right"></td> 
                          <td></td>
                        </tr>
                    </table>
                
            </div>
            <div class="modal-footer">
                <div id="modalAskSure" >
                    <button class="btn btn-danger" type="button" data-dismiss="modal">No</button>
                    <button class="btn btn-success" type="button" onclick="newServiceSave();">Save</button>
                </div>
            </div>
           </div>
          <!-- /.modal-content --> 
         </div>
        <!-- /.modal-dialog --> 
     </div>  
      <!-------------------------- error DIV ------------------------------>
      <div id="errorDIV" class="errorDIV" hidden onclick="errBigClose()">
          <h1 id="errorDIVHeader"></h1>
          <p id="errorDIVDesc"></p>
          
      </div>
      
      
      <!-------------------------- error DIV ------------------------------>
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


<script type="text/javascript">
    $(document).ready(function() {
            $('#example').dataTable( {
                    "sPaginationType": "full_numbers"
            });
            $('#example1').dataTable( {
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
    function checkInputVal(element) {
        var vValu = document.getElementById(element).value;
        if(vValu!='') {
            $('#'+element).attr('style', 'width:97%;background-color: white;color:black;margin:3px;border: 1px solid #dee4ea;text-align:right');
        }
    }
    function checkInputValues() {
        var a = document.getElementById("inputName").value;
        var b = document.getElementById("inputDays").value;
        var c = document.getElementById("inputValue").value;
 
        var sumAll=0;
        if (a==='') {
            $('#inputName').attr('style','width:97%;background-color: #FF9191;color:black;margin:3px;border: 1px solid #dee4ea;text-align:right');
        } else {
            sumAll=sumAll+1;
        }
        if (b==='') {
            $('#inputDays').focus();''
        } else {
            sumAll=sumAll+1;
        }
        if (c==='') {
            $('#inputValue').attr('style','width:97%;background-color: #FF9191;color:black;margin:3px;border: 1px solid #dee4ea;text-align:right');
        } else {w
            sumAll=sumAll+1;
        }

        
       if (sumAll===3) {
           return true;
       } else {
           return false;
       }
   }
     function askYouSure(q) {
       if (checkInputValues()) {
            if (q) {
                 $('#modalSave').fadeOut('fast', function() {$('#modalAskSure').fadeIn('fast')});
            } else {
                $('#modalAskSure').fadeOut('fast', function() {$('#modalSave').fadeIn('fast')});
            }
       }
    }
    function btnClick(id) {
      var btn = $('#'+id);
      
      $.ajax({
            url: "/admin/default/btnSetValueToBase",
            type: "post",
            dataType: 'html',
            data: "data="+id+"|"+btn.attr('value'),
            success: function(data){
                var dataS = data.split("|");
                if(btn.attr('value')==="1") {

                    btn.removeClass('btn-success');
                    btn.addClass('btn-danger');
                    btn.text('OFF');
                    btn.attr('value','0');
                    errBig(dataS[0], dataS[1]);
                } else {

                    btn.removeClass('btn-danger');
                    btn.addClass('btn-success');
                    btn.text('ON');
                    btn.attr('value','1');
                    
                }
            },
            error:function(data){
                alert('Cannot set function! Error: '+data);
            }
        });
    }
    
       
    
     function inputOut(id) {
      var inputVal = $('#'+id);

      $.ajax({
            url: "/admin/default/inputSetValueToBase",
            type: "post",
            dataType: 'html',
            data: "data="+id+"|"+inputVal.val(),
            success: function(data){
                input.attr('value',data);
            },
            error:function(data){
                alert('Cannot set function! Error: '+data);
            }
        });
    }
    function closeModal() {
        $('#myModal').fadeOut('fast');
    }
    
    function errBig(header, desc) {
        $('#errorDIVHeader').html(header);
        $('#errorDIVDesc').html(desc);
        $('#errorDIV').fadeIn('fast');
    }
    function errBigClose() {
        $('#errorDIV').fadeOut('fast');
    }
    
    function saveNewReminder() {
        var a = document.getElementById("inputName").value;
        var b = document.getElementById("inputDays").value;
        var c = document.getElementById("inputValue").value;

        var sumAll = a + "|" + b + "|" + c;
        $.ajax({
                 url: "/admin/default/saveNewReminder",
                 type: "post",
                 dataType: 'html',
                 data: "data="+sumAll,
                 success: function(data){
                     closeModal();
                     
                 },
                 error:function(data){
                     alert('error');
                 }
             });
    }
    
    
   function newServiceSave() {
       
        var a = document.getElementById("inputNewFrom").value;
        var b = document.getElementById("inputNewTo").value;
        var c = document.getElementById("inputNewFixed").value;
        var d = document.getElementById("inputNewPercent").value;
        var type2 = document.getElementById("inputID4").value;
        var type = document.getElementById("inputID2").value;
        var sumAll = a + "|" + b + "|" + c + "|" + d;
   
        $.ajax({
                 url: "/admin/default/newServiceSave",
                 type: "post",
                 dataType: 'html',
                 data: "data="+sumAll+"|"+type+"|"+type2,
                 success: function(data){
//                    alert('ok: ' + data);
                    $('#newServiceModal').fadeOut('fast');
                    location.reload();
                 },
                 error:function(data){
                     alert('error: '+data);
                 }
             });
    }


       $(document).on("mousedown", ".delBTN", function() {
           document.getElementById("inputID").value = $(this).attr('data-id');
       });
       $(document).on("mousedown", ".newBTN", function() {
            document.getElementById("inputID2").value           = $(this).attr('data-id');
            document.getElementById("inputID4").value           = 'new';
            document.getElementById("inputNewFrom").value       = '';
            document.getElementById("inputNewTo").value         = '';
            document.getElementById("inputNewFixed").value      = '';
            document.getElementById("inputNewPercent").value    = '';
            
            if (document.getElementById("inputID2").value==='3') {
                
                $('#newModalLabel').html('New service fee - BUYER');
            } else if (document.getElementById("inputID2").value==='4'){
              
                $('#newModalLabel').html('New service fee - SELLER');
            } else {
                $('#newModalLabel').html('New service fee - BUYER CASH');
            }
       });
       $(document).on("mousedown", ".editBTN", function() {
           document.getElementById("inputID2").value = $(this).attr('data-type');
           document.getElementById("inputID3").value = $(this).attr('data-id');
           document.getElementById("inputID4").value = $(this).attr('data-id');
           var data = $(this).attr('data-edit');
           var dataS = data.split("|");
           document.getElementById("inputNewFrom").value        = dataS[0];
           document.getElementById("inputNewTo").value          = dataS[1];
           document.getElementById("inputNewFixed").value       = dataS[2];
           document.getElementById("inputNewPercent").value     = dataS[3];
           if (document.getElementById("inputID2").value==='3') {
                
                $('#newModalLabel').html('Edit service fee - BUYER');
            } else {
              
                $('#newModalLabel').html('Edit service fee - SELLER');
            }
       });
       
    function closeModal() {
        $('#delModal').fadeOut('fast');
    }
    function delService() {
      var inputID = document.getElementById("inputID").value;
        $.ajax({
            url: "/admin/default/delService",
            type: "post",
            dataType: 'html',
            data: "data="+inputID,
            success: function(data){
                if(data=='ok') {
                    closeModal();
                    location.reload();
                }
            },
            error:function(data){
                alert('error');
            }
        }); 
    }
    
    
</script>

</body>
</html>
