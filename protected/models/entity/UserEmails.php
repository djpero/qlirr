<?php

    /**
    * This is the model class for table "user_emails".
    *
    * The followings are the available columns in table 'user_emails':
    * @property string $id
    * @property string $user_id
    * @property string $email
    * @property integer $primary
    * @property string $description
    *
    * The followings are the available model relations:
    * @property Users $user
    */
    class UserEmails extends CActiveRecord
    {
        /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return UserEmails the static model class
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
            return 'user_emails';
        }

        /**
        * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('user_id, email', 'required'),
                array('primary', 'numerical', 'integerOnly'=>true),
                array('user_id', 'length', 'max'=>10),
                array('email', 'length', 'max'=>100),
                array('description', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, user_id, email, primary, description', 'safe', 'on'=>'search'),
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
                'email' => 'Email',
                'primary' => 'Primary',
                'description' => 'Description',
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
            $criteria->compare('email',$this->email,true);
            $criteria->compare('primary',$this->primary);
            $criteria->compare('description',$this->description,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                ));
        }
}