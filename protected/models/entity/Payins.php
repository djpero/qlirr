<?php

/**
 * This is the model class for table "payins".
 *
 * The followings are the available columns in table 'payins':
 * @property integer $id
 * @property integer $order_id
 * @property string $payment_reference
 * @property string $pay_date
 * @property string $bank_account_from
 * @property string $bank_account_to
 * @property string $name
 * @property string $description
 * @property string $amount
 * @property string $created_at
 */
class Payins extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Payins the static model class
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
		return 'payins';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('payment_reference, pay_date, bank_account_from, bank_account_to, amount', 'required'),
			array('order_id', 'numerical', 'integerOnly'=>true),
			array('payment_reference, bank_account_from, bank_account_to, name', 'length', 'max'=>50),
			array('description', 'length', 'max'=>200),
			array('amount', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, order_id, payment_reference, pay_date, bank_account_from, bank_account_to, name, description, amount, created_at', 'safe', 'on'=>'search'),
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
			'order_id' => 'Order',
			'payment_reference' => 'Payment Reference',
			'pay_date' => 'Pay Date',
			'bank_account_from' => 'Bank Account From',
			'bank_account_to' => 'Bank Account To',
			'name' => 'Name',
			'description' => 'Description',
			'amount' => 'Amount',
			'created_at' => 'Created At',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('payment_reference',$this->payment_reference,true);
		$criteria->compare('pay_date',$this->pay_date,true);
		$criteria->compare('bank_account_from',$this->bank_account_from,true);
		$criteria->compare('bank_account_to',$this->bank_account_to,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}