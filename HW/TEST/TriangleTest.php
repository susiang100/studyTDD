<?php
//require_once __DIR__ . '/../PHPUnit/Autoload.php';
require_once __DIR__ . '/../Triangle.php';

class TriangleTest extends PHPUnit_Framework_TestCase {
    public function setUp() {
        $this -> triangle = new Triangle();
    }
	public function myProviderInt(){
		return array(
			array("a", 1, 1, "error int"),
			array(1, "a", 1, "error int"),
			array(1, 1, "a", "error int"),
			array("a", "a", 1, "error int"),
			array(1, "a", "a", "error int"),
			array("a", 1, "a", "error int"),
			array("a", "a", "a", "error int"),
			array(null, null, null, "error int"),
			//array(0, 0, 0, "error int"),
			array(0, 0, 0, "ok int"),
			array(-100, 0, 100, "ok int"),
			array(1, 1, 2147483647, "ok int"),//32-bit is True
			array(1, 1, -2147483647, "ok int"),//32-bit is True
			array(1, 1, 2147483648, "ok int"),//64-bit is True
			array(1, 1, -2147483648, "ok int"),//64-bit is True
			array(1, 1, 9223372036854775808, "ok int"),//All is False
			array(1, 1, -9223372036854775808, "ok int"),//All is False
        );
    }
	
		public function myProviderRange(){
		return array(
			array(0, 0, 0, "error range"),
			array(0, 10, 10, "error range"),
			array(10, 0, 10, "error range"),
			array(10, 10, 0, "error range"),
			array(-1, -1, -1, "error range"),
        );
    }
	
		public function myProviderFormation(){
		return array(
			array(100, 1, 1, "error formation"),
			array(1, 100, 1, "error formation"),
			array(1, 10, 1000, "error formation"),
			array(3, 4, 5, "ok formation"),

        );
    }
	
		public function myProviderTypes(){
		return array(
			array(3, 4, 5, 3),//不等邊三角形
			array(9, 9, 1, 2),//等邊三角形
			array(9, 9, 1, 1),//等邊三角形,但預設為1正三角形
			array(9, 9, 9, 1),//正三角形
 
        );
    }
	
    /**
     * @dataProvider myProviderInt
     */
    public function testValidateInt($a='a',$b=1,$c=1,$expected='error int'){
		echo __FUNCTION__,"(",$a,",",$b,",",$c,",",$expected,") --> " ;
        try { 
			$this -> triangle -> validateInt($a,$b,$c);
			if ($expected == "ok int") {//no error
				echo "msg: ok int/assert_1 OK", "\n";//達到預期效果，assert OK
			} else {
				echo "assert_1 X!", "\n";//非預期效果，assert 有問題
			}
			$this -> assertFalse(false);
        } catch(Exception $e) {//have error
			if ($expected == "error int") {//達到預期效果，assert OK
				echo 'msg: ',  $e -> getMessage(), "/";echo "assert_1 OK", "\n";
			} else {//非預期效果，assert 有問題
				echo "assert_1 X!", "\n";
			}
			$this -> assertTrue(true);
        }
    }
	
    /**
     * @dataProvider myProviderRange
     */
    public function testValidateRange($a='0',$b=0,$c=0,$expected='error range') {
		echo __FUNCTION__,"(",$a,",",$b,",",$c,",",$expected,") --> " ;
        try {
			$this -> triangle -> validateRange($a, $b, $c);
			if ($expected == "ok range") {
				echo "msg: ok range/assert_2 OK", "\n";
			} else {
				echo "assert_2 X!", "\n";
			}
			$this -> assertFalse(false);
        } catch(Exception $e) {
			if ($expected == "error range") {
				echo 'msg: ',  $e -> getMessage(), "/";echo "assert_2 OK", "\n";
			} else {
				echo "assert_2 X!", "\n";
			}
            $this -> assertTrue(true);
        }
    }

    /**
     * @dataProvider myProviderFormation
     */
    public function testValidateFormation($a=1,$b=0,$c=0,$expected='error formation') {
		echo __FUNCTION__,"(",$a,",",$b,",",$c,",",$expected,") --> " ;
        try {
			$this -> triangle -> validateFormation($a, $b, $c);
			if ($expected == "ok formation") {
				echo "msg: ok formation/assert_3 OK", "\n";
			} else {
				echo "assert_3 X!", "\n";
			}
			$this -> assertFalse(false);
        } catch(Exception $e) {
			if ($expected == "error formation") {
				echo 'msg: ',  $e -> getMessage(), "/";echo "assert_3 OK", "\n";
			} else {
				echo "assert_3 X!", "\n";
			}
            $this -> assertTrue(true);
        }
    }
	
    /**
     * @dataProvider myProviderTypes
     */
    public function testValidateTypes($a=3,$b=4,$c=5,$expected=3) {
		echo __FUNCTION__,"(",$a,",",$b,",",$c,",",$expected,") --> " ;
        //$this -> assertEquals($expected, $this -> triangle -> validateTypes($a, $b, $c));
		//echo "this Types OK\n";
       try {
			$this -> assertEquals($expected, $this -> triangle -> validateTypes($a, $b, $c));
			echo "msg: ok types/assert_4 OK1", "\n";
			//$this -> assertFalse(false);
        } catch(Exception $e) {
			echo 'msg: ',  $e -> getMessage(), "\n";
            //$this -> assertTrue(true);
        }
		
    }
}