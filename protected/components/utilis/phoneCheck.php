<?php
    class phoneCheck {

        public function check($mobile) {
        $url    = "https://platform.instantor.com/eds/info-torg/find-by-phone/";

        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url.$mobile);
        $output = curl_exec ($ch);
        curl_close ($ch); 
        return $output;
        }
    }
?>
