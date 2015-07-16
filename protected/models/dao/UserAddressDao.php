<?php
    class UserAddressDao extends UserAddress 
    {
        public function getUserAddressOptions()
        {
            return CHtml::listData(UserAddress::model()->findAll(), 'id', 'FullUserAddress');   
        }
        
        public function getBuyerAddressOptions($id)
        {
            return CHtml::listData(UserAddress::model()->findAllByAttributes(array('user_id'=>$id)), 'id', 'FullUserAddress');   
        }

        public function getUserAddressByIdOptions($user_id, $address_type = 1)
        {
            $criteria = new CDbCriteria;
            $criteria->condition = "user_id = :user_id AND address_type = :address_type";
            $criteria->params = array('user_id' => $user_id, 'address_type' => $address_type);
            $criteria->order = '`primary` DESC';
            return CHtml::listData(UserAddressDao::model()->findAll($criteria), 'id', 'fullUserAddress');   
        }

        public function getUserAddress()
        {
            return UserAddressDao::model()->findByAttributes(array("user_id" => $this->user->id, "active" => 1, "address_type" => 0));
        }

        public function getUserAddressesByType($type)
        {
            return UserAddressDao::model()->findAllByAttributes(array('address_type'=>$type, "active" => 1, 'user_id'=>CheckFunctions::userId()));  
        }

        public function getUserAddressesByTypeAndUserId($user_id, $type)
        {
            return UserAddressDao::model()->findAllByAttributes(array('address_type'=>$type, "active" => 1, 'user_id'=>$user_id));  
        }

        public function getUserPrimaryAddressesByType($type)
        {
            return UserAddressDao::model()->findByAttributes(array('address_type'=>$type, "active" => 1, "primary" => 1, 'user_id'=>CheckFunctions::userId()));  
        }

        public function getPrimaryAddressByTypeAndUserId($id, $type)
        {
            return UserAddressDao::model()->findByAttributes(array('address_type'=>$type, "active" => 1, "primary" => 1, 'user_id'=>$id));  
        }

        public function getAddressById($id)
        {
            return UserAddressDao::model()->findByPk($id);    
        }
        public function getAllAddresses($id)
        {
            $criteria = new CDbCriteria;
            $criteria->condition = '(user_id = :user_id)';
            $criteria->params = array("user_id" => $id);
            $criteria->order = 'address_type';
            return UserAddress::model()->findAll($criteria);
        }
 
    }
?>
