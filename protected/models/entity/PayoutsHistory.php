<?php

    /**
    * This is the model class for table "payouts_history".
    *
    * The followings are the available columns in table 'payouts_history':
    * @property string $id
    * @property string $payout_id
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
    * @property string $comment
    * @property integer $change_type
    * @property string $update_time
    *
    * The followings are the available model relations:
    * @property Payouts $payouts
    * @property Users $user
    * @property PayoutStatus $status
    * @property Orders $order
    */
    class PayoutsHistory extends CActiveRecord
    {
        /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return PayoutsHistory the static model class
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
            return 'payouts_history';
        }

        /**
        * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('payout_id, order_id, amount, payment_reference, payment_model, status_id, comment, change_type, update_time', 'required'),
                array('payout_id, user_id, merchant_id, order_id, amount, status_id, admin_id', 'length', 'max'=>10),
                array('payment_reference, payment_model', 'length', 'max'=>50),
                array('from_account, to_account', 'length', 'max'=>100),
                array('payment_date, payment_notice, time_created, booking_time, comment, description', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, comment, description, payout_id, user_id, merchant_id, order_id, admin_id, amount, comment, change_type, update_time, payment_date, payment_reference, payment_model, payment_notice, time_created, status_id, from_account, to_account, booking_time', 'safe', 'on'=>'search'),
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
                'payout' => array(self::BELONGS_TO, 'Payouts', 'payout_id'),
                'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
                'status' => array(self::BELONGS_TO, 'PayoutStatus', 'status_id'),
                'order' => array(self::BELONGS_TO, 'Orders', 'order_id'),
                'toAccount' => array(self::BELONGS_TO, 'BankAccount', 'to_account'),
                'fromAccount' => array(self::BELONGS_TO, 'BankAccount', 'from_account'),
            );
        }

        /**
        * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
                'id' => 'ID',
                'payout_id' => 'Payout',
                'user_id' => 'User',
                'merchant_id' => 'Merchant',
                'order_id' => 'Order',
                'amount' => 'Amount',
                'payment_date' => 'Payment Date',
                'payment_reference' => 'Payment Reference',
                'payment_model' => 'Payment Model',
                'payment_notice' => 'Payment Notice',
                'time_created' => 'Time Created',
                'status_id' => 'Status',
                'from_account' => 'From Account',
                'to_account' => 'To Account',
                'booking_time' => 'Booking Time',
                'comment' => 'Komentar',
                'description' => 'Opis',
                'admin_id' => 'Admin',
                'comment' => 'Comment',
                'change_type' => 'Change Type',
                'update_time' => 'Update Time'                
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
            $criteria->compare('payout_id',$this->payout_id,true);
            $criteria->compare('user_id',$this->user_id,true);
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
            $criteria->compare('comment',$this->comment,true);
            $criteria->compare('change_type',$this->change_type);
            $criteria->compare('update_time',$this->update_time,true);


            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                ));
        }
}