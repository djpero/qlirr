<?php
    class MerchantDao extends Merchant 
    {
        public function getMerchantDataById($id)
        {
            return MerchantDao::model()->findByAttributes(array('id'=>$id));  
        }
        public function getMerchantDataByName($name)
        {
            return MerchantDao::model()->findByAttributes(array('name'=>$name));  
        }

    }
?>
