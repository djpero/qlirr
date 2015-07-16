<?php
    class AdminsController extends Controller
    {
        public $layout='//layouts/admin';
        public $user;

        public function init()
        {
            $languageCookie = Yii::app()->request->cookies['language'];

            if(isset($languageCookie))
            {
                Yii::app()->language = $languageCookie->value;
            }

            if(CheckFunctions::userType() == 2)
                $this->redirect(array('/merchant'));
            elseif(CheckFunctions::userType() == 3)
                $this->redirect(array('/customer'));   
            if(Yii::app()->user->isGuest) 
                $this->redirect(array('/site/SessionOut'));   

            $this->user = Yii::app()->user->getState("UserData");
        }

        public function filters()
        {
            return CMap::mergeArray(parent::filters(),array(
                    'accessControl', // perform access control for CRUD operations
                    'postOnly + delete', // we only allow deletion via POST request
                ));
        }
        /**
        * Specifies the access control rules.
        * This method is used by the 'accessControl' filter.
        * @return array access control rules
        */
        public function accessRules()
        {
            return array(
                array('allow',  // allow all users to perform 'index' and 'view' actions
                    'expression'=>'CheckFunctions::userType()==1'
                ),
                array('deny',  // deny all users
                    'users'=>array('*'),
                ),
            );
        }

    }
?>
