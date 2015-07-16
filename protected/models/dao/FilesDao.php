<?php
    class FilesDao extends Files 
    {
        public function getFilesListByCID($cid)
        {
            return Files::model()->findAllByAttributes(array('type_id'=> $cid));
        }
        public function getLogoShopByCid($cid)
        {
            return Files::model()->findByAttributes(array('type_id'=> $cid, 'type'=>0));
        }
    } 
?>
