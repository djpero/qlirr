<?php

require_once 'HTTP/Request2.php';

class InstantorRest {

    const ENCRYPTION = 'B64/MD5/AES/CBC/PKCS5';

    protected static function hash($salt, $payload) {
        ksort($payload);
        $payload_string = $salt;

        foreach ($payload as $val)
            $payload_string.=$val;

        return sha1($payload_string);
    }

    private static function pkcs5_pad($text, $blocksize = 16) {
        $pad = $blocksize - ( strlen($text) % $blocksize );
        return $text . str_repeat(chr($pad), $pad);
    }

    private static function pkcs5_unpad($text) {
        $pad = ord($text{ strlen($text) - 1 });
        if ($pad > strlen($text))
            return false;
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad)
            return false;
        return substr($text, 0, -1 * $pad);
    }

    protected static function crypt($encryption, $encrypt, $key, $payload, $msg_id) {
        switch ($encryption) {
            case self::ENCRYPTION:
                $key = md5($key, true);
                $iv = md5($msg_id, true);

                $cipher = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
                mcrypt_generic_init($cipher, $key, $iv);

                if ($encrypt) {
                    $payload = self::pkcs5_pad($payload);
                    $payload = mcrypt_generic($cipher, $payload);
                    $payload = base64_encode($payload);
                } else {
                    $payload = base64_decode($payload);
                    $payload = mdecrypt_generic($cipher, $payload);
                    $payload = self::pkcs5_unpad($payload);
                }

                mcrypt_generic_deinit($cipher);
                mcrypt_module_close($cipher);

                return $payload;
        }

        return false;
    }

//  -------------------------------------------------------------------

    protected static function createXML($params, $comment = null) {
        $xml = newDom();
        $xml->formatOutput = true;

        $root = $xml->createElement('payload');
        $xml->appendChild($root);

        if (null !== $comment) {
            $com = $xml->createComment(' ' . $comment . ' ');
            $parent->appendChild($com);
        }

        $last = null;

        foreach ($params as $name => $value) {
            $elem = $xml->createElement($name);
            $elem->appendChild($xml->createTextNode($value));

            $root->appendChild($elem);
        }

        return $xml->saveXML();
    }

    protected static function post($url, $content) {
        $request = new HTTP_Request2($url);
        $request->setMethod(HTTP_Request2::METHOD_POST);

        foreach ($content as $name => $val)
            $request->addPostParameter($name, $val);

        $request->setConfig(array(
            'ssl_verify_peer' => false,
        ));

        try {
            $response = $request->send();
            $body = $response->getBody();
            return $body;
        } catch (HTTP_Request2_Exception $e) {
            return false;
        }
    }

}