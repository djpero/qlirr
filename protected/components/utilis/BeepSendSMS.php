<?php 
    class BeepSendSMS {

        public function sendSMS($mobile, $message) {
        $username       = Yii::app()->params['beepSendSMSUsername'];
        $password       = Yii::app()->params['beepSendSMSPassword'];
        $destination    = $mobile;
        $source         = 'Qlirr'; 
        $text           = $message;

        $content =  '&user='.rawurlencode($username). 
                    '&pass='.rawurlencode($password). 
                    '&to='.rawurlencode($destination). 
                    '&message='.UtilsMain::sms_encode($text).
                    '&from='.rawurlencode($source);
        $ch = curl_init('http://connect.beepsend.com/gateway.php'); 
        curl_setopt($ch, CURLOPT_POST, true); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        
        //------------- log SMS u bazu ------------
            $model = new SmsLogs;
            $user = Users::model()->findByAttributes(array('mobile_number'=>$mobile));
            if (count($user)>0) {
                $model->user_id = $user->id;
            } else { 
                $model->user_id = '0000';
            }
            $model->mobile_number = $mobile;
            $model->content = $message;
            $model->status = 1;
            $model->save();
            $getAppSetting = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'smsEnabled'));
            if ($getAppSetting->setting_value=='1') {
                $output = curl_exec ($ch); //--------->>>>>>>> PALJENJE I GASENJE PORUKA
            } 
            curl_close ($ch); 
        //-----------------------------------------    
        }

    }
?>
