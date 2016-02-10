<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 10/02/16
 * Time: 20:07
 */
include "../business/Calculations.php";

class CalculationTests extends PHPUnit_Framework_TestCase
{

    public function testCalculationEnergyUsageNormalShowerExpected()
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
