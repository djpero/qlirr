<?php

    /**
    * This is the model class for table "document_type".
    *
    * The followings are the available columns in table 'document_type':
    * @property string $id
    * @property string $name
    * @property string $description
    */
    class DocumentType extends CActiveRecord
    {
        /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return DocumentType the static model class
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
            return 'document_type';
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
                array('name', 'length', 'max'=>100),
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
            );
        }

        /**
        * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
                'id' => 'ID',
                'name' => 'Name',
                'description' => 'Description',
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