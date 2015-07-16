<?php

/**
 * This is the model class for table "service_installment".
 *
 * The followings are the available columns in table 'service_installment':
 * @property string $id
 * @property string $serviceFee_id
 * @property integer $number
 * @property string $fixed
 * @property string $percentage
 * @property integer $include_vat
 *
 * The followings are the available model relations:
 * @property ServiceFees $serviceFee
 */
class ServiceInstallment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ServiceInstallment the static model class
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
		return 'service_installment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('serviceFee_id, number', 'required'),
			array('number, include_vat', 'numerical', 'integerOnly'=>true),
			array('serviceFee_id, fixed, percentage', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, serviceFee_id, number, fixed, percentage, include_vat', 'safe', 'on'=>'search'),
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
			'serviceFee' => array(self::BELONGS_TO, 'ServiceFees', 'serviceFee_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'serviceFee_id' => 'Service Fee',
			'number' => 'Number',
			'fixed' => 'Fixed',
			'percentage' => 'Percentage',
			'include_vat' => 'Include Vat',
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
		$criteria->compare('serviceFee_id',$this->serviceFee_id,true);
		$criteria->compare('number',$this->number);
		$criteria->compare('fixed',$this->fixed,true);
		$criteria->compare('percentage',$this->percentage,true);
		$criteria->compare('include_vat',$this->include_vat);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}