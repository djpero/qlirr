<?php
    class BanksDao extends Banks 
    {
        public function getBanksOptions()
        {
            return CHtml::listData(Banks::model()->findAll(), 'id', 'CodeFullName');   
        }
        
        public function getOurBanksOptions()
        {
            $criteria = new CDbCriteria;
            $criteria->condition = 'sorty_key IS NOT null AND sorty_key <> ""';
            
            return CHtml::listData(Banks::model()->findAll($criteria), 'id', 'CodeFullName');   
        }
        public function getBankName($bank_id) {
            return Banks::model()->findByAttributes(array('id'=>$bank_id));
        }
        public function getAll() {
            return Banks::model()->findAllByAttributes(array('visible'=>1));            
        }
    }
?>
