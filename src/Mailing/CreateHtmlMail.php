<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 25/11/15
 * Time: 17:56
 */

include "HtmlPriming.php";
include "HtmlClassification.php";
include "HtmlDescInj.php";
include "HtmlTimeComp.php";
include "HtmlRecommendations.php";
include "HtmlFooter.php";
include "HtmlSummary.php";

/**
 * Class CreateHtmlMail
 *
 * Create the complete html mail
 */
class CreateHtmlMail
{
    /**
     * Creates the complete html mal
     *
     * @return string the complete html mail
     */
    public function CreateHTMLMailing()
    {
        // init html section classes
        $priming = new HtmlPriming();
        $classification = new HtmlClassification();
        $descinj = new HtmlDescInj();
        $timecomp = new HtmlTimeComp();
        $recommendations = new HtmlRecommendations();
        $footer = new HtmlFooter();
        $summary = new HtmlSummary();

        // gets the html header information
        $htmlheadmeta = $this->GetHtmlHeadMeta();

        // gets the html sections
        $priming_html =  $priming->GetHtmlPriming();
        $classification_html = $classification->GetHtmlClassification();
        $descinj_html = $descinj->GetHtmlDescInj();
        $timecomp_html = $timecomp->GetHtmlTimeComp();
        $recommendations_html = $recommendations->GetHtmlRecommendations();
        $footer_html = $footer->GetHtmlFooter();
        $summary_html = $summary->GetHtmlSummary();

        // build and return the full html mail
        return
            $htmlheadmeta
            .$priming_html
            .$descinj_html
            .$classification_html
            .$timecomp_html
            .$recommendations_html
            .$summary_html
            .$footer_html
            .'</body></html>';
    }

    /**
     * Define the head for the html mail
     *
     * @return string the html meta head
     */
    private function GetHtmlHeadMeta()
    {
        return '<!DOCTYPE html>
                <html lang="en">
                <head>
                <!-- importend charset=utf-8 and http-equiv="Content-Type" for the inline css -->
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    <title>Amphiro Report 0.5</title>
                </head>
                <body>';
    }
}
