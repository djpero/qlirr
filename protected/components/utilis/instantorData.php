<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of instantorData
 *
 * @author Pero
 */
class instantorData {
    //put your code here
    
    public function getStatus($xml) {
        return $xml->{'basic-info'}->{'scrape-report'}->status;
    }
    public function getBankName($xml) {
        return $xml->{'basic-info'}->bank->name;
    }
    public function getBankAbbr($xml) {
        return $xml->{'basic-info'}->bank->abbr;
    }
    public function getUserName($xml) {
        return $xml->{'basic-info'}->username;
    }
    public function getLastName($xml) {
        return $xml->{'basic-info'}->misc->entry[0];
    }
    public function getFirstName($xml) {
        return $xml->{'basic-info'}->misc->entry[1];
    }
    public function getUserID($xml) {
        return $xml->{'basic-info'}->misc->entry[2];
    }
    public function getUserPersonalNo($xml) {
        return $xml->{'basic-info'}->misc->entry[3];
    }
    
}

?>
