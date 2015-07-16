<?php 
    class PaymentNoticeDao extends PaymentNotice
    {
        public function actions($status_id, $id)
        {
            $contract = CHtml::link(Yii::t('app', 'customer.orders.download_contract'), array('/customer/orders/getPDF', 'id'=>$id));
            $bill = CHtml::link(Yii::t('app', 'customer.orders.download_payment'), array('/customer/orders/bill', 'id'=>$id));
            $paymentNotice = CHtml::link(Yii::t('app', 'model.account.unique_ref'), array('/customer/orders/getPDFNotice', 'id'=>$id, 'reference'=>'', 'service'=>''));

            if($status_id == 1)
            {
                return '<ul id="yw'.$id.'" class="nav nav-pills">
                <li class="dropdown">
                <button class="btn btn-mini btn-warning dropdown-toggle" data-toggle="dropdown">
                <i class="icon-cog"></i>
                </button>
                <ul id="yw'.$id.'1" class="dropdown-menu"><li>'.$contract.'</li><li>'.$bill.'</li></ul></li></ul>';   
            } elseif($status_id == 2 || $status_id == 3) {
                return '<ul id="yw'.$id.'2" class="nav nav-pills">
                <li class="dropdown">
                <button class="btn btn-mini btn-warning dropdown-toggle" data-toggle="dropdown">
                <i class="icon-cog"></i>
                </button>
                <ul id="yw'.$id.'3" class="dropdown-menu"><li>'.$contract.'</li><li>'.$paymentNotice.'</li></ul></li></ul>';
            } elseif($status_id == 4) {
                return $contract;
            }

        }


        public function getPaymentNoticeForOrder($type, $user_id, $order_id)
        {
            return PaymentNotice::model()->findByAttributes(array('user_id'=>$user_id, 'type'=>$type, 'order_id'=>$order_id));   
        }

        public function leftToPay($data)
        {
            $a = 0;
            foreach($data->accounts as $account)
            {
                $a = $a + $account->income;
            }
            return $data->total_amount-$a;
        }

        public function getLatePaymentNotice() {
            $criteria = new CDbCriteria;
            $criteria->condition = 'date_due < NOW()';
            $criteria->compare('status_id', 2);
            return PaymentNotice::model()->findAll($criteria);
        }

        public function getLate()
        {
            $criteria=new CDbCriteria;
            $criteria->compare('status_id',3);

            return new CActiveDataProvider('PaymentNotice', array(
                    'criteria'=>$criteria,
                ));   
        }

        public function getBiggestLate()
        {
            $criteria=new CDbCriteria;
            $criteria->compare('status_id',3);

            $models = PaymentNotice::model()->with('accounts')->findAll($criteria);  
            $left = array();
            $i=0;            

            foreach($models as $model)
            {
                $a = 0;
                foreach($model->accounts as $account)
                {
                    $a = $a + $account->income;
                }
                $left[$i] = $model->total_amount-$a;
                $i++;
            }

            if(empty($left))
                return Yii::t('app', 'no_lates');
            else                
                return max($left);
        }    

        public function getReturned()
        {
            $criteria=new CDbCriteria;
            $criteria->compare('status_id',1);

            return new CActiveDataProvider('PaymentNotice', array(
                    'criteria'=>$criteria, ));
        }   

        public function getLastReturned()
        {
            $criteria=new CDbCriteria;
            $criteria->compare('status_id',1);
            $criteria->order = 'date_due DESC';

            return PaymentNotice::model()->find($criteria);            
        } 
}