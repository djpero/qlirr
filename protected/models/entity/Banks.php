<?php

    /**
    * This is the model class for table "banks".
    *
    * The followings are the available columns in table 'banks':
    * @property string $id
    * @property string $full_name
    * @property string $abbr
    * @property string $url
    * @property string $account
    * @property string $sorty_key
    * @property integer $visible
    * @property string $created_at
    * @property string $update_at
    *
    * The followings are the available model relations:
    * @property BankAccount[] $bankAccounts
    * @property BankAccountHistory[] $bankAccountHistories
    */
    class Banks extends CActiveRecord
    {
        /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return Banks the static model class
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
            return 'banks';
        }

        /**
        * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('visible', 'numerical', 'integerOnly'=>true),
                array('id', 'length', 'max'=>11),
                array('full_name, url', 'length', 'max'=>50),
                array('abbr', 'length', 'max'=>15),
                array('account', 'length', 'max'=>20),
                array('sorty_key', 'length', 'max'=>2),
                array('created_at, update_at', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, full_name, abbr, url, account, sorty_key, visible, created_at, update_at', 'safe', 'on'=>'search'),
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
                'bankAccounts' => array(self::HAS_MANY, 'BankAccount', 'bank_id'),
                'bankAccountHistories' => array(self::HAS_MANY, 'BankAccountHistory', 'bank_id'),
            );
        }

        /**
        * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
                'id' => Yii::t('app', 'model.bank.code'),
                'full_name' => Yii::t('app', 'model.bank.full_name'),
                'abbr' => 'Abbr',
                'url' => 'Url',
                'account' => 'Account',
                'sorty_key' => 'Sorty Key',
                'visible' => 'Visible',
                'created_at' => 'Created At',
                'update_at' => 'Update At',
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
            $criteria->compare('full_name',$this->full_name,true);
            $criteria->compare('abbr',$this->abbr,true);
            $criteria->compare('url',$this->url,true);
            $criteria->compare('account',$this->account,true);
            $criteria->compare('sorty_key',$this->sorty_key,true);
            $criteria->compare('visible',$this->visible);
            $criteria->compare('created_at',$this->created_at,true);
            $criteria->compare('update_at',$this->update_at,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                ));
        }


        public function getCodeFullName()
        {
            return $this->full_name.' - '.$this->id;
        }
}