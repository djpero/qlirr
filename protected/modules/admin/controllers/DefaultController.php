<?php
    class DefaultController extends AdminsController
    {
//        
        
        public function actionIndex()
        {
            $model=new InstantorXml('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['InstantorXml']))
                $model->attributes=$_GET['InstantorXml'];            

            $this->renderPartial('index', array( 
                    'model'=>$model
                ));
        }
        
        public function actionXml($id)
        {
            $model = InstantorXml::model()->findByPk($id);
            
            $this->renderPartial('xml', array('model'=>$model));   
        }

        public function actionComplain()
        {
            $model=new Orders('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Orders']))
                $model->attributes=$_GET['Orders'];

            $this->renderPartial('complain', array('model'=>$model), false, true);   
        }

        public function actionWePaid()
        {
            $model=new Payouts('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Payouts']))
                $model->attributes=$_GET['Payouts'];           

            $this->renderPartial('wePaid', array('model'=>$model), false, true); 
        }

        public function actionReturned()
        {
            $model=new PaymentNotice('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['PaymentNotice']))
                $model->attributes=$_GET['PaymentNotice'];

            $this->renderPartial('returned', array('model'=>$model), false, true);    
        }

        public function actionReturnedPartial()
        {
            $model=new PaymentNotice('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['PaymentNotice']))
                $model->attributes=$_GET['PaymentNotice'];

            $this->renderPartial('returnedPartial', array('model'=>$model), false, true);    
        }

        public function actionLate()
        {
            $model=new PaymentNotice('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['PaymentNotice']))
                $model->attributes=$_GET['PaymentNotice'];

            $this->renderPartial('late', array('model'=>$model), false, true);   
        }

        public function actionForPayment()
        {
            $model=new Payouts('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Payouts']))
                $model->attributes=$_GET['Payouts'];

            $this->renderPartial('forPayment', array('model'=>$model), false, true);    
        }

        public function actionDocuments()
        {
            $model=new Users('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Users']))
                $model->attributes=$_GET['Users'];

            $this->renderPartial('documents', array('model'=>$model), false, true);  
        }

        public function actionVerified()
        {
            $model=new Users('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Users']))
                $model->attributes=$_GET['Users'];

            $this->renderPartial('verified', array('model'=>$model), false, true);  
        }

        public function actionNewUsers()
        {
            $model=new Users('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Users']))
                $model->attributes=$_GET['Users'];

            $this->renderPartial('newUsers', array('model'=>$model), false, true);  
        }
        
        public function actiongetData() {
            $dataFromPost = $_POST['data'];
            switch ($dataFromPost) {
                case 'totalAmountWaitingPayout':
                    $totalPayout = Yii::app()->db->createCommand()
                        ->select('sum(amount) as totalAmount')
                        ->from('payouts')
                        ->where('status_id = 1')
                        ->queryRow();
                    $totalPayoutCount = Yii::app()->db->createCommand()
                        ->select('count(DISTINCT user_id) as totalCount')
                        ->from('payouts')
                        ->where('status_id = 1')
                        ->queryRow();
                    echo $totalPayout['totalAmount'].'|'.$totalPayoutCount['totalCount'];

                    break;
                case 'totalAmountWaitingPayin':
                    $totalPayin = Yii::app()->db->createCommand()
                        ->select('sum(total_amount) as totalAmount')
                        ->from('orders')
                        ->where('orderStatusF_id = 0')
                        ->queryRow();
                    $totalPayinCount = Yii::app()->db->createCommand()
                        ->select('count(id) as totalCount')
                        ->from('orders')
                        ->where('orderStatusF_id = 0')
                        ->queryRow();
                    echo $totalPayin['totalAmount'].'|'.$totalPayinCount['totalCount'];

                    break;
                case 'totalAmountOrdersPending':
                    $totalPayin = Yii::app()->db->createCommand()
                        ->select('sum(total_amount) as totalAmount')
                        ->from('orders')
                        ->where('orderStatus_id = 1')
                        ->queryRow();
                    $totalPayinCount = Yii::app()->db->createCommand()
                        ->select('count(id) as totalCount')
                        ->from('orders')
                        ->where('orderStatus_id = 1')
                        ->queryRow();
                    echo $totalPayin['totalAmount'].'|'.$totalPayinCount['totalCount'];

                    break;
                case 'totalAmountOrdersContracted':
                    $totalPayin = Yii::app()->db->createCommand()
                        ->select('sum(total_amount) as totalAmount')
                        ->from('orders')
                        ->where('orderStatus_id = 2 AND date(date_accepted) = CURDATE()')
                        ->queryRow();
                    $totalPayinCount = Yii::app()->db->createCommand()
                        ->select('count(id) as totalCount')
                        ->from('orders')
                        ->where('orderStatus_id = 2 AND date(date_accepted) = CURDATE()')
                        ->queryRow();
                    echo $totalPayin['totalAmount'].'|'.$totalPayinCount['totalCount'];

                    break;
                case 'totalAmountOrdersNotPaid':
                    $totalPayin = Yii::app()->db->createCommand()
                        ->select('sum(total_amount) as totalAmount')
                        ->from('orders')
                        ->where('orderStatus_id = 2 AND paid=0 and DATE_ADD(date_delivered, INTERVAL 16 DAY)<=CURDATE()')
                        ->queryRow();
                    $totalPayinCount = Yii::app()->db->createCommand()
                        ->select('count(id) as totalCount')
                        ->from('orders')
                        ->where('orderStatus_id = 2 AND paid=0 and DATE_ADD(date_delivered, INTERVAL 16 DAY)<=CURDATE()')
                        ->queryRow();
                    echo $totalPayin['totalAmount'].'|'.$totalPayinCount['totalCount'];

                    break;
                case 'totalAmountOrdersNotSent':
                    $totalPayin = Yii::app()->db->createCommand()
                        ->select('sum(total_amount) as totalAmount')
                        ->from('orders')
                        ->where('orderStatus_id = 2 AND tracking_number IS NULL and DATE_ADD(date_accepted, INTERVAL 5 DAY)<=CURDATE()')
                        ->queryRow();
                    $totalPayinCount = Yii::app()->db->createCommand()
                        ->select('count(id) as totalCount')
                        ->from('orders')
                        ->where('orderStatus_id = 2 AND tracking_number IS NULL and DATE_ADD(date_accepted, INTERVAL 5 DAY)<=CURDATE()')
                        ->queryRow();
                    echo $totalPayin['totalAmount'].'|'.$totalPayinCount['totalCount'];

                    break;
                case 'totalAmountOrdersNewTrackings':
                    $totalPayin = '';
                    $totalPayinCount = Yii::app()->db->createCommand()
                        ->select('count(id) as totalCount')
                        ->from('documents')
                        ->where('sent=0 AND documentType_id=9')
                        ->queryRow();
                    echo $totalPayin['totalAmount'].'|'.$totalPayinCount['totalCount'];

                    break;
                 case 'totalAmountOrdersNewFrauds':
                    $totalPayin = '';
                    $totalPayinCount = Yii::app()->db->createCommand()
                        ->select('count(id) as totalCount')
                        ->from('order_fraud')
                        ->where('notify=0')
                        ->queryRow();
                    echo $totalPayin['totalAmount'].'|'.$totalPayinCount['totalCount'];

                    break;
                default:
                    break;
            }
        }
        
        public function actioncheckEmail() {
            print_r('test');

            $server = '{imap.gmail.com:993/imap/ssl}INBOX';
            $username = 'djpero.84@gmail.com';
            $password = 'odvnjfbklwsbzizx';
            $inbox = imap_open($server,$username,$password) or die('Cannot connect to Gmail: <small>' . imap_last_error().'</small>');
            /* grab emails */
            print_r('povdje sam1');
            $emails = imap_search($inbox,'UNSEEN');
            var_dump($emails);
            /* if emails are returned, cycle through each... */
            if($emails) {
                
                $output = '';
                rsort($emails);
                foreach($emails as $email_number) {

                    $overview = imap_fetch_overview($inbox,$email_number,0);
                    $message = imap_fetchbody($inbox,$email_number,2);

                    $output.= '<div class="toggler '.($overview[0]->seen ? 'read' : 'unread').'">';
                    $output.= '<span class="subject">'.$overview[0]->subject.'</span> ';
                    $output.= '<span class="from">'.$overview[0]->from.'</span>';
                    $output.= '<span class="date">on '.$overview[0]->date.'</span>';
                    $output.= '</div>';

                    $output.= '<div class="body">'.$message.'</div>';
                }

                echo $output;
                                    
                }
                imap_close($inbox);
        }
        public function actionpayouts() {
            $this->renderPartial('payouts');
        }
        public function actionusers() {
            $this->renderPartial('users');
        }
        public function actionshops() {
            $this->renderPartial('shops');
        }
        public function actionuserDetails() {
            $this->renderPartial('userDetails');
        }
        public function actionorders() {
            $this->renderPartial('orders');
        }
        public function actionorderPackage() {
            $this->renderPartial('orderPackage');
        }
        public function actionorderReminders() {
            $this->renderPartial('orderReminders');
        }
        public function actionorderRemindersSend() {
            $this->renderPartial('orderRemindersSend');
        }
        public function actionorderFinance() {
            $this->renderPartial('orderFinance');
        }
        public function actionorderList() {
            $this->renderPartial('orderList');
        }
        public function actionorderDetails() {
            $this->renderPartial('orderDetails');
        }
        public function actionDynamic() {
            $this->renderPartial('dynamic_table');
        }
        public function actionfinance() {
            $this->renderPartial('finance');
        }
        public function actionsettings() {
            $this->renderPartial('settings');
        }
        public function actiongetOrdersTableData() {
            $dataFromPost = $_POST['data'];
            
            $orders = OrdersDao::getAllOrders($dataFromPost);
            $response='';
            $x=0;
            
            if (count($orders)>0) {
                while ($x < count($orders)) {
                    $buyer = UsersDao::getUserById($orders[$x]->buyer_id);
                    $seller = UsersDao::getUserById($orders[$x]->seller_id);
                    $orderStatus = OrderStatusDao::getOrderStatus($orders[$x]->orderStatus_id);
                    // order status
                    if ($orderStatus->id==1) {
                        $packageStatusColor='orange;text-shadow:0px 0px 2px black;';
                    } else if($orderStatus->id==2) {
                        $packageStatusColor='green;text-shadow:0px 0px 2px black;';
                    } else if($orderStatus->id==3) {
                        $packageStatusColor='red;text-shadow:0px 0px 2px black;';    
                    } else if ($orderStatus->id==4) {
                        $packageStatusColor='orange;text-shadow:0px 0px 2px black;';
                    } else if($orderStatus->id==5) {
                        $packageStatusColor='yellow;text-shadow:0px 0px 2px black;';
                    } else if($orderStatus->id==6) {
                        $packageStatusColor='yellowgreen;text-shadow:0px 0px 2px black;';    
                    } else {
                        $packageStatusColor='white;text-shadow:0px 0px 2px black;';  
                    }
                    if ($orders[$x]->date_accepted) {
                        $delayForSendGoods         = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'goods_not_sent_delay'));
                        $lastDateToSendPackageTemp = new DateTime($orders[$x]->date_accepted);
                        $lastDateToSendPackageTemp->modify("+".$delayForSendGoods->setting_value." days"); 
                        $lastDateToSendPackage     = $lastDateToSendPackageTemp->format("Y-m-d H:i:s");  
                    } else {
                       $lastDateToSendPackage = ''; 
                    }
                    $response=$response.
                            '<a href="/admin/default/orderDetails/id/'.$orders[$x]->id.'">'.$orders[$x]->id.'</a>|'.
                            '<span style="font-size:12px">'.'<a style="color:yellow" href="/admin/default/userDetails/id/'.$buyer->id.'">'.$buyer->name.' '.$buyer->surname.'</span>|'.
                            '<span style="font-size:12px">'.'<a style="color:#FFDA85" href="/admin/default/userDetails/id/'.$seller->id.'">'.$seller->name.' '.$seller->surname.'</span>|'.
                            '<a style="color:#8CCFFF" href="/admin/default/orderDetails/id/'.$orders[$x]->id.'">'.substr($orders[$x]->article_name,0,30).'</a>|'.
                            $orders[$x]->tracking_number.'|'.
                            $orders[$x]->total_amount.'</a>|'.
                            '<span style="color:'.$packageStatusColor.'">'.$orderStatus->name.'</span>|'.
                            '<span style="font-size:12px">'.$orders[$x]->date_accepted.'</span>|'.
                            '<span style="font-size:12px">'.$lastDateToSendPackage.'</span>|';
                    $x++;
                }
                 echo count($orders).'|'.$response;
            } else {
                echo '1|-|-|-|-|-|-|-|-|-';
            }
         } 
         
         public function actiongetRemindersTableData() {
            $dataFromPost = $_POST['data'];
            
            $orders = DocumentsDao::getDocumentsByType(9, $dataFromPost); // type 9 je reminder - type 8 je invoice
            $x=0;
            
            if (count($orders)>0) {
                while ($x < count($orders)) {
                    $buyer      = UsersDao::getUserById($orders[$x]->user_id);
                    $orderData  = OrdersDao::getOrderById($orders[$x]->order_id);
                    $response=$response.
                            '<a href="/admin/default/orderDetails/id/'.$orders[$x]->order_id.'">'.$orders[$x]->order_id.'</a>|'.
                            '<span style="font-size:12px">'.'<a style="color:yellow" href="/admin/default/userDetails/id/'.$buyer->id.'">'.$buyer->name.' '.$buyer->surname.'</span>|'.
                            '<span>'.$orders[$x]->created_date.'</span>|'.
                            '<span>'.$orderData->date_due.'</span>|'.
                            '<span>'.$orders[$x]->penality.'</span>|'.
                            '<span>'.$orderData->total_amount.'</span>|';
                    $x++;
                }
                 echo count($orders).'|'.$response;
            } else {
                echo '1|-|-|-|-|-|-';
            }
         } 
         
         public function actiongetRemindersForSendTableData() {
            $dataFromPost = $_POST['data'];
            
            $orders = DocumentsDao::getDocumentsByTypeSend(9, $dataFromPost); // type 9 je reminder - type 8 je invoice
            $x=0;
            
            if (count($orders)>0) {
                while ($x < count($orders)) {
                    $buyer      = UsersDao::getUserById($orders[$x]->user_id);
                    $address    = UserAddressDao::getUserAddressesByTypeAndUserId($buyer->id,0);
                    $orderData  = OrdersDao::getOrderById($orders[$x]->order_id);
                    
                            if ($dataFromPost ==0) {
                                $response=$response.
                                    '<a href="/admin/default/orderDetails/id/'.$orders[$x]->order_id.'">'.$orders[$x]->order_id.'</a>|'.
                                    '<span style="font-size:14px">'.'<a style="color:yellow" href="/admin/default/userDetails/id/'.$buyer->id.'">'.$buyer->name.' '.$buyer->surname.'</span>|'.
                                    '<span>'.$address[0]->street.', '.$address[0]->post_code.' '.$address[0]->city.'</span>|'.
                                    '<span>'.$orders[$x]->name.'</span>|'.
                                    '<span>'.$orders[$x]->created_date.'</span>|'.
                                    '<span><button id="'.$orders[$x]->id.'" class="btn btn-success btn-xs sendBTN" data-target="#sendModal" data-toggle="modal">Send</button> <button id="'.$orders[$x]->id.'" class="btn btn-danger btn-xs canBTN"  data-target="#delModal" data-toggle="modal">Cancel</button></span>|';
                            } else {
                                $response=$response.
                                    '<a href="/admin/default/orderDetails/id/'.$orders[$x]->order_id.'">'.$orders[$x]->order_id.'</a>|'.
                                    '<span style="font-size:14px">'.'<a style="color:yellow" href="/admin/default/userDetails/id/'.$buyer->id.'">'.$buyer->name.' '.$buyer->surname.'</span>|'.
                                    '<span>'.$address[0]->street.', '.$address[0]->post_code.' '.$address[0]->city.'</span>|'.
                                    '<span>'.$orders[$x]->name.'</span>|'.
                                    '<span>'.$orders[$x]->date_sent.'</span>|'.
                                    '<span></span>|';
                            }
                           
                    $x++;
                }
                 echo count($orders).'|'.$response;
            } else {
                echo '1|-|-|-|-|-|-';
            }
         } 
         
         public function actiongetOrdersTableDataF() {
            $dataFromPost = $_POST['data'];
            
            $orders = OrdersDao::getAllOrdersF($dataFromPost);
            
            
            $response='';
            $x=0;
            //return count($orders);
            if (count($orders)>0) {
                while ($x < count($orders)) {
                    $buyer = UsersDao::getUserById($orders[$x]->buyer_id);
                    $orderStatus = OrderStatusFDao::getOrderStatus($orders[$x]->orderStatusF_id);
                    // order status
                    if ($orderStatus->id==1) {
                        $packageStatusColor='orange;text-shadow:0px 0px 2px black;';
                    } else if($orderStatus->id==2) {
                        $packageStatusColor='green;text-shadow:0px 0px 2px black;';
                    } else if($orderStatus->id==3) {
                        $packageStatusColor='red;text-shadow:0px 0px 2px black;';    
                    } else if ($orderStatus->id==4) {
                        $packageStatusColor='orange;text-shadow:0px 0px 2px black;';
                    } else if($orderStatus->id==5) {
                        $packageStatusColor='yellow;text-shadow:0px 0px 2px black;';
                    } else if($orderStatus->id==6) {
                        $packageStatusColor='yellowgreen;text-shadow:0px 0px 2px black;';
                    } else if($orderStatus->id==7) {
                        $packageStatusColor='red;text-shadow:0px 0px 2px black;';   
                    } else {
                        $packageStatusColor='#F8FFDE;text-shadow:0px 0px 2px black;';  
                    }
                    if ($orders[$x]->date_accepted) {
                        $delayForSendGoods         = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'goods_not_sent_delay'));
                        $lastDateToSendPackageTemp = new DateTime($orders[$x]->date_accepted);
                        $lastDateToSendPackageTemp->modify("+".$delayForSendGoods->setting_value." days"); 
                        $lastDateToSendPackage     = $lastDateToSendPackageTemp->format("Y-m-d H:i:s");  
                    } else {
                       $lastDateToSendPackage = ''; 
                    }
                    
                    //$pathImg = Yii::app()->basePath.'/documents/screenshots/'.$orders[$x]->merchant_id.$orders[$x]->order_reference.'.jpg';
//                    $pathImg = '/ws/test/peydo/code/protected/documents/screenshots/1361183.jpg';
//                    $articleImg = Yii::app()->assetManager->publish($pathImg);
                    if($dataFromPost==1) {
                        $actionLink = '<span style="font-size:12px"<a class="btn btn-sm btn-success" style="cursor:pointer" onclick="changeToCourt('.$orders[$x]->id.');">Court</a></span>|';
                    } else {
                        $actionLink = '-|'; 
                    }
                    $response=$response.
                            $orders[$x]->id.'|'.
                            '<span style="font-size:12px;">'.'<a style="color:yellow" href="/admin/default/userDetails/id/'.$buyer->id.'">'.$buyer->name.' '.$buyer->surname.'</span>|'.
                            '<a style="color:#8CCFFF" href="/admin/default/orderDetails/id/'.$orders[$x]->id.'">'.$orders[$x]->payment_reference.'</a>|'.
                            '<a style="color:#8CCFFF"  href="/admin/default/orderDetails/id/'.$orders[$x]->id.'">'.substr($orders[$x]->code,0,30).'</a>|'.
                            $orders[$x]->total_amount.'</a>|'.
                            '<span style="color:'.$packageStatusColor.'">'.$orderStatus->name.'</span>|'.
                            '<span style="font-size:12px">'.$orders[$x]->date_accepted.'</span>|'.
                            '<span style="font-size:12px">'.$lastDateToSendPackage.'</span>|'.
                            $actionLink;
                    $x++;
                }
                 echo count($orders).'|'.$response;
            } else {
                echo '1|-|-|-|-|-|-|-|-|-';
            }
         }
         
         public function actiongetPayin() {
            $dataFromPost = $_POST['data'];
            
            $payins = PayinsDao::getAll(0);
            $response='';
            $x=0;
            
            if (count($payins)>0) {
                while ($x < count($payins)) {
                    
                    $response=$response.
                            $payins[$x]->order_id.'|'.
                            $payins[$x]->payment_reference.'|'.
                            $payins[$x]->bank_account_from.'|'.
                            $payins[$x]->bank_account_to.'|'.
                            $payins[$x]->amount.'|'. 
                            $payins[$x]->name.'|'.
                            $payins[$x]->statement_no.'|'.
                            $payins[$x]->pay_date.'|'.
                            $payins[$x]->created_at.'|'.
                            '<a class="btn btn-danger btn-xs" style="cursor:pointer" onclick="delPayin('.$payins[$x]->id.')">Del</a>&nbsp;'.
                            '<button data-id="'.$payins[$x]->id.'" type="button" class="btn btn-warning btn-xs editBTN" data-backdrop="false" data-target="#myModal" data-toggle="modal">Edit</button>|';
                    $x++;
                }
                 echo count($payins).'|'.$response;
            } else {
                echo '1|-|-|-|-|-|-|-|-|-|-';
            }
         }
         
         public function printMenu($currentPage) {
             
             $curClass[$currentPage] = 'current';
             $noMenus = 7;
             $menu[0] = '<li class="'.$curClass[0].'"> <a href="/admin/default"> <i class="icon-dashboard"></i> Dashboard </a> </li>';
             $menu[1] = '<li class="'.$curClass[1].'"> <a href="/admin/default/users"> <i class="icon-user"></i> Users </a> </li>';
             $menu[2] = '<li class="'.$curClass[2].'"> <a href="/admin/default/shops"> <i class="icon-shopping-cart"></i> Shops </a> </li>';             
             $menu[3] = '<li class="'.$curClass[3].'"> <a href="/admin/default/payouts"> <i class="icon-money"></i> Payouts </a> </li>';
             $menu[4] = '<li class="'.$curClass[4].'"> <a href="#"> <i class="icon-book"></i> Orders <i class="arrow icon-angle-left"></i></a>
                            <ul class="sub-menu">
                              <li> <a href="/admin/default/orderFinance"> <i class="icon-angle-right"></i> Finance </a> </li>
                              <li> <a href="/admin/default/orderReminders"> <i class="icon-angle-right"></i> Reminders </a> </li>
                              <li> <a href="/admin/default/orderRemindersSend"> <i class="icon-angle-right"></i> Reminders for send </a> </li>
                            </ul>
                         </li>';
             $menu[5] = '<li class="'.$curClass[5].'"> <a href="/admin/default/finance"> <i class="icon-bar-chart"></i> Finance </a> </li>';
             $menu[6] = '<li class="'.$curClass[6].'"> <a href="/admin/default/settings"> <i class="icon-wrench"></i> Settings </a> </li>';
             $x=0;
             while ($x < $noMenus) {
                 $response.= $menu[$x];
                 $x++;
             }
             echo $response;
         }

         public function actiongetPRef() {
             $dataFromGet = $_GET['id'];
             $orders = OrdersDao::getAllOrdersLike($dataFromGet);
             $results = array();
             $x=0;
             if (count($orders)>0) {
                while ($x < count($orders)) {
                    $buyer = UsersDao::getUserById($orders[$x]->buyer_id);
                    $results[] = array('ref' => $orders[$x]->payment_reference,
                                       'buyer'=> $buyer->name.' '.$buyer->surname,
                                       'amount' =>$orders[$x]->total_amount);
                    $x++;
                }
             } else {
                 $ordersName = OrdersDao::getAllOrdersWithName($dataFromGet);
                 while ($x < count($ordersName)) {
                    $buyer = UsersDao::getUserById($ordersName[$x]->buyer_id);
                    $results[] = array('ref' => $ordersName[$x]->payment_reference,
                                       'buyer'=> $buyer->name.' '.$buyer->surname,
                                       'amount' =>$ordersName[$x]->total_amount);
                    $x++;
                }
             }
            echo json_encode($results);
           // echo var_dump($results);
         }
         public function actiongetOurBanks() {
             $dataFromGet = $_GET['id'];
              $q = new CDbCriteria();
              $q->addSearchCondition('setting_name', $dataFromGet);
              $q->addSearchCondition('setting_type', '101');

             $banks = ApplicationSettings::model()->findAll( $q );
             $results = array();
             $x=0;
             while ($x < count($banks)) {
                 $results[] = array('bank' => $banks[$x]->setting_value,
                                    'name' =>$banks[$x]->setting_name);
                 $x++;
             }
            echo json_encode($results);
            // echo var_dump($results);
         }
         
         
         public function actioncheckOrderPayPerctentage() {
             $dataFromPost = $_POST['data'];
             $orders = OrdersDao::getPercByRef($dataFromPost);
             echo $orders->pay_percent.'|'.$orders->total_amount;
         }
         
         public function actionsaveNewPayin() {
            $dataFromPost           = explode('|',$_POST['data']);
            $orderID                = OrdersDao::getPercByRef($dataFromPost[2]);
            $orderID->pay_percent   = $dataFromPost[6]/100;
            $orderID->paid_amount   = ($orderID->paid_amount+$dataFromPost[5]);
            $buyer = UsersDao::getUserById($orderID->buyer_id);
            if ($dataFromPost[6]/100<100) {

                 $orderID->orderStatusF_id = 2;

            } else if($dataFromPost[6]/100===100) {
                $orderID->orderStatusF_id = 6;
                $buyer->creditLimit_expends = $buyer->creditLimit_expends - ($orderID->total_amount - $orderID->penality - $orderID->fee);
                $buyer->creditLimit_remaining = $buyer->creditLimit_remaining + ($orderID->total_amount - $orderID->penality - $orderID->fee);
                $buyer->update(array('creditLimit_expends', 'creditLimit_remaining'));
            } else {
                $orderID->orderStatusF_id = 7;
                $buyer->creditLimit_expends = $buyer->creditLimit_expends - ($orderID->total_amount - $orderID->penality - $orderID->fee);
                $buyer->creditLimit_remaining = $buyer->creditLimit_remaining + ($orderID->total_amount - $orderID->penality - $orderID->fee);
                $buyer->update(array('creditLimit_expends', 'creditLimit_remaining'));
            }
 
            $orderID->update(array('pay_percent', 'orderStatusF_id', 'paid_amount'));
            
            $newPayin = new Payins;
            $newPayin->order_id			= $orderID->id;				
            $newPayin->payment_reference	= $dataFromPost[2];			
            $newPayin->statement_no		= $dataFromPost[0];		
            $newPayin->pay_date			= $dataFromPost[1];		
            $newPayin->bank_account_from	= $dataFromPost[3];			
            $newPayin->bank_account_to		= $dataFromPost[4];			
            $newPayin->name			= '';		
            $newPayin->description              = '';		
            $newPayin->amount			= $dataFromPost[5];			
            $newPayin->status			= 0;
            $newPayin->type			= 0;
            $newPayin->user_id			= $dataFromPost[7];
            $newPayin->save();
            
            // delete old payin 
            if ($dataFromPost[8]==1) {
                $this->delPayin($dataFromPost[9]);
            }
            echo 'ok'; 
            
         }
         public function actionbtnSetValueToBase() {
             $dataFromPost = explode("|", $_POST['data']);
             $valSet = $dataFromPost[1];
             if ($valSet=='1') {
                 $valSet = '0';
             } else {
                 $valSet = '1';
             }
     
             switch ($dataFromPost[0]) {
                 case 'btnSMS':
                     echo 'SMS OFF??!!|Are you sure to disable SMS sending to users?';
                     $appSetChange = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'smsEnabled'));
                     $appSetChange->setting_value = $valSet;
                     $appSetChange->time_updated  = date('Y-m-d H:i:s',time());
                     $appSetChange->update('setting_value', 'time_updated');
                     break;
                 case 'btnReminder':
                     echo 'Reminders OFF??!!|Are you sure to disable REMINDERS?<br>When is off, this option will not increase Total Value of Offer for Reminder value.';
                     $appSetChange = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'remindersEnabled'));
                     $appSetChange->setting_value = $valSet;
                     $appSetChange->time_updated  = date('Y-m-d H:i:s',time());
                     $appSetChange->update('setting_value', 'time_updated');
                     break;

                 default:
                     break;
             }
             
         }
         

         
          public function actioninputSetValueToBase() {
             $dataFromPost = explode("|", $_POST['data']);
             $valSet = $dataFromPost[1];
             switch ($dataFromPost[0]) {
                 case 'inputBisPerc':

                     $appSetChange = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'bisGateMinProc'));
                     $appSetChange->setting_value = $valSet;
                     $appSetChange->time_updated  = date('Y-m-d H:i:s',time());
                     $appSetChange->update('setting_value', 'time_updated');
                     echo $appSetChange->setting_value;
                     break;
                 
                 case 'inputBisGross':

                     $appSetChange = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'bisGateMinIncome'));
                     $appSetChange->setting_value = $valSet;
                     $appSetChange->time_updated  = date('Y-m-d H:i:s',time());
                     $appSetChange->update('setting_value', 'time_updated');
                     echo $appSetChange->setting_value;
                     break;
                  
                 case 'inputCreditLimit':

                     $appSetChange = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'newUserCreditLimit'));
                     $appSetChange->setting_value = $valSet;
                     $appSetChange->time_updated  = date('Y-m-d H:i:s',time());
                     $appSetChange->update('setting_value', 'time_updated');
                     echo $appSetChange->setting_value;
                     break;
                   
                 case 'inputCreditLimitS':

                     $appSetChange = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'newUserCreditLimitS'));
                     $appSetChange->setting_value = $valSet;
                     $appSetChange->time_updated  = date('Y-m-d H:i:s',time());
                     $appSetChange->update('setting_value', 'time_updated');
                     echo $appSetChange->setting_value;
                     break;
                  
                case 'inputTimeReturnLimitS':

                     $appSetChange = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'timeReturnLimitS'));
                     $appSetChange->setting_value = $valSet;
                     $appSetChange->time_updated  = date('Y-m-d H:i:s',time());
                     $appSetChange->update('setting_value', 'time_updated');
                     echo $appSetChange->setting_value;
                     break;
                      
                case 'inputCancelOffer':

                     $appSetChange = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'timecancelOffer'));
                     $appSetChange->setting_value = $valSet;
                     $appSetChange->time_updated  = date('Y-m-d H:i:s',time());
                     $appSetChange->update('setting_value', 'time_updated');
                     echo $appSetChange->setting_value;
                     break;
                 
                 case 'inputBank1':

                     $appSetChange = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'Handelsbanken'));
                     $appSetChange->setting_value = $valSet;
                     $appSetChange->time_updated  = date('Y-m-d H:i:s',time());
                     $appSetChange->update('setting_value', 'time_updated');
                     echo $appSetChange->setting_value;
                     break;
                        
                 case 'inputBank2':

                     $appSetChange = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'Nordea'));
                     $appSetChange->setting_value = $valSet;
                     $appSetChange->time_updated  = date('Y-m-d H:i:s',time());
                     $appSetChange->update('setting_value', 'time_updated');
                     echo $appSetChange->setting_value;
                     break;    
                 
                 case 'inputBank3':

                     $appSetChange = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'SEB'));
                     $appSetChange->setting_value = $valSet;
                     $appSetChange->time_updated  = date('Y-m-d H:i:s',time());
                     $appSetChange->update('setting_value', 'time_updated');
                     echo $appSetChange->setting_value;
                     break;
                 
                 case 'inputBank4':

                     $appSetChange = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'Swedbank'));
                     $appSetChange->setting_value = $valSet;
                     $appSetChange->time_updated  = date('Y-m-d H:i:s',time());
                     $appSetChange->update('setting_value', 'time_updated');
                     echo $appSetChange->setting_value;
                     break;
                                  
                 case 'inputBank5':

                     $appSetChange = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'Danske Bank'));
                     $appSetChange->setting_value = $valSet;
                     $appSetChange->time_updated  = date('Y-m-d H:i:s',time());
                     $appSetChange->update('setting_value', 'time_updated');
                     echo $appSetChange->setting_value;
                     break;
                                  
                 case 'inputBank6':

                     $appSetChange = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'Skandiabanken'));
                     $appSetChange->setting_value = $valSet;
                     $appSetChange->time_updated  = date('Y-m-d H:i:s',time());
                     $appSetChange->update('setting_value', 'time_updated');
                     echo $appSetChange->setting_value;
                     break;
                                                   
                 case 'inputBank7':

                     $appSetChange = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'ICA Banken'));
                     $appSetChange->setting_value = $valSet;
                     $appSetChange->time_updated  = date('Y-m-d H:i:s',time());
                     $appSetChange->update('setting_value', 'time_updated');
                     echo $appSetChange->setting_value;
                     break;
                                                     
                 case 'inputreminder1days':

                     $appSetChange = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'delay_not_paid'));
                     $appSetChange->setting_value = $valSet;
                     $appSetChange->time_updated  = date('Y-m-d H:i:s',time());
                     $appSetChange->update('setting_value', 'time_updated');
                     echo $appSetChange->setting_value;
                     break;
                                                        
                 case 'inputreminder1amount':

                     $appSetChange = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'delay_not_paid_amount'));
                     $appSetChange->setting_value = $valSet;
                     $appSetChange->time_updated  = date('Y-m-d H:i:s',time());
                     $appSetChange->update('setting_value', 'time_updated');
                     echo $appSetChange->setting_value;
                     break;
                 
                  case 'inputreminder2days':

                     $appSetChange = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'delay_not_paid1'));
                     $appSetChange->setting_value = $valSet;
                     $appSetChange->time_updated  = date('Y-m-d H:i:s',time());
                     $appSetChange->update('setting_value', 'time_updated');
                     echo $appSetChange->setting_value;
                     break;
                                                        
                 case 'inputreminder2amount':

                     $appSetChange = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'delay_not_paid_amount1'));
                     $appSetChange->setting_value = $valSet;
                     $appSetChange->time_updated  = date('Y-m-d H:i:s',time());
                     $appSetChange->update('setting_value', 'time_updated');
                     echo $appSetChange->setting_value;
                     break;
                 
                  case 'inputreminder3days':

                     $appSetChange = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'delay_not_paid2'));
                     $appSetChange->setting_value = $valSet;
                     $appSetChange->time_updated  = date('Y-m-d H:i:s',time());
                     $appSetChange->update('setting_value', 'time_updated');
                     echo $appSetChange->setting_value;
                     break;
                                                        
                 case 'inputreminder3amount':

                     $appSetChange = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'delay_not_paid_amount2'));
                     $appSetChange->setting_value = $valSet;
                     $appSetChange->time_updated  = date('Y-m-d H:i:s',time());
                     $appSetChange->update('setting_value', 'time_updated');
                     echo $appSetChange->setting_value;
                     break;
                 
                  case 'inputreminder4days':

                     $appSetChange = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'delay_not_paid3'));
                     $appSetChange->setting_value = $valSet;
                     $appSetChange->time_updated  = date('Y-m-d H:i:s',time());
                     $appSetChange->update('setting_value', 'time_updated');
                     echo $appSetChange->setting_value;
                     break;
                                                        
                 case 'inputreminder4amount':

                     $appSetChange = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'delay_not_paid_amount3'));
                     $appSetChange->setting_value = $valSet;
                     $appSetChange->time_updated  = date('Y-m-d H:i:s',time());
                     $appSetChange->update('setting_value', 'time_updated');
                     echo $appSetChange->setting_value;
                     break;
                 default:
                     break;
             }
             
         }
         
         public function actionupdatePayout() {
             $dataFromPost = explode("|", $_POST['data']);
             $updatePayout = PayoutsDao::getPayoutByPayoutId($dataFromPost[0]);
             $updatePayout->payment_date            = $dataFromPost[1];
             $updatePayout->payment_date_updated    = date('Y-m-d H:i:s',time());
             $updatePayout->status_id               = 3;
             $updatePayout->userBank                = $dataFromPost[2];
             $updatePayout->paid                    = 1;
             $updatePayout->update(array('payment_date', 'payment_date_updated', 'status_id', 'paid', 'userBank'));
             
             // ovdje ide update na order paid i slanje sms-ova
                
                $modelOrder     = OrdersDao::getOrderById($updatePayout->order_id);
                $pathPDFBuyer   = $this->generatePDF($modelOrder->id, true, 'buyer'); // generisanje pdf
                $pathPDFSeller  = $this->generatePDF($modelOrder->id, false, 'seller'); // generisanje pdf
               // $pathTnxPDF     = $this->generateTnxPDF($modelOrder->id);
                $seller         = UsersDao::getUserById($modelOrder->seller_id);
                $buyer          = UsersDao::getUserById($modelOrder->buyer_id);
                $payValue       = number_format($updatePayout->amount, 0, '.', '');
                
                $textSeller = "Hej! Vi har gjort en utbetalning på ".$payValue."kr till kontonummer ".$dataFromPost[2].". Lämna över eller skicka varan inom 5 dagar. Tack för att du använder Peydo. Leveransadress och kontrakt hittar du här: qlirr.com/faktura/IS".substr(date("Y"),-2)."-".$modelOrder->id.".";
                $textBuyer  = "Hej! Vi har betalat säljaren för den vara du köpt. Varan skickas eller lämnas över inom 5 dagar. Här är din faktura (qlirr.com/faktura/ID".substr(date("Y"),-2)."-".$modelOrder->id."). Tack för att du använder Peydo.";
                BeepSendSMS::sendSMS($seller->mobile_number,$textSeller); // PERO - vratiti na $seller->mobile_number
                BeepSendSMS::sendSMS($buyer->mobile_number,$textBuyer);   // PERO - vratiti na $buyer->mobile_number
            
             echo 'ok';
         }
         public function generateTnxPDF($id) {
             		Yii::import('ext.scrape.SimpleHTMLDOM');
                        $simpleHTML = new SimpleHTMLDOM;
                        $hash = '42e47d0ca7a5e2b96e2d46449cf2a2c9199b143b919f9a1ad8b4421b7c72d5d2';
                        $link = 'http://qlirr.com/site/tnxpage/data/'.$hash.'|'.$id;
                        $html = $simpleHTML->file_get_html($link);
                        $pathToPdf="/ws/prod/qlirr/code/protected/documents/pdf/tnx/tnx_".$id.".pdf";
                        PdfGenerator::generatePdfTcpdf($html,false,$pathToPdf );
                        return $pathToPdf;
         }
         
        public function actionsendSMS() {
             $appSetChange = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'smsEnabled'));
             if ($appSetChange->setting_value==1) {
                $dataFromPost = explode("|", $_POST['data']);
                BeepSendSMS::sendSMS($dataFromPost[0],$dataFromPost[1]);
                echo 'ok';
             } else {
                echo '#error:SMS function off.';
             }

         }
         
         public function actionsaveTracking() {
             $dataFromPost = explode("|", $_POST['data']);
             
             $order = OrdersDao::getOrderById($dataFromPost[0]);
             $order->tracking_number = $dataFromPost[1];
             $order->update('tracking_number');
             echo 'ok';
         }
         public function actionsavePenality() {
             $dataFromPost = explode("|", $_POST['data']);
             
             $order = OrdersDao::getOrderById($dataFromPost[0]);
             $order->penality = $dataFromPost[1];
             $order->update('penality');
             echo 'ok';
         }
         
        
         public function actionchangeFinancialStatus() {
             $dataFromPost = $_POST['data'];
             
             $order = OrdersDao::getOrderById($dataFromPost);
             $order->orderStatusF_id = 3;
             $order->update('orderStatusF_id');
             echo 'ok';
         }
         
         public function actiondelPayin() {
             $dataFromPost=$_POST['data'];
             $payin = PayinsDao::getPayinById($dataFromPost);
             // ovdje provjeriti da li order se vraca na partiali paid ili ne placeni
             // provjeriti korisnika i njegove limite
             $order = OrdersDao::getOrderById($payin->order_id);
             $percent = $order->pay_percent - (($payin->amount/$order->total_amount)*100);
             $order->pay_percent = $percent;
             
             $buyer = UsersDao::getUserById($order->buyer_id);

             if ($percent===100) {
                $order->orderStatusF_id = 6;
             } else if ($percent > 100) {
                $order->orderStatusF_id = 7;
             } else if(round($percent)=='0') {
                $order->orderStatusF_id = 0;
                $buyer->creditLimit_expends     = $buyer->creditLimit_expends   + ($order->total_amount - $order->fee);
                $buyer->creditLimit_remaining   = $buyer->creditLimit_remaining - ($order->total_amount - $order->fee);
                $buyer->update(array('creditLimit_expends', 'creditLimit_remaining'));   
             } else {
               $order->orderStatusF_id = 2;
             }
             $order->update(array('pay_percent', 'orderStatusF_id'));
             
             $payin->active = 0;
             $payin->update(array('active'));
             echo 'ok';
          }
          
          public function delPayin($id) {
             $dataFromPost=$id;
             $payin = PayinsDao::getPayinById($dataFromPost);
             // ovdje provjeriti da li order se vraca na partiali paid ili ne placeni
             // provjeriti korisnika i njegove limite
             $order = OrdersDao::getOrderById($payin->order_id);
             $percent = $order->pay_percent - (($payin->amount/$order->total_amount)*100);
             $order->pay_percent = $percent;
             
             $buyer = UsersDao::getUserById($order->buyer_id);

             if ($percent===100) {
                $order->orderStatusF_id = 6;
             } else if ($percent > 100) {
                $order->orderStatusF_id = 7;
             } else if(round($percent)=='0') {
                $order->orderStatusF_id = 0;
                $buyer->creditLimit_expends     = $buyer->creditLimit_expends   + ($order->total_amount - $order->fee);
                $buyer->creditLimit_remaining   = $buyer->creditLimit_remaining - ($order->total_amount - $order->fee);
                $buyer->update(array('creditLimit_expends', 'creditLimit_remaining'));   
             } else {
               $order->orderStatusF_id = 2;
             }
             $order->update(array('pay_percent', 'orderStatusF_id'));
             
             $payin->active = 0;
             $payin->update(array('active'));
           
          }
          
          public function actiongetPayinById() {
              $dataFromPost = $_POST['data'];
              $payin = PayinsDao::getPayinById($dataFromPost);
              echo $payin->statement_no.'|'.$payin->payment_reference.'|'.$payin->bank_account_from.'|'.$payin->bank_account_to.'|'.$payin->amount;
          }
          public function actiongetUserBankByPayoutId() {
              $dataFromPost = $_POST['data'];
              $payout = PayoutsDao::getPayoutByPayoutId($dataFromPost);
              echo $payout->userBank;
          }
          public function actionincreaseLimit() {
              $dataFromPost = explode("|", $_POST['data']);
              $user = UsersDao::getUserById($dataFromPost[0]);
              if ($dataFromPost[2]=='1') {
                  $user->creditLimit_remaining       = ($dataFromPost[1]- ($user->creditLimit_expends+$user->creditLimit_reserved));
                  $user->credit_limit                = $dataFromPost[1];
                  
                  $user->update(array('credit_limit', 'creditLimit_remaining'));
                  echo 'b';
              } else {
                  $user->credit_limit_s_remaining    = ($dataFromPost[1]-$user->credit_limit_s_expends);
                  $user->credit_limit_s              = $dataFromPost[1];
                  
                  $user->update(array('credit_limit_s', 'credit_limit_s_remaining'));
                  echo 's';
              }
   
              
          }
          
          public function actionsaveNewReminder() {
              $dataFromPost = explode("|", $_POST['data']);
              
              $reminder = new Remi;
              $reminder->name       = $dataFromPost[0];
              $reminder->value      = $dataFromPost[1];
              $reminder->value2     = $dataFromPost[2];
              $reminder->type       = 1;
              $reminder->active     = 1;
              $reminder->save();
              echo 'ok';
              
          }
          
           public function actionsaveNewComment() {
              $dataFromPost = explode("|", $_POST['data']);
              
              $comment                  = new OrderCo;
              $comment->order_id        = $dataFromPost[2];
              $comment->comment         = $dataFromPost[0];
              $comment->user_created    = $dataFromPost[1];
              $comment->save();
              echo 'ok';
              
          }
          
               
           public function actionsaveNewCommentShop() {
              $dataFromPost = explode("|", $_POST['data']);
              
              $comment                  = new ShopComments;
              $comment->shop_id         = $dataFromPost[2];
              $comment->comment         = $dataFromPost[0];
              $comment->user_created    = $dataFromPost[1];
              $comment->save();
              echo 'ok';
              
          }
          public function actiondelService() {
              $dataFromPost = $_POST['data'];
              $service = ServiceFeesDao::model()->findByPk($dataFromPost);
              $service->delete();
              echo 'ok';
          }
          
          public function actionnewServiceSave() {
              $dataFromPost = explode("|", $_POST['data']);
              
              if ($dataFromPost[5]=='new') {
                  $service = new ServiceFees;
              } else {
                  $service = ServiceFeesDao::model()->findByPk($dataFromPost[5]);
              }
              
              $service->service_id      = $dataFromPost[4];
              $service->from            = $dataFromPost[0];
              $service->to              = $dataFromPost[1];
              $service->fixed           = $dataFromPost[2];
              $service->percentage      = $dataFromPost[3];
              $service->include_vat     = 1;
              $service->installment_id  = 1;
              $service->status          = 1;
              if ($dataFromPost[5]=='new') {
                $service->save();
              } else {
                 $service->update(array('service_id', 'from', 'to', 'fixed', 'percentage', 'include_vat', 'installment_id', 'status')); 
              }
              
          }
          public function actionreminderSend() {
              $dataFromPost = $_POST['data'];
              
              $reminder = Documents::model()->findByPk($dataFromPost);
              $reminder->sent = 1;
              $reminder->date_sent = date('Y-m-d H:i:s');
              $reminder->update('sent');
              echo $dataFromPost;
          }
          
          public function actioncancelreminderSend() {
              $dataFromPost = $_POST['data'];
              
              $reminder = Documents::model()->findByPk($dataFromPost);
              $reminder->sent = 2;
              $reminder->date_sent = date('Y-m-d H:i:s');
              $reminder->update('sent');
              echo $dataFromPost;
          }
          
          public function actionsaveNewChargeback() {
                $dataFromPost = explode("|", $_POST['data']);
               
                $order = OrdersDao::getOrderById($dataFromPost[1]);
  
                if ($dataFromPost[0]==='B') {
                    $user = UsersDao::getUserById($order->buyer_id);
                } else {
                    $user = UsersDao::getUserById($order->seller_id);
                }

                $chargebackAmount   = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'chargeback_amount'));
                $chargebackExtDays  = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'chargeback_Ext_days'));
                $chargebackVAT      = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'vatRate'));
                $dateDueValue       = $chargebackExtDays->setting_value;
                $dateDueTemp        = new DateTime(date("Y-m-d H:i:s"));
                $dateDue            = $dateDueTemp->modify("+ ".$dateDueValue." days");
                
                $tomorrow           = mktime(9, 0, 0, $dateDue->format('m'), $dateDue->format('d')+1, $dateDue->format('Y'));
                $nameOfDoc          = substr(date("Y"),-2)."-".$order->id.$this->RandomCode(4);
                
                $chargeback = new Chargeback;
                $chargeback->user_id            =  $user->id;       
                $chargeback->order_id           =  $order->id;
                $chargeback->finance_status_id  =  0;
                $chargeback->netto              =  $chargebackAmount->setting_value;
                $chargeback->vat                =  ($chargebackAmount->setting_value*($chargebackVAT->setting_value/100));
                $chargeback->brutto             =  ($chargeback->netto+$chargeback->vat);
                $chargeback->penality           =  0;
                $chargeback->penalityLevel      =  0;
                $chargeback->name               =  'chargeback_'.$nameOfDoc;
                $chargeback->payment_reference  =  $nameOfDoc;
                $chargeback->paid               =  0;          
                $chargeback->date_due           =  date("Y-m-d H:i:s", $tomorrow);       
                $chargeback->date_due_ext       =  $dateDue->format("Y-m-d H:i:s");   
                $chargeback->status             =  1;        
                $chargeback->save();
               
                // --------------------------- ovdje napraviti za chargeback PDF -------------------------
                $this->generateChargebackPDF($chargeback->id);
                echo $chargeback->id;
          }
          
           public function RandomCode($lengthCode) {
            $characters = '0123456789';
            $randomString = '';
            for ($i = 0; $i < $lengthCode; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $randomString;
            }
        public function generateChargebackPDF($chargeback_id) {
           $chargeback = Chargeback::model()->findByPk($chargeback_id);
           $order      = OrdersDao::getOrderById($chargeback->order_id);
           $customer   = UsersDao::getUserById($chargeback->user_id);
           $customerAddress = UserAddressDao::getPrimaryAddressByTypeAndUserId($chargeback->user_id,0);
           
           $smarty = Yii::app()->viewRenderer->getSmarty();
           $smarty->assign('order', $order);
           $smarty->assign('invoiceNO'        , $chargeback->payment_reference);
           $smarty->assign('customer'         , $customer);
           $smarty->assign('customerAddress'  , $customerAddress);
           $smarty->assign('itemPrice'        , $chargeback->netto);
           $smarty->assign('itemFee'          , $order->fee);
           $smarty->assign('article_name'     ,'Chargeback for Order no #'.$order->id);
           $smarty->assign('totalAmount'      , number_format($chargeback->netto,2, '.',' '));
           $smarty->assign('paymentReference' , $chargeback->payment_reference);
           $smarty->assign('dateDue'          , $chargeback->date_due_ext);
           $smarty->assign('totalAmountAN'    , $chargeback->netto);
           $smarty->assign('totalAmountAB'    , $chargeback->brutto);
           $smarty->assign('vat'              , (($chargeback->brutto/$chargeback->netto)*100)-100);
           $smarty->assign('vatValue'         , number_format($chargeback->brutto-$chargeback->netto,2, '.',' '));
           $smarty->assign('customerCountry'  , 'Sverige');

           $content = $smarty->fetch('r1_c.tpl'); 

           $pathToPdf="/ws/prod/qlirr/code/protected/documents/pdf/agreements/chargeback_".$chargeback->payment_reference.".pdf";
           $documents                   = new Documents;
           $documents->user_id          = $chargeback->user_id;
           $documents->order_id         = $chargeback->order_id;
           $documents->documentType_id  = 11;
           $documents->name             = $chargeback->payment_reference;
           $documents->path             = $pathToPdf;
           $documents->save();
           PdfGenerator::generatePdfTcpdf($content,false,$pathToPdf );
           return $pathToPdf;
           
        }
        public function generatePDF($order_id, $bankgirot, $userType) {
           $orderID                 = $order_id;
           $order                   = OrdersDao::model()->findByPk($order_id);
           $customer                = UsersDao::getUserData($order->buyer_id);
           $seller                  = UsersDao::getUserData($order->seller_id);
           $customerAddressBuyer    = UserAddressDao::getPrimaryAddressByTypeAndUserId($order->buyer_id,0);
           $customerAddressSeller   = UserAddressDao::getPrimaryAddressByTypeAndUserId($order->seller_id,0);
           $bankBuyer               = BankAccountDao::getUserPrimaryAccountAndBankName($order->buyer_id);
           $nameOfDoc               = 'B'.substr(date("Y"),-2)."-".$orderID;
           
           $paymentReference        = PayoutsDao::getPayoutById($order_id);
           $date_due_value          = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'dateDueExtensionDays'));           
           
           $sellerMobile            = '0'.substr($seller->mobile_number, 4, strlen($seller->mobile_number));
           $buyerMobile             = '0'.substr($customer->mobile_number, 4, strlen($customer->mobile_number));
           
           $sellerPayout            = PayoutsDao::getPayoutById($order_id);
           $feeAmount               = number_format(($order->price - $sellerPayout->amount), 2, ',', ' ');
           $feePrice                = number_format(($feeAmount/1.25), 2, ',', ' ');
           $dateDue                 = new DateTime($order->date_accepted);
           $dateDue->modify("+ ".$date_due_value->setting_value." days");
           $smarty                  = Yii::app()->viewRenderer->getSmarty();
           
           $smarty->assign('order',                 $order);
           $smarty->assign('invoiceNO',             $nameOfDoc);
           $smarty->assign('customer',              $customer);
           $smarty->assign('seller',                $seller);
           $smarty->assign('feeAmount',             $feeAmount);
           $smarty->assign('feePrice',              $feePrice);
           $smarty->assign('customerAddressBuyer',  $customerAddressBuyer);
           $smarty->assign('customerAddressSeller', $customerAddressSeller);
           $smarty->assign('sellerMobile',          $sellerMobile);
           $smarty->assign('sellerPayout',          $sellerPayout->amount);
           $smarty->assign('userCheckSeller',       $this->checkUserRegType($seller->id));
           $smarty->assign('userCheckBuyer',        $this->checkUserRegType($customer->id));
           $smarty->assign('buyerMobile',           $buyerMobile);
           $smarty->assign('itemPrice',             $order->total_amount);
           $smarty->assign('itemFee',               $order->fee);
           $smarty->assign('article_name',          substr($order->article_name,0,30));
           $smarty->assign('totalAmount',           number_format($order->total_amount,2, ',',' '));
           $smarty->assign('paymentReference',      $paymentReference->payment_reference);
           $smarty->assign('paymentReferenceSeller',$nameOfDoc.'-'.$this->RandomCode(4));
           $smarty->assign('dateDue',               $dateDue->format("Y-m-d"));
           $smarty->assign('customerCountry',       'Sverige');
 
           if ($userType=='buyer') {
               $content = $smarty->fetch('r1.tpl'); 
               $pathToPdf="/ws/prod/qlirr/code/protected/documents/pdf/agreements/invoice_".$nameOfDoc.".pdf";
               $userDocId = $order->buyer_id;
           } else if ($userType=='seller') {
               $content = $smarty->fetch('r1_s.tpl'); 
               $pathToPdf="/ws/prod/qlirr/code/protected/documents/pdf/agreements/invoice_s_".$nameOfDoc.".pdf";
               $userDocId = $order->seller_id;
           }
          
           $documents                           = new Documents;
           $documents->user_id                  = $userDocId;
           $documents->order_id                 = $order->id;
           $documents->documentType_id          = 8;
           $documents->name                     = $nameOfDoc;
           $documents->path                     = $pathToPdf;
           $documents->save();
           PdfGenerator::generatePdfTcpdf($content,$bankgirot,$pathToPdf );
           return $pathToPdf;
           
        }
        public function checkUserRegType($user_id) {
           $user = Users::model()->findByPk($user_id);
           $instantor = InstantorXmlDao::getInstantorDataBySsnOk($user->personal_number);
           if (count($instantor)) {
               $returnData = 'Instantor';
           } else {
               $returnData = 'Registrerat mobiltelefonnummer';
           }
           return $returnData;
        }
        
        public function actiongetReport() {
            $dataFromPost   = explode("|", $_POST['data']);
            $user           = UsersDao::getUserById($dataFromPost[1]);
            $userMobile     = '0'.substr($user->mobile_number, 4, strlen($user->mobile_number));
            if ($dataFromPost[0]=='0') {
                $response = UserCheckDao::checkPHONEexist($userMobile);
                echo $response->result;
            } else if ($dataFromPost[0]=='1') {
                $response = InstantorXmlDao::getInstantorDataBySsnOk($user->personal_number);
                echo $response->xml;
            } else {
                $response = UserCheckDao::checkSSNexist($user->personal_number,365);
                echo $response->result;
            }
            
        }
        
        public function actiongetShopList() {
            $dataFromPost = $_POST['data'];
            $shops = ShopsDao::getShopList($dataFromPost);
            $response='';
            $x=0;
            
            if (count($shops)>0) {
                while ($x < count($shops)) {
                    $shoptype = ShopTypeDao::getShopType($shops[$x]->shop_type_id);
                    $delBtn = '<a class="btn btn-danger btn-xs" style="cursor:pointer;margin-bottom:4px;width:80px" onclick="delShop('.$shops[$x]->id.')">Deactivate</a> ';
                    $editBtn = '<button data-id="'.$shops[$x]->id.'" type="button" class="btn btn-warning btn-xs editBTN" data-backdrop="false" data-target="#modalShop" data-toggle="modal" style="width:80px">Edit</button>';
                    $activateBTN = '<a data-id="'.$shops[$x]->id.'" class="btn btn-success btn-xs activeBTN" style="cursor:pointer" >Activate</a>&nbsp;';
                    if ($dataFromPost == '1') {
                        $activeBTN = $delBtn.$editBtn;
                    } else {
                        $activeBTN = $activateBTN;
                    }
                    $response=$response.
                            $shops[$x]->shop_id.'|'.
                            '<a href="/admin/default/shopDetails/id/'.$shops[$x]->id.'">'.$shops[$x]->name.'</a>|'.
                            $shops[$x]->vat_number.'|'.
                            $shops[$x]->mobile_number.'|'.
                            $shoptype->name.'|'. 
                            $shops[$x]->create_at.'|'.
                            $activeBTN.'|';
                            
                    $x++;
                }
                 echo count($shops).'|'.$response;
            } else {
                echo '1|-|-|-|-|-|-|-|';
            }
        }
        
        public function actiondelShop() {
            $dataFromPost = $_POST['data'];
            $shop = ShopsDao::getShopById($dataFromPost);
            $shop->status = '0';
            $shop->update('status');
            echo 'ok';
        }
        
        public function actioneditShop() {
            $dataFromPost = $_POST['data'];
            $shop = ShopsDao::getShopById($dataFromPost);
            $shopAddress = ShopAddressDao::getPrimaryAddressByShopId($shop->id);
            $shopAddress1 = ShopAddressDao::getLegalAddressByShopId($shop->id);
            
            $shopContacts = ShopContactsDao::getAllContacts($shop->id);
            $shopOwners = ShopsCompanyDao::getAllOwners($shop->id);
            
            
            $result = array();
            $resultAddress = array();
            $resultAddress1 = array();
            $resultContacts = array();
            $resultOwners = array();
            if (count($shopContacts)>0) {
                $x=0;
                do {
                    $resultContacts[] = array(
                        'email' => $shopContacts[$x]->email,
                        'phone' => $shopContacts[$x]->phone

                    );
                    $x++;
                } while ($x < count($shopContacts));
            }
            
            if (count($shopOwners)>0) {
                $x=0;
                do {
                    $resultOwners[] = array(
                        'owner' => $shopOwners[$x]->owner,
                        'ssn' => $shopOwners[$x]->ssn

                    );
                    $x++;
                } while ($x < count($shopOwners));
            }
            
            $resultAddress[] = array('street' => $shopAddress->street,
                                     'post_code' => $shopAddress->post_code,
                                     'city' => $shopAddress->city,
                                     'county' => $shopAddress->county_id
                );
            $resultAddress1[] = array('street' => $shopAddress1->street,
                                     'post_code' => $shopAddress1->post_code,
                                     'city' => $shopAddress1->city,
                                     'county' => $shopAddress1->county_id
                );
            $result[] = array('account' => $shop->name,
                              'id'=> $shop->id, 
                              'shop_type_id'=> $shop->shop_type_id,
                              'cid' => $shop->shop_id,
                              'date_signed' => $shop->date_signed,
                              'date_ended' => $shop->date_signed_end,
                              'username' => $shop->username,
                              'password' => $shop->password,
                              'bank_account' => $shop->bank_account,
                              'bank_clearing' => $shop->bank_clearing,
                              'bank_swift' => $shop->bank_swift,
                              'bank_iban' => $shop->bank_iban,
                              'company_name' => $shop->company_name,
                              'vat_number' => $shop->vat_number,
                              'email' => $shop->email,
                              'contact' => $shop->contact,
                              'mobile_number' => $shop->mobile_number,
                              'owner' => $shop->owner1,
                              'installments' => $shop->installments,
                              'invoice' => $shop->invoice,
                              'ssn' => $shop->ssn,
                              'address0' => json_encode($resultAddress),
                              'address1' => json_encode($resultAddress1),
                              'contacts' => json_encode($resultContacts),
                              'owners' => json_encode($resultOwners)
                              
            );
            echo json_encode($result);
        }                
        public function actionvalidateInput() {
            $dataFromPost = explode("|", $_POST['data']);
            
            switch ($dataFromPost[0]) {
                case 'modalShopName':
                    if (count(ShopsDao::validateName($dataFromPost[1]))>0) {
                        echo 'false';
                    } else {
                        echo 'true';
                    }

                    break;
                case 'modalCID':
                    if (count(ShopsDao::validateCID($dataFromPost[1]))>0) {
                        echo 'false';
                    } else {
                        echo 'true';
                    }

                    break;
                case 'modalSSN':
                    if (count(ShopsDao::validateSSN($dataFromPost[1]))>0) {
                        echo 'false';
                    } else {
                        echo 'true';
                    }

                    break;
                case 'modalUsername':
                    if (count(ShopsDao::validateUser($dataFromPost[1]))>0) {
                        echo 'false';
                    } else {
                        echo 'true';
                    }

                    break;

                default:
                    break;
            }
        }
        
        public function actionsaveNewShop() {
            $dataFromPost = explode("|", $_POST['data']);
            
           
            if ($dataFromPost[32]==='edit') {
                $shop = ShopsDao::getShopById($dataFromPost[33]);
            } else {
                $shop = new Shops;
            }
            
                $shop->name		= $dataFromPost[0];
                $shop->company_name	= $dataFromPost[4];	
                $shop->username		= $dataFromPost[6];		
                $shop->password		= md5($dataFromPost[7]);		
                $shop->shop_id		= $dataFromPost[1];			
                $shop->shop_type_id	= $dataFromPost[2];	
                $shop->email		= $dataFromPost[11];
                $shop->mobile_number	= $dataFromPost[12];
                $shop->owner1       	= $dataFromPost[5];		
                $shop->vat_number       = $dataFromPost[3];		
                $shop->ssn          	= $dataFromPost[13];		
                $shop->status		= 1;			
                $shop->ip_address	= Yii::app()->request->userHostAddress;		
                $shop->contact          = $dataFromPost[10];
                $shop->bank_clearing    = $dataFromPost[19];
                $shop->bank_account     = $dataFromPost[20];
                $shop->bank_swift       = $dataFromPost[21];
                $shop->bank_iban        = $dataFromPost[22];
                $shop->installments     = $dataFromPost[23];
                $shop->invoice          = $dataFromPost[24];
                $shop->date_signed      = $dataFromPost[29];
                $shop->date_signed_end  = $dataFromPost[30];
            if ($dataFromPost[32]==='edit') {
                $shop->update(array('name', 'company_name', 'username', 'shop_id', 'shop_type_id', 'email', 'mobile_number', 'owner1', 'vat_number', 'ssn', 'status', 'ip_address',
                    'contact', 'bank_clearing', 'bank_account', 'bank_swift', 'bank_iban', 'installments', 'invoice', 'date_signed', 'date_signed_end'));
            } else {
                $shop->save();
            } 
            
            
            if ($dataFromPost[32]==='edit') {
                $shopAddress = ShopAddressDao::getPrimaryAddressByShopId($shop->id);
            } else {
                $shopAddress = new ShopAddress;
            }
            
                $shopAddress->address_type   = 0;
                $shopAddress->street         = $dataFromPost[8];
                $shopAddress->post_code      = $dataFromPost[15];
                $shopAddress->city           = $dataFromPost[16];
                $shopAddress->active         = 1;
                $shopAddress->county_id      = $dataFromPost[31];
                $shopAddress->user_id        = $shop->id;
                $shopAddress->primary        = 1;
            if ($dataFromPost[32]==='edit') {
                $shopAddress->update(array('address_type', 'street', 'post_code', 'city', 'active', 'county_id', 'user_id', 'primary'));
            } else {
                $shopAddress->save();
            }
            
            if (strlen($dataFromPost[9])>0) {
                
                if ($dataFromPost[32]==='edit') {
                   $shopAddress = ShopAddressDao::getLegalAddressByShopId($shop->id); 
                    
                } else {
                    $shopAddress = new ShopAddress;
                }
                    $shopAddress->address_type   = 1;
                    $shopAddress->street         = $dataFromPost[9];
                    $shopAddress->post_code      = $dataFromPost[17];
                    $shopAddress->city           = $dataFromPost[18];
                    $shopAddress->active         = 1;
//                    $shopAddress->county_id      = $dataFromPost[31];
                    $shopAddress->user_id        = $shop->id;
                    $shopAddress->primary        = 1;
                if ($dataFromPost[32]==='edit') {
                    $shopAddress->update(array('address_type', 'street', 'post_code', 'city', 'active', 'user_id', 'primary'));
                } else {
                    $shopAddress->save();
                }
                    
                
            }
            
            if ($dataFromPost[32]==='edit') {
                $shopbank = ShopBankDao::getBankByUserId($shop->id);
            } else {
                $shopbank = new ShopBank;
            }
                
                    $shopbank->status       = 1;
                    $shopbank->primary      = 1;
                    $shopbank->user_id      = $shop->id;
                    $shopbank->bank_account = $dataFromPost[14];
                    $shopbank->bank_id      = $dataFromPost[14];
            if ($dataFromPost[32]==='edit') {
                $shopbank->update(array('status', 'primary', 'user_id', 'bank_account', 'bank_id'));
            } else {
                $shopbank->save();
            }      
                
            
            $owners     = explode(";", $dataFromPost[25]);
            $ssns       = explode(";", $dataFromPost[26]);
            $contactE   = explode(";", $dataFromPost[27]);
            $contactP   = explode(";", $dataFromPost[28]);
            
            $x=0;
            
            $shopOwner = ShopsCompanyDao::getAllOwners($shop->id);
            
            do {
                if (count($shopOwner) > $x) {

                    $shopOwner[$x]->owner   = $owners[$x];
                    $shopOwner[$x]->ssn     = $ssns[$x];
                    $shopOwner[$x]->active  = 1;
                    $shopOwner[$x]->shop_id = $shop->id;
                    $shopOwner[$x]->update(array('owner', 'ssn', 'active', 'shop_id')); 
                } else {
                    //unset($shopOwner);
                    
                    $shopOwner1          = new ShopsCompany;
                    $shopOwner1->owner   = $owners[$x];
                    $shopOwner1->ssn     = $ssns[$x];
                    $shopOwner1->active  = 1;
                    $shopOwner1->shop_id = $shop->id;
                    $shopOwner1->save();
             
                }

                $x++;
            } while ($x<count($owners));
            
        
            $y=0;
            $shopContacts = ShopContactsDao::getAllContacts($shop->id);
            
         
            do {
                if (count($shopContacts) > $y) {
                    $shopContacts[$y]->email     = $contactE[$y];
                    $shopContacts[$y]->phone     = $contactP[$y];
                    $shopContacts[$y]->active    = 1;
                    $shopContacts[$y]->shop_id   = $shop->id;
                    $shopContacts[$y]->update(array('email', 'phone', 'active', 'shop_id'));
                } else {
                    $shopContact1            = new ShopContacts;
                    $shopContact1->email     = $contactE[$y];
                    $shopContact1->phone     = $contactP[$y];
                    $shopContact1->active    = 1;
                    $shopContact1->shop_id   = $shop->id;
                    $shopContact1->save();
                }
                $y++;
            } while ($y<count($contactE));
            
            echo 'ok';
                        
        }
        public function actionshopDetails() {
            $this->renderPartial('shopDetails');
        }        
        
        public function actiongetPayoutsByShop() {
            $dataFromPost = $_POST['data'];
            $payouts = PayoutsDao::getPayoutsNotPaidByShop($dataFromPost);
            $x=0;
            if (count($payouts)>0) {
                do {
                    $order    = OrdersDao::getOrderByIdAll($payouts[$x]->order_id);
                    $response = $response.
                                ($x+1).'|<b>'.
                                $order->code.'</b>|'.
                                $payouts[$x]->amount.'|'.
                                $payouts[$x]->time_created.'|'.
                                '<label><input type="checkbox"  name="payout" style="vertical-align:-2px;margin-right:5px" value="'.$payouts[$x]->id.'">SELECT</label>|';
                    $x++;
                } while ($x<count($payouts));
                echo count($payouts).'|'.$response;
            }
        }
        
        public function actionselectedPayoutsCheck() {
            //$data = '100;200;300;500;800;900;400;200;22;22;555;44;111;';
            $dataFromPost = explode(";", $_POST['data']);
            foreach ($dataFromPost as $key => $value) {
                $order = PayoutsDao::getPayoutById2($value);
                $total += $order->amount;
                $list  = $list.$value.', ';
                $fee += 29;
            }
            $shop = ShopsDao::getShopById($order->user_id);
            $bankName = ShopBankDao::getBankByUserId($shop->id);
            $bankName2 = BanksDao::getBankName($bankName->bank_id);
            echo $shop->bank_account.' - '.$bankName2->full_name."|".$shop->name."|".substr($list, 0, -2)."|".number_format($total, 2, ",", ".")." kr|".number_format($fee, 2, ",", ".")." kr";
        }
        
        public function actionpayoutPay() {
            
            $dataFromPost = explode(";", $_POST['data']);
            $x=0;
            do {
                $order = PayoutsDao::getPayoutById2($dataFromPost[$x]);
                $order->paid = 1;
                $total += $order->amount;
                $order->update(array('paid'));
                $orderPaid = OrdersDao::getOrderAllById($order->order_id);
                $orderPaid->paidToShop = '1';
                $orderPaid->update('paidToShop');
                $list = $list.$dataFromPost[$x].',';
                $x++;
            } while ($x<count($dataFromPost)-1);
            
            $user    = PayoutsDao::getPayoutById2($dataFromPost[0]);
            $shop    = ShopsDao::getShopById($user->user_id);
                
            $invoice = new Invoice;
            $invoice->invoice_status    = 1;
            $invoice->user_id           = $user->user_id;
            $invoice->date_issued       = date("Y-m-d H:i:s");
            $invoice->total_amount      = $total;
            $invoice->to_account        = $shop->bank_account;
            $invoice->payouts_list      = substr($list,0,-1);
            $invoice->count             = count($dataFromPost)-1;
            $invoice->save();
            
            $this->generateSellerPDF($invoice->id);
            $this->generateListPDF($invoice->id);
            echo 'ok';
        }
        
        public function actiontest2() {
             echo 'Starting test<br>';
             $test = $this->generateSellerPDF(18);
             echo $test.'<br><br>';
        }
        public function generateSellerPDF($invoice_id) {
            $invoice           = Invoice::model()->findByPk($invoice_id);
            $shop              = ShopsDao::getShopById($invoice->user_id);
            $shopAddress       = ShopAddressDao::getAddressByShopId($shop->id);
            $paymentReferenceSeller = substr(date('Y'), -2).$invoice->id;

            $list = explode(",", $invoice->payouts_list);
            $x=0;
            
            do {
                $payouts        = PayoutsDao::getPayoutById2($list[$x]);
                $orders         = OrdersDao::getOrderAllById($payouts->order_id);
                $orderID        = $orderID.$orders->code.'<br>';
                $feePrice       = $feePrice.number_format($orders->fee, 2, ',', '.').'<br>';
                $feeTotal+=29;
                $percentVAT     = $percentVAT.'0 %<br>';
                $qty            = $qty.'1 st<br>';
                $idnr           = $idnr.($x+1).'<br>';
                $x++;
            } while ($x<$invoice->count);
            
            $smarty            = Yii::app()->viewRenderer->getSmarty();
            
            $smarty->assign('shop',                     $shop);
            $smarty->assign('invoice',                  $invoice);
            $smarty->assign('paymentReferenceSeller',   $paymentReferenceSeller);
            $smarty->assign('shopAddress',              $shopAddress);
            $smarty->assign('ordersID',                 $orderID);
            $smarty->assign('feePrice',                 $feePrice);
            $smarty->assign('percentVAT',               $percentVAT);
            $smarty->assign('idnr',                     $idnr);
            $smarty->assign('qty',                      $qty);
            $smarty->assign('feePriceTotal',            number_format($feeTotal, 2, ',', '.'));
            
            $content     = $smarty->fetch('r1_s.tpl'); 
            $pathToPdf   = "/ws/prod/qlirr/code/protected/documents/pdf/agreements/invoice_s_".$paymentReferenceSeller.".pdf";
          
            PdfGenerator::generatePdfTcpdf($content,false,$pathToPdf );
            return $pathToPdf;
        }
        
       
        public function generateListPDF($invoice_id) {
            $invoice           = Invoice::model()->findByPk($invoice_id);
            
            $shop              = ShopsDao::getShopById($invoice->user_id);
            $shopAddress       = ShopAddressDao::getAddressByShopId($shop->id);
            $bank              = ShopBankDao::getBankByUserId($shop->id);
            $bankName          = BanksDao::getBankName($bank->bank_id);
            $paymentReferenceSeller = substr(date('Y'), -2).$invoice->id;

            $list = explode(",", $invoice->payouts_list);
            $x=0;
            
            $orderID = '<p style="line-height:160%;font-size:12px">';
            $idnr    = '<p style="line-height:160%;font-size:12px">';
            $prices  = '<p style="line-height:160%;font-size:12px">';
            do {
                $payouts        = PayoutsDao::getPayoutById2($list[$x]);
                $orders         = OrdersDao::getOrderAllById($payouts->order_id);
                $orderID        = $orderID.$orders->code.'<br>';
                $prices         = $prices.number_format($orders->total_amount, 2, ',', '.').'<br>';
                $feePrice       = $feePrice.number_format($orders->fee, 2, ',', '.').'<br>';
                $feeTotal+=29;
                $percentVAT     = $percentVAT.'0 %<br>';
                $qty            = $qty.'1 st<br>';
                $idnr           = $idnr.($x+1).'.<br>';
                $pricesT+=$orders->total_amount;
                $x++;
            } while ($x<$invoice->count);
            
            $orderID = $orderID.'</p>';
            $idnr    = $idnr.'</p>';
            $prices  = $prices.'</p>';
            
            $smarty            = Yii::app()->viewRenderer->getSmarty();
            
            $smarty->assign('shop',                     $shop);
            $smarty->assign('invoice',                  $invoice);
            $smarty->assign('bank',                     $bankName);
            $smarty->assign('paymentReferenceSeller',   $paymentReferenceSeller);
            $smarty->assign('shopAddress',              $shopAddress);
            $smarty->assign('ordersID',                 $orderID);
            $smarty->assign('feePrice',                 $feePrice);
            $smarty->assign('percentVAT',               $percentVAT);
            $smarty->assign('idnr',                     $idnr);
            $smarty->assign('prices',                   $prices);
            $smarty->assign('pricesT',                  number_format($pricesT, 2, ',', '.'));
            $smarty->assign('qty',                      $qty);
            $smarty->assign('feePriceTotal',            number_format($feeTotal, 2, ',', '.'));
            $smarty->assign('datef',                     date("Y-m-d H:i:s"));
            
            $content     = $smarty->fetch('r1_list.tpl'); 
            $pathToPdf   = "/ws/prod/qlirr/code/protected/documents/pdf/agreements/list_s_".$paymentReferenceSeller.".pdf";
          
            PdfGenerator::generatePdfTcpdf($content,false,$pathToPdf );
            return $pathToPdf;
        }
        
        public function actionUpload() {
            
            $demo_mode = false;
            $upload_dir = "/ws/prod/qlirr/code/protected/documents/";
            $allowed_ext = array('jpg','jpeg','png','gif');


            if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
                exit_status('Error! Wrong HTTP method!');
            }


            if(array_key_exists('pic',$_FILES) && $_FILES['pic']['error'] == 0 ){
                $pic = $_FILES['pic'];
                if(!in_array(get_extension($pic['name']),$allowed_ext)){
                    exit_status('Only '.implode(',',$allowed_ext).' files are allowed!');
                }	
                if($demo_mode){
                    // File uploads are ignored. We only log them.
                    $line = implode('		', array( date('r'), $_SERVER['REMOTE_ADDR'], $pic['size'], $pic['name']));
                    file_put_contents('log.txt', $line.PHP_EOL, FILE_APPEND);
                    exit_status('Uploads are ignored in demo mode.');
                }
                if(move_uploaded_file($pic['tmp_name'], $upload_dir.$pic['name'])){
                    exit_status('File was uploaded successfuly!');
                }
            }
        }
        
        public function actionlogout() {
            Yii::app()->session->clear();
            $this->redirect('/site/login');
        }
        
        public function actionviewInvoice() {
           $dataFromPost = $_POST['data'];
           $invoice = InvoiceDao::getInvoiceById($dataFromPost);
           $payouts = explode(",",$invoice->payouts_list);
           $x=0;
           $sum=0;
           $response = '<table cellpadding="2" style="margin-bottom:18px"><tr style="font-weight:700;background-color:#eee;border-bottom:1px dotted #aaa"><td width="90">Payout ID</td><td width="90">Order Code</td><td width="90" style="text-align:right">Amount</td></tr><tr>';
           do {
               $payout   = PayoutsDao::getPayoutByPayoutId($payouts[$x]);
               $order    = OrdersDao::getOrderAllById($payout->order_id);
               $response = $response.'<td>'.$payout->id.'</td><td style="text-align:right"><a href="/admin/default/orderDetails/id/'.$order->id.'" style="color:black;">'.$order->code.' <i class="fa fa-external-link-square"></i></a></td><td style="text-align:right">'.$payout->amount.'</td></tr>';
               $sum+=$payout->amount;
               $x++;
           } while ($x<count($payouts));
           $response  = $response.'<tr style="border-top:1px dotted #ccc"><td colspan="3" style="font-weight:900;text-align:right">'.number_format($sum,2,',',' ').'kr</td></tr>';
           echo $response.'</table>';
        }
        
        public function actiongetCities() {
            $dataFromGet = $_GET['id'];
//            $dataFromGet = 'Stock';
            $cities = CitiesDao::getCityByName($dataFromGet);
            $results = array();
            $x=0;
            if (count($cities)>0) {
                while ($x < count($cities)) {
                    $county = CountiesDao::getCountyById($cities[$x]->county_id);
                    $results[] = array('city'       => $cities[$x]->place,
                                       'county'     => $county->code,
                                       'countyName' => $county->name,
                                       'postcode'   => $cities[$x]->postcode);
                    $x++;
                }
            }
            echo json_encode($results);
        }
         
        public function actiongetPostcode() {
            $dataFromGet = $_GET['id'];
//            $dataFromGet = 'Stock';
            $cities = CitiesDao::getCityByPostcode($dataFromGet);
            $results = array();
            $x=0;
            if (count($cities)>0) {
                while ($x < count($cities)) {
                    $county = CountiesDao::getCountyById($cities[$x]->county_id);
                    $results[] = array('city'       => $cities[$x]->place,
                                       'county'     => $county->code,
                                       'countyName' => $county->name,
                                       'postcode'   => $cities[$x]->postcode);
                    $x++;
                }
            }
            echo json_encode($results);
        }
        public function actionuploadImage() {
        if(isset($_POST['SESSION_ID'])){
            $session=Yii::app()->getSession();
            $session->close();
            $session->sessionID = $_POST['SESSION_ID'];
            $session->open();
        }
       
        $targetFolder = '/themes/admin/images/uploads'; // Relative to the root
        $verifyToken = md5('unique_salt' . $_POST['timestamp']);

            if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
                $specName = $_POST['specName'];
                $tempFile = $_FILES['Filedata']['tmp_name'];
                $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
                $targetFile = rtrim($targetPath,'/') . '/' . $specName.'.png';

                // Validate the file type
                $fileTypes = array('jpg','jpeg','gif','png'); // File extensions
                $fileParts = pathinfo($_FILES['Filedata']['name']);

                if (in_array($fileParts['extension'],$fileTypes)) {
                        move_uploaded_file($tempFile,$targetFile);
                        echo '1';
                } else {
                        echo 'Invalid file type.';
                }
            }

        }
        public function actionuploadS() {
            $this->renderPartial('upload');
        }
        public function actionuploadInfo() {
            
            
            $upload_dir =  "/ws/prod/qlirr/code/protected/documents/shop_upload/";
            if ($_FILES["file"]["error"] > 0)
                echo "Error: " . $_FILES["image"]["error"] . "<br />";
            else
            {   
                $ext = explode(".", $_FILES['image']['name']);
                
                $newname = $_FILES['image']['name'];
               
                
                if ($_POST['user_id']<>"") {
                    $type_id = $_POST['user_id'];
                    $type = '1_';
                } else {
                    $type_id = $_POST['name_cid'];
                    $type = '0_';
                }
                $random = $this->RandomCode(8);
                $files = new Files;
                $files->type         = 0;
                $files->type_id      = $type_id;
                $files->name         = $newname;
                $files->real_name    = $upload_dir.$type.$type_id.$random.'.'.$ext[1];
                $files->save();
                
                move_uploaded_file($_FILES["image"]["tmp_name"], $upload_dir.$type.$type_id.$random.'.'.$ext[1]);

                echo "ok";
            }
        }
        
        public function actiontest123() {
            $shopContacts = ShopContactsDao::getAllContacts(140);

            $y=0;
            $shopContacts->email     = 'pero';
            $shopContacts->phone     = 'test';
            $shopContacts->active    = 1;
            $shopContacts->shop_id   = '140';
            $shopContacts->update(array('email', 'phone', 'active', 'shop_id'));
            echo 'pl';
        }
        
        public function actionactivateShop() {
            $dataFromPost = $_POST['data'];
            $shop = ShopsDao::getShopByIdPassive($dataFromPost);
            $shop->status = '1';
            $shop->update('status');
            echo 'ok';
        }
  }
?>