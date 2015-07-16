<?php
    class UserAdDao extends UserAd
    {
        public function getAds()
        {
            $criteriaOglasi = new CDbCriteria;
            $criteriaOglasi->compare('user_id',CheckFunctions::userId());
            $criteriaOglasi->compare('status', 1);
            return new CActiveDataProvider('UserAd', array('criteria'=>$criteriaOglasi,));
        }

        public function getLastAd()
        {
            $criteria = new CDbCriteria;
            $criteria->compare('user_id', CheckFunctions::userId());
            $criteria->compare('status', 1);
            $criteria->order = 'time_created DESC';

            return UserAd::model()->find($criteria);   
        }
    }
?>
