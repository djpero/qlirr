<?php
    class CountiesDao extends Counties 
    {
        public function getAll() {
            return Counties::model()->findAll();
        }
        public function getCountyById($id) {
            return Counties::model()->findByAttributes(array('id'=>$id));
        }
        
    }
?>
