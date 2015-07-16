<?php
    class SiteController extends Controller
    {
        public $layout;
        public $new;
        public $newOffer;
        public $userLogin;
        public $status;
        public $code;
        public $modelLoginForm;
        public $user;
        
        public function init()
        {
            $this->modelLoginForm=new LoginForm;
        }
        
        /**
        * This is the default 'index' action that is invoked
        * when an action is not explicitly requested by users.
        */
        public function actionIndex()
        {
            // renders the view file 'protected/views/site/index.php'
            // using the default layout 'protected/views/layouts/main.php'
            /*if(!Yii::app()->user->isGuest) {
            $user = (Yii::app()->user->getState('UserData'));

            if($user->userType_id == 3)
            $this->redirect(array('/customer'));
            elseif($user->userType_id == 2)
            $this->redirect(array('/merchant'));
            elseif($user->userType_id == 1)
            $this->redirect(array('/admin'));
            }*/

            /*$html2pdf = Yii::app()->ePdf->HTML2PDF();
            $html2pdf->WriteHTML($this->renderPartial('index', array(), true));
            $html2pdf->Output();*/
            $this->render('index', array('lang' => 'en'));
        
            /*$emailTemplate = EmailTemplate::model()->findByPk(1);
            $buyer = Users::model()->findByPk(3);*/

            /*SendMail::mailsend("draganbl@gmail.com", "draganbl@gmail.com", "aaa", $this->smarty->fetch('eval:' . TinyMCECharacterConvertor::convertCharacters($emailTemplate->eContent)));*/

        }
        public function actionmyaccount() {
            $this->layout = '//layouts/myAccount';
            $this->pageTitle = 'Peydo - Secure Connection'; 
            Yii::app()->language = $_COOKIE['lang'];
            $this->render('/myaccount/index'); 
           
        }
        public function actionen() { 
            
            $this->render('index', array('lang'=>'en'));
        }
        public function actionsv() { 
            
            $this->render('index', array('lang'=>'sv'));
        }
        public function actionhr() { 
            
            $this->render('index', array('lang'=>'hr'));
        }
        public function actionWizard()
        {

            $this->user = Yii::app()->user->getState('UserData'); 

            $model = new Users;

//            $this->render('wizard', array('model'=>$model));   
        }
        public function actionshopmap() {
            $this->renderPartial('shopmap');
        }

        public function actionFirstStep()
        {
            if($_POST)
            {
                $model = new Users;
                $model->email = $_POST['email'];
                $model->repeat_email = $_POST['email'];
                $model->password = sha1($_POST['password']);
                $model->repeat_password = sha1($_POST['password']);
                $model->status = 2;
                $model->save();
            } else {
                //$this->redirect(array('/site/index'));
            }
        }

        public function actionSecondStep()
        {
            if($_POST)
            {
                $user = Users::model()->findByAttributes(array('email'=>$_POST['email']));
                $user->name = $_POST['name'];
                $user->surname = $_POST['surname'];
                $user->personal_number = $_POST['personal_number'];
                $user->mobile_number = $_POST['mobilePrefix'].$_POST['mobile_number'];
                if(isset($_POST['id_number']))
                    $user->id_number = $_POST['id_number'];
                $user->status = 1;
                $user->save();
            } else {
                //$this->redirect(array('/site/index'));
            }
        }

        /**
        * This is the action to handle external exceptions.
        */
        public function actionError()
        {
            if($error=Yii::app()->errorHandler->error)
            {
                if(Yii::app()->request->isAjaxRequest)
                    echo $error['message'];
                else
                    $this->render('error', $error);
            }
        }

        public function actionLanguage($lang, $url)
        {
            unset(Yii::app()->request->cookies['language']);

            Yii::app()->request->cookies['language'] = new CHttpCookie('language', $lang, array('expire'=>time() +(30*24*60*60)));

            $this->redirect($url);        
        }

        public function actionSecure()
        {
            if(Yii::app()->user->isGuest) {
                $this->redirect("/site/index"); 
            }

            $user = (Yii::app()->user->getState('UserData'));

            if($user->userType_id == 3)
                $redirect = "customer";
            elseif($user->userType_id == 2)
                $redirect = "merchant";
            elseif($user->userType_id == 1)
                $redirect = "admin";

            $this->layout = '//layouts/blank';
            $this->pageTitle = 'Peydo - Secure Connection'; 
            $this->render('secure', array("redirect" => $redirect)); 
        }

        /**
        * Displays the login page
        */
        public function actionlogin() {
          $this->renderPartial('login');
        }

        /**
        * Logs out the current user and redirect to homepage.
        */
        public function actionLogoutSecure()
        {
            $adminId = Yii::app()->user->getState("adminId");
            if($adminId) {
                $user = Users::model()->findByPk($adminId);
                $login = new LoginForm();
                $login->username = $user->mobile_number;
                $login->password = $user->password;
                if($login->login()) 
                    $this->redirect("/admin");
            }
            Yii::app()->user->logout();
            $this->redirect(Yii::app()->homeUrl);
        }

        public function actionLogout()
        {
            $adminId = Yii::app()->user->getState("adminId");
            if($adminId) {
                $user = Users::model()->findByPk($adminId);
                $login = new LoginForm();
                $login->username = $user->mobile_number;
                $login->password = $user->password;
                if($login->login()) 
                    $this->redirect("/admin");
            }
            Yii::app()->user->logout();

            $this->layout = '//layouts/blank';
            $this->pageTitle = 'Peydo - Secure Logout'; 
            $this->render("signOut");
        }

        public function actionSessionOut()
        {
            $this->layout = '//layouts/blank';
            $this->pageTitle = 'Peydo - Session out'; 
            $this->render("sessionOut");
        }

        public function actionCheckOib()
        {
            $fname = trim($_POST['fname']);
            $lname = trim($_POST['lname']);
            $boi_jmbg = trim($_POST['boi_jmbg']);
            $mobile_number = trim($_POST['mobile_number']);
            $email = trim($_POST['email']);
            $mobilePrefix = trim($_POST['mobilePrefix']);
            $agreement = trim($_POST['agreement']);

            $oib = CheckFunctions::checkOib($fname, $lname, $boi_jmbg);

            $emailCheck  = UsersDao::model()->findByAttributes(array("email" => $email, "status" => 1));
            $mobile_numberCheck  = UsersDao::model()->findByAttributes(array("mobile_number" => $mobilePrefix.$mobile_number, "status" => 1));

            $personalNumberFetcher = new PersonalNumberFetcher();
            $personData = $personalNumberFetcher->getData($fname, $lname, $boi_jmbg);

            $error = "error|";

            if($oib == 'OIBerror')
                $error .= Yii::t('frontend', 'frontend.error.oib_exist');

            if($oib == 'error')
                $error .= Yii::t("frontend", 'frontend.error.name');

            if($emailCheck != null)
                $error .= Yii::t('frontend', 'frontend.error.email_exist');

            if($mobile_numberCheck != null)
                $error .= Yii::t('frontend', 'frontend.error.mobile_exist');

            if($agreement == 0)
                $error .= Yii::t('frontend', 'frontend.error.agreement');

            if(time()-$personData['age'] < 60*60*24*365*18)
                $error .= Yii::t('frontend', 'frontend.error.personal_number');

            if($error == "error|")
                echo $oib;
            else
                echo $error;
        }

        public function actionOffers(){
            if($_POST) {
                $mobile = $_POST['mobilePrefix_id'].$_POST["mobile"];
                $code = $_POST["code"];
                Yii::app()->user->setState("mobile_number", null);

                $login = new LoginForm();

                $order = OrdersDao::model()->findByAttributes(array("code" => $code, "orderStatus_id" => 1));

                //$user = UsersDao::model()->findByAttributes(array("mobile_number" => $mobile));
                $user = UsersDao::model()->findByPk($order->seller_id);

                if($user && $order) {
                    $login->username = $user->mobile_number;
                    $login->password = $user->password;

                    if($user->mobile_number == $mobile) {
                        if($login->login()) {
                            //Yii::app()->user->setState("orderId", $order);
                            $this->redirect(array("/customer/orders/offer/", 'id'=>$order->id));
                        } else {
                            // Yii::app()->user->setFlash('errorCode','Code is wrong.');
                            $this->redirect(array('/site/index'));
                        }
                    } else {
                        Yii::app()->user->setFlash('userMessage', Yii::t('app', 'customer.error.offer_not_exist'));
                        $this->redirect(array('/site/index'));
                    }

                } else if($order) {
                    Yii::app()->user->setState("mobile_number", $mobile);
                    Yii::app()->user->setState("order", $order->id);
                    Yii::app()->user->setFlash('userMessage', 'reg|'.Yii::t('frontend', 'frontend.notification.user_registration'));
                    $this->redirect(array('/site/index'));
                } else {
                    Yii::app()->user->setFlash('userMessage', Yii::t('app', 'customer.error.offer_not_exist'));
                    $this->redirect(array('/site/index'));
                }
            }
        }

        public function actionForget()
        {
            if($_POST)
            {
                if($_POST['email_mobile'] != "")
                {
                    $user = UsersDao::model()->findByAttributes(array('email'=>trim($_POST['email_mobile'])));

                    if(!isset($user->email))
                        $user = UsersDao::model()->findByAttributes(array('mobile_number'=>$_POST['email_mobile']));

                    if(isset($user->email))
                    {   
                        $smarty = Yii::app()->viewRenderer->getSmarty();

                        $emailTemplate = EmailTemplateDao::model()->findByPk(12);   
                        $code = GeneralFunctions::randomCode(8);

                        $user->reset_code = $code;
                        $user->reset_time = date('Y-m-d H:i:s',time());

                        $resetUrl = $this->createAbsoluteUrl('/site/reset', array('code'=>$code));

                        $smarty->assign('user', $user);
                        $smarty->assign('resetUrl', $resetUrl);

                        $code = GeneralFunctions::randomCode(8);
                        $smarty->assign('code', $code);
                        $content = $smarty->fetch('eval:' . $emailTemplate->eContent);

                        SendMail::mailsend($user->email, 
                            $emailTemplate->sender_email, 
                            $emailTemplate->subject, 
                            $content, null, $user, $code);

                        $user->save();
                        echo Yii::t('app', 'customer.success.password_reset').$user->email;
                        return;

                    } else {
                        echo "error|".Yii::t('frontend', 'frontend.error.password_forget');
                    }
                } else {
                    echo "error|".Yii::t('frontend', 'frontend.error.password_forget');
                }   
            }   
        }

        public function actionReset($code)
        {   
            $model = new LoginForm;
            $user = UsersDao::model()->findByAttributes(array('reset_code'=>$code));

            $time = date('U',strtotime($user->reset_time));
            $current = time();

            $diff = $current - $time;
            if($diff >= 86400)
            {
                //echo Yii::t("app", "customer.error.password_reset");
                $status = 1;   
            } else {
                $status = 0;
            }

            if($_POST)
            {
                if($_POST['password'] != "")
                {
                    if($_POST['password'] == $_POST['confirm_password'])
                    {
                        $user->password = sha1($_POST['password']);

                        if($user->save())
                        {
                            $model->username = $user->mobile_number;
                            $model->password = $user->password;

                            if($model->validate() && $model->login()) 
                            {   
                                if($user->userType_id == 3)
                                    echo "customer";
                                elseif($user->userType_id == 2)
                                    echo "merchant";
                                elseif($user->userType_id == 1)
                                    echo "admin";
                            } 
                        }
                    } else 
                        echo "error|".Yii::t('frontend', 'passwords.dont.match');  
                    return;                   
                } else
                    echo "error|".Yii::t('frontend', 'no.password');
                return;
            }
            $model=new LoginForm;
            $this->status = $status;
            $this->code = $code;
            $this->render('index');
        }

        public function actionAccount() {
            if($_GET['new'] == true) {
                $this->new = true;
                $this->render('index');
            }
        }

        public function actionNewOffer() {
            if($_GET['new'] == true) {
                $this->newOffer = true;
                $this->render('index');
            }
        }

        public function actionUserLogin() {
            if($_GET['login'] == true) {
                $this->userLogin = true;
                $this->render('index');
            }
        }

        public function actionPostCodes($term)
        {
            $criteria = new CDbCriteria;
            $criteria->addSearchCondition('postal_code', $term);

            $models = Region::model()->findAll($criteria);

            $arr = array();
            foreach($models as $model)
            {
                $arr[] = array(
                    'label'=>$model->postal_code.' - '.$model->region,  // label for dropdown list
                    'value'=>$model->postal_code,  // value for input field
                    'id'=>$model->postal_code,     // return value from autocomplete
                );
            }

            if(!empty($arr))
                echo CJSON::encode($arr);   
            else
                echo CJSON::encode(Yii::t('frontend', 'no_results'));
        }

        /* public function actionPrv(){
        $criteria = new CDbCriteria();
        $criteria->condition = "id > 494";
        $emails = EmailLogs::model()->findAll($criteria);

        foreach($emails as $email) {
        echo SendMail::mailsend($email->email, "info@peydo.com", $email->subject, $email->content)."<hr />";
        }
        }*/

        public function actionScrape($id) {
            require('protected/components/simple_html_dom.php');

            // Create DOM from URL or file
            $html = file_get_html('http://www.njuskalo.hr/index.php?ctl=display_ad&action=show_pr&ad_id='.$id);

            $articles = array();

            foreach($html->find('div.ad_basic_data_wrap') as $article) {
                $price = explode(" ", $article->find('div.price', 0)->plaintext);
                $articles["cijena"] = $price[2];
                $ad = explode(" ", $article->find('div.ad_id', 0)->plaintext);
                $articles['sifra oglasa'] = $ad[2];
            }

            foreach($html->find('div.ad_contact_data') as $article) {
                $tel1 = explode(" ", $article->find('div span', 2)->plaintext);
                $articles['tel1'] = $tel1[2];
                $tel2 = explode(" ", $article->find('div span', 3)->plaintext);
                $articles['tel2'] = $tel2[2];
                //$item1['tel3']     = $article->find('div span', 4)->plaintext;
            }

            foreach($html->find('img.img_var') as $element) {
                $articles['slika'] = substr($element->src, 2, strlen($element->src));
            }
            foreach($articles as $key => $value) {
                echo $key.": ".$value."<br />";
            } 
        }
        public function actionsiteLogin() {
           $this->renderPartial('frontend', true);

        }
        public function actionnewCheckout() {
            if ($_GET['option']==1) {
                //$mobileNo=OrdersDao::checkOrderByArticle($_GET['article'], Yii::app()->request->userHostAddress)->mobile;
                $mobileNo=$_GET['mobile'];
                $pageRender = 'newOfferPending';
            } else {
                $mobileNo=$_GET['mobile'];
                $pageRender = 'newCheckout';
            }
            $imageLink = $_GET['img'];
            $imageLink = str_replace("|", "/", $imageLink);
            Yii::app()->session['dataCheckoutPublic']=$_GET['title'].'|'.$_GET['article'].'|'.$_GET['seller'].'|'.$_GET['price'].'|'.$_GET['email'].'|'.$mobileNo.'|'.$imageLink.'|'.$_GET['marketplace'];
            $this->renderPartial($pageRender);
        }
        public function actionnewCheckoutBack() {
            
            $this->renderPartial('newCheckout');
          
        }
        public function actionnewCheckoutVerification() {
            $this->renderPartial('newCheckoutVerification');
          
        }
        public function actionnewMyCheckoutVerification() {
            $this->renderPartial('newMyCheckoutVerification');
          
        }
        public function actionnewMyCheckout() {
            $this->renderPartial('newMyCheckout');
          
        }
         public function actiondataExchange() {
      
            $valuesFromJava=explode("|", $_POST['curValue']);
            $fee=ServiceFeesDao::FindServiceFeeByPrice($valuesFromJava[1],3);
            $valuePercent= ApplicationSettings::model()->findByAttributes(array('setting_name' => 'buyerPercentOnInstallments'));
            
            if ($valuesFromJava[0]==1) {
                $montlyBase=$valuesFromJava[1]/$valuesFromJava[2];
                $creditRate=$valuesFromJava[1]*$valuePercent->setting_value/100;
                $totalTotal=$montlyBase+$creditRate; 
                $fee_amount=$creditRate;
            } elseif($valuesFromJava[0]==0) {
                if($fee->fixed==0){
                    $totalTotal=$valuesFromJava[1]+(($valuesFromJava[1]*$fee->percentage)/100);
                    $fee_amount=($valuesFromJava[1]*$fee->percentage)/100;
                } else {
                    $totalTotal=$valuesFromJava[1]+$fee->fixed;
                    $fee_amount=$fee->fixed;
                }
                $valuesFromJava[2]=0;
            } elseif($valuesFromJava[0]==99) {
               $fee=ServiceFeesDao::FindServiceFeeByPrice($valuesFromJava[1],4); 
               if($fee->fixed==0){
                    $totalTotal=$valuesFromJava[1]-(($valuesFromJava[1]*$fee->percentage)/100);
                    $fee_amount=($valuesFromJava[1]*$fee->percentage)/100;
                } else {
                    $totalTotal=$valuesFromJava[1]-$fee->fixed;
                    $fee_amount=$fee->fixed;
                }
            }
            echo round($totalTotal);

        }
        public function actionnewCheckoutSendPin() {
            $pinCode=$this->RandomCode(4);
            $dataFromPost= explode("|", $_POST['dataPost']);
            $textMessage="Hej! Knappa in koden: ".$pinCode.", så betalar vi för din vara.";
            BeepSendSMS::sendSMS($dataFromPost[0], $textMessage); // ujedno upisuje u sms log
            $modelSmsTemp= new SmscodeTemp;
            $modelSmsTemp->mobile_number=$dataFromPost[0];
            $modelSmsTemp->order_reference=$dataFromPost[1];
            $modelSmsTemp->sms_code=$pinCode;       
            $modelSmsTemp->save();

           // $this->renderPartial('newCheckoutVerification');
        }
        public function RandomCode($lengthCode) {
            $characters = '0123456789';
            $randomString = '';
            for ($i = 0; $i < $lengthCode; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $randomString;
       }
       public function actioncheckUserByMobile() {
            $dataFromPost= explode("|", $_POST['data']);
            $user=UsersDao::getUserByMobile($dataFromPost[0]);
            if (empty($user)) {
                echo $user->id;
            } else {
                
                $pinCode=$this->RandomCode(4);
                $textMessage="Din verifieringskod för Qlirr är: ".$pinCode;
                BeepSendSMS::sendSMS($dataFromPost[0], $textMessage); // ujedno upisuje u sms log
                $modelSmsTemp= new SmscodeTemp;
                $modelSmsTemp->mobile_number=$dataFromPost[0];
                $modelSmsTemp->order_reference=$dataFromPost[1];
                $modelSmsTemp->sms_code=$pinCode;       
                $modelSmsTemp->save();
                echo $user->id;
            }
       }

       public function actionautoSellThankYou() {
            $fromSession=explode("|",Yii::app()->session['dataCheckoutPublic']);
            $elements['title']=$fromSession[0];
            $elements['article']=$fromSession[1];
            $elements['seller']=$fromSession[2];
            $elements['price']=$fromSession[3];
            $elements['email']=$fromSession[4];
            $elements['mobile']=$fromSession[5];        
            $elements['image']=$fromSession[6];
            
            $source= $elements['image'];
            $destination= "themes/classic/cms/scraped_img/"."0"."1".$elements['article'].".jpg"; //ovdje popuniti merchant_id prije ispisa fajla
            UtilsMain::SaveImageFromUrl($source, $destination); 
            
             
            $sellerOrder = UsersDao::getUserById($_GET['id']);
            $modelOrder = new Orders;
            $modelOrder->seller_id          = $sellerOrder->id;
            $modelOrder->autosell           = 1; 
            $modelOrder->service_id         = 1;
            $modelOrder->orderStatus_id     = 1;
            $modelOrder->merchant_id        = 3;
            $modelOrder->seller_nick_name   = $elements['seller'];
            $modelOrder->order_reference    = $elements['article'];
            $modelOrder->article_name       = $elements['title'];
            $modelOrder->img_path           = $destination;
            $modelOrder->total_amount       = $elements['price'];
            $modelOrder->min_price          = $_COOKIE['priceTotal'];
            $modelOrder->mobile             = $sellerOrder->mobile_number;
            $modelOrder->ip_address         = Yii::app()->request->userHostAddress;
            $modelOrder->save();
            $this->renderPartial('newMyCheckoutThankYou');
       }
       public function actionupdatePrice() {
           $inputData = explode("|",$_POST['data']);
           $modelOrder = OrdersDao::getOrderData($inputData[0]);
           $modelOrder->total_amount=$inputData[1];
           $modelOrder->update(array('total_amount'));
  
       }
       public function actionupdateLowestPrice() {
           $inputData = explode("|",$_POST['data']);
           $modelOrder = OrdersDao::getOrderData($inputData[0]);
           $modelOrder->min_price=$inputData[1];
           $modelOrder->update(array('min_price'));
 
       }
       public function actioncheckPinSentToMobile() {
           $dataFromPost= explode("|", $_POST['data']);
           $pinConfirm = SmsCodeTempDao::checkPINByArticleAndPhone($dataFromPost[1],$dataFromPost[0], trim($dataFromPost[2]));
           if (empty($pinConfirm->id)) {
               echo $pinConfirm->id;
           } else {
               $user=UsersDao::getUserByMobile($dataFromPost[0]);
               if (empty($user->id)) {
                    $modelUser = new Users;
                    $modelUser->name                = "John";
                    $modelUser->surname             = "Smith";
                    $modelUser->email               = "email@address.com";
                    $modelUser->credit_limit        = 1000;
                    $modelUser->mobile_number       = $dataFromPost[0];
                    $modelUser->userType_id         = 3;
                    $modelUser->save();
                    
                    $modelUserAddress= new UserAddress;
                    $modelUserAddress->user_id      = $modelUser->id;
                    $modelUserAddress->address_type = 0;
                    $modelUserAddress->street       = 'Pellervontie 34A';
                    $modelUserAddress->post_code    = '00610';
                    $modelUserAddress->city         = 'Helsinki';
                    $modelUserAddress->active       = '1';
                    $modelUserAddress->primary      = '1';
                    $modelUserAddress->country_id   = '51';
                    $modelUserAddress->save();
               } 
               $fromSession=explode("|",Yii::app()->session['dataCheckoutPublic']);
               $elements['title']      = $fromSession[0];
               $elements['article']    = $fromSession[1];
               $elements['seller']     = $fromSession[2];
               $elements['price']      = $fromSession[3];
               $elements['email']      = $fromSession[4];
               if (isset($dataFromPost[7])) {
                   $elements['mobile']     =$dataFromPost[7];        
               } else {
                   $elements['mobile']     =$fromSession[5];  
               }
               $elements['image']      =$fromSession[6];
               
               $user=UsersDao::getUserByMobile($dataFromPost[0]);
               
               
//               if ($dataFromPost[3]==1) {
//                    $totalPrice= $dataFromPost[4]*$dataFromPost[5];
//               } else {
//                    $totalPrice= $dataFromPost[4];
//               }
               
               $source=$elements['image'];   
               $destination= "themes/classic/cms/scraped_img/"."0"."3".$elements['article'].".jpg"; //ovdje popuniti merchant_id prije ispisa fajla
               
               $smsCodeToSeller = $this->RandomCode(6);
               
               $modelOrder= new Orders;
                    $modelOrder->service_id         = 3;
                    $modelOrder->orderStatus_id     = 1;
                    $modelOrder->autosell           = 0;
                    $modelOrder->buyer_id           = $user->id;
                    $modelOrder->merchant_id        = 3;
                    $modelOrder->seller_nick_name   = $elements['seller'];
                    $modelOrder->date_issued        = date("Y-m-d");
                    $userSeller=UsersDao::getUserByMobile($elements['mobile']);
                    if (empty($userSeller->id)) {
                        $modelUser = new Users;
                        $modelUser->name            = "Peter";
                        $modelUser->surname         = "Green";
    //                    $modelUser->email           = $inputData[0];
                        $modelUser->credit_limit    = 1000;
                        $modelUser->mobile_number   = $elements['mobile'];
                        $modelUser->userType_id     = 3;
                        $modelUser->save();
                        
                        $modelSellerAddress= new UserAddress;
                        $modelSellerAddress->user_id      = $modelUser->id;
                        $modelSellerAddress->address_type = 0;
                        $modelSellerAddress->street       = 'Osmontie 33A';
                        $modelSellerAddress->post_code    = '00610';
                        $modelSellerAddress->city         = 'Helsinki';
                        $modelSellerAddress->active       = '1';
                        $modelSellerAddress->primary      = '1';
                        $modelSellerAddress->country_id   = '51';
                        $modelSellerAddress->save();
                                               
                    }
                    $userSeller=UsersDao::getUserByMobile($elements['mobile']);  
                    
                    $modelOrder->seller_id          = $userSeller->id;
                    $modelOrder->installments       = Yii::app()->session['checkOutRates'];
                    $modelOrder->orderStatus_id     = 1;
//                    $userShippingAddress=UserAddress::model()->findByAttributes(array("user_id"=>$user->id,"address_type"=>1));
//                    $modelOrder->shippingAddress_id = $userShippingAddress->id;
                    $modelOrder->order_reference    = $elements['article'];
//                    $modelOrder->website            = Yii::app()->session['checkOutArticleLink'];
                    $modelOrder->article_name       = $elements['title'];
                    $modelOrder->img_path           = $destination; 
                    $modelOrder->mobile             = $elements['mobile'];
                    $modelOrder->code               = $smsCodeToSeller;
                    $modelOrder->total_amount       = $dataFromPost[6];
                    $modelOrder->installments       = $dataFromPost[5];
//                    $modelOrder->fee                = Yii::app()->session['checkOutFeeAmount'];
                    $modelOrder->ip_address         = Yii::app()->request->userHostAddress;
               $modelOrder->save();
               
               UtilsMain::SaveImageFromUrl($source, $destination);
//               if (isset($dataFromPost[7])) {
////                   $textMessage="You have a buyer! Visit klirrr.com/site/myaccount and enter PIN ".$smsCodeToSeller." in order to receive payment.";
//                   $textMessage="Hej! Jag (".$dataFromPost[0].") vill betala dig med Peydo. Besök klirrr.com/site/myaccount och knappa in koden: ".$smsCodeToSeller." så har du pengarna på kontot inom 10 minuter.";
//               } else {
//                   $textMessage="You have a buyer! Visit your ad at Tori.fi, click at the Peydo banner and enter this PIN ".$smsCodeToSeller." in order to receive your money. Peydo";
//               }
                $textMessage="Hej! Jag (".$dataFromPost[0].") vill betala dig med Peydo. Besök klirrr.com/site/myaccount och knappa in koden: ".$smsCodeToSeller." så har du pengarna på kontot inom 10 minuter.";
                BeepSendSMS::sendSMS($elements['mobile'] ,$textMessage); // ujedno upisuje u sms log
               
               echo $modelOrder->id;
           }

        }
        public function actioncheckPinSentToMobileAutoSell() {
           $dataFromPost= explode("|", $_POST['data']);
           $pinConfirm = SmsCodeTempDao::checkPINByArticleAndPhone($dataFromPost[1],$dataFromPost[0], trim($dataFromPost[2]));
           if (empty($pinConfirm->id)) {
               echo $pinConfirm->id;
           } else {
               $user=UsersDao::getUserByMobile($dataFromPost[0]);
               echo $user->id;
           }
        }
        public function actionnewUserRegister() {
            $inputData = explode("|",$_POST['data']);
//            $inputData=explode("|","pero@pero.com|test|123123123|004665015595");
            $modelUser = new Users;
                $modelUser->name            = "John";
                $modelUser->surname         = "Smith";
                $modelUser->email           = $inputData[0];
                $modelUser->credit_limit    = 1000;
                $modelUser->mobile_number   = $inputData[2];
                $modelUser->userType_id     = 3;
//                $modelUser->password        = sha1($inputData[1]);
            $modelUser->save();
            
            $user=UsersDao::getUserByMobile($inputData[2]);
            
            $modelUserAddress= new UserAddress;
                $modelUserAddress->user_id      = $user->id;
                $modelUserAddress->address_type = 0;
                $modelUserAddress->street       = 'Pellervontie 34A';
                $modelUserAddress->post_code    = '00610';
                $modelUserAddress->city         = 'Helsinki';
                $modelUserAddress->active       = '1';
                $modelUserAddress->primary      = '1';
                $modelUserAddress->country_id   = '51';
            $modelUserAddress->save();

            $modelUserAddress1= new UserAddress;
                $modelUserAddress1->user_id      = $user->id;
                $modelUserAddress1->address_type = 1;
                $modelUserAddress1->street       = 'Osmontie 33A';
                $modelUserAddress1->post_code    = '00610';
                $modelUserAddress1->city         = 'Helsinki';
                $modelUserAddress1->active       = '1';
                $modelUserAddress1->primary      = '1';
                $modelUserAddress1->country_id   = '51';
            $modelUserAddress1->save();
            
            $modelBankAccount = new BankAccount;
                $modelBankAccount->bank_id='999999';
                $modelBankAccount->user_id=$user->id;
                $modelBankAccount->status='1';
                $modelBankAccount->primary= '1';
                $modelBankAccount->bank_account=$inputData[2];
            $modelBankAccount->save();
            
            $pinCode=$this->RandomCode(4);
            $textMessage="Hej! Knappa in koden: ".$pinCode.", så betalar vi för din vara.";
            BeepSendSMS::sendSMS($inputData[3], $textMessage); // ujedno upisuje u sms log
            $modelSmsTemp= new SmscodeTemp;
            $modelSmsTemp->mobile_number=$inputData[3];
            $modelSmsTemp->order_reference=$inputData[4];
            $modelSmsTemp->sms_code=$pinCode;       
            $modelSmsTemp->save();
            
            echo $user->id; 
        }
        public function actiontoripresentation() {
            $this->renderPartial('toriPresentation', true); 
        }
        public function actionipad() {
            $this->renderPartial('ipad', true); 
        }
        public function actionnewCheckoutThankYou() {
            
            $this->renderPartial('newCheckoutThankYou',true);
        }
        public function actiontoriPresentationEnd() {
            $this->renderPartial('toriPresentationEnd',true);
        }
        public function actioncheck6digitPin() {
            $dataFromPost = explode("|",$_POST['data']);
            $orderID = OrdersDao::checkOrderByPinAndArticle($dataFromPost[0],$dataFromPost[1], $dataFromPost[2]);
            echo $orderID->id;

        }
        public function actionacceptOffer() {
           
            
            if (Yii::app()->session['try2']==0) {
                $this->renderPartial('newAcceptOffer');
            } else {
               
//                $this->redirect(array('/site/newCheckout/option/1/title/Ipad%20mini%20Wi-Fi%20cellular%2016GB/article/124789124/seller/Jake/price/270/email/djpero.84@gmail.com/mobile/004665015595/img/http:%7C%7Cklirrr.com%7Cthemes%7Cclassic%7Ccms%7Ccss%7Cpres%7Cipad.jpg'));
                 $this->renderPartial('newAcceptOffer');
            }
            
        }
        public function actionchangeSession() {
            $dataFromPost=  explode("|", $_POST['sessionName']);
            Yii::app()->session[$dataFromPost[0]]=$dataFromPost[1];
        }
        public function actionsellOffer() {
           $inputData = explode("|",$_POST['data']);

           $modelOrder = OrdersDao::getOrderData($inputData[1]);
           $modelOrder->orderStatus_id=2;
           $modelOrder->update(array('orderStatus_id'));
           
           $order   = OrdersDao::getOrderData($inputData[1]);
           $seller  = UsersDao::getUserById($order->seller_id);
           $buyer   = UsersDao::getUserById($order->buyer_id);
            
           $modelBankAccountTemp=BankAccountDao::getUserPrimaryAccount($seller->id);
           if (empty($modelBankAccountTemp)) {
               $modelBankAccount = new BankAccount;
//                $modelBankAccount->bank_id='999999';
                $modelBankAccount->user_id=$seller->id;
                $modelBankAccount->status='1';
                $modelBankAccount->primary= '1';
                $modelBankAccount->bank_account=$inputData[0];
               $modelBankAccount->save();
           } else {
                $modelBankUpdate = BankAccountDao::getUserPrimaryAccount($seller->id);
                $modelBankUpdate->bank_account=$inputData[0];
                $modelBankUpdate->update(array('bank_account'));
           }
           
           
           // ============= ovdje unijeti podatke za isplatu nakon sto je kupac upisao svoje podatke
           // ============= pogledati da li je prosao INSTANTOR ili PHONE CHECK
           // ======================================================================================
           $feeSeller=ServiceFeesDao::FindServiceFeeByPrice($modelOrder->total_amount, 4);

           if ($feeSeller->fixed==0) {
               $serviceFee = $order->total_amount -($order->total_amount*((100-$feeSeller->percentage)/100));
           } else {
               $serviceFee = $order->total_amount-($order->total_amount-$feeSeller->fixed);
           }
            $modelPayout= new Payouts;
                $modelPayout->user_id           = $seller->id;
                $modelPayout->user_verified     = $seller->verification;
                $modelPayout->order_id          = $order->id;
                $modelPayout->status_id         = 1;
                $modelPayout->payment_reference = 'SV01';
                $modelPayout->amount            = ($order->total_amount-$serviceFee);
                $modelPayout->payment_model     = '1333';
                $modelPayout->userBank          = $inputData[0]; 
           $modelPayout->save();
           
//           $textSeller = "Please check your bank account. We have transferred ".number_format($order->total_amount-$serviceFee) ." EUR to ".$inputData[0].". Please send or deliver the item within 5 days. Thank you for using Peydo.";
           $textSeller = "Vi har precis betalat ut ".number_format($order->total_amount-$serviceFee) ." EUR till kontonummer ".$inputData[0].". Skicka eller leverera varan inom 5 dagar. Tack för att du använder Peydo.";
//           $textBuyer = "Congratulations! The seller has agreed to your offer. Item will be sent or delivered within 5 days. Please visit your Peydo account for invoice details. Peydo";
           $textBuyer = "Säljaren har tagit emot pengarna. Varan skickas eller levereras inom 5 dagar. Här är din faktura (peydo.com/faktura/123456). Tack för att du använder Peydo.";
         //  BeepSendSMS::sendSMS($seller->mobile_number,$textSeller);
         //  BeepSendSMS::sendSMS($buyer->mobile_number,$textBuyer);
           echo $order->id;
        }
        public function actionitemSold() {
            $this->renderPartial('itemSold');
        }
        public function actionsendEmailPresentation() {
            $dataFromPost = explode("|",$_POST['data']);
            $textMessageToPeydo="This is contact who completed successufuly Peydo presentation:<br><br><strong>".$dataFromPost[0]."</strong>";
            $textMessageToUser="To whom it may concern,<br><br>Thank you for showing interest in our payment service. We will contact you as soon as possible.<br>In the meantime please gather any questions you may have regarding Peydo. <br><br>Best regards <br>Team Peydo";
            SendMail::mailsend("oste@peydo.com", Yii::app()->params['adminEmail'],"Contact from Peydo presentation",$textMessageToPeydo,Null ,"pero");
            SendMail::mailsend($dataFromPost[0], Yii::app()->params['adminEmail'],"Contact from Peydo presentation",$textMessageToUser,Null , "Miki");
            echo "1";
        }
        public function actionsendEmailSignUp() {
            $dataFromPost = explode("|",$_POST['data']);
            switch ($dataFromPost[1]) {
            case 'en':
                $message="1";
                $textMessageToPeydo="This is contact who clicked for Sign Up :<br><br><strong>".$dataFromPost[0]."</strong><br><br>Message:<br><i>".$dataFromPost[2];
                $textMessageToUser="To whom it may concern,<br><br>Thank you for showing interest in our payment service. We will contact you as soon as possible.<br>In the meantime please gather any questions you may have regarding Peydo. <br><br>Best regards <br>Team Peydo";
                break;
             case 'sv':
                $message="2";
                $textMessageToPeydo="This is contact who clicked for Sign Up :<br><br><strong>".$dataFromPost[0]."</strong><br><br>Message:<br><i>".$dataFromPost[2];
                $textMessageToUser="Till den det berör, <br> Tack för att du visar intresse för vår betaltjänst. Vi kontaktar dig så fort som möjligt. <br> Under tiden ber vi samla alla frågor du har angående Peydo. <br> Vänliga hälsningar <br> Team Peydo ";
                break;
             case 'hr':
                $message="3";
                $textMessageToPeydo="This is contact who clicked for Sign Up :<br><br><strong>".$dataFromPost[0]."</strong><br><br>Message:<br><i>".$dataFromPost[2];
                $textMessageToUser="Poštovani, <br> Hvala vam pokazali zanimanje za našu uslugu. Mi ćemo vam se javiti u najkraćem mogućem roku. <br> U međuvremenu molimo vas budite slobodni postaviti pitanja koja možete imati u vezi Peydo. <br> Srdačan pozdrav <br> Team Peydo ";
                break;
            default:
                $message="1";
                $textMessageToPeydo="This is contact who clicked for Sign Up :<br><br><strong>".$dataFromPost[0]."</strong><br><br>Message:<br><i>".$dataFromPost[2];
                $textMessageToUser="To whom it may concern,<br><br>Thank you for showing interest in our payment service. We will contact you as soon as possible.<br>In the meantime please gather any questions you may have regarding Peydo. <br><br>Best regards <br>Team Peydo";
                break;
            }
             echo $message;
            SendMail::mailsend("djpero.84@gmail.com", Yii::app()->params['adminEmail'],"Contact from Peydo frontend",$textMessageToPeydo,Null ,"pero");
            SendMail::mailsend($dataFromPost[0], Yii::app()->params['adminEmail'],"Contact from Peydo",$textMessageToUser,Null , "Miki");
        }
        public function actionscrapeToCheckout() {
            $inputLink = $_COOKIE['scrapeUrl'];
            Yii::import('ext.scrape.SimpleHTMLDOM');
            $simpleHTML = new SimpleHTMLDOM;
            $html = $simpleHTML->file_get_html($inputLink);
            
            $elements['price'] = $html->find("//*[@id=biddingSection]/div[1]/div/div[1]/div/div[1]/span[2]",0)->plaintext;
            print_r($elements['price'] );
            $elements['price'] = $elements['price']*1;
            $elements['title'] = $html->find("//*[@id=vip]/h1",0)->plaintext;
            $elements['article_id'] = $html->find("//*[@id=vip]/div[2]/div[1]/div[2]",0)->plaintext; // ovaj string treba razbiti
            $articleIdExplode_STEP_1= explode("|", $elements['article_id']);
            $articleIdExplode_STEP_2= explode(":", $articleIdExplode_STEP_1[1]);
            $elements['article_id']=trim($articleIdExplode_STEP_2[1]);
            $elements['image'] = $html->find("//*[@id=mainimage]/img",0);
            $elements['seller'] = $html->find("//*[@id=sellerName]/b",0)->plaintext;
            $elements['seller_link'] = $html->find("//*[@id=SellerShopLink]",0)->href;
            $imageLink = $elements['image']->src;
            
            $image = str_replace("/", "|", $imageLink);
            $this->redirect('/site/newCheckout/option/0/marketplace/1/title/'.$elements['title'].'/article/'.$elements['article_id'].'/seller/'.$elements['seller'].'/price/0/email/'.$elements['seller_link'].'/mobile/0x0/img/'.$image);
        }
        public function actioncheckOrderByMobileAndPin() {
            $dataFromPost=explode("|",$_POST['data']);
            $order = OrdersDao::checkOrderByMobileAndPin($dataFromPost[0],$dataFromPost[1]);
            echo $order->id;
        }
        public function actionphoneTest() {
          $mobile = $_POST['data'];
          $retVal = phoneCheck::check($mobile);
          echo $retVal;
        }
        public function actionphoneCheck() {
            $this->renderPartial("phoneCheck");
        }
        public function actionuserRegFromPhoneCheck() {
            $dataFromPost = explode(",", $_POST['data']);

            $user = new Users;
                $user->name                     = $dataFromPost[0];
                $user->surname                  = $dataFromPost[1];
                $user->gender                   = $dataFromPost[4];
                $user->personal_number          = $dataFromPost[3];
                $user->mobile_number            = '0046'.$dataFromPost[2];
                $user->birthday                 = $dataFromPost[10];
                $user->individual_id            = $dataFromPost[11];
                $user->ip_address               = Yii::app()->request->userHostAddress;
                $user->userType_id              = '3';  
                $user->status                   = 1;
                $user->creditLimit_reserved     = '3000';
                
                $user->email            = strtolower($dataFromPost[0].'@'.$dataFromPost[1].'.com');
                $user->password         = sha1('a');
            $user->save();

            $userAddress = new UserAddress;
                $userAddress->active        = '1';
                $userAddress->primary       = '1';
                $userAddress->user_id       = $user->id;
                $userAddress->address_type  = '0';
                $userAddress->street        = $dataFromPost[5];    
                $userAddress->post_code     = $dataFromPost[7];  
                $userAddress->country_id    = '216';    
                $userAddress->city          = $dataFromPost[6];
                $userAddress->xcoord        = $dataFromPost[8];
                $userAddress->ycoord        = $dataFromPost[9];
            $userAddress->save();
            
        }
        public function actioncheckSellerNickName() {
            $dataFromPost=$_POST['data'];
            $nick = UsersDao::getUserByNickName($dataFromPost);
            echo $nick->mobile_number;
        }
        public function actioninsertPayment() {
           $modelPayout= new Payouts;
                $modelPayout->user_id           = '138';
                $modelPayout->user_verified     = '2';
                $modelPayout->order_id          = '789';
                $modelPayout->status_id         = 1;
                $modelPayout->payment_reference = 'SV01';
                $modelPayout->amount            = '1000';
                $modelPayout->payment_model     = '1333';
           $modelPayout->save();
           echo $modelPayout->id;
           
        }
        
        public function actionScrapeAll() {
            $inputLink = $_POST['data'];
            //$inputLink = "http://mobil.blocket.se/arvidsjaur/Summit_800__09_52222969.htm?ca=1_2&w=0";
            Yii::import('ext.scrape.SimpleHTMLDOM');
            Yii::import('ext.ocr.ocr');
            $simpleHTML = new SimpleHTMLDOM;
            $html = $simpleHTML->file_get_html($inputLink);
            
            $marketTraderaMobile = strpos($inputLink,"m.tradera.com");
            $marketTradera = strpos($inputLink,"tradera.com");
            $marketBlocketMobile = strpos($inputLink,"mobil.blocket.se");
            $marketBlocket = strpos($inputLink,"blocket.se");
            $marketCitiboard = strpos($inputLink, "citiboard.se");
            
            if($marketTraderaMobile) {
                // - - - - - - - - - - - - - - - - -  TRADERA MOBILE - - - - - - - - - - - - - - - - - - - -
                $elements['title']      = $html->find("header[@class='view-item-details-header']",0)->plaintext;
                $elements['img1']       = $html->find("img[@class='product-image']",0)->src;
                $elements['img']        = 'http:'.$elements['img1'];
                $elementsSellerTemp     = $html->find("span[@data-toggle='SellerDetails']",0)->plaintext;
                $elementsSellerTemp1    = explode("(", $elementsSellerTemp);
                $elements['seller']     = trim($elementsSellerTemp1[0]);
                $linkTemp = explode("/", $inputLink);
                $elements['article_id'] = $linkTemp[5];
                $elements['marketplace']= 1;
                $priceTemp = $html->find("h2[@class='view-item-price']",0)->plaintext;
                $priceTemp1 = explode(" ",trim($priceTemp));
                $elements['price'] = $priceTemp1[0];
                $tempShip = $html->find("/html/body/div[1]/div/div/section/section/div/div[2]/article/section/ul/li[2]/dl/dd/ul/li']",0)->plaintext;
                $tempShip1 = explode(" ", trim($tempShip));
                $elements['shipping'] = $tempShip1[1];
                //-------------------------------------------------------------------------------------------
            } else {
                if($marketTradera) {
                    $elements['article_id'] = $html->find("//html/body/div[1]/div[2]/section/section/div[1]/section[2]/ol/li[2]",0)->plaintext; // ovaj string treba razbiti
                    if($elements['article_id'] !='') {
                        //$articleIdExplode_STEP_1= explode("|", $elements['article_id']);
                        $articleIdExplode_STEP_2= explode(":", $elements['article_id']);
                        $elements['article_id']=trim($articleIdExplode_STEP_2[1]);
                    } else {
                        $elements['article_id']     = $html->find("//*[@id=vip]/div[5]/div[1]/div[2]",0)->plaintext; // ovaj string treba razbiti
                        $articleIdExplode_STEP_1    = explode("|", $elements['article_id']);
                        $articleIdExplode_STEP_2    = explode(":", $articleIdExplode_STEP_1[1]);
                        $elements['article_id']     = trim($articleIdExplode_STEP_2[1]);
                        $priceTemp                  = $html->find("//*[@id='leadingBidAmount']",0)->plaintext;
                        $priceTemp1                 = explode(" ", $priceTemp);
                        $elements['price']          = trim($priceTemp1[0]);
                        if (strlen($elements['price'])==0) {
                              $priceTemp                  = $html->find("//*[@id='biddingSection']/div[1]/div/div[1]/div/div[1]/span[2]",0)->plaintext;
                              $priceTemp1                 = explode(" ", $priceTemp);
                              $elements['price']          = trim($priceTemp1[0]);
                        }
                        $shipValue                  = $html->find("//*[@id=biddingSection]/div[5]/table[2]/tbody/tr/td[2]/span/b",0)->plaintext;
                        $shipValue1                 = explode(" ", $shipValue);
                        $elements['shipping']       = trim($shipValue1[0]);
                        if (strlen($elements['shipping']) ==0) {
                            $shipValue                  = $html->find("//*[@id='biddingSection']/div[1]/table[1]/tbody/tr[2]/td[2]/span/b",0)->plaintext;
                            $shipValue1                 = explode(" ", $shipValue);
                            $elements['shipping']       = trim($shipValue1[0]);
                            if (strlen($elements['shipping']) ==0) {
                                $shipValue                  = $html->find("//*[@id='biddingSection']/div[5]/table[3]/tbody/tr/td[2]/span/b",0)->plaintext;
                                $shipValue1                 = explode(" ", $shipValue);
                                $elements['shipping']       = trim($shipValue1[0]); 
                            }
                        }
                    }
                    
                    
                    // - - - - - - - - - - - - - - - - -  TRADERA - - - - - - - - - - - - - - - - - - - -
                    $elements['title'] = $html->find("/html/body/div[1]/div[2]/section/section/div[1]/div[2]/article/header/h1",0)->plaintext;
                    $elements['seller'] = $html->find("/html/body/div[1]/div[2]/section/section/div[1]/div[2]/article/section[2]/ul/li[5]/dl/dd/span[1]/a[1]",0)->plaintext;
                    $elements['img'] = 'http:'.$html->find("img[@class='product-image']",0)->src;
                    $elements['marketplace']=1;
                    //------------------------------------------------------------------------------------
                    
                }
                
            }
            
            if($marketBlocketMobile) {
                // - - - - - - - - - - - - - - - - -  BLOCKET MOBILE - - - - - - - - - - - - - - - - - - - -
                $elements['title'] = $html->find("h2[@class='item_subject']",0)->plaintext;
                $elementsSellerTemp= $html->find("div[@class='item_header']",0)->plaintext;
                $elementsSellerTemp1 = explode(".", $elementsSellerTemp);
                $elements['seller'] = trim($elementsSellerTemp1[0]);
                $elements['img'] = $html->find("//*[@id='main_content']/div[3]/div[1]/div/ul/li/img",0)->src;
                $tempLink = $html->find("input[@id='list_id']",0)->value;
                $elements['article_id']=$tempLink;
                //-------------------------------------------------------------------------------------------
                $elements['marketplace']="2";
            } else {
                if ($marketBlocket) {
                    $elements['title'] = $html->find("//*[@id='view_header']/div[1]/h2",0)->plaintext;
                    if (strlen($elements['title'])==0) {
                        $elements['title'] = $html->find("//*[@id='view_header_broker']/div[1]/h2",0)->plaintext;
                    }
                    $elementsSeller = $html->find("div[@class='header_bar']",0)->plaintext;
                    preg_match("/av(.*)/", $elementsSeller, $results);
                    $tempSeller1 = explode(".", $results[1]);
                    $tempSeller = explode(",",$tempSeller1[0]);
                    $elements['seller'] = trim($tempSeller[0]);
                    $elements['img'] = $html->find("//*[@id='main_image']",0)->src;
                    $tempLink = $html->find("a[@id='contact_link']",0)->href;
                    $tempLink2 = explode("/",$tempLink);
                    $tempLink3 = explode("=",$tempLink2[4]);
                    $elements['article_id']=$tempLink3[1];
                    $elements['phoneTEMP'] = $html->find("//*[@class='phone_gif']",0)->src;
                    $elements['mobile'] = $elements['phoneTEMP'];
        
                     $elements['marketplace']="2";
                }
               
            }
           
            if($marketCitiboard) {
                // - - - - - - - - - - - - - - - - -  CITIBOARD - - - - - - - - - - - - - - - - - - - -
                $elements['title'] = $html->find("h1[@class='title']",0)->plaintext;
                $elements['seller'] = $html->find("strong[@class='name']",0)->plaintext;
                $elements['img'] = $html->find("img[@id='fsGallery']",0)->src;
                $tempLink = explode(",",$inputLink);
                $elements['article_id'] = $tempLink[1];
                $elements['mobile'] = $html->find("//*[@id='boardItem-1418467']/div[1]/section/div/p",0)->plaintext;
                //-------------------------------------------------------------------------------------------
                $elements['marketplace']="3";
            }
            
            $sessionText = $elements['title']."|".$elements['seller']."|".$elements['img']."|".
                           $elements['article_id']."|".$elements['mobile']."|".$elements['marketplace']."|".
                           $elements['price']."|".$elements['shipping'];
            Yii::app()->session['scrapeData'] =  $sessionText;
            Yii::app()->session['scrapeURL'] =  $inputLink;
            if ($elements['article_id']<> "") {
                // ovdje snimamo sve pokusaje bez da je kupljeno!!!! SNIMANJE U HTML I SNIMANJE U PNG PODSREDSTVOM page2image SERVISA
                $html->save('protected/documents/html/'.$elements['marketplace'].$elements['article_id'].'.html');
                p2i::call_p2i($inputLink,$elements['marketplace'].$elements['article_id']);
                echo "redirect:/site/checkout";
                //echo $sessionText;
                //echo $elements['article_id'];
            } else {
                echo "error:Invalid Url. No article found";
            }
            
        }
        public function actioncheckPhoneReturn() {
            $phoneNumberTemp = $_POST['data'];
            $phoneNumber = "0046".$phoneNumberTemp;
                
                $pinCode=$this->RandomCode(4);
                $textMessage="Din verifieringskod för Qlirr är ".$pinCode;
                BeepSendSMS::sendSMS($phoneNumber, $textMessage); // ujedno upisuje u sms log zadnji sms
                $modelSmsTemp= new SmscodeTemp;
                $modelSmsTemp->mobile_number        = $phoneNumber;
                $modelSmsTemp->order_reference      = $phoneNumber;
                $modelSmsTemp->sms_code             = $pinCode;       
                $modelSmsTemp->save();
                echo "4digit";
 
            
            
        }
        
        public function actioncheckPhonePinReturn() { // SELLER PART
           $dataFromPost= explode("|", $_POST['data']);
           $phoneNumber = "0046".$dataFromPost[0];
           $orders = SmsCodeTempDao::checkUserByMobileAndPin($phoneNumber,$dataFromPost[1]);
           if (count($orders)==0) {
               echo "#error:Du har angett felaktig sms kod. Vänligen försök igen.";
           } else {
               $user=UsersDao::getUserByMobile($phoneNumber);
               if (count($user)==0) {
                   $userSSN = UserCheckDao::getElementByPhone('SSNo','0'.$dataFromPost[0]); // provjera u Teleaddress za SSN broj
                   if($userSSN=='') {
                       echo '#startInstantor';
                   } else { // provjera dalje SSN-a u potrazi za Credit Desicion ! ! ! !  - nismo jos dobili to!
                       echo '#ssn:'.$userSSN;
                   }
               } else {
                   $userSSN = UserCheckDao::getElementByPhone('SSNo','0'.$dataFromPost[0]); // provjera u Teleaddress za SSN broj
                   if ($user->verification==1) {
                       echo '#id:'.$user->id;
                   } else {
                       $testUser = $this->verifyUser($userSSN, $phoneNumber );
                       if ($testUser=='#notverified') { 
                            echo '#redirect:'.'/site/msg';
                       } else {
                           echo '#id:'.$testUser;
                       }
                   }
               }
           }
        }

        
        public function actioncheckUserByMobilePin() {
           $dataFromPost= explode("|", $_POST['data']);
           $phoneNumber = "0046".$dataFromPost[0];
           $pinConfirm = SmsCodeTempDao::checkUserByMobileAndPin($phoneNumber,$dataFromPost[1]);
           if (count($pinConfirm)==0) {
               echo "#error:Du har angett felaktig sms kod. Vänligen försök igen.";
           } else {
               $user=UsersDao::getUserByMobile($phoneNumber);
               if (count($user)==0) {
                   $userSSN = UserCheckDao::getElementByPhone('SSNo','0'.$dataFromPost[0]); // provjera u Teleaddress za SSN broj
                   
                   if($userSSN=='') {
                       //echo '#startInstantor'; // --------------------------->>>>>> AKO IKAD BUDEM HTIO UPALITI PROVJERU INSTANTOR <<<<<<
                       echo '#enterSSN';
                   } else { // provjera dalje SSN-a u potrazi za Credit Desicion ! ! ! !  - nismo jos dobili to!
//                       $user->verification_document = 4;
//                       $user->update(array('verification_document'));
                       echo '#ssn:'.$userSSN;
                   }
               } else {
                   $userSSN = UserCheckDao::getElementByPhone('SSNo','0'.$dataFromPost[0]); // provjera u Teleaddress za SSN broj
                   if ($user->verification==1) {
                       echo '#id:'.$user->id;
                   } else {
                       $testUser = $this->verifyUser($userSSN, $phoneNumber);
                       if ($testUser=='#notverified|ok') { 
                            echo '#error2:'.'USER NOT VERIFIED FOR BUYING!';
                       } else {
                           echo '#id:'.$testUser;
                       }
                   }
               }
           }
        }
        public function actionurl() {
            $tempUserID = Yii::app()->session['userID'];
            $tempUserM  = Yii::app()->session['userIDm'];
            $tempUserP  = Yii::app()->session['userIDp'];
                $pinExist = SmsCodeTempDao::checkUserByMobileAndPin($tempUserM,$tempUserP);
                if (strlen($tempUserP) > 0) {
                    if ($pinExist->sms_code == $tempUserP) {
                        $this->renderPartial('/site/url');
                    } else {
                      $this->redirect('http://klirrr.com');
                    }
                } else {
                    $this->redirect('http://klirrr.com');
                }

        }
        public function actioncheckout() {
            $tempUserID = Yii::app()->session['userID'];
            $tempUserM  = Yii::app()->session['userIDm'];
            $tempUserP  = Yii::app()->session['userIDp'];
                $pinExist = SmsCodeTempDao::checkUserByMobileAndPin($tempUserM,$tempUserP);
                if (strlen($tempUserP) > 0) {
                    if ($pinExist->sms_code == $tempUserP) {
                      $this->renderPartial('/site/checkout');
                    } else {
                      $this->redirect('http://klirrr.com');
                    }
                } else {
                    $this->redirect('http://klirrr.com');
                }
        }
        public function actionstartUserSession() {
            $inputDataPost=explode("|",$_POST['data']);
            Yii::app()->session['userID']  = $inputDataPost[0];
            Yii::app()->session['userIDm'] = $inputDataPost[1];
            Yii::app()->session['userIDp'] = $inputDataPost[2];
            $type  = $inputDataPost[3];
            if ($type=='b') {
               echo "redirect:/site/checkout";
            } else {
               $orders = OrdersDao::getAllOrdersBySellerMobile($inputDataPost[1]);
               if (count($orders)==1) {
                   echo "redirect:/site/offer/id/".$orders[0]->id;
               } else {
                   echo "redirect:/site/offersList/id/".$inputDataPost[1]; 
               }
            }         
            
        }
        public function actionsreceipt() {
            $tempUserID = Yii::app()->session['userID'];
            $tempUserM  = Yii::app()->session['userIDm'];
            $tempUserP  = Yii::app()->session['userIDp'];
            $pinExist = SmsCodeTempDao::checkUserByMobileAndPin($tempUserM,$tempUserP);
                if (strlen($tempUserP) > 0) {
                    if ($pinExist->sms_code == $tempUserP) {
                       //echo $pinExist->sms_code; 
//                        $pinExist->active = 0;
//                        $pinExist->update(array('active'));
                      $this->renderPartial('/site/sreceipt');
                    } else {
                      $this->redirect('http://klirrr.com');
                    }
                } else {
                    $this->redirect('http://klirrr.com');
                }
                
        }
        public function actioncreceipt() {
                       
            $tempUserID = Yii::app()->session['userID'];
            $tempUserM  = Yii::app()->session['userIDm'];
            $tempUserP  = Yii::app()->session['userIDp'];

            $pinExist = SmsCodeTempDao::checkUserByMobileAndPin($tempUserM,$tempUserP);

                if (strlen($tempUserP) > 0) {
                    if ($pinExist->sms_code == $tempUserP) {
                      $this->renderPartial('/site/creceipt');
                    } else {
                      $this->redirect('http://klirrr.com');
                    }
                } else {
                    $this->redirect('http://klirrr.com');
                }

        }
        public function actionexchangeClearPrice() {
            $dataFromPost = $_POST['data'];
            if($dataFromPost !=0) {
            $fee=ServiceFeesDao::FindServiceFeeByPrice($dataFromPost,3);
                if($fee->fixed==0){
                    $totalTotal=$dataFromPost+(($dataFromPost*$fee->percentage)/100);
                } else {
                    $totalTotal=$dataFromPost+$fee->fixed;
                }
            } else {
                $totalTotal=0;
            }
            $sTotal = (string) number_format(round($totalTotal),2);
            echo str_replace(',',' ',$sTotal);
        }
        public function actioncheckoutSaveOrder() {
            $dataFromPost = explode("|", $_POST['data']);
            $buyer        = UsersDao::getUserById($dataFromPost[2]);
            $shop         = ShopsDao::validateCID($dataFromPost[1]);
            
            if(count($shop)==0) {
                echo '#error|noshop';
                die();
            }
            
            $totalTotalTemp  = $dataFromPost[0];
            $fee             = ServiceFeesDao::FindServiceFeeByPrice($totalTotalTemp,3);
            if ($fee->fixed==0) {
                $totalTotal  = $totalTotalTemp+(($totalTotalTemp*$fee->percentage)/100);
                $feeAmount   = ($totalTotalTemp*$fee->percentage)/100;
            } else {
                $totalTotal  = $totalTotalTemp+$fee->fixed;
                $feeAmount   = $fee->fixed;
            }
            
           
            if ($dataFromPost[0]>500) {
               echo "#error|over500"; 
            } else {
                if ($dataFromPost[0]>$buyer->creditLimit_remaining) {
                    echo "#error|creditlow";
                } else {
                    //--------------------- snimanje ordera -------------------
                    $modelOrder = new Orders;
                        $modelOrder->seller_id          = $shop->id;     
                        $modelOrder->buyer_id           = $buyer->id; 
                        $modelOrder->service_id         = 3;
                        $modelOrder->orderStatus_id     = 1;

                        $modelOrder->active             = 1;
                        $modelOrder->notify             = 0;
                        $modelOrder->pay_percent        = 0;
                        $modelOrder->total_amount       = $totalTotal;
                        $modelOrder->fee                = $feeAmount;
                        $modelOrder->min_price          = 0;
                        $modelOrder->price              = $totalTotalTemp;
                        $modelOrder->code               = GeneralFunctions::randomCode(2, 't').GeneralFunctions::randomCode(4, 'n');
                        $modelOrder->ip_address         = Yii::app()->request->userHostAddress;
                    $modelOrder->save();
                    
                    $buyer->creditLimit_reserved  = $buyer->creditLimit_reserved + ($totalTotalTemp);
                    $buyer->creditLimit_remaining = $buyer->credit_limit - ($buyer->creditLimit_reserved + $buyer->creditLimit_expends);
                    $buyer->update(array('creditLimit_reserved','creditLimit_remaining'));
                    Yii::app()->session['code'] = $modelOrder->code;
                    Yii::app()->session['order'] = $modelOrder->id;
                    Yii::app()->session['shop'] = $shop->id;
                    echo "#ok|receipt";
                }
                
            }
            
            
        }
        public function actionoffer() {
            $orderID = $_GET['id'];

            $tempUserID = Yii::app()->session['userID'];
            $tempUserM  = Yii::app()->session['userIDm'];
            $tempUserP  = Yii::app()->session['userIDp'];

            if (isset(Yii::app()->session['userID'])) {
                
              $order = SmsCodeTempDao::checkUserByMobileAndPin($tempUserM,$tempUserP);
              
              if (count($order)>0) {
                  $seller=UsersDao::getUserByMobile($tempUserM);
                  $modelOrder = OrdersDao::getOrderData($orderID);
                  $modelOrder->seller_id=$seller->id;
                  $modelOrder->update(array('seller_id'));
                  $this->renderPartial('offer');
              } else {
                  $this->redirect('http://klirrr.com');
              }
            } else {
                  $this->redirect('http://klirrr.com');
            }
        }
        public function actionenterIBAN() {
            
            $dataFromPost           = explode("|", $_POST['data']);
            $modelOrder             = OrdersDao::getOrderData($dataFromPost[0]);
            $tempPayReferenceCode   = substr(date("Y"),-2).'-'.$modelOrder->id.'-'.$this->RandomCode(4);
            $seller                 = UsersDao::getUserById($modelOrder->seller_id);
            $date_due               = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'dateDueExtensionDays'));
            $date_due_value         = new DateTime($modelOrder->date_accepted);
            $date_due_value->modify("+".$date_due->setting_value." days"); 
            $date_due_valueTemp     = $date_due_value->format("Y-m-d H:i:s"); 
            
            if (($modelOrder->price) <= $seller->credit_limit_s_remaining) {
                $modelOrder->orderStatus_id         = 2;
                $modelOrder->date_accepted          = date("Y-m-d H:i:s");
                $modelOrder->payment_reference      = $tempPayReferenceCode;
                $modelOrder->orderStatusF_id        = 0;
                $modelOrder->date_due               = $date_due_valueTemp;
                $modelOrder->date_due_ext           = $date_due_valueTemp;
                $modelOrder->update(array('orderStatus_id', 'date_accepted', 'payment_reference', 'orderStatusF_id', 'date_due', 'date_due_ext'));
                
                $totalAmount = $modelOrder->price;

                $totalPayoutFee = ServiceFeesDao::FindServiceFeeByPrice($totalAmount,4);
                if($totalPayoutFee->fixed==0){
                    $totalTotal=$totalAmount-(($totalAmount*$totalPayoutFee->percentage)/100);
                } else {
                    $totalTotal=$totalAmount-$totalPayoutFee->fixed;
                }       

                // povecaj kupovni limit za kupca  
                $modelBuyer = UsersDao::getUserByID($modelOrder->buyer_id);
                $modelBuyer->creditLimit_reserved = $modelBuyer->creditLimit_reserved - ($modelOrder->price);
                $modelBuyer->creditLimit_expends  = $modelBuyer->creditLimit_expends  + ($modelOrder->price);
                $modelBuyer->update(array('creditLimit_reserved', 'creditLimit_expends'));
                
                // smanji prodajni limit sa prodavca 
                $seller->credit_limit_s_expends   = $seller->credit_limit_s_expends   + ($modelOrder->price);
                $seller->credit_limit_s_remaining = $seller->credit_limit_s_remaining - ($modelOrder->price);
                $seller->update(array('credit_limit_s_expends', 'credit_limit_s_remaining'));
                
                
                // u user_verified treba provjeriti sadasnje stanje credit limit za sellera i upisati shodno tome koji tip isplate je u pitanju
                // da li odmah ili nakon sto je kupac uplatio

                $modelPayout= new Payouts;
                    $modelPayout->user_id           = $modelOrder->seller_id;
                    $modelPayout->user_verified     = '2';
                    $modelPayout->order_id          = $modelOrder->id;
                    $modelPayout->status_id         = 1;
                    $modelPayout->userBank          = $dataFromPost[1];
                    $modelPayout->amount            = round($totalTotal);
                    $modelPayout->payment_model     = '1333';
                    $modelPayout->payment_reference = $tempPayReferenceCode;
                $modelPayout->save();
                // ================= ovdje salji smsove i pdf ==============================
                // PREBACENO U DEFAULTCONTROLLER NAKON UNOSA UPLATE
                
                    $emailMSG = '<b>Offer</b><br>'
                                 . 'ID: '.$modelOrder->id.'<br>'
                                 . 'Seller: '.$seller->id.' - '.$seller->name. ' '.$seller->surname.'<br>'
                                 . 'Buyer: '.$modelBuyer->id.' - '.$modelBuyer->name. ' '.$modelBuyer->surname.'<br>'
                                 . 'Amount: '.$modelOrder->total_amount;
                    SendMail::mailsend('support@peydo.com', "backend@peydo.com","Backend: Order Approved #".$modelOrder->id,$emailMSG,Null,Null);
                echo $modelOrder->id;
            } else {
                $errorLimit = "Du har ".$seller->credit_limit_s_remaining." kr kvar att sälja för! Så snart dina sålda varor är anses godkända höjs din gräns.";
                echo "#error|".$errorLimit;
            }
                
        }
        
        
        public function actionsaveAddress() {
            $dataFromPost = explode("|", $_POST['data']);
            $buyer = UsersDao::getUserById($dataFromPost[0]);
            
            Yii::app()->db->createCommand('update user_address set address_type=1 where user_id='.$dataFromPost[0])->query();
            
            $modelAddress = new UserAddress;
            $modelAddress->active       = 1;
            $modelAddress->primary      = 1;
            $modelAddress->address_type = 0;
            $modelAddress->user_id      = $dataFromPost[0];
            $modelAddress->street       = $dataFromPost[1];
            $modelAddress->post_code    = $dataFromPost[2];
            $modelAddress->city         = $dataFromPost[3];
            $modelAddress->country_id   = 216;
            $modelAddress->save();
            
            $country = CountryDao::getCountryValueById($modelAddress->country_id);
            
            $postcode1 = substr($modelAddress->post_code, 0, 3);
            $postcode2 = substr($modelAddress->post_code,3,4);
            $postCode  = $postcode1.' '.$postcode2;
            
            echo '<strong>Din vara skickas till</strong>'.$buyer->name.' '.$buyer->surname.'<br>'.$modelAddress->street.'<br>'.$postCode.' '.$modelAddress->city;
        }
        public function actioncancelOffer() {
            $dataFromPost = $_POST['data'];
            $modelOrder = OrdersDao::getOrderData($dataFromPost);
            $modelOrder->orderStatus_id=3;
            $modelOrder->active=0;
            $modelOrder->update(array('orderStatus_id', 'active'));
            
            $buyer=UsersDao::getUserById($modelOrder->buyer_id);
            
            $buyer->creditLimit_reserved  = $buyer->creditLimit_reserved  - ($modelOrder->total_amount - $modelOrder->fee);
            $buyer->creditLimit_remaining = $buyer->creditLimit_remaining + ($modelOrder->total_amount - $modelOrder->fee);
            $buyer->update(array('creditLimit_reserved', 'creditLimit_remaining'));
            
            $buyerName       = $this->limitString($buyer->name, 12);  
            $article_name    = $this->limitString($modelOrder->article_name, 15);
            $textBuyer       = "Hej ".$buyerName."! Säljaren har valt att avbryta försäljningen av ".$article_name.". Självklart betalar du ingenting. Försök igen med någon annan vara. Lycka till!";
            BeepSendSMS::sendSMS($buyer->mobile_number,$textBuyer);
            
            echo $modelOrder->id;
        }

      
      public function actioncheckBisGateway() {
            $dataFromPost = explode("|",$_POST['data']);
//            $dataFromPost = explode("|", '197501231612|0046722940514');
            echo $this->verifyUser($dataFromPost[0], $dataFromPost[1]);
      }
      public function verifyUser($ssn, $mobile) {
   
            $probabilityCode        = UserCheckDao::getElementBySsn('scoreApplicant', $ssn);
            $incomeOfEmployment     = UserCheckDao::getElementBySsn('grossTaxEarnedInc', $ssn);
             // ovdje treba ako vrati prazan kod da se izvaci da nije verifikovan
            $proc                   = BisGateCodeDao::getPercentByProbabilityCode($probabilityCode);
            $minProcApp             = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'bisGateMinProc'));
            $minIncomeEmployment    = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'bisGateMinIncome'));
            
            $creditLimit            =  ApplicationSettings::model()->findByAttributes(array('setting_name' => 'newUserCreditLimit'));

            $userNAMEtemp = UserCheckDao::getElementBySsn('consumerName', $ssn);
            
            if($this->purifyName($userNAMEtemp)==false) {
                $firstNameTemp = UserCheckDao::getElementBySsn('firstName', $ssn);
                $firstName = $firstNameTemp;
            } else {
                $firstName = $this->purifyName($userNAMEtemp);
            }
            
            $check = UsersDao::getUserBySSN($ssn);
            
           $userid = $check->id;
           // $userIBAN = InstantorXmlDao::getInstantorDataBySsn($ssn);
            
            if (count($check)==0) {
                $modelUser = new Users;
                   $modelUser->name                    = $firstName;
                   $modelUser->surname                 = UserCheckDao::getElementBySsn('surname', $ssn);
                   $modelUser->fullname                = UserCheckDao::getElementBySsn('firstName', $ssn);
                   $modelUser->mobile_number           = $mobile;
                   $modelUser->userType_id             = 3;
                   $modelUser->verification            = 0;
                   $modelUser->country_id              = 216;
                   $modelUser->personal_number         = $ssn;
                   $modelUser->ip_address              = Yii::app()->request->userHostAddress;
//                   $modelUser->iban                    = '0000';
                $modelUser->save(); 
                
                $addressCheck = UserAddressDao::getPrimaryAddressByTypeAndUserId($modelUser->id, 0);
                $userid = $modelUser->id;
                if (count($addressCheck)==0) {
                    // billing address
                    $modelAddress = new UserAddress;
                    $modelAddress->active       = 1;
                    $modelAddress->primary      = 1;
                    $modelAddress->address_type = 0;
                    $modelAddress->user_id      = $modelUser->id;
                    $modelAddress->street       = UserCheckDao::getElementBySsn('postalAddressLine1', $ssn);
                    $modelAddress->post_code    = UserCheckDao::getElementBySsn('postCodeNational', $ssn);
                    $modelAddress->city         = ucfirst(strtolower(UserCheckDao::getElementBySsn('town', $ssn)));
                    $modelAddress->country_id   = 216;
                    $modelAddress->save();
                    
                    // shipping address
                    $modelAddress = new UserAddress;
                    $modelAddress->active       = 1;
                    $modelAddress->primary      = 1;
                    $modelAddress->address_type = 1;
                    $modelAddress->user_id      = $modelUser->id;
                    $modelAddress->street       = UserCheckDao::getElementBySsn('postalAddressLine1', $ssn);
                    $modelAddress->post_code    = UserCheckDao::getElementBySsn('postCodeNational', $ssn);
                    $modelAddress->city         = ucfirst(strtolower(UserCheckDao::getElementBySsn('town', $ssn)));
                    $modelAddress->country_id   = 216;
                    $modelAddress->save();
                }
                    $emailMSG = '<b>User</b><br>'
                            . 'ID: '.$modelUser->id.'<br>'
                            . 'Name: '.$modelUser->name. ' '.$modelUser->surname.'<br>'
                            . 'Mobile: '.$modelUser->mobile_number.'<br>';
                    SendMail::mailsend('support@peydo.com', "support@peydo.com","Backend: New User #".$modelUser->id,$emailMSG,Null,Null);
                
            }    
            if((int)$incomeOfEmployment<$minIncomeEmployment->setting_value) {
               
                return '#notverified|ok';
            }

            if ($proc->result<$minProcApp->setting_value) {
                
                // ovdje treba unijeti odnosno prepraviti korisnika Verificartion i unosim limit
                
                $modelUserUpdate                            = UsersDao::getUserById($userid);
                $modelUserUpdate->credit_limit              = $creditLimit->setting_value;
                $modelUserUpdate->creditLimit_remaining     = $creditLimit->setting_value;
                $modelUserUpdate->verification              = 1;
                $modelUserUpdate->update(array('credit_limit' , 'creditLimit_remaining', 'verification'));
                // check user address exist
                
                return "#verified|".$modelUser->id;
            } else {
                return '#notverified|ok';
            }
      }
      
      public function actioncheckPhone() {
          $dataFromPost = $_POST['data'];
          //$dataFromPost = '0735044955';
          $response=UserCheckDao::getElementByPhone('SSNo',$dataFromPost);
          echo $response;
            
      }
      public function actioncheckInstantor() {
          $dataFromPost = $_POST['data']; //ovdje stize broj telefona kao indentifikacija za instantor
          $response=UserCheckDao::getElementByBank($dataFromPost);
          echo $response;
          
      }
      
      public function actioncheckSSN(){
          $response = UserCheckDao::getElementBySsn('probabilityCode', '197308141634', 1);
          echo var_dump($response);
      }
      
      public function actionfrontendCalculator() {
         $valuesFromJava=explode("|", $_POST['data']);
            $fee=ServiceFeesDao::FindServiceFeeByPrice($valuesFromJava[1],3);
            if ($valuesFromJava[0]==1) {
                if($fee->fixed==0){
                    $totalTotal=$valuesFromJava[1]+(($valuesFromJava[1]*$fee->percentage)/100);
                    $fee_amount=($valuesFromJava[1]*$fee->percentage)/100;
                } else {
                    $totalTotal=$valuesFromJava[1]+$fee->fixed;
                    $fee_amount=$fee->fixed;
                }

            } elseif($valuesFromJava[0]==0) {
               $fee=ServiceFeesDao::FindServiceFeeByPrice($valuesFromJava[1],4); 
               if($fee->fixed==0){
                    $totalTotal=$valuesFromJava[1]-(($valuesFromJava[1]*$fee->percentage)/100);
                    $fee_amount=($valuesFromJava[1]*$fee->percentage)/100;
                } else {
                    $totalTotal=$valuesFromJava[1]-$fee->fixed;
                    $fee_amount=$fee->fixed;
                }
            }
            if ($valuesFromJava[1]>2000) {
                echo 'Överskridet';
            } else {
                echo number_format(round($totalTotal), 2, '.', ' ').'kr';
            }
      }
      public function actionreceipt() {
            $tempUserID = Yii::app()->session['userID'];
            $tempUserM  = Yii::app()->session['userIDm'];
            $tempUserP  = Yii::app()->session['userIDp'];

                $pinExist = SmsCodeTempDao::checkUserByMobileAndPin($tempUserM,$tempUserP);
                if (strlen($tempUserP) > 0) {
                    if ($pinExist->sms_code == $tempUserP) {
                       //echo $pinExist->sms_code; 
//                      $pinExist->active=0;
//                      $pinExist->update(array('active'));
                      $this->renderPartial('/site/receipt');
                    } else {
                      $this->redirect('http://klirrr.com');
                    }
                } else {
                    $this->redirect('http://klirrr.com');
                }
      

      }
      public function actionmakeAddressPrimary() {
          $dataFromPost = $_POST['data'];
          $modelAddress = UserAddressDao::getAddressById($dataFromPost);
          Yii::app()->db->createCommand('update user_address set primary=0 where user_id='.$modelAddress->user_id.' AND address_type=1')->query();

          $modelAddress->primary = 1;
          $modelAddress->address_type = 1;
          $modelAddress->update(array('primary', 'address_type'));
          
           $country = CountryDao::getCountryValueById($modelAddress->country_id);
            $postcode1 = substr($modelAddress->post_code, 0, 3);
            $postcode2 = substr($modelAddress->post_code,3,4);
            $postCode = $postcode1.' '.$postcode2;
            $buyer = UsersDao::getUserById($modelAddress->user_id);
            echo '<strong>Din vara skickas till</strong>'.$buyer->name.' '.$buyer->surname.'<br>'.$modelAddress->street.'<br>'.$postCode.' '.$modelAddress->city;
      }
      
      public function actionsendModalEmail() {
          $dataFromPost = explode("|",$_POST['data']);
          SendMail::mailsend('support@peydo.com', $dataFromPost[0],"Contact from Peydo frontend",$dataFromPost[1],Null,'138');
          
          $mail = new Messages;
          $mail->from    = $dataFromPost[0];
          $mail->to      = 'support@peydo.com';
          $mail->message = $dataFromPost[1];
          $mail->save();
          
          echo "ok";
      }
      public function purifyName($name) {
          //$name = 'Sonelöf, Anders *Jesper*';
          
          if (strpos($name,'*') !== false) {
              $position1 = strpos($name, '*');
              $position2 = strrpos($name, '*');
              return substr($name, $position1+1, $position2- ($position1+1));
          } else {
              return false;
          }
          
      }
      public function actionmsg() {
          $this->renderPartial('msg');
      }
      
      public function actioncancelOfferSeller() {
          $dataFromPost = explode("|", $_POST['data']);
          
          $modelOrder = OrdersDao::checkOrderByMobileAndPin($dataFromPost[0],$dataFromPost[1]);
          echo var_dump($modelOrder);
          if (count($modelOrder)>0) {

            $modelOrder->orderStatus_id = 3;
            $modelOrder->active         = 0;
            $modelOrder->update(array('orderStatus_id', 'active'));
            
            $buyer=UsersDao::getUserById($modelOrder->buyer_id);
            
            $buyer->creditLimit_reserved  = $buyer->creditLimit_reserved  - ($modelOrder->total_amount - $modelOrder->fee);
            $buyer->creditLimit_remaining = $buyer->creditLimit_remaining + ($modelOrder->total_amount - $modelOrder->fee);
            $buyer->update(array('creditLimit_reserved', 'creditLimit_remaining'));
            
            $buyerName       = $this->limitString($buyer->name, 12);  
            $article_name    = $this->limitString($modelOrder->article_name, 30);
            
            $textBuyer       = "Hej ".$buyerName."! Säljaren har valt att avbryta försäljningen av ".$article_name.". Du behöver självklart inte betala något. Försök igen med någon annan vara. Lycka till!";
            BeepSendSMS::sendSMS($buyer->mobile_number,$textBuyer);
            
          }
      }
      
        public function actiontnxpage() {
          $this->renderPartial('tnxpage');
      }
     
      public function limitString($string, $limit) {
          if (strlen($string)<=$limit) {
              return $string;
          } else {
              $temp = substr($string, 0, $limit);
              return $temp;
          }
      }
      public function actionoffersList() {
            $tempUserID = Yii::app()->session['userID'];
            $tempUserM  = Yii::app()->session['userIDm'];
            $tempUserP  = Yii::app()->session['userIDp'];

                $pinExist = SmsCodeTempDao::checkUserByMobileAndPin($tempUserM,$tempUserP);
                if (strlen($tempUserP) > 0) {
                    if ($pinExist->sms_code == $tempUserP) {
//                       echo $pinExist->sms_code; 
//                      $pinExist->active=0;
//                      $pinExist->update(array('active'));
                      $this->renderPartial('/site/offersList');
                    } else {
                      $this->redirect('http://klirrr.com');
                    }
                } else {
                    $this->redirect('http://klirrr.com');
                }
      }
      
      public function actiontest2() {
          $test = 'Weinstock, *Vilma* Sofia';
          echo $this->purifyName($test);
      }
      
      public function actionadminlogin() {
            $model=new LoginForm;
            // if it is ajax validation request
            /*if(isset($_POST['ajax']) && $_POST['ajax']==='login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
            }*/
            //pr_r($_POST['username']);
            $userLog = new UserLogs;
            // collect user input data
            if(isset($_POST['username'])) { 
                $username = trim($_POST['username']);
                $user = null;

                if($username != "") {
                    $user = UsersDao::model()->findByAttributes(array('email'=>$username, 'status' => 1));

                    if(!isset($user->email))
                        $user = UsersDao::model()->findByAttributes(array('mobile_number'=>$username, 'status' => 1));

                    //$this->status = 1;
                }

                if($user != null) {
                    $model->username = $user->email;
                    $model->password = sha1(trim($_POST['password']));
                    // validate user input and redirect to the previous page if valid

                    $user->lastVisit_at = date('Y-m-d H:i:s',time());
                    $user->save();

                    $userLog->user_id = $user->id;
                    $userLog->ip_address = Yii::app()->request->userHostAddress;

                    if($model->validate() && $model->login()) {   
                        $userLog->success = 1;
                        $userLog->save();

                        /*if($user->userType_id == 3)
                        $this->redirect(array('/customer'));
                        elseif($user->userType_id == 2)
                        $this->redirect(array('/merchant'));
                        elseif($user->userType_id == 1)
                        $this->redirect(array('/admin'));*/
                        $this->redirect("/admin/default");
                    } else {
                        $userLog->success = 0;
                        $userLog->save();

                        Yii::app()->user->setFlash('errorLogin', Yii::t('frontend', 'frontend.error.password_wrong'));
                        $this->redirect(array('/site/index'));
                    }
                } else {
                    Yii::app()->user->setFlash('errorLogin', Yii::t('frontend', 'frontend.error.password_wrong'));
                    $this->redirect(array('/site/index'));
                }
            }
      }
      
      public function actionLoginout() {
            Yii::app()->session['userIDm'] = '';
            Yii::app()->session['userIDp'] = '';
            Yii::app()->session->clear();
            $this->redirect('/');
      }
       
      
      public function actioncheckUserExist() {
          $dataFromPost = $_POST['data'];
          $mobile = substr($dataFromPost, 1);
          $user = UsersDao::getUserByMobile('0046'.$mobile);
          if (count($user)===1) {
              echo 'ok';
          } else {
              echo 'Mobilnummer';
          }
      }
      
      public function actiondemosendpin() {
          $dataFromPost = $_POST['data'];
          $mobile = substr($dataFromPost, 1);
          $pinCodeText  = "Hej! Knappa in koden: 1234, så betalar vi för din vara.";
          if (strlen($dataFromPost)===0) {
              echo 'nook';
          } elseif (strlen($dataFromPost)===10){
              BeepSendSMS::sendSms('0046'.$mobile,$pinCodeText);
              echo 'ok';
          } else {
              echo 'nook';
          }
      }
      public function actiondemosendinvoice() {
          $dataFromPost = explode("|", $_POST['data']);
          $mobile = $mobile = substr($dataFromPost[0], 1);
         $refcode = $this->generatePDF($dataFromPost[0], $dataFromPost[1], $dataFromPost[2]);
         $faktura = 'm.qlirr.com/Faktura/DE'.$refcode;
         $textBuyer  = "Hej Demo! Här är din faktura: (".$faktura."). Tack för att du använder QLIRR.";
         BeepSendSMS::sendSMS('0046'.$mobile, $textBuyer);
         
      }
      
      public function generatePDF($buyer, $amount, $curdate) {
        
           $buyerMobile             = $buyer;
           $tempPayReferenceCode    = substr(date("Y"),-2).'-9999-'.$this->RandomCode(4);
           
           
           $nextDate = new DateTime($curdate);
           $curDate2 = $nextDate->format("Y-m-d");
           $nextDate->modify("+ 14 days"); 
           $dueDate  = $nextDate->format("Y-m-d");
           if ($amount>49) {
               $totalAmount2 = ($amount );
           }
           
           $totalAmount = number_format($totalAmount2, 2,',', ' ');
           $decimal                 = explode(',', $totalAmount);
           $smarty                  = Yii::app()->viewRenderer->getSmarty();

           $smarty->assign('totalAmount',           $totalAmount);
           $smarty->assign('decimalAmount',         $decimal[1]);
           $smarty->assign('wholeAmount',           $decimal[0]);
           $smarty->assign('paymentReference',      $tempPayReferenceCode);
           $smarty->assign('curDate',               $curDate2);
           $smarty->assign('dateDue',               $dueDate);
           $smarty->assign('customerCountry',       'Sverige');
           $content     = $smarty->fetch('r1demo.tpl'); 
           $pathToPdf   = YiiBase::getPathOfAlias('webroot')."/protected/documents/pdf/agreements/demo_".$tempPayReferenceCode.".pdf";
          
           
           PdfGenerator::generatePdfTcpdf($content,true,$pathToPdf);
           return $tempPayReferenceCode;
           
        }
        public function actionTEST123() {
            $refcode = $this->generatePDF($dataFromPost[0], $dataFromPost[1], $dataFromPost[2]);
            $faktura = "Faktura: ".'http://m.klirrr.com/Faktura/DE'.$refcode;
            echo $faktura.'<br>';
            $getAppSetting = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'smsEnabled'));
            echo  $getAppSetting->setting_value;
            $textBuyer  = "Hej! Vi har betalat säljaren för den vara du köpt. Varan skickas eller lämnas över inom 5 dagar. Här är din faktura (".$faktura."). Tack för att du använder QLIRR.";
             BeepSendSMS::sendSMS('0038765015595', $textBuyer);
        }
        
        public function actiongetShopLocations() {
            $dataFromPost = explode('|',$_POST['data']);
            
            $shops = ShopAddressDao::getListByCityLatLng($dataFromPost[0], $dataFromPost[1], 55000);
     
            $x=0; 

            if (count($shops)> 0 ) {
                do {
                    $shop = ShopsDao::getShopById($shops[$x]['user_id']);
                    $logo = FilesDao::getLogoShopByCid($shop->shop_id);
                    $path = $logo->real_name;
                    $yourImageUrl = Yii::app()->assetManager->publish($path);
                    $output.= '<img src="/themes/frontend/gfx/login_logo.png" width="160" alt=logo style="margin-top:6px;" />~';
                    $output.= '<p class="title">'.$shop->name.'</p>~';
                    
                    $output.= '<p>'.$shops[$x]['street'].', '.$shops[$x]['city'].', '.$shops[$x]['post_code'].'</p>~';
                    $output.= $shops[$x]['pos_lat'].'~';
                    $output.= $shops[$x]['pos_lng'].'~'.$x.'|'; 

                    $x++;
                } while ($x<count($shops));
            } else {
                echo 'nema rezultat';
            }
            echo $output;
        }
//        public function vincentyGreatCircleDistance(
//            $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
//          {
//            // convert from degrees to radians
//            $latFrom = deg2rad($latitudeFrom);
//            $lonFrom = deg2rad($longitudeFrom);
//            $latTo = deg2rad($latitudeTo);
//            $lonTo = deg2rad($longitudeTo);
//
//            $lonDelta = $lonTo - $lonFrom;
//            $a = pow(cos($latTo) * sin($lonDelta), 2) +
//              pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
//            $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);
//
//            $angle = atan2(sqrt($a), $b);
//            return $angle * $earthRadius;
//        }

      
}   