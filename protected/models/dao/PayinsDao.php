<?php
    class PayinsDao extends Payins
    {       
        
        public function getAll($status) {
            return Payins::model()->findAllByAttributes(array('status'=> $status, 'active' => 1));
        }
        public function getPayinByOrderId($id) {
            return Payins::model()->findAllByAttributes(array('order_id'=> $id),array('order'=>'id DESC', 'limit'=> '1'));
        }
        public function getPayinsForOrder($id) {
            return Payins::model()->findAllByAttributes(array('order_id'=> $id),array('order'=>'id DESC'));
        }
        public function getPayinById($id) {
            return Payins::model()->findByAttributes(array('id'=> $id));
        }
 
        
}
