
<?php
  class ShopsCompanyDao extends ShopsCompany
  {
      public function getAllOwners($shop_id) {
          return ShopsCompany::model()->findAllByAttributes(array('shop_id'=>$shop_id));
      }    
  }
?>
