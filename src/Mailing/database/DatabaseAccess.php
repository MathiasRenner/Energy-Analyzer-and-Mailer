<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 28/11/15
 * Time: 15:55
 */

/**
 * Class DBAccessSingleton
 * implemented as singleton
 * to access all the data-objects with an single db-access
 */
class DBAccessSingleton
{
    //variable to hold db connection
    private $db;

    // the userId / with extractions
    public $userIdAll;
    public $userIdsWithExtractions;

    // user data information
    public $username;
    public $firstname;
    public $familyname;
    public $address;
    public $email;
    public $postal;
    public $city;
    public $country;

    // user
    public $energyUser;
    public $volumeUser;
    public $flowRateUser;
    public $temperatureUser;
    public $reportedOnUser;
    public $extractionsCountUser;

    // all user
    public $energyAllUser;
    public $flowRateAllUser;
    public $volumeAllUser;

    // singleton instance
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
     * DBAccessSingleton constructor.
     *
     * init the db connection
     */
    private function __construct()
    {
        $this->db = mysqli_connect('***REMOVED***:5190', '***REMOVED***', '***REMOVED***', '***REMOVED***');
    }

    private function __clone(){}

    /**
     * Get all the data from the db and rum all functions one time to get everything we needed
     *
     * the user id
     */
    public function Init()
    {
        $this->SetAllUserIds();
        $this->SetAllUserIdWithExtractions();

        $this->SetAllUserShowerUsageInformation();
    }

    /**
     * Update only the relevant objects for the user
     *
     * @param $id
     * the user id
     */
    public function Update($id)
    {
        $this->SetUserDataInfo($id);
        $this->SetUserShowerUsageInformation($id);
    }

    /**
     * set all userid in the userIdAll object
     */
    private function SetAllUserIds()
    {
        $this->userIdAll = array();

        $query = "SELECT id FROM b1user";
        $res = mysqli_query($this->db, $query);
        while($row = mysqli_fetch_object($res))
        {
            array_push($this->userIdAll, $row->id);
        }
    }

    /**
     *  set all userid int the userIdsWithExtractions object who has extractions
     */
    public function SetAllUserIdWithExtractions()
    {
        $this->userIdsWithExtractions = array();

        $queryUE = "SELECT DISTINCT b1user_id FROM b1users_b1extractions";
        $res = mysqli_query($this->db, $queryUE);
        while($row = mysqli_fetch_object($res))
        {
            array_push($this->userIdsWithExtractions, $row->b1user_id);
        }
    }

    /**
     * set all user information
     *
     * @param $id int the user id
     */
    private function SetUserDataInfo($id)
    {
        $res = mysqli_query($this->db, "SELECT * FROM b1user WHERE id =" . $id);
        $row = mysqli_fetch_assoc($res);
        $this->username = $row['username'];
        $this->address = $row['address'];
        $this->email = $row['email'];
        $this->city = $row['city'];
        $this->postal = $row['postal'];
        $this->country = $row['country'];
        $this->firstname = $row['firstName'];
        $this->familyname = $row['familyName'];
    }

    /**
     * set the calculated showerUsageInformation usage for each shower for the given user
     * into the corresponding object
     * @param $id int the user id
     */
    private function SetUserShowerUsageInformation($id)
    {
        $calc = new Calculations();

        $this->energyUser = array();
        $this->volumeUser = array();
        $this->flowRateUser = array();
        $this->temperatureUser = array();
        $this->reportedOnUser = array();
        $this->extractionsCountUser = 0;

        $userExtractionId = array();
        // get all the extractionid for the user
        $res = mysqli_query($this->db, "SELECT * FROM b1users_b1extractions WHERE b1user_id =" . $id );
        while($row = mysqli_fetch_object($res))
        {
            array_push($userExtractionId , $row->b1extraction_id);
        }

        // building the query to get all shower data information
        $query = "Select * From b1extraction WHERE id= " . $userExtractionId[0];
        foreach($userExtractionId AS $extractionId)
        {
            $query = $query . " OR id = ". $extractionId;
        }
        $query = $query . " ORDER BY showerID;"; // order ascending

        // get all the row information
        $res = mysqli_query($this->db, $query);
        while($row = mysqli_fetch_object($res))
        {
            // count all extractions
            $this->extractionsCountUser = $this->extractionsCountUser + 1;

            // check coldwatertemp
            $cwT = 10;
            if(!is_null($row->coldWaterTemperature) && $row->coldWaterTemperature > 10)
            {
                $cwT = $row->coldWaterTemperature;
            }

            // check heat efficiency
            $he = 100;
            if(!is_null($row->heatingEfficiency) && $row->heatingEfficiency < 100 && $row->heatingEfficiency > 80)
            {
                $he = $row->heatingEfficiency;
            }
            // Data Cleaning
            if(!is_null($row->volume) && $row->volume >= 5 && $row->volume <= 150 &&  // detect outlier
                !is_null($row->flowRate) && $row->flowRate > 0 &&
                !is_null($row->temperature) && $row->temperature > 10
            )
            {
                // push the value into the corresponding array
                array_push($this->volumeUser, $row->volume);
                array_push($this->flowRateUser, $row->flowRate);
                array_push($this->temperatureUser, $row->temperature);
                // calculate the energy usage
                array_push($this->energyUser, $calc->CalcEnergy($row->volume,$row->temperature,$cwT,$he/ 100));
                // push all upload dates
                if($this->GetDate('')!= $this->GetDate($row->reportedOn))
                {
                    array_push($this->reportedOnUser, $this->GetDate($row->reportedOn));
                }
            }
        }
    }

    /**
     * set the calculated showerUsageInformation for each shower for all user
     * into the corresponding object
     */
    private function SetAllUserShowerUsageInformation()
    {
        $calc = new Calculations();

        $allUserWithExtractions = array();
        $this->energyAllUser = array();
        $this->flowRateAllUser = array();
        $this->volumeAllUser = array();

        // get all user with extractionids
        $queryUE = "SELECT DISTINCT b1user_id FROM b1users_b1extractions";
        $res = mysqli_query($this->db, $queryUE);
        while($row = mysqli_fetch_object($res))
        {
            array_push($allUserWithExtractions, $row->b1user_id);
        }

        // loop all user
        foreach ($allUserWithExtractions as $uID)
        {
            // temp variables
            $userExtractionIdsTemp = array();
            $userEnergyTemp = array();
            $userFlowRateTemp = array();
            $userVolumeTemp = array();

            // get all the extractionid for the user
            $query = "SELECT b1extraction_id FROM b1users_b1extractions WHERE b1user_id = " . $uID;
            $res = mysqli_query($this->db, $query);
            while($row = mysqli_fetch_object($res))
            {
                array_push($userExtractionIdsTemp, $row->b1extraction_id);
            }

            // building the query to get all shower data information
            $queryShowerData = "Select * From b1extraction WHERE id= " . $userExtractionIdsTemp[0];
            foreach($userExtractionIdsTemp AS $extractionId)
            {
                $queryShowerData = $queryShowerData . " OR id = ". $extractionId;
            }
            $queryShowerData = $queryShowerData . " ORDER BY showerID;";

            // get all the row information
            $res = mysqli_query($this->db, $queryShowerData);
            while($row = mysqli_fetch_object($res))
            {
                // check coldwatertemp
                $cwT = 10;
                if(!is_null($row->coldWaterTemperature) && $row->coldWaterTemperature > 10)
                {
                    $cwT = $row->coldWaterTemperature;
                }

                // check heat efficiency
                $he = 100;
                if(!is_null($row->heatingEfficiency) && $row->heatingEfficiency < 100 && $row->heatingEfficiency > 80)
                {
                    $he = $row->heatingEfficiency;
                }

                // same data cleaning
                if(!is_null($row->volume) && $row->volume >= 5 && $row->volume <= 150 &&
                    !is_null($row->flowRate) && $row->flowRate > 0 &&
                    !is_null($row->temperature) && $row->temperature > 10)
                {
                    // push the value into the corresponding array
                    array_push($userEnergyTemp, $calc->CalcEnergy($row->volume,$row->temperature,$cwT,$he / 100));
                    array_push($userFlowRateTemp, $row->flowRate);
                    array_push($userVolumeTemp, $row->volume);
                }
            }

            // after all shower data for one user is completed push the array into the array witch holds
            // all data
            array_push($this->volumeAllUser, $userVolumeTemp);
            array_push($this->flowRateAllUser, $userFlowRateTemp);
            array_push($this->energyAllUser, $userEnergyTemp);
        } // end foreach user
    }


    /**
     * TODO naming not calc describe function
     *
     *
     * @param $id
     * @return mixed
     */
    private function CalcDaysSinceLastReport($id)
    {
        $lastReport = mysqli_query($this->db, "SELECT * FROM bires_mcm_mailing WHERE id =" . $id . " ORDER BY lastMailingSent DESC;");
        $dateLastReport = new DateTime($lastReport);

        $today = new DateTime('now');

        $diff = $datetime1->diff($today)->days;
        return $diff;
    }

    /**
     * Get the maximum number of extractions
     * @return mixed the extraction count as int
     */
    public function GetNumberOfExtractions()
    {
       // get all extractions
        $allExtractions = mysqli_query($this->db, "SELECT COUNT(id) as count FROM b1extraction");
        $row = mysqli_fetch_assoc($allExtractions);

        return $row['count'];
    }

    /**
     * Get the maximum number of user
     * @return mixed the user count as int
     */
    public function GetNumberOfUsers(){
        // get all users
        $queryAllUsers = mysqli_query($this->db, "SELECT COUNT(id) as count FROM b1user");
        $row = mysqli_fetch_assoc($queryAllUsers);

        return $row['count'];
    }

    /**
     * extract the date from the timestamp
     *
     * @param $reportTime timestamp
     * @return bool|string the date
     */
    private function GetDate($reportTime)
    {
        $date = $reportTime;
        $ts   = strtotime($date);
        return date('Y-m-d', $ts);
    }
}