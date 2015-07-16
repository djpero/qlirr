<?php
    class CitiesDao extends Cities 
    {
        public function getCityByName($match) {
            $q = new CDbCriteria();
            $q->addSearchCondition('place', $match);
            return $cities = Cities::model()->findAll( $q );
        }
        
        public function getCityByPostcode($match) {
            $q = new CDbCriteria();
            $q->addSearchCondition('postcode', $match);
            return $cities = Cities::model()->findAll( $q );
        }
        
        
    }
?>
