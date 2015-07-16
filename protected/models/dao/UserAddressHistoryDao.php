<?php 
    class UserAddressHistoryDao extends UserAddressHistory 
    {
        public function getLastAddressChange($user_id)
        {
            $criteria = new CDbCriteria;
            $criteria->order = 'update_time DESC';
            return UserAddressHistory::model()->findByAttributes(array('user_id'=>$user_id), $criteria);
        }
    }
?>