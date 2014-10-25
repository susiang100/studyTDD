<?php
class NextDate {
/**  
* NextDate
*/
    public function validateInt($a, $b, $c) {
		if(!is_int($a) || !is_int($b) || !is_int($c)) {
			throw new Exception("error int");
			//echo "error int";
        }
    }
	
    public function validateRange($a, $b, $c) {
		$V1_a = 1000;
		$V2_a = 9999;
		$V1_b = 1;
		$V2_b = 12;
        //if (($a < $V1_a || $a > $V2_a) && ($b < $V1_b || $b > $V2_b) && ($c < 1 || $c > 31)) {
			//error year, month, day
			//throw new Exception('error year, month, day');
		//} else 
		if (($a >= $V1_a && $a <= $V2_a) && ($b >= $V1_b && $b <= $V2_b)) {
			//ok year, month
			if ($c >= 1) {//ok year, month, day
				if ($b==2) {
					if (is_int($a/4) && $c > 29) {
						throw new Exception('error day(Max:29)');
					} else if (!is_int($a/4) && $c > 28) {
						throw new Exception('error day(Max:28)');
					}
				} else if ($b==4 || $b==6 || $b==9 || $b==11) {
					if ($c > 30) {
						throw new Exception('error day(Max:30)');
					}
				} else { //if ($b==1 || $b==3 || $b==5 || $b==7 || $b==8 || $b==10 || $b==12) {
					if ($c > 31) {
						throw new Exception('error day(Max:31)');
					}
				}
			} else if ($c <= 0) {//ok year, month, error day
				throw new Exception('error day(Min:1)');
			}
		} else if (($a >= $V1_a && $a <= $V2_a)) {
			//ok year
			if ($c >= 1) {//ok year, day
				if ($b <= 0) {//ok year, day, error month
					throw new Exception('error month(Min:1)');
				}
			} else if ($c <= 0) {//ok year, error day
				if ($b <= 0) {//ok year, error month, day
					throw new Exception('error month(Min:1), day(Min:1)');
				}
			}
		} else if (($a < $V1_a || $a > $V2_a)) {
			//error year
			if ($c >= 1) {//error year, ok day
				if ($b <= 0) {//error year, month, ok day
					throw new Exception('error year, month(Min:1)');
				} else { //error year, ok month, day
					throw new Exception('error year');
				}
			} else if ($c <= 0) {//error year, day
				if ($b <= 0) {//error year, month, day
					throw new Exception('error year, month(Min:1), day(Min:1)');
				} else { //error year, day, ok month
					throw new Exception('error year, day(Min:1)');
				}
			}

		} else {
			throw new Exception('unknow error');
		}
	}
			

    public function calNextDate($a, $b, $c) {
		if ($b == 12 && $c == 31) {
			$a = $a+1;
			$b = 1;
			$c = 1;
		} else if ($b==2) {
			if (is_int($a/4) && $c == 29) {
				$b = $b+1;
				$c = 1;
			} else if (!is_int($a/4) && $c == 28) {
				$b = $b+1;
				$c = 1;
			} else {
				$c = $c+1;
			}
		} else if (($b==4 || $b==6 || $b==9 || $b==11)) {
			if ($c == 30) {
				$b = $b+1;
				$c = 1;
			} else {
				$c = $c+1;
			}
		} else { //if ($b==1 || $b==3 || $b==5 || $b==7 || $b==8 || $b==10 || $b==12) {
			if ($c == 31) {
				$b = $b+1;
				$c = 1;
			} else {
				$c = $c+1;
			}
		}
		$result = (string)($a."-".$b."-".$c);
		return $result;
    }
   
}


?>