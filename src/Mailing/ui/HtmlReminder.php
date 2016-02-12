<?php

/**
 * Class HtmlPriming
 *
 * crates the Priming feature
 * with say something big at the beginning and
 * personal speech
 */
class HtmlReminder
{
    public function GetHtmlPriming()
    {
        $db = DBAccessSingleton::getInstance();
        $extractionUserCount = $db->getExtractionsCountUser();

        // if the user has not given a name take the mail address
        if(strlen($db->getFirstname()) == 0)
        {
            $name = $db->getEmail();
        }
        else
        {
            $name = $db->getFirstname();
        }

        return $this->GetHtml($name);
    }

    private function GetHtml($name)
    {
        $db = DBAccessSingleton::getInstance();
        $DaysSinceLastUpload = $db->CalcDaysSinceLastUpload();

        return
'<br/>
<table class=section cellpadding="0" cellspacing="0">
    <tr>
        <td  width="800" align="center">
            <table cellpadding="0" cellspacing="0">
                <tr>
                <td width="800" align="center" valign="top">
                    <table cellpadding="0" cellspacing="0">
                    <tr>
                    <td> <a class="hero_image"><a href="http://amphiro.com/"><img src="'. UtilSingleton::getInstance()->InlinePicture("assets/priming/amphirologo.png") .'" width="200" alt="" style="display: block; border: 0;" /> </a>
                    </td>
                    </tr>
                    </table>
                </td>
                </tr>

                <tr>
                <td class="headline" width="800" style="font-family: arial,sans-serif; font-size: 22px; color: #7f7f7f; padding-top: 10px;">
                We are sorry, <br />
                we would like to send you an updated amphiro report but we couldn’t!
                <br>
                </td>
                </tr>

                <tr>
                <td   width="800" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px; padding-left: 30px; padding-right: 30px;">
                <table>
                <tr>
                <td>  <img src="'. UtilSingleton::getInstance()->InlinePicture("assets/priming/baer.png") .'" width="50" alt=""/>
                </td>
                <td>&nbsp; Hello <b>' . $name . '</b>,</td>
                </tr>
                </table>

                <b>we need some recent data from you, so we can provide you with your <b>personal</b> amphiro report </b> (the last time you uploaded your shower data was  '.  $DaysSinceLastUpload .'   days ago).
                 <br/><br/>
                In the report you will receive information about...

                </td>
                </tr>

                <tr>
                <td  width="800" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px; padding-left: 50px; padding-right: 50px;">


                <lu>
                   <li><strong>your energy consumption compared to other amphiro users</strong></li>
                   <li><strong>your energy saving performance</strong></li>
                   <li><strong>and give personal energy saving tips</strong></li>
                </lu>
                </td>
                </tr>

                <tr>
                <td  width="800" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px; padding-left: 30px; padding-right: 30px;">
                ...so you can save even more energy!
                <br/><br/>
                <b>We look forward to hearing from you soon!</b>

                </td>
                </tr>
            </table>
        </td>
    </tr>
</table>';
    }
}



