<?php

    class InstantorParser
    {

        private $xml;

        public function __construct($xml)
        {
            $this->xml = $xml;
        }

        public function getXml()
        {
            return $this->xml;
        }

        public function getBasicInfo()
        {
            if ($this->xml == null)
            {
                return null;
            }

            $providerData = array();
            $statusCode = (string) $this->xml->{'user-list'}->user->report->status;

            if ($statusCode === 'ok')
            {
                $providers = $this->xml->{'user-list'}->user->identification->provider;

                foreach ($providers as $provider)
                {
                    $attribs = $provider->attributes();
                    $providerId = (string) $attribs['id'];

                    $data = array();
                    foreach ($provider->info as $info)
                    {
                        $attribs = $info->attributes();
                        $attribName = (string) $attribs['field'];

                        $data[$attribName] = trim((string) $info);
                    }
                    $providerData[] = array(
                        $providerId => $data
                    );
                }

                $result = array();

                $result['peydo'] = $this->parseProvider($providerData[0]);
                $result['personal'] = $this->parseProvider($providerData[1]);

                // Parse scoring data

                $result['scores'] = $this->getScoringInfo();
                $result['transactions'] = $this->getTransactionsInfo();
                $result['foreclosures'] = $this->getForeclosuresInfo();
                $result['bankAccount'] = $this->getBankAccount();
            }

            return $result;
        }

        public function isSplitBank()
        {
            if ($this->xml == null)
            {
                return null;
            }

            $bank = $this->xml->xpath("/payload/user-list/user/identification/provider[@id='Bank-sb-HR']");

            return ($bank) ? true : false;
        }

        public function getBankAccount()
        {
            if ($this->xml == null)
            {
                return null;
            }

            $debugList = $this->xml->xpath('//transaction/@account');

            return (count($debugList) > 0) ? (string) $debugList[0]->account : null;
        }

        public function getScoringInfo()
        {
            if ($this->xml == null)
            {
                return null;
            }

            $scoresData = array();

            $scores = $this->xml->{'user-list'}->user->scoring;
            foreach ($scores->variable as $variable)
            {
                $attribs = $variable->attributes();
                $id = $attribs['id'];

                $data = array();
                if (isset($attribs['months']))
                {
                    $data['months'] = (string) $attribs['months'];
                }

                if (property_exists($variable, 'above'))
                {
                    $bellowAttribs = $variable->above->attributes();
                    foreach ($bellowAttribs as $name => $value)
                    {
                        $data['above_' . (string) $name] = (string) $value;
                    }
                    $data['above'] = (string) $variable->above;
                }

                if (property_exists($variable, 'below'))
                {
                    $bellowAttribs = $variable->below->attributes();
                    foreach ($bellowAttribs as $name => $value)
                    {
                        $data['below_' . (string) $name] = (string) $value;
                    }
                    $data['below'] = (string) $variable->below;
                }

                $scoresData[(string) $id] = $data;
            }

            return $scoresData;
        }

        public function getTransactionsInfo()
        {
            if ($this->xml == null)
            {
                return null;
            }

            $result = array();

            $debugList = $this->xml->{'user-list'}->user->{'variable_debug-list'};
            foreach ($debugList->variable as $variable)
            {
                $id = (string) $variable['id'];

                if ($id !== 'income_suggestions')
                {
                    continue;
                }

                foreach ($variable->month as $month)
                {
                    $mon = (string) $month['month'];

                    $monTotal = 0;
                    $monCount = 0;
                    foreach ($month->transaction as $transaction)
                    {
                        $moneyIn = (string) $transaction->money_in / 100;
                        $monTotal += $moneyIn;
                        $monCount ++;
                    }

                    $monAvg = 0;
                    if ($monCount > 0)
                    {
                        $monAvg = round($monTotal / $monCount, 2);
                    }

                    $key = str_replace('-', '', $mon);
                    $result[$key] = array(
                        'count' => $monCount,
                        'avg' => $monAvg,
                        'total' => $monTotal
                    );
                }
            }

            // Important: sort months in ascending order
            ksort($result);

            return $result;
        }

        public function getForeclosuresInfo()
        {
            if ($this->xml == null)
            {
                return null;
            }

            $result = array();

            $debugList = $this->xml->{'user-list'}->user->{'variable_debug-list'};
            foreach ($debugList->variable as $variable)
            {
                $id = (string) $variable['id'];

                if ($id !== 'foreclosures')
                {
                    continue;
                }

                foreach ($variable->month as $month)
                {
                    $mon = (string) $month['month'];
                    $monCount = count($month->transaction);

                    $key = str_replace('-', '', $mon);
                    $result[$key] = array(
                        'count' => $monCount
                    );
                }
            }

            // Important: sort months in ascending order
            ksort($result);

            return $result;
        }

        protected function parseProvider(array $providerData)
        {
            $result = array();
            if (isset($providerData['Bank-zaba-HR']))
            {
                $result = $providerData['Bank-zaba-HR'];

                // Name
                $result['name'] = str_replace('  ', ' ', $result['name']);
                $result['fullname'] = ucwords(strtolower($result['name']));
                // Address
                preg_match('/^(.*), ([\d]{5}) (.*)$/', $result['residence_address'], $matches);

                $result['street'] = $matches[1];
                $result['zip'] = $matches[2];
                $result['city'] = $matches[3];
                $result['bank'] = 2360000;
            }
            else if (isset($providerData['Bank-pbz-HR']))
            {
                $result = $providerData['Bank-pbz-HR'];

                // Name
                $result['name'] = str_replace('  ', ' ', $result['name']);
                $result['fullname'] = ucwords(strtolower($result['name']));
                // Address
                $result['street'] = $result['address'];
                preg_match('/^([\d]{5}) (.*)$/', $result['city'], $matches);
                $result['zip'] = $matches[1];
                $result['city'] = $matches[2];
                $result['bank'] = 2340009;
            }
            else if (isset($providerData['Bank-erste-HR']))
            {
                $result = $providerData['Bank-erste-HR'];

                // Name
                $result['name'] = str_replace('  ', ' ', $result['name']);
                $result['fullname'] = ucwords(strtolower($result['name']));
                // Address
                $result['street'] = $result['address'];
                preg_match('/^([\d]{5}) (.*)$/', $result['city'], $matches);
                $result['zip'] = $matches[1];
                $result['city'] = $matches[2];
                $result['bank'] = 2402006;
            }
            else if (isset($providerData['Bank-hypo-HR']))
            {
                $result = $providerData['Bank-hypo-HR'];

                // Name
                $result['name'] = str_replace('  ', ' ', $result['name']);
                $result['fullname'] = ucwords(strtolower($result['name']));
                // Address
                $result['street'] = $result['address'];
                // zip and city are already correct
                $result['bank'] = 2500009;
            }
            else if (isset($providerData['Bank-rba-HR']))
            {
                $result = $providerData['Bank-rba-HR'];

                // Name
                $result['name'] = str_replace('  ', ' ', $result['name']);
                $result['fullname'] = ucwords(strtolower($result['name']));

                // Address
                preg_match('/^(.*), ([\d]{5}) (.*)$/', $result['address'], $matches);

                $result['street'] = $matches[1];
                $result['zip'] = $matches[2];
                $result['city'] = $matches[3];
                $result['bank'] = 2484008;
            }
            else if (isset($providerData['Bank-sb-HR']))
            {
                $result = $providerData['Bank-sb-HR'];

                // Name
                $result['name'] = str_replace('  ', ' ', $result['name']);
                $result['fullname'] = ucwords(strtolower($result['name']));

                // Address
                if (isset($result['address']))
                {
                    preg_match('/^(.*), ([\d]{5}) (.*)$/', $result['address'], $matches);

                    $result['street'] = $matches[1];
                    $result['zip'] = $matches[2];
                    $result['city'] = $matches[3];

                }
                $result['bank'] = 2330003;
            }
            else if (isset($providerData['peydo.hr']))
            {
                $result = $providerData['peydo.hr'];
            }

            return $result;
        }

        public function checkXml($return = false)
        {
            $oib = $_GET['oib'];
            $date = date('Y-m-d H:i:s');

            $xmlDb = InstantorParser::checkXMLFromDB($oib, $date);

            $startTime = time();
            $endTime = time();


            while (true)
            {
                if ($xmlDb != "error")
                {
                    if($return)
                        return $xmlDb;
                    echo $xmlDb;
                    break;
                    // call the procedure you wish to call
                }
                elseif ($endTime - $startTime > 120)
                {
                    if($return)
                        return "error";
                    echo "error";
                    break;
                }
                else
                {
                    // come back again
                    $endTime = time();
                    $xmlDb = InstantorParser::checkXMLFromDB($oib, $date);
                    sleep(5);
                    continue;
                }
            }
        }

        public function checkXmlError()
        {
            $startTime = time();
            $endTime = time();
            $date = date('Y-m-d H:i:s');

            $oib = $_GET['oib'];

            // $instantorXML = $instantor->findByInternalName($oib);

            while (true)
            {
                if (InstantorXmlDao::getByUserIdentificationAndStatusAndDate($oib, "invalid_login", $date))
                {
                    $instantorXML = InstantorXmlDao::getByUserIdentificationAndStatusAndDate($oib, "invalid_login", $date);

                    $xmlResponse = $instantorXML->xml;
                    if ($xmlResponse != null)
                    {
                        $xmlObj = simplexml_load_string($xmlResponse);

                        $providers = $xmlObj->{'user-list'}->user->report->status;
                        echo $providers;
                    }
                    // call the procedure you wish to call
                }
                elseif (InstantorXmlDao::getByUserIdentificationAndStatusAndDate($oib, "parse_error", $date))
                {
                    $instantorXML = InstantorXmlDao::getByUserIdentificationAndStatusAndDate($oib, "parse_error", $date);

                    $xmlResponse = $instantorXML->xml;

                    if ($xmlResponse != null)
                    {
                        $xmlObj = simplexml_load_string($xmlResponse);

                        $providers = $xmlObj->{'user-list'}->user->report->status;
                        echo $providers;
                    }

                    break;
                    // call the procedure you wish to call
                }
                elseif ($endTime - $startTime > 30)
                {
                    echo "error";
                    break;
                }
                else
                {
                    // come back again
                    $endTime = time();
                    sleep(5);
                    continue;
                }
            }
        }

        protected function checkXMLFromDB($oib, $date)
        {
            $instantorXML = InstantorXmlDao::getByUserIdentificationAndStatusAndDate($oib, "ok", $date);
            //$instantorXML->xml = @file_get_contents(Yii::getPathOfAlias('application.data.Instantor')."/Amir.xml");

            $return = "error";
            $userBank = false;

            if ($instantorXML)
            {
                $xmlObj = simplexml_load_string($instantorXML->xml);
                $providers = $xmlObj->{'user-list'}->user->identification->provider;

                foreach ($providers as $provider)
                {
                    $attribs = $provider->attributes();
                    $providerId = (string) $attribs['id'];

                    $data = array();
                    foreach ($provider->info as $info)
                    {
                        $attribs = $info->attributes();
                        $attribName = (string) $attribs['field'];

                        $data[$attribName] = trim((string) $info);
                    }
                    $providerData[] = array(
                        $providerId => $data
                    );
                }

                $userBank = isset($providerData[1]['Bank-sb-HR']);

                if (! $userBank)
                    $return = "success";
                else
                    $return = "success-splitska";
            }

            return $return;
        }

        public function addCreditLimit($transactions, $foreclosures)
        {
            $currentMonth = date("Ym", time());
            unset($transactions[$currentMonth]);
            unset($foreclosures[$currentMonth]);

            $foreclosures = array_reverse($foreclosures);

            $creditLimit = Yii::app()->params['creditLimit'];
            $positiveIncomeMonths = Yii::app()->params['positiveIncomeMonths'];
            $positiveIncomeSalary = Yii::app()->params['positiveIncomeSalary'];
            $foreclosureMonths = Yii::app()->params['foreclosureMonths'];
            $foreclosureLastMonthsWithZero = Yii::app()->params['foreclosureLastMonthsWithZero'];
            $foreclosureMonthsTotal = Yii::app()->params['foreclosureMonthsTotal'];
            $totalCash = 0;     

            $transactionsA = array_values($transactions);
            $foreclosuresA = array_values($foreclosures);
            $totalMonthForeClosures = count($foreclosures);

            if($totalMonthForeClosures < $foreclosureMonths)
                $foreclosureMonths = $totalMonthForeClosures;
            
            if(count($transactionsA) >= $positiveIncomeMonths){
                for($i=0;$i < $positiveIncomeMonths; $i++) {
                    $totalCash += $transactionsA[$i]['total'];
                    if($i < $positiveIncomeSalary &&  $transactionsA[$i]['total'] == 0) {
                        $totalCash = 0; break;
                    }
                }

                $totalForeclosures = 0;

                for($i=0;$i < $foreclosureMonths; $i++) {
                    if($i < $foreclosureLastMonthsWithZero && $foreclosuresA[$i]['count'] != 0) {
                        $totalCash = 0; 
                        break;
                    }

                    $totalForeclosures += $foreclosuresA[$i]['count'];
                }

                if($totalForeclosures > $foreclosureMonthsTotal)
                    $totalCash = 0;
            }

            $totalCashAvarage = $totalCash/$positiveIncomeMonths;

            if($totalCashAvarage >= 1000 && $totalCashAvarage < 2000)
                $creditLimit = 500;
            elseif($totalCashAvarage >= 2000 && $totalCashAvarage < 3500)
                $creditLimit = 1000;
            elseif($totalCashAvarage >= 3500 && $totalCashAvarage < 5000)
                $creditLimit = 2000;
            elseif($totalCashAvarage >= 5000 && $totalCashAvarage < 6500)
                $creditLimit = 3000;
            elseif($totalCashAvarage >= 6500 && $totalCashAvarage < 8000)
                $creditLimit = 4000;
            elseif($totalCashAvarage >= 8000 && $totalCashAvarage < 10000)
                $creditLimit = 5000;
            elseif($totalCashAvarage >= 10000 && $totalCashAvarage < 12000)
                $creditLimit = 6000;
            elseif($totalCashAvarage >= 12000 && $totalCashAvarage < 13000)
                $creditLimit = 7000;
            elseif($totalCashAvarage >= 13000 && $totalCashAvarage < 14000)
                $creditLimit = 8000;
            elseif($totalCashAvarage >= 14000 && $totalCashAvarage < 15000)
                $creditLimit = 9000;
            elseif($totalCashAvarage >= 15000)
                $creditLimit = 10000;

            //$user = Yii::app()->user->getState('UserData');
            $userData = UsersDao::model()->findByPk(CheckFunctions::userId());

            $differenceCredit = $creditLimit-$userData->credit_limit;

            $userData->credit_limit = $creditLimit;
            $userData->creditLimit_remaining = $userData->creditLimit_remaining+$differenceCredit;;
            $userData->creditLimit_date = date('Y-m-d H:i:s');
            $userData->save();
        }
}