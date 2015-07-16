<?php
    class ServiceDao extends Service 
    {
        public function getServiceOptions()
        {
            return CHtml::listData(Service::model()->findAll(), 'id', 'service_name');   
        }

        public function getServiceData($id)
        {
            return Service::model()->findByPk($id);   
        }
    }
?>
