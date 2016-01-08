<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 25/11/15
 * Time: 17:56
 */

include_once "libs/swiftmailer/lib/swift_required.php";

include "HtmlPriming.php";
include "HtmlClassification.php";
include "HtmlDescInj.php";
include "HtmlTimeComp.php";
include "HtmlRecommendations.php";
include "HtmlFooter.php";
include "HtmlSummary.php";

class CreateHtmlMail
{
    /**
     * @return string
     */
    public function CreateHTMLMailing()
    {
        $priming = new HtmlPriming();
        $classification = new HtmlClassification();
        $descinj = new HtmlDescInj();
        $timecomp = new HtmlTimeComp();
        $recommendations = new HtmlRecommendations();
        $footer = new HtmlFooter();
        $summary = new HtmlSummary();

        $htmlheadmeta = $this->GetHtmlHeadMeta();

        $priming_html =  $priming->GetHtmlPriming();
        $classification_html = $classification->GetHtmlClassification();
        $descinj_html = $descinj->GetHtmlDescInj();
        $timecomp_html = $timecomp->GetHtmlTimeComp();
        $recommendations_html = $recommendations->GetHtmlRecommendations();
        $footer_html = $footer->GetHtmlFooter();
        $summary_html = $summary->GetHtmlSummary();

        return $htmlheadmeta . '' . $priming_html .''. $descinj_html .''. $classification_html . '
        ' . $timecomp_html . '' . $recommendations_html . ''. $summary_html  .'' . $footer_html . '</body></html>';
    }

    private function GetHtmlHeadMeta()
    {
        return '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    <title>Amphiro Report 0.5</title>
                </head>
                <body>';
    }
}
