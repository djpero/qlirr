<?php

/**
 * This is the model class for table "country".
 *
 * The followings are the available columns in table 'country':
 * @property string $id
 * @property integer $default_currency_id
 * @property string $country_name
 * @property string $country_code
 * @property string $iso_code2
 * @property string $iso_code3
 * @property string $iso_ncode
 * @property string $vat
 * @property string $default_language
 * @property string $time_created
 *
 * The followings are the available model relations:
 * @property Banks[] $banks
 * @property EmailTemplate[] $emailTemplates
 * @property UserAddress[] $userAddresses
 * @property UserHistory[] $userHistories
 * @property Users[] $users
 */
class Country extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Country the static model class
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
		return 'country';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('country_code, vat', 'required'),
			array('default_currency_id', 'numerical', 'integerOnly'=>true),
			array('country_name', 'length', 'max'=>255),
			array('country_code', 'length', 'max'=>5),
			array('iso_code2', 'length', 'max'=>2),
			array('iso_code3, iso_ncode', 'length', 'max'=>3),
			array('vat', 'length', 'max'=>10),
			array('default_language', 'length', 'max'=>4),
			array('time_created', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, default_currency_id, country_name, country_code, iso_code2, iso_code3, iso_ncode, vat, default_language, time_created', 'safe', 'on'=>'search'),
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
			'banks' => array(self::HAS_MANY, 'Banks', 'country_id'),
			'emailTemplates' => array(self::HAS_MANY, 'EmailTemplate', 'country_id'),
			'userAddresses' => array(self::HAS_MANY, 'UserAddress', 'country_id'),
			'userHistories' => array(self::HAS_MANY, 'UserHistory', 'country_id'),
			'users' => array(self::HAS_MANY, 'Users', 'country_id'),
		);
	}
    
     /**
        * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
                'id' => 'ID',
                'default_currency_id' => Yii::t('app', 'model.country.default_currency'),
                'country_name' => Yii::t('app', 'model.country.name'),
                'country_code' => 'Country Code',
                'iso_code2' => 'Iso Code2',
                'iso_code3' => 'Iso Code3',
                'iso_ncode' => 'Iso Ncode',
                'vat' => Yii::t('app', 'model.country.vat'),
                'default_language' => Yii::t('app', 'model.country.default_language'),
                'time_created' => Yii::t('model.country.time_created', 'model.country.time_created'),
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
		$criteria->compare('default_currency_id',$this->default_currency_id);
		$criteria->compare('country_name',$this->country_name,true);
		$criteria->compare('country_code',$this->country_code,true);
		$criteria->compare('iso_code2',$this->iso_code2,true);
		$criteria->compare('iso_code3',$this->iso_code3,true);
		$criteria->compare('iso_ncode',$this->iso_ncode,true);
		$criteria->compare('vat',$this->vat,true);
		$criteria->compare('default_language',$this->default_language,true);
		$criteria->compare('time_created',$this->time_created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}