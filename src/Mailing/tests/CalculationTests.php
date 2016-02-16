<?php

include "../business/Calculations.php";

/*
 * Test class for the Calculation.php
 */
class CalculationTests extends PHPUnit_Framework_TestCase
{

    public function testCalculationEnergyUsageNormalShowerExpected1750()
    {
        // Arrange
        $a = new Calculations();

        //((4200/3600) * 40 * 30) / 0,8
        // Act
        $b = $a->CalcEnergy(40,40,10,0.8);

        // Assert
        $this->assertEquals(1750, $b);
    }


}
