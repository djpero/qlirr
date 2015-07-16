<?php
    class ECountDown extends CWidget
    {
        private static $unique;
        public $seconds = 10;
        public $follow = null;
        public $up = FALSE;
        public $style = NULL;

        private function getUniqueId()
        {
            return md5(++self::$unique);
        }

        public function init()
        {
            if ($this->follow == null) {
                $this->follow = Yii::app()->createUrl('site/login');
            }

            Yii::app()->getClientScript()
            ->registerCoreScript('jquery')
            ->registerScript('countDown', '
                var expired = false;
                function countDown() {
                $(".countdown").each(function() {
                var valore = parseInt($(this).attr(\'value\')) '. ($this->up?'+':'-') .' 1;

                if(typeof(valore_iniziale) == \'undefined\') {
                valore_iniziale = valore;
                }

                $(this).attr(\'value\',valore);

                secondi = valore'. ($this->up?'-'.$this->seconds:'') .';
                _secondi = secondi % 60;
                _minuti = ((secondi - _secondi) / 60) % 60;
                _ore = (secondi - _secondi - _minuti * 60) / 3600;
                _ore = _ore < 10 ? "0"+_ore : _ore;
                _minuti = _minuti < 10 ? "0"+_minuti : _minuti;
                _secondi = _secondi < 10 ? "0"+_secondi : _secondi;

                $("#"+$(this).attr("rel")).html(_ore+":"+_minuti+":"+_secondi);
                if((valore-'.$this->seconds.' >= valore_iniziale-1) || (' . ($this->up ? 'valore-'.$this->seconds.' == 0' : 'valore <= 0') . ')) {
                document.location.href = "' . $this->follow . '";
                expired = true;
                return false;
                }
                ;
                });
                if(!expired)
                setTimeout("countDown();", 1000)
                }', CClientScript::POS_END)
            ->registerScript('callcountDown', 'countDown()', CClientScript::POS_END);
        }

        public function run()
        {
            $id = $this->getUniqueId();
            echo '
            <div id="' . $id . '_box" '.($this->style != NULL ? 'style="'.$this->style.'">' : '').'
            <input type="hidden" rel="' . $id . '" class="countdown" value="' . ($this->seconds) . '"><span id="' . $id . '"></span>
            </div>';
        }

}