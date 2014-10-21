<?php
class Triangle {
/**  
* Triangle
*/
/*///Testing input var
	public $a,$b,$c = '';
    public function __construct($cfg=NULL) {
        if ($cfg) {
            $this->config($cfg);
        }
    }
    private function config($cfg='') {
        if (is_string($cfg)) {
            $cfg = require $cfg;
        }
        if (isset($cfg['a'])) {
            $this->a = $cfg['a'];
        }
        if (isset($cfg['b'])) {
            $this->b = $cfg['b'];
        }
        if (isset($cfg['c'])) {
            $this->c = $cfg['c'];
        }
    }
*/
    public function validateInt($a, $b, $c) {
		if(!is_int($a) || !is_int($b) || !is_int($c)) {
			throw new Exception("error int");
        }
    }
	
    public function validateRange($a, $b, $c) {
        if($a < 1 || $b < 1 || $c < 1) {
            throw new Exception('error range');
			return 1;
        }
    }

    public function validateFormation($a, $b, $c) {
        $list = array($a, $b, $c);
        rsort($list);
        if($list[0] >= ($list[1] + $list[2])) {
            throw new Exception('error formation');
        }
    }
	
    public function validateTypes($a, $b, $c) {
        if($a === $b && $b === $c && $c === $a) {
			return 1;//正三角形
        } elseif($a === $b || $b === $c || $c === $a) {
			return 2;//等邊三角形
        } elseif($a !== $b && $b !== $c && $c !== $a) {
		   return 3;//不等邊三角形
        }
    }
}

//$C_Triangle = new Triangle();
//$C_Triangle -> validateInt("1",1,1);