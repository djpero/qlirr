<?php
    class EmailTemplateDao extends EmailTemplate 
    {
         public function getEmailTemplateById($id) {
            return EmailTemplate::model()->findByAttributes(array("id" => $id));
        }
    }
?>
