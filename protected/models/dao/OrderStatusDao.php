<?php
    class OrderStatusDao extends OrderStatus 
    {
        public function getOrderStatus($status_id)
        {
           return $status = OrderStatus::model()->findByPk($status_id);

        } 

        public function getOrderStatusOptions()
        {
            return CHtml::listData(OrderStatus::model()->findAll(), 'id', 'name');   
        }
        
        public function getAllStatuses($type) {
            return OrderStatus::model()->findAllByAttributes(array('type' => $type));
        }

    }
?>
