<!DOCTYPE html>
<?php
    $order          = OrdersDao::getOrderByIdAll($_GET['id']);
    $orderStatus    = OrderStatusDao::getOrderStatus($order->orderStatus_id);
    $orderStatusF   = OrderStatusFDao::getOrderStatus($order->orderStatusF_id);
    $merchant       = MerchantDao::getMerchantDataById($order->merchant_id);
    $buyer          = UsersDao::getUserById($order->buyer_id);
    $shop           = ShopsDao::getShopById($order->seller_id);
    $payin          = PayinsDao::getPayinByOrderId($order->id);
    $payins         = PayinsDao::getPayinsForOrder($order->id);
    $admin          = UsersDao::getUserById($this->user->id);
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
<style>
    .twitter-typeahead{
width:100%;
}

.twitter-typeahead .tt-query,
.twitter-typeahead .tt-hint {
  margin-bottom: 0;
}
.tt-dropdown-menu {
  min-width: 160px;
  margin-top: 2px;
  padding: 5px 0;
  background-color: #fff;
  border: 1px solid #ccc;
  border: 1px solid rgba(0,0,0,.2);
  *border-right-width: 2px;
  *border-bottom-width: 2px;
  -webkit-border-radius: 6px;
     -moz-border-radius: 6px;
          border-radius: 6px;
  -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
     -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
          box-shadow: 0 5px 10px rgba(0,0,0,.2);
  -webkit-background-clip: padding-box;
     -moz-background-clip: padding;
          background-clip: padding-box;
  width:100%;        
}

.tt-suggestion {
  display: block;
  padding: 3px 20px;
}

.tt-suggestion.tt-is-under-cursor {
  color: #fff;
  background-color: #0081c2;
  background-image: -moz-linear-gradient(top, #0088cc, #0077b3);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#0088cc), to(#0077b3));
  background-image: -webkit-linear-gradient(top, #0088cc, #0077b3);
  background-image: -o-linear-gradient(top, #0088cc, #0077b3);
  background-image: linear-gradient(to bottom, #0088cc, #0077b3);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff0088cc', endColorstr='#ff0077b3', GradientType=0)
}

.tt-suggestion.tt-is-under-cursor a {
  color: #fff;
}

.tt-suggestion p {
  margin: 0;
}
</style>
<body>
    <input id="inputUser" value="<?php echo $this->user->id; ?>" hidden />
    <input id="inputOrder" value="<?php echo $order->id; ?>" hidden />    
    <input id="inputPRef" value="<?php echo $order->payment_reference; ?>" hidden />
    <input id="inputIBAN" value="<?php echo $buyer->iban; ?>"  hidden />
     <input id="user" value="<?php echo $this->user->id; ?>" hidden>
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
            <div class="col-lg-6"><h2 class="page-title">Order Details</h2></div>
            <div class="col-lg-6"><h2 class="page-title" style="text-align:right"><span id="tmrWatch"></span></h2></div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-9">
          <div class="widget">
            <div class="widget-header"> <i class="icon-user"></i>
              <h3><?php echo 'Order #'.$order->id.' - '.$order->code;  ?></h3>
              <?php if ($order->orderStatus_id==1) { ?>
                <button style="margin-right:20px;margin-top:14px;float:right" class="btn btn-danger btn-sm" data-target="#cancelOfferModal" data-toggle="modal" >Cancel Offer</button>
              <?php } else if ($order->orderStatus_id==3) { ?>
                <p  style="margin-right:20px;margin-top:14px;float:right;color:red;text-shadow: 0px 0px 12px red">CANCELED</p> 
              <?php } ?> 
              
            
            </div>
              
            <div class="widget-content">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a data-toggle="tab" href="#basic">Basic information</a></li>
                    <li><a data-toggle="tab" href="#amounts">Amounts</a></li>
                    <li><a data-toggle="tab" href="#comments">Comments</a></li>
                </ul>

              <div class="tab-content" id="myTabContent">
                <div id="basic" class="tab-pane fade active in">
                    <div style ="float:right;margin-right: 20px; ">
                        <div style='background-color: white;padding:16px;border-radius: 3px'>
                            <!--<img style='border: 1px solid white' src="" height='220'/>-->
                            <p style='font-size:20px;font-weight: 700;color:black;text-align:center;margin-bottom: 2px;'><?php echo $order->total_amount.'kr';  ?></p>

                        </div> 
                        <?php if ($order->orderStatusF_id==0 || $order->orderStatusF_id==1 || $order->orderStatusF_id==2 || $order->orderStatusF_id==3 || $order->orderStatusF_id==8) {        ?>
                        <button id="btnnewPayin" data-backdrop="false" data-target="#modalPayin" data-toggle="modal" type="button" style="margin-top:10px" class="btn btn-default btn-sm btn-success btn-block"><b>Pay</b></button>
                        <?php   }      ?>
                    </div>
                        

                    <table style="width:58%;margin-top:30px;">
                        <tr style="height: <?php echo $tableHeight.'px' ?>; border-bottom:1px dotted grey;">
                            <td style="color: #d8d6d6; border-right: 1px dotted aliceblue">Order ID:</td>
                          <td style="font-weight: bold; padding-left:4px"><?php echo $order->id; ?></td> 
                          <td></td>
                        </tr>
                        <tr style="height: <?php echo $tableHeight.'px' ?>; border-bottom:1px dotted grey;">
                          <td  style="color: #d8d6d6; border-right: 1px dotted aliceblue">Status:</td>
                          <td style="font-weight: bold; padding-left:4px"><?php echo $orderStatus->name; 
                          $payoutLink = PayoutsDao::getPayoutById($order->id);
                          if (count($payoutLink>0)) {
                              echo ' - <a href= "/admin/default/payouts"  />PAYOUT</a>';
                          }
                          ?></td> 
                          <td></td>
                        </tr>
                        <tr style="height: <?php echo $tableHeight.'px' ?>; border-bottom:1px dotted grey;">
                          <td  style="color: #d8d6d6; border-right: 1px dotted aliceblue">Status <strong>F</strong>:</td>
                          <td style="font-weight: bold; padding-left:4px"><?php echo $orderStatusF->name; ?></td> 
                          <td></td>
                        </tr>
                        <tr style="height: <?php echo $tableHeight.'px' ?>; border-bottom:1px dotted grey;">
                          <td  style="color: #d8d6d6; border-right: 1px dotted aliceblue">Article code:</td>
                          <td style="font-weight: bold; padding-left:4px"><?php echo $order->code; ?></td> 
                          <td></td>
                        </tr>

                        <tr style="height: <?php echo $tableHeight.'px' ?>; border-bottom:1px dotted grey;">
                          <td style="color: #d8d6d6; border-right: 1px dotted aliceblue">Buyer:</td>
                          <td style="font-weight: bold; padding-left:4px"><?php echo '<a href="/admin/default/userDetails/id/'.$buyer->id.'">'.$buyer->name.' '.$buyer->surname; ?></td> 
                          <td></td>
                        </tr>
                        <tr style="height: <?php echo $tableHeight.'px' ?>; border-bottom:1px dotted grey;">
                          <td style="color: #d8d6d6; border-right: 1px dotted aliceblue">Shop:</td>
                          <td style="font-weight: bold; padding-left:4px"><?php 
                          if (!empty($shop->id)) {
                            echo '<a href="/admin/default/shopDetails/id/'.$shop->id.'">'.$shop->name.'</a>'; 
                          } else {
                            echo '';
                          }
                          ?></td> 
                          <td></td>
                        </tr>
                        <tr style="height: <?php echo $tableHeight.'px' ?>; border-bottom:1px dotted grey;">
                          <td style="color: #d8d6d6; border-right: 1px dotted aliceblue">Created at:</td>
                          <td style="font-weight: bold; padding-left:4px"><?php echo $order->time_created; ?></td> 
                          <td></td>
                        </tr>
                        <tr style="height: <?php echo $tableHeight.'px' ?>; border-bottom:1px dotted grey;">
                          <td style="color: #d8d6d6; border-right: 1px dotted aliceblue">Date accepted:</td>
                          <td style="font-weight: bold; padding-left:4px"><?php echo $order->date_accepted; ?></td> 
                          <td></td>
                        </tr>
<!--
                         <tr style="height: <?php echo $tableHeight.'px' ?>; border-bottom:1px dotted grey;">
                          <td style="color: #d8d6d6; border-right: 1px dotted aliceblue">Frouds:</td>
                          <td style="font-weight: bold; padding-left:4px"><?php 
                                $modelFraud = OrderFraudDao::getFraudByOrderID($order->id);
                                if (count($modelFraud)>0) {
                                    echo '<a href="" class="toolTipA" toolTipText="Click on this to view fraud!">Yes</a>';
                                } else {
                                    echo 'No';
                                }
                           ?></td> 
                          <td></td>
                        </tr>-->
                    </table>

                </div>
                <div id="amounts" class="tab-pane fade">
                     <table style="width:50%;margin-top:30px;">
                        <tr style="height: <?php echo $tableHeight.'px' ?>; border-bottom:1px dotted grey;">
                            <td style="color: #d8d6d6; border-right: 1px dotted aliceblue">Total Amount <i>kr</i>:</td>
                          <td style="font-weight: bold; padding-left:4px;text-align:right"><?php echo $order->total_amount; ?></td> 
                          <td></td>
                        </tr>
                        <tr style="height: <?php echo $tableHeight.'px' ?>; border-bottom:1px dotted grey;">
                            <td style="color: #d8d6d6; border-right: 1px dotted aliceblue">Shipping <i>kr</i>:</td>
                          <td style="font-weight: bold; padding-left:4px;text-align:right"><?php  ?></td> 
                          <td></td>
                        </tr>
                        <tr style="height: <?php echo $tableHeight.'px' ?>; border-bottom:1px dotted grey;">
                          <td  style="color: #d8d6d6; border-right: 1px dotted aliceblue">Fee <i>kr</i>:</td>
                          <td style="font-weight: bold; padding-left:4px;text-align:right"><?php echo $order->fee; ?></td> 
                          <td></td>
                        </tr>
                        <tr style="height: <?php echo $tableHeight.'px' ?>; border-bottom:1px dotted grey;">
                          <td  style="color: #d8d6d6; border-right: 1px dotted aliceblue">Paid %:</td>
                          <td style="font-weight: bold; padding-left:4px;text-align:right"><?php echo $order->pay_percent; ?></td> 
                          <td></td>
                          
                        </tr>
                        <tr style="height: <?php echo $tableHeight.'px' ?>; border-bottom:1px dotted grey;">
                          <td  style="color: #d8d6d6; border-right: 1px dotted aliceblue">Paid <i>kr</i>:</td>
                          <td style="font-weight: bold; padding-left:4px;text-align:right"><?php echo number_format($order->total_amount*$order->pay_percent/100,2); ?></td> 
                          <td></td>
                          
                        </tr>
                        <tr style="height: <?php echo $tableHeight.'px' ?>; border-bottom:1px dotted grey;">
                          <td  style="color: #d8d6d6; border-right: 1px dotted aliceblue">Date last payment:</td>
                          <td style="font-weight: bold; padding-left:4px;text-align:right"><?php echo $payin[0]->pay_date; ?></td> 
                          <td></td>
                          
                        </tr>
                         <tr style="height: <?php echo $tableHeight.'px' ?>; border-bottom:1px dotted grey;">
                          <td  style="color: #d8d6d6; border-right: 1px dotted aliceblue">Remainder amount:</td>
                          <td style="font-weight: bold; padding-left:4px;text-align:right"><input id="inputPenality" type="tel" style="height:14px;width:40%" hidden  onblur="savePenality();"/><?php 
                          if (is_null($order->penality)) {
                              echo '<a id="linkPenality" style="cursor:pointer" onclick="showInputPenality()">Input remainder amount <i class="icon-pencil"></i></a>';
                          } else {
                              echo $order->penality;
                          }
                           ?></td> 
                          <td></td>
                          
                        </tr>
                    </table>
 <div class="example_alt_pagination" style="margin-top:50px;border-top:1px dotted white;padding-top:10px">
      <div id="container">
        <div class="full_width big"></div>
  <div id="demo">
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="example2">
      <thead>
        <tr>
          <th>ID</th>
          <th class="hidden-xs">Statement no.</th>
          <th class="hidden-xs">From bank account</th>
          <th class="hidden-xs">To bank account</th>
          <th class="hidden-xs" style="text-align:right">Amount</th>
          <th class="hidden-xs">Admin</th>
          <th class="hidden-xs">Pay date</th>
          <th class="hidden-xs">Date created</th>
          </tr>
        </thead>
      <tbody>
       
          <?php
          
          $y=0;
          while ($y < count($payins))  
            {

             
                echo '<tr class="gradeA">'.
                     '<td class="hidden-xs" style="font-size:11px">'.$payins[$y]->id.'</td>'.
                     '<td class="hidden-xs" style="font-size:11px">'.$payins[$y]->statement_no.'</td>'.
                     '<td class="hidden-xs" style="font-size:10px">'.$payins[$y]->bank_account_from.'</td>'.
                     '<td class="hidden-xs" style="font-size:10px">'.$payins[$y]->bank_account_to.'</td>'.
                     '<td class="hidden-xs" style="font-size:11px;text-align:right;font-weight:900">'.$payins[$y]->amount.'</td>'.
                     '<td class="hidden-xs" style="font-size:11px"><a href="/admin/default/userDetails/id/'.$payins[$y]->user_id.'">'.$admin->surname.'</a></td>'.
                     '<td class="hidden-xs" style="font-size:11px">'.$payins[$y]->pay_date.'</td>'.
                     '<td class="hidden-xs" style="font-size:11px">'.$payins[$y]->created_at.'</td></tr>';
                
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
             
                <div id="comments" class="tab-pane fade">
                    <div align="right" style="margin-bottom: 20px;margin-top:5px">
                     <button id="btnNewComment" data-backdrop="false" data-target="#myModal" data-toggle="modal" class="btn btn-s-md  btn-default btn-sm" type="button">New comment</button>
                    </div>
                   <?php  
                         $x=0;
                         $comments = OrderCoDao::getAllCommentsByOrderId($order->id);
                         while ($x < count($comments)) {
                             $userComment = UsersDao::getUserById($comments[$x]->user_created);
                             $comBody = '';
                             $comBody =  $comBody.'<div class="alert alert-block fade in" style="background: rgba(10,10,10,0.3);">
                                         <button type="button" class="close close-sm" data-dismiss="alert"> <i class="icon-remove"></i> </button>';
                             $comBody = $comBody .'<h4> <i class="icon-user"></i> ' .$userComment->name.'<small style="padding-left:5px">'. $comments[$x]->time_created.'</small></h4> ';
                             $comBody = $comBody.'<p>'.$comments[$x]->comment.'</p></div>';
                             echo $comBody;
                             $x++;
                         }
                    
                    
                    
                    ?>

                </div>
              </div>
                
                
            </div>
          </div>
        </div>
        <div class="col-lg-3">
            <div class="widget">
                <div class="widget-header"> <i class=" icon-phone"></i>
                    <h3>Order code</h3>
                </div>
                <div class="widget-content">
                    <p style="font-size:24px;font-weight: 700;text-align:center"><?php echo $order->code; ?></p>
                </div>
                
            </div>
        </div>
      </div>
      
      
      
    </div>
  </div>
</div>
     <div style="display: none;" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal fade" id="myModal">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
                  <h4 id="myModalLabel" class="modal-title">New comment</h4>
                </div>
                <div class="modal-body" >
                    <table style="width:520px;margin-top:10px;">
                        <tr style="height: <?php echo $tableHeight.'px' ?>;">
                          <td>Comment:</td>
                          <td style="font-weight: bold"><textarea rows="5" id="inputComment" type="text" placeholder=""  style="width:97%;background-color: white;color:black;margin:3px;border: 1px solid #dee4ea;"></textarea></td> 
                          <td></td>
                        </tr>
                    </table>
                    
                </div>
                  
                <div class="modal-footer">
                    <div id="modalSave">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                        <button class="btn btn-primary" type="button" onclick="askYouSure(true);">Save</button>
                    </div>
                    <div id="modalAskSure" hidden>
                        <button class="btn btn-danger" type="button" onclick="askYouSure(false);">No</button>
                        <button class="btn btn-success" type="button" onclick='saveNewComment();'>Yes</button>
                    </div>
                </div>
              </div>
              <!-- /.modal-content --> 
            </div>
            <!-- /.modal-dialog --> 
    </div>  
         <!---------------------------------- MODAL Offer DELETE CONFIRMATION ----------------------------------->
    <div  aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal fade" id="cancelOfferModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button onclick="closeModal();" aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
              <h4 id="delModalLabel" class="modal-title">Canceling offer</h4>
            </div>
            <div class="modal-body" >
                <p style="font-size:16px;text-align:center;color:red;font-weight: 300;margin-top:24px"> Are you sure to cancel this offer?</p>
                
            </div>
            <div class="modal-footer">
                <div id="modalAskSure" >
                    <button class="btn btn-danger" type="button" aria-hidden="true" data-dismiss="modal">No</button>
                    <button class="btn btn-success" type="button" onclick="cancelOffer(<?php echo $order->id; ?>);">Yes</button>
                </div>
            </div>
           </div>
          <!-- /.modal-content --> 
         </div>
        <!-- /.modal-dialog --> 
     </div>
      
         
         <!------------------------------------------------modal payin --------------------------------------->   
      
            <div style="display: none;" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal fade" id="modalPayin">
                   <div class="modal-dialog">
                     <div class="modal-content">
                       <div class="modal-header">
                         <button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
                         <h4 id="myModalLabel" class="modal-title">New manual input payin</h4>
                       </div>
                       <div class="modal-body" >
                           <table style="width:520px;margin-top:10px;">
                               <tr style="height: <?php echo $tableHeight.'px' ?>;">
                                 <td>Statement no</td>
                                 <td style="font-weight: bold"><input id="inputStaNo" onkeyup="checkInputVal('inputStaNo')" onfocus="readVal()" onblur="createCookie()" type="text" placeholder="" style="width:97%;background-color: white;color:black;margin:3px;border: 1px solid #dee4ea;text-align:right"></td> 
                                 <td></td>
                               </tr>
                               <tr style="height: <?php echo $tableHeight.'px' ?>;">
                                 <td>Date Payin</td>
                                 <td style="font-weight: bold"><input id="inputDatePayin"  type="date" placeholder=""  style="width:97%;background-color: white;color:black;margin:3px;border: 1px solid #dee4ea;text-align:right;font-weight: 700"></td> 
                                 <td></td>
                               </tr>
                               <tr style="height: <?php echo $tableHeight.'px' ?>;">
                                 <td>Payment reference</td>
                                 <td style="font-weight: bold"><input  id="inputPayRef" type="text" placeholder="" style="width:97%;background-color: white;color:black;margin:3px;border: 1px solid #dee4ea;text-align:right"></td> 
                                 <td></td>
                               </tr>
                               <tr style="height: <?php echo $tableHeight.'px' ?>;">
                                 <td>From account</td>
                                 <td style="font-weight: bold"><input id="inputFrom" type="text" placeholder="" style="width:97%;background-color: white;color:black;margin:3px;border: 1px solid #dee4ea;text-align:right"></td> 
                                 <td></td>
                               </tr>
                               <tr style="height: <?php echo $tableHeight.'px' ?>;">
                                 <td>To account</td>
                                 <td style="font-weight: bold"><input class="typeahead" id="inputTo" type="text" placeholder="" style="width:97%;background-color: white;color:black;margin:3px;border: 1px solid #dee4ea;text-align:right"></td> 
                                 <td></td>
                               </tr>
                               <tr style="height: <?php echo $tableHeight.'px' ?>;">
                                 <td>Amount</td>
                                 <td style="font-weight: bold"><input class="typeahead" id="inputAmount" type="text" placeholder="" onkeyup="updateProgress();" style="width:97%;background-color: white;color:black;margin:3px;border: 1px solid #dee4ea;text-align:right;font-weight: 700"></td> 
                                 <td><div class="progress" style="width:60px;height:26px;margin-bottom: 0px!important">
                                   <div id="percProgress" class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                                       <p id="pValue" style="padding-top:4px;text-align:center;width: 100%">0%</p></div>
                                 </div></td>
                               </tr>
                               <input id="valPerc" hidden value="">

                           </table>

                       </div>

                       <div class="modal-footer">
                           <div id="modalSave2">
                               <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                               <button class="btn btn-primary" type="button" onclick="askYouSure2(true);">Save</button>
                           </div>
                           <div id="modalAskSure2" hidden>
                               <button class="btn btn-danger" type="button" onclick="askYouSure2(false);">No</button>
                               <button class="btn btn-success" type="button" onclick='saveNewPayin();'>Yes</button>
                           </div>
                       </div>
                     </div>
                     <!-- /.modal-content --> 
                   </div>
                   <!-- /.modal-dialog --> 
            </div>

      
         <!------------------------------------------------------------------------------------------------------------->
    
         
         
  <div id="tooltipMsg" hidden ></div>
    <input id="orderID" value="<?php echo $order->id; ?>" hidden>
<div class="bottom-nav footer"><?php    echo date('Y'); ?> &copy; Qlirr </div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/jquery.js"></script> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/hogan.js"></script> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/smooth-sliding-menu.js"></script>


<script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
            $('#example2').dataTable( {
                    "sPaginationType": "full_numbers"
            } );
            $('.toolTipA').mouseover(
                function() {
                     var position = $(this).offset();
                     var top = position.top - 25;
                     $('#tooltipMsg').html($(this).attr('toolTipText'));
                     $('#tooltipMsg').attr('style', 'color:white;font-size:11px;border-radius:3px; padding:4px;background:rgba(20,20,20,0.65);position:absolute; top:'+top+'px; left:'+position.left+'px');
                     $('#tooltipMsg').fadeIn('fast');
            });
            $('.toolTipA').mouseout(
                function() {
                     $('#tooltipMsg').fadeOut('fast');
            });
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
       function updateProgress() {
       checkInputVal('inputAmount');
       var paymentRef = document.getElementById("inputPayRef").value;
       $.ajax({
            url: "/admin/default/checkOrderPayPerctentage",
            type: "post",
            dataType: 'html',
            data: "data="+paymentRef,
            success: function(data){
                var dataS = data.split("|");
                var inpPayin = document.getElementById("inputAmount").value;
                var aVal = Number(dataS[0]);
                var result = ((inpPayin/dataS[1])*100)+aVal;
                $('#valPerc').val(result.toFixed(2));
                $('#pValue').text(result.toFixed(2)+'%');
                var resultR = result.toFixed(2);
                if (resultR<100) {
                    $('#percProgress').attr('style', 'width:'+result+'%;background-color:orange;text-shadow: 0px 0px 3px black');
                } else if(resultR==100) {
                    $('#percProgress').attr('style', 'width:'+result+'%;background-color:greenyellow;text-shadow: 0px 0px 3px black');
                } else if(resultR>100) {
                    $('#percProgress').attr('style', 'width:'+result+'%;background-color:red;text-shadow: 0px 0px 3px black');
                }
                
            },
            error:function(data){
                alert('error');
            }
        }); 
   }  
   
      function saveNewPayin() {
        
        var a = document.getElementById("inputStaNo").value;
        var b = document.getElementById("inputDatePayin").value;
        var c = document.getElementById("inputPayRef").value;
        var d = document.getElementById("inputFrom").value;
        var e = document.getElementById("inputTo").value;
        var f = document.getElementById("inputAmount").value;
        var g = document.getElementById("valPerc").value;
        var h = document.getElementById("user").value;
        if (checkInputValues2()) {
            var sumAll = a+'|'+b+'|'+c+'|'+d+'|'+e+'|'+f+'|'+g*100+"|"+h;
            $.ajax({
                 url: "/admin/default/saveNewPayin",
                 type: "post",
                 dataType: 'html',
                 data: "data="+sumAll,
                 success: function(data){
 
                   if(data=='ok') {
                      $('#modalPayin').fadeOut('fast');
                      location.reload(true);
                   }
                 },
                 error:function(data){
                     alert('error');
                 }
             }); 
        }
   }
    function resetFields(){
       $('#inputStaNo').val('');
       $('#inputPayRef').val('');
       $('#inputFrom').val('');
       $('#inputTo').val('');
       $('#inputAmount').val('');
       $('#inputStaNo').focus();
       $('#percProgress').attr('style', 'width:0%');
       $('#pValue').text('0%');
       $('#modalAskSure').fadeOut('fast', function() {$('#modalSave').fadeIn('fast')});
   }
    function showInputTracking() {
        $('#linkTracking').fadeOut('fast', function() {$('#inputTracking').fadeIn('fast')});
    }    
    function showInputPenality() {
        $('#linkPenality').fadeOut('fast', function() {$('#inputPenality').fadeIn('fast')});
    }       
    function saveTracking() {
        var inputTracking = document.getElementById('inputTracking').value;
        var orderID = document.getElementById('orderID').value;
         $.ajax({
            url: "/admin/default/saveTracking",
            type: "post",
            dataType: 'html',
            data: "data="+orderID+"|"+inputTracking,
            success: function(data){
                $('#linkTracking').html(inputTracking);
                $('#inputTracking').fadeOut('fast', function() {$('#linkTracking').fadeIn('fast')})
            },
            error:function(data){
                alert("Error:" + data);
            }
        });
    }
     function savePenality() {
        var inputPenality = document.getElementById('inputPenality').value;
        var orderID = document.getElementById('orderID').value;
         $.ajax({
            url: "/admin/default/savePenality",
            type: "post",
            dataType: 'html',
            data: "data="+orderID+"|"+inputPenality,
            success: function(data){
                $('#linkPenality').html(inputPenality);
                $('#inputPenality').fadeOut('fast', function() {$('#linkPenality').fadeIn('fast')})
            },
            error:function(data){
                alert("Error:" + data);
            }
        });
    }
    function cancelOffer(offerID) {
           $.ajax({
                url: '/site/cancelOffer',
                type: 'post',
                dataType: 'html',
                data: 'data='+offerID,
                async: false,
                success: function(data) {
                    window.location = '/admin/default/orderList';
               }
            }); 
    
    }
    
     $('#inputPenality').keydown(function(event) {
              // Allow special chars + arrows 
//              $('#inputNumber').attr('style','border-color:aquablue');
              if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 
                  || event.keyCode == 27
                  || (event.keyCode == 65 && event.ctrlKey === true) 
                  || (event.keyCode >= 35 && event.keyCode <= 39)){
                      return;
              } else if (event.keyCode==13) {
                    savePenality();
               }else {
                  // If it's not a number stop the keypress
                  if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                      event.preventDefault(); 
                  }   
              }
          }); 
        $('#inputTracking').keydown(function(event) {
              // Allow special chars + arrows 
//              $('#inputNumber').attr('style','border-color:aquablue');
              if  (event.keyCode==13) {
                    saveTracking();
               }
          }); 
    function checkInputVal(element) {
        var vValu = document.getElementById(element).value;
        if(vValu!='') {
            $('#'+element).attr('style', 'width:97%;background-color: white;color:black;margin:3px;border: 1px solid #dee4ea;text-align:right');
        }
    }     
          
     function checkInputValues() {
        var a = document.getElementById("inputComment").value;
        if (a==='') {
            $('#inputComment').attr('style','width:97%;background-color: #FF9191;color:black;margin:3px;border: 1px solid #dee4ea');
            return false;
            
        } else {
            return true;
        }
    }
    
     function checkInputValues2() {
        var a = document.getElementById("inputStaNo").value;
        var d = document.getElementById("inputFrom").value;
        var f = document.getElementById("inputAmount").value;
        var b = document.getElementById("inputTo").value;
        var sumAll=0;
        if (a==='') {
            $('#inputStaNo').attr('style','width:97%;background-color: #FF9191;color:black;margin:3px;border: 1px solid #dee4ea;text-align:right');
        } else {
            sumAll=sumAll+1;
        }
        if (b==='') {
            $('#inputTo').focus();
        } else {
            sumAll=sumAll+1;
        }
        if (d==='') {
            $('#inputFrom').attr('style','width:97%;background-color: #FF9191;color:black;margin:3px;border: 1px solid #dee4ea;text-align:right');
        } else {
            sumAll=sumAll+1;
        }

        if (f==='') {
            $('#inputAmount').attr('style','width:97%;background-color: #FF9191;color:black;margin:3px;border: 1px solid #dee4ea;text-align:right');
        } else {
            sumAll=sumAll+1;
        }
        
       if (sumAll===4) {
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
    function closeModal() {
        $('#myModal').fadeOut('fast');
    }
    
    function saveNewComment() {
        var a = document.getElementById("inputComment").value;
        var b = document.getElementById("inputUser").value;
        var c = document.getElementById("inputOrder").value;
        
        $.ajax({
                 url: "/admin/default/saveNewComment",
                 type: "post",
                 dataType: 'html',
                 data: "data="+a+"|"+b+"|"+c,
                 success: function(data){
                     closeModal();
                 },
                 error:function(data){
                     alert('error');
                 }
             });
    } 
    
    function createCookie() {
        var lastSta = document.getElementById("inputStaNo").value;
        document.cookie = "lastStatementNo="+lastSta;
    }
   
    function readCookie(n){n+='=';for(var a=document.cookie.split(/;\s*/),i=a.length-1;i>=0;i--)if(!a[i].indexOf(n))return a[i].replace(n,'');}
    
    function readVal() {
        var readValue = readCookie("lastStatementNo");
        $("#inputStaNo").val(readValue);
    }
    
    $(document).ready(function() {
        $('#example').dataTable( {
            "sPaginationType": "full_numbers"
        });
         var d = new Date();
         d.setDate(d.getDate()-1);
         document.getElementById("inputDatePayin").valueAsDate  = d;
         document.getElementById("inputPayRef").value = document.getElementById("inputPRef").value;
         document.getElementById("inputFrom").value = document.getElementById("inputIBAN").value;
    });
    
    function askYouSure2(q) {
       if (checkInputValues2()) {
            if (q) {
                 $('#modalSave2').fadeOut('fast', function() {$('#modalAskSure2').fadeIn('fast')});
            } else {
                $('#modalAskSure2').fadeOut('fast', function() {$('#modalSave2').fadeIn('fast')});
            }
       }
   }
</script>

<script>

  /*!
 * typeahead.js 0.9.3
 * https://github.com/twitter/typeahead
 * Copyright 2013 Twitter, Inc. and other contributors; Licensed MIT
 */

!function(a){var b="0.9.3",c={isMsie:function(){var a=/(msie) ([\w.]+)/i.exec(navigator.userAgent);return a?parseInt(a[2],10):!1},isBlankString:function(a){return!a||/^\s*$/.test(a)},escapeRegExChars:function(a){return a.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g,"\\$&")},isString:function(a){return"string"==typeof a},isNumber:function(a){return"number"==typeof a},isArray:a.isArray,isFunction:a.isFunction,isObject:a.isPlainObject,isUndefined:function(a){return"undefined"==typeof a},bind:a.proxy,bindAll:function(b){var c;for(var d in b)a.isFunction(c=b[d])&&(b[d]=a.proxy(c,b))},indexOf:function(a,b){for(var c=0;c<a.length;c++)if(a[c]===b)return c;return-1},each:a.each,map:a.map,filter:a.grep,every:function(b,c){var d=!0;return b?(a.each(b,function(a,e){return(d=c.call(null,e,a,b))?void 0:!1}),!!d):d},some:function(b,c){var d=!1;return b?(a.each(b,function(a,e){return(d=c.call(null,e,a,b))?!1:void 0}),!!d):d},mixin:a.extend,getUniqueId:function(){var a=0;return function(){return a++}}(),defer:function(a){setTimeout(a,0)},debounce:function(a,b,c){var d,e;return function(){var f,g,h=this,i=arguments;return f=function(){d=null,c||(e=a.apply(h,i))},g=c&&!d,clearTimeout(d),d=setTimeout(f,b),g&&(e=a.apply(h,i)),e}},throttle:function(a,b){var c,d,e,f,g,h;return g=0,h=function(){g=new Date,e=null,f=a.apply(c,d)},function(){var i=new Date,j=b-(i-g);return c=this,d=arguments,0>=j?(clearTimeout(e),e=null,g=i,f=a.apply(c,d)):e||(e=setTimeout(h,j)),f}},tokenizeQuery:function(b){return a.trim(b).toLowerCase().split(/[\s]+/)},tokenizeText:function(b){return a.trim(b).toLowerCase().split(/[\s\-_]+/)},getProtocol:function(){return location.protocol},noop:function(){}},d=function(){var a=/\s+/;return{on:function(b,c){var d;if(!c)return this;for(this._callbacks=this._callbacks||{},b=b.split(a);d=b.shift();)this._callbacks[d]=this._callbacks[d]||[],this._callbacks[d].push(c);return this},trigger:function(b,c){var d,e;if(!this._callbacks)return this;for(b=b.split(a);d=b.shift();)if(e=this._callbacks[d])for(var f=0;f<e.length;f+=1)e[f].call(this,{type:d,data:c});return this}}}(),e=function(){function b(b){b&&b.el||a.error("EventBus initialized without el"),this.$el=a(b.el)}var d="typeahead:";return c.mixin(b.prototype,{trigger:function(a){var b=[].slice.call(arguments,1);this.$el.trigger(d+a,b)}}),b}(),f=function(){function a(a){this.prefix=["__",a,"__"].join(""),this.ttlKey="__ttl__",this.keyMatcher=new RegExp("^"+this.prefix)}function b(){return(new Date).getTime()}function d(a){return JSON.stringify(c.isUndefined(a)?null:a)}function e(a){return JSON.parse(a)}var f,g;try{f=window.localStorage,f.setItem("~~~","!"),f.removeItem("~~~")}catch(h){f=null}return g=f&&window.JSON?{_prefix:function(a){return this.prefix+a},_ttlKey:function(a){return this._prefix(a)+this.ttlKey},get:function(a){return this.isExpired(a)&&this.remove(a),e(f.getItem(this._prefix(a)))},set:function(a,e,g){return c.isNumber(g)?f.setItem(this._ttlKey(a),d(b()+g)):f.removeItem(this._ttlKey(a)),f.setItem(this._prefix(a),d(e))},remove:function(a){return f.removeItem(this._ttlKey(a)),f.removeItem(this._prefix(a)),this},clear:function(){var a,b,c=[],d=f.length;for(a=0;d>a;a++)(b=f.key(a)).match(this.keyMatcher)&&c.push(b.replace(this.keyMatcher,""));for(a=c.length;a--;)this.remove(c[a]);return this},isExpired:function(a){var d=e(f.getItem(this._ttlKey(a)));return c.isNumber(d)&&b()>d?!0:!1}}:{get:c.noop,set:c.noop,remove:c.noop,clear:c.noop,isExpired:c.noop},c.mixin(a.prototype,g),a}(),g=function(){function a(a){c.bindAll(this),a=a||{},this.sizeLimit=a.sizeLimit||10,this.cache={},this.cachedKeysByAge=[]}return c.mixin(a.prototype,{get:function(a){return this.cache[a]},set:function(a,b){var c;this.cachedKeysByAge.length===this.sizeLimit&&(c=this.cachedKeysByAge.shift(),delete this.cache[c]),this.cache[a]=b,this.cachedKeysByAge.push(a)}}),a}(),h=function(){function b(a){c.bindAll(this),a=c.isString(a)?{url:a}:a,i=i||new g,h=c.isNumber(a.maxParallelRequests)?a.maxParallelRequests:h||6,this.url=a.url,this.wildcard=a.wildcard||"%QUERY",this.filter=a.filter,this.replace=a.replace,this.ajaxSettings={type:"get",cache:a.cache,timeout:a.timeout,dataType:a.dataType||"json",beforeSend:a.beforeSend},this._get=(/^throttle$/i.test(a.rateLimitFn)?c.throttle:c.debounce)(this._get,a.rateLimitWait||300)}function d(){j++}function e(){j--}function f(){return h>j}var h,i,j=0,k={};return c.mixin(b.prototype,{_get:function(a,b){function c(c){var e=d.filter?d.filter(c):c;b&&b(e),i.set(a,c)}var d=this;f()?this._sendRequest(a).done(c):this.onDeckRequestArgs=[].slice.call(arguments,0)},_sendRequest:function(b){function c(){e(),k[b]=null,f.onDeckRequestArgs&&(f._get.apply(f,f.onDeckRequestArgs),f.onDeckRequestArgs=null)}var f=this,g=k[b];return g||(d(),g=k[b]=a.ajax(b,this.ajaxSettings).always(c)),g},get:function(a,b){var d,e,f=this,g=encodeURIComponent(a||"");return b=b||c.noop,d=this.replace?this.replace(this.url,g):this.url.replace(this.wildcard,g),(e=i.get(d))?c.defer(function(){b(f.filter?f.filter(e):e)}):this._get(d,b),!!e}}),b}(),i=function(){function d(b){c.bindAll(this),c.isString(b.template)&&!b.engine&&a.error("no template engine specified"),b.local||b.prefetch||b.remote||a.error("one of local, prefetch, or remote is required"),this.name=b.name||c.getUniqueId(),this.limit=b.limit||5,this.minLength=b.minLength||1,this.header=b.header,this.footer=b.footer,this.valueKey=b.valueKey||"value",this.template=e(b.template,b.engine,this.valueKey),this.local=b.local,this.prefetch=b.prefetch,this.remote=b.remote,this.itemHash={},this.adjacencyList={},this.storage=b.name?new f(b.name):null}function e(a,b,d){var e,f;return c.isFunction(a)?e=a:c.isString(a)?(f=b.compile(a),e=c.bind(f.render,f)):e=function(a){return"<p>"+a[d]+"</p>"},e}var g={thumbprint:"thumbprint",protocol:"protocol",itemHash:"itemHash",adjacencyList:"adjacencyList"};return c.mixin(d.prototype,{_processLocalData:function(a){this._mergeProcessedData(this._processData(a))},_loadPrefetchData:function(d){function e(a){var b=d.filter?d.filter(a):a,e=m._processData(b),f=e.itemHash,h=e.adjacencyList;m.storage&&(m.storage.set(g.itemHash,f,d.ttl),m.storage.set(g.adjacencyList,h,d.ttl),m.storage.set(g.thumbprint,n,d.ttl),m.storage.set(g.protocol,c.getProtocol(),d.ttl)),m._mergeProcessedData(e)}var f,h,i,j,k,l,m=this,n=b+(d.thumbprint||"");return this.storage&&(f=this.storage.get(g.thumbprint),h=this.storage.get(g.protocol),i=this.storage.get(g.itemHash),j=this.storage.get(g.adjacencyList)),k=f!==n||h!==c.getProtocol(),d=c.isString(d)?{url:d}:d,d.ttl=c.isNumber(d.ttl)?d.ttl:864e5,i&&j&&!k?(this._mergeProcessedData({itemHash:i,adjacencyList:j}),l=a.Deferred().resolve()):l=a.getJSON(d.url).done(e),l},_transformDatum:function(a){var b=c.isString(a)?a:a[this.valueKey],d=a.tokens||c.tokenizeText(b),e={value:b,tokens:d};return c.isString(a)?(e.datum={},e.datum[this.valueKey]=a):e.datum=a,e.tokens=c.filter(e.tokens,function(a){return!c.isBlankString(a)}),e.tokens=c.map(e.tokens,function(a){return a.toLowerCase()}),e},_processData:function(a){var b=this,d={},e={};return c.each(a,function(a,f){var g=b._transformDatum(f),h=c.getUniqueId(g.value);d[h]=g,c.each(g.tokens,function(a,b){var d=b.charAt(0),f=e[d]||(e[d]=[h]);!~c.indexOf(f,h)&&f.push(h)})}),{itemHash:d,adjacencyList:e}},_mergeProcessedData:function(a){var b=this;c.mixin(this.itemHash,a.itemHash),c.each(a.adjacencyList,function(a,c){var d=b.adjacencyList[a];b.adjacencyList[a]=d?d.concat(c):c})},_getLocalSuggestions:function(a){var b,d=this,e=[],f=[],g=[];return c.each(a,function(a,b){var d=b.charAt(0);!~c.indexOf(e,d)&&e.push(d)}),c.each(e,function(a,c){var e=d.adjacencyList[c];return e?(f.push(e),(!b||e.length<b.length)&&(b=e),void 0):!1}),f.length<e.length?[]:(c.each(b,function(b,e){var h,i,j=d.itemHash[e];h=c.every(f,function(a){return~c.indexOf(a,e)}),i=h&&c.every(a,function(a){return c.some(j.tokens,function(b){return 0===b.indexOf(a)})}),i&&g.push(j)}),g)},initialize:function(){var b;return this.local&&this._processLocalData(this.local),this.transport=this.remote?new h(this.remote):null,b=this.prefetch?this._loadPrefetchData(this.prefetch):a.Deferred().resolve(),this.local=this.prefetch=this.remote=null,this.initialize=function(){return b},b},getSuggestions:function(a,b){function d(a){f=f.slice(0),c.each(a,function(a,b){var d,e=g._transformDatum(b);return d=c.some(f,function(a){return e.value===a.value}),!d&&f.push(e),f.length<g.limit}),b&&b(f)}var e,f,g=this,h=!1;a.length<this.minLength||(e=c.tokenizeQuery(a),f=this._getLocalSuggestions(e).slice(0,this.limit),f.length<this.limit&&this.transport&&(h=this.transport.get(a,d)),!h&&b&&b(f))}}),d}(),j=function(){function b(b){var d=this;c.bindAll(this),this.specialKeyCodeMap={9:"tab",27:"esc",37:"left",39:"right",13:"enter",38:"up",40:"down"},this.$hint=a(b.hint),this.$input=a(b.input).on("blur.tt",this._handleBlur).on("focus.tt",this._handleFocus).on("keydown.tt",this._handleSpecialKeyEvent),c.isMsie()?this.$input.on("keydown.tt keypress.tt cut.tt paste.tt",function(a){d.specialKeyCodeMap[a.which||a.keyCode]||c.defer(d._compareQueryToInputValue)}):this.$input.on("input.tt",this._compareQueryToInputValue),this.query=this.$input.val(),this.$overflowHelper=e(this.$input)}function e(b){return a("<span></span>").css({position:"absolute",left:"-9999px",visibility:"hidden",whiteSpace:"nowrap",fontFamily:b.css("font-family"),fontSize:b.css("font-size"),fontStyle:b.css("font-style"),fontVariant:b.css("font-variant"),fontWeight:b.css("font-weight"),wordSpacing:b.css("word-spacing"),letterSpacing:b.css("letter-spacing"),textIndent:b.css("text-indent"),textRendering:b.css("text-rendering"),textTransform:b.css("text-transform")}).insertAfter(b)}function f(a,b){return a=(a||"").replace(/^\s*/g,"").replace(/\s{2,}/g," "),b=(b||"").replace(/^\s*/g,"").replace(/\s{2,}/g," "),a===b}return c.mixin(b.prototype,d,{_handleFocus:function(){this.trigger("focused")},_handleBlur:function(){this.trigger("blured")},_handleSpecialKeyEvent:function(a){var b=this.specialKeyCodeMap[a.which||a.keyCode];b&&this.trigger(b+"Keyed",a)},_compareQueryToInputValue:function(){var a=this.getInputValue(),b=f(this.query,a),c=b?this.query.length!==a.length:!1;c?this.trigger("whitespaceChanged",{value:this.query}):b||this.trigger("queryChanged",{value:this.query=a})},destroy:function(){this.$hint.off(".tt"),this.$input.off(".tt"),this.$hint=this.$input=this.$overflowHelper=null},focus:function(){this.$input.focus()},blur:function(){this.$input.blur()},getQuery:function(){return this.query},setQuery:function(a){this.query=a},getInputValue:function(){return this.$input.val()},setInputValue:function(a,b){this.$input.val(a),!b&&this._compareQueryToInputValue()},getHintValue:function(){return this.$hint.val()},setHintValue:function(a){this.$hint.val(a)},getLanguageDirection:function(){return(this.$input.css("direction")||"ltr").toLowerCase()},isOverflow:function(){return this.$overflowHelper.text(this.getInputValue()),this.$overflowHelper.width()>this.$input.width()},isCursorAtEnd:function(){var a,b=this.$input.val().length,d=this.$input[0].selectionStart;return c.isNumber(d)?d===b:document.selection?(a=document.selection.createRange(),a.moveStart("character",-b),b===a.text.length):!0}}),b}(),k=function(){function b(b){c.bindAll(this),this.isOpen=!1,this.isEmpty=!0,this.isMouseOverDropdown=!1,this.$menu=a(b.menu).on("mouseenter.tt",this._handleMouseenter).on("mouseleave.tt",this._handleMouseleave).on("click.tt",".tt-suggestion",this._handleSelection).on("mouseover.tt",".tt-suggestion",this._handleMouseover)}function e(a){return a.data("suggestion")}var f={suggestionsList:'<span class="tt-suggestions"></span>'},g={suggestionsList:{display:"block"},suggestion:{whiteSpace:"nowrap",cursor:"pointer"},suggestionChild:{whiteSpace:"normal"}};return c.mixin(b.prototype,d,{_handleMouseenter:function(){this.isMouseOverDropdown=!0},_handleMouseleave:function(){this.isMouseOverDropdown=!1},_handleMouseover:function(b){var c=a(b.currentTarget);this._getSuggestions().removeClass("tt-is-under-cursor"),c.addClass("tt-is-under-cursor")},_handleSelection:function(b){var c=a(b.currentTarget);this.trigger("suggestionSelected",e(c))},_show:function(){this.$menu.css("display","block")},_hide:function(){this.$menu.hide()},_moveCursor:function(a){var b,c,d,f;if(this.isVisible()){if(b=this._getSuggestions(),c=b.filter(".tt-is-under-cursor"),c.removeClass("tt-is-under-cursor"),d=b.index(c)+a,d=(d+1)%(b.length+1)-1,-1===d)return this.trigger("cursorRemoved"),void 0;-1>d&&(d=b.length-1),f=b.eq(d).addClass("tt-is-under-cursor"),this._ensureVisibility(f),this.trigger("cursorMoved",e(f))}},_getSuggestions:function(){return this.$menu.find(".tt-suggestions > .tt-suggestion")},_ensureVisibility:function(a){var b=this.$menu.height()+parseInt(this.$menu.css("paddingTop"),10)+parseInt(this.$menu.css("paddingBottom"),10),c=this.$menu.scrollTop(),d=a.position().top,e=d+a.outerHeight(!0);0>d?this.$menu.scrollTop(c+d):e>b&&this.$menu.scrollTop(c+(e-b))},destroy:function(){this.$menu.off(".tt"),this.$menu=null},isVisible:function(){return this.isOpen&&!this.isEmpty},closeUnlessMouseIsOverDropdown:function(){this.isMouseOverDropdown||this.close()},close:function(){this.isOpen&&(this.isOpen=!1,this.isMouseOverDropdown=!1,this._hide(),this.$menu.find(".tt-suggestions > .tt-suggestion").removeClass("tt-is-under-cursor"),this.trigger("closed"))},open:function(){this.isOpen||(this.isOpen=!0,!this.isEmpty&&this._show(),this.trigger("opened"))},setLanguageDirection:function(a){var b={left:"0",right:"auto"},c={left:"auto",right:" 0"};"ltr"===a?this.$menu.css(b):this.$menu.css(c)},moveCursorUp:function(){this._moveCursor(-1)},moveCursorDown:function(){this._moveCursor(1)},getSuggestionUnderCursor:function(){var a=this._getSuggestions().filter(".tt-is-under-cursor").first();return a.length>0?e(a):null},getFirstSuggestion:function(){var a=this._getSuggestions().first();return a.length>0?e(a):null},renderSuggestions:function(b,d){var e,h,i,j,k,l="tt-dataset-"+b.name,m='<div class="tt-suggestion">%body</div>',n=this.$menu.find("."+l);0===n.length&&(h=a(f.suggestionsList).css(g.suggestionsList),n=a("<div></div>").addClass(l).append(b.header).append(h).append(b.footer).appendTo(this.$menu)),d.length>0?(this.isEmpty=!1,this.isOpen&&this._show(),i=document.createElement("div"),j=document.createDocumentFragment(),c.each(d,function(c,d){d.dataset=b.name,e=b.template(d.datum),i.innerHTML=m.replace("%body",e),k=a(i.firstChild).css(g.suggestion).data("suggestion",d),k.children().each(function(){a(this).css(g.suggestionChild)}),j.appendChild(k[0])}),n.show().find(".tt-suggestions").html(j)):this.clearSuggestions(b.name),this.trigger("suggestionsRendered")},clearSuggestions:function(a){var b=a?this.$menu.find(".tt-dataset-"+a):this.$menu.find('[class^="tt-dataset-"]'),c=b.find(".tt-suggestions");b.hide(),c.empty(),0===this._getSuggestions().length&&(this.isEmpty=!0,this._hide())}}),b}(),l=function(){function b(a){var b,d,f;c.bindAll(this),this.$node=e(a.input),this.datasets=a.datasets,this.dir=null,this.eventBus=a.eventBus,b=this.$node.find(".tt-dropdown-menu"),d=this.$node.find(".tt-query"),f=this.$node.find(".tt-hint"),this.dropdownView=new k({menu:b}).on("suggestionSelected",this._handleSelection).on("cursorMoved",this._clearHint).on("cursorMoved",this._setInputValueToSuggestionUnderCursor).on("cursorRemoved",this._setInputValueToQuery).on("cursorRemoved",this._updateHint).on("suggestionsRendered",this._updateHint).on("opened",this._updateHint).on("closed",this._clearHint).on("opened closed",this._propagateEvent),this.inputView=new j({input:d,hint:f}).on("focused",this._openDropdown).on("blured",this._closeDropdown).on("blured",this._setInputValueToQuery).on("enterKeyed tabKeyed",this._handleSelection).on("queryChanged",this._clearHint).on("queryChanged",this._clearSuggestions).on("queryChanged",this._getSuggestions).on("whitespaceChanged",this._updateHint).on("queryChanged whitespaceChanged",this._openDropdown).on("queryChanged whitespaceChanged",this._setLanguageDirection).on("escKeyed",this._closeDropdown).on("escKeyed",this._setInputValueToQuery).on("tabKeyed upKeyed downKeyed",this._managePreventDefault).on("upKeyed downKeyed",this._moveDropdownCursor).on("upKeyed downKeyed",this._openDropdown).on("tabKeyed leftKeyed rightKeyed",this._autocomplete)}function e(b){var c=a(g.wrapper),d=a(g.dropdown),e=a(b),f=a(g.hint);c=c.css(h.wrapper),d=d.css(h.dropdown),f.css(h.hint).css({backgroundAttachment:e.css("background-attachment"),backgroundClip:e.css("background-clip"),backgroundColor:e.css("background-color"),backgroundImage:e.css("background-image"),backgroundOrigin:e.css("background-origin"),backgroundPosition:e.css("background-position"),backgroundRepeat:e.css("background-repeat"),backgroundSize:e.css("background-size")}),e.data("ttAttrs",{dir:e.attr("dir"),autocomplete:e.attr("autocomplete"),spellcheck:e.attr("spellcheck"),style:e.attr("style")}),e.addClass("tt-query").attr({autocomplete:"off",spellcheck:!1}).css(h.query);try{!e.attr("dir")&&e.attr("dir","auto")}catch(i){}return e.wrap(c).parent().prepend(f).append(d)}function f(a){var b=a.find(".tt-query");c.each(b.data("ttAttrs"),function(a,d){c.isUndefined(d)?b.removeAttr(a):b.attr(a,d)}),b.detach().removeData("ttAttrs").removeClass("tt-query").insertAfter(a),a.remove()}var g={wrapper:'<span class="twitter-typeahead"></span>',hint:'<input class="tt-hint" type="text" autocomplete="off" spellcheck="off" disabled>',dropdown:'<span class="tt-dropdown-menu"></span>'},h={wrapper:{position:"relative",display:"inline-block"},hint:{position:"absolute",top:"0",left:"0",borderColor:"transparent",boxShadow:"none"},query:{position:"relative",verticalAlign:"top",backgroundColor:"transparent"},dropdown:{position:"absolute",top:"100%",left:"0",zIndex:"100",display:"none"}};return c.isMsie()&&c.mixin(h.query,{backgroundImage:"url(data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7)"}),c.isMsie()&&c.isMsie()<=7&&(c.mixin(h.wrapper,{display:"inline",zoom:"1"}),c.mixin(h.query,{marginTop:"-1px"})),c.mixin(b.prototype,d,{_managePreventDefault:function(a){var b,c,d=a.data,e=!1;switch(a.type){case"tabKeyed":b=this.inputView.getHintValue(),c=this.inputView.getInputValue(),e=b&&b!==c;break;case"upKeyed":case"downKeyed":e=!d.shiftKey&&!d.ctrlKey&&!d.metaKey}e&&d.preventDefault()},_setLanguageDirection:function(){var a=this.inputView.getLanguageDirection();a!==this.dir&&(this.dir=a,this.$node.css("direction",a),this.dropdownView.setLanguageDirection(a))},_updateHint:function(){var a,b,d,e,f,g=this.dropdownView.getFirstSuggestion(),h=g?g.value:null,i=this.dropdownView.isVisible(),j=this.inputView.isOverflow();h&&i&&!j&&(a=this.inputView.getInputValue(),b=a.replace(/\s{2,}/g," ").replace(/^\s+/g,""),d=c.escapeRegExChars(b),e=new RegExp("^(?:"+d+")(.*$)","i"),f=e.exec(h),this.inputView.setHintValue(a+(f?f[1]:"")))},_clearHint:function(){this.inputView.setHintValue("")},_clearSuggestions:function(){this.dropdownView.clearSuggestions()},_setInputValueToQuery:function(){this.inputView.setInputValue(this.inputView.getQuery())},_setInputValueToSuggestionUnderCursor:function(a){var b=a.data;this.inputView.setInputValue(b.value,!0)},_openDropdown:function(){this.dropdownView.open()},_closeDropdown:function(a){this.dropdownView["blured"===a.type?"closeUnlessMouseIsOverDropdown":"close"]()},_moveDropdownCursor:function(a){var b=a.data;b.shiftKey||b.ctrlKey||b.metaKey||this.dropdownView["upKeyed"===a.type?"moveCursorUp":"moveCursorDown"]()},_handleSelection:function(a){var b="suggestionSelected"===a.type,d=b?a.data:this.dropdownView.getSuggestionUnderCursor();d&&(this.inputView.setInputValue(d.value),b?this.inputView.focus():a.data.preventDefault(),b&&c.isMsie()?c.defer(this.dropdownView.close):this.dropdownView.close(),this.eventBus.trigger("selected",d.datum,d.dataset))},_getSuggestions:function(){var a=this,b=this.inputView.getQuery();c.isBlankString(b)||c.each(this.datasets,function(c,d){d.getSuggestions(b,function(c){b===a.inputView.getQuery()&&a.dropdownView.renderSuggestions(d,c)})})},_autocomplete:function(a){var b,c,d,e,f;("rightKeyed"!==a.type&&"leftKeyed"!==a.type||(b=this.inputView.isCursorAtEnd(),c="ltr"===this.inputView.getLanguageDirection()?"leftKeyed"===a.type:"rightKeyed"===a.type,b&&!c))&&(d=this.inputView.getQuery(),e=this.inputView.getHintValue(),""!==e&&d!==e&&(f=this.dropdownView.getFirstSuggestion(),this.inputView.setInputValue(f.value),this.eventBus.trigger("autocompleted",f.datum,f.dataset)))},_propagateEvent:function(a){this.eventBus.trigger(a.type)},destroy:function(){this.inputView.destroy(),this.dropdownView.destroy(),f(this.$node),this.$node=null},setQuery:function(a){this.inputView.setQuery(a),this.inputView.setInputValue(a),this._clearHint(),this._clearSuggestions(),this._getSuggestions()}}),b}();!function(){var b,d={},f="ttView";b={initialize:function(b){function g(){var b,d=a(this),g=new e({el:d});b=c.map(h,function(a){return a.initialize()}),d.data(f,new l({input:d,eventBus:g=new e({el:d}),datasets:h})),a.when.apply(a,b).always(function(){c.defer(function(){g.trigger("initialized")})})}var h;return b=c.isArray(b)?b:[b],0===b.length&&a.error("no datasets provided"),h=c.map(b,function(a){var b=d[a.name]?d[a.name]:new i(a);return a.name&&(d[a.name]=b),b}),this.each(g)},destroy:function(){function b(){var b=a(this),c=b.data(f);c&&(c.destroy(),b.removeData(f))}return this.each(b)},setQuery:function(b){function c(){var c=a(this).data(f);c&&c.setQuery(b)}return this.each(c)}},jQuery.fn.typeahead=function(a){return b[a]?b[a].apply(this,[].slice.call(arguments,1)):b.initialize.apply(this,arguments)}}()}(window.jQuery);

$('#inputTo').typeahead({
    hint: true,
    highlight: true,
    minLength: 3, 
    valueKey: 'bank',
    remote: {
        url:'/admin/default/getOurBanks/id/%QUERY',
        dataType:'json'
    },
    template:  '<p style="font-weight:400;font-size:12px">{{bank}} </p> <p style="font-weight:800">{{name}}</span></p>',
    engine: Hogan
  });
     
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
$('.tt-query').css('background-color','#fff');                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
</script>




</body>
</html>
