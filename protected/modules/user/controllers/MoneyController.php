<?php
class MoneyController extends Controller
{
	public function actionIndex()
	{
            $this->render('index');
	}
        
        public function actionexchange()
	{
            $this->render('exchange');
	}
        public function actionsend()
	{
            $this->render('send');
	}
        public function actionborrow()
	{
            $this->render('borrow');
	}
       
}