<?php

    /**
    * This is the model class for table "invoice_item".
    *
    * The followings are the available columns in table 'invoice_item':
    * @property string $id
    * @property string $invoice_id
    * @property string $item_name
    * @property string $item_description
    * @property string $item_amount
    * @property string $tax_rate
    * @property string $total_amount
    * @property string $time_created
    *
    * The followings are the available model relations:
    * @property Invoice $invoice
    */
    class InvoiceItem extends CActiveRecord
    {
        /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return InvoiceItem the static model class
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
            return 'invoice_item';
        }

        /**
        * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('invoice_id, item_name, item_amount, tax_rate, total_amount, time_created', 'required'),
                array('invoice_id', 'length', 'max'=>11),
                array('item_name, item_description', 'length', 'max'=>255),
                array('item_amount, tax_rate, total_amount', 'length', 'max'=>10),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, invoice_id, item_name, item_description, item_amount, tax_rate, total_amount, time_created', 'safe', 'on'=>'search'),
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
                'invoice' => array(self::BELONGS_TO, 'Invoice', 'invoice_id'),
            );
        }

        /**
        * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
                'id' => 'ID',
                'invoice_id' => 'Invoice',
                'item_name' => Yii::t('app', 'model.invoice.item_name'),
                'item_description' => Yii::t('app', 'model.description'),
                'item_amount' => Yii::t('app', 'model.invoice.item_amount'),
                'tax_rate' => Yii::t('app', 'model.invoice.tax_rate'),
                'total_amount' => Yii::t('app', 'model.invoice.total_amount'),
                'time_created' => Yii::t('app', 'model.invoice.time_created'),
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
            $criteria->compare('invoice_id',$this->invoice_id,true);
            $criteria->compare('item_name',$this->item_name,true);
            $criteria->compare('item_description',$this->item_description,true);
            $criteria->compare('item_amount',$this->item_amount,true);
            $criteria->compare('tax_rate',$this->tax_rate,true);
            $criteria->compare('total_amount',$this->total_amount,true);
            $criteria->compare('time_created',$this->time_created,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                ));
        }
}