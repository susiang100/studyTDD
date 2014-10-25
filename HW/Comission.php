<?php
/**  
* Comission
*/
class Comission {

    public function validateInt($a, $b, $c) {
		if(!is_int($a) || !is_int($b) || !is_int($c)) {
			throw new Exception("error int");
        }
    }
	
	public function validateRange($a, $b, $c) {
/*
The salesperson had to sell at least one lock, one stock, and one barrel (but not necessarily one complete rifle) per month,and production limits were such that the most the salesperson could sell in a month was 70 locks, 80 stocks, and 90 barrels. (locks = -1 as the termination condition)
*/
		$V1_a = 1;
		$V2_a = 70;
		$V1_b = 1;
		$V2_b = 80;
		$V1_c = 1;
		$V2_c = 90;		
		//if($a < 1 || $a > 70 || $b < 1 || $b > 80 || $c < 1 || $c > 90) {
		//	throw new Exception('error');
		//}
		if ( ($a>=$V1_a) && ($a<=$V2_a) ) {//ok locks
			if ( ($b>=$V1_b) && ($b<=$V2_b) ) {//ok locks >> ok stocks
				if ( ($c<$V1_c) || ($c>$V2_c) ) {//ok locks >> ok stocks >> error barrels
					throw new Exception('error barrels');
				}
			} else {//ok locks >> error stocks
				if ( ($c<$V1_c) || ($c>$V2_c) ) {//ok locks >> error stocks >> error barrels
					throw new Exception('error stocks, barrels');
				} else {
					throw new Exception('error stocks');
				}
			}
		} else {//error locks
			if ( ($b>=$V1_b) && ($b<=$V2_b) ) {//error locks >> ok stocks
				if ( ($c<$V1_c) || ($c>$V2_c) ) {//error locks >> ok stocks >> error barrels
					throw new Exception('error locks, barrels');
				} else {
					throw new Exception('error locks');
				}
			} else {//error locks >> error stocks
				if ( ($c<$V1_c) || ($c>$V2_c) ) {//error locks >> error stocks >> error barrels
					throw new Exception('error locks, stocks, barrels');
				} else {
					throw new Exception('error locks, stocks');
				}
			}
		}
	}
			
    public function calComission($a, $b, $c) {
/*
Locks cost $45, stocks cost $30, and barrels cost $25.
---
salesperson’s commission: 
10% on sales up to $1000 (and including), 
15% on the next $800, and 
20% on any sales in excess of $1800.
*/
		$aCost=45;//locks cost
		$bCost=30;//stocks cost
		$cCost=25;//barrels cost
		$totalSales=($a*$aCost)+($b*$bCost)+($c*$cCost);
		if ($totalSales>1800) {
			$comission=(0.10*1000)+(0.15*800)+(0.20*($totalSales-1800));
		} else if($totalSales>1000) {
			$comission=(0.10*1000)+(0.15*($totalSales-1000));
		} else {
			$comission=(0.10*$totalSales);
		}
		return $comission;
    }
}
?>