<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 25/11/15
 * Time: 17:56
 */
//include "CreateCharts.php";
include_once "libs/swiftmailer/lib/swift_required.php";

class CreateHtmlMail
{

    /**
     * @param $cid
     * @return string
     */
    public function CreateHTMLMailing($cid)
    {
        //$createChart = new CreateCharts();
        //$createChart->CreateDummyChart();

        // If placing the embed() code inline becomes cumbersome
        // it's easy to do this in two steps
        //$cid = $message->embed(Swift_Image::fromPath('dummy.png'));

        $dummytext = "Hallo Dummy Welt";

        return '<html>' .
        ' <head>  <style> h2 {color:red;}</style> </head>' .
        ' <body>' .
        ' <h2> '.$dummytext .'</h2> ' .
       // '  Here is an image <img src="' . $cid . '" alt="Image" />' .
        '  Here is an image <img src="pictures/test.png" alt="Image" />' .
        '  Rest of message' .
        ' </body>' .
        '</html>';
    }
}