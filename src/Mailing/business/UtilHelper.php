<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 13/01/16
 * Time: 10:29
 */

/**
 * Class UtilHelper
 *
 * Helper class for various problems
 */
class UtilSingleton
{
    // the one and only message object
    private $message;

    /**
     * instance
     *
     * Statische Variable, um die aktuelle (einzige!) Instanz dieser Klasse zu halten
     *
     */
    static private $instance = null;

    // instance creation and get instance
    static public function getInstance()
    {
        if (null === self::$instance)
        {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * clone
     *
     * Kopieren der Instanz von aussen ebenfalls verbieten
     */
    protected function __clone() {}

    /**
     * constructor
     *
     * externe Instanzierung verbieten
     */
    protected function __construct() {}

    public function SetSwiftMailerInstance($m)
    {
        $this->message = $m;
    }

    /**
     * Helper to encode pictures to base64
     *
     * @param $pathToPicture
     * @return mixed the encoded picture
     */
    public function InlinePicture($pathToPicture)
    {
        // uncommend the line when you send a mail
        //$picture = Swift_Image::fromPath($pathToPicture);
        //$picture->setDisposition('inline');
        //return $cid = $this->message->embed($picture);

        // for debug to see the pictures in the browser
        return $pathToPicture;
    }

    /**
     * returns the next better Wh consumption for the next better efficiency class
     *
     * @param $actualConsumption
     * @return int
     */
    public static function GetConsumptionForBetterEfficiencyClass($actualConsumption)
    {
        $betterConsumption = 0;
        if($actualConsumption >= 350 && $actualConsumption <= 700)
        {
            $betterConsumption = 349;
        }
        elseif($actualConsumption > 700 && $actualConsumption <= 1225)
        {
            $betterConsumption = 699;
        }
        elseif($actualConsumption > 1225 && $actualConsumption <= 1750)
        {
            $betterConsumption = 1224;
        }
        elseif($actualConsumption > 1750 && $actualConsumption <= 2275)
        {
            $betterConsumption = 1749;
        }
        elseif($actualConsumption > 2275 && $actualConsumption <= 2800)
        {
            $betterConsumption = 2274;
        }
        elseif($actualConsumption > 2800 && $actualConsumption <= 3325)
        {
            $betterConsumption = 2799;
        }
        elseif($actualConsumption > 3325)
        {
            $betterConsumption = 3324;
        }
        return $betterConsumption;
    }

    /**
     * Gets the corresponding efficiency class
     *
     * @param $energy|int actual energy consumption
     * @return string the actual class
     */
    public static function GetEfficiencyClass($energy)
    {
        if($energy < 350)
        {
            return 'A+';
        }
        elseif($energy < 700)
        {
            return 'A';
        }
        elseif ($energy < 1225)
        {
            return 'B';
        }
        elseif ($energy < 1750)
        {
            return 'C';
        }
        elseif ($energy < 2275)
        {
            return 'D';
        }
        elseif ($energy < 2800)
        {
            return 'E';
        }
        elseif ($energy < 3325)
        {
            return 'F';
        }
        elseif ($energy >= 3325)
        {
            return 'G';
        }
        return "";
    }

    /**
     * Gets the number of extractions for this user
     *
     * @param bool|FALSE $ignoreLimit FALSE for getting only 50 extractions
     *                     TRUE for getting all extraction counts
     * @return int count of extractions
     */
    public static function GetExtractionUserCount($ignoreLimit = FALSE)
    {
        $db = DBAccessSingleton::getInstance();
        if($ignoreLimit)
        {
            return $db->extractionsCountUser;
        }
        if($db->extractionsCountUser < 50)
        {
            $extractionUserCount = $db->extractionsCountUser;
        }
        else
        {
            $extractionUserCount = 50;
        }
        return $extractionUserCount;
    }
}
