<?php

    /**
    * This is the model class for table "email_template".
    *
    * The followings are the available columns in table 'email_template':
    * @property string $id
    * @property integer $active
    * @property string $country_id
    * @property integer $recipient_type
    * @property string $internal_name
    * @property string $sender_name
    * @property string $sender_email
    * @property string $subject
    * @property string $eContent
    * @property string $time_created
    *
    * The followings are the available model relations:
    * @property Country $country
    * @property UserTypes $recipient
    */
    class EmailTemplate extends CActiveRecord
    {
        /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return EmailTemplate the static model class
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
            return 'email_template';
        }

        /**
        * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('active, country_id, recipient_type, internal_name, sender_name, sender_email, subject, eContent', 'required'),
                array('active, recipient_type', 'numerical', 'integerOnly'=>true),
                array('country_id', 'length', 'max'=>11),
                array('internal_name, sender_name, sender_email, subject', 'length', 'max'=>255),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, active, country_id, recipient_type, internal_name, sender_name, sender_email, subject, eContent, time_created', 'safe', 'on'=>'search'),
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
                'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
                'recipient' => array(self::BELONGS_TO, 'UserTypes', 'recipient_type'),
            );
        }

        /**
        * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
                'id' => 'ID',
                'active' => 'Active',
                'country_id' => Yii::t('app', 'model.email_temp.country_id'),
                'recipient_type' => Yii::t('app', 'model.email_temp.recipient_type'),
                'internal_name' => 'Internal Name',
                'sender_name' => Yii::t('app', 'model.email_temp.sender_name'),
                'sender_email' => Yii::t('app', 'model.email_temp.sender_email'),
                'subject' => Yii::t('app', 'model.email_temp.subject'),
                'eContent' => Yii::t('app', 'model.email_temp.econtent'),
                'time_created' => Yii::t('app', 'model.email_temp.time_created'),
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
            $criteria->compare('active',$this->active);
            $criteria->compare('country_id',$this->country_id,true);
            $criteria->compare('recipient_type',$this->recipient_type);
            $criteria->compare('internal_name',$this->internal_name,true);
            $criteria->compare('sender_name',$this->sender_name,true);
            $criteria->compare('sender_email',$this->sender_email,true);
            $criteria->compare('subject',$this->subject,true);
            $criteria->compare('eContent',$this->eContent,true);
            $criteria->compare('time_created',$this->time_created,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                ));
        }
}