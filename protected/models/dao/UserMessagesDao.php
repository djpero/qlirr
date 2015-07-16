<?php
    class UserMessagesDao extends UserMessages 
    {
        public function getNumberOfNewMessageByUserId($userId)
        {
            return UserMessages::model()->count("receiver_id=:receiver_id AND status = 1", array("receiver_id" => $userId));
        }
    }
?>
