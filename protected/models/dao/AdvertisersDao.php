<?php
    class AdvertisersDao extends Advertisers
    {
        public function getAdvertisersOptions()
        {
            return CHtml::listData(Advertisers::model()->findAll(), 'id', 'name');   
        }
    }
?>
