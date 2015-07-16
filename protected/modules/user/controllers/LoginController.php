<?php

class LoginController extends Controller
{
	public function actionIndex()
	{
            $this->render('index');
	}
        public function actionchange_password()
	{
            $this->render('change_password');
	}
        public function actioncheckLogin() {
            $dataFromPost   = explode("|", $_POST['data']);
            $shop           = ShopsDao::validateUser($dataFromPost[0]);
            if (count($shop)>0) {
                if (md5($dataFromPost[1])===$shop->password) {
                    
                    Yii::app()->session['userIDm'] = $shop->id;
                    Yii::app()->session['userIDp'] = $shop->password;
                    if ($shop->firstTime==='1') {
                       echo '#ok|login/change_password'; 
                    } else {
                       echo '#ok|/user/orders/index/firsttime/true'; 
                    }
                    
                } else {
                    echo '#error|Wrong credentials';
                }
            } else {
                echo '#error|Wrong credentials';
            }
            
        }
        
        public function actionchangePass() {
            $dataFromPost = explode("|", $_POST['data']);
            $shop = ShopsDao::getShopById($dataFromPost[2]);
            $shop->password = md5($dataFromPost[0]);
            $shop->firstTime = '0';
            $shop->update(array('password', 'firstTime'));
            Yii::app()->session['userIDp'] = $shop->password;
            echo '#ok|/user/orders';
        }
}