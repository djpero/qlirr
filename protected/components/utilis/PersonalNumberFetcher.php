<?php
    class PersonalNumberFetcher {

        public function getData($firstName, $lastName, $personalNo) {
            $user = Yii::app()->params['oibSvcUsername'];
            $pass = Yii::app()->params['oibSvcPassword'];

            if (empty($user) || empty($pass)) {
                return null;
            }

            // Important to encode:
            $firstName = urlencode($firstName);
            $lastName = urlencode($lastName);

            $serviceUrl = "https://instantkredit.hr/check/?user={$user}&pass={$pass}&ime={$firstName}&prezime={$lastName}&boi_jmbg={$personalNo}";
            
            $handle = curl_init();
            curl_setopt($handle, CURLOPT_HEADER, false);
            curl_setopt($handle, CURLOPT_URL, $serviceUrl);
            curl_setopt($handle, CURLOPT_ENCODING , 'UTF-8');
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($handle);

            if (!isset($response) || $response == '') {
                return null;
            }

            $responseXML = simplexml_load_string($response);

            $status = $responseXML->harvest->attributes()->status;
            if ($status != 'success') {
                return null;
            }

            $fPattern = "@<fname(?:\s.*?!/)?>(.*?)</fname\s*>@s";
            $lPattern = "@<lname(?:\s.*?!/)?>(.*?)</lname\s*>@s";
            $oibPattern = "@<oib(?:\s.*?!/)?>(.*?)</oib\s*>@s";
            $jmbgPattern = "@<boi_jmbg(?:\s.*?!/)?>(.*?)</boi_jmbg\s*>@s";

            //$response = preg_replace('/\s+/', '', $response);
            preg_match($fPattern, $response, $fMatch);
            preg_match($lPattern, $response, $lMatch);
            preg_match($jmbgPattern, $response, $jmbgMatch);
            preg_match($oibPattern, $response, $oibMatch);

            $jmbg = $jmbgMatch[1];
            $result = array(
                'firstname' => $fMatch[1],
                'lastname' => $lMatch[1],
                'personalNumber' => $oibMatch[1],
                'personalNumber2' => $jmbg,
                'age' => $this->getDOB($jmbg),
                'gender' => $this->getGender($jmbg)
            );


            return $result;
        }

        public function getDataFromPermutations($fullname, $personalNo) {
            if (empty($fullname)) {
                return null;
            }

            $arr = explode(' ', $fullname);
            // TODO Fullnames with 2+ parts

            $perm = new Permutations();
            $a = $perm->permute($arr);

            $result = null;
            foreach ($a as $permutation) {
                $result = $this->getData($permutation[0], $permutation[1], $personalNo);
                if ($result != null) {
                    break;
                }
            }

            return $result;
        }

        public function getDOB($jmbg) {
            if (empty($jmbg) || strlen($jmbg) != 13) {
                return null;
            }

            $day = substr($jmbg, 0, 2);
            $month = substr($jmbg, 2, 2);

            $year = substr($jmbg, 4, 3);
            ($year > 100) ? $year = '1' . (string)$year : $year = '2' . (string)$year;

            $ts = mktime(0, 0, 0, $month, $day, $year);
            //$dob = new DateTime('now');
            //$dob->setTimestamp($ts);

            return $ts;
        }

        public function getGender($jmbg) {
            if (empty($jmbg) || strlen($jmbg) != 13) {
                return null;
            }

            $genderCode = substr($jmbg, 9, 3);

            $gender = null;
            if ($genderCode >= 0 && $genderCode <=499) {
                $gender = "M";
            } else {
                $gender = "F";
            }

            return $gender;
        }
    }
