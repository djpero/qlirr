<?php
    /**
    * This is the model class for table "account".
    *
    * The followings are the available columns in table 'account':
    * @property string $id
    * @property string $user_id
    * @property string $income
    * @property string $income_net
    * @property string $income_vat
    * @property string $outgoing
    * @property string $outgoing_net
    * @property string $outgoing_vat
    * @property string $from_account
    * @property string $to_account
    * @property string $booking_time
    * @property string $order_id
    * @property string $paymentNotice_id
    * @property string $date_document
    * @property string $date_due
    * @property string $vat
    * @property string $description
    * @property string $comment
    * @property string $time_created
    *
    * The followings are the available model relations:
    * @property Users $user
    * @property PaymentNotice $paymentNotice_id
    * @property Orders $order
    */
    class Account extends CActiveRecord
    {
        /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return Account the static model class
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
            return 'account';
        }

        /**
        * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('user_id', 'required'),
                array('user_id, order_id', 'length', 'max'=>11),
                array('income, income_net, income_vat, outgoing, outgoing_net, outgoing_vat, from_account, to_account, vat', 'length', 'max'=>10),
                array('date_document, date_due, time_created, paymentNotice_id, booking_time', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, user_id, income, income_net, paymentNotice_id, income_vat, from_account, to_account, time_booking, description, outgoing, outgoing_net, outgoing_vat, order_id, date_document, date_due, vat, comment, time_created', 'safe', 'on'=>'search'),
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
                'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
                'order' => array(self::BELONGS_TO, 'Orders', 'order_id'),
                'paymentNotice' => array(self::BELONGS_TO, 'PaymentNotice', 'paymentNotice_id'),
                'fromAccount' => array(self::BELONGS_TO, 'BankAccount', 'from_account'),
                'toAccount' => array(self::BELONGS_TO, 'BankAccount', 'to_account'),
            );
        }

        /**
        * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
                'id' => 'ID',                                                       
                'user_id' => 'User',
                'income' => Yii::t('app', 'model.account.income'),
                'income_net' => Yii::t('app', 'model.account.income_net'),
                'income_net' => Yii::t('app', 'model.account.income_vat'),
                'outgoing' => Yii::t('app', 'model.account.outgoing'),
                'outgoing_net' => Yii::t('app', 'model.account.outgoing_net'),
                'outgoing_vat' => Yii::t('app', 'model.account.outgoing_vat'),
                'from_account' => Yii::t('app', 'model.account.from_account'),
                'to_account' => Yii::t('app', 'model.account.to_account'),
                'booking_time' => Yii::t('app', 'model.account.booking_time'),
                'order_id' => 'Order',
                'paymentNotice_id' => 'Poziv na plaćanje',
                'date_document' => Yii::t('app', 'model.account.date_document'),
                'date_due' => Yii::t('app', 'model.account.date_due'),
                'vat' => Yii::t('app', 'model.account.vat'),
                'description' => Yii::t('app', 'model.account.description'),
                'comment' => Yii::t('app', 'model.account.comment'),
                'time_created' => Yii::t('app', 'model.account.time_created'),
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
            $criteria->compare('income',$this->income,true);
            $criteria->compare('income_net',$this->income_net,true);
            $criteria->compare('income_vat',$this->income_vat,true);
            $criteria->compare('outgoing',$this->outgoing,true);
            $criteria->compare('outgoing_net',$this->outgoing_net,true);
            $criteria->compare('outgoing_vat',$this->outgoing_vat,true);
            $criteria->compare('order_id',$this->order_id,true);
            $criteria->compare('date_document',$this->date_document,true);
            $criteria->compare('date_due',$this->date_due,true);
            $criteria->compare('vat',$this->vat,true);
            $criteria->compare('comment',$this->comment,true);
            $criteria->compare('time_created',$this->time_created,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                ));
        }
        
        /**
        * Retrieves a list of models based on the current search/filter conditions.
        * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
        */
        public function orderAccounts($order_id)
        {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria=new CDbCriteria;

            $criteria->compare('id',$this->id,true);
            $criteria->compare('user_id',$this->user_id,true);
            $criteria->compare('income',$this->income,true);
            $criteria->compare('income_net',$this->income_net,true);
            $criteria->compare('income_vat',$this->income_vat,true);
            $criteria->compare('outgoing',$this->outgoing,true);
            $criteria->compare('outgoing_net',$this->outgoing_net,true);
            $criteria->compare('outgoing_vat',$this->outgoing_vat,true);
            $criteria->compare('order_id',$order_id);
            $criteria->compare('date_document',$this->date_document,true);
            $criteria->compare('date_due',$this->date_due,true);
            $criteria->compare('vat',$this->vat,true);
            $criteria->compare('comment',$this->comment,true);
            $criteria->compare('time_created',$this->time_created,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                ));
        }
}