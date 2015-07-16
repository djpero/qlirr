<?php
    class ServiceFeesDao extends ServiceFees 
    {
        public function CheckPriceBuyer($price, $service) {
            $criteria = new CDbCriteria;
            $criteria->addCondition('`service_id` = :service_id AND `to` >= :price');
            $criteria->params = array('price' => $price, 'service_id' => $service);

            return ServiceFeesDao::model()->find($criteria);; 
        }

        public function FindServiceFeeByPrice($price, $service) {
            $criteria = new CDbCriteria;
            if($price != 0) {
                $criteria->addCondition('`service_id` = :service_id AND `from` <= :price AND `to` >= :price');
            } else {
                $criteria->addCondition('`service_id` = :service_id AND `from` = :price');
                
            }
            $criteria->params = array('price' => $price, 'service_id' => $service);
            return ServiceFeesDao::model()->find($criteria);; 
        }
        
        public function getServecesList($service_id){
           return ServiceFees::model()->findAllByAttributes(array('status'=>1, 'service_id'=>$service_id)); 
        }
        
     
    }
?>
