<?php
    class CheckFunctions extends Controller
    {

        public function userType()
        {
            if(!Yii::app()->user->isGuest) {
                $user = new UsersDao;
                $type = $user->model()->findByAttributes(array('email'=>Yii::app()->user->name));

                if($type)
                    return $type->userType_id;

                return 0;
            } else {
                return 0;
            }  
        }

        public function userId()
        {
            if(!Yii::app()->user->isGuest)
            {
                $user = new UsersDao;
                $type = $user->model()->findByAttributes(array('mobile_number'=>Yii::app()->user->name));

                return $type->id;
            }   
            else
            {
                return false;
            }
        }

        public function userData() {
            return UsersDao::model()->findByAttributes(array("mobile_number" => Yii::app()->user->name));  
        }

        public function checkOib($fname, $lname, $boi_jmbg, $checkOib = true)
        {
            $personalNumberFetcher = new PersonalNumberFetcher();
            $personData = $personalNumberFetcher->getData($fname, $lname, $boi_jmbg);

            $error = 0;
            $customerOib = null;
            
            if($checkOib)
                $customerOib = UsersDao::model()->findByAttributes(array("id_number" => $personData['personalNumber'], 'status' => 1));
            //$customerOib = null;

            if ($personData != null)
            {
                (strcasecmp(GeneralFunctions::strtolower_utf8($fname), GeneralFunctions::strtolower_utf8($personData['firstname'])) == 0 ? '' : $error = 1);
                (strcasecmp(GeneralFunctions::strtolower_utf8($lname), GeneralFunctions::strtolower_utf8($personData['lastname'])) == 0 ? '' : $error = 1);

                /*if($logged != 1)
                $customerOib = $customerOibDAO->findByIdentNumber2($personData['personalNumber']);*/
            }

            if ($personData == null || $error != 0 || $customerOib != null) {
                if($personData == null || $error != 0)
                    return 'error';
                else
                    return 'OIBerror';
            }

            //$this->session->userOib = $personData['personalNumber'];
            return $personData['personalNumber'];
        }
    }
?>
