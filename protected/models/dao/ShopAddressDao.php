<?php
    class ShopAddressDao extends ShopAddress  
    {
        public function getAll() {
            return ShopAddress::model()->findAll();
        }
        public function getAddressByShopId($shop) {
            return ShopAddress::model()->findByAttributes(array('user_id'=>$shop));
        }
        public function getPrimaryAddressByShopId($shop) {
            return ShopAddress::model()->findByAttributes(array('user_id'=>$shop, 'address_type'=>0));
        }
        public function getLegalAddressByShopId($shop) {
            return ShopAddress::model()->findByAttributes(array('user_id'=>$shop, 'address_type'=>1));
        }
        public function getList($text) {
            $model = ShopAddress::model()->findAll(array(
                'condition'=>'street LIKE :code OR city LIKE :code OR post_code LIKE :code',
                'params'=>array(':code'=>'%'.$text.'%')
            ));
            return $model;
        }
        public function getListByCityLatLng($lat, $lng, $dst) {
            $model = ShopAddress::model()->findAll();
            $x=0;
            $results = array();
            do {
                $distance = ShopAddressDao::vincentyGreatCircleDistance($lat, $lng, $model[$x]->pos_lat, $model[$x]->pos_lng);
                if($distance < $dst ) {
                    $results[] = array('user_id' => $model[$x]->user_id,
                                       'street'=> $model[$x]->street,
                                       'city' =>$model[$x]->city,
                                       'post_code' =>$model[$x]->post_code,
                                       'pos_lat' =>$model[$x]->pos_lat,
                                       'pos_lng' =>$model[$x]->pos_lng);
                }
            
            $x++;
            } while ($x < count($model));
            return $results;
        }
        public function vincentyGreatCircleDistance(
            $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
          {
            // convert from degrees to radians
            $latFrom = deg2rad($latitudeFrom);
            $lonFrom = deg2rad($longitudeFrom);
            $latTo = deg2rad($latitudeTo);
            $lonTo = deg2rad($longitudeTo);

            $lonDelta = $lonTo - $lonFrom;
            $a = pow(cos($latTo) * sin($lonDelta), 2) +
              pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
            $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

            $angle = atan2(sqrt($a), $b);
            return $angle * $earthRadius;
        }
    }
    
?>
