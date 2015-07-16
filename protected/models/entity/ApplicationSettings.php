<?php

/**
 * This is the model class for table "application_settings".
 *
 * The followings are the available columns in table 'application_settings':
 * @property string $id
 * @property string $setting_name
 * @property integer $setting_type
 * @property string $setting_value
 * @property string $time_updated
 */
class ApplicationSettings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ApplicationSettings the static model class
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
		return 'application_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('setting_name, setting_type, time_updated', 'required'),
			array('setting_type', 'numerical', 'integerOnly'=>true),
			array('setting_name', 'length', 'max'=>255),
			array('setting_value', 'length', 'max'=>1000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, setting_name, setting_type, setting_value, time_updated', 'safe', 'on'=>'search'),
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
			'setting_name' => Yii::t('app', 'model.app_settings.setting_name'),
			'setting_type' => Yii::t('app', 'model.app_settings.setting_type'),
			'setting_value' => Yii::t('app', 'model.app_settings.setting_value'),
			'time_updated' => Yii::t('app', 'model.app_settings.time_updated'),
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
		$criteria->compare('setting_name',$this->setting_name,true);
		$criteria->compare('setting_type',$this->setting_type);
		$criteria->compare('setting_value',$this->setting_value,true);
		$criteria->compare('time_updated',$this->time_updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>30)
		));
	}
}