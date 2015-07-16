<?php
    /**
    * Controller is the customized base controller class.
    * All controller classes for this application should extend from this base class.
    */
    class Controller extends CController {   


        public $modelLogin;
        public $menu=array();
        /**
        * @var array the breadcrumbs of the current page. The value of this property will
        * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
        * for more details on how to specify this property.
        */
        public $breadcrumbs=array();
        /**
        * @var string the default layout for the controller view. Defaults to '//layouts/column1',
        * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
        */
        public $layout='//layouts/main';

        public $user;

        public function init() {
            $this->user = Yii::app()->user->getState("UserData");

            $languageCookie = Yii::app()->request->cookies['language'];

            if(isset($languageCookie))
            {
                Yii::app()->language = $languageCookie->value;
            }

            $this->modelLogin = new LoginForm();
        }

        public function actions() {
        }

        public function register() {
            $model = new UsersDao;
            $login = new LoginForm;

            // Uncomment the following line if AJAX validation is needed
            //$this->performAjaxValidation($model);

            if(isset($_POST['UsersDao']))
            {
                $fname = GeneralFunctions::mb_ucwords(trim($_POST['UsersDao']['name']));
                $lname = GeneralFunctions::mb_ucwords(trim($_POST['UsersDao']['surname']));
                $boi_jmbg = trim($_POST['UsersDao']['personal_number']);

                $personalNumberFetcher = new PersonalNumberFetcher();
                $personData = $personalNumberFetcher->getData($fname, $lname, $boi_jmbg);

                $passwordRandom =  GeneralFunctions::randomCode(6);

                $model->attributes=$_POST['UsersDao'];
                $model->email = GeneralFunctions::strtolower_utf8(trim($_POST['UsersDao']['email']));
                $model->gender = $personData['gender'];
                $model->age = $personData['age'];
                $model->password = sha1($passwordRandom);
                $model->name = $fname;
                $model->surname = $lname;
                $model->ip_address = Yii::app()->request->userHostAddress;
                $model->mobile_number = $_POST['mobilePrefix_id'].$_POST['UsersDao']['mobile_number'];
                $model->userType_id = 3; 

                if($model->save()) {
                    $smarty = Yii::app()->viewRenderer->getSmarty();
                    $emailTemplate = EmailTemplate::model()->findByPk(1);
                    //$user = UsersDao::model()->findByAttributes(array('mobile_number'=>$model->mobile_number,'password'=>$model->password));

                    OrdersDao::model()->updateAll(array( 'seller_id' => $model->id), 'mobile = '.$model->mobile_number);

                    $smarty->assign('user', $model);
                    $smarty->assign('password', $passwordRandom);
                    $code = GeneralFunctions::randomCode(8);
                    $smarty->assign('code', $code);
                    $content = $smarty->fetch('eval:' . $emailTemplate->eContent);

                    //$smarty->assign('user', $user);
                    SendMail::mailsend($model->email, 
                        $emailTemplate->sender_email, 
                        $emailTemplate->subject, 
                        $content, null, $model, $code);

                    //BeepSendSMS::sendSMS("387".$user->mobilePrefix->value.$user->mobile, "Test jedan dva!");
                    $login->username = $model->mobile_number;
                    $login->password = $model->password;

                    if($login->validate() && $login->login()) {
                        $order =  Yii::app()->user->getState("order");

                        if($order) {
                            $orderDao = OrdersDao::model()->findByPk($order);
                            $orderDao->seller_id = $model->id;
                            $orderDao->save();

                            $this->redirect(array("/customer/orders/offer/", 'id'=>$order));
                        }
                        else
                            $this->redirect(array('/site/secure'));
                    }

                } else {
                    $this->redirect("/");
                }
                //$this->redirect(array('/users/view','id'=>$model->id));
            }

            $mobile = Yii::app()->user->getState('mobile_number');

            $mobilePrefixD = substr($mobile, 0, 3);
            $mobile = substr($mobile, 3, strlen($mobile));

            $this->renderPartial('/site/registration',array(
                    'model'=>$model, 'mobile' => $mobile, 'mobilePrefix' => $mobilePrefixD
                ));
        }
    }
