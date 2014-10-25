<?php
//require_once __DIR__ . '/../PHPUnit/Autoload.php';
require_once __DIR__ . '/../Triangle.php';

class TriangleTest extends PHPUnit_Framework_TestCase {

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
        $this -> triangle = new Triangle();
    }

	public function myProviderInt(){
		return array(
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
			array(0, 10, 10, "error"),
			array(10, 0, 10, "error"),
			array(10, 10, 0, "error"),
			array(-1, -1, -1, "error"),
        );
    }
	
		public function myProviderFormation(){
		return array(
			array(100, 1, 1, "error"),
			array(1, 100, 1, "error"),
			array(1, 10, 1000, "error"),
			array(3, 4, 5, "ok"),

        );
    }
	
		public function myProviderTypes(){
		return array(
			array(3, 4, 5, 3),//不等邊三角形
			array(9, 9, 1, 2),//等邊三角形
			array(9, 9, 1, 1),//等邊三角形,但預設結果為1(正三角形)，assertion錯誤！
			array(9, 9, 9, 1),//正三角形
 
        );
    }
	
    /**
     * @dataProvider myProviderInt
     */
    public function testValidateInt($a='a',$b=1,$c=1,$expected='error'){
		echo __FUNCTION__,"(",$a,",",$b,",",$c,",",$expected,") --> ";
		try {
			$this -> triangle -> validateInt($a,$b,$c);
			$this -> ValidateFunc(1,$expected);
        } catch(Exception $e) {
			$this -> ValidateFunc(2,$expected,$e);
        }
    }

    /**
     * @dataProvider myProviderRange
     */
    public function testValidateRange($a=0,$b=0,$c=0,$expected='error') {
		echo __FUNCTION__,"(",$a,",",$b,",",$c,",",$expected,") --> ";
		try {
			$this -> triangle -> validateRange($a,$b,$c);
			$this -> ValidateFunc(1,$expected);
        } catch(Exception $e) {
			$this -> ValidateFunc(2,$expected,$e);
        }
    }

    /**
     * @dataProvider myProviderFormation
     */
    public function testValidateFormation($a=1,$b=0,$c=0,$expected='error formation') {
		echo __FUNCTION__,"(",$a,",",$b,",",$c,",",$expected,") --> ";
		try {
			$this -> triangle -> validateFormation($a,$b,$c);
			$this -> ValidateFunc(1,$expected);
        } catch(Exception $e) {
			$this -> ValidateFunc(2,$expected,$e);
        }
    }
	
    /**
     * @dataProvider myProviderTypes
     */
    public function testTriangle($a=3,$b=4,$c=5,$expected=3) {
		echo __FUNCTION__,"(",$a,",",$b,",",$c,",",$expected,") --> ";
		try {
			$this -> assertEquals($expected, $this -> triangle -> calTriangle($a, $b, $c));
			echo "result(",$expected,")->OK", "\n";//達到預期效果，assert OK
			//$this -> assertFalse(false);
		} catch(Exception $e) {
			echo "result(",$this -> triangle -> calTriangle($a, $b, $c),")->X!", "\n";//非預期效果，assert 有問題
			//echo 'msg: ',  $e -> getMessage(), "\n";
			//$this -> assertTrue(true);
        }
    }
}
?>