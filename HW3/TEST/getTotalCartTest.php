<?php
/* tests/CartTest.php */
//require_once '../PHPUnit/Autoload.php';
require __DIR__ . '/../Cart.php';

class getTotalCartTest extends PHPUnit_Framework_TestCase{
	public function setUp() {
        $this -> mycart = new Cart();
    }	
	public function myProvider(){
		return array(
			array(0,[0, 0, 0, 0, 0, 0,]),
			array(199,[1, 0, 0, 0, 0, 0,]),
			array(299,[0, 1, 0, 0, 0, 0,]),
			array(399,[0, 0, 1, 0, 0, 0,]),
			array(299,[0, 0, 0, 1, 0, 0,]),
			array(399,[0, 0, 0, 0, 1, 0,]),
			array(499,[0, 0, 0, 0, 0, 1,]),
	
			array(498,[1, 1, 0, 0, 0, 0,]),
			array(698,[0, 1, 1, 0, 0, 0,]),
			array(698,[0, 0, 1, 1, 0, 0,]),
			array(698,[0, 0, 0, 1, 1, 0,]),
			array(898,[0, 0, 0, 0, 1, 1,]),
			array(698,[1, 0, 0, 0, 0, 1,]),
			
			array(897,[1, 1, 1, 0, 0, 0,]),
			array(997,[0, 1, 1, 1, 0, 0,]),
			array(1097,[0, 0, 1, 1, 1, 0,]),
			array(1197,[0, 0, 0, 1, 1, 1,]),
			array(1097,[1, 0, 0, 0, 1, 1,]),
			array(997,[1, 1, 0, 0, 0, 1,]),
			
			array(1196,[1, 1, 1, 1, 0, 0,]),
			array(1396,[0, 1, 1, 1, 1, 0,]),
			array(1596,[0, 0, 1, 1, 1, 1,]),
			array(1396,[1, 0, 0, 1, 1, 1,]),
			array(1396,[1, 1, 0, 0, 1, 1,]),
			array(1396,[1, 1, 1, 0, 0, 1,]),
	
			array(1595,[1, 1, 1, 1, 1, 0,]),
			array(1895,[0, 1, 1, 1, 1, 1,]),
			array(1795,[1, 0, 1, 1, 1, 1,]),
			array(1695,[1, 1, 0, 1, 1, 1,]),
			array(1795,[1, 1, 1, 0, 1, 1,]),
			array(1695,[1, 1, 1, 1, 0, 1,]),
			
			array(2094,[1, 1, 1, 1, 1, 1,]),
			
        );
    }
	
	/**
     * @dataProvider myProvider
     */
    public function testCart($expected=0,$quantities=[0]){
		$result = $this -> mycart -> updateQuantities($quantities);
		$result = $this -> mycart -> getTotal();
		$this -> assertEquals($expected, $result);
    }
}

?>