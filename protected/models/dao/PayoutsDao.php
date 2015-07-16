<?php
    class PayoutsDao extends Payouts
    {       
        public function getPayments()
        {
            $criteria = new CDbCriteria;
            $criteria->condition = 'user_id = :user_id';
            $criteria->params = array("user_id" => CheckFunctions::userId());
            return new CActiveDataProvider('Payouts', array('criteria'=>$criteria,));
        }

        public function getLastPayment()
        {
            $criteria = new CDbCriteria;
            $criteria->condition = 'user_id = :user_id';
            $criteria->params = array("user_id" => CheckFunctions::userId());
            $criteria->order = 'time_created DESC';
            return PayoutsDao::model()->find($criteria);
        }

        public function getSumPayments() {
            $c = new CDbCriteria;
            $c->condition = "user_id = :user_id AND status_id = 3";
            $c->params = array("user_id" => CheckFunctions::userId());
            $c->select = array(
                'SUM(amount) as sumAmount',
            );
            return PayoutsDao::model()->find($c)->sumAmount;
        }

        public function getSumApprovedPayments() {
            $c = new CDbCriteria;
            $c->condition = "user_id = :user_id AND status_id = 2";
            $c->params = array("user_id" => CheckFunctions::userId());
            $c->select = array(
                'SUM(amount) as sumAmount',
            );
            return PayoutsDao::model()->find($c)->sumAmount;
        }

        public function getLastPayout()
        {
            $criteria = new CDbCriteria;
            $criteria->compare('user_id', CheckFunctions::userId());
            $criteria->compare('status_id', 3);
            $criteria->order = 'payment_date DESC';

            return Payouts::model()->find($criteria);
        }

        public function getLastPayoutDate()
        {
            $criteria = new CDbCriteria;
            $criteria->compare('status_id', 3);
            $criteria->order = 'payment_date DESC';

            return Payouts::model()->find($criteria); 
        }

        public function getTotalPayouts()
        {
            $criteria = new CDbCriteria;
            $criteria->compare('status_id', 3);
            $criteria->order = 'payment_date DESC';

            return new CActiveDataProvider('Payouts', array('criteria'=>$criteria)); 
        }

	public function getTotalForPayment()
        {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria=new CDbCriteria;

            $criteria->addCondition('status_id = 1');

            return new CActiveDataProvider('Payouts', array(
                    'criteria'=>$criteria, 'sort'=>array('defaultOrder'=>'id')
                ));
        }
        public function getPayoutById($id) {
            return Payouts::model()->findByAttributes(array('order_id'=> $id));
        }
        public function getPayoutByPayoutId($id) {
            return Payouts::model()->findByAttributes(array('id'=> $id));
        }
        public function getTotalPayoutAmountByStatus($status) {
            return Payouts::model()->findAllByAttributes(array('status_id'=> $status),array('order'=>'id DESC'));
        }
        public function getGroupSumPayouts($shop_id) {
            $tot = Yii::app()->db->createCommand()
                    ->select('sum(amount) as mySum')
                    ->from('payouts')
                    ->where('user_id = ' . $shop_id. ' AND paid=0')
                    ->queryRow();
            return $tot;
        }
        public function getGroupCountPayouts($shop_id) {
            $tot = Yii::app()->db->createCommand()
                    ->select('count(id) as mySum')
                    ->from('payouts')
                    ->where('user_id = ' . $shop_id. ' AND paid=0')
                    ->queryRow();
            return $tot;
        }
        public function getGroupList() {
            return Payouts::model()->findAllBySql('SELECT user_id FROM payouts WHERE paid=0 GROUP BY user_id');
        }
        public function getPayoutsNotPaidByShop($shop_id) {
            return Payouts::model()->findAllByAttributes(array('paid'=>0, 'user_id'=>$shop_id));
        }
        
        public function getPayoutById2($id) {
            return Payouts::model()->findByAttributes(array('id'=>$id));
        }
        
}
