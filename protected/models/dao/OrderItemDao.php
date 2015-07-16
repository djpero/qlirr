<?php
    class OrderItemDao extends OrderItem 
    {
        public function getOrderItemData($id)
        {
            return OrderItem::model()->findByAttributes(array('order_id' => $id));   
        }
    }
?>
