<?php

    /**
    * This is the model class for table "order_item".
    *
    * The followings are the available columns in table 'order_item':
    * @property string $id
    * @property string $order_id
    * @property string $product_name
    * @property string $product_description
    * @property string $part_number
    * @property string $qty
    * @property string $price
    * @property string $tax_rate
    * @property string $time_created
    *
    * The followings are the available model relations:
    * @property Orders $order
    */
    class OrderItem extends CActiveRecord
    {
        /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return OrderItem the static model class
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
            return 'order_item';
        }

        /**
        * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('order_id, product_name, qty, price, tax_rate', 'required'),
                array('order_id, qty', 'length', 'max'=>11),
                array('product_name, product_description', 'length', 'max'=>255),
                array('part_number', 'length', 'max'=>100),
                array('price, tax_rate', 'length', 'max'=>10),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, order_id, product_name, product_description, part_number, qty, price, tax_rate, time_created', 'safe', 'on'=>'search'),
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
                'order' => array(self::BELONGS_TO, 'Orders', 'order_id'),
            );
        }

        /**
        * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
                'id' => 'ID',
                'order_id' => 'Order',
                'product_name' => Yii::t('app', 'model.order_item.product_name'),
                'product_description' => Yii::t('app', 'model.order_item.product_description'),
                'part_number' => 'Part Number',
                'qty' => Yii::t('app', 'model.order_item.qty'),
                'price' => Yii::t('app', 'model.order_item.price'),
                'tax_rate' => Yii::t('app', 'model.order_item.tax_rate'),
                'time_created' => Yii::t('app', 'model.order_item.time_created'),
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
            $criteria->compare('order_id',$this->order_id,true);
            $criteria->compare('product_name',$this->product_name,true);
            $criteria->compare('product_description',$this->product_description,true);
            $criteria->compare('part_number',$this->part_number,true);
            $criteria->compare('qty',$this->qty,true);
            $criteria->compare('price',$this->price,true);
            $criteria->compare('tax_rate',$this->tax_rate,true);
            $criteria->compare('time_created',$this->time_created,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                ));
        }
}