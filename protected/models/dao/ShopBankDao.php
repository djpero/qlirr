<?php
    class ShopBankDao extends ShopBank 
    {
        public function getAll() {
            return ShopBank::model()->findAllByAttributes(array('status'=>1));            
        }
        public function getBankByUserId($user_id) {
            return ShopBank::model()->findByAttributes(array('user_id'=>$user_id));    
        }
    }
?>
