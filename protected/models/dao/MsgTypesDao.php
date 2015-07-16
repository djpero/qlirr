<?php
    class MsgTypesDao extends MsgTypes 
    {
        public function getMsgTypeOptions()
        {
            return CHtml::listData(MsgTypes::model()->findAll(), 'id', 'name');
        }
        
          public function msgType($type)
        {
            $naziv = MsgTypesDao::model()->findByAttributes(array('id'=>$type));

            return $naziv->name;    
        }
    }
?>
