<?php


class p2i {
    

    public function call_p2i($url, $imageName)
    {
        $api_url = "http://api.page2images.com/restfullink";
        $device = 6; // 0 - iPhone4, 1 - iPhone5, 2 - Android, 3 - WinPhone, 4 - iPad, 5 - Android Pad, 6 - Desktop
        $apikey = "d6a0f0b30ef0ba6f"; //please input your RESTful api key here.
        $callback_url = "http://test.peydo.com/receive/screenShotUrl/image_id/".$imageName;
          $para = array(
                    "p2i_callback"      => $callback_url,
                    "p2i_url"           => $url,
                    "p2i_key"           => $apikey,
                    "p2i_size"          => '1024x0',
                    "p2i_fullpage"      => '1',
                    "p2i_device"        => $device,
                    "p2i_imageformat"   => 'jpg'
                );
          
          $returnS = p2i::connect($api_url,$para);

    }
    // curl to connect server
    public function connect($url, $para)
    {
        if (empty($para)) {
            return false;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($para));
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

   
}