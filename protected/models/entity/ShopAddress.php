<?php

/**
 * This is the model class for table "shop_address".
 *
 * The followings are the available columns in table 'shop_address':
 * @property string $id
 * @property integer $active
 * @property string $user_id
 * @property integer $address_type
 * @property string $street
 * @property string $post_code
 * @property string $city
 * @property string $county_id
 * @property string $xcoord
 * @property string $ycoord
 * @property string $time_created
 * @property integer $primary
 */
class ShopAddress extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ShopAddress the static model class
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
		return 'shop_address';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('active, user_id, street', 'required'),
			array('active, address_type, primary', 'numerical', 'integerOnly'=>true),
			array('user_id, county_id', 'length', 'max'=>11),
			array('street, city', 'length', 'max'=>100),
			array('post_code', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, active, user_id, address_type, street, post_code, city, county_id, time_created, primary', 'safe', 'on'=>'search'),
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
			'active' => 'Active',
			'user_id' => 'User',
			'address_type' => 'Address Type',
			'street' => 'Street',
			'post_code' => 'Post Code',
			'city' => 'City',
			'county_id' => 'Country',
			'xcoord' => 'Xcoord',
			'ycoord' => 'Ycoord',
			'time_created' => 'Time Created',
			'primary' => 'Primary',
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
		$criteria->compare('active',$this->active);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('address_type',$this->address_type);
		$criteria->compare('street',$this->street,true);
		$criteria->compare('post_code',$this->post_code,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('county_id',$this->county_id,true);
		$criteria->compare('xcoord',$this->xcoord,true);
		$criteria->compare('ycoord',$this->ycoord,true);
		$criteria->compare('time_created',$this->time_created,true);
		$criteria->compare('primary',$this->primary);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}