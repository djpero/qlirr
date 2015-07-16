<?php
    class MobilePrefixDao extends MobilePrefix 
    {
        public function getMobilePrefix()
        {
            return CHtml::listData(MobilePrefix::model()->findAll(), 'name', 'name');
        } 

        public function getMobilePrefixValue()
        {
            $prefix = MobilePrefix::model()->findByPk($this->loadModel()->mobilePrefix_id);

            return $prefix->name;   
        }
    }
?>
