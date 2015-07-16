<?php
    class CurrDao extends Curr 
    {

        public function getCurrById($id) {
            return Curr::model()->findByAttributes(array('id'=>$id));
        }
        public function getCurrByName($id) {
            $model = Curr::model()->findAll(array(
                'condition'=>'name LIKE :code',
                'params'=>array(':code'=>'%'.$id.'%')
            ));
            return $model;
        }
       
    }
?>
