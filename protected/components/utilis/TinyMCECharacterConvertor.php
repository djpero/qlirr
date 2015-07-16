<?php
    class TinyMCECharacterConvertor
    {
        public static function convertCharacters($content)
        {
            $tinyCharacters = array("&gt;");
            $normalCharacters   = array(">");

            return str_replace($tinyCharacters, $normalCharacters, $content);
        }
    }