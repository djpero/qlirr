<?php

/**
 * This is the model class for table "shop_comments".
 *
 * The followings are the available columns in table 'shop_comments':
 * @property integer $id
 * @property integer $shop_id
 * @property string $comment
 * @property integer $user_created
 * @property string $time_created
 * @property integer $active
 */
class ShopComments extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ShopComments the static model class
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
		return 'shop_comments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('shop_id, comment, user_created', 'required'),
			array('shop_id, user_created, active', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, shop_id, comment, user_created, time_created, active', 'safe', 'on'=>'search'),
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
			'shop_id' => 'Shop',
			'comment' => 'Comment',
			'user_created' => 'User Created',
			'time_created' => 'Time Created',
			'active' => 'Active',
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
		$criteria->compare('shop_id',$this->shop_id);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('user_created',$this->user_created);
		$criteria->compare('time_created',$this->time_created,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}