<?php

    /**
    * This is the model class for table "orders".
    *
    * The followings are the available columns in table 'orders':
    * @property string $id
    * @property string $service_id
    * @property string $orderStatus_id
    * @property string $buyer_id
    * @property string $merchant_id
    * @property string $seller_id
    * @property string $paymentMethod_id
    * @property string $shippingAddress_id
    * @property string $country_id
    * @property string $date_issued
    * @property string $date_accepted
    * @property string $date_sent
    * @property string $date_delivered
    * @property string $order_reference
    * @property string $total_amount
    * @property string $reason
    * @property string $comment
    * @property string $time_created
    * @property string $code
    * @property string $ip_address
    *
    * The followings are the available model relations:
    * @property Account[] $accounts
    * @property Documents[] $documents
    * @property OrderItem[] $orderItems
    * @property PaymentNotice[] $paymentNotice
    * @property Service $service
    * @property OrderStatus $orderStatus
    * @property UserAddress $shippingAddress
    * @property Users $buyer
    * @property Users $seller
    * @property PaymentMethod $paymentMethod
    */
    class Orders extends CActiveRecord
    {
        /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return Orders the static model class
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
            return 'orders';
        }

        /**
        * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('service_id, orderStatus_id', 'required'),
                array('service_id, orderStatus_id, buyer_id, merchant_id, seller_id, shippingAddress_id', 'length', 'max'=>11),
                array('order_reference', 'length', 'max'=>100),
                array('total_amount', 'length', 'max'=>10),
                array('reason, comment', 'length', 'max'=>500),
                array('code', 'length', 'max'=>50),
                array('ip_address', 'length', 'max'=>30),
                array('date_issued, date_sent, date_accepted, date_delivered', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, service_id, orderStatus_id, shippingAddress_id, ip_address, buyer_id, seller_id, paymentMethod_id, date_issued, date_accepted, date_sent, date_delivered, order_reference, total_amount, reason, comment, time_created, code', 'safe', 'on'=>'search'),
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
                'accounts' => array(self::HAS_MANY, 'Account', 'order_id'),
                'documents' => array(self::HAS_MANY, 'Documents', 'order_id'),
                'orderItems' => array(self::HAS_MANY, 'OrderItem', 'order_id'),
                'paymentNotice' => array(self::HAS_MANY, 'PaymentNotice', 'order_id'),
                'shippingAddress' => array(self::BELONGS_TO, 'UserAddress', 'shippingAddress_id'),
                'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
                'paymentMethod' => array(self::BELONGS_TO, 'PaymentMethod', 'paymentMethod_id'),
                'service' => array(self::BELONGS_TO, 'Service', 'service_id'),
                'orderStatus' => array(self::BELONGS_TO, 'OrderStatus', 'orderStatus_id'),
                'buyer' => array(self::BELONGS_TO, 'Users', 'buyer_id'),
                'seller' => array(self::BELONGS_TO, 'Users', 'seller_id'),
            );
        }

        /**
        * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
                'id' => 'ID',
                'service_id' => Yii::t('app', 'model.orders.service'),
                'orderStatus_id' => Yii::t('app', 'model.orders.orderStatus_id'),
                'buyer_id' => Yii::t('app', 'model.orders.buyer_id'),
                'merchant_id' => 'Merchant',
                'seller_id' => Yii::t('app', 'model.orders.seller_id'),
                'paymentMethod_id' => Yii::t('app', 'model.orders.paymentMethod_id'),
                'shippingAddress_id' => Yii::t('app', 'model.orders.shippingAddress_id'),
                'country_id' => Yii::t('app', 'model.orders.country_id'),
                'date_issued' => Yii::t('app', 'model.orders.date_issued'),
                'date_accepted' => Yii::t('app', 'model.orders.date_accepted'),
                'date_sent' => Yii::t('app', 'model.orders.date_sent'),
                'date_delivered' => Yii::t('app', 'model.orders.date_delivered'),
                'order_reference' => Yii::t('app', 'model.orders.reference'),
                'total_amount' => Yii::t('app', 'model.orders.total_amount'),
                'reason' => Yii::t('app', 'model.orders.reason'),
                'comment' => Yii::t('app', 'model.orders.comment'),
                'time_created' => Yii::t('app', 'model.orders.time_created'),
                'code' => Yii::t('app', 'model.orders.code'),
                'ip_address' => Yii::t('app', 'Ip Address'),
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
            $criteria->compare('service_id',$this->service_id,true);
            $criteria->compare('orderStatus_id',$this->orderStatus_id,true);
            $criteria->compare('buyer_id',$this->buyer_id,true);
            $criteria->compare('merchant_id',$this->merchant_id,true);
            $criteria->compare('seller_id',$this->seller_id,true);
            $criteria->compare('paymentMethod_id',$this->paymentMethod_id,true);
            $criteria->compare('shippingAddress_id',$this->shippingAddress_id,true);
            $criteria->compare('country_id',$this->country_id,true);
            $criteria->compare('date_issued',$this->date_issued,true);
            $criteria->compare('date_accepted',$this->date_accepted,true);
            $criteria->compare('date_sent',$this->date_sent,true);
            $criteria->compare('date_delivered',$this->date_delivered,true);
            $criteria->compare('order_reference',$this->order_reference,true);
            $criteria->compare('total_amount',$this->total_amount,true);
            $criteria->compare('reason',$this->reason,true);
            $criteria->compare('comment',$this->comment,true);
            $criteria->compare('time_created',$this->time_created,true);
            $criteria->compare('code',$this->code,true);
            $criteria->compare('ip_address',$this->ip_address,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria, 'pagination'=>array('pageSize'=>30),
                    'sort'=>array('defaultOrder'=>'time_created DESC')
                ));
        }

        public function getReceivedOfferByUserId()
        {
            $criteria = new CDbCriteria;
            $criteria->compare('orderStatus_id',$this->orderStatus_id,true);
            $criteria->addCondition('seller_id = ' . CheckFunctions::userId());
            return new CActiveDataProvider($this, array('criteria'=>$criteria,));
        }

        public function getSentOfferByUserId()
        {
            $criteria = new CDbCriteria;
            $criteria->compare('orderStatus_id',$this->orderStatus_id,true);
            $criteria->addCondition('buyer_id = ' . CheckFunctions::userId());
            return new CActiveDataProvider($this, array('criteria'=>$criteria,));
        }

        public function complain()
        {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria=new CDbCriteria;

            $criteria->compare('id',$this->id,true);
            $criteria->compare('service_id',$this->service_id,true);
            $criteria->compare('buyer_id',$this->buyer_id,true);
            $criteria->compare('merchant_id',$this->merchant_id,true);
            $criteria->compare('seller_id',$this->seller_id,true);
            $criteria->compare('paymentMethod_id',$this->paymentMethod_id,true);
            $criteria->compare('shippingAddress_id',$this->shippingAddress_id,true);
            $criteria->compare('country_id',$this->country_id,true);
            $criteria->compare('date_issued',$this->date_issued,true);
            $criteria->compare('date_accepted',$this->date_accepted,true);
            $criteria->compare('date_sent',$this->date_sent,true);
            $criteria->compare('date_delivered',$this->date_delivered,true);
            $criteria->compare('order_reference',$this->order_reference,true);
            $criteria->compare('total_amount',$this->total_amount,true);
            $criteria->compare('reason',$this->reason,true);
            $criteria->compare('comment',$this->comment,true);
            $criteria->compare('img_path',$this->img_path,true);
            $criteria->compare('time_created',$this->time_created,true);
            $criteria->compare('code',$this->code,true);
            $criteria->compare('ip_address',$this->ip_address,true);
            $criteria->addCondition('(orderStatus_id = 7 OR orderStatus_id = 10 OR orderStatus_id = 11 OR orderStatus_id = 14 OR orderStatus_id = 15 OR orderStatus_id = 16 )');

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria, 'pagination'=>array('pageSize'=>30),
                    'sort'=>array('defaultOrder'=>'time_created DESC')
                ));
        }

}