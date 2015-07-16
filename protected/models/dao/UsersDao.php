<?php
    class UsersDao extends Users 
    {
        public $initialPassword;

        public function beforeSave()
        {
            // in this case, we will use the old hashed password.
            if(empty($this->old_password))
                $this->old_password = $this->initialPassword;


            if(empty($this->password) && empty($this->repeat_password) && !empty($this->initialPassword))
            {

                $this->password = $this->initialPassword;
                $this->repeat_password = $this->initialPassword;
            }

            return parent::beforeSave();
        }

        public function afterFind()
        {
            //reset the password to null because we don't want the hash to be shown.
            $this->initialPassword = $this->password;
            //$this->password = null;

            parent::afterFind();
        }

        public function saveModel($data=array())
        {
            //because the hashes needs to match
            if(!empty($data['password']) && !empty($data['repeat_password']))
            {
                $data['password'] = sha1($data['password']);
                $data['repeat_password'] = sha1($data['repeat_password']);
            }

            $this->attributes = $data;

            if(!$this->save())
                return CHtml::errorSummary($this);

            return true;
        }

        public function getUserData($user_id)
        {
            return Users::model()->findByPk($user_id);
        }

        public function getUserOptions()
        {
            return CHtml::listData(Users::model()->findAll(), 'id', 'fullName');   
        }

        public function getFullName()
        {
            return $this->name." ".$this->surname;
        }

        public function msgSenderReceiver($user_id)
        {
            $naziv = UsersDao::model()->findByAttributes(array('id'=>$user_id));

            $name = $naziv->name . ' ' . $naziv->surname;

            return $name;    
        }
        public function getUserById($id) {
            return UsersDao::model()->findByAttributes(array('id'=>$id));
     
        }
         public function getUserByMobile($mobile) {
            return UsersDao::model()->findByAttributes(array('mobile_number'=>$mobile));
         }
          public function getUserBySSN($ssn) {
            return UsersDao::model()->findByAttributes(array('personal_number'=>$ssn));
         }
         public function getUserByNickName($nick) {
             return UsersDao::model()->findByAttributes(array('nick'=>$nick));
         }
         public function getAllUsers() {
             return UsersDao::model()->findAllByAttributes(array('status'=>'1'));             
         }

             
    }
?>
