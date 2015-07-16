<?php

    /**
    * This is the model class for table "service".
    *
    * The followings are the available columns in table 'service':
    * @property string $id
    * @property string $service_name
    * @property string $internal_name
    *
    * The followings are the available model relations:
    * @property Orders[] $orders
    * @property ServiceFees[] $serviceFees
    */
    class Service extends CActiveRecord
    {
        /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return Service the static model class
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
            return 'service';
        }

        /**
        * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('service_name', 'required'),
                array('service_name', 'length', 'max'=>255),
                array('internal_name', 'length', 'max'=>100),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, service_name, internal_name', 'safe', 'on'=>'search'),
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
                'orders' => array(self::HAS_MANY, 'Orders', 'service_id'),
                'serviceFees' => array(self::HAS_MANY, 'ServiceFees', 'service_id'),
            );
        }

        /**
        * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
                'id' => 'ID',
                'service_name' => Yii::t('app', 'model.service.name'),
                'internal_name' => 'Internal Name',
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
            $criteria->compare('service_name',$this->service_name,true);
            $criteria->compare('internal_name',$this->internal_name,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                ));
        }
}