<?php
/* tests/CartTest.php */
//require_once '../PHPUnit/Autoload.php';
require __DIR__ . '/../Cart.php';

class getProductsCartTest extends PHPUnit_Framework_TestCase{
	public function setUp() {
        $this -> mycart = new Cart();
    }
    public function testCart(){
        $products = $this -> mycart -> getProducts();
        $this->assertEquals(6, count($products));
        //$this->assertEquals(2, $products[3]['quantity']);
    }
}

?>