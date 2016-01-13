<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 15/12/15
 * Time: 20:48
 */

// needed for inline css

// datetime
if (ini_get('date.timezone') == '') {
    date_default_timezone_set('Europe/Brussels');
}
// parse headers
header('content-type: text/html;charset=utf-8');