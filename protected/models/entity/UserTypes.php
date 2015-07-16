<?php

    /**
    * This is the model class for table "user_types".
    *
    * The followings are the available columns in table 'user_types':
    * @property string $id
    * @property string $name
    * @property string $description
    *
    * The followings are the available model relations:
    * @property UserHistory[] $userHistories
    * @property Users[] $users
    */
    class UserTypes extends CActiveRecord
    {
        /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return UserTypes the static model class
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
            return 'user_types';
        }

        /**
        * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('name', 'required'),
                array('name', 'length', 'max'=>30),
                array('description', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, name, description', 'safe', 'on'=>'search'),
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
                'userHistories' => array(self::HAS_MANY, 'UserHistory', 'useType_id'),
                'users' => array(self::HAS_MANY, 'Users', 'userType_id'),
            );
        }

        /**
        * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
                'id' => 'ID',
                'name' => Yii::t('app', 'model.user_types.name'),
                'description' => Yii::t('app', 'model.description'),
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
            $criteria->compare('name',$this->name,true);
            $criteria->compare('description',$this->description,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                ));
        }
}