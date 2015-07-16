<?php
    require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'TinyMCE.php';

    class TinyMCE_Simple extends TinyMCE
    {    
        public $editorOptions = array(

            'plugins'=>'advlist autolink lists link image charmap print preview hr anchor pagebreak
            searchreplace wordcount visualblocks visualchars code fullscreen
            insertdatetime media nonbreaking save table contextmenu directionality
            emoticons template paste',

            'theme'=>'modern',

            'force_br_newlines'=>true,
            'force_p_newlines'=>false,
            'forced_root_block'=>'',
        );
    }
