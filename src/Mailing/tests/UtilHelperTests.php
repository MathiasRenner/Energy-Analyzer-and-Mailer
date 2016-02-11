<?php
/**
 * Created by PhpStorm.
 */

include "../business/UtilHelper.php";

/*
 * Test class for the UtilHelper
 */
class UtilHelperTests extends PHPUnit_Framework_TestCase
{

    public function testGetEfficiencyClassWith1000GetB()
    {
        // Arrange
        //
        //
        // Act
        $b = UtilSingleton::GetEfficiencyClass(1000);

        // Assert
        $this->assertEquals("B", $b);
    }
}