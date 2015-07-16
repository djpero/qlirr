<?php
  class ChargeBackDao extends Chargeback 
  {
          public function getList() {
              return Chargeback::model()->findAllByAttributes(array('status'=>1));
          }
          public function getAllByUserId($user_id) {
              return Chargeback::model()->findAllByAttributes(array('status'=>1, 'user_id'=> $user_id), array('order' => 'id DESC'));
          }
  }
?>