<?php
    class UserTypesDao extends UserTypes 
    {
        public function getUserTypeOptions()
        {
            return CHtml::listData(UserTypes::model()->findAll(), 'id', 'name');   
        }

        public function getUserTypesData($type_id)
        {
            return UserTypes::model()->findByPk($type_id);   
        }
    }
?>
