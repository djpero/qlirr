<?php

/**
 * This is the model class for table "shops".
 *
 * The followings are the available columns in table 'shops':
 * @property string $id
 * @property string $name
 * @property string $password
 * @property string $shop_id
 * @property string $passwordUpdate_at
 * @property string $email
 * @property string $id_number
 * @property string $personal_number
 * @property string $iban
 * @property string $gender
 * @property string $individual_id
 * @property integer $age
 * @property string $birthday
 * @property string $mobile_number
 * @property string $country_id
 * @property string $credit_limit
 * @property string $credit_limit_s
 * @property string $credit_limit_s_expends
 * @property string $credit_limit_s_remaining
 * @property integer $creditLimit_manual
 * @property string $creditLimit_remaining
 * @property string $creditLimit_expends
 * @property string $creditLimit_reserved
 * @property string $creditLimit_date
 * @property string $reset_code
 * @property string $reset_time
 * @property integer $status
 * @property string $time_deactivated
 * @property string $create_at
 * @property string $lastVisit_at
 * @property string $userType_id
 * @property integer $newsletter
 * @property integer $verification
 * @property integer $verification_document
 * @property string $ip_address
 * @property integer $seller
 */
class Shops extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Shops the static model class
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
		return 'shops';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, shop_id', 'required'),
			array('status,  verification, verification_document', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>150),
			array('password, email', 'length', 'max'=>128),
			array('shop_id', 'length', 'max'=>20),
			array('ip_address', 'length', 'max'=>30),
			array('mobile_number', 'length', 'max'=>100),
			array('country_id', 'length', 'max'=>11),
			array('passwordUpdate_at, creditLimit_date, reset_time, time_deactivated, create_at, lastVisit_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, password, shop_id, passwordUpdate_at, email, id_number, gender, individual_id, mobile_number, country_id,  status, time_deactivated, create_at, lastVisit_at, newsletter, verification, verification_document, ip_address, seller', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'password' => 'Password',
			'shop_id' => 'Shop',
			'passwordUpdate_at' => 'Password Update At',
			'email' => 'Email',
			'id_number' => 'Id Number',
			'personal_number' => 'Personal Number',
			'gender' => 'Gender',
			'individual_id' => 'Individual',
			'age' => 'Age',
			'birthday' => 'Birthday',
			'mobile_number' => 'Mobile Number',
			'country_id' => 'Country',
			'credit_limit' => 'Credit Limit',
			'credit_limit_s' => 'Credit Limit S',
			'credit_limit_s_expends' => 'Credit Limit S Expends',
			'credit_limit_s_remaining' => 'Credit Limit S Remaining',
			'creditLimit_remaining' => 'Credit Limit Remaining',
			'creditLimit_expends' => 'Credit Limit Expends',
			'creditLimit_reserved' => 'Credit Limit Reserved',
			'creditLimit_date' => 'Credit Limit Date',
			'reset_code' => 'Reset Code',
			'reset_time' => 'Reset Time',
			'status' => 'Status',
			'time_deactivated' => 'Time Deactivated',
			'create_at' => 'Create At',
			'lastVisit_at' => 'Last Visit At',
			'userType_id' => 'User Type',
			'newsletter' => 'Newsletter',
			'verification' => 'Verification',
			'verification_document' => 'Verification Document',
			'ip_address' => 'Ip Address',
			'seller' => 'Seller',
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
		$criteria->compare('password',$this->password,true);
		$criteria->compare('shop_id',$this->shop_id,true);
		$criteria->compare('passwordUpdate_at',$this->passwordUpdate_at,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('id_number',$this->id_number,true);
		$criteria->compare('personal_number',$this->personal_number,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('individual_id',$this->individual_id,true);
		$criteria->compare('age',$this->age);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('mobile_number',$this->mobile_number,true);
		$criteria->compare('country_id',$this->country_id,true);
		$criteria->compare('reset_code',$this->reset_code,true);
		$criteria->compare('reset_time',$this->reset_time,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('time_deactivated',$this->time_deactivated,true);
		$criteria->compare('create_at',$this->create_at,true);
		$criteria->compare('lastVisit_at',$this->lastVisit_at,true);
		$criteria->compare('userType_id',$this->userType_id,true);
		$criteria->compare('newsletter',$this->newsletter);
		$criteria->compare('verification',$this->verification);
		$criteria->compare('verification_document',$this->verification_document);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('seller',$this->seller);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}