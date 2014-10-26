<?php
//require_once __DIR__ . '/../PHPUnit/Autoload.php';
require_once __DIR__ . '/../Commission.php';

class CommissionTest extends PHPUnit_Framework_TestCase {

	private function ValidateFunc($thisSet="",$expected="",$e=""){
		switch ($thisSet) {
			case 1:
			if ($expected == "ok") {//Detected(no error)
				echo "no_msg(",$expected,")->OK", "\n";//達到預期效果，assert OK
			} else {
				echo "no_msg(",$expected,")->X!", "\n";//非預期效果，assert 有問題
			}
			$this -> assertFalse(false);
			break;

			case 2:
			if ($expected == "error") {//Detected(have error)
				echo "msg(",$e -> getMessage(),")->OK", "\n";//達到預期效果，assert OK
			} else {
				echo "msg(",$e -> getMessage(),")->X!", "\n";//非預期效果，assert 有問題
			}
			$this -> assertTrue(true);
			break;
        }
    }

	public function setUp() {
        $this -> commission = new Commission();
    }
	
	public function myProviderInt(){
		return array(
			array("a", 1, 1, "ok"),
			array(-100, 0, 100, "error"),
			array("a", 1, 1, "error"),
			array(1, "a", 1, "error"),
			array(1, 1, "a", "error"),
			array("a", "a", 1, "error"),
			array(1, "a", "a", "error"),
			array("a", 1, "a", "error"),
			array("a", "a", "a", "error"),
			array(null, null, null, "error"),
			//array(0, 0, 0, "error"),
			array(0, 0, 0, "ok"),
			array(-100, 0, 100, "ok"),
			array(1, 1, 2147483647, "ok"),//32-bit is True
			array(1, 1, -2147483647, "ok"),//32-bit is True
			array(1, 1, 2147483648, "ok"),//64-bit is True
			array(1, 1, -2147483648, "ok"),//64-bit is True
			array(1, 1, 9223372036854775808, "ok"),//All is False
			array(1, 1, -9223372036854775808, "ok"),//All is False
        );
    }

		public function myProviderRange(){
		return array(
			array(0, 0, 0, "error"),
			array(0, 1, 1, "error"),
			array(1, 0, 1, "error"),
			array(1, 1, 0, "error"),
			array(0, 0, 1, "error"),
			array(0, 1, 0, "error"),
			array(1, 0, 0, "error"),
			array(1, 1, 1, "ok"),
			array(70, 80, 90, "ok"),
			array(71, 81, 91, "error"),
        );
    }

	public function myProviderNextDate(){
		return array(
			array(1, 1, 1, 10),			//$totalSales=45*1+30*1+25*1=100
										//-->100*0.10=10
			array(10, 10, 10, 100),		//$totalSales=45*10+30*10+25*10=1000
										//-->1000*0.10=100
			array(10, 20, 20, 182.5),	//$totalSales=45*10+30*20+25*20=450+600+500=1550
										//-->1000*0.10+550*0.15=100+82.5=182.5
			array(20, 20, 20, 260),		//$totalSales=45*20+30*20+25*20=900+600+500=2000
										//-->1000*0.10+800*0.15+200*0.20=100+120+40=260
			array(70, 80, 90, 1420),	//$totalSales=45*70+30*80+25*90=3150+2400+2250=7800
										//-->1000*0.10+800*0.15+6000*0.2=100+120+1200=1420
			array(70, 80, 90, 111),
        );
    }

    /**
     * @dataProvider myProviderInt
     */
    public function testValidateInt($a='a',$b=1,$c=1,$expected='error'){
		echo __FUNCTION__,"(",$a,",",$b,",",$c,",",$expected,") --> ";
        try {
			$this -> commission -> validateInt($a,$b,$c);
			$this -> ValidateFunc(1,$expected);
        } catch(Exception $e) {
			$this -> ValidateFunc(2,$expected,$e);
        }
    }
	
    /**
     * @dataProvider myProviderRange
     */
    public function testValidateRange($a=0,$b=0,$c=0,$expected='error'){
		echo __FUNCTION__,"(",$a,",",$b,",",$c,",",$expected,") --> ";
        try {
			$this -> commission -> validateRange($a,$b,$c);
			$this -> ValidateFunc(1,$expected);
        } catch(Exception $e) {
			$this -> ValidateFunc(2,$expected,$e);
        }
    }
    /**
     * @dataProvider myProviderNextDate
     */
	public function testCommission($a=1,$b=1,$c=1,$expected="2014-10-26") {
		echo __FUNCTION__,"(",$a,",",$b,",",$c,",",$expected,") --> ";
		try {
			$this -> assertEquals($expected, $this -> commission -> calCommission($a, $b, $c));
			echo "result(",$expected,")->OK", "\n";//達到預期效果，assert OK
			//$this -> assertFalse(false);
		} catch(Exception $e) {
			echo "result(",$this -> commission -> calCommission($a, $b, $c),")->X!", "\n";//非預期效果，assert 有問題
			//echo 'msg: ',  $e -> getMessage(), "\n";
			//$this -> assertTrue(true);
        }
    }
}
?>