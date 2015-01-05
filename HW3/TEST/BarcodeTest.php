<?php
/* tests/BarcodeTest.php */
//require_once '../PHPUnit/Autoload.php';
require __DIR__ . '/../Barcode.php';

class BarcodeTest extends PHPUnit_Framework_TestCase{
	public function setUp() {
        $this -> myBarcode = new Barcode();
    }	
	public function myProvider(){
		return array(
			array('111','iPhone 6 (16G)'),
			array('222','iPhone 6 (64G)'),
			array('333','iPhone 6 Plus (128G)'),
			array('444','iPhone 6 Plus (16G)'),
			array('555','iPhone 6 Plus (64G)'),
			array('666','iPhone 6 Plus (128G)'),
        );
    }
    public function testBarcode(){
        $cart = new Barcode();
        $products = $cart->getProducts();

        $this->assertEquals('111', $products[0]['barcode']);
		$this->assertEquals('222', $products[1]['barcode']);
		$this->assertEquals('333', $products[2]['barcode']);
		$this->assertEquals('444', $products[3]['barcode']);
		$this->assertEquals('555', $products[4]['barcode']);
		$this->assertEquals('666', $products[5]['barcode']);
		
		
    }
}

?>