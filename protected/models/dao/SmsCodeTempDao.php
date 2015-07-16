<?php
    class SmsCodeTempDao extends SmscodeTemp 
    {
        public function getCodeByArticleAndPhone($article,$phone)
        {
            return SmscodeTemp::model()->findByAttributes(array('order_reference'=>$article, 'mobile_phone'=>$phone));  
        }
        public function checkPINByArticleAndPhone($article,$phone,$pin)
        {
            return SmscodeTemp::model()->findByAttributes(array('order_reference'=>$article, 'mobile_number'=>$phone, 'sms_code'=>$pin));  
        }
        public function checkUserByMobileAndPin($phone, $pin) {
            
            return SmscodeTemp::model()->findByAttributes(array('mobile_number'=>$phone, 'sms_code'=>$pin, 'active' => 1));  
        }
        public function getLastPinByMobile($mobile) {
            return SmscodeTemp::model()->findByAttributes(array('mobile_number'=>$mobile,'active' => 1)); 
        }
    }
?>
