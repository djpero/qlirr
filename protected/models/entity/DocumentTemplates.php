<?php

    /**
    * This is the model class for table "document_templates".
    *
    * The followings are the available columns in table 'document_templates':
    * @property string $id
    * @property integer $document_type
    * @property string $lang
    * @property string $template_name
    * @property string $memo_header
    * @property string $memo_footer
    * @property string $time_created
    */
    class DocumentTemplates extends CActiveRecord
    {
        /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return DocumentTemplates the static model class
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
            return 'document_templates';
        }

        /**
        * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('document_type, lang, template_name, time_created', 'required'),
                array('document_type', 'numerical', 'integerOnly'=>true),
                array('lang', 'length', 'max'=>2),
                array('template_name', 'length', 'max'=>255),
                array('memo_header, memo_footer', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, document_type, lang, template_name, memo_header, memo_footer, time_created', 'safe', 'on'=>'search'),
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
                'type' => array(self::BELONGS_TO, 'DocumentType', 'document_type'),
            );
        }

        /**
        * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
                'id' => 'ID',
                'document_type' => Yii::t('app', 'model.document_temp.document_type'),
                'lang' => Yii::t('app', 'model.document_temp.lang'),
                'template_name' => Yii::t('app', 'model.document_temp.template_name'),
                'memo_header' => Yii::t('app', 'model.document_temp.memo_header'),
                'memo_footer' => Yii::t('app', 'model.document_temp.memo_footer'),
                'time_created' => Yii::t('app', 'model.document_temp.time_created'),
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
            $criteria->compare('document_type',$this->document_type);
            $criteria->compare('lang',$this->lang,true);
            $criteria->compare('template_name',$this->template_name,true);
            $criteria->compare('memo_header',$this->memo_header,true);
            $criteria->compare('memo_footer',$this->memo_footer,true);
            $criteria->compare('time_created',$this->time_created,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                ));
        }
}