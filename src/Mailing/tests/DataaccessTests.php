<?php

include "../database/DatabaseAccess.php";
include "../business/Calculations.php";

/*
 * Test class for the Dataaccess
 */
class DataAccessTests extends PHPUnit_Framework_TestCase
{

    public function testGetInstanceNotNull()
    {
        // Arrange
        //
        // Act
        $db = DBAccessSingleton::getInstance();

        // Assert
        $this->assertNotNull($db);
    }

    public function testSetUserInfoForUser1EmailNotNull()
    {
        // Arrange
        $db = DBAccessSingleton::getInstance();

        // Act
        $db->UpdateCurrentUserData(1);

        // Assert
        $this->assertNotNull($db->getEmail());
    }

    public function testSetUserInfosForUser1VolumelNotNull()
    {
        // Arrange
        $db = DBAccessSingleton::getInstance();

        // Act
        $db->UpdateCurrentUserData(1);

        // Assert
        $this->assertNotNull($db->getVolumeUser());
    }

    public function testSetUserInfosForAllUserVolumelNotNull()
    {
        // Arrange
        $db = DBAccessSingleton::getInstance();

        // Act
        $db->Init();

        // Assert
        $this->assertNotNull($db->getVolumeAllUser());
    }
}