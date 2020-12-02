<?php

use PHPUnit\Framework\TestCase;

class FirstTest extends \PHPUnit\Framework\TestCase
{
    public function testPerimeterArea()
    {
        require "app/index.php";

        $this->assertEquals(1463099.36, perimeter(68.571166, 96.802899, 68.571166, 108.931805, 66.419762, 96.802899));
        $this->assertEquals(444520.40, perimeter(1, 1, 1, 2, 2, 1));
        $this->assertEquals(117745715190.53, area(68.571166, 96.802899, 68.571166, 108.931805, 66.419762, 96.802899));
    }
};
