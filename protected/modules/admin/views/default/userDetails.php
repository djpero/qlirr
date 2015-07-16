<!DOCTYPE html>

<?php
    $user = UsersDao::getUserById($_GET['id']);
    $userAddressBilling = UserAddressDao::getPrimaryAddressByTypeAndUserId($user->id,0); // ovo je biling
    $userAddressShipping = UserAddressDao::getPrimaryAddressByTypeAndUserId($user->id,1); // ovo je biling
    $tableHeight = '25'; // in px
    $lastpin = SmsCodeTempDao::getLastPinByMobile($user->mobile_number);
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
    <input id="tel" value="<?php echo $user->mobile_number; ?>" hidden>
    <input id="inputUser" value="<?php echo $user->id; ?>" hidden>
    <input id="inputID" hidden>
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
            <?php  DefaultController::printMenu(1); ?>
       </ul>
    </div>
  </div>
  <div class="page-content">
    <div class="content container">
      <div class="row">
       <div class="col-lg-12">
            <div class="col-lg-6"><h2 class="page-title">User Details</h2></div>
            <div class="col-lg-6"><h2 class="page-title" style="text-align:right"><span id="tmrWatch"></span></h2></div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-9">
          <div class="widget">
            <div class="widget-header"> <i class="icon-user"></i>
              <h3><?php echo $user->name.' '.$user->surname;  ?></h3>
            </div>
            <div class="widget-content">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a data-toggle="tab" href="#basic">Basic information</a></li>
                    <li class=""><a data-toggle="tab" href="#purchases">Purchases</a></li>
                    <li class=""><a data-toggle="tab" href="#finance">Finance</a></li>
                    <li class=""><a data-toggle="tab" href="#documents">Documents</a></li>
                    <li class=""><a data-toggle="tab" href="#reports">Reports</a></li>
                </ul>

              <div class="tab-content" id="myTabContent">
                <div id="basic" class="tab-pane fade active in">
                    <table style="margin-top:30px;">
                        <tr style="height: <?php echo $tableHeight.'px' ?>;">
                          <td>Name:</td>
                          <td style="font-weight: bold"><?php echo $user->name; ?></td> 
                          <td></td>
                        </tr>
                        <tr style="height: <?php echo $tableHeight.'px' ?>;">
                          <td>Surname:</td>
                          <td style="font-weight: bold"><?php echo $user->surname; ?></td> 
                          <td></td>
                        </tr>
                        <tr style="height: <?php echo $tableHeight.'px' ?>;">
                          <td>Personal Number:</td>
                          <td style="font-weight: bold"><?php echo $user->personal_number; ?></td> 
                          <td></td>
                        </tr>

                        <tr style="height: <?php echo $tableHeight.'px' ?>;">
                          <td>Cell Phone Number:</td>
                          <td style="font-weight: bold"><?php echo $user->mobile_number; ?></td> 
                          <td></td>
                        </tr>
                        <tr style="height: <?php echo $tableHeight.'px' ?>;">
                          <td>Date of registration:</td>
                          <td style="font-weight: bold"><?php echo $user->create_at; ?></td> 
                          <td></td>
                        </tr>
                        <tr style="height: <?php echo $tableHeight.'px' ?>;">
                          <td>Billing address:</td>
                          <td style="font-weight: bold"><?php echo $userAddressBilling->street.', '.$userAddressBilling->post_code.' '.$userAddressBilling->city; ?></td> 
                          <td></td>
                        </tr>
                        <tr style="height: <?php echo $tableHeight.'px' ?>;">
                          <td>Shipping address:</td>
                          <td style="font-weight: bold"><?php echo $userAddressShipping->street.', '.$userAddressShipping->post_code.' '.$userAddressShipping->city; ?></td> 
                          <td></td>
                        </tr>
                         <tr style=" border-top:1px dotted white; height: <?php echo $tableHeight.'px' ?>;">
                          <td>Total credit limit:</td>
                          <td style="font-weight: bold"><?php echo number_format($user->credit_limit,2); ?>kr</td> 
                          <td><button id="btnIncLimB" class="btn btn-xs btn-success" onclick="showModal('b');">Increase limit</button></td>
                        </tr>
                        <tr style="height: <?php echo $tableHeight.'px' ?>;">
                          <td>Total credit remaining:</td>
                          <td style="font-weight: bold"><?php echo number_format($user->creditLimit_remaining,2); ?>kr</td> 
                        </tr>
                        <tr style="height: <?php echo $tableHeight.'px' ?>;">
                          <td>Total credit reserved:</td>
                          <td style="font-weight: bold"><?php echo number_format($user->creditLimit_reserved,2); ?>kr</td> 
                          <td></td>
                        </tr>
                        <tr style="height: <?php echo $tableHeight.'px' ?>;">
                          <td>Total credit expends:</td>
                          <td style="font-weight: bold"><?php echo number_format($user->creditLimit_expends,2); ?>kr</td> 
                          <td></td>
                        </tr>

                    </table>

                </div>
                <div id="purchases" class="tab-pane fade">
                  <div class="example_alt_pagination">
                    <div id="container">
                          <div class="full_width big"></div>
                    <div id="demo">
                      <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                        <thead>
                          <tr>

                            <th class="hidden-xs">Order ID</th>
                            <th class="hidden-xs">Seller</th>
                            <th class="hidden-xs">Amount</th>
                            <th class="hidden-xs">Article code</th>
                            <th class="hidden-xs">Status</th>
                            <th class="hidden-xs">Date accepted</th>
                            </tr>
                          </thead>
                        <tbody>

                            <?php
                            $x=0;
                            $orders = OrdersDao::getPurchasesByUser($user->id);

                            while ($x < count($orders))  
                              {
                                  $sellerID = ShopsDao::getShopById($orders[$x]->seller_id);
                                  $orderStatus = OrderStatusDao::getOrderStatus($orders[$x]->orderStatus_id);
                                  echo '<tr class="gradeA">'.
                                       '<td class="hidden-xs"><a href="">'.$orders[$x]->id.'</a></td>'.
                                       '<td class="hidden-xs"><a href="/admin/default/userDetails/id/'.$sellerID->id.'">'.$sellerID->name.'</a></td>'.
                                       '<td class="hidden-xs"><a href="">'.$orders[$x]->total_amount.'</a></td>'.
                                       '<td class="hidden-xs"><a href="/admin/default/orderDetails/id/'.$orders[$x]->id.'">'.$orders[$x]->code.'</a></td>'.
                                       '<td class="hidden-xs">'.$orderStatus->name.'</td>'.
                                       '<td class="hidden-xs">'.$orders[$x]->date_accepted.'</td></tr>';

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
                <div id="sales" class="tab-pane fade">
                  <div class="example_alt_pagination">
                    <div id="container">
                          <div class="full_width big"></div>
                    <div id="demo">
                      <table cellpadding="0" cellspacing="0" border="0" class="display" id="example2">
                        <thead>
                          <tr>

                            <th class="hidden-xs">Order ID</th>
                            <th class="hidden-xs">Buyer</th>
                            <th class="hidden-xs">Amount</th>
                            <th class="hidden-xs">Article code</th>
                            <th class="hidden-xs">Status</th>
                            <th class="hidden-xs">Action</th>
                            </tr>
                          </thead>
                        <tbody>

                            <?php
//                            $x=0;
//                            $ordersB = OrdersDao::getSalesByUser($user->id);
//                            
//                            while ($x < count($ordersB))  
//                              {
//                                  $buyerID = UsersDao::getUserById($ordersB[$x]->buyer_id);
//                                  $orderStatus = OrderStatusDao::getOrderStatus($orders[$x]->orderStatus_id);
//                                  echo '<tr class="gradeA">'.
//                                       '<td class="hidden-xs"><a href="">'.$ordersB[$x]->id.'</a></td>'.
//                                       '<td class="hidden-xs"><a href="/admin/default/userDetails/id/'.$buyerID->id.'">'.$buyerID->name.' '.$buyerID->surname.'</a></td>'.
//                                       '<td class="hidden-xs"><a href="">'.$ordersB[$x]->total_amount.'</a></td>'.
//                                       '<td class="hidden-xs"><a href="/admin/default/orderDetails/id/'.$ordersB[$x]->id.'">'.$ordersB[$x]->article_name.'</a></td>'.
//                                       '<td class="hidden-xs">'.$orderStatus->name.'</td>'.
//                                       '<td class="hidden-xs"><button class="btn btn-danger btn-xs chargeBTN" data-id="S|'.$ordersB[$x]->id.'" data-backdrop="false" data-target="#chargebackModal" data-toggle="modal">Chargeback</button></td></tr>';
//
//                                  $x++;
//                              }

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
                <div id="finance" class="tab-pane fade">
                    <div id="accordion2" class="panel-group">
                        <div class="panel">
                          <div class="panel-heading"> <a href="#collapseOne" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed"> Orders </a> </div>
                          <div style="height: 0px;" class="panel-collapse collapse" id="collapseOne">
                          <div class="panel-body">
                            <?php 
                                $ordersF  = OrdersDao::getPurchasesByUser($user->id);
                                $dV       = ApplicationSettings::model()->findAllByAttributes(array('setting_type' => 103));

                                $y=0;
                                while ($y < count($ordersF))  {
                                    $orderStatusF   = OrderStatusFDao::getOrderStatus($ordersF[$y]->orderStatusF_id);
                                    $payin          = PayinsDao::getPayinByOrderId($ordersF[$y]->id);
                                    $z=0;
                                    $remindersList  = '';
                                    $remindValue    = 0;
                                    if ($ordersF[$y]->penalityLevel>0) {
                                        $z=1;
                                        while ($z <= $ordersF[$y]->penalityLevel) {
                                            $remindValue   = ($remindValue+ $dV[0]->setting_value);
                                            $remindersList = $remindersList.' '.$z;
                                            $z++;
                                        }

                                    }  


                                    $printData      = '';
                                    $printData      = $printData.'<p style="font-size:18px;">Orders ID:<span style="font-weight:700"> '.$ordersF[$y]->id.'</span></p>';
                                    $printData      = $printData.'<table style="width:80%;border-bottom: 1px dotted gray;border-top: 1px dotted white;margin-bottom:30px;"><tr>';
                                    $printData      = $printData.'<td style="width:25%">Article code:</td>'; 
                                    $printData      = $printData.'<td>'.$ordersF[$y]->code.'</td>';  
                                    $printData      = $printData.'</tr>';
                                    $printData      = $printData.'<tr>';
                                    $printData      = $printData.'<td>Debt amount:</td>'; 
                                    $printData      = $printData.'<td>'.number_format(($ordersF[$y]->total_amount - $ordersF[$y]->penality),2).' kr</td>';  
                                    $printData      = $printData.'</tr>';
                                    $printData      = $printData.'<tr>';
                                    $printData      = $printData.'<td>Payment reference:</td>'; 
                                    $printData      = $printData.'<td>'.$ordersF[$y]->payment_reference.'</td>';  
                                    $printData      = $printData.'</tr>';
                                    $printData      = $printData.'<tr>';
                                    $printData      = $printData.'<td>Debt created:</td>'; 
                                    $printData      = $printData.'<td>'.$ordersF[$y]->time_created.'</td>';  
                                    $printData      = $printData.'</tr>';       
                                    $printData      = $printData.'<tr>';
                                    $printData      = $printData.'<td>Financial status:</td>'; 
                                    $printData      = $printData.'<td>'.$orderStatusF->name.'</td>';  
                                    $printData      = $printData.'</tr>'; 
                                    $printData      = $printData.'<tr>';
                                    $printData      = $printData.'<td>Reminders:</td>'; 
                                    $printData      = $printData.'<td>'.$remindersList.'</td>';  
                                    $printData      = $printData.'</tr>'; 
                                    $printData      = $printData.'<tr>';
                                    $printData      = $printData.'<td>Due date:</td>'; 
                                    $printData      = $printData.'<td>'.$orders[$y]->date_due_ext.'</td>';  
                                    $printData      = $printData.'</tr>'; 
                                    $printData      = $printData.'<tr>';
                                    $printData      = $printData.'<td>Due date reminder:</td>'; 
                                    $printData      = $printData.'<td>'.$ordersF[$y]->date_due.'</td>';  
                                    $printData      = $printData.'</tr>';
                                    $printData      = $printData.'<tr>';
                                    $printData      = $printData.'<td>Total to pay:</td>'; 
                                    $printData      = $printData.'<td>'.$ordersF[$y]->total_amount.' kr</td>';  
                                    $printData      = $printData.'</tr>'; 
                                    $printData      = $printData.'<tr>';
                                    $printData      = $printData.'<td>Paid:</td>'; 
                                    $printData      = $printData.'<td>'.number_format($ordersF[$y]->paid_amount,2).' kr</td>';  
                                    $printData      = $printData.'</tr>'; 
                                    $printData      = $printData.'<tr>';
                                    $printData      = $printData.'<td>To pay:</td>'; 
                                    $printData      = $printData.'<td>'.number_format(($ordersF[$y]->total_amount - $ordersF[$y]->paid_amount),2).' kr</td>';  
                                    $printData      = $printData.'</tr>'; 
                                    $printData      = $printData.'<tr>';
                                    $printData      = $printData.'<td>Last payment date:</td>'; 
                                    $printData      = $printData.'<td>'.$payin[0]->pay_date.'</td>';  
                                    $printData      = $printData.'</tr>'; 
                                    $printData      = $printData.'</table>';
                                    echo $printData;
                                    $y++;
                                }                        
                            ?>
                          </div>
                          </div>
                        </div>
                        <div class="panel">
                          <div class="panel-heading"> <a href="#collapseTwo" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed"> Chargebacks </a> </div>
                          <div class="panel-collapse collapse" id="collapseTwo" style="height: 0px;">
                            <div class="panel-body">
                                <?php 
//                                    $chargebacks  = ChargebackDao::getAllByUserId($user->id);
//                                    $dV           = ApplicationSettings::model()->findAllByAttributes(array('setting_type' => 103));
//
//                                    $y=0;
//                                    while ($y < count($chargebacks))  {
////                                        $orderStatusF   = OrderStatusFDao::getOrderStatus($ordersF[$y]->orderStatusF_id);
////                                        $payin          = PayinsDao::getPayinByOrderId($ordersF[$y]->id);
//                                        $order          = OrdersDao::getOrderById($chargebacks[$y]->order_id);
//                                        $orderStatusF   = OrderStatusFDao::getOrderStatus($order->orderStatusF_id);
//                                        $z=0;
//                                        $remindersList  = '';
//                                        $remindValue    = 0;
//                                        if ($chargebacks[$y]->penalityLevel > 0) {
//                                            $z=1;
//                                            while ($z <= $chargebacks[$y]->penalityLevel) {
//                                                $remindValue   = ($remindValue + $dV[0]->setting_value);
//                                                $remindersList = $remindersList.' '.$z;
//                                                $z++;
//                                            }
//
//                                        }  
//
//                                        $printData      = '';
//                                        $printData      = $printData.'<p style="font-size:18px;">Chargeback ID:<span style="font-weight:700"> '.$chargebacks[$y]->id.'</span></p>';
//                                        $printData      = $printData.'<table style="width:80%;border-bottom: 1px dotted gray;border-top: 1px dotted white;margin-bottom:30px;"><tr>';
//                                        $printData      = $printData.'<td style="width:25%">Article name:</td>'; 
//                                        $printData      = $printData.'<td>'.$order->article_name.'</td>';  
//                                        $printData      = $printData.'</tr>';
//                                        $printData      = $printData.'<tr>';
//                                        $printData      = $printData.'<td>Debt amount:</td>'; 
//                                        $printData      = $printData.'<td>'.$chargebacks[$y]->netto.' kr</td>';  
//                                        $printData      = $printData.'</tr>';
//                                        $printData      = $printData.'<tr>';
//                                        $printData      = $printData.'<td>Payment reference:</td>'; 
//                                        $printData      = $printData.'<td>'.$chargebacks[$y]->payment_reference.'</td>';  
//                                        $printData      = $printData.'</tr>';
//                                        $printData      = $printData.'<tr>';
//                                        $printData      = $printData.'<td>Debt created:</td>'; 
//                                        $printData      = $printData.'<td>'.$chargebacks[$y]->created_at.'</td>';  
//                                        $printData      = $printData.'</tr>';       
//                                        $printData      = $printData.'<tr>';
//                                        $printData      = $printData.'<td>Financial status:</td>'; 
//                                        $printData      = $printData.'<td>'.$orderStatusF->name.'</td>';  
//                                        $printData      = $printData.'</tr>'; 
//                                        $printData      = $printData.'<tr>';
//                                        $printData      = $printData.'<td>Reminders:</td>'; 
//                                        $printData      = $printData.'<td>'.$remindersList.'</td>';  
//                                        $printData      = $printData.'</tr>'; 
//                                        $printData      = $printData.'<tr>';
//                                        $printData      = $printData.'<td>Due date:</td>'; 
//                                        $printData      = $printData.'<td>'.$chargebacks[$y]->date_due_ext.'</td>';  
//                                        $printData      = $printData.'</tr>'; 
//                                        $printData      = $printData.'<tr>';
//                                        $printData      = $printData.'<td>Due date reminder:</td>'; 
//                                        $printData      = $printData.'<td>'.$chargebacks[$y]->date_due.'</td>';  
//                                        $printData      = $printData.'</tr>';
//                                        $printData      = $printData.'<tr>';
//                                        $printData      = $printData.'<td>Total to pay:</td>'; 
//                                        $printData      = $printData.'<td>'.$chargebacks[$y]->brutto.' kr</td>';  
//                                        $printData      = $printData.'</tr>'; 
//                                        $printData      = $printData.'<tr>';
//                                        $printData      = $printData.'<td>Paid:</td>'; 
//                                        $printData      = $printData.'<td>'.' kr</td>';  
//                                        $printData      = $printData.'</tr>'; 
//                                        $printData      = $printData.'<tr>';
//                                        $printData      = $printData.'<td>To pay:</td>'; 
//                                        $printData      = $printData.'<td>'.' kr</td>';  
//                                        $printData      = $printData.'</tr>'; 
//                                        $printData      = $printData.'<tr>';
//                                        $printData      = $printData.'<td>Last payment date:</td>'; 
//                                        $printData      = $printData.'<td>'.'</td>';  
//                                        $printData      = $printData.'</tr>'; 
//                                        $printData      = $printData.'</table>';
//                                        echo $printData;
//                                        $y++;
//                                    }                        
                                ?>
                            
                            
                            
                            </div>
                          </div>
                        </div>
                    </div>
                   
      
                </div>
                <div id="documents" class="tab-pane fade">
                    
                    <div class="example_alt_pagination">
                    <div id="container">
                          <div class="full_width big"></div>
                    <div id="demo">
                      <table cellpadding="0" cellspacing="0" border="0" class="display" id="example3">
                        <thead>
                          <tr>

                            <th class="hidden-xs">Order ID</th>
                            <th class="hidden-xs">Article code</th>
                            <th class="hidden-xs">Document name</th>
                            <th class="hidden-xs">Create time</th>
                            <th class="hidden-xs">Doc type</th>
                            </tr>
                          </thead>
                        <tbody>

                            <?php
                            $w=0;
                            $documents = DocumentsDao::getListAllDocumentsByUserId($user->id);
                            
                            while ($w < count($documents))  
                              {
                                  
                                  $docOrder = OrdersDao::getOrderFinishedById($documents[$w]->order_id);
                                  $docType = DocumentTypeDao::getDocumentTypeData($documents[$w]->documentType_id);
                                  if ($docType->id =='9') {
                                      if ($documents[$w]->type == 0) {
                                        $docStyle = 'red';
                                        $docPath  = 'FR';
                                        $docName  = 'Reminder';
                                      } else {
                                        $docStyle = 'red';
                                        $docPath  = 'CR'; 
                                        $docName  = 'Chargeback';
                                      }
                                  } else if ($docType->id==='11') {
                                      $docStyle = 'orange';
                                      $docPath  = 'CF';
                                      $docName  = 'Chargeback';
                                  } else {
                                      $docStyle = 'orange';
                                      $docPath  = 'ID';
                                      $docName  = 'Invoice';
                                  }
                                  echo '<tr class="gradeA">'.
                                       '<td class="hidden-xs"><a href="">'.$documents[$w]->order_id.'</a></td>'.
                                       '<td class="hidden-xs"><a href="">'.$docOrder->code.'</a></td>'.
                                       '<td class="hidden-xs"><a href="http://www.qlirr.com/Faktura/'.$docPath.$documents[$w]->name.'"><i class="icon-link"></i> '.$docName.$documents[$w]->name.'</a></td>'.
                                       '<td class="hidden-xs">'.$documents[$w]->created_date.'</td>'.
                                       '<td class="hidden-xs"><span style="color:'.$docStyle.';text-shadow: 0px 0px 2px black">'.$docType->name.'</span></td></tr>';
                                  $w++;
                              }
                              
                              // ----------------- ovdje treba da se doda chargeback lista ------------------
                              
                              
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
                  <div id="reports" class="tab-pane fade"> 
                      <div class="container">
                        <?php
                                $instantor = InstantorXmlDao::getInstantorDataBySsnOk($user->personal_number);
                                if (count($instantor)) {
                                    $returnData = 'Instantor';
                                    echo '<p style="float:left;margin-right:6px"><button class="btn btn-large btn-danger reportBTN"  data-type="0" data-backdrop="false" data-target="#reportModal" data-toggle="modal">Teleaddress</button></p>';
                                    echo '<p style="float:left;margin-right:6px;display:none"><button class="btn btn-large btn-success reportBTN" data-type="1" data-backdrop="false" data-target="#reportModal" data-toggle="modal"  >Instantor</button></p>';
                                    echo '<p style="float:left;margin-right:6px"><button class="btn btn-large btn-success reportBTN" data-type="2" data-backdrop="false" data-target="#reportModal" data-toggle="modal">Bissnode</button></p>';
                                } else {
                                    echo '<p style="float:left;margin-right:6px"><button class="btn btn-large btn-success reportBTN"   data-type="0" data-backdrop="false" data-target="#reportModal" data-toggle="modal">Teleaddress</button></p>';
                                    echo '<p style="float:left;margin-right:6px;display:none"><button class="btn btn-large btn-danger reportBTN"    data-type="1" data-backdrop="false" data-target="#reportModal" data-toggle="modal" >Instantor</button></p>';
                                    echo '<p style="float:left;margin-right:6px"><button class="btn btn-large btn-success reportBTN"   data-type="2" data-backdrop="false" data-target="#reportModal" data-toggle="modal">Bissnode</button></p>';
                                }
                                
                        
                        ?>
         
                      </div>
                  </div>
              </div>
                
                
            </div>
          </div>
        </div>
        <div class="col-lg-3">
            <div class="widget">
                <div class="widget-header"> <i class=" icon-phone"></i>
                    <h3>Send SMS</h3>
                </div>
                <div class="widget-content">
                    <textarea id="smsBody" style="width:100%;margin-bottom:9px" rows="5" maxlength="160"></textarea>
                    <div class="col-lg-8">
                        <p id="charsLeft" style="font-size:12px;margin-top:6px">Characters left <strong>160</strong></p>
                    </div>
                    <div class="col-lg-4" align="right">
                        <button id="btnsendSMS" class="btn btn-sm btn-success" onclick="sendSMS();" disabled>Send</button>
                    </div>
                    
                </div>
                
            </div>
             <div class="widget">
                <div class="widget-header"> <i class=" icon-phone"></i>
                    <h3>SMS pin code</h3>
                </div>
                <div class="widget-content" align="center">
                    <p>Last active: </p>
                    <p style="font-size:36px"><b><?php   echo  $lastpin->sms_code; ?></b></p>
                </div>
                
            </div>
        </div>
      </div>
      
      
      
    </div>
  </div>
</div>
    
    
    <div  aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal" id="sLimit">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button onclick="closeModal();" aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
              <h4 id="myModalLabel" class="modal-title">Increase Limit</h4>
            </div>
            <div class="modal-body" >
                <table style="width:520px;margin-top:10px;">
                    <tr style="height: <?php echo $tableHeight.'px' ?>;">
                      <td>New limit Value (kr)</td>
                      <td style="font-weight: bold"><input id="inputLimitValue"  type="text" placeholder="" style="width:97%;background-color: white;color:black;margin:3px;border: 1px solid #dee4ea;text-align:right"></td> 
                      <td> </td>
                    </tr>
                </table>

            </div>

            <div class="modal-footer">
                <div id="modalAskSure" >
                    <button class="btn btn-danger" type="button"  data-dismiss="modal" onclick="closeModal('s')">No</button>
                    <button class="btn btn-success" type="button" onclick="saveNewLimit(0);">Yes</button>
                </div>
            </div>
          </div>
          <!-- /.modal-content --> 
        </div>
        <!-- /.modal-dialog --> 
    </div>
    
     <div  aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal" id="bLimit">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button onclick="closeModal();" aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
              <h4 id="myModalLabel" class="modal-title">Increase Limit</h4>
            </div>
            <div class="modal-body" >
                <table style="width:520px;margin-top:10px;">
                    <tr style="height: <?php echo $tableHeight.'px' ?>;">
                      <td>New limit Value (kr)</td>
                      <td style="font-weight: bold"><input id="inputLimitValueB"  type="text" placeholder="" style="width:97%;background-color: white;color:black;margin:3px;border: 1px solid #dee4ea;text-align:right"></td> 
                      <td> </td>
                    </tr>
                </table>

            </div>

            <div class="modal-footer">
                <div id="modalAskSure" >
                    <button class="btn btn-danger" type="button"  data-dismiss="modal" onclick="closeModal('b')">No</button>
                    <button class="btn btn-success" type="button" onclick="saveNewLimit(1);">Yes</button>
                </div>
            </div>
          </div>
          <!-- /.modal-content --> 
        </div>
        <!-- /.modal-dialog --> 
    </div>
    
       <div  aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal fade" id="chargebackModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button onclick="closeModal();" aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
              <h4 id="myModalLabel" class="modal-title">Chargeback</h4>
            </div>
            <div class="modal-body" >
                <p style="color:red;text-shadow: 0px 0px 1px orangered;text-align:center;font-size:16px;margin-top:20px;">Add chargeback to this user?</p>

            </div>

            <div class="modal-footer">
                <div id="modalAskSure" >
                    <button class="btn btn-danger" type="button"  data-dismiss="modal">No</button>
                    <button class="btn btn-success" type="button" onclick="SaveNewChargeback();">Yes</button>
                </div>
            </div>
          </div>
          <!-- /.modal-content --> 
        </div>
        <!-- /.modal-dialog --> 
    </div>
    
        
       <div  aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal fade" id="reportModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
              <h4 id="myModalLabel" class="modal-title">Report</h4>
            </div>
            <div class="modal-body" >
                <textarea id="txtReport" style="width:100%;background-color: white;color:black;border: 1px solid #ccc ; border-radius: 3px" rows="15"></textarea>
            </div>

            <div class="modal-footer">
                <div id="modalAskSure" >
                    <button class="btn btn-grey" type="button"  data-dismiss="modal">Close</button>
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
            $('#example2').dataTable( {
                    "sPaginationType": "full_numbers"
            } );
             $('#example3').dataTable( {
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
    
    $('#smsBody').keyup(function(event) {
        var thisE = this.value.length;
        var leftC = 160 - thisE;
        $('#charsLeft').html('Characters left <strong>'+leftC+'</strong>');
        if (thisE===0) {
            $('#btnsendSMS').attr('disabled','disabled');
        } else {
            $('#btnsendSMS').removeAttr('disabled');
        }
    });
    
    function sendSMS() {
       
        var smsBody = document.getElementById("smsBody").value;
        var tel = document.getElementById('tel').value;

         $.ajax({
                url: '/admin/default/sendSMS', 
                type: 'post',
                dataType: 'html',
                data: 'data='+tel+'|'+smsBody,
                async: false,
                success: function(data) {
                  var dataS = data.split(":");
                  if (dataS[0]==='#error') {
                      alert(dataS[1]);
                  } else {
                      alert('SMS sent!');
                  }   
             }});
    }
        function closeModal(bs) {
            $('#'+bs+'Limit').fadeOut('fast');
        }
        
        function showModal(bs) {
            $('#'+bs+'Limit').fadeIn('fast');
        }
    function saveNewLimit(bs) {
        var inputValue; 
        if (bs===0) {
            inputValue = document.getElementById("inputLimitValue").value;
        } else {
            inputValue = document.getElementById("inputLimitValueB").value;
        }
        
        var inputUser  = document.getElementById("inputUser").value;

        $.ajax({
           url: '/admin/default/increaseLimit', 
           type: 'post',
           dataType: 'html',
           data: 'data='+inputUser+'|'+inputValue+'|'+bs,
           async: false,
           success: function(data) {
  
            closeModal(data);
            location.reload(true);
             
        }});
    }
    
     $(document).on("mousedown", ".chargeBTN", function() {
        document.getElementById("inputID").value = $(this).attr('data-id');
    });
    
    function SaveNewChargeback() {
        var a = document.getElementById("inputID").value;
        var iData = a;
        $.ajax({
            url: "/admin/default/saveNewChargeback",
            type: "post",
            dataType: 'html',
            data: "data="+iData,
            success: function(data){
                $('#chargebackModal').fadeOut('fast');
                location.reload();
            },
            error:function(data){
                alert('error: '+data);
            }
        });
        
    }
    
      $(document).on("mousedown", ".reportBTN", function() {
        
        getReport($(this).attr('data-type'));
      });
    
    function getReport(type) {

        var userId = document.getElementById("inputUser").value;
        $.ajax({
            url: "/admin/default/getReport",
            type: "post",
            dataType: 'html',
            data: "data="+type+"|"+userId,
            success: function(data){
                $('#txtReport').val(data);
                //alert(data);
            },
            error:function(data){
                alert('error: '+data);
            }
        });
        
        
    }
    
    
</script>




</body>
</html>
