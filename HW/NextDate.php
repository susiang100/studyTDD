<?php
class NextDate {
/**  
* NextDate
*/
    public function validateInt($a, $b, $c) {
		if(!is_int($a) || !is_int($b) || !is_int($c)) {
			throw new Exception("error int");
        }
    }
	
    public function validateRange($a, $b, $c) {
		$V1_a = 1000;
		$V2_a = 9999;
		$V1_b = 1;
		$V2_b = 12;
		if ( ($a>=$V1_a) && ($a<=$V2_a) ) {//ok year
			if ($c>=1) {//ok year >> ok day(Min:1)
				if ( ($b<$V1_b) || ($b>$V2_b) ) {//ok year >> ok day(Min:1) >> error month(Min:1,Max:12)
					throw new Exception('error month');
				} else {//ok year >> ok day(Min:1) >> ok month(Min:1,Max:12)
					if ( ($b==2) && (!is_int($a/4)) && ($c>28) ) {
						throw new Exception('error day(Max:28)');
					} else if ( ($b==2) && (is_int($a/4)) && ($c>29) ) {
						throw new Exception('error day(Max:29)');
					} else if ( ($b==4 || $b==6 || $b==9 || $b==11) && ($c>30) ) {
						throw new Exception('error day(Max:30)');
					} else if ($c>31) {//if ($b==1 || $b==3 || $b==5 || $b==7 || $b==8 || $b==10 )
						throw new Exception('error day(Max:31)');
					}
				}
			} else { //if ($c <= 0) {//ok year >> error day(Min:1)
				if ( ($b<$V1_b) || ($b>$V2_b) ) {//ok year >> error day(Min:1) >> error month(Min:1,Max:12)
					throw new Exception('error month, day');
				}  else {
					throw new Exception('error day');
				}
			}
		} else if (($a < $V1_a || $a > $V2_a)) {//error year
			if ($c>=1) {//error year >> ok day(Min:1)
				if ( ($b<$V1_b) || ($b>$V2_b) ) {//error year >> ok day(Min:1) >> error month(Min:1,Max:12)
					throw new Exception('error year, month');
				} else {//error year >> ok day(Min:1) >> ok month(Min:1,Max:12)
					if ( ($b==2) && ($c>28) ) {
						throw new Exception('error year, error day(Max: 28/29)');
					} else if ( ($b==4 || $b==6 || $b==9 || $b==11) && ($c>30) ) {
						throw new Exception('error year, error day(Max:30)');
					} else if ($c>31) {//if ($b==1 || $b==3 || $b==5 || $b==7 || $b==8 || $b==10 )
						throw new Exception('error year, error day(Max:31)');
					} else {
						throw new Exception('error year');
					}
				}
			} else { //if ($c <= 0) {//error year >> error day(Min:1)
				if ( ($b<$V1_b) || ($b>$V2_b) ) {//error year >> error day(Min:1) >> error month(Min:1,Max:12)
					throw new Exception('error year, month, day');
				}  else {
					throw new Exception('error year, day');
				}
			}
		}
	}
			
    public function calNextDate($a, $b, $c) {
		if ($b == 12 && $c == 31) {//NextYear
			$a++;
			$b = 1;
			$c = 1;
		} else if (
			( ($b==2) && (!is_int($a/4)) && ($c==28) ) ||
			( ($b==2) && (is_int($a/4)) && ($c==29) ) ||
			( ($b==4 || $b==6 || $b==9 || $b==11) && ($c == 30) ) ||
			($c == 31)  //if ($b==1 || $b==3 || $b==5 || $b==7 || $b==8 || $b==10 || $b==12) 
		) {//NextMonth
			$b++;
			$c = 1;
		} else {//NextDay
			$c++;
		}
		$result = (string)($a."-".$b."-".$c);
		return $result;
    }
   
}


?>