<?php

    /**
    * This is the model class for table "invoice".
    *
    * The followings are the available columns in table 'invoice':
    * @property string $id
    * @property integer $invoice_status
    * @property string $invoice_number
    * @property string $user_id
    * @property string $date_issued
    * @property string $date_due
    * @property string $total_amount
    * @property string $time_created
    *
    * The followings are the available model relations:
    * @property Users $user
    * @property InvoiceItem[] $invoiceItems
    */
    class Invoice extends CActiveRecord
    {
        /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return Invoice the static model class
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
            return 'invoice';
        }

        /**
        * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('invoice_status, user_id, date_issued, total_amount', 'required'),
                array('invoice_status', 'numerical', 'integerOnly'=>true),
                array('user_id', 'length', 'max'=>11),
                array('total_amount', 'length', 'max'=>10),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, invoice_status, user_id, date_issued, total_amount, time_created', 'safe', 'on'=>'search'),
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
                'invoiceItems' => array(self::HAS_MANY, 'InvoiceItem', 'invoice_id'),
            );
        }

        /**
        * @return array customized attribute labels (name=>label)
        */


        /**
        * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
                'id' => 'ID',
                'invoice_status' => 'Invoice Status',
                'user_id' => 'User',
                'date_issued' => 'Date Issued',
                'total_amount' => 'Total Amount',
                'time_created' => 'Time Created',
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
            $criteria->compare('invoice_status',$this->invoice_status);
            $criteria->compare('user_id',$this->user_id,true);
            $criteria->compare('date_issued',$this->date_issued,true);
            $criteria->compare('total_amount',$this->total_amount,true);
            $criteria->compare('time_created',$this->time_created,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                ));
        }
}