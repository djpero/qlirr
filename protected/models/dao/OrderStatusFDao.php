<?php
    class OrderStatusFDao extends OrderStatusF
    {
        
        public function getAllStatuses($type) {
            return OrderStatusF::model()->findAllByAttributes(array('type' => $type));
        }
        public function getOrderStatus($id) {
            return OrderStatusF::model()->findByAttributes(array('id' => $id));
        }

    }
?>
