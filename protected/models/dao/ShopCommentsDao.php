
<?php
  class ShopCommentsDao extends ShopComments
  {
      public function getAllCommentsByShopId($shop_id) {
          return ShopComments::model()->findAllByAttributes(array('shop_id'=>$shop_id, 'active'=>1), array('order'=>'id DESC'));
      }    
  }
?>
