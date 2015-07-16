<?php
    class PayoutStatusDao extends PayoutStatus
    {
        public function getPayoutStatus($status_id)
        {
            $status = PayoutStatusDao::model()->findByPk($status_id);

            return $status->name;
        } 
}