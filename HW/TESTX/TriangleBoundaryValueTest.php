<?php
//require_once __DIR__ . '/../PHPUnit/Autoload.php';
require_once __DIR__ . '/../Triangle.php';
//$expected ==-1, "error"
//$expected ==0, "ok"
//$expected ==1, "正三角形"
//$expected ==2, "等邊三角形"
//$expected ==3, "不等邊三角形"	

class TriangleTest extends PHPUnit_Framework_TestCase {

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
        $this -> triangle = new Triangle();
    }

	public function myProviderBoundaryValueTestingStandard(){
				$maxInt = 2147483647;
				//$maxInt, Max Length(Int) for a,b,c
				//2147483647, successful for 32-bit and 64-bit
				//9223372036854775807, successful for 64-bit ONLY
		return array(
			//array(2147483647, 2147483647, 2147483647, "ok"),
				//detected successful for 32-bit and 64-bit
			//array(2147483648, 2147483648, 2147483648, "ok"),
				//detected successful for 64-bit only
			//array(9223372036854775808, 9223372036854775808, 9223372036854775808, "ok"),
				//detected failure for 32-bit and 64-bit
		
			
			//Boundary Value Testing - Standard, 4n+1=13 Test Cases
			//min = 1, min+ = 2, nom = 100, max- = $maxInt-1, max = $maxInt
			array(100, 100, 1, 2),
			array(100, 100, 2, 2),
			array(100, 100, 100, 1),
			array(100, 100, $maxInt-1, 2),
			array(100, 100, $maxInt, "error"),//not a triangle
			array(100, 1, 100, 2),
			array(100, 2, 100, 2),
			array(100, $maxInt-1, 100, 2),
			array(100, $maxInt, 100, "error"),//not a triangle
			array(1, 100, 100, 2),
			array(2, 100, 100, 2),
			array($maxInt-1, 100, 100, 2),
			array(100, 100, 100, 1),//not a triangle
			
			//Boundary Value Testing - robustness, 6n+1=19 Test Cases
			//min = 1, min+ = 2, nom = 100, max- = $maxInt-1, max = $maxInt
			array(100, 100, 1, 2),
			array(100, 100, 2, 2),
			array(100, 100, 100, 1),
			array(100, 100, $maxInt-1, 2),
			array(100, 100, $maxInt, "error"),//not a triangle
			array(100, 1, 100, 2),
			array(100, 2, 100, 2),
			array(100, $maxInt-1, 100, 2),
			array(100, $maxInt, 100, "error"),//not a triangle
			array(1, 100, 100, 2),
			array(2, 100, 100, 2),
			array($maxInt-1, 100, 100, 2),
			array(100, 100, 100, 1),//not a triangle
			
			array(-1, 100, 100, "error"),//invalid input
			array(100, -1, 100, "error"),//invalid input
			array(100, 100, -1, "error"),//invalid input
			array($maxInt+1, 100, 100, "error"),//invalid input
			array(100, $maxInt+1, 100, "error"),//invalid input
			array(100, 100, $maxInt+1, "error"),//invalid input
			
			//Boundary Value Testing - worst-case, 5^n=125 Test Cases
			//min = 1, min+ = 2, nom = 100, max- = $maxInt-1, max = $maxInt
			array(1, 1, 1, 1),
			array(1, 1, 2, "error"),//not a triangle
			array(1, 1, 100, "error"),//not a triangle
			array(1, 1, $maxInt-1, "error"),//not a triangle
			array(1, 1, $maxInt, "error"),//not a triangle
			array(1, 2, 1, "error"),//not a triangle
			array(1, 2, 2, 2),
			array(1, 2, 100, "error"),//not a triangle
			array(1, 2, $maxInt-1, "error"),//not a triangle
			array(1, 2, $maxInt, "error"),//not a triangle
			//end-10
			array(1, 100, 1, "error"),//not a triangle
			array(1, 100, 2, "error"),//not a triangle
			array(1, 100, 100, 2),
			array(1, 100, $maxInt-1, "error"),//not a triangle
			array(1, 100, $maxInt, "error"),//not a triangle
			array(1, $maxInt-1, 1, "error"),//not a triangle
			array(1, $maxInt-1, 2, "error"),//not a triangle
			array(1, $maxInt-1, 100,"error"),//not a triangle
			array(1, $maxInt-1, $maxInt-1, 2),
			array(1, $maxInt-1, $maxInt, "error"),//not a triangle
			//end-20
			array(1, $maxInt, 1, "error"),//not a triangle
			array(1, $maxInt, 2, "error"),//not a triangle
			array(1, $maxInt, 100,"error"),//not a triangle
			array(1, $maxInt, $maxInt-1, "error"),//not a triangle
			array(1, $maxInt, $maxInt, 2),
			array(2, 1, 1, "error"),//not a triangle
			array(2, 1, 2, 2),
			array(2, 1, 100, "error"),//not a triangle
			array(2, 1, $maxInt-1, "error"),//not a triangle
			array(2, 1, $maxInt, "error"),//not a triangle
			//end-30
			array(2, 2, 1, 2),
			array(2, 2, 2, 1),
			array(2, 2, 100, "error"),//not a triangle
			array(2, 2, $maxInt-1, "error"),//not a triangle
			array(2, 2, $maxInt, "error"),//not a triangle
			
			array(2, 100, 1, "error"),//not a triangle
			array(2, 100, 2, "error"),//not a triangle
			array(2, 100, 100, 2),
			array(2, 100, $maxInt-1, "error"),//not a triangle
			array(2, 100, $maxInt, "error"),//not a triangle
			//end-40
			array(2, $maxInt-1, 1, "error"),//not a triangle
			array(2, $maxInt-1, 2, "error"),//not a triangle
			array(2, $maxInt-1, 100, "error"),//not a triangle
			array(2, $maxInt-1, $maxInt-1, 2),
			array(2, $maxInt-1, $maxInt, 3),
			
			array(2, $maxInt, 1, "error"),//not a triangle
			array(2, $maxInt, 2, "error"),//not a triangle
			array(2, $maxInt, 100,"error"),//not a triangle
			array(2, $maxInt, $maxInt-1, 3),
			array(2, $maxInt, $maxInt, 2),
			//end-50
			array(100, 1, 1, "error"),//not a triangle
			array(100, 1, 2, "error"),//not a triangle
			array(100, 1, 100, 2),
			array(100, 1, $maxInt-1, "error"),//not a triangle
			array(100, 1, $maxInt, "error"),//not a triangle
			array(100, 2, 1, "error"),//not a triangle
			array(100, 2, 2, "error"),//not a triangle
			array(100, 2, 100, 2),
			array(100, 2, $maxInt-1, "error"),//not a triangle
			array(100, 2, $maxInt, "error"),//not a triangle
			//end-60
			array(100, 100, 1, 2),
			array(100, 100, 2, 2),
			array(100, 100, 100, 1),
			array(100, 100, $maxInt-1, 2),
			array(100, 100, $maxInt, "error"),//not a triangle
			array(100, $maxInt-1, 1, "error"),//not a triangle
			array(100, $maxInt-1, 2, "error"),//not a triangle
			array(100, $maxInt-1, 100, 2),
			array(100, $maxInt-1, $maxInt-1, 2),
			array(100, $maxInt-1, $maxInt, 3),
			//end-70
			array(100, $maxInt, 1, "error"),//not a triangle
			array(100, $maxInt, 2, "error"),//not a triangle
			array(100, $maxInt, 100,"error"),//not a triangle
			array(100, $maxInt, $maxInt-1, 3),
			array(100, $maxInt, $maxInt, 2),
			array($maxInt-1, 1, 1, "error"),//not a triangle
			array($maxInt-1, 1, 2, "error"),//not a triangle
			array($maxInt-1, 1, 100, "error"),//not a triangle
			array($maxInt-1, 1, $maxInt-1, 2),
			array($maxInt-1, 1, $maxInt, "error"),//not a triangle
			//end-80
			array($maxInt-1, 2, 1, "error"),//not a triangle
			array($maxInt-1, 2, 2, "error"),//not a triangle
			array($maxInt-1, 2, 100, "error"),//not a triangle
			array($maxInt-1, 2, $maxInt-1, 2),
			array($maxInt-1, 2, $maxInt, 3),
			
			array($maxInt-1, 100, 1, "error"),//not a triangle
			array($maxInt-1, 100, 2, "error"),//not a triangle
			array($maxInt-1, 100, 100, 2),
			array($maxInt-1, 100, $maxInt-1, 2),
			array($maxInt-1, 100, $maxInt, 3),
			//end-90
			array($maxInt-1, $maxInt-1, 1, 2),
			array($maxInt-1, $maxInt-1, 2, 2),
			array($maxInt-1, $maxInt-1, 100, 2),
			array($maxInt-1, $maxInt-1, $maxInt-1, 1),
			array($maxInt-1, $maxInt-1, $maxInt, 2),
			
			array($maxInt-1, $maxInt, 1, "error"),//not a triangle
			array($maxInt-1, $maxInt, 2, 3),
			array($maxInt-1, $maxInt, 100, 3),
			array($maxInt-1, $maxInt, $maxInt-1, 2),
			array($maxInt-1, $maxInt, $maxInt, 2),
			//end-100
			array($maxInt, 1, 1, "error"),//not a triangle
			array($maxInt, 1, 2, "error"),//not a triangle
			array($maxInt, 1, 100, "error"),//not a triangle
			array($maxInt, 1, $maxInt-1, "error"),//not a triangle
			array($maxInt, 1, $maxInt, 2),
	
			array($maxInt, 2, 1, "error"),//not a triangle
			array($maxInt, 2, 2, "error"),//not a triangle
			array($maxInt, 2, 100, "error"),//not a triangle
			array($maxInt, 2, $maxInt-1, 3),
			array($maxInt, 2, $maxInt, 2),
			//end-110
			array($maxInt, 100, 1, "error"),//not a triangle
			array($maxInt, 100, 2, "error"),//not a triangle
			array($maxInt, 100, 100,"error"),//not a triangle
			array($maxInt, 100, $maxInt-1, 3),
			array($maxInt, 100, $maxInt, 2),
			
			array($maxInt, $maxInt-1, 1, "error"),//not a triangle
			array($maxInt, $maxInt-1, 2, 3),
			array($maxInt, $maxInt-1, 100, 3),
			array($maxInt, $maxInt-1, $maxInt-1, 2),
			array($maxInt, $maxInt-1, $maxInt, 2),
			//end-120
			array($maxInt, $maxInt, 1, 2),
			array($maxInt, $maxInt, 2, 2),
			array($maxInt, $maxInt, 100, 2),
			array($maxInt, $maxInt, $maxInt-1, 2),
			array($maxInt, $maxInt, $maxInt, 1),
			//end-125
			
			
			
			
			//Boundary Value Testing - robust worst-case, 7^n=343 Test Cases
			//min = 1, min+ = 2, nom = 100, max- = $maxInt-1, max = $maxInt
		
			array(-1, 1, 1, "error"),//invalid input
			array(-1, 1, 2, "error"),//invalid input
			array(-1, 1, 100, "error"),//invalid input
			array(-1, 1, $maxInt-1, "error"),//invalid input
			array(-1, 1, $maxInt, "error"),//invalid input
			
			array(-1, 2, 1, "error"),//invalid input
			array(-1, 2, 2, "error"),//invalid input
			array(-1, 2, 100, "error"),//invalid input
			array(-1, 2, $maxInt-1, "error"),//invalid input
			array(-1, 2, $maxInt, "error"),//invalid input
			//end-10
			array(-1, 100, 1, "error"),//invalid input
			array(-1, 100, 2, "error"),//invalid input
			array(-1, 100, 100, "error"),//invalid input
			array(-1, 100, $maxInt-1, "error"),//invalid input
			array(-1, 100, $maxInt, "error"),//invalid input
			
			array(-1, $maxInt-1, 1, "error"),//invalid input
			array(-1, $maxInt-1, 2, "error"),//invalid input
			array(-1, $maxInt-1, 100, "error"),//invalid input
			array(-1, $maxInt-1, $maxInt-1, "error"),//invalid input
			array(-1, $maxInt-1, $maxInt, "error"),//invalid input
			//end-20
			array(-1, $maxInt, 1, "error"),//invalid input
			array(-1, $maxInt, 2, "error"),//invalid input
			array(-1, $maxInt, 100, "error"),//invalid input
			array(-1, $maxInt, $maxInt-1, "error"),//invalid input
			array(-1, $maxInt, $maxInt, "error"),//invalid input
			
			array(1, -1, 1, "error"),//invalid input
			array(1, -1, 2, "error"),//invalid input
			array(1, -1, 100, "error"),//invalid input
			array(1, -1, $maxInt-1, "error"),//invalid input
			array(1, -1, $maxInt, "error"),//invalid input
			//end-30
			array(2, -1, 1, "error"),//invalid input
			array(2, -1, 2, "error"),//invalid input
			array(2, -1, 100, "error"),//invalid input
			array(2, -1, $maxInt-1, "error"),//invalid input
			array(2, -1, $maxInt, "error"),//invalid input
			
			array(100, -1, 1, "error"),//invalid input
			array(100, -1, 2, "error"),//invalid input
			array(100, -1, 100, "error"),//invalid input
			array(100, -1, $maxInt-1, "error"),//invalid input
			array(100, -1, $maxInt, "error"),//invalid input
			//end-40
			array($maxInt-1, -1, 1, "error"),//invalid input
			array($maxInt-1, -1, 2, "error"),//invalid input
			array($maxInt-1, -1, 100, "error"),//invalid input
			array($maxInt-1, -1, $maxInt-1, "error"),//invalid input
			array($maxInt-1, -1, $maxInt, "error"),//invalid input
			
			array($maxInt, -1, 1, "error"),//invalid input
			array($maxInt, -1, 2, "error"),//invalid input
			array($maxInt, -1, 100, "error"),//invalid input
			array($maxInt, -1, $maxInt-1, "error"),//invalid input
			array($maxInt, -1, $maxInt, "error"),//invalid input
			//end-50
			array(1, 1, -1, "error"),//invalid input
			array(1, 2, -1, "error"),//invalid input
			array(1, 100, -1, "error"),//invalid input
			array(1, $maxInt-1, -1, "error"),//invalid input
			array(1, $maxInt, -1, "error"),//invalid input
		
			array(2, 1, -1, "error"),//invalid input
			array(2, 2, -1, "error"),//invalid input
			array(2, 100, -1, "error"),//invalid input
			array(2, $maxInt-1, -1, "error"),//invalid input
			array(2, $maxInt, -1, "error"),//invalid input
			//end-60
			array(100, 1, -1, "error"),//invalid input
			array(100, 2, -1, "error"),//invalid input
			array(100, 100, -1,"error"),//invalid input
			array(100, $maxInt-1, -1, "error"),//invalid input
			array(100, $maxInt, -1, "error"),//invalid input
			
			array($maxInt-1, 1, -1, "error"),//invalid input
			array($maxInt-1, 2, -1, "error"),//invalid input
			array($maxInt-1, 100, -1, "error"),//invalid input
			array($maxInt-1, $maxInt-1, -1, "error"),//invalid input
			array($maxInt-1, $maxInt, -1, "error"),//invalid input
			//end-70
			array($maxInt, 1, -1, "error"),//invalid input
			array($maxInt, 2, -1, "error"),//invalid input
			array($maxInt, 100, -1, "error"),//invalid input
			array($maxInt, $maxInt-1, -1, "error"),//invalid input
			array($maxInt, $maxInt, -1, "error"),//invalid input
			//end-75
			array($maxInt+1, 1, 1, "error"),//invalid input
			array($maxInt+1, 1, 2, "error"),//invalid input
			array($maxInt+1, 1, 100, "error"),//invalid input
			array($maxInt+1, 1, $maxInt-1, "error"),//invalid input
			array($maxInt+1, 1, $maxInt, "error"),//invalid input
			//end-80
			array($maxInt+1, 2, 1, "error"),//invalid input
			array($maxInt+1, 2, 2, "error"),//invalid input
			array($maxInt+1, 2, 100, "error"),//invalid input
			array($maxInt+1, 2, $maxInt-1, "error"),//invalid input
			array($maxInt+1, 2, $maxInt, "error"),//invalid input
			
			array($maxInt+1, 100, 1, "error"),//invalid input
			array($maxInt+1, 100, 2, "error"),//invalid input
			array($maxInt+1, 100, 100, "error"),//invalid input
			array($maxInt+1, 100, $maxInt-1, "error"),//invalid input
			array($maxInt+1, 100, $maxInt, "error"),//invalid input
			//end-90
			array($maxInt+1, $maxInt-1, 1, "error"),//invalid input
			array($maxInt+1, $maxInt-1, 2, "error"),//invalid input
			array($maxInt+1, $maxInt-1, 100, "error"),//invalid input
			array($maxInt+1, $maxInt-1, $maxInt-1, "error"),//invalid input
			array($maxInt+1, $maxInt-1, $maxInt, "error"),//invalid input
			
			array($maxInt+1, $maxInt, 1, "error"),//invalid input
			array($maxInt+1, $maxInt, 2, "error"),//invalid input
			array($maxInt+1, $maxInt, 100, "error"),//invalid input
			array($maxInt+1, $maxInt, $maxInt-1, "error"),//invalid input
			array($maxInt+1, $maxInt, $maxInt, "error"),//invalid input
			//end-100
			array(1, $maxInt+1, 1, "error"),//invalid input
			array(1, $maxInt+1, 2, "error"),//invalid input
			array(1, $maxInt+1, 100, "error"),//invalid input
			array(1, $maxInt+1, $maxInt-1, "error"),//invalid input
			array(1, $maxInt+1, $maxInt, "error"),//invalid input
			
			array(2, $maxInt+1, 1, "error"),//invalid input
			array(2, $maxInt+1, 2, "error"),//invalid input
			array(2, $maxInt+1, 100, "error"),//invalid input
			array(2, $maxInt+1, $maxInt-1, "error"),//invalid input
			array(2, $maxInt+1, $maxInt, "error"),//invalid input
			//end-110
			array(100, $maxInt+1, 1, "error"),//invalid input
			array(100, $maxInt+1, 2, "error"),//invalid input
			array(100, $maxInt+1, 100, "error"),//invalid input
			array(100, $maxInt+1, $maxInt-1, "error"),//invalid input
			array(100, $maxInt+1, $maxInt, "error"),//invalid input
			
			array($maxInt-1, $maxInt+1, 1, "error"),//invalid input
			array($maxInt-1, $maxInt+1, 2, "error"),//invalid input
			array($maxInt-1, $maxInt+1, 100, "error"),//invalid input
			array($maxInt-1, $maxInt+1, $maxInt-1, "error"),//invalid input
			array($maxInt-1, $maxInt+1, $maxInt, "error"),//invalid input
			//end-120
			array($maxInt, $maxInt+1, 1, "error"),//invalid input
			array($maxInt, $maxInt+1, 2, "error"),//invalid input
			array($maxInt, $maxInt+1, 100, "error"),//invalid input
			array($maxInt, $maxInt+1, $maxInt-1, "error"),//invalid input
			array($maxInt, $maxInt+1, $maxInt, "error"),//invalid input
			
			array(1, 1, $maxInt+1, "error"),//invalid input
			array(1, 2, $maxInt+1, "error"),//invalid input
			array(1, 100, $maxInt+1, "error"),//invalid input
			array(1, $maxInt-1, $maxInt+1, "error"),//invalid input
			array(1, $maxInt, $maxInt+1, "error"),//invalid input
			//end-130
			array(2, 1, $maxInt+1, "error"),//invalid input
			array(2, 2, $maxInt+1, "error"),//invalid input
			array(2, 100, $maxInt+1, "error"),//invalid input
			array(2, $maxInt-1, $maxInt+1, "error"),//invalid input
			array(2, $maxInt, $maxInt+1, "error"),//invalid input
			
			array(100, 1, $maxInt+1, "error"),//invalid input
			array(100, 2, $maxInt+1, "error"),//invalid input
			array(100, 100, $maxInt+1,"error"),//invalid input
			array(100, $maxInt-1, $maxInt+1, "error"),//invalid input
			array(100, $maxInt, $maxInt+1, "error"),//invalid input
			//end-140
			array($maxInt-1, 1, $maxInt+1, "error"),//invalid input
			array($maxInt-1, 2, $maxInt+1, "error"),//invalid input
			array($maxInt-1, 100, $maxInt+1, "error"),//invalid input
			array($maxInt-1, $maxInt-1, $maxInt+1, "error"),//invalid input
			array($maxInt-1, $maxInt, $maxInt+1, "error"),//invalid input
			
			array($maxInt, 1, $maxInt+1, "error"),//invalid input
			array($maxInt, 2, $maxInt+1, "error"),//invalid input
			array($maxInt, 100, $maxInt+1, "error"),//invalid input
			array($maxInt, $maxInt-1, $maxInt+1, "error"),//invalid input
			array($maxInt, $maxInt, $maxInt+1, "error"),//invalid input
			//end-150
			
			array(1, -1, -1, "error"),//not a triangle
			array(2, -1, -1, "error"),//not a triangle
			array(100, -1, -1, "error"),//not a triangle
			array($maxInt-1, -1, -1, "error"),//not a triangle
			array($maxInt, -1, -1, "error"),//not a triangle
			
			array(-1, 1, -1, "error"),//not a triangle
			array(-1, 2, -1, "error"),//not a triangle
			array(-1, 100, -1, "error"),//not a triangle
			array(-1, $maxInt-1, -1, "error"),//not a triangle
			array(-1, $maxInt, -1, "error"),//not a triangle
			
			array(-1, -1, 1, "error"),//not a triangle
			array(-1, -1, 2, "error"),//not a triangle
			array(-1, -1, 100, "error"),//not a triangle
			array(-1, -1, $maxInt-1, "error"),//not a triangle
			array(-1, -1, $maxInt, "error"),//not a triangle
			//end-165
			array(1, $maxInt+1, $maxInt+1, "error"),//not a triangle
			array(2, $maxInt+1, $maxInt+1, "error"),//not a triangle
			array(100, $maxInt+1, $maxInt+1, "error"),//not a triangle
			array($maxInt-1, $maxInt+1, $maxInt+1, "error"),//not a triangle
			array($maxInt, $maxInt+1, $maxInt+1, "error"),//not a triangle
			array($maxInt+1, 1, $maxInt+1, "error"),//not a triangle
			array($maxInt+1, 2, $maxInt+1, "error"),//not a triangle
			array($maxInt+1, 100, $maxInt+1, "error"),//not a triangle
			array($maxInt+1, $maxInt-1, $maxInt+1, "error"),//not a triangle
			array($maxInt+1, $maxInt, $maxInt+1, "error"),//not a triangle
			array($maxInt+1, $maxInt+1, 1, "error"),//not a triangle
			array($maxInt+1, $maxInt+1, 2, "error"),//not a triangle
			array($maxInt+1, $maxInt+1, 100, "error"),//not a triangle
			array($maxInt+1, $maxInt+1, $maxInt-1, "error"),//not a triangle
			array($maxInt+1, $maxInt+1, $maxInt, "error"),//not a triangle
			//end-180
			array(1, $maxInt+1, -1, "error"),//not a triangle
			array(2, $maxInt+1, -1, "error"),//not a triangle
			array(100, $maxInt+1, -1, "error"),//not a triangle
			array($maxInt-1, $maxInt+1, -1, "error"),//not a triangle
			array($maxInt, $maxInt+1, -1, "error"),//not a triangle
			array($maxInt+1, 1, -1, "error"),//not a triangle
			array($maxInt+1, 2, -1, "error"),//not a triangle
			array($maxInt+1, 100, -1, "error"),//not a triangle
			array($maxInt+1, $maxInt-1, -1, "error"),//not a triangle
			array($maxInt+1, $maxInt, -1, "error"),//not a triangle
			array($maxInt+1, -1, 1, "error"),//not a triangle
			array($maxInt+1, -1, 2, "error"),//not a triangle
			array($maxInt+1, -1, 100, "error"),//not a triangle
			array($maxInt+1, -1, $maxInt-1, "error"),//not a triangle
			array($maxInt+1, -1, $maxInt, "error"),//not a triangle
			//end-195
			array(1, -1, $maxInt+1, "error"),//not a triangle
			array(2, -1, $maxInt+1, "error"),//not a triangle
			array(100, -1, $maxInt+1, "error"),//not a triangle
			array($maxInt-1, -1, $maxInt+1, "error"),//not a triangle
			array($maxInt, -1, $maxInt+1, "error"),//not a triangle
			array(-1, 1, $maxInt+1, "error"),//not a triangle
			array(-1, 2, $maxInt+1, "error"),//not a triangle
			array(-1, 100, $maxInt+1, "error"),//not a triangle
			array(-1, $maxInt-1, $maxInt+1, "error"),//not a triangle
			array(-1, $maxInt, $maxInt+1, "error"),//not a triangle
			array(-1, $maxInt+1, 1, "error"),//not a triangle
			array(-1, $maxInt+1, 2, "error"),//not a triangle
			array(-1, $maxInt+1, 100, "error"),//not a triangle
			array(-1, $maxInt+1, $maxInt-1, "error"),//not a triangle
			array(-1, $maxInt+1, $maxInt, "error"),//not a triangle
			//end-210
			array($maxInt+1, $maxInt+1, $maxInt+1, "error"),//not a triangle
			array($maxInt+1, -1, -1, "error"),//not a triangle
			array(-1, $maxInt+1, -1, "error"),//not a triangle
			array(-1, -1, $maxInt+1, "error"),//not a triangle
						
			array(-1, -1, -1, "error"),//not a triangle
			array(-1, $maxInt+1, $maxInt+1, "error"),//not a triangle
			array($maxInt+1, -1, $maxInt+1, "error"),//not a triangle
			array($maxInt+1, $maxInt+1, -1, "error"),//not a triangle
			//end-218
			
			
			
			
			
						
			//Equivalence Class Testing - Weak Normal, 4 TestCase
			array(4, 1, 2, "error"),
			array(5, 5, 5, 1),
			array(2, 2, 3, 2),
			array(3, 4, 5, 3),
			
			//Equivalence Class Testing - Strong Normal
			//Since there is no further sub-intervals inside the valid inputs for the 3 sides a, b, and c, are Strong Normal Equivalence is the same as the Weak Normal Equivalence 

			//Equivalence Class Testing - Weak Robust, total 10 TestCase
			//Total TestCase = Weak-normal cases + following error cases
			//				 = 4 + 6
			//				 = 10
			//for the corners <1,1,1> , n=3 TestCase
			array(-1, 5, 5, "error"),
			array(5, -1, 5, "error"),
			array(5, 5, -1, "error"),
			//for the corners <$maxInt,$maxInt,$maxInt> , n=3 TestCase
			array($maxInt+1, 5, 5, "error"),
			array(5, $maxInt+1, 5, "error"),
			array(5, 5, $maxInt+1, "error"),
			
			//Equivalence Class Testing - Strong Robust, total 18 TestCase
			//Total TestCase = Weak-normal cases + following error cases
			//				 = 4 + 14
			//				 = 18
			//for the corners <1,1,1> , 2^n-1=7 TestCase
			array(-1, 5, 5, "error"),
			array(5, -1, 5, "error"),
			array(5, 5, -1, "error"),
			array(5, -1, -1, "error"),
			array(-1, 5, -1, "error"),
			array(-1, -1, 5, "error"),
			array(-1, -1, -1, "error"),
			//for the corners <$maxInt,$maxInt,$maxInt> , 2^n-1=7 TestCase
			array($maxInt+1, 5, 5, "error"),
			array(5, $maxInt+1, 5, "error"),
			array(5, 5, $maxInt+1, "error"),
			array(5, $maxInt+1, $maxInt+1, "error"),
			array($maxInt+1, 5, $maxInt+1, "error"),
			array($maxInt+1, $maxInt+1, 5, "error"),
			array($maxInt+1, $maxInt+1, $maxInt+1, "error"),
			
			
			//Decision Table-Based Testing
			array(4, 1, 2, "error"),//not a triangle
			array(1, 4, 2, "error"),//not a triangle
			array(1, 2, 4, "error"),//not a triangle
			array(3, 3, 3, 1),
			array(4, 3, 3, 2),
			array(3, 4, 3, 2),
			array(3, 3, 4, 2),
			array(3, 4, 5, 3),
			array("?", 2, 4, "error"),//impossible
			array(1, -2, 4, "error"),//impossible
			array("?", -2, -1, "error"),//impossible

			//C0
			array(1, 2, 4, "error"),//not a triangle
			array(3, 3, 3, 1),
			array(3, 4, 3, 2),
			array(3, 4, 5, 3),
			array("?", 1, -1, "error"),//impossible

			//C1
			array(1, 2, 4, "error"),//not a triangle
			array(3, 3, 3, 1),
			array(3, 4, 3, 2),
			array(3, 4, 5, 3),
			array("?", 1, -1, "error"),//impossible
			
			//C2
			array(1, 2, 4, "error"),//not a triangle
			array(3, 3, 3, 1),
			array(3, 4, 3, 2),
			array(3, 4, 5, 3),
			array("?", 1, -1, "error"),//impossible
			
			//MCDC
			array(4, 1, 2, "error"),//not a triangle
			array(1, 4, 2, "error"),//not a triangle
			array(1, 2, 4, "error"),//not a triangle
			array(3, 3, 3, 1),
			array(4, 3, 3, 2),
			array(3, 4, 3, 2),
			array(3, 3, 4, 2),
			array(3, 4, 5, 3),
			array(0, 1, 1, "error"),//impossible
			array(1, 0, 1, "error"),//impossible
			array(1, 1, 0, "error"),//impossible
			array($maxInt+1, 1, 1, "error"),//impossible
			array(1, $maxInt+1, 1, "error"),//impossible
			array(1, 1, $maxInt+1, "error"),//impossible
	

        );
    }
	

    /**
     * @dataProvider myProviderBoundaryValueTestingStandard
     */

    public function testTriangle($a=1,$b=0,$c=0,$expected='error') {
		try {
			if ($expected == "error" || $expected == "ok") {
				$this -> triangle -> validateInt($a,$b,$c);
				$this -> triangle -> validateRange($a,$b,$c);
				$this -> triangle -> validateFormation($a,$b,$c);
				$this -> ValidateFunc(1,$expected);
			} else {
				$result = $this -> triangle -> calTriangle($a, $b, $c);
				$this -> assertEquals($expected, $result);
			}
        } catch(Exception $e) {
			$this -> ValidateFunc(2,$expected,$e);
        }
    }
	

}
?>