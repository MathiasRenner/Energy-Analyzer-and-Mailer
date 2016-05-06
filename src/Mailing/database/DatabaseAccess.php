<?php

/**
 * Class DBAccessSingleton
 * implemented as singleton
 * to access all the data-objects with an single db-access
 */
class DBAccessSingleton
{
    //variable to hold db connection
    private $db;

    // the userId / with extractions / with registered for report
    private $userIdAll;
    public function getUserIdAll()
    {
        return $this->userIdAll;
    }

    private $userIdsWithExtractions;
    public function getUserIdsWithExtractions()
    {
        return $this->userIdsWithExtractions;
    }

    private $userIdsRegisteredForReport;
    public function getUserIdsRegisteredForReport()
    {
        return $this->userIdsRegisteredForReport;
    }

    // user data information
    private $username;
    public function getUsername()
    {
        return $this->username;
    }

    private $firstname;
    public function getFirstname()
    {
        return $this->firstname;
    }

    private $familyname;
    public function getFamilyname()
    {
        return $this->familyname;
    }

    private $address;
    public function getAddress()
    {
        return $this->address;
    }

    private $email;
    public function getEmail()
    {
        return $this->email;
    }

    private $postal;
    public function getPostal()
    {
        return $this->postal;
    }

    private $city;
    public function getCity()
    {
        return $this->city;
    }

    private $country;
    public function getCountry()
    {
        return $this->country;
    }

    // user
    private $energyUser;
    public function getEnergyUser()
    {
        return $this->energyUser;
    }

    private $volumeUser;
    public function getVolumeUser()
    {
        return $this->volumeUser;
    }

    private $flowRateUser;
    public function getFlowRateUser()
    {
        return $this->flowRateUser;
    }

    private $temperatureUser;
    public function getTemperatureUser()
    {
        return $this->temperatureUser;
    }

    private $reportedOnUser;
    public function getReportedOnUser()
    {
        return $this->reportedOnUser;
    }


    private $extractionsCountUser;
    public function getExtractionsCountUser()
    {
        return $this->extractionsCountUser;
    }

    // all user
    private $energyAllUser;
    public function getEnergyAllUser()
    {
        return $this->energyAllUser;
    }

    private $flowRateAllUser;
    public function getFlowRateAllUser()
    {
        return $this->flowRateAllUser;
    }

    private $volumeAllUser;
    public function getVolumeAllUser()
    {
        return $this->volumeAllUser;
    }

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
        $this->db = mysqli_connect('IP', 'USER', 'PASSWORD', 'DATABASE');
    }

    private function __clone(){}

    /**
     * Get all the data from the db and run all functions once to get everything we needed
     *
     * the user id
     */
    public function Init()
    {
        $this->SetAllUserIds();
        $this->SetAllUserIdWithExtractions();
        $this->SetAllUserIdRegisteredForReport();

        $this->SetAllUserShowerUsageInformation();
    }

    /**
     * Update only the relevant objects for the user
     *
     * @param $id
     * the user id
     */
    public function UpdateCurrentUserData($id)
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
     * set all userId who are registerd to the portal
     * TODO: update the column studyDataProvider to the corresponding one for registered to reprot
     */
    public function SetAllUserIdRegisteredForReport()
    {
        $this->userIdsRegisteredForReport = array();
        $query = "SELECT id FROM b1user WHERE studyDataProvider = 1";
        $res = mysqli_query($this->db, $query);
        while($row = mysqli_fetch_object($res))
        {
            array_push($this->userIdsRegisteredForReport, $row->id);
        }
    }

    /**
     * for one user, write timestamp of last sent Mail into database
     *
     * @param $id int the user id
     */
    public function WriteTimestampOfMailing($id)
    {
        $date = date( 'Y-m-d' );

        $queryUE = "insert into bires_mcm_mailing (b1user_ID,MailingSentOn) values ($id,'$date')";
        $res = mysqli_query($this->db, $queryUE);
    }

    /**
     * for one user, calculate the number of days since the last mailing has been sent
     *
     * @param $id int the user id
     * @return int
     */
    public function DaysSinceLastMailing($id)
    {
        // Query timestamp of last Mailing from Database
        $queryUE = "select MailingSentOn from ***REMOVED***.bires_mcm_mailing where b1user_ID = $id ORDER BY MailingSentOn DESC  limit 1";
        $res = mysqli_query($this->db, $queryUE);
        $dateLastMailingArray = mysqli_fetch_assoc($res);
        $dateLastMailing = $dateLastMailingArray['MailingSentOn'];

        // Create "Today"
        $now = new DateTime();

        // Calculate difference between "Today" and Last Mailing timestamp
        $val = $now->diff(new DateTime($dateLastMailing));

        // Output and return the interval only in full days
        $interval = (int)$val->format("%a"); // output with sign: $interval = (int)$val->format("%r%a");
        return $interval;
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

                // some data cleaning
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
     * Calculates the days since the last upload
     * @return mixed
     */
    public function CalcDaysSinceLastUpload()
    {
        // Query timestamp of last Upload from Database
        $dateLastUploadString = $this->getReportedOnUser()[(count($this->getReportedOnUser()))-1];
        $dateLastUpload = new DateTime($dateLastUploadString);

        // Create "Today"
        $today = new DateTime('now');

        // Calculate difference between "Today" and Last Upload timestamp
        $diff = $dateLastUpload->diff($today)->days;

        // Return the interval only in full days
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
