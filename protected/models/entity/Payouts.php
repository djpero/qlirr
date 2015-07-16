<?php

    /**
    * This is the model class for table "payouts".
    *
    * The followings are the available columns in table 'payouts':
    * @property string $id
    * @property string $user_id
    * @property string $merchant_id
    * @property string $order_id
    * @property string $amount
    * @property string $payment_date
    * @property string $payment_reference
    * @property string $payment_model
    * @property string $payment_notice
    * @property string $time_created
    * @property string $status_id
    * @property string $from_account
    * @property string $to_account
    * @property string $booking_time
    * @property string $comment
    * @property string $description
    * @property string $admin_id
    *
    * The followings are the available model relations:
    * @property PayoutStatus $status
    * @property Users $user
    */
    class Payouts extends CActiveRecord
    {
        public $sumAmount;

        /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return Payouts the static model class
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
            return 'payouts';
        }

        /**
        * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('order_id, amount, payment_reference, payment_model, status_id', 'required'),
                array('user_id, merchant_id, amount, status_id, admin_id, user_verified', 'length', 'max'=>10),
                array('payment_reference, payment_model', 'length', 'max'=>50),
                array('from_account, to_account', 'length', 'max'=>100),
                array('payment_notice, time_created, comment, description, booking_time', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, comment, description, booking_time, admin_id, from_account, to_account, user_id, merchant_id, order_id, amount, payment_date, payment_reference, payment_model, payment_notice, time_created, status_id', 'safe', 'on'=>'search'),
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
                'order' => array(self::BELONGS_TO, 'Orders', 'order_id'),
                'status' => array(self::BELONGS_TO, 'PayoutStatus', 'status_id'),
                'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
                'order' => array(self::BELONGS_TO, 'Orders', 'order_id'),
                'userBankAccount' => array(self::BELONGS_TO, 'BankAccount', 'to_account'),
                'ourBankAccount' => array(self::BELONGS_TO, 'BankAccount', 'from_account'),
            );
        }

        /**
        * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
                'id' => 'ID',
                'user_id' => Yii::t('app', 'model.payouts.user_id'),
                'user_verified' => Yii::t('app', 'model.payouts.user_verified'),
                'merchant_id' => 'Merchant',
                'order_id' => Yii::t('app', 'model.payouts.order_id'),
                'amount' => Yii::t('app', 'model.payouts.amount'),
                'payment_date' => Yii::t('app', 'model.payouts.payment_date'),
                'payment_reference' => 'Payment Reference',
                'payment_model' => 'Payment Model',
                'payment_notice' => Yii::t('app', 'model.payouts.payment_notice'),
                'time_created' => Yii::t('app', 'model.payouts.time_created'),
                'status_id' => 'Status',
                'from_account' => 'Sa računa',
                'to_account' => 'Na račun',
                'booking_time' => 'Datum knjiženja',
                'comment' => 'Komentar',
                'description' => 'Opis',
                'admin_id' => 'Admin',
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
            $criteria->compare('user_verified',$this->user_verified,true);
            $criteria->compare('merchant_id',$this->merchant_id,true);
            $criteria->compare('order_id',$this->order_id,true);
            $criteria->compare('amount',$this->amount,true);
            $criteria->compare('payment_date',$this->payment_date,true);
            $criteria->compare('payment_reference',$this->payment_reference,true);
            $criteria->compare('payment_model',$this->payment_model,true);
            $criteria->compare('payment_notice',$this->payment_notice,true);
            $criteria->compare('time_created',$this->time_created,true);
            $criteria->compare('status_id',$this->status_id,true);
            $criteria->compare('from_account',$this->from_account,true);
            $criteria->compare('to_account',$this->to_account,true);
            $criteria->compare('booking_time',$this->booking_time,true);
            $criteria->compare('comment',$this->comment,true);
            $criteria->compare('description',$this->description,true);
            $criteria->compare('admin_id',$this->admin_id,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                ));
        }

        public function forPayment()
        {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria=new CDbCriteria;

            $criteria->compare('id',$this->id,true);
            $criteria->compare('user_id',$this->user_id,true);
            $criteria->compare('user_verified',$this->user_verified,true);
            $criteria->compare('order_id',$this->order_id,true);
            $criteria->compare('amount',$this->amount,true);
            $criteria->compare('payment_date',$this->payment_date,true);
            $criteria->compare('payment_reference',$this->payment_reference,true);
            $criteria->compare('payment_model',$this->payment_model,true);
            $criteria->compare('payment_notice',$this->payment_notice,true);
            $criteria->compare('time_created',$this->time_created,true);
            $criteria->addCondition('status_id = 1');
            $criteria->compare('from_account',$this->from_account,true);
            $criteria->compare('to_account',$this->to_account,true);
            $criteria->compare('booking_time',$this->booking_time,true);
            $criteria->compare('comment',$this->comment,true);
            $criteria->compare('description',$this->description,true);
            $criteria->compare('admin_id',$this->admin_id,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria, 'sort'=>array('defaultOrder'=>'time_created DESC')
                ));
        }

        public function wePaid()
        {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria=new CDbCriteria;

            $criteria->compare('id',$this->id,true);
            $criteria->compare('user_id',$this->user_id,true);
            $criteria->compare('user_verified',$this->user_verified,true);
            $criteria->compare('order_id',$this->order_id,true);
            $criteria->compare('amount',$this->amount,true);
            $criteria->compare('payment_date',$this->payment_date,true);
            $criteria->compare('payment_reference',$this->payment_reference,true);
            $criteria->compare('payment_model',$this->payment_model,true);
            $criteria->compare('payment_notice',$this->payment_notice,true);
            $criteria->compare('time_created',$this->time_created,true);
            $criteria->compare('status_id',3);
            $criteria->compare('from_account',$this->from_account,true);
            $criteria->compare('to_account',$this->to_account,true);
            $criteria->compare('booking_time',$this->booking_time,true);
            $criteria->compare('comment',$this->comment,true);
            $criteria->compare('description',$this->description,true);
            $criteria->compare('admin_id',$this->admin_id,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria, 'sort'=>array('defaultOrder'=>'time_created DESC')
                ));
        }
}