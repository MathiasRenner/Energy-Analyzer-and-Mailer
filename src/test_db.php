<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 26.11.15
 * Time: 16:42
 */
$mysqli = mysqli_connect('***REMOVED***', '***REMOVED***', '***REMOVED***', '***REMOVED***');
$res = mysqli_query($mysqli, "SELECT * FROM b1user");
$row = mysqli_fetch_assoc($res);
echo $row['username'];
?>
