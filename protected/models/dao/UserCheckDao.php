<?php
    class UserCheckDao extends UserCheck
    {
        
        public function checkSSNexist($ssn, $days) {
           // $userCheck =  UserCheck::model()->findByAttributes(array('query_value'=>$ssn, 'type'=>1));

            $criteria = new CDbCriteria;
            $criteria->condition = "query_value = :query_value AND type = :type";
            $criteria->params = array('query_value' => $ssn, 'type' => 1);
            $criteria->order = '`time` DESC';
            $userCheck = UserCheck::model()->findAll($criteria);   
            
            $dateUserCheck = new DateTime($userCheck[0]->time);
            $dateUserCheck->modify("+".$days." days"); 
            $diff=$dateUserCheck->format("Y-m-d H:i:s");   
            $nowTime = date("Y-m-d H:i:s");
            if ($diff > $nowTime) {
                return $userCheck[0];
            }
            
//            return $userCheck[0]->time;
            
        }
        public function checkPHONEexist($phone) {
            return UserCheck::model()->findByAttributes(array('query_value'=>$phone, 'type'=>0));
        }
        public function getUserBySSN($ssn, $days) {
            $modelCheckExist = UserCheckDao::checkSSNexist($ssn, $days);    
            if (count($modelCheckExist)<1) {
                    $wsdl = 'https://www.bisgateway.com/brg/services/NRGDecisionSupportDSC?wsdl';
                    $soapHeader =  '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:brg="http://www.dnbnordic.com/brg" xmlns:req="http://www.dnbnordic.com/brg/NRGDecisionSupportDSC/request">
                                    <soapenv:Header>
                                       <brg:customerReference>?</brg:customerReference>
                                       <brg:deliveryAddress>?</brg:deliveryAddress>
                                       <brg:userPassword></brg:userPassword>
                                       <brg:userId>BDFF</brg:userId>
                                       <brg:customerCode>EIO1</brg:customerCode>
                                       <brg:customerCodeOwner>EIO1</brg:customerCodeOwner>
                                       <req:language>se</req:language>
                                       <req:fromCountry>se</req:fromCountry>
                                       <req:toCountry>se</req:toCountry>
                                    </soapenv:Header>   <soapenv:Body>
                                       <req:nRGDecisionSupportDSCRequest>
                                          <req:criteria>';
                    $soapFooter = '<req:appliedCredit>2</req:appliedCredit>
                                    <req:statedIncomeCoApp>?</req:statedIncomeCoApp>
                                    <req:dateOfEmployment>?</req:dateOfEmployment>
                                    <req:dateOfEmploymentCoApp>?</req:dateOfEmploymentCoApp>
                                 </req:criteria>
                                 <req:deliveryLetterOfNotice>
                                    <req:cellPhone>?</req:cellPhone>
                                    <req:eMail>?</req:eMail>
                                    <req:freeText>?</req:freeText>
                                 </req:deliveryLetterOfNotice>
                              </req:nRGDecisionSupportDSCRequest>
                           </soapenv:Body>
                        </soapenv:Envelope>';
                    
                    $soap_request = $soapHeader."<req:socialSecurityNumberApplicant>". $ssn  ."</req:socialSecurityNumberApplicant>".$soapFooter;
                    $header = array(
                      "Content-type: text/xml;charset=UTF-8",
                      "Accept: text/xml",
                      "Host: www.bisgateway.com",
                      "Connection: Keep-Alive",
                      "User-Agent: Apache-HttpClient/4.1.1 (java 1.5)",
                      "SOAPAction: NRGDecisionSupportDSC",
                      "Content-length: ".strlen($soap_request),
                    );
                    $soap_do = curl_init();
                    curl_setopt($soap_do, CURLOPT_URL, $wsdl );
                    curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
                    curl_setopt($soap_do, CURLOPT_TIMEOUT,        10);
                    curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true );
                    curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
                    curl_setopt($soap_do, CURLOPT_POST,           true );
                    curl_setopt($soap_do, CURLOPT_POSTFIELDS,     $soap_request);
                    curl_setopt($soap_do, CURLOPT_HTTPHEADER,     $header);
                    $response = curl_exec($soap_do);
                    if($response === false) {
                      $err = 'Curl error: ' . curl_error($soap_do);
                      curl_close($soap_do);
                      print $err;
                    } else {

                        $modelCheck = new UserCheck;
                          $modelCheck->type        = 1; // type 1 is check by SSN
                          $modelCheck->query_value = $ssn;
                          $modelCheck->url         = $wsdl;
                          $modelCheck->result      = $response;
                        $modelCheck->save();
                        
                        curl_close($soap_do);
                        return $modelCheck;
                    }
            } else {
                return $modelCheckExist;
            }
        }
        public function getElementBySsn($element, $ssn) {
            $days = ApplicationSettings::model()->findByAttributes(array('setting_name' => 'daysToNewCheckBisnode'));
            $modelCheck = UserCheckDao::getUserBySSN($ssn, $days->setting_value);
            
            $doc = new DOMDocument();
            $doc->loadXML( $modelCheck->result );
            $LoginResults = $doc->getElementsByTagName($element);
            //print_r($LoginResults);
            $arrayW = array();
            foreach($LoginResults as $node) {
                $arrayW[]=$node;
            }
            return $arrayW[0]->nodeValue;
        }
         public function getElementByPhone($element, $phone) {
            $modelCheck = UserCheckDao::phoneCheck($phone);
            
            $doc = new DOMDocument();
            $doc->loadXML( $modelCheck->result );
            $LoginResults = $doc->getElementsByTagName($element);
            //print_r($LoginResults);
            $arrayW = array();
            foreach($LoginResults as $node) {
                $arrayW[]=$node;
            }
            return $arrayW[0]->nodeValue;
        }
      
        public function getElementByBank($id) {
            $modelCheck = InstantorXmlDao::getInstantorData($id);
            if (count($modelCheck)>0) {
              return $modelCheck->ssn;  
            } else {
                return "count:0";
            }
            
        }
        
        public function phoneCheck($phone) {
            $modelCheckExist = UserCheckDao::checkPHONEexist($phone);    
            if (count($modelCheckExist)<1) {
            
                $par = new stdClass();
                //---------------------------------- RADI / NE RADI
                $par->UserId ="Cust"; // ----------- JOGR / CUST
                $par->Password ="CumOrr11"; //------ ukn699 / cu#mOr11
                $par->QueryParams->FindTelephone = $phone; // TREBA STAVITI $phone
                // ----------- kolone koje se traze -------------
                $par->QueryColumns->Vkid                    ="1";
                $par->QueryColumns->FirstName               ="1";
                $par->QueryColumns->MiddleName              ="1";
                $par->QueryColumns->LastName                ="1";
                $par->QueryColumns->Gender                  ="1";
                $par->QueryColumns->SSNo                    ="1";
                $par->QueryColumns->Title                   ="1";
                $par->QueryColumns->CoName                  ="1";
                $par->QueryColumns->StreetName              ="1";
                $par->QueryColumns->FullStreetName          ="1";
                $par->QueryColumns->StreetNumber            ="1";
                $par->QueryColumns->StreetSuffix            ="1";
                $par->QueryColumns->TextBeforeLocality      ="1";
                $par->QueryColumns->ZipCode                 ="1";
                $par->QueryColumns->Locality                ="1";
                $par->QueryColumns->CountyCode              ="1";
                $par->QueryColumns->CommunityCode           ="1";
                $par->QueryColumns->ParishCode              ="1";
                $par->QueryColumns->XCoord                  ="1";
                $par->QueryColumns->YCoord                  ="1";
                $par->QueryColumns->MaxDiff                 ="1";
                $par->QueryColumns->CountyName              ="1";
                $par->QueryColumns->CommunityName           ="1";
                $par->QueryColumns->ParishName              ="1";
                $par->QueryColumns->Telephones              ="1";
                $par->QueryColumns->TelephoneTexts          ="1";
                $par->QueryColumns->Mobiles                 ="1";
                $par->QueryColumns->MobileTexts             ="1";
                $par->QueryColumns->MobileUsage             ="1";
                $par->QueryColumns->SSNoMainUser            ="1";
                $par->QueryColumns->Internet                ="1";
                $par->QueryColumns->TeleRestriction         ="1";
                $par->QueryColumns->MailRestriction         ="1";
                $par->QueryColumns->BirthDate               ="1";
                $par->QueryColumns->Deceased                ="1";
                $par->QueryColumns->IndividualId            ="1";
                $par->QueryColumns->HouseholdId             ="1";
                $par->QueryColumns->AdRestriction           ="1";
                $par->QueryColumns->Fb_FirstName            ="1";
                $par->QueryColumns->Fb_GivenName            ="1";
                $par->QueryColumns->Fb_MiddleName           ="1";
                $par->QueryColumns->Fb_LastName             ="1";
                $par->QueryColumns->Fb_CoName               ="1";
                $par->QueryColumns->Fb_StreetName           ="1";
                $par->QueryColumns->Fb_FullStreetName       ="1";
                $par->QueryColumns->Fb_StreetNumber         ="1";
                $par->QueryColumns->Fb_StreetSuffix         ="1";
                $par->QueryColumns->Fb_ZipCode              ="1";
                $par->QueryColumns->Fb_Locality             ="1";
                $par->QueryColumns->Fb_CountyCode           ="1";
                $par->QueryColumns->Fb_CommunityCode        ="1";
                $par->QueryColumns->Fb_ParishCode           ="1";
                $par->QueryColumns->Fb_XCoord               ="1";
                $par->QueryColumns->Fb_YCoord               ="1";
                $par->QueryColumns->Fb_MaxDiff              ="1";
                $par->QueryColumns->Fb_CountyName           ="1";
                $par->QueryColumns->Fb_CommunityName        ="1";
                $par->QueryColumns->Fb_ParishName           ="1";
                $par->QueryColumns->Fb_MailRestriction      ="1";
                
                
                $params->FindPerson = $par;
                $wsdl = "http://api.teleadress.se/WSDL/nnapiwebservice.wsdl";
                $client = new SoapClient($wsdl, array( "trace" => 1,"exceptions" => 0 ) );

                $response = $client->Find($params);
                
                $modelCheck = new UserCheck;
                    $modelCheck->type        = 0; // type 1 is check by PHONE
                    $modelCheck->query_value = $phone;
                    $modelCheck->url         = $wsdl;
                    $modelCheck->result      = $client->__getLastResponse();
                $modelCheck->save();
                return $modelCheck;
                
            } else {
                return $modelCheckExist;
            }
    }  
       public function checkSSN($ssn) {

                    $wsdl = 'https://www.bisgateway.com/brg/services/NRGDecisionSupportDSC?wsdl';
                    $soapHeader ='<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:brg="http://www.dnbnordic.com/brg" xmlns:request="http://www.dnbnordic.com/brg/NRGDecisionSupportDSC/request">
                                <SOAP-ENV:Header>
                                   <brg:deliveryAddress>?</brg:deliveryAddress>
                                   <brg:userPassword>CumOrr11</brg:userPassword>
                                   <brg:userId>Cust</brg:userId>
                                   <brg:customerCode>EIO1</brg:customerCode>
                                   <brg:customerCodeOwner>EIO1</brg:customerCodeOwner>
                                   <request:language>se</request:language>
                                   <request:fromCountry>se</request:fromCountry>
                                   <request:toCountry>se</request:toCountry>
                                </SOAP-ENV:Header>
                                <SOAP-ENV:Body>
                                   <request:nRGDecisionSupportDSCRequest>
                                      <request:criteria>';
                                       $soapFooter = '</request:criteria>
                                   </request:nRGDecisionSupportDSCRequest>
                                </SOAP-ENV:Body>
                              </SOAP-ENV:Envelope>';
                    $soap_request = $soapHeader."<request:socialSecurityNumberApplicant>". $ssn  ."</request:socialSecurityNumberApplicant><request:appliedCredit>10</request:appliedCredit>".$soapFooter;
                    $header = array(
                      "Content-type: text/xml;charset=UTF-8",
                      "Accept: text/xml",
                      "Host: www.bisgateway.com",
                      "Connection: Keep-Alive",
                      "User-Agent: Apache-HttpClient/4.1.1 (java 1.5)",
                      "SOAPAction: NRGDecisionSupportDSC",
                      "Content-length: ".strlen($soap_request),
                    );
                    $soap_do = curl_init();
                    curl_setopt($soap_do, CURLOPT_URL, $wsdl );
                    curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
                    curl_setopt($soap_do, CURLOPT_TIMEOUT,        10);
                    curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true );
                    curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
                    curl_setopt($soap_do, CURLOPT_POST,           true );
                    curl_setopt($soap_do, CURLOPT_POSTFIELDS,     $soap_request);
                    curl_setopt($soap_do, CURLOPT_HTTPHEADER,     $header);
                    $response = curl_exec($soap_do);
                    return $response;    
        
            }
    }
?>