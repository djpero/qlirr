<?php
    class InstantorXmlDao extends InstantorXml
    {
        public function getByUserIdentificationAndStatus($userIdentification, $type)
        {
            return InstantorXml::model()->find(array('order'=>'time_created DESC', 'condition'=>'user_identification=:userIdentification AND type=:type', 'params'=>array(':userIdentification'=>$userIdentification, ":type" => $type)));   
        }

        public function getByUserIdentificationAndStatusAndDate($userIdentification, $type, $date)
        {
            return InstantorXml::model()->find(array('order'=>'time_created DESC', 'condition'=>'user_identification=:userIdentification AND type=:type AND time_created>:date', 'params'=>array(':userIdentification'=>$userIdentification, ":type" => $type, "date" => $date)));   
        }

        public function getUserIdentification($userIdentification, $type)
        {
            $instantorXml = InstantorXmlDao::getByUserIdentificationAndStatus($userIdentification, $type);

            if($instantorXml)
            {
                if((time() - strtotime($instantorXml->time_created)) < (60*60*24*90))
                    return true;
            }
            else
                return false;
        }
        
        public function getInstantorData($id_number) {
            return InstantorXml::model()->findByAttributes(array('user_identification'=>$id_number, 'reportNo' => '1'));
        }
        public function getInstantorDataBySsn($id_number) {
            return InstantorXml::model()->findByAttributes(array('ssn'=>$id_number, 'reportNo' => '1'));
        }
        public function getInstantorDataBySsnOk($id_number) {
            return InstantorXml::model()->findByAttributes(array('ssn'=>$id_number, 'reportNo' => '3'));
        }
    } 
?>
