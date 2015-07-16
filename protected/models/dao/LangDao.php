<?php
    class LangDao extends Lang 
    {

        public function getDataByLang($lang)
        {
            return Lang::model()->findAllByAttributes(array('lang'=> $lang));   
        }
    }
?>
