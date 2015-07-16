<?php
    class CountryphoneDao extends Countryphone 
    {
        public function getCountyPhoneList()
        {
            return Countryphone::model()->findAll();
        }
        public function getFlagByPrefix($prefix)
        {
            return Countryphone::model()->findByAttributes(array('prefix' => $prefix));
        }
    } 
?>
