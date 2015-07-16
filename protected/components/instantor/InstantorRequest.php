<?php

class InstantorRequest extends InstantorRest {

    public static function sendPostRequest($url, $source, $api_key, $msg_id, $action, $payload) {
        $payload = self::crypt(self::ENCRYPTION, true, $api_key, $payload, $msg_id);

        $content = array(
            'msg_id' => $msg_id,
            'source' => $source,
            'action' => $action,
            'timestamp' => date('c', time()),
            'encryption' => self::ENCRYPTION,
            'payload' => $payload
        );

        $content['hash'] = self::hash($api_key, $content);
        $res = self::post($url, $content);
        return $res;
    }

    protected static function parsePostFields() {
        $fields = array(
            'source' => null,
            'msg_id' => null,
            'action' => null,
            'encryption' => null,
            'payload' => null,
            'timestamp' => null,
            'hash' => null
        );

        foreach ($fields as $field => &$value) {
            if (isset($_POST[$field]))
                $value = $_POST[$field];
            unset($value);
        }

        return $fields;
    }

    public static function receivePostRequest($source, $api_key, &$payload) {
        $fields = self::parsePostFields();

        $missing_fields = array();
        foreach ($fields as $k => $v)
            if ($v === null)
                $missing_fields[] = $k;

        if (count($missing_fields) !== 0)
            return 'Error: Missing POST field(s): ' . implode(', ', $missing_fields);

        if ($fields['source'] !== $source)
            return 'Error: Invalid source: ' . $fields['source'];

        if ($fields['encryption'] !== self::ENCRYPTION)
            return 'Error: Invalid encryption: ' . $fields['encryption'];

        $hash = $fields['hash'];
        unset($fields['hash']);

        $calc = self::hash($api_key, $fields);
        if ($calc !== $hash)
            return 'Error: Invalid checksum: ' . $hash;

        $payload = self::crypt(self::ENCRYPTION, false, $api_key, $fields['payload'], $fields['msg_id']);

        return 'OK: ' . $fields['msg_id'];
    }

}