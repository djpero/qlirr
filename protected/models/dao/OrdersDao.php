<?php
    class OrdersDao extends Orders 
    {
        public function getOrdersByShopId($shopId) {
            return Orders::model()->findAllByAttributes(array('seller_id'=>$shopId, 'orderStatus_id'=>'1', 'sync'=>0));
        }
        public function getOrdersByShopIdNotActive($shopId) {
            return Orders::model()->findAllByAttributes(array('seller_id'=>$shopId, 'sync'=>0), 'orderStatus_id <> 1');
        }
        public function getOrdersByShopAll($shopId) {
            return Orders::model()->findAllByAttributes(array('seller_id'=>$shopId));
        }
         public function getOrdersByShopAll2($shopId) {
            return Orders::model()->findAllByAttributes(array('seller_id'=>$shopId, 'orderStatus_id'=> '2'));
        }
        public function getOrderById($id) {
            return Orders::model()->findByAttributes(array('id'=>$id, 'orderStatus_id'=>1));
        }
        public function getOrderByIdAll($id) {
            return Orders::model()->findByAttributes(array('id'=>$id, 'active'=>1));
        }
        public function getOrderFinishedById($id) {
            return Orders::model()->findByAttributes(array('id'=>$id, 'orderStatus_id'=>2));
        }
        public function getOrderAllById($id) {
            return Orders::model()->findByAttributes(array('id'=>$id));
        }
        public function getOrderByIdStatus($id) {
            return Orders::model()->findByAttributes(array('id'=>$id));
        }
        public function getOrderAllButActiveByStatus($id, $status) {
            return Orders::model()->findAllByAttributes(array('active'=>'1', 'seller_id'=>$id, 'orderStatus_id'=>$status));
        }
        public function getOrderAllByPaidToShop($id, $status) {
            return Orders::model()->findAllByAttributes(array('active'=>'1', 'seller_id'=>$id, 'paidToShop'=>$status));
        }
        public function searchByInput($text, $shop_id) {
                $searchitems = str_replace(" ", "|", $text);
                $cond='';
            for ($i = 0; $i < count($searchitems); $i++) {
//                $cond.= ' OR code LIKE '.$searchitems[$i].' OR total_amount LIKE '.$searchitems[$i].' OR DATE_FORMAT(date_accepted, "%d%m%Y") REGEXP "('.$searchitems.')"';
            }
                $model = Orders::model()->findAll(array(
                'condition'=>'code LIKE :code OR total_amount LIKE :code OR DATE_FORMAT(date_accepted,"%Y%m%d") LIKE :code AND seller_id = :shop AND orderStatus_id = 2',
                'params'=>array(':code'=>'%'.$text.'%', ':shop'=> $shop_id)
            ));
//            return 'code LIKE :code OR total_amount LIKE :code OR DATE_FORMAT(date_accepted,"%Y-%m-%d") LIKE :code'.$cond;
               return $model;

        }
        public function searchByInput2($text, $shop_id, $filter) {
            $searchitems = str_replace(" ", "|", $text);
            $cond='';
            for ($i = 0; $i < count($searchitems); $i++) {
//                $cond.= ' OR code LIKE '.$searchitems[$i].' OR total_amount LIKE '.$searchitems[$i].' OR DATE_FORMAT(date_accepted, "%d%m%Y") REGEXP "('.$searchitems.')"';
            }
            $model = Orders::model()->findAll(array(
                'condition'=>'code LIKE :code OR total_amount LIKE :code OR DATE_FORMAT(date_accepted,"%Y%m%d") LIKE :code AND paidToShop = :filter AND seller_id = :shop  AND orderStatus_id = 2'.$cond,
                'params'=>array(':code'=>'%'.$text.'%', ':filter'=>$filter, ':shop'=> $shop_id)
            ));
            return $model;
        }
        public function getPurchasesByUser($buyer) {
            return Orders::model()->findAllByAttributes(array('active'=>1, 'buyer_id'=>$buyer, 'orderStatus_id'=>2));
        }
        public function getSalesByUser($shop) {
            return Orders::model()->findAllByAttributes(array('active'=>1, 'seller_id'=>$shop, 'orderStatus_id'=>2));
        }
        public function getAllOrdersF($orderStatus) {
            if ($orderStatus==2) {
                $model = Orders::model()->findAll(array(
                    'condition'=>'paid_amount>:amount AND  orderStatusF_id != 7 AND orderStatusF_id != 6',
                    'params'=>array(':amount'=>'0'),
                ));
                return $model;
                
            } elseif($orderStatus=='99') {
                return Orders::model()->findAllByAttributes(array('active' => 1));
            } else {
                return Orders::model()->findAllByAttributes(array('active' => 1, 'orderStatusF_id' => $orderStatus));
            }
          
        }
         public function getAllOrdersLike($match) {
            $q = new CDbCriteria();
            $q->addSearchCondition('payment_reference', $match);
            $q->addSearchCondition('orderStatus_id', '2');
            return $orders = Orders::model()->findAll( $q );
            
        }
        
        public function getAllOrdersWithName($match) {
            $q = new CDbCriteria();
            $q->addSearchCondition('name', $match);
            $q->addSearchCondition('surname', $match, true, 'OR');
            $userTemp = Users::model()->find( $q );

            $buyer = $userTemp->id;
            return Orders::model()->findAllByAttributes(array('active' => 1, 'buyer_id' => $buyer, 'orderStatus_id' => 2));
        }
        public function getPercByRef($payRef) {
            return Orders::model()->findByAttributes(array('payment_reference' => $payRef));
        }
        public function getOrdersExpired() {
             return Orders::model()->findAllByAttributes(array('orderStatus_id' => 2, 'paid' => 0, 'orderStatusF_id' => 0));
        }
        public function getOrdersLate() {
            return Orders::model()->findAllByAttributes(array('orderStatusF_id' => 1, 'paid' => 0, 'orderStatus_id' => 2));
        }
        
        public function getAllOrdersWithReminders() {
            $model = Remi::model()->findAll(array(
                'condition'=>'penalityLevel>:penalityLevel',
                'params'=>array(':penalityLevel'=>'0')
            ));
            return $model;
        }
    }
?>
