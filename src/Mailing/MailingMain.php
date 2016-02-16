<?php

/**
 * Main PHP File for running the mailing service
 * Include all needed files
 *
 * Set Debug Mode true = sending the mail, false = show the mailing in the browser
 *
 * 1. step: init all needed database variables
 * 2. step: init the SwiftMailer instaces
 * 3. step: decide weather to send an mailing or not
 * 4. step: build all the grafics
 * 5. step: build all the hmtl mailing segments
 * 6. step: combine the css with the html segments
 * 7. step: send the mail
 */

use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

require_once 'config.php';
require_once __DIR__ . '/vendor/autoload.php';

/* pChart library inclusions */
include("libs/charts/pChart2_1_4/class/pData.class.php");
include("libs/charts/pChart2_1_4/class/pDraw.class.php");
include("libs/charts/pChart2_1_4/class/pImage.class.php");
include("libs/charts/pChart2_1_4/class/pPie.class.php");

/* include all needed files */
include "business/CreateCharts.php";
include "business/CreateHtmlMail.php";
include "business/CreateHtmlMailReminder.php";
include "business/Calculations.php";
include "business/UtilHelper.php";

include "database/DatabaseAccess.php";

include "ui/HtmlPriming.php";
include "ui/HtmlClassification.php";
include "ui/HtmlDescInj.php";
include "ui/HtmlTimeComp.php";
include "ui/HtmlRecommendations.php";
include "ui/HtmlFooter.php";
include "ui/HtmlSummary.php";
include "ui/HtmlTwitterBadge.php";
include "ui/HtmlReminder.php";
include "ui/HtmlThinkBig.php";

// Parameter
//$id = $_GET['user'];
//$debug = $_GET['debug'];

// 1. step
// DEBUG MODE:
$debug = true;
UtilSingleton::getInstance()->SetDebugMode($debug);

// Init DB and get all relevant db entries
$db = DBAccessSingleton::getInstance();
$db->Init();  // init database and all consumption data

if($debug)
{
    $daysSinceLastUpload = 9999;
    // To show  users in different efficiency classes, use 1 = A | 7 = B | 5 = F | array(1,5,7);
    // Test if user did not recently upload data: 11
    // Test if just received a report: 4
    $allUser = array(1);
}
else
{
    $daysSinceLastUpload = 21;
    // if you wanna send all users with extractions or all registered users
    //$allUser = $db->getUserIdsWithExtractions();
    //$allUser = $db->getUserIdAll();
    $allUser = $db->getUserIdsRegisteredForReport();
    //$allUser = array(1,2,3);
}


foreach($allUser as $id)
{
    // set the user db information
    $db->UpdateCurrentUserData($id);

    // 2. step
    // create the message object
    $message = new Swift_Message("Your personal amphiro report");
    UtilSingleton::getInstance()->SetSwiftMailerInstance($message);

    // 3. step
    // if last mailing has been sent within the last X days, do not send a report again
    global $sendMail;
    $sendMail = true;
    if ($db->DaysSinceLastMailing($id) < 21 && $db->DaysSinceLastMailing($id) != 0 ) {

        $sendMail = false;
        echo 'No report has been generated because the last report has been sent ' . $db->DaysSinceLastMailing($id) . ' day(s) ago.';
        //break;

        // if user did not upload data in the last X days, send him a reminder to upload data
    } else if ($db->CalcDaysSinceLastUpload() >= $daysSinceLastUpload) {

        // create the html mail including all pictures + html + style
        $htmlMailing = new CreateHtmlMailReminder();
        $html = $htmlMailing->CreateHTMLReminderMailing();

    } else {

        // 4. step
        // create the chart object
        $createChart = new CreateCharts();
        // create all charts
        $createChart->CreateAllCharts();

        // 5. step
        // create the html mail including all pictures + html + style
        $htmlMailing = new CreateHtmlMail();
        $html = $htmlMailing->CreateHTMLMailing();
    }

    // only send Mail when variable has not been set to false before
    if ($sendMail == true)
    {
        // 6. step
        // inline css
        $cssToInlineStyles = new CssToInlineStyles();
        $css = file_get_contents(__DIR__ . '/ui/mailing.css');
        $cssToInlineStyles->setHTML($html);
        $cssToInlineStyles->setCSS($css);
        // output
        $html = $cssToInlineStyles->convert();

        // the transport object
        $transport = Swift_SmtpTransport::newInstance('mail.uni-bamberg.de', 587, 'tls');
        $transport->setLocalDomain('[127.0.0.1]');

        $from = array('mailing@amphiro.com' => 'Amphiro');
        $to = array(
            $db->getEmail() => $db->getFirstname(). ' ' . $db->getFamilyname()
        );

        // object for sending the finished mail
        $mailer = Swift_Mailer::newInstance($transport);

        // build your mail
        $message->setFrom($from);
        $message->setBody($html, 'text/html');

        // further infos
        //$text = "This is your Amphiro report. Together we can save the planet!";

        $message->setTo($to);
        //$message->addPart($text, 'text/plain');

        // display for debug
        if($debug)
        {
            print $message->getBody();
        }

        if($debug == false)
        {
            // 7. step
            // for sending your email
            if ($recipients = $mailer->send($message, $failures)) { echo '<br/>Message successfully sent!';

            // write timestamp to database
            //$db->WriteTimestampOfMailing($id);

            } else { echo "There was an error:\n"; print_r($failures);}
        }
    }
}
