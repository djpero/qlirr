<?php

    /**
    * UserIdentity represents the data needed to identity a user.
    * It contains the authentication method that checks if the provided
    * data can identity the user.
    */
    class UserIdentity extends CUserIdentity
    {
        public function authenticate()
        {   
            $user = UsersDao::model()->findByAttributes(array('email'=>$this->username, 'status' => 1));
                
            Yii::app()->user->setState('UserData', $user);
            $users=array(
                // username => password
                $user->email => $user->password,
            );

            if(!isset($users[$this->username]))
                $this->errorCode=self::ERROR_USERNAME_INVALID;
            else if($users[$this->username]!==$this->password)
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
                else
                    $this->errorCode=self::ERROR_NONE;
            return !$this->errorCode;
        }
}