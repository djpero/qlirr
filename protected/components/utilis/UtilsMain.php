<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class UtilsMain {
    
    public function MakeThumbnail($path,$thumbnail) {
          $im = new Imagick($path);
          $width    = $im->getImageWidth();
          $height   = $im->getImageHeight();
          $coef     = 1;
          $ratio    = ($height*$coef);
          if ($width>$ratio) {
              $cropLeftRight = ($width-$ratio) / 2;
              $im->cropImage(($width-($cropLeftRight*2)), $height, $cropLeftRight,0);
          } else {
              $cropTopBottom = ($height - ($width/$coef))/ 2;
              $im->cropImage($width, $height-($cropTopBottom*2), 0, $cropTopBottom);
          }
          $im->writeImage($thumbnail);
    }
    public function SaveImageFromUrl($my_img,$fullpath){

                $ch = curl_init ($my_img);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
                curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
                $rawdata=curl_exec($ch);
                curl_close ($ch);
                if(file_exists($fullpath)){
                    unlink($fullpath);
                }
                $fp = fopen($fullpath,'x');
                fwrite($fp, $rawdata);
                fclose($fp);
     }
     
     public function sms_encode($inputMsg) {
            $RemoveChars[] = '/å/';
            $RemoveChars[] = '/ä/';
            $RemoveChars[] = '/ö/';
            $RemoveChars[] = '/Å/';
            $RemoveChars[] = '/Ä/';
            $RemoveChars[] = '/Ö/';

            $ReplaceWith[] = '%E5';
            $ReplaceWith[] = '%E4';
            $ReplaceWith[] = '%F6';
            $ReplaceWith[] = '%C5';
            $ReplaceWith[] = '%C4';
            $ReplaceWith[] = '%D6';

            return preg_replace($RemoveChars, $ReplaceWith, $inputMsg);
     }
     public function pEnc($string) {
            $key="datadanemaproblemasapermisijama";
            $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
            return $encrypted;
     }
     public function pDenc($string) {
            $key="datadanemaproblemasapermisijama";
            $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
            return $decrypted;
     }

}


?>
