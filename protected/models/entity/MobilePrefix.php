<?php

    /**
    * This is the model class for table "mobile_prefix".
    *
    * The followings are the available columns in table 'mobile_prefix':
    * @property string $id
    * @property string $name
    * @property string $value
    *
    * The followings are the available model relations:
    * @property UserHistory[] $userHistories
    */
    class MobilePrefix extends CActiveRecord
    {
        /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return MobilePrefix the static model class
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
            return 'mobile_prefix';
        }

        /**
        * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('name, value', 'required'),
                array('name', 'length', 'max'=>50),
                array('value', 'length', 'max'=>11),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, name, value', 'safe', 'on'=>'search'),
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
                'userHistories' => array(self::HAS_MANY, 'UserHistory', 'mobilePrefix_id'),
            );
        }

        /**
        * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
                'id' => 'ID',
                'name' => Yii::t('app', 'model.mobile_prefix.name'),
                'value' => Yii::t('app', 'model.mobile_prefix.value'),
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
            $criteria->compare('value',$this->value,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                ));
        }
}