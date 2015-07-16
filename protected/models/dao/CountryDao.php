<?php
    class CountryDao extends Country 
    {
        public function getCountryOptions()
        {
            return CHtml::listData(Country::model()->findAll(), 'id', 'country_name');   
        }

        public function getCountryValue()
        {
            $country = Country::model()->findByPk($this->user->country_id);
            return $country->country_name;   
        }

        public function getCountryCodeValue()
        {
            $country = Country::model()->findByPk($this->user->country_id);
            return $country->country_code;   
        }

        public function getCountryCodeValueByUserId($country_id)
        {
            $country = Country::model()->findByPk($country_id);
            return $country->country_code;   
        }

        public function getCountryValueById($id)
        {
            $country = Country::model()->findByPk($id);
            return $country->country_name;   
        }
        public function getCountryByName($country) {
            $model = Country::model()->findAll(array(
                'condition'=>'country_name LIKE :code',
                'params'=>array(':code'=>'%'.$country.'%')
            ));
            return $model;
        }
        public function getCountryByCurrencyCode($valute_id) {
            
            $model = Country::model()->findByAttributes(array('default_currency_id'=>$valute_id));
            return $model;
        }
    }
?>
