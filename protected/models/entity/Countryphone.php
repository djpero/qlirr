<?php

/**
 * This is the model class for table "countryphone".
 *
 * The followings are the available columns in table 'countryphone':
 * @property integer $id
 * @property string $country
 * @property string $cc
 * @property string $prefix
 * @property string $capital
 */
class Countryphone extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Countryphone the static model class
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
		return 'countryphone';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, country, cc, prefix, capital', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('country', 'length', 'max'=>50),
			array('cc', 'length', 'max'=>5),
			array('prefix', 'length', 'max'=>10),
			array('capital', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, country, cc, prefix, capital', 'safe', 'on'=>'search'),
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
			'country' => 'Country',
			'cc' => 'Cc',
			'prefix' => 'Prefix',
			'capital' => 'Capital',
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
		$criteria->compare('country',$this->country,true);
		$criteria->compare('cc',$this->cc,true);
		$criteria->compare('prefix',$this->prefix,true);
		$criteria->compare('capital',$this->capital,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}