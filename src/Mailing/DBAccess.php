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
    public $username;
    public $address;

      static private $instance = null;

      static public function getInstance($id)
      {if (null === self::$instance)
         {
             self::$instance = new self;
             self::$instance->runAll($id);
         }
         return self::$instance;
     }

     private function __construct(){
         $this->db = mysqli_connect('***REMOVED***', '***REMOVED***', '***REMOVED***', '***REMOVED***');
     }
     private function __clone(){}

    public function runAll($id)
    {
        $this->GetUsername($id);
        $this->SetAddress($id);
    }

    private function GetUsername($id)
    {
        $res = mysqli_query($this->db, "SELECT * FROM b1user WHERE id =" . $id);
        $row = mysqli_fetch_assoc($res);
        $this->username = $row['username'];
    }

    private function SetAddress($id)
    {
        $res = mysqli_query($this->db, "SELECT * FROM b1user WHERE id =" . $id);
        $row = mysqli_fetch_assoc($res);
        $this->address = $row['address'];
    }
}