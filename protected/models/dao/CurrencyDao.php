<?php
    class CurrencyDao extends Currency 
    {
        
        public function getCountryByName($country) {
            $model = Currency::model()->findAll(array(
                'condition'=>'currency_name LIKE :code',
                'params'=>array(':code'=>'%'.$country.'%')
            ));
            return $model;
        }
    }
    
?>
