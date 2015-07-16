<?php
    class UsersHistoryDao extends UsersHistory
    {
        public function getLastNameAndSurnameChange($user_id, $change_type)
        {
            return UsersHistory::model()->findByAttributes(array('user_id'=>$user_id, 'change_type' => $change_type));
        }
    }
?>
