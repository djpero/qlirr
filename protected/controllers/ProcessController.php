<?php

class ProcessController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
        public function actionrevolving() {
            $datas  = $_GET['data']; 
            $data   = explode(",", $datas);
            echo $this->getRevolvingRate($data[0], $data[1], $data[2]).'|'.$this->getRevolvingRemain($data[0], $data[1], $data[2]);
        }
        
        public function actioninstallments() {
            $vars = explode(",", $_GET['data']);
            echo $this->getCreditBrutto($vars[0], $vars[1], $vars[2]);
            
        }
        
        public function getRevolvingRate($loan, $yearRate, $minRepay) {
            $rate1 = ($loan*$minRepay)/100;
            $rate2 = ($loan*$yearRate)/100;
            $rate  = $rate1+($rate2/12);
            return $rate;
        }
        
        public function getRevolvingRemain($loan, $yearRate, $minRepay) {
            $rate1 = ($loan*$minRepay)/100;
            $rate2 = ($loan*$yearRate)/100;
            $remain  = $loan-$rate1;
            return $remain;
        }
        
        public function getCreditBrutto($loan, $yearRate, $noofInstallments) {
            $in_years       = floor($noofInstallments/12);
            $in_months      = $noofInstallments - ($in_years*12);
//          --------------------------------------------------
            $in_months_rate = $in_months * ($yearRate / 12);
            $totalCamats    = $in_years*(($loan*$yearRate)/100)+ ($in_months_rate*$loan/100) ;
            $totalBrutto    = $loan + $totalCamats;
            return $totalBrutto;
        }
        public function getInstallmentsList() {
            
        }
}