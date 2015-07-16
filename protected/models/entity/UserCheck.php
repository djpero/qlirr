<?php

/**
 * This is the model class for table "user_check".
 *
 * The followings are the available columns in table 'user_check':
 * @property integer $id
 * @property integer $type
 * @property string $query_value
 * @property string $url
 * @property string $result
 */
class UserCheck extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserCheck the static model class
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
		return 'user_check';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, query_value, url, result', 'required'),
			array('id, type', 'numerical', 'integerOnly'=>true),
			array('query_value', 'length', 'max'=>50),
			array('url', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type, query_value, url, result', 'safe', 'on'=>'search'),
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
			'type' => 'Type',
			'query_value' => 'Query Value',
			'url' => 'Url',
			'result' => 'Result',
                        'time' => 'Time',
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
		$criteria->compare('type',$this->type);
		$criteria->compare('query_value',$this->query_value,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('result',$this->result,true);
                $criteria->compare('time',$this->time,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}