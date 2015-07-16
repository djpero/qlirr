<?php

    /**
    * This is the model class for table "payment_notice".
    *
    * The followings are the available columns in table 'payment_notice':
    * @property string $id
    * @property string $user_id
    * @property string $service_id
    * @property string $order_id
    * @property string $status_id
    * @property string $total_amount
    * @property string $total_amount_net
    * @property string $total_amount_vat
    * @property string $vat
    * @property string $min_amount
    * @property string $currency_code
    * @property string $date_issued
    * @property string $date_due
    * @property string $period_start
    * @property string $period_end
    * @property string $comment
    * @property string $payment_reference_model
    * @property string $payment_reference
    * @property string $type
    * @property string $time_created
    *
    * The followings are the available model relations:
    * @property Currency $currencyCode
    * @property Users $user
    * @property Service $service
    * @property Account[] $accounts
    */
    class PaymentNotice extends CActiveRecord
    {
        public $left;

        /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return PaymentNotice the static model class
        */
        public static function model($className=__CLASS__)
        {
            return parent::model($className);
        }

        /**
        * @return string the associated database table name
        */
        public function tableName()
        {
            return 'payment_notice';
        }

        /**
        * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('user_id, service_id, total_amount, min_amount, order_id, status_id, currency_code, date_due', 'required'),
                array('user_id, service_id, order_id, status_id, currency_code, total_amount, total_amount_net, total_amount_vat, vat, min_amount', 'length', 'max'=>10),
                array('type', 'length', 'max'=>10),
                array('comment', 'length', 'max'=>1000),
                array('payment_reference_model', 'length', 'max'=>6),
                array('payment_reference', 'length', 'max'=>50),
                array('date_issued, period_start, period_end', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, user_id, service_id, order_id, type, status_id, total_amount, total_amount_net, total_amount_vat, vat, min_amount, currency_code, date_issued, date_due, period_start, period_end, comment, payment_reference_model, payment_reference, time_created', 'safe', 'on'=>'search'),
            );
        }

        /**
        * @return array relational rules.
        */
        public function relations()
        {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array(
                'currencyCode' => array(self::BELONGS_TO, 'Currency', 'currency_code'),
                'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
                'service' => array(self::BELONGS_TO, 'Service', 'service_id'),
                'accounts' => array(self::HAS_MANY, 'Account', 'paymentNotice_id'),
                'orders' => array(self::BELONGS_TO, 'Orders', 'order_id'),
                'status' => array(self::BELONGS_TO, 'PaymentNoticeStatus', 'status_id'),
            );
        }

        /**
        * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
                'id' => 'ID',
                'user_id' => Yii::t('app', 'model.payment_notice.user_id'),
                'service_id' => Yii::t('app', 'model.payment_notice.service_id'),
                'order_id' => Yii::t('app', 'model.payment_notice.order_id'),
                'status_id' => 'Status',
                'total_amount' => Yii::t('app', 'model.payment_notice.total_amount'),
                'total_amount_net' => 'Total Amount Net',
                'total_amount_vat' => 'Total Amount Vat',
                'vat' => 'Vat',
                'min_amount' => Yii::t('app', 'model.payment_notice.min_amount'),
                'currency_code' => Yii::t('app', 'model.payment_notice.currency_code'),
                'date_issued' => Yii::t('app', 'model.payment_notice.date_issued'),
                'date_due' => Yii::t('app', 'model.payment_notice.date_due'),
                'period_start' => 'Period Start',
                'period_end' => 'Period End',
                'comment' => Yii::t('app', 'model.payment_notice.comment'),
                'payment_reference_model' => 'Payment Reference Model',
                'payment_reference' => 'Payment Reference',
                'type' => Yii::t('app', 'model.payment_notice.type'),
                'time_created' => Yii::t('app', 'model.payment_notice.time_created'),
            );
        }

        /**
        * Retrieves a list of models based on the current search/filter conditions.
        * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
        */
        public function search()
        {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria=new CDbCriteria;

            $criteria->compare('id',$this->id,true);
            $criteria->compare('user_id',$this->user_id,true);
            $criteria->compare('service_id',$this->service_id,true);
            $criteria->compare('order_id',$this->order_id,true);
            $criteria->compare('status_id',$this->status_id,true);
            $criteria->compare('total_amount',$this->total_amount,true);
            $criteria->compare('total_amount_net',$this->total_amount_net,true);
            $criteria->compare('total_amount_vat',$this->total_amount_vat,true);
            $criteria->compare('vat',$this->vat,true);
            $criteria->compare('min_amount',$this->min_amount,true);
            $criteria->compare('currency_code',$this->currency_code,true);
            $criteria->compare('date_issued',$this->date_issued,true);
            $criteria->compare('date_due',$this->date_due,true);
            $criteria->compare('period_start',$this->period_start,true);
            $criteria->compare('period_end',$this->period_end,true);
            $criteria->compare('comment',$this->comment,true);
            $criteria->compare('payment_reference_model',$this->payment_reference_model,true);
            $criteria->compare('payment_reference',$this->payment_reference,true);
            $criteria->compare('type',$this->type,true);
            $criteria->compare('time_created',$this->time_created,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                ));
        }

        public function searchByUser($id)
        {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria=new CDbCriteria;

            $criteria->compare('id',$this->id,true);
            $criteria->compare('user_id',$id);
            $criteria->compare('service_id',$this->service_id,true);
            $criteria->compare('order_id',$this->order_id,true);
            $criteria->compare('status_id',$this->status_id,true);
            $criteria->compare('total_amount',$this->total_amount,true);
            $criteria->compare('total_amount_net',$this->total_amount_net,true);
            $criteria->compare('total_amount_vat',$this->total_amount_vat,true);
            $criteria->compare('vat',$this->vat,true);
            $criteria->compare('min_amount',$this->min_amount,true);
            $criteria->compare('currency_code',$this->currency_code,true);
            $criteria->compare('date_issued',$this->date_issued,true);
            $criteria->compare('date_due',$this->date_due,true);
            $criteria->compare('period_start',$this->period_start,true);
            $criteria->compare('period_end',$this->period_end,true);
            $criteria->compare('comment',$this->comment,true);
            $criteria->compare('payment_reference_model',$this->payment_reference_model,true);
            $criteria->compare('payment_reference',$this->payment_reference,true);
            $criteria->compare('type',$this->type,true);
            $criteria->compare('time_created',$this->time_created,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                ));
        }

        public function late()
        {
            $criteria=new CDbCriteria;

            $criteria->compare('id',$this->id,true);
            $criteria->compare('user_id',$this->user_id,true);
            $criteria->compare('service_id',$this->service_id,true);
            $criteria->compare('order_id',$this->order_id,true);
            $criteria->compare('status_id',3);
            $criteria->compare('total_amount',$this->total_amount,true);
            //$criteria->compare('total_amount_net',$this->total_amount_net,true);
            //$criteria->compare('total_amount_vat',$this->total_amount_vat,true);
            //$criteria->compare('vat',$this->vat,true);
            $criteria->compare('min_amount',$this->min_amount,true);
            $criteria->compare('currency_code',$this->currency_code,true);
            $criteria->compare('date_issued',$this->date_issued,true);
            $criteria->compare('period_start',$this->period_start,true);
            $criteria->compare('period_end',$this->period_end,true);
            $criteria->compare('comment',$this->comment,true);
            $criteria->compare('type',$this->type,true);
            $criteria->compare('payment_reference_model',$this->payment_reference_model,true);
            $criteria->compare('payment_reference',$this->payment_reference,true);
            $criteria->compare('time_created',$this->time_created,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria, 'sort'=>array('defaultOrder'=>'time_created DESC')
                ));
        }

        public function returnedPartial()
        {
            $criteria=new CDbCriteria;

            $criteria->compare('id',$this->id,true);
            $criteria->compare('user_id',$this->user_id,true);
            $criteria->compare('service_id',$this->service_id,true);
            $criteria->compare('order_id',$this->order_id,true);
            $criteria->compare('status_id',2);
            $criteria->compare('total_amount',$this->total_amount,true);
            $criteria->compare('min_amount',$this->min_amount,true);
            $criteria->compare('currency_code',$this->currency_code,true);
            $criteria->compare('date_issued',$this->date_issued,true);
            $criteria->compare('period_start',$this->period_start,true);
            $criteria->compare('period_end',$this->period_end,true);
            $criteria->compare('comment',$this->comment,true);
            $criteria->compare('type',$this->type,true);
            $criteria->compare('payment_reference_model',$this->payment_reference_model,true);
            $criteria->compare('payment_reference',$this->payment_reference,true);
            //$now = new CDbExpression("NOW()");
            // $criteria->addCondition('date_due >= "'.$now.'" ');

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria, 'sort'=>array('defaultOrder'=>'time_created DESC')
                ));
        }

        public function paid()
        {
            $criteria=new CDbCriteria;

            $criteria->compare('id',$this->id,true);
            $criteria->compare('user_id',$this->user_id,true);
            $criteria->compare('service_id',$this->service_id,true);
            $criteria->compare('order_id',$this->order_id,true);
            $criteria->compare('status_id',1);
            $criteria->compare('total_amount',$this->total_amount,true);
            $criteria->compare('min_amount',$this->min_amount,true);
            $criteria->compare('currency_code',$this->currency_code,true);
            $criteria->compare('date_issued',$this->date_issued,true);
            $criteria->compare('period_start',$this->period_start,true);
            $criteria->compare('period_end',$this->period_end,true);
            $criteria->compare('payment_reference_model',$this->payment_reference_model,true);
            $criteria->compare('payment_reference',$this->payment_reference,true);
            $criteria->compare('comment',$this->comment,true);
            $criteria->compare('type',$this->type,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria, 'sort'=>array('defaultOrder'=>'time_created DESC')
                ));
        }

        public function getPaymentNoticeSeller()
        {
            $criteria = new CDbCriteria;
            $criteria->compare('status_id', $this->status_id);
            $criteria->compare('type', 2);
            $criteria->addCondition('date_issued is NOT NULL');
            $criteria->compare('user_id', CheckFunctions::userId());
            return new CActiveDataProvider($this, array('criteria'=>$criteria,));
        }

        public function getPaymentNoticeBuyer()
        {
            $criteria = new CDbCriteria;
            $criteria->compare('status_id', $this->status_id);
            $criteria->addCondition('date_issued is NOT NULL AND (type = 1 OR type = 3)');
            $criteria->compare('user_id', CheckFunctions::userId());
            return new CActiveDataProvider($this, array('criteria'=>$criteria,));
        }

}