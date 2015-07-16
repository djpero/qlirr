<?php

    /**
    * This is the model class for table "bank_account".
    *
    * The followings are the available columns in table 'bank_account':
    * @property string $id
    * @property string $bank_id
    * @property string $user_id
    * @property string $bank_account
    * @property string $status
    * @property integer $primary
    *
    * The followings are the available model relations:
    * @property Banks $bank
    * @property Users $user
    */
    class BankAccount extends CActiveRecord
    {
        /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return BankAccount the static model class
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
            return 'bank_account';
        }

        /**
        * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('bank_id, user_id, bank_account', 'required'),
                array('primary, status', 'numerical', 'integerOnly'=>true),
                array('bank_id, user_id', 'length', 'max'=>11),
                array('bank_account', 'length', 'max'=>50),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, bank_id, user_id, bank_account, primary, status', 'safe', 'on'=>'search'),
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
                'bank' => array(self::BELONGS_TO, 'Banks', 'bank_id'),
                'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
            );
        }

        /**
        * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
                'id' => 'ID',
                'bank_id' => 'Bank',
                'user_id' => 'User',
                'bank_account' => Yii::t('app', 'model.bank.account'),
                'primary' => Yii::t('app', 'model.bank.primary'),
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
            $criteria->compare('bank_id',$this->bank_id,true);
            $criteria->compare('user_id',$this->user_id,true);
            $criteria->compare('bank_account',$this->bank_account,true);
            $criteria->compare('status',$this->status);
            $criteria->compare('primary',$this->primary);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                ));
        }
        
        public function adminAccounts()
        {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria=new CDbCriteria;

            $criteria->compare('id',$this->id,true);
            $criteria->compare('bank_id',$this->bank_id,true);
            $criteria->compare('user_id', 1);
            $criteria->compare('bank_account',$this->bank_account,true);
            $criteria->compare('status',$this->status);
            $criteria->compare('primary',$this->primary);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                ));
        }
        
}