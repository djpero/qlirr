<?php

    /**
    * This is the model class for table "currency".
    *
    * The followings are the available columns in table 'currency':
    * @property string $id
    * @property string $currency_code
    * @property string $currency_ncode
    * @property string $currency_name
    * @property integer $exponent
    * @property string $symbol
    * @property string $time_created
    *
    * The followings are the available model relations:
    * @property UserHistory[] $userHistories
    */
    class Currency extends CActiveRecord
    {
        /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return Currency the static model class
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
            return 'currency';
        }

        /**
        * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('currency_code, currency_ncode, currency_name, exponent, time_created', 'required'),
                array('exponent', 'numerical', 'integerOnly'=>true),
                array('currency_code, currency_ncode', 'length', 'max'=>3),
                array('currency_name', 'length', 'max'=>50),
                array('symbol', 'length', 'max'=>10),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, currency_code, currency_ncode, currency_name, exponent, symbol, time_created', 'safe', 'on'=>'search'),
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
                'userHistories' => array(self::HAS_MANY, 'UserHistory', 'currency_id'),
            );
        }

        /**
        * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
                'id' => 'ID',
                'currency_code' => Yii::t('app', 'model.currency.code'),
                'currency_ncode' => 'Currency Ncode',
                'currency_name' => Yii::t('app', 'model.currency.name'),
                'exponent' => 'Exponent',
                'symbol' => Yii::t('app', 'model.currency.symbol'),
                'time_created' => 'Time Created',
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
            $criteria->compare('currency_code',$this->currency_code,true);
            $criteria->compare('currency_ncode',$this->currency_ncode,true);
            $criteria->compare('currency_name',$this->currency_name,true);
            $criteria->compare('exponent',$this->exponent);
            $criteria->compare('symbol',$this->symbol,true);
            $criteria->compare('time_created',$this->time_created,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                ));
        }
}