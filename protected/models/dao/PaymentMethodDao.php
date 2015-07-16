<?php
    class PaymentMethodDao extends PaymentMethod
    {
        public function getPaymentMethodOptions()
        {
            return CHtml::listData(PaymentMethod::model()->findAll(), 'id', 'name');   
        }

    }
?>
