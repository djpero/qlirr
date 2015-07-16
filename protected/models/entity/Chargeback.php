<?php

/**
 * This is the model class for table "chargeback".
 *
 * The followings are the available columns in table 'chargeback':
 * @property integer $id
 * @property integer $user_id
 * @property integer $order_id
 * @property string $amount
 * @property string $penality
 * @property integer $paid
 * @property string $created_at
 * @property string $date_due
 * @property string $date_due_ext
 * @property integer $status
 */
class Chargeback extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Chargeback the static model class
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
		return 'chargeback';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, order_id, penality, paid, date_due, date_due_ext, status', 'required'),
			array('user_id, order_id, paid, status', 'numerical', 'integerOnly'=>true),
			array('penality', 'length', 'max'=>10),
			array('created_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, order_id, amount, penality, paid, created_at, date_due, date_due_ext, status', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'order_id' => 'Order',
			'amount' => 'Amount',
			'penality' => 'Penality',
			'paid' => 'Paid',
			'created_at' => 'Created At',
			'date_due' => 'Date Due',
			'date_due_ext' => 'Date Due Ext',
			'status' => 'Status',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('penality',$this->penality,true);
		$criteria->compare('paid',$this->paid);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('date_due',$this->date_due,true);
		$criteria->compare('date_due_ext',$this->date_due_ext,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}