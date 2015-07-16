<?php
    class OrderFraudDao extends OrderFraud 
    {

        public function getFraudByOrderID($id)
        {
            return OrderFraud::model()->findByAttributes(array('order_id'=> $id));   
        }
    }
?>
