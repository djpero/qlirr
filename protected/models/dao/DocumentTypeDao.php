<?php
    class DocumentTypeDao extends DocumentType
    {
        public function getDocumentTypeOptions()
        {
            return CHtml::listData(DocumentType::model()->findAll(), 'id', 'name');   
        }

        public function getDocumentTypeData($id)
        {
            return DocumentType::model()->findByPk($id);   
        }
    }
?>
