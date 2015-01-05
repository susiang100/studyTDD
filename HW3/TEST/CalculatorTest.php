<?php
//require_once 'PHPUnit/Autoload.php';
require_once '../Calculator.php';

class CalculatorTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        $this->calc = new Calculator();
    }

    public function testAdd() {
        $result = $this->calc->add(1, 2);
        $this->assertEquals(3, $result);
    }

    public function testSubstract() {
        $result = $this->calc->substract(2, 1);
        $this->assertEquals(1, $result);
    }

    public function testMultiply() {
        $result = $this->calc->multiply(3, 2);
        $this->assertEquals(6, $result);
    }

    public function testDivide() {
        $result = $this->calc->divide(4, 2);
        $this->assertEquals(2, $result);
    }

}
