<?php
    class ReceiveController extends Controller
    {
        public function actionInstantor()
        {	
            $xmlResponse = '';
            $r = '';
            
            // !!!!!!!!!   
            
            $realInstantorTest = true; // staviti da li radis pravi test ili sa server snimljenog fajla
            if (!$realInstantorTest) {
                $xmlResponse = file_get_contents(Yii::app()->basePath."/data/Instantor/pero2.xml");
            } else {
                $source  = Yii::app()->params['instantorSource'];
                $api_key = Yii::app()->params['instantorApiKey'];
                $r = InstantorRequest::receivePostRequest($source, $api_key, $xmlResponse);

                // Return error to Instantor
                /*if (!strstr($r, 'OK: ')) {
                $this->getLogger()->log("Instantor error (POST): " . print_r($_POST, true), Zend_Log::ERR);
                $this->getLogger()->log("Instantor error (message): " . $xmlResponse, Zend_Log::ERR);
                echo $r; return;
                }
                $this->getLogger()->log("Received Instantor message: " . $xmlResponse, Zend_Log::INFO);*/
            }

            if($xmlResponse != null) {
                $xmlObj = simplexml_load_string($xmlResponse);
               
                $userIdentification             = $xmlObj->{'basic-info'}->misc->entry[0];
                $reportNumber                   = $xmlObj->{'basic-info'}->{'scrape-report'}->reportNumber;
                $userSSN                        = $xmlObj->{'basic-info'}->misc->entry[1];
                $userIBAN                       = $xmlObj->Scrape->accountList->Account->iban;
                $status                         = instantorData::getStatus($xmlObj);
                $response                       = new InstantorXml();
                $response->user_identification  = (string)$userIdentification;//$userIdentification;
                $response->xml                  = $xmlResponse;
                $response->ssn                  = $userSSN;
                $response->reportNo             = $reportNumber;
                $response->type                 = (string)$status;
                $response->tag                  = $userIBAN;
                $response->save();  
                
                // save new user here
//                if ($reportNumber=='1'){
//                    $userTemp = explode(' ', $xmlObj->Scrape->userDetails->name);
//                    $modelUser = new Users;
//                    $modelUser->name                = ucfirst(strtolower($userTemp[1]));
//                    $modelUser->surname             = ucfirst(strtolower($userTemp[0]));
//                    $modelUser->personal_number     = $userSSN;
//                    $modelUser->mobile_number       = '0046'.substr($userIdentification,1,strlen($userIdentification));
//                    $modelUser->userType            = 3;
//                    $modelUser->verification        = 0;
//                    $modelUser->country_id          = 216;
//                    $modelUser->save();
//                }
            }

            echo $r;
            //$this->processInstantor($userIdentification);
        }
        public function processInstantor($userID) {
            $header = '<style>body {font-family:monospace}</style><p style="font-size:12px">Analitics started!</p>~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~</br></br>';
            print_r($header);
            // - - - - - - - - - - - - - STARTING ANALITICS - - - - - - - - - - - - - - - - - - - 
            $itor = InstantorXmlDao::getInstantorData($userID);
                $xmlObj = simplexml_load_string($itor->xml);
                $incomingSum=0;
                $outgoingSum=0;
                    foreach ($xmlObj->PeydoSEReport->bankReport->cashFlow->MonthlyCashFlow as $cashFlow) {
                        if ($cashFlow->month>-2) {
                            $incomingSum+=$cashFlow->incoming;
                            $outgoingSum+=$cashFlow->outgoing;
                        }
                    }
            $itor->report_finished='1';
            $itor->update(array('report_finished'));
            // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
            
            // ovdje ide ispis
            foreach ($xmlObj->Scrape->accountList->Account as $account) {
                echo "<b>".$account->kind." ".$account->balance." - ".$account->number."<br>";
                echo $account->holderName."</b><br>----------------------------------------------<br>";
                foreach ($account->transactionList->Transaction as $transaction) {
                    echo $transaction->onDate." - ".$transaction->amount." ".$transaction->balance." ".$transaction->description. "<br>";
                }
                echo "<br>";
            }
            
        }
        public function actiongetInvoice() {
            
            $pathToInvoice=YiiBase::getPathOfAlias('webroot')."/protected/documents/pdf/agreements/invoice_14-".$_GET['id'].".pdf";
//            $test = UtilsMain::pEnc("invoice_453");
//            echo $test.'<br>';
//            echo UtilsMain::pDenc($test);
            GDownload::send($pathToInvoice);
//            echo $_SERVER['HTTP_USER_AGENT']; 
        }
        public function actionsendSms() {
              BeepSendSMS::sendSMS('0038765015595','Hej Betalar vag ovo ono, skappa faktura: http://shop.peydo.com/Faktura/ID740');
        }
        public function actioncronjob($id) {
            
            $realKey = '883d2fb8b38a7840ed185ce625d6a07ecebfde21ee39c4a8780a90df37867c5e';
            $key = $_GET['id'];
            $remindersEnabled = ApplicationSettings::model()->findByAttributes(array('setting_name'=>'remindersEnabled'));
            if ($remindersEnabled->setting_value == 0 ) {
                die();
            }
            if ($key==$realKey) {
                $orders = OrdersDao::getOrdersLate();
                $x=0;
                $nowTime = date("Y-m-d H:i:s");
                while ($x < count($orders)) {
                    if ($orders[$x]->date_due_temp < $nowTime) {
                       if ($orders[$x]->penalityLevel < 3) { 
                            $firstActiveReminder = RemiDao::getNextReminder($orders[$x]->id);
                            $nextDate =  new DateTime($orders[$x]->date_due);
                            $nextDate->modify("+".$firstActiveReminder->value." days"); 
                            $nextDateTemp = $nextDate->format("Y-m-d H:i:s");
                            $tomorrow = mktime(9, 0, 0, $nextDate->format('m'), $nextDate->format('d')+1, $nextDate->format('Y'));
                            $level = $orders[$x]->penalityLevel;
                            $orders[$x]->penalityLevel = ($level+1);
                            $orders[$x]->penality      = ($orders[$x]->penality + $firstActiveReminder->value2);
                            $orders[$x]->total_amount  = ($orders[$x]->total_amount + $firstActiveReminder->value2);
                            $orders[$x]->date_due      = $nextDateTemp;
                            $orders[$x]->date_due_temp = date("Y-m-d H:i:s", $tomorrow);
                            echo $orders[$x]->id.' | '.$nextDateTemp.'<br>'; 
                            $orders[$x]->update(array('penalityLevel', 'date_due', 'penality', 'total_amount', 'date_due_temp'));
                            $this->generatePDFReminder($orders[$x]->id, ($level+1));
                       } elseif ($orders[$x]->penalityLevel == 3) {
                           $orders[$x]->orderStatusF_id = 8;
                           $orders[$x]->update(array('orderStatusF_id'));
                       }
                    }
                    
                    $x++;
                }
                
            }
        }
        
        public function actioncronjobCharge($id) {
            
            $realKey = 'cd55eb645973ee4fafe99e7564c1cfa90587d3d48d2f445b91fe7084d37b3b27';
            $key = $_GET['id'];
            $remindersEnabled = ApplicationSettings::model()->findByAttributes(array('setting_name'=>'remindersEnabled'));
            if ($remindersEnabled->setting_value == 0 ) {
                die();
            }
            
            if ($key==$realKey) {
                $chargeback = ChargebackDao::getList();
                $x=0;
                $nowTime = date("Y-m-d H:i:s");
                
                while ($x < count($chargeback)) {
                    if ($chargeback[$x]->finance_status_id ===0) {
                        $extDays = RemiDao::getFirstActiveReminderForChargeBack();
                        $chargeback[$x]->finance_status_id = 1;
                        $nextDate                       = new DateTime($chargeback[$x]->date_due_ext);
                        // ovdje treba vidjeti oko datuma sta da se desava sa tim, mozda treba da se stavi da ide tomorrow
                        $chargeback[$x]->update(array('finance_status_id')); 
                    }
                                       
                    if ($chargeback[$x]->date_due_ext < $nowTime) {
                       if ($chargeback[$x]->penalityLevel < 3) { 
                            $firstActiveReminder            = RemiDao::getNextReminderCharge($chargeback[$x]->id);
                            $nextDate                       = new DateTime($chargeback[$x]->date_due_ext);
                            $nextDate->modify("+".$firstActiveReminder->value." days"); 
                            $nextDateTemp                   = $nextDate->format("Y-m-d H:i:s");
                            $tomorrow                       = mktime(9, 0, 0, $nextDate->format('m'), $nextDate->format('d')+1, $nextDate->format('Y'));
                            $level                          = $chargeback[$x]->penalityLevel;
                            $chargeback[$x]->penalityLevel  = ($level+1);
                            $chargeback[$x]->penality       = ($chargeback[$x]->penality + $firstActiveReminder->value2);
                            $chargeback[$x]->date_due_ext   = $nextDateTemp;
                            $chargeback[$x]->date_due       = date("Y-m-d H:i:s", $tomorrow);
                            echo $chargeback[$x]->id.' | '.$nextDateTemp.'<br>'; 
                            $chargeback[$x]->update(array('penalityLevel', 'date_due', 'penality', 'date_due_ext'));
                            $this->generateChargebackReminder($chargeback[$x]->id, ($level+1));
                       } elseif ($orders[$x]->penalityLevel == 3) {
//                           $orders[$x]->orderStatusF_id = 8;
//                           $orders[$x]->update(array('orderStatusF_id'));
                       }
                    }
                    $x++;
                    // -------- ovdje je kraj --------
                        
                    // -------------------------------
                }
                
            }
        }
        
        
        public function actioncronJobLate($id) {
            $realKey = '07a10df89fbb7507da765183ca88e0836e461017a6b291873588440c5da4f2d3';
            $key = $_GET['id'];
            if ($key === $realKey) {
                $orders = OrdersDao::getOrdersExpired();
                echo 'Count: '.count($orders).'<br>';
                $x = 0;
                $nowTime = date("Y-m-d H:i:s");
                while ($x < count($orders)) {
//                    $firstActiveReminder = RemiDao::getFirstActiveReminder($orders[$x]->id);
                    
                    $nextDate = new DateTime($orders[$x]->date_due);
                    $nextDate->modify("+ 1 days"); 
                    $tomorrow = mktime(9, 0, 0, $nextDate->format('m'), $nextDate->format('d'), $nextDate->format('Y'));
                    echo date("Y-m-d H:i:s", $tomorrow).'<br>';
          
                    if ($orders[$x]->date_due < $nowTime) {
                        $orders[$x]->orderStatusF_id      = 1;
                        $orders[$x]->date_due_temp        = date("Y-m-d H:i:s", $tomorrow);
                        $orders[$x]->update(array('orderStatusF_id', 'date_due_temp'));
                    }
                    $x++;
                }
            }
            
        }
        public function actioncronJob72s() {
            $key = $_GET['id'];
            $realKey = '5cb08f5dc61f56cd3713bbbe99a7dd5dff8d9266d112f238fd7db2795af2c306'; // string: "vuya" ; en: sha256
            $timeReturnLimitS = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'timeReturnLimitS'));
            if ($key==$realKey) {
                $orders = Orders::model()-> findAllByAttributes(array('orderStatus_id' => 2 , 'sellerCreditLimitReturn' => 0));
                $x=0;
                $nowTime = date("Y-m-d H:i:s");
                do {
                    $timeAccepted = new DateTime($orders[$x]->date_accepted);
                    $timeAccepted->modify("+".$timeReturnLimitS->setting_value." hour"); 
                    $diff=$timeAccepted->format("Y-m-d H:i:s");   
                    if ( $nowTime > $diff ) {
                        
                        $seller = UsersDao::getUserById($orders[$x]->seller_id);
                        $seller->credit_limit_s_remaining = $seller->credit_limit_s_remaining + ($orders[$x]->total_amount - $orders[$x]->fee);
                        $seller->credit_limit_s_expends   = $seller->credit_limit_s_expends   - ($orders[$x]->total_amount - $orders[$x]->fee);
                        $seller->update(array('credit_limit_s_remaining', 'credit_limit_s_expends'));
                        
                        $orders[$x]->sellerCreditLimitReturn = 1;
                        $orders[$x]->update(array('sellerCreditLimitReturn'));
                    }
                    
                    $x++;
                } while ($x<=count($orders)-1);
                
            }
            
        }
         public function actioncronJob72c() { //ovo je kada se automatski odbija ponuda
            $key = $_GET['id'];
            $realKey = '5cb08f5dc61f56cd3713bbbe99a7dd5dff8d9266d112f238fd7db2795af2c306'; // string: "vuya" ; en: sha256
            $timeReturnLimitS = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'timecancelOffer'));
            if ($key==$realKey) {
                $orders = Orders::model()-> findAllByAttributes(array('orderStatus_id' => 1));
                $x=0;
                $nowTime = date("Y-m-d H:i:s");
                do {
                    $timeCreate = new DateTime($orders[$x]->time_created);
                    $timeCreate->modify("+".$timeReturnLimitS->setting_value." hours"); //vratiti to days 
                    $diff=$timeCreate->format("Y-m-d H:i:s");   
                    if ( $nowTime > $diff ) {
                        
                        $buyer = UsersDao::getUserById($orders[$x]->buyer_id);
                        $buyer->creditLimit_remaining = $buyer->creditLimit_remaining + ($orders[$x]->total_amount - $orders[$x]->fee);
                        $buyer->creditLimit_reserved  = $buyer->creditLimit_reserved  - ($orders[$x]->total_amount - $orders[$x]->fee);
                        $buyer->update(array('creditLimit_remaining', 'creditLimit_reserved'));
                    
                        $orders[$x]->orderStatus_id = 3;
                        $orders[$x]->update(array('orderStatus_id'));
                        
                        // ------- sending sms to buyer ; 72h is out
                        $textBuyer = "Din betalning (". $orders[$x]->code.") är avbruten.";
                        BeepSendSMS::sendSMS($buyer->mobile_number, $textBuyer);
                    }
                    
                    $x++;
                } while ($x<=count($orders)-1);
                
            }
            
        }
        public function RandomCode($lengthCode) {
             $characters = '0123456789';
             $randomString = '';
             for ($i = 0; $i < $lengthCode; $i++) {
                 $randomString .= $characters[rand(0, strlen($characters) - 1)];
             }
             return $randomString;
        }
        public function actionscreenShotUrl() {
                
            if (! empty($_REQUEST["image_id"])) {
            // do anything you want about the unique image id. We suggest to use it to identify which url you send to us since you can send 1,000 at one time.
            
                $image_id = $_REQUEST["image_id"];
            }
            
            if (! empty($_POST["result"])) {
                $post_data = $_POST["result"];
                $json_data = json_decode($post_data);
                switch ($json_data->status) {
                    case "error":
                        // do something with error
                        echo $json_data->errno . " " . $json_data->msg;
                        break;
                    case "finished":
                        // do something with finished
                        //  echo $json_data->image_url;
                        // Or you can download the image from our server
                        UtilsMain::SaveImageFromUrl(urldecode($json_data->image_url),'/ws/test/peydo/code/protected/documents/screenshots/'.$image_id.'.jpg'); 
                        break;
                    default:
                        break;
                }
            } else {
                // Do whatever you think is right to handle the exception.
                echo "Error: Empty";
            }

                
        }
        public function actionXML() {
            $xmlResponse = file_get_contents(Yii::app()->basePath."/data/Instantor/pero.xml");
            $xmlObj = simplexml_load_string($xmlResponse);
            $test = $xmlObj->Scrape->accountList->Account->iban;
            print var_dump($test);
        }
        public function actionGen() {
            $pathToPdf = $this->generatePDFReminder(1725,3);
            GDownload::send($pathToPdf);
//            echo 'Download started';
            
//            $customerAddress = UserAddressDao::getPrimaryAddressByTypeAndUserId(1677,0);
//            echo $customerAddress->street;
        }
        
        public function generatePDFReminder($order_id, $level) {
           $orderID         = $order_id;
           $order           = OrdersDao::model()->findByPk($order_id);
           $customer        = UsersDao::getUserData($order->buyer_id);
           $customerAddress = UserAddressDao::getPrimaryAddressByTypeAndUserId($order->buyer_id,0);
           $nameOfDoc       = substr(date("Y"),-2)."-".$orderID;
           // ovdje unijeti date_due ;)

           $brutto          = ($order->total_amount); // bruto i neto zbog pdv
           $netto           = ($order->total_amount); 
           if ($level==0) {
               $levelAdd = '';
           }
            // reminders -----------------------------------
              for ($x=0; $x<$level; $x++) {
                  if ($x===0) {
                      $reminders        = '<br>';
                      $remindersPCS     = '<br>';
                      $remindersValue   = '<br>';
                      $remindersVAT     = '<br>';
                      $remindersTotal   = '<br>';
                  }
                  $firstActiveReminder  = RemiDao::getReminderValueByOrderPenalityLevel2($order->id, $x+1);
                  $reminders            = $reminders.'Reminder #'.($x+1).'<br>';
                  $remindersPCS         = $remindersPCS.'1 st'.'<br>';
                  $remindersValue       = $remindersValue.number_format($firstActiveReminder->value2, 2, ',', ' ').'<br>'; //ovo treba promjeniti
                  $remindersVAT         = $remindersVAT.'0 %'.'<br>';
                  $remindersTotal       = $remindersTotal.number_format($firstActiveReminder->value2, 2, ',', ' ').'<br>'; //ovo treba promjeniti
                  $remindersValueSum    = ($remindersValueSum    + $firstActiveReminder->value2);
                  $dueDateDaysReminders = ($dueDateDaysReminders + $firstActiveReminder->value2);
                  
              }
              
           // reminders -----------------------------------
           $decimal                 = explode('.', $brutto);   
               
           $paymentReference = PayoutsDao::getPayoutById($order_id);
           
           $dateDue = new DateTime($order->date_due);
           $smarty  = Yii::app()->viewRenderer->getSmarty();
           
           $smarty->assign('totalAmountAN'    , number_format($netto, 2, ',', ' '));
           $smarty->assign('totalAmountAB'    , number_format($brutto, 2, ',', ' '));
           $smarty->assign('reminders'        , $reminders);
           $smarty->assign('remindersPCS'     , $remindersPCS);
           $smarty->assign('remindersValue'   , $remindersValue);
           $smarty->assign('remindersVAT'     , $remindersVAT);
           $smarty->assign('remindersTotal'   , $remindersTotal);
           $smarty->assign('order'            , $order);
           $smarty->assign('invoiceNO'        , $nameOfDoc);
           $smarty->assign('customer'         , $customer);
           $smarty->assign('customerAddress'  , $customerAddress);
           $smarty->assign('itemPrice'        , number_format(($order->total_amount-$order->penality),2, ',',' '));
           $smarty->assign('itemFee'          , $order->fee);
           $smarty->assign('totalAmount'      , number_format(($order->total_amount-$order->penality),2, ',',' '));
           $smarty->assign('paymentReference' , $paymentReference->payment_reference);
           $smarty->assign('dateDue'          , $dateDue->format("Y-m-d"));
           $smarty->assign('customerCountry'  , 'Sverige');
           $smarty->assign('article_name'     , $order->code);
           $smarty->assign('decimalAmount',         $decimal[1]);
           $smarty->assign('wholeAmount',           $decimal[0]);
           $content = $smarty->fetch('r1_r.tpl'); 
           
           $pathToPdf=YiiBase::getPathOfAlias('webroot')."/protected/documents/pdf/agreements/invoice_r".$level."_".$nameOfDoc.".pdf";
           
           PdfGenerator::generatePdfTcpdf($content,true,$pathToPdf );
           $firstActiveReminder = RemiDao::getReminderValueByOrderPenalityLevel($order->id);
           $documents                   = new Documents;
           $documents->user_id          = $order->buyer_id;
           $documents->order_id         = $order->id;
           $documents->documentType_id  = 9;
           $documents->penalityLevel    = $level;
           $documents->penality         = $firstActiveReminder->value2;
           $documents->name             = $level.'_'.$nameOfDoc;
           $documents->path             = $pathToPdf;
           $documents->save();
           
           BeepSendSMS::sendSMS('0038765015595', 'Faktura+reminder: http://shop.peydo.com/Faktura/FR'.$level."_".$nameOfDoc);
           return $pathToPdf;
           
        }   
        
        
        public function generateChargebackReminder($chargebackID, $level) {
           echo 'level: '.$level.'<br>';
           $chargeback      = Chargeback::model()->findByPk($chargebackID);
           $order           = OrdersDao::getOrderById($chargeback->order_id);
           $customer        = UsersDao::getUserById($chargeback->user_id);
           $customerAddress = UserAddressDao::getPrimaryAddressByTypeAndUserId($chargeback->user_id,0);
           
           if ($level==0) {
               $levelAdd = '';
           }
            // -------------------------------------- reminders -----------------------------------
              for ($x=0; $x<$level; $x++) {
                  if ($x===0) {
                      $reminders        = '<br>';
                      $remindersPCS     = '<br>';
                      $remindersValue   = '<br>';
                      $remindersVAT     = '<br>';
                      $remindersTotal   = '<br>';
                  }
                  $firstActiveReminder  = RemiDao::getReminderValueByChargebackPenalityLevel2($chargeback->id, $x+1);
                  $reminders            = $reminders.'Reminder #'.($x+1).'<br>';
                  $remindersPCS         = $remindersPCS.'1 st'.'<br>';
                  $remindersValue       = $remindersValue.number_format($firstActiveReminder->value2, 2, '.', ' ').'<br>'; //ovo treba promjeniti
                  $remindersVAT         = $remindersVAT.'0 %'.'<br>';
                  $remindersTotal       = $remindersTotal.number_format($firstActiveReminder->value2, 2, '.', ' ').'<br>'; //ovo treba promjeniti
                  $remindersValueSum    = ($remindersValueSum    + $firstActiveReminder->value2);
                  $dueDateDaysReminders = ($dueDateDaysReminders + $firstActiveReminder->value2);
                  
              }
              

           
           $smarty = Yii::app()->viewRenderer->getSmarty();
           $smarty->assign('order', $order);
           $smarty->assign('invoiceNO'        , $chargeback->payment_reference);
           $smarty->assign('customer'         , $customer);
           $smarty->assign('reminders'        , $reminders);
           $smarty->assign('remindersPCS'     , $remindersPCS);
           $smarty->assign('remindersValue'   , $remindersValue);
           $smarty->assign('remindersVAT'     , $remindersVAT);
           $smarty->assign('remindersTotal'   , $remindersTotal);
           $smarty->assign('customerAddress'  , $customerAddress);
           $smarty->assign('itemPrice'        , number_format($chargeback->netto,2, '.',' '));
           $smarty->assign('itemPriceWithVat' , number_format($chargeback->brutto,2, '.',' '));
           $smarty->assign('itemFee'          , $order->fee);
           $smarty->assign('article_name'     , 'Chargeback for Order no #'.$order->id);
           $smarty->assign('totalAmount'      , number_format($chargeback->netto,2, '.',' '));
           $smarty->assign('paymentReference' , $chargeback->payment_reference);
           $smarty->assign('dateDue'          , $chargeback->date_due_ext);
           $smarty->assign('totalAmountAN'    , number_format($chargeback->netto+$chargeback->penality,2, '.',' '));
           $smarty->assign('totalAmountAB'    , number_format($chargeback->brutto+$chargeback->penality,2, '.',' '));
           $smarty->assign('vat'              , (($chargeback->brutto/$chargeback->netto)*100)-100);
           $smarty->assign('vatValue'         , number_format($chargeback->brutto-$chargeback->netto,2, '.',' '));
           $smarty->assign('customerCountry'  , 'Sverige');

           $content = $smarty->fetch('r1_c_r.tpl');  
           
           $pathToPdf=YiiBase::getPathOfAlias('webroot')."/protected/documents/pdf/agreements/chargeback_r".$level."_".$chargeback->payment_reference.".pdf";
           
           PdfGenerator::generatePdfTcpdf($content,false,$pathToPdf);
           $firstActiveReminder = RemiDao::getReminderValueByChargebackPenalityLevel($chargeback->id);
           $documents                   = new Documents;
           $documents->user_id          = $order->buyer_id;
           $documents->order_id         = $order->id;
           $documents->documentType_id  = 9;
           $documents->type             = 1;
           $documents->penalityLevel    = $level;
           $documents->penality         = $firstActiveReminder->value2;
           $documents->name             = $level.'_'.$chargeback->payment_reference;
           $documents->path             = $pathToPdf;
           $documents->save();
           
           BeepSendSMS::sendSMS('0038765015595', 'Faktura+reminder: http://shop.peydo.com/Faktura/FR'.$level."_".$nameOfDoc);
           return $pathToPdf;
           
        } 
        public function actionTest() {
             $level=4;
             
             $payin = '1150';
             $x=$level;
             for ($level; $x>0; $x--) {
                  $getReminderValue = DocumentsDao::getDocumentByOrderIdAndTypeAndLevel(1204, '9', $x);
                  if ($payin>0) {
                        if ($payin > $getReminderValue->penality) {
                            $payin = ($payin - $getReminderValue->penality);
                            echo $getReminderValue->penality.' - PAID: <b>'.$getReminderValue->penality.'</b><br>';
                        } elseif($payin===$getReminderValue->penality) {
                            $payin = ($payin - $getReminderValue->penality);
                            echo $getReminderValue->penality.' - PAID: <b>'.$getReminderValue->penality.'</b><br>';
                        } else {
                            $payinT =  $payin;
                            echo $getReminderValue->penality.' - PAID: <b>'.$payinT.'</b><br>';
                            $payin  = 0;
                        }
                  }
             }
        }
        
        public function actiontest1() {
            print p2i::call_p2i('www.google.com', 'googleslika');
            
        }
}