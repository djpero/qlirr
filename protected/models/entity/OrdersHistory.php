<?php

/**
 * This is the model class for table "orders_history".
 *
 * The followings are the available columns in table 'orders_history':
 * @property string $id
 * @property string $order_id
 * @property string $service_id
 * @property string $orderStatus_id
 * @property string $buyer_id
 * @property string $merchant_id
 * @property string $seller_id
 * @property string $paymentMethod_id
 * @property string $shippingAddress_id
 * @property string $date_issued
 * @property string $date_accepted
 * @property string $date_delivered
 * @property string $order_reference
 * @property string $total_amount
 * @property string $reason
 * @property string $comment
 * @property string $website
 * @property string $time_created
 * @property string $code
 * @property string $tracking_number
 * @property string $mobile
 * @property string $ip_address
 * @property string $change_comment
 * @property integer $change_type
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property Orders $order
 * @property Service $service
 * @property OrderStatus $orderStatus
 * @property Users $buyer
 * @property Users $seller
 * @property PaymentMethod $paymentMethod
 * @property UserAddress $shippingAddress
 */
class OrdersHistory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OrdersHistory the static model class
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
		return 'orders_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id, service_id, orderStatus_id, total_amount', 'required'),
			array('change_type', 'numerical', 'integerOnly'=>true),
			array('order_id, paymentMethod_id, shippingAddress_id, total_amount', 'length', 'max'=>10),
			array('service_id, orderStatus_id, buyer_id, merchant_id, seller_id', 'length', 'max'=>11),
			array('order_reference, tracking_number', 'length', 'max'=>100),
			array('reason, comment', 'length', 'max'=>500),
			array('website', 'length', 'max'=>255),
			array('code', 'length', 'max'=>50),
            array('mobile', 'length', 'max'=>15),
            array('ip_address', 'length', 'max'=>30),
			array('date_issued, date_accepted, date_delivered, change_comment, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, order_id, service_id, orderStatus_id, mobile, ip_address, buyer_id, merchant_id, seller_id, paymentMethod_id, shippingAddress_id, date_issued, date_accepted, date_delivered, order_reference, total_amount, reason, comment, website, time_created, code, tracking_number, change_comment, change_type, update_time', 'safe', 'on'=>'search'),
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
			'service' => array(self::BELONGS_TO, 'Service', 'service_id'),
			'orderStatus' => array(self::BELONGS_TO, 'OrderStatus', 'orderStatus_id'),
			'buyer' => array(self::BELONGS_TO, 'Users', 'buyer_id'),
			'seller' => array(self::BELONGS_TO, 'Users', 'seller_id'),
			'paymentMethod' => array(self::BELONGS_TO, 'PaymentMethod', 'paymentMethod_id'),
			'shippingAddress' => array(self::BELONGS_TO, 'UserAddress', 'shippingAddress_id'),
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
			'service_id' => 'Service',
			'orderStatus_id' => 'Order Status',
			'buyer_id' => 'Buyer',
			'merchant_id' => 'Merchant',
			'seller_id' => 'Seller',
			'paymentMethod_id' => 'Payment Method',
			'shippingAddress_id' => 'Shipping Address',
			'date_issued' => 'Date Issued',
			'date_accepted' => 'Date Accepted',
			'date_delivered' => 'Date Delivered',
			'order_reference' => 'Order Reference',
			'total_amount' => 'Total Amount',
			'reason' => 'Reason',
			'comment' => 'Comment',
			'website' => 'Website',
			'time_created' => 'Time Created',
			'code' => 'Code',
            'tracking_number' => 'Tracking Number',
            'mobile' => 'Mobile',
			'ip_address' => 'Ip Address',
			'change_comment' => 'Change Comment',
			'change_type' => 'Change Type',
			'update_time' => 'Update Time',
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
		$criteria->compare('service_id',$this->service_id,true);
		$criteria->compare('orderStatus_id',$this->orderStatus_id,true);
		$criteria->compare('buyer_id',$this->buyer_id,true);
		$criteria->compare('merchant_id',$this->merchant_id,true);
		$criteria->compare('seller_id',$this->seller_id,true);
		$criteria->compare('paymentMethod_id',$this->paymentMethod_id,true);
		$criteria->compare('shippingAddress_id',$this->shippingAddress_id,true);
		$criteria->compare('date_issued',$this->date_issued,true);
		$criteria->compare('date_accepted',$this->date_accepted,true);
		$criteria->compare('date_delivered',$this->date_delivered,true);
		$criteria->compare('order_reference',$this->order_reference,true);
		$criteria->compare('total_amount',$this->total_amount,true);
		$criteria->compare('reason',$this->reason,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('time_created',$this->time_created,true);
		$criteria->compare('code',$this->code,true);
        $criteria->compare('tracking_number',$this->tracking_number,true);
        $criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('change_comment',$this->change_comment,true);
		$criteria->compare('change_type',$this->change_type);
		$criteria->compare('update_time',$this->update_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}