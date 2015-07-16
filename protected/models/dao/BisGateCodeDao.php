<?php
    class BisGateCodeDao extends BisGateCode
    {
        
        public function getPercentByProbabilityCode($code) {
            return BisGateCode::model()->findByAttributes(array('code'=>$code));
        }

    }
?>