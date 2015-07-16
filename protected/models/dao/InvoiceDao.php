<?php
  class InvoiceDao extends Invoice 
  {
        public function getInvoicesByShop($shop_id) {
              return Invoice::model()->findAllByAttributes(array('user_id'=>$shop_id));
        }
        public function searchByInput($text, $shop_id) {
            
            $model = Invoice::model()->findAll(array(
                'condition'=>'date_issued LIKE :code OR id LIKE :code',
                'params'=>array(':code'=>'%'.$text.'%')
            ));
            return $model;
        }
        
        public function getAllInvoices() {
            return Invoice::model()->findAll();
        }
        
        public function getInvoiceById($id) {
            return Invoice::model()->findByAttributes(array('id'=>$id));
        }
  }
?>