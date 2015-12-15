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

        $htmlheadmeta = $this->GetHtmlHeadMeta();

        $priming_html =  $priming->GetHtmlPriming();
        $classification_html = $classification->GetHtmlClassification();
        $descinj_html = $descinj->GetHtmlDescInj();
        $timecomp_html = $timecomp->GetHtmlTimeComp();
        $recommendations_html = $recommendations->GetHtmlRecommendations();

        return $htmlheadmeta . '' . $priming_html .''. $descinj_html  .''. $classification_html . '' . $timecomp_html . '' . $recommendations_html . '</body></html>';
    }

    private function GetHtmlHeadMeta()
    {
        return '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    <title>Amphiro Report 0.1</title>
                </head>
                <body>';
    }

    private function GetDummyHtml()
    {
        return '
<html>

<head>

<style>

  .buttonshare {
        display: block;
        width: 150px;
        height: 20px;
        background: #4E9CAF;
        padding: 10px;
        text-align: center;
        border-radius: 5px;
        color: white;
        font-weight: bold;
        }


</style>
</head>

<body>
<table cellpadding="0" cellspacing="0">
    <tr>
        <td class="pattern" width="600" align="center">
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <td class="col" width="290" valign="top">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="hero_image"><img src="http://placehold.it/450x150" width="290" alt="" style="display: block; border: 0;" /></td>
                            </tr>
                            <tr>
                                <td class="headline" align="left" style="font-family: arial,sans-serif; font-size: 22px; color: #333; padding-top: 15px;">
                                  <a class="buttonshare" href="www.google.de">butttttoooon</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
                                    Virtual computing via the cloud is all the rage these days but blade servers, which make up the bulk of the infrastructure for cloud computing systems, require specific fusing for high reliability and uptime. The Littelfuse 456 Series--- NANO2 Subminature Surface Mount Fuse - is perfect for this.
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="padding-top: 15px;"><img src="http://placehold.it/118x34/333&text=Learn+More" alt="Learn More" style="display: block; border: 0;" /></td>
                            </tr>
                        </table>
                    </td>
                    <td class="spacer" width="20" style="font-size: 1px;">&nbsp;</td>
                    <td class="col" width="290" valign="top">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="hero_image"><img src="http://placehold.it/450x150" width="290" alt="" style="display: block; border: 0;" /></td>
                            </tr>
                            <tr>
                                <td class="headline" align="left" style="font-family: arial,sans-serif; font-size: 22px; color: #333; padding-top: 15px;">
                                    This is a story headline
                                </td>
                            </tr>
                            <tr>
                                <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
                                    Virtual computing via the cloud is all the rage these days but blade servers, which make up the bulk of the infrastructure for cloud computing systems, require specific fusing for high reliability and uptime. The Littelfuse 456 Series--- NANO2 Subminature Surface Mount Fuse - is perfect for this.
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="padding-top: 15px;"><img src="http://placehold.it/118x34/333&text=Learn+More" alt="Learn More" style="display: block; border: 0;" /></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<table cellpadding="0" cellspacing="0">
    <tr>
        <td class="pattern1" width="600">
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <td class="hero1">
                        <img src="http://placehold.it/600x200&text=Hero+Image" alt="" style="display: block; border: 0;" />
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-family: arial,sans-serif; color: #333;">
                        <h1>Header Text</h1>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #666; padding-bottom: 20px;">
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa. Sed eleifend nonummy diam. Praesent mauris ante, elementum et, bibendum at, posuere sit amet, nibh. Duis tincidunt lectus quis dui viverra vestibulum. Suspendisse vulputate aliquam dui. Nulla elementum dui ut augue. Aliquam vehicula mi at mauris. Maecenas placerat, nisl at consequat rhoncus, sem nunc gravida justo, quis eleifend arcu velit quis lacus. Morbi magna magna, tincidunt a, mattis non, imperdiet vitae, tellus. Sed odio est, auctor ac, sollicitudin in, consequat vitae, orci. Fusce id felis. Vivamus sollicitudin metus eget eros.
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        <a href="#"><img src="http://placehold.it/200x50/333&text=CTA+»" alt="CTA" style="display: block; border: 0;" /></a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
';
    }
}