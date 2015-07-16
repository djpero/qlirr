<?php

/**
 * This is the model class for table "service_fees".
 *
 * The followings are the available columns in table 'service_fees':
 * @property string $id
 * @property string $service_id
 * @property string $from
 * @property string $to
 * @property string $fixed
 * @property string $percentage
 * @property integer $include_vat
 * @property integer $installment_id
 *
 * The followings are the available model relations:
 * @property Service $service
 * @property ServiceInstallment[] $serviceInstallments
 */
class ServiceFees extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ServiceFees the static model class
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
		return 'service_fees';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service_id, from, to', 'required'),
			array('include_vat, installment_id', 'numerical', 'integerOnly'=>true),
			array('service_id, from, to, fixed, percentage', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, service_id, from, to, fixed, percentage, include_vat, installment_id', 'safe', 'on'=>'search'),
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
			'service' => array(self::BELONGS_TO, 'Service', 'service_id'),
			'serviceInstallments' => array(self::HAS_MANY, 'ServiceInstallment', 'serviceFee_id'),
		);
	}
    
    /**
        * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
                'id' => 'ID',
                'service_id' => Yii::t('app', 'model.service_fees.service_id'),
                'from' => Yii::t('app', 'model.service_fees.from'),
                'to' => Yii::t('app', 'model.service_fees.to'),
                'fixed' => Yii::t('app', 'model.service_fees.fixed'),
                'percentage' => Yii::t('app', 'model.service_fees.percentage'),
                'include_vat' => 'Include Vat',
                'installment_id' => 'Installment',
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
		$criteria->compare('service_id',$this->service_id,true);
		$criteria->compare('from',$this->from,true);
		$criteria->compare('to',$this->to,true);
		$criteria->compare('fixed',$this->fixed,true);
		$criteria->compare('percentage',$this->percentage,true);
		$criteria->compare('include_vat',$this->include_vat);
        $criteria->compare('installment_id',$this->installment_id);
		$criteria->compare('status', 1);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}