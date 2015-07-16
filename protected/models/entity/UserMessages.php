<?php

    /**
    * This is the model class for table "user_messages".
    *
    * The followings are the available columns in table 'user_messages':
    * @property string $id
    * @property integer $status
    * @property string $receiver_id
    * @property string $sender_id
    * @property integer $msgType_id
    * @property string $subject
    * @property string $content
    * @property string $time_created
    *
    * The followings are the available model relations:
    * @property Users $receiver
    * @property Users $sender
    * @property MsgTypes $msgType
    */
    class UserMessages extends CActiveRecord
    {
        /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return UserMessages the static model class
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
            return 'user_messages';
        }

        /**
        * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('receiver_id, sender_id, msgType_id, subject, content', 'required'),
                array('status, msgType_id', 'numerical', 'integerOnly'=>true),
                array('receiver_id, sender_id', 'length', 'max'=>11),
                array('subject', 'length', 'max'=>255),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, status, receiver_id, sender_id, msgType_id, subject, content, time_created', 'safe', 'on'=>'search'),
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
                'receiver' => array(self::BELONGS_TO, 'Users', 'receiver_id'),
                'sender' => array(self::BELONGS_TO, 'Users', 'sender_id'),
                'msgType' => array(self::BELONGS_TO, 'MsgTypes', 'msgType_id'),
            );
        }

        /**
        * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
                'id' => 'ID',
                'new' => Yii::t('app', 'model.user_messages.new'),
                'receiver_id' => Yii::t('app', 'model.user_messages.receiver_id'),
                'sender_id' => Yii::t('app', 'model.user_messages.sender_id'),
                'msgType_id' => Yii::t('app', 'model.user_messages.msgType_id'),
                'subject' => Yii::t('app', 'model.user_messages.subject'),
                'content' => Yii::t('app', 'model.user_messages.content'),
                'time_created' => Yii::t('app', 'model.user_messages.time_created'),
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
            $criteria->compare('status',$this->status);
            $criteria->compare('receiver_id',$this->receiver_id,true);
            $criteria->compare('sender_id',$this->sender_id,true);
            $criteria->compare('msgType_id',$this->msgType_id);
            $criteria->compare('subject',$this->subject,true);
            $criteria->compare('content',$this->content,true);
            $criteria->compare('time_created',$this->time_created,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria, 'sort'=>array('defaultOrder'=>'time_created DESC')
                ));
        }
}