<?php


class ProfileController extends Controller
{
	public function actionIndex()
	{
            $this->render('index');
	}
        
        public function actionlogout() {
            Yii::app()->session['userIDm'] = '';
            Yii::app()->session['userIDp'] = '';
            Yii::app()->session->clear();
            $this->redirect('/user/login');
        }
        
        public function actionsaveProfile() {
            $dataFromPost = explode("|", $_POST['data']);
            
            
        }
       
}