<?php
    class RemiDao extends Remi 
    {
        public function getFirstActiveReminder($order_id) {
            $order = OrdersDao::getOrderById($order_id);
             
            $model = Remi::model()->findAll(array(
                'condition'=>'name=:name AND created_at <= :date',
                'params'=>array(':name'=>'reminder_1', ':date'=>$order->time_created),
                'order'=> 'created_at DESC',
            ));
            return $model[0]->value;
        }
        
        public function getFirstActiveReminderForChargeBack() {
             
            $model = Remi::model()->findAll(array(
                'condition'=>'name=:name AND created_at <= :date',
                'params'=>array(':name'=>'reminder_1', ':date'=>date("Y-m-d H:i:s")),
                'order'=> 'created_at DESC',
            ));
            return $model[0]->value;
        }
        
        public function getNextReminder($order_id) {
            $order = OrdersDao::getOrderAllById($order_id);
            $model = Remi::model()->findAll(array(
                'condition'=>'name=:name AND created_at <= :date',
                'params'=>array(':name'=>'reminder_'.($order->penalityLevel+1), ':date'=>$order->time_created),
                'order'=> 'created_at DESC',
            ));
            return $model[0];
        }
         
        public function getNextReminderCharge($chargeback) {
            $order = Chargeback::model()->findByPk($chargeback);
            $model = Remi::model()->findAll(array(
                'condition'=>'name=:name AND created_at <= :date',
                'params'=>array(':name'=>'reminder_'.($order->penalityLevel+1), ':date'=>$order->created_at),
                'order'=> 'created_at DESC',
            ));
            return $model[0];
        }
        public function getReminderValueByOrderPenalityLevel($order_id) {
            $order = OrdersDao::getOrderAllById($order_id);
            $model = Remi::model()->findAll(array(
                'condition'=>'name=:name AND created_at <= :date',
                'params'=>array(':name'=>'reminder_'.($order->penalityLevel), ':date'=>$order->time_created),
                'order'=> 'created_at DESC',
            ));
            return $model[0];
        }
        
        public function getReminderValueByChargebackPenalityLevel($chargeback) {
            $order = Chargeback::model()->findByPk($chargeback);
            $model = Remi::model()->findAll(array(
                'condition'=>'name=:name AND created_at <= :date',
                'params'=>array(':name'=>'reminder_'.($order->penalityLevel), ':date'=>$order->created_at),
                'order'=> 'created_at DESC',
            ));
            return $model[0];
        }
        
        public function getReminderValueByOrderPenalityLevel2($order_id, $level) {
            $order = OrdersDao::getOrderAllById($order_id);
            $model = Remi::model()->findAll(array(
                'condition'=>'name=:name AND created_at <= :date',
                'params'=>array(':name'=>'reminder_'.$level, ':date'=>$order->time_created),
                'order'=> 'created_at DESC',
            ));
            return $model[0];
        }
        
         public function getReminderValueByChargebackPenalityLevel2($order_id, $level) {
            $order = Chargeback::model()->findByPk($order_id);
            $model = Remi::model()->findAll(array(
                'condition'=>'name=:name AND created_at <= :date',
                'params'=>array(':name'=>'reminder_'.$level, ':date'=>$order->created_at),
                'order'=> 'created_at DESC',
            ));
            return $model[0];
        }
        
        public function getList() {
            return Remi::model()->findAllByAttributes();
        }
      
    }
?>
