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
 */
class DBAccess
{
    public function GetUsername($id)
    {
        $mysqli = mysqli_connect('***REMOVED***', '***REMOVED***', '***REMOVED***', '***REMOVED***');
        $res = mysqli_query($mysqli, "SELECT * FROM b1user WHERE id =" . $id);
        $row = mysqli_fetch_assoc($res);
        return $row['username'];
    }

    /**
     *  ctor
     *
     */
    public function __construct()
    {

    }
}