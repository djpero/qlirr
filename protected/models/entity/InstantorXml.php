<?php
    /**
    * This is the model class for table "instantor_xml".
    *
    * The followings are the available columns in table 'instantor_xml':
    * @property string $id
    * @property string $user_identification
    * @property string $xml
    * @property string $time_created
    * @property string $type
    *
    * The followings are the available model relations:
    * @property Users $user
    */
    class InstantorXml extends CActiveRecord
    {
        /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return InstantorXml the static model class
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
            return 'instantor_xml';
        }

        /**
        * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('user_identification, xml, type', 'required'),
                array('user_identification', 'length', 'max'=>40),
                array('type', 'length', 'max'=>30),
                array('time_created', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, user_identification, xml, time_created, type', 'safe', 'on'=>'search'),
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
                'user' => array(self::BELONGS_TO, 'Users', 'user_identification'),
            );
        }

        /**
        * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
                'id' => 'ID',
                'user_identification' => 'User Identification',
                'xml' => 'Xml',
                'time_created' => 'Time Created',
                'type' => 'Type',
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
            $criteria->compare('user_identification',$this->user_identification,true);
            $criteria->compare('xml',$this->xml,true);
            $criteria->compare('time_created',$this->time_created,true);
            $criteria->compare('type',$this->type,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                ));
        }
        
        /**
        * Retrieves a list of models based on the current search/filter conditions.
        * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
        */
        public function searchByUserIdentification($identification)
        {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria=new CDbCriteria;

            $criteria->compare('id',$this->id,true);
            $criteria->compare('user_identification',$identification);
            $criteria->compare('xml',$this->xml,true);
            $criteria->compare('time_created',$this->time_created,true);
            $criteria->compare('type',$this->type,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                ));
        }

        /**
        * Retrieves a list of models based on the current search/filter conditions.
        * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
        */
        public function last20tries()
        {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria=new CDbCriteria;

            $criteria->compare('id',$this->id,true);
            $criteria->compare('user_identification',$this->user_identification,true);
            $criteria->compare('time_created',$this->time_created,true);
            $criteria->compare('type',$this->type,true);
            $criteria->order = 'time_created DESC';

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria, 'pagination'=>array('pageSize'=>5), 'totalItemCount'=>20
                ));
        }
}