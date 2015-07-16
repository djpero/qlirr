<?php

/**
 * This is the model class for table "sms_logs".
 *
 * The followings are the available columns in table 'sms_logs':
 * @property integer $id
 * @property string $content
 * @property string $mobile_number
 * @property string $user_id
 * @property integer $status
 * @property string $callback
 * @property string $time_sent
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class SmsLogs extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SmsLogs the static model class
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
		return 'sms_logs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content, mobile_number, user_id, status', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('mobile_number', 'length', 'max'=>20),
			array('user_id', 'length', 'max'=>11),
			array('callback', 'length', 'max'=>200),
			array('time_sent', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, content, mobile_number, user_id, status, callback, time_sent', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'content' => 'Content',
			'mobile_number' => 'Mobile Number',
			'user_id' => 'User',
			'status' => 'Status',
			'callback' => 'Callback',
			'time_sent' => 'Time Sent',
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
		$criteria->compare('content',$this->content,true);
		$criteria->compare('mobile_number',$this->mobile_number,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('callback',$this->callback,true);
		$criteria->compare('time_sent',$this->time_sent,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}