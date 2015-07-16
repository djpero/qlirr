
<?php
  class OrderCoDao extends OrderCo 
  {
      public function getAllCommentsByOrderId($order_id) {
          return OrderCo::model()->findAllByAttributes(array('order_id'=>$order_id, 'active'=>1), array('order'=>'id DESC'));
      }    
  }
?>
