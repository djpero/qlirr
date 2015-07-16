<?php
    class BankAccountDao extends BankAccount 
    {
        public function getBankAccount()
        {
            return BankAccount::model()->findByAttributes(array("user_id" => $this->user->id, "primary" => 1));
        }

        public function getBankAccountsByUserId($user_id)
        {
            return BankAccount::model()->findAllByAttributes(array("user_id" => $user_id, "status" => 1));
        }

        public function getOurBankAccountsOptions()
        {
            return CHtml::listData(BankAccount::model()->findAllByAttributes(array('user_id'=>1)), 'id', 'bank_account');   
        }
        
        public function getUserBankAccountsOptions($id)
        {
            return CHtml::listData(BankAccount::model()->findAllByAttributes(array('user_id'=>$id)), 'id', 'bank_account');   
        }
        
        public function getOurPrimaryAccount()
        {
            return BankAccount::model()->findByAttributes(array('user_id'=>1, 'primary'=>1));   
        }
        
        public function getUserPrimaryAccount($id)
        {
            return BankAccount::model()->findByAttributes(array('user_id'=>$id, 'primary'=>1));   
        }
         public function getUserPrimaryAccountAndBankName($id)
        {
            $infoBankAccount=BankAccount::model()->findByAttributes(array('user_id'=>$id, 'primary'=>1));  
            $infoBankName=BanksDao::model()->findByAttributes(array("id" =>$infoBankAccount->bank_id, "visible" => 1));
            return(array("account"=>$infoBankAccount->bank_account, "name"=>$infoBankName->full_name));
        }

    }
?>
