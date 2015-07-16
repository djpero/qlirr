
<?php
  class ShopContactsDao extends ShopContacts
  {
      public function getAllContacts($shop_id) {
          return ShopContacts::model()->findAllByAttributes(array('shop_id'=>$shop_id));
      }    
  }
?>
