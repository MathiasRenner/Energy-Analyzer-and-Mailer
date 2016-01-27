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
                    <td> <a class="hero_image"><a href="http://amphiro.com/"><img src="'. UtilSingleton::getInstance()->InlinePicture("assets/badges/logo.png") .'" width="200" alt="" style="display: block; border: 0;" /> </a>
                    </td>
                 <!--   <td>
                        <img src="'. UtilSingleton::getInstance()->InlinePicture("assets/badges/_baer.png") .'" height="40" width="auto" alt="" style="display: block; border: 0;" />
                    </td>
                    <td align="left" style="font-family: arial,sans-serif; font-size: 13px; line-height: 17px !important; color: #7f7f7f; padding-top: 5px;">
                       Together we can <br/><b>save</b> his world!
                    </td> -->
                    </tr>
                    </table>
                </td>
                </tr>

                <tr>
                <td  class="headline" width="800" align="center" style="font-family: arial,sans-serif; font-size: 22px; color: #333; padding-top: 15px; padding-bottom: 20px; ">
                Your personal amphiro report can not be created.
                <br>
                </td>
                </tr>

                <tr>
                <td   width="800" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px; padding-left: 30px; padding-right: 30px;">
                Hello <b>' . $name . '</b>, <br/>
                <br>
                We would be pleased to provide you your <b>personal</b> amphiro report. To do so, we need some recent data from you (the last time you uploaded your shower data was  '.  $DaysSinceLastUpload .'   days ago).
                 <br/><br/>
                The report will then provide you information about...

                </td>
                </tr>

                <tr>
                <td  width="800" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px; padding-left: 50px; padding-right: 50px;">


                <lu>
                   <li><strong>your energy consumption compared to other customers</strong></li>
                   <li><strong>your energy saving performance</strong></li>
                   <li><strong>and give personal energy saving tips</strong></li>
                </lu>
                </td>
                </tr>

                <tr>
                <td  width="800" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px; padding-left: 30px; padding-right: 30px;">
                ...so you can even save more energy!
                <br/><br/>
                <b>We look forward to hear from you soon!</b>


                </td>
                </tr>
            </table>
        </td>
    </tr>
</table>';
    }
}



