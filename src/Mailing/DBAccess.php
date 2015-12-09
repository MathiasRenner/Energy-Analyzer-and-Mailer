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

    // variable for all the funny stuff
    public $username;
    public $firstname;
    public $familyname;
    public $address;
    public $email;
    public $postal;
    public $city;
    public $country;

    public $extractionIds = array();
    public $extractionsUserVolume = array();
    public $extractionsUserTemperature = array();
    public $extractionsUserColdWaterTemperature = array();
    public $extractionsHeatingEfficiency = array();
    public $extractionsReportedOn = array();


    static private $instance = null;

    static public function getInstance()
    {
        if (null === self::$instance)
        {
             self::$instance = new self;

             //self::$instance->RunAll($id);
        }
        return self::$instance;
    }

     private function __construct(){
         $this->db = mysqli_connect('***REMOVED***:5190', '***REMOVED***', '***REMOVED***', '***REMOVED***');
     }
     private function __clone(){}

    public function RunAll($id)
    {
        $this->SetAllUserData($id);

        $this->SetDevices($id);
        $this->SetUserExtractions();

    }

    private function SetUserExtractions()
    {
        $query = "Select * From b1extraction WHERE showerID= " . $this->extractionIds[0];

        foreach($this->extractionIds AS $extractionId)
        {
            $query = $query . " OR showerID = ". $extractionId;
        }
        $query = $query . " ORDER BY id DESC Limit 10;";

        $res = mysqli_query($this->db, $query);
        while($row = mysqli_fetch_object($res))
        {
            array_push($this->extractionsUserVolume, $row->volume);
            array_push($this->extractionsUserTemperature, $row->temperature);
            array_push($this->extractionsUserColdWaterTemperature, $row->coldWaterTemperature);
            array_push($this->extractionsHeatingEfficiency, $row->heatingEfficiency);
            array_push($this->extractionsReportedOn, $row->reportedOn);
        }

    }

    private function SetAllUserData($id)
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

    private function SetDevices($id)
    {
        $res = mysqli_query($this->db, "SELECT * FROM b1users_b1extractions WHERE b1user_id =" . $id );
        while($row = mysqli_fetch_object($res))
        {
            array_push($this->extractionIds, $row->b1extraction_id);
        }
    }


}