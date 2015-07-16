<?php

    /**
    * This is the model class for table "documents".
    *
    * The followings are the available columns in table 'documents':
    * @property string $id
    * @property string $user_id
    * @property string $order_id
    * @property string $documentType_id
    * @property string $name
    * @property string $created_date
    * @property string $tracking_number
    * @property string $date_sent
    * @property string $date_delivered
    *
    * The followings are the available model relations:
    * @property Orders $order
    * @property Users $user
    */
    class Documents extends CActiveRecord
    {
        /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return Documents the static model class
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
            return 'documents';
        }

        /**
        * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('user_id, documentType_id, name', 'required'),
                array('user_id, order_id, documentType_id', 'length', 'max'=>10),
                array('tracking_number', 'length', 'max'=>11),
                array('name', 'length', 'max'=>100),
                array('created_date, date_sent, date_delivered', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, user_id, order_id, documentType_id, name, created_date, tracking_number, date_sent, date_delivered', 'safe', 'on'=>'search'),
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
                'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
                'type' => array(self::BELONGS_TO, 'DocumentType', 'documentType_id'),
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
                'order_id' => 'Order',
                'documentType_id' => 'Document Type',
                'name' => 'Name',
                'created_date' => 'Created Date',
                'tracking_number' => 'Tracking Number',
                'date_sent' => 'Date Sent',
                'date_delivered' => 'Date Delivered',
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
            $criteria->compare('order_id',$this->order_id,true);
            $criteria->compare('documentType_id',$this->documentType_id,true);
            $criteria->compare('name',$this->name,true);
            $criteria->compare('created_date',$this->created_date,true);
            $criteria->compare('tracking_number',$this->tracking_number,true);
            $criteria->compare('date_sent',$this->date_sent,true);
            $criteria->compare('date_delivered',$this->date_delivered,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                ));
        }
}