<?php

    /**
    * This is the model class for table "users_history".
    *
    * The followings are the available columns in table 'users_history':
    * @property string $id
    * @property string $user_id
    * @property string $name
    * @property string $surname
    * @property string $password
    * @property string $passwordUpdate_at
    * @property string $email
    * @property string $id_number
    * @property string $personal_number
    * @property string $gender
    * @property integer $age
    * @property string $mobile_number
    * @property string $country_id
    * @property string $credit_limit
    * @property string $creditLimit_remaining
    * @property string $creditLimit_expends
    * @property string $creditLimit_date
    * @property string $reset_code
    * @property string $reset_time
    * @property integer $status
    * @property string $create_at
    * @property string $lastVisit_at
    * @property string $userType_id
    * @property integer $newsletter
    * @property integer $verification
    * @property integer $verification_document
    * @property string $ip_address
    * @property string $comment
    * @property integer $change_type
    * @property string $update_time
    *
    * The followings are the available model relations:
    * @property Users $user
    * @property Country $country
    * @property UserTypes $userType
    */
    class UsersHistory extends CActiveRecord
    {
        /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return UsersHistory the static model class
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
            return 'users_history';
        }

        /**
        * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('user_id, name, surname, id_number, mobile_number, comment, change_type, update_time', 'required'),
                array('age, status, newsletter, verification, verification_document change_type', 'numerical', 'integerOnly'=>true),
                array('user_id, credit_limit, creditLimit_remaining, creditLimit_expends', 'length', 'max'=>10),
                array('name, surname', 'length', 'max'=>50),
                array('password, email', 'length', 'max'=>128),
                array('id_number, personal_number', 'length', 'max'=>30),
                array('gender', 'length', 'max'=>1),
                array('mobile_number', 'length', 'max'=>100),
                array('country_id, userType_id', 'length', 'max'=>11),
                array('reset_code', 'length', 'max'=>8),
                array('comment', 'length', 'max'=>150),
                array('ip_address', 'length', 'max'=>15),
                array('passwordUpdate_at, creditLimit_date, reset_time, create_at, lastVisit_at', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, user_id, name, surname, password, passwordUpdate_at, email, id_number, personal_number, gender, age, mobile_number, country_id, credit_limit, creditLimit_remaining, creditLimit_expends, creditLimit_date, reset_code, reset_time, status, create_at, lastVisit_at, userType_id, newsletter, ip_address, verification_document, verification, comment, change_type, update_time', 'safe', 'on'=>'search'),
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
                'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
                'userType' => array(self::BELONGS_TO, 'UserTypes', 'userType_id'),
            );
        }

        /**
        * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
                'id' => 'ID',
                'name' => Yii::t('app', 'model.users.name'),
                'surname' => Yii::t('app', 'model.users.surname'),
                'password' => Yii::t('app', 'model.users.password'),
                'old_password' => Yii::t('app', 'model.users.old_password'),
                'repeat_password' => Yii::t('app', 'model.users.repeat_password'),
                'email' => Yii::t('app', 'model.users.email'),
                'id_number' => Yii::t('app', 'model.users.id_number'),
                'personal_number' => Yii::t('app', 'model.users.personal_number'),
                'gender' => 'Gender',
                'age' => 'Age',
                'mobile_number' => Yii::t('app', 'model.users.mobile'),
                'country_id' => Yii::t('app', 'model.users.country'),
                'credit_limit' => Yii::t('app', 'model.users.credit_limit'),
                'creditLimit_expends' => 'Credit Limit Expends',
                'creditLimit_date' => 'Credit Limit Date',
                'crediLimit_date' => Yii::t('app', 'model.users.creditLimit_date'),
                'reset_code' => 'Reset Code',
                'reset_time' => 'Reset Time',
                'status' => 'Status',
                'create_at' => 'Create At',
                'lastVisit_at' => 'Lastvisit At',
                'passwordUpdate_at' => 'Password Update At',
                'userType_id' => 'User Type',
                'newsletter' => Yii::t('app', 'model.users.newsletter'),
                'verification' => Yii::t('app', 'model.users.percentage'),
                'verification_document' => 'Verification Document',
                'ip_address' => 'Ip Address',
                'comment' => 'Comment',
                'change_type' => 'Change Type',
                'update_time' => 'Update Time',
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
            $criteria->compare('name',$this->name,true);
            $criteria->compare('surname',$this->surname,true);
            $criteria->compare('password',$this->password,true);
            $criteria->compare('passwordUpdate_at',$this->passwordUpdate_at,true);
            $criteria->compare('email',$this->email,true);
            $criteria->compare('id_number',$this->id_number,true);
            $criteria->compare('personal_number',$this->personal_number,true);
            $criteria->compare('gender',$this->gender,true);
            $criteria->compare('age',$this->age);
            $criteria->compare('mobile_number',$this->mobile_number,true);
            $criteria->compare('country_id',$this->country_id,true);
            $criteria->compare('credit_limit',$this->credit_limit,true);
            $criteria->compare('creditLimit_remaining',$this->creditLimit_remaining,true);
            $criteria->compare('creditLimit_expends',$this->creditLimit_expends,true);
            $criteria->compare('creditLimit_date',$this->creditLimit_date,true);
            $criteria->compare('reset_code',$this->reset_code,true);
            $criteria->compare('reset_time',$this->reset_time,true);
            $criteria->compare('status',$this->status);
            $criteria->compare('create_at',$this->create_at,true);
            $criteria->compare('lastVisit_at',$this->lastVisit_at,true);
            $criteria->compare('userType_id',$this->userType_id,true);
            $criteria->compare('newsletter',$this->newsletter);
            $criteria->compare('verification',$this->verification);
            $criteria->compare('verification_document',$this->verification_document);
            $criteria->compare('ip_address',$this->ip_address);
            $criteria->compare('comment',$this->comment,true);
            $criteria->compare('change_type',$this->change_type);
            $criteria->compare('update_time',$this->update_time,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                ));
        }
}