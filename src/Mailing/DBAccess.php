<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 28/11/15
 * Time: 15:55
 */
/**
 * Singleton class
 *
 *
 */
/**
 * Singleton class
 *
 */
class DBAccessSingleton
{
    //variable to hold db connection
    private $db;

    // the userId
    public $userIdAll = array();
    public $userIdsWithExtractions = array();

    // variable for all the funny stuff
    public $username;
    public $firstname;
    public $familyname;
    public $address;
    public $email;
    public $postal;
    public $city;
    public $country;

    public $extractionsUserReportedOn = array();

    public $energyUser = array();
    public $energyAllUser = array();

    static private $instance = null;

    static public function getInstance()
    {
        if (null === self::$instance)
        {
             self::$instance = new self;
        }
        return self::$instance;
    }

     private function __construct()
     {
         $this->db = mysqli_connect('***REMOVED***:5190', '***REMOVED***', '***REMOVED***', '***REMOVED***');
     }
     private function __clone(){}

    public function RunAll($id)
    {
        $this->SetAllUserIds();
        $this->SetAllUserIdWithExtractions();

        $this->SetAllUserEnergy();
        $this->Update($id);
    }

    public function Update($id)
    {
        $this->SetUserDataInfo($id);
        $this->SetUserEnergy($id);
    }


    private function SetAllUserIds()
    {
        $query = "SELECT id FROM b1user";
        $res = mysqli_query($this->db, $query);
        while($row = mysqli_fetch_object($res))
        {
            array_push($this->userIdAll, $row->id);
        }
    }

    public function SetAllUserIdWithExtractions()
    {
        $queryUE = "SELECT DISTINCT b1user_id FROM b1users_b1extractions";
        $res = mysqli_query($this->db, $queryUE);
        while($row = mysqli_fetch_object($res))
        {
            array_push($this->userIdsWithExtractions, $row->b1user_id);
        }
    }

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


    private function SetUserEnergy($id)
    {
        $calc = new Calculations();

        $userExtractionId = array();
        $res = mysqli_query($this->db, "SELECT * FROM b1users_b1extractions WHERE b1user_id =" . $id );
        while($row = mysqli_fetch_object($res))
        {
            array_push($userExtractionId , $row->b1extraction_id);
        }

        $query = "Select * From b1extraction WHERE id= " . $userExtractionId[0];

        foreach($userExtractionId AS $extractionId)
        {
            $query = $query . " OR id = ". $extractionId;
        }
        $query = $query . " ORDER BY showerID DESC;";// Limit 10;";

        $res = mysqli_query($this->db, $query);
        while($row = mysqli_fetch_object($res))
        {

            $cwT = 10;
            if(!is_null($row->coldWaterTemperature) && $row->coldWaterTemperature > 10)
            {
                $cwT = $row->coldWaterTemperature;
            }
            $he = 100;
            if(!is_null($row->heatingEfficiency) && $row->heatingEfficiency < 100 && $row->heatingEfficiency > 80)
            {
                $he = $row->heatingEfficiency;
            }
            // TODO: TIME
            if(!is_null($row->volume) && $row->volume > 0 &&
                !is_null($row->temperature) && $row->temperature > 0 )
            {
                array_push($this->energyUser, $calc->CalcEnergy($row->volume,$row->temperature,$cwT,$he/ 100));
                array_push($this->extractionsUserReportedOn, $this->GetDate($row->reportedOn));
            }
        }
    }

    public function SetAllUserEnergy()
    {
        $calc = new Calculations();

        $allUserWithExtractions = array();
        $queryUE = "SELECT DISTINCT b1user_id FROM b1users_b1extractions";
        $res = mysqli_query($this->db, $queryUE);
        while($row = mysqli_fetch_object($res))
        {
            array_push($allUserWithExtractions, $row->b1user_id);
        }

        foreach ($allUserWithExtractions as $uID)
        {

            $userExtractionIds = array();
            $userEnergyTemp = array();
            $query = "SELECT b1extraction_id FROM b1users_b1extractions WHERE b1user_id = " . $uID;
            $res = mysqli_query($this->db, $query);
            while($row = mysqli_fetch_object($res))
            {
                array_push($userExtractionIds, $row->b1extraction_id);
            }

            $queryE = "Select * From b1extraction WHERE id= " . $userExtractionIds[0];

            foreach($userExtractionIds AS $extractionId)
            {
                $queryE = $queryE . " OR id = ". $extractionId;
            }
            $queryE = $queryE . " ORDER BY showerID;";// Limit 10;";

            $res = mysqli_query($this->db, $queryE);
            while($row = mysqli_fetch_object($res))
            {
                $cwT = 10;
                if(!is_null($row->coldWaterTemperature) && $row->coldWaterTemperature > 10)
                {
                    $cwT = $row->coldWaterTemperature;
                }
                $he = 100;
                if(!is_null($row->heatingEfficiency) && $row->heatingEfficiency < 100 && $row->heatingEfficiency > 80)
                {
                    $he = $row->heatingEfficiency;
                }

                if(!is_null($row->volume) && $row->volume > 0 &&
                    !is_null($row->temperature) && $row->temperature > 0 )
                {
                    array_push($userEnergyTemp, $calc->CalcEnergy($row->volume,$row->temperature,$cwT,$he/ 100));
                }
            }
            if(count($userEnergyTemp) > 0)
            {
                array_push($this->energyAllUser, $userEnergyTemp);
            }
        }
    }

    private function GetDate($reportTime)
    {
        $date = $reportTime;
        $ts   = strtotime($date);
        return date('Y-m-d', $ts);

    }


}