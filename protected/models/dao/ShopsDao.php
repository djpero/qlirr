<?php
    class ShopsDao extends Shops 
    {
        public function getShopList($status) {
            return Shops::model()->findAllByAttributes(array('status'=> $status));
        }
        public function validateName($name) {
            return Shops::model()->findByAttributes(array('status'=>1, 'name'=>$name));
        }
        public function validateCID($cid) {
            return Shops::model()->findByAttributes(array('status'=>1, 'shop_id'=>$cid));
        }
        public function validateSSN($ssn) {
            return Shops::model()->findByAttributes(array('status'=>1, 'personal_number'=>$ssn));
        }
        public function validateUser($user) {
            return Shops::model()->findByAttributes(array('status'=>1, 'username'=>$user));
        }
        public function getShopById($id) {
            return Shops::model()->findByAttributes(array('id'=>$id, 'status'=>1));
        }
        public function getShopByIdPassive($id) {
            return Shops::model()->findByAttributes(array('id'=>$id, 'status'=>0));
        }
        public function searchShopByName($shop) {
            $model = Shops::model()->findAll(array(
                'condition'=>'name LIKE :code',
                'params'=>array(':code'=>'%'.$shop.'%')
            ));
            return $model;
        }
    }
?>
