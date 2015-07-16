<?php

class OrdersController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
        public function actionview()
	{
		$this->renderPartial('view');
	}
        public function actionfinished()
	{
		$this->renderPartial('finished');
	}
        public function actioninvoices()
	{
		$this->renderPartial('invoices');
	}
        public function actionsold()
	{
		$this->renderPartial('sold');
	}
        public function actiontransactions()
	{
		$this->renderPartial('transactions');
	}
        public function actionreceipt()
	{
		$this->renderPartial('receipt');
	}
        public function actiongetList() {
            $dataFromPost   = $_POST['data'];
            $shop           = ShopsDao::validateCID($dataFromPost);
            $orders         = OrdersDao::getOrdersByShopId($shop->id);
//            echo json_encode($orders);
            $object = new stdClass();
            $object = (array) $object;
            $x=0;
            if (count($orders)>0) {
                do {
                    $date_value                       = new DateTime($orders[$x]->time_created);
                    $object[$orders[$x]->id]->status  = $orders[$x]->orderStatus_id;
                    $object[$orders[$x]->id]->price   = number_format($orders[$x]->price, 2, ',','.').' kr';
                    $object[$orders[$x]->id]->code    = $orders[$x]->code;
                    $object[$orders[$x]->id]->time    = $date_value->format("d/m/y")."|".$date_value->format("H:i");
                    $object[$orders[$x]->id]->id      = $orders[$x]->id;
                    $x++;
                } while ($x<count($orders));
               
            }
            $y=0;
            $ordersDelete    = OrdersDao::getOrdersByShopIdNotActive($shop->id);
            if (count($ordersDelete)>0) {
                do {
                    $object[$ordersDelete[$y]->id]->status  = $ordersDelete[$y]->orderStatus_id;
                    $object[$ordersDelete[$y]->id]->id      = $ordersDelete[$y]->id;
                    $y++;
                } while ($y<count($ordersDelete));
               
            }
            
            
            echo json_encode( $object);
        }
        public function actiongetListFinished() {
            $dataFromPost   = explode("|", $_POST['data']);
            $shop           = ShopsDao::validateCID($dataFromPost[0]);
            
            if ($dataFromPost[1]==='2') {
                $orders     = OrdersDao::getOrderAllButActiveByStatus($shop->id, 2);
            } else {
                $orders     = OrdersDao::getOrderAllByPaidToShop($shop->id, $dataFromPost[1]);
            }
//            echo json_encode($orders);
            $object = new stdClass();
            $object = (array) $object;
            $x=0;
            if (count($orders)>0) {
                do {
                    $date_value                                 = new DateTime($orders[$x]->time_created);
                    $object[$orders[$x]->id]->status            = $orders[$x]->orderStatus_id;
                    $object[$orders[$x]->id]->price             = number_format($orders[$x]->price, 2, ',','.').' kr';
                    $object[$orders[$x]->id]->total_amount      = $orders[$x]->price;
                    $object[$orders[$x]->id]->code              = $orders[$x]->code;
                    $object[$orders[$x]->id]->time              = $date_value->format("d/m/y")."|".$date_value->format("H:i");
                    $object[$orders[$x]->id]->id                = $orders[$x]->id;
                    $x++;
                } while ($x<count($orders));
               
            }
            echo json_encode( $object);
        }
        public function actiongetOrderData() {
            $dataFromPost = $_POST['data'];
            $order = OrdersDao::getOrderByIdAll($dataFromPost);
            $date_value = new DateTime($order->time_created);
            echo $date_value->format("d/m/y").' '.$date_value->format("d/m/Y").' '.$order->code.' '.number_format($order->price, 2, ',','.').' kr';
        }
        
        
        public function actionorderAction() {
            $dataFromPost = explode("|",$_POST['data']);
            $order = OrdersDao::getOrderById($dataFromPost[0]);
            $paymentRef = substr(date("Y"),-2).$order->id.$this->RandomCode(2);
            $date_due               = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'dateDueExtensionDays'));
            $date_due_value         = new DateTime($order->date_accepted);
            $date_due_value->modify("+".$date_due->setting_value." days"); 
            $date_due_valueTemp     = $date_due_value->format("Y-m-d H:i:s"); 
            
            if (count($order)>0) {
                if ($dataFromPost[1]=='approve') {
                    $order->orderStatus_id      = '2';
                    $order->orderStatusF_id     = '0';
                    $order->payment_reference   = $paymentRef;
                    $order->date_due            = $date_due_valueTemp;
                    $order->date_due_ext        = $date_due_valueTemp;
                } else {
                    $order->orderStatus_id      = '3';
                    $order->orderStatusF_id     = 'NULL';
                }
                $order->date_accepted = date("Y-m-d H:i:s");
                $order->update(array('orderStatus_id', 'date_accepted', 'orderStatusF_id', 'date_due', 'date_due_ext', 'payment_reference'));
                echo '#ok|'.$order->id;
                //============================= SEND SMS WITH PDF ================================
                $buyer    = UsersDao::getUserById($order->buyer_id);
                if ($dataFromPost[1]=='approve') {
                    $ocr      = $paymentRef;
                    
                    $message  = "Hej ".$buyer->name."! Här är din faktura: (qlirr.com/Faktura/ID".substr(date("Y"),-2)."-".$order->id."). Tack för att du använder QLIRR.";
                    BeepSendSMS::sendSMS($buyer->mobile_number, $message); // promjeniti u $buyer->mobile_number
                    $this->generatePDF($order->id, true, 'buyer');
                    
                    $buyer->creditLimit_reserved = $buyer->creditLimit_reserved - ($order->price);
                    $buyer->creditLimit_expends  = $buyer->creditLimit_expends  + ($order->price);
                    $buyer->update(array('creditLimit_reserved', 'creditLimit_expends'));
                } else {
                    $buyer->creditLimit_reserved = $buyer->creditLimit_reserved - ($order->price);
                    $buyer->creditLimit_remaining = $buyer->creditLimit_remaining + ($order->price);
                    $buyer->update(array('creditLimit_remaining', 'creditLimit_reserved'));
                }
            } else {
                $orderStatus = OrdersDao::getOrderByIdStatus($dataFromPost);
                if ($orderStatus->orderStatus_id ==='2') {
                    echo "#error|#approved|Your order is already approved";
                } else if ($orderStatus->orderStatus_id ==='3') {
                    echo "#error|#rejected|Your order is already rejected";
                } else {
                    echo "#error|#noexist|Your order not exist";
                }
            }
        }
        public function actionorderStorno() {
            $dataFromPost = $_POST['data'];
            $order = OrdersDao::getOrderFinishedById($dataFromPost);
            $order->orderStatus_id = 1;
            $order->update(array('orderStatus_id'));
            echo '#ok';
        }
        
        public function actionremoveFromList(){
            $orderID = $_GET['id'];
            echo $orderID;
            $order = OrdersDao::getOrderByIdStatus($orderID);
            if (count($order)>0) {
                $order->sync = '1';
                $order->update('sync');
                echo '#ok';
            }
        }
        public function generatePDF($order_id, $bankgirot, $userType) {
           $orderID                 = $order_id;
           $order                   = OrdersDao::model()->findByPk($order_id);
           $customer                = UsersDao::getUserData($order->buyer_id);
           $customerAddressBuyer    = UserAddressDao::getPrimaryAddressByTypeAndUserId($order->buyer_id,0);
           $bankBuyer               = ShopBankDao::getBankByUserId($order->buyer_id);
           $nameOfDoc               = substr(date("Y"),-2)."-".$orderID;           
           $date_due_value          = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'dateDueExtensionDays'));           
           
           $buyerMobile             = '0'.substr($customer->mobile_number, 4, strlen($customer->mobile_number));
           
           $feeAmount               = '29';
           $feePrice                = '29';
           $dateDue                 = new DateTime($order->date_accepted);
           $dateDue->modify("+ ".$date_due_value->setting_value." days");
           
           $tempPayReferenceCode    = substr(date("Y"),-2).'-'.$order->id.'-'.$this->RandomCode(4);
           $total_amount            = number_format($order->total_amount,2, ',',' ');
           $decimal                 = explode(',', $total_amount);
           $smarty                  = Yii::app()->viewRenderer->getSmarty();
           $smarty->assign('order',                 $order);
           $smarty->assign('invoiceNO',             $nameOfDoc);
           $smarty->assign('customer',              $customer);
           $smarty->assign('feeAmount',             $feeAmount);
           $smarty->assign('feePrice',              $feePrice);
           $smarty->assign('customerAddressBuyer',  $customerAddressBuyer);
           $smarty->assign('buyerMobile',           $buyerMobile);
           $smarty->assign('itemPrice',             $order->total_amount);
           $smarty->assign('itemFee',               $order->fee);
           $smarty->assign('article_name',          $order->code);
           $smarty->assign('totalAmount',           $total_amount);
           $smarty->assign('decimalAmount',         $decimal[1]);
           $smarty->assign('wholeAmount',           $decimal[0]);
           $smarty->assign('paymentReference',      $tempPayReferenceCode);
           $smarty->assign('paymentReferenceSeller',$nameOfDoc.'-'.$this->RandomCode(4));
           $smarty->assign('dateDue',               $dateDue->format("Y-m-d"));
           $smarty->assign('customerCountry',       'Sverige');
           $content     = $smarty->fetch('r1.tpl'); 
           $pathToPdf   = YiiBase::getPathOfAlias('webroot')."/protected/documents/pdf/agreements/invoice_".$nameOfDoc.".pdf";
           $userDocId   = $order->buyer_id;

           $documents                            = new Documents;
           $documents->user_id                   = $userDocId;
           $documents->order_id                  = $order->id;
           $documents->documentType_id           = 8;
           $documents->name                      = $nameOfDoc;
           $documents->path                      = $pathToPdf;
           $documents->save();
           
           $modelPayout= new Payouts;
                 $modelPayout->user_id           = $order->seller_id;
                 $modelPayout->user_verified     = '2';
                 $modelPayout->order_id          = $order->id;
                 $modelPayout->status_id         = 1;
                 $modelPayout->userBank          = $bankBuyer->bank_account;
                 $modelPayout->amount            = $order->price;
                 $modelPayout->payment_model     = '1333';
                 $modelPayout->payment_reference = $tempPayReferenceCode;
           $modelPayout->save();
           
           
           PdfGenerator::generatePdfTcpdf($content,$bankgirot,$pathToPdf);
           return $pathToPdf;
           
        }
        
        public function RandomCode($lengthCode) {
            $characters = '0123456789';
            $randomString = '';
            for ($i = 0; $i < $lengthCode; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $randomString;
        }
        
        public function actiontest() {
            $this->generatePDF(1410, true, 'buyer');
            
        }
        
        public function actionTest1234() {
            $data2 = OrdersDao::searchByInput('10 06', '9999');
           
        }
        
        public function actiongetSearchList() {
            $dataFromPost    = explode("|", $_POST['data']);
            $shop            = ShopsDao::validateCID($dataFromPost[1]);
            $searchFiltered  = str_replace('.', '', $dataFromPost[0]);
//            $searchFiltered2 = str_replace('/', '', $searchFiltered);
//            $searchFiltered3 = str_replace(' ', '', $searchFiltered2);
            
            if ($dataFromPost[2]==='2') {
                $orders         = OrdersDao::searchByInput($searchFiltered, $shop->id);
            } else {
                $orders         = OrdersDao::searchByInput2($searchFiltered, $shop->id, $dataFromPost[2]);
            }
            
            $x=0;
//            $header = '<table id="tableFaktura" class="tableFaktura"><tr style="padding-bottom: 3px;"><th>DATUM</th><th>REFERENS</th><th>BELOPP</th></tr>';
            if (count($orders)) { 
                do {
                    $dateNew = new DateTime($orders[$x]->date_accepted);
                    $output  = $output.'<div data-content="'.$orders[$x]->id.'" class="searchItem row"><p>'.str_replace(strtoupper($dataFromPost[0]), '<span style="font-weight:500;color:#000">'.strtoupper($dataFromPost[0]).'</span>',date_format($dateNew, 'Y/m/d')).'</p> ';
                    $output  = $output.'<p>'.str_replace(strtoupper($dataFromPost[0]), '<span style="font-weight:500;color:#000">'.strtoupper($dataFromPost[0]).'</span>',$orders[$x]->code).'</p> ';
                    $output  = $output.'<p>'.str_replace(strtoupper($dataFromPost[0]), '<span style="font-weight:500;color:#000">'.strtoupper($dataFromPost[0]).'</span>',number_format($orders[$x]->total_amount, 2, ",", ".")).' KR</p></div>';
                    $x++;
                } while ($x< count($orders));
//                $output = str_replace(strtoupper($dataFromPost[0]), '<span style="font-weight:500;color:#000">'.strtoupper($dataFromPost[0]).'</span>', $output);
                echo $output;
            } else {
                echo $output;
            }
            
        }
        
        public function actiongetShopsList() {
            $dataFromPost   = $_POST['data'];
            $shop           = ShopsDao::searchShopByName($dataFromPost);
            
            $x=0;
            if (count($shop)) { 
                do {
                    $shopAddress = ShopAddressDao::getAddressByShopId($shop[$x]->id);
//                  --------------------------------------------------------------------------------------------------------
                    $output .= '<div data-content="'.$shop[$x]->id.'" class="searchItem row"><p style="padding-right:0;">'.str_ireplace($dataFromPost,'<span style="font-weight:500;color:#000">'.$dataFromPost.'</span>',$shop[$x]->name).',</p>';
                    $output .= '<p>&nbsp;'.$shopAddress->street.', '.$shopAddress->city.', '.$shopAddress->post_code.'</p>';
                    $output.='</div>';
                    $x++;
                } while ($x< count($shop));
                echo $output;
            } else {
               $shopAddS = ShopAddressDao::getList($dataFromPost); 
               $y=0;
               if (count($shopAddS)) {
                   do {
                       $shopAdd = ShopsDao::getShopById($shopAddS[$y]->user_id);
                       $output .= '<div data-content="'.$shopAdd->id.'" class="searchItem row"><p style="padding-right:0;">'.str_ireplace($dataFromPost,'<span style="font-weight:500;color:#000">'.$dataFromPost.'</span>',$shopAdd->name).',</p>';
                        $output .= '<p>&nbsp;'.str_ireplace($dataFromPost,'<span style="font-weight:500;color:#000">'.$dataFromPost.'</span>',$shopAddS[$y]->street).', '.str_ireplace($dataFromPost,'<span style="font-weight:500;color:#000">'.$dataFromPost.'</span>',$shopAddS[$y]->city).', '.str_ireplace($dataFromPost,'<span style="font-weight:500;color:#000">'.$dataFromPost.'</span>',$shopAddS[$y]->post_code).'</p>';
                        $output.='</div>';
                        $y++;
                   } while ($y<count($shopAddS));
               }
               echo $output;
            }
            
        }
        public function actiongetCountryList() {
            $dataFromPost   = $_POST['data'];
            $country        = CountryDao::getCountryByName($dataFromPost);
            
            
            $x=0;
            if (count($country)) { 
                do {
                    
                    $pos = stripos($country[$x]->country_name, $dataFromPost);
                    if ($pos > 0) {
                       $output .= '<div data-img="'.strtoupper($country[$x]->iso_code2).'" data-content="'.$country[$x]->country_name.'" data-pos="'.$pos.'"  class="searchItem row"><img src="/themes/frontend/gfx/flags-mini/'.strtoupper($country[$x]->iso_code2).'.png" alt="flag"/><p style="padding-right:0;">'.str_ireplace($dataFromPost,'<span style="font-weight:500;color:#000;text-transform:lowercase">'.$dataFromPost.'</span>',$country[$x]->country_name).'</p>'; 
                    } else {
                        $output .= '<div data-img="'.strtoupper($country[$x]->iso_code2).'"  data-content="'.$country[$x]->country_name.'" data-pos="'.$pos.'" style="text-transform:capitalize;" class="searchItem row"><img src="/themes/frontend/gfx/flags-mini/'.strtoupper($country[$x]->iso_code2).'.png" alt="flag"/><p style="padding-right:0;">'.str_ireplace($dataFromPost,'<span style="font-weight:500;color:#000;">'.strtolower($dataFromPost).'</span>',$country[$x]->country_name).'</p>';
                    }
                    //                  --------------------------------------------------------------------------------------------------------
                    
                    //$output .= '<p>&nbsp;'.$shopAddress->street.', '.$shopAddress->city.', '.$shopAddress->post_code.'</p>';
                    $output.='</div>';
                    $x++;
                } while ($x< count($country));
                echo $output;
            } 
            
        }
        public function actiongetCountryListValute() {
            $dataFromPost   = $_POST['data'];
            $valute         = CurrDao::getCurrByName($dataFromPost);
            
            
            $x=0;
            if (count($valute)) { 
                do {
                    
                    $pos = stripos($valute[$x]->currency_name, $dataFromPost);
                 
                    if ($pos > 0) {
                       $output .= '<div data-sign="'.$valute[$x]->currrency_symbol.'"  data-valute="'.$valute[$x]->currency_code.'" data-img="'.strtoupper($valute[$x]->iso_alpha2).'" data-content="'.$valute[$x]->name.' ('.$valute[$x]->currency_code.')" data-pos="'.$pos.'"  class="searchItem row"><img src="/themes/frontend/gfx/flags-mini/'.strtoupper($valute[$x]->iso_alpha2).'.png" alt="flag"/><p style="padding-right:0;">'.str_ireplace($dataFromPost,'<span style="font-weight:500;color:#000;text-transform:lowercase">'.$dataFromPost.'</span>',$valute[$x]->name).' ('.$valute[$x]->currency_code.')</p>'; 
                    } else {
                        $output .= '<div data-sign="'.$valute[$x]->currrency_symbol.'"  data-valute="'.$valute[$x]->currency_code.'"  data-img="'.strtoupper($valute[$x]->iso_alpha2).'"  data-content="'.$valute[$x]->name.' ('.$valute[$x]->currency_code.')" data-pos="'.$pos.'" style="text-transform:capitalize;" class="searchItem row"><img src="/themes/frontend/gfx/flags-mini/'.strtoupper($valute[$x]->iso_alpha2).'.png" alt="flag"/><p style="padding-right:0;">'.str_ireplace($dataFromPost,'<span style="font-weight:500;color:#000;">'.strtolower($dataFromPost).'</span>',$valute[$x]->name).' ('.$valute[$x]->currency_code.')</p>';
                    }
                    //                  --------------------------------------------------------------------------------------------------------
                    
                    //$output .= '<p>&nbsp;'.$shopAddress->street.', '.$shopAddress->city.', '.$shopAddress->post_code.'</p>';
                    $output.='</div>';
                    $x++;
                } while ($x< count($valute));
                echo $output;
            } 
            
        }
        
        
        public function actiongetShopData() {
            $dataFromPost   = $_POST['data'];
            $shop           = ShopsDao::getShopById($dataFromPost);
            $shopAddress    = ShopAddressDao::getAddressByShopId($shop->id);
            echo $shopAddress->street.'+'.$shopAddress->city.'|'.$shop->name.', '.$shopAddress->street.', '.$shopAddress->city.', '.$shopAddress->post_code;
        }

        public function actiongetSearchEnter() {
            $dataFromPost    = explode("|", $_POST['data']);
            $shop            = ShopsDao::validateCID($dataFromPost[1]);
            $searchFiltered  = str_replace('.', '', $dataFromPost[0]);
            $orders         = OrdersDao::searchByInput($searchFiltered, $shop->id);
            $x=0;
            $object = new stdClass();
            $object = (array) $object;
            if (count($orders)) { 
                do {
                    $date_value                                 = new DateTime($orders[$x]->time_created);
                    $object[$orders[$x]->id]->status            = $orders[$x]->orderStatus_id;
                    $object[$orders[$x]->id]->price             = number_format($orders[$x]->total_amount, 2, ',','.').' kr';
                    $object[$orders[$x]->id]->total_amount      = $orders[$x]->total_amount;
                    $object[$orders[$x]->id]->code              = $orders[$x]->code;
                    $object[$orders[$x]->id]->time              = $date_value->format("d/m/y")."|".$date_value->format("H:i");
                    $object[$orders[$x]->id]->id                = $orders[$x]->id;
                    $x++;
                } while ($x< count($orders));
                echo json_encode( $object);
            } else {
                echo json_encode( $object);
            }
            
        }
        public function actiongetSearchListFaktura() {
            $dataFromPost   = explode("|", $_POST['data']);
            $shop           = ShopsDao::validateCID($dataFromPost[1]);
            $orders         = InvoiceDao::searchByInput($dataFromPost[0], $shop->id);
            $x=0;

            if (count($orders)) {
                do {
                    if ($orders[$x]->user_id === $shop->id) {
                        $dateNew = new DateTime($orders[$x]->date_issued);
                        $output  = $output.'<div class="searchItem"><p>'.$orders[$x]->id.'</p>';
                        $output  = $output.'<p>'.date_format($dateNew, 'Y-m-d').'</p>';
                        $output  = $output.'</div>';
                    }
                    $x++;
                } while ($x< count($orders));
                //$output = str_replace(strtoupper($dataFromPost[0]), '<span style="background-color:rgba(250,246,130,0.9);font-weight:900">'.strtoupper($dataFromPost[0]).'</span>', $output);
                echo $output;
            } else {
                echo $output;
            }
            
        }
        
        public function actiondownloadInvoice() {
            $dataFromPost = $_GET['id'];
           // $dataFromPost = '22';
            $invoice        = InvoiceDao::getInvoiceById($dataFromPost);
            $pathToInvoice  = YiiBase::getPathOfAlias('webroot').'/protected/documents/pdf/agreements/invoice_s_'.substr(date('Y'),-2).$invoice->id.'.pdf';
            GDownload::send($pathToInvoice);
        }
        
        public function actiondownloadInvoiceList() {
            $dataFromPost = $_GET['id'];
           // $dataFromPost = '22';
            $invoice        = InvoiceDao::getInvoiceById($dataFromPost);
            $pathToInvoice  = YiiBase::getPathOfAlias('webroot').'/protected/documents/pdf/agreements/list_s_'.substr(date('Y'),-2).$invoice->id.'.pdf';
            GDownload::send($pathToInvoice);
        }
        public function actionverifyBuyer() {
            $dataFromPost   = explode("|", $_POST['data']);
            $user           = UsersDao::getUserBySSN($dataFromPost[0]);
            if (count($user)>0) {
                $user->verification_document = $dataFromPost[1];
                $user->update(array('verification_document'));
                echo '#ok';
            } else {
                echo '#error';
            }
            
        }
        public function actionsendMail() {
            $dataFromPost = explode($_POST['data'], '|');
            $text = 'Contact From Qlirr fonrend';
            $text.= '--------------------------';
            $text.= $dataFromPost[0].'<br>'.$dataFromPost[1].'<br>'.$dataFromPost[2].'<br>'.$dataFromPost[3].'<br>'.$dataFromPost[4].'<br>';
            $text.= '---------------------------';
            $error = SendMail::mailsend("oste@qlirr.com", "oste@qlirr.com","Contact from Qlirr frontend",$text,Null ,"pero");
            echo $error;
        }
        
        public function actioncheckBuyer(){
            $dataFromPost = $_POST['data'];
            $order        = OrdersDao::getOrderByIdAll($dataFromPost);
            $user           = UsersDao::getUserById($order->buyer_id);
            if ($user->verification_document == '0') {
                echo '#not_verified|'.$user->name.' '.$user->surname.'|'.$user->personal_number;
            } else {
                echo '#verified';
            }
        }
        
        public function actionprintTransactions() {
            $dataFromPost = $_POST['data'];
            $path = $this->generateprintPDFTransactions($dataFromPost);
            $newpath = Yii::app()->assetManager->publish($path);
            echo $newpath;

        }
        
        public function generateprintPDFTransactions($order_string) {
           
            $data = explode('|', $order_string); 
            $x=0;
            do {
                $order   = OrdersDao::getOrderAllById($data[$x]);
                $realDate = new DateTime($order->date_accepted);
                $dateS  .= $realDate->format('Y.m.d').'<br>';
                $codeS  .= $order->code.'<br>';
                $totalS .= number_format($order->total_amount,2,",",".").'<br>';
                $totalTotal+= $order->total_amount;
                $x++;
                $noS    .= $x.'.<br>';
            } while ($x < count($data)-1);
            
            $shop = ShopsDao::getShopById($order->seller_id);
            $shopAddress = ShopAddressDao::getAddressByShopId($shop->id);
            
            $smarty  = Yii::app()->viewRenderer->getSmarty();
            $smarty->assign('nummer',       '<p style="line-height:2px;font-size:14px">'.$noS.'</p>');
            $smarty->assign('date',         '<p style="line-height:2px;font-size:14px">'.$dateS.'</p>');
            $smarty->assign('code',         '<p style="line-height:2px;font-size:14px">'.$codeS.'</p>');
            $smarty->assign('total',        '<p style="line-height:2px;font-size:14px">'.$totalS.'</p>');
            $smarty->assign('shop',         $shop);
            $smarty->assign('shopAddress',  $shopAddress);
            $smarty->assign('totalTotal',   number_format($totalTotal,2,",","."));
            $content     = $smarty->fetch('printTransaction.tpl'); 
            $pathToPdf   = YiiBase::getPathOfAlias('webroot')."/protected/documents/print/garbage/".GeneralFunctions::randomCode(16).".pdf";
           
            PdfGenerator::generatePdfTcpdf($content,false,$pathToPdf);
            
            return $pathToPdf;
           
        }
}