<?php
    class ShopTypeDao extends ShopType 
    {
        public function getShopType($type) {
            return ShopType::model()->findByAttributes(array('type'=>$type));
        }
        public function getAll() {
            return ShopType::model()->findAll();
        }
    }
?>
