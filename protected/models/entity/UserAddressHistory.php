<?php

    /**
    * This is the model class for table "user_address_history".
    *
    * The followings are the available columns in table 'user_address_history':
    * @property string $id
    * @property integer $active
    * @property string $user_id
    * @property integer $address_type
    * @property string $street
    * @property string $post_code
    * @property string $city
    * @property string $region
    * @property string $country_id
    * @property string $time_created
    * @property integer $primary
    * @property string $comment
    * @property string $update_time
    *
    * The followings are the available model relations:
    * @property Users $user
    * @property Country $country
    */
    class UserAddressHistory extends CActiveRecord
    {
        /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return UserAddressHistory the static model class
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
            return 'user_address_history';
        }

        /**
        * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('active, user_id, street, time_created, comment, update_time', 'required'),
                array('active, address_type, primary', 'numerical', 'integerOnly'=>true),
                array('user_id, country_id', 'length', 'max'=>11),
                array('street, city, region', 'length', 'max'=>100),
                array('post_code', 'length', 'max'=>50),
                array('comment', 'length', 'max'=>150),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, active, user_id, address_type, street, post_code, city, region, country_id, time_created, primary, comment, update_time', 'safe', 'on'=>'search'),
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
                'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
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
                'region' => 'Region',
                'country_id' => 'Country',
                'time_created' => 'Time Created',
                'primary' => 'Primary',
                'comment' => 'Comment',
                'update_time' => 'Update Time',
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
            $criteria->compare('region',$this->region,true);
            $criteria->compare('country_id',$this->country_id,true);
            $criteria->compare('time_created',$this->time_created,true);
            $criteria->compare('primary',$this->primary);
            $criteria->compare('comment',$this->comment,true);
            $criteria->compare('update_time',$this->update_time,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                ));
        }
}