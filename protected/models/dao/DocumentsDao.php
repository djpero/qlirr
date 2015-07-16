<?php
    class DocumentsDao extends Documents
    {
        public function getDocumentByOrderIdAndType($orderId, $type) {
            return Documents::model()->findByAttributes(array("order_id" => $orderId, 'documentType_id' => $type));
        }
        public function getDocumentByOrderIdAndTypeAndLevel($orderId, $type, $level) {
            return Documents::model()->findByAttributes(array("order_id" => $orderId, 'documentType_id' => $type, 'penalityLevel' => $level));
        }
        
        public function checkIFExistDocumentWithUSerIdAndTypeAndOrderId($userId, $type, $orderId) {
            return Documents::model()->findByAttributes(array("order_id" => $orderId, 'documentType_id' => $type, 'user_id' => $userId));
        }
        
        public function getListAllDocumentsByUserId($user_id) {
            return Documents::model()->findAllByAttributes(array('user_id'=>$user_id));
        }
        public function getListDocuments($order_id) {
            return Documents::model()->findAllByAttributes(array('order_id'=>$order_id));
            
        }
        public function getDocumentsByType($type, $level) {
            $model = Documents::model()->findAll(array(
                'condition'=>'documentType_id=:type AND penalityLevel = :level',
                'params'=>array(':type'=>$type, ':level'=>$level),
            ));
            return $model;
        }
        public function getDocumentsByTypeSend($type, $sent) {
            $model = Documents::model()->findAll(array(
                'condition'=>'documentType_id=:type AND sent = :sent',
                'params'=>array(':type'=>$type, ':sent'=>$sent),
            ));
            return $model;
        }
    }
?>
