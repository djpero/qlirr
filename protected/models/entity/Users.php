<?php

    /**
    * This is the model class for table "users".
    *
    * The followings are the available columns in table 'users':
    * @property string $id
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
    * @property integer $creditLimit_manual
    * @property string $creditLimit_remaining
    * @property string $creditLimit_expends
    * @property string $creditLimit_reserved
    * @property string $creditLimit_date
    * @property string $reset_code
    * @property string $reset_time
    * @property integer $status
    * @property string $create_at
    * @property string $time_deactivated
    * @property string $lastVisit_at
    * @property string $userType_id
    * @property integer $newsletter
    * @property integer $verification
    * @property integer $verification_document
    * @property string $ip_address
    * @property string $seller
    *
    * The followings are the available model relations:
    * @property Account[] $accounts
    * @property BankAccount[] $bankAccounts
    * @property Documents[] $documents
    * @property Invoice[] $invoices
    * @property InstantorXml[] $instantorXml
    * @property Orders[] $orders
    * @property Orders[] $orders1
    * @property UserAddress[] $userAddresses
    * @property UserEmails[] $userEmails
    * @property UserHistory[] $userHistories
    * @property UserMessages[] $userMessages
    * @property UserMessages[] $userMessages1
    * @property UserPhoneNumbers[] $userPhoneNumbers
    * @property Country $country
    * @property UserTypes $userType
    */
    class Users extends CActiveRecord
    {
        public $repeat_password;
        public $repeat_email;
        public $old_password;

        /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return Users the static model class
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
            return 'users';
        }

        /**
        * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('mobile_number', 'required'),
                array('age, status, newsletter, verification, verification_document', 'numerical', 'integerOnly'=>true),
                array('name, surname', 'length', 'max'=>50),
                array('password, email', 'length', 'max'=>128),
                array('id_number, personal_number', 'length', 'max'=>30),
                array('gender, creditLimit_manual, seller', 'length', 'max'=>1),
                array('mobile_number', 'length', 'max'=>100),
                array('country_id, userType_id', 'length', 'max'=>11),
                array('credit_limit, creditLimit_remaining, creditLimit_manual, creditLimit_expends, creditLimit_reserved', 'length', 'max'=>10),
                array('reset_code', 'length', 'max'=>8),
                array('ip_address', 'length', 'max'=>15),
                array('passwordUpdate_at, creditLimit_date, creditLimit_manual, time_deactivated, reset_time, create_at, lastVisit_at', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, name, surname, password, passwordUpdate_at, ip_address, time_deactivated, verification_document, email, id_number, personal_number, gender, age, mobile_number, country_id, credit_limit, creditLimit_remaining, creditLimit_expends, creditLimit_reserved, creditLimit_date, reset_code, reset_time, status, create_at, lastVisit_at, userType_id, newsletter, verification', 'safe', 'on'=>'search'),
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
                'accounts' => array(self::HAS_MANY, 'Account', 'user_id'),
                'bankAccounts' => array(self::HAS_MANY, 'BankAccount', 'user_id'),
                'documents' => array(self::HAS_MANY, 'Documents', 'user_id'),
                'invoices' => array(self::HAS_MANY, 'Invoice', 'user_id'),
                'instantorXml' => array(self::HAS_MANY, 'InstantorXml', 'user_identification'),
                'orders' => array(self::HAS_MANY, 'Orders', 'buyer_id'),
                'orders1' => array(self::HAS_MANY, 'Orders', 'seller_id'),
                'userAddresses' => array(self::HAS_MANY, 'UserAddress', 'user_id'),
                'userAddressesBasic' => array(self::HAS_MANY, 'UserAddress', 'user_id', 'condition'=>'address_type=0'),
                'userEmails' => array(self::HAS_MANY, 'UserEmails', 'user_id'),
                'userHistories' => array(self::HAS_MANY, 'UserHistory', 'user_id'),
                'userMessages' => array(self::HAS_MANY, 'UserMessages', 'receiver_id'),
                'userMessages1' => array(self::HAS_MANY, 'UserMessages', 'sender_id'),
                'userPhoneNumbers' => array(self::HAS_MANY, 'UserPhoneNumbers', 'user_id'),
                'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
                'userType' => array(self::BELONGS_TO, 'UserTypes', 'userType_id'),
            );
        }

        public function getBankAccount()
        {
            return BankAccount::model()->findByAttributes(array("user_id" => $this->id, "status" => 1))->bank_account;
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
                'gender' => Yii::t('app', 'model.users.gender'),
                'age' => Yii::t('app', 'model.users.age'),
                'mobile_number' => Yii::t('app', 'model.users.mobile'),
                'country_id' => Yii::t('app', 'model.users.country'),
                'credit_limit' => Yii::t('app', 'model.users.credit_limit'),
                'creditLimit_expends' => 'Credit Limit Expends',
                'creditLimit_reserved' => 'Credit Limit Reserved',
                'creditLimit_date' => 'Credit Limit Date',
                'crediLimit_date' => Yii::t('app', 'model.users.creditLimit_date'),
                'reset_code' => 'Reset Code',
                'reset_time' => 'Reset Time',
                'status' => 'Aktivan',
                'create_at' => Yii::t('app', 'model.users.create_at'),
                'lastVisit_at' => 'Lastvisit At',
                'passwordUpdate_at' => 'Password Update At',
                'userType_id' => Yii::t('app', 'model.users.userType_id'),
                'newsletter' => Yii::t('app', 'model.users.newsletter'),
                'verification' => Yii::t('app', 'model.users.percentage'),
                'verification_document' => 'Verification Document',
                'ip_address' => 'Ip Address',
                'bankAccount' => 'Bankovni račun',
                'time_deactivated' => 'Datum deaktiviranja',
                'creditLimit_manual' => 'Ručno dodjeljen limit',
                'seller' => Yii::t('app', 'model.users.userType_id')
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
            $criteria->compare('creditLimit_reserved',$this->creditLimit_reserved,true);
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
            $criteria->compare('seller',$this->seller);
            $criteria->compare('iban',$this->iban);
            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria, 'pagination'=>array('pageSize'=>30), 
                    'sort'=>array('defaultOrder'=>'create_at DESC')
                ));
        }

        public function newUsers()
        {
            $criteria=new CDbCriteria;

            $criteria->compare('id',$this->id,true);
            $criteria->compare('name',$this->name,true);
            $criteria->compare('surname',$this->surname,true);
            $criteria->compare('email',$this->email,true);
            $criteria->compare('id_number',$this->id_number,true);
            $criteria->compare('mobile_number',$this->mobile_number,true);
            $criteria->compare('country_id',$this->country_id,true);
            $criteria->compare('credit_limit',$this->credit_limit,true);
            $criteria->compare('creditLimit_date',$this->creditLimit_date,true);
            $criteria->compare('create_at',$this->create_at,true);
            $criteria->compare('verification', 0);
            $criteria->compare('userType_id', 3);
            $criteria->compare('verification_document', 0);
            $criteria->compare('ip_address',$this->ip_address,true);
            $criteria->compare('status', $this->status, true);
            $criteria->compare('seller',$this->seller);
            $criteria->compare('iban',$this->iban);
            return new CActiveDataProvider('Users', array(
                    'criteria'=>$criteria, 'pagination'=>array('pageSize'=>20),
                    'sort'=>array('defaultOrder'=>'create_at DESC')
                ));  
        }

        public function verified()
        {
            $criteria=new CDbCriteria;

            $criteria->compare('id',$this->id,true);
            $criteria->compare('name',$this->name,true);
            $criteria->compare('surname',$this->surname,true);
            $criteria->compare('email',$this->email,true);
            $criteria->compare('id_number',$this->id_number,true);
            $criteria->compare('mobile_number',$this->mobile_number,true);
            $criteria->compare('country_id',$this->country_id,true);
            $criteria->compare('credit_limit',$this->credit_limit,true);
            $criteria->compare('creditLimit_date',$this->creditLimit_date,true);
            $criteria->compare('create_at',$this->create_at,true);
            $criteria->compare('verification', 1);
            $criteria->compare('userType_id', 3);
            $criteria->compare('status', $this->status, true);
            $criteria->compare('ip_address',$this->ip_address,true);
            $criteria->compare('seller',$this->seller);

            return new CActiveDataProvider('Users', array(
                    'criteria'=>$criteria, 'pagination'=>array('pageSize'=>20),
                    'sort'=>array('defaultOrder'=>'create_at DESC')
                ));  
        }

        public function documents()
        {
            $criteria=new CDbCriteria;

            $criteria->compare('id',$this->id,true);
            $criteria->compare('name',$this->name,true);
            $criteria->compare('surname',$this->surname,true);
            $criteria->compare('email',$this->email,true);
            $criteria->compare('id_number',$this->id_number,true);
            $criteria->compare('mobile_number',$this->mobile_number,true);
            $criteria->compare('country_id',$this->country_id,true);
            $criteria->compare('credit_limit',$this->credit_limit,true);
            $criteria->compare('verification', 0);
            $criteria->compare('userType_id', 3);
            $criteria->compare('status', $this->status, true);
            $criteria->compare('verification_document', 1);
            $criteria->compare('ip_address',$this->ip_address,true);
            $criteria->compare('seller',$this->seller);

            return new CActiveDataProvider('Users', array(
                    'criteria'=>$criteria, 'pagination'=>array('pageSize'=>20),
                    'sort'=>array('defaultOrder'=>'create_at DESC')
                ));  
        }

        public function getFullName() {
            return $this->name." ".$this->surname;
        }
        
        public function userExist($email, $mobile) {
            if($email<>"") {           
                 $userEx=UsersDao::model()->findByAttributes(array("email" =>$email));
            } else {
                 $userEx=UsersDao::model()->findByAttributes(array("mobile_number" =>$mobile));
            }
            return $userEx;
        }
}