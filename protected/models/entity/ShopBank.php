<?php

/**
 * This is the model class for table "shop_bank".
 *
 * The followings are the available columns in table 'shop_bank':
 * @property string $id
 * @property string $bank_id
 * @property string $user_id
 * @property string $bank_account
 * @property integer $status
 * @property integer $primary
 */
class ShopBank extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ShopBank the static model class
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
		return 'shop_bank';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, bank_account', 'required'),
			array('status, primary', 'numerical', 'integerOnly'=>true),
			array('bank_id, user_id', 'length', 'max'=>11),
			array('bank_account', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, bank_id, user_id, bank_account, status, primary', 'safe', 'on'=>'search'),
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
			'bank_id' => 'Bank',
			'user_id' => 'User',
			'bank_account' => 'Bank Account',
			'status' => 'Status',
			'primary' => 'Primary',
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
		$criteria->compare('bank_id',$this->bank_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('bank_account',$this->bank_account,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('primary',$this->primary);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}