<?php
//require_once __DIR__ . '/../PHPUnit/Autoload.php';
require_once __DIR__ . '/../NextDate.php';

class NextDateTest extends PHPUnit_Framework_TestCase {

	private function ValidateFunc($thisSet="",$expected="",$e=""){
		switch ($thisSet) {
			case 1:
			if ($expected == "ok") {
				throw new Exception('assertion successful');
			} else {
				throw new Exception('assertion failed');
			}
			break;

			case 2:
			if (	(($expected == "error") && ($e -> getMessage()!='assertion failed')) ||
					(($expected == "ok") && ($e -> getMessage()=='assertion successful'))
			) {
				$thisTF = true;
			} else {
				$thisTF = false;
			}
			$this -> assertTrue($thisTF);
			break;
        }
    }

	public function setUp() {
        $this -> nextdate = new NextDate();
    }
	
	public function myProviderInt(){
		return array(
			//array(1, 1, 1, "ok"),
			//array(1, 1, 1, "error"),
			//array("a", 1, 1, "ok"),
			array("a", 1, 1, "error"),
			array(1, "a", 1, "error"),
			array(1, 1, "a", "error"),
			array("a", "a", 1, "error"),
			array(1, "a", "a", "error"),
			array("a", 1, "a", "error"),
			array("a", "a", "a", "error"),
			array(NULL, NULL, NULL, "error"),
			//array(0, 0, 0, "error"),
			array(0, 0, 0, "ok"),
			array(-100, 0, 100, "ok"),
			array(1, 1, 2147483647, "ok"),//detected successful for 32-bit and 64-bit
			array(1, 1, -2147483647, "ok"),//detected successful for 32-bit and 64-bit
			//array(1, 1, 2147483648, "ok"),//detected successful for 64-bit only
			//array(1, 1, -2147483648, "ok"),//detected successful for 64-bit only
			//array(1, 1, 9223372036854775808, "ok"),//detected failure for 32-bit and 64-bit
			//array(1, 1, -9223372036854775808, "ok"),//detected failure for 32-bit and 64-bit
        );
    }

		public function myProviderRange(){
		return array(
			array(2012, 2, 28, "ok"),
			array(2012, 2, 29, "ok"),
			array(2012, 2, 30, "error"),
			array(2012, 2, 31, "error"),
			array(2014, 2, 27, "ok"),
			array(2014, 2, 28, "ok"),
			array(2014, 2, 29, "error"),
			array(2014, 2, 30, "error"),
			
			array(2014, 4, 30, "ok"),
			array(2014, 4, 31, "error"),
			array(2014, 6, 30, "ok"),
			array(2014, 6, 31, "error"),
			array(2014, 9, 30, "ok"),
			array(2014, 9, 31, "error"),
			array(2014, 11, 30, "ok"),
			array(2014, 11, 31, "error"),
		
			array(2014, 1, 31, "ok"),
			array(2014, 3, 31, "ok"),
			array(2014, 5, 31, "ok"),
			array(2014, 7, 31, "ok"),
			//array(2014, 5, 31, "error"),//detected failure
			//array(2014, 7, 31, "error"),//detected failure
		
			array(999, 0, 0, "error"),
			array(999, 1, 31, "error"),
			array(999, 0, 31, "error"),
			array(999, 10, 0, "error"),
			
			array(1000, 0, 0, "error"),
			array(1000, 1, 31, "ok"),
			array(1000, 0, 1, "error"),
			array(1000, 1, 0, "error"),
        );
    }

	public function myProviderNextDate(){
		return array(
			array(2014, 12, 30, "2014-12-31"),
			array(2014, 12, 31, "2015-1-1"),
			
			array(2012, 2, 28, "2012-2-29"),
			array(2012, 2, 29, "2012-3-1"),
			
			array(2014, 1, 30, "2014-1-31"),
			array(2015, 1, 31, "2015-2-1"),
			array(2016, 4, 29, "2016-4-30"),
			array(2017, 4, 30, "2017-5-1"),
			array(2017, 4, 30, "2017-4-31"),//detected failure
        );
    }

    /**
     * @dataProvider myProviderInt
     */
    public function testValidateInt($a='a',$b=1,$c=1,$expected='error'){
        try {
			$this -> nextdate -> validateInt($a,$b,$c);
			$this -> ValidateFunc(1,$expected);
        } catch(Exception $e) {
			$this -> ValidateFunc(2,$expected,$e);
        }
    }
	
    /**
     * @dataProvider myProviderRange
     */
    public function testValidateRange($a=2020,$b=0,$c=0,$expected='error'){
        try {
			$this -> nextdate -> validateRange($a,$b,$c);
			$this -> ValidateFunc(1,$expected);
        } catch(Exception $e) {
			$this -> ValidateFunc(2,$expected,$e);
        }
    }
    /**
     * @dataProvider myProviderNextDate
     */
	public function testNextDate($a=2014,$b=10,$c=25,$expected="2014-10-26") {
		$result = $this -> nextdate -> calNextDate($a, $b, $c);
		$this -> assertEquals($expected, $result);
    }
}
?>