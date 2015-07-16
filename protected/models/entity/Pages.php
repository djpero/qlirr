<?php

    /**
    * This is the model class for table "pages".
    *
    * The followings are the available columns in table 'pages':
    * @property integer $id
    * @property string $subject
    * @property string $content
    * @property string $slug
    * @property string $country_id
    * @property string $pageType_id
    *
    * The followings are the available model relations:
    * @property Country $country
    * @property PageType $pageType
    */
    class Pages extends CActiveRecord
    {
        /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return Pages the static model class
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
            return 'pages';
        }

        /**
        * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('subject, content, country_id', 'required'),
                array('subject', 'length', 'max'=>200),
                array('slug', 'length', 'max'=>150),
                array('country_id', 'length', 'max'=>10),
                array('pageType_id', 'length', 'max'=>11),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, subject, content, slug, country_id, pageType_id', 'safe', 'on'=>'search'),
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
                'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
                'pageType' => array(self::BELONGS_TO, 'PageType', 'pageType_id'),
            );
        }

        /**
        * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
                'id' => 'ID',
                'subject' => 'Naslov',
                'content' => 'Sadržaj',
                'slug' => 'Permalink',
                'country_id' => 'Za državu',
                'pageType_id' => 'Za stranicu',
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
            $criteria->compare('subject',$this->subject,true);
            $criteria->compare('content',$this->content,true);
            $criteria->compare('slug',$this->slug,true);
            $criteria->compare('country_id',$this->country_id,true);
            $criteria->compare('pageType_id',$this->pageType_id,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                ));
        }

        /**
        * Retrieves a list of models based on the current search/filter conditions.
        * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
        */
        public function pageType($pageType)
        {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria=new CDbCriteria;

            $criteria->compare('id',$this->id);
            $criteria->compare('subject',$this->subject,true);
            $criteria->compare('content',$this->content,true);
            $criteria->compare('slug',$this->slug,true);
            $criteria->compare('country_id',$this->country_id,true);
            $criteria->compare('pageType_id',$pageType);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                ));
        }
}