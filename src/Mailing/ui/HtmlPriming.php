<?php

/**
 * Class HtmlPriming
 *
 * crates the Priming feature
 * with say something big at the beginning and
 * personal speech
 */
class HtmlPriming
{
    public function GetHtmlPriming()
    {
        // feature say something big
        $db = DBAccessSingleton::getInstance();

        // if the user has not given a name take the mail address
        if(strlen($db->getFirstname()) == 0)
        {
            $name = $db->getEmail();
        }
        else
        {
            $name = $db->getFirstname();
        }

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
                    <td> <a class="hero_image"><a href="http://amphiro.com/"><img src="'. UtilSingleton::getInstance()->InlinePicture("assets/priming/amphirologo.png") .'" width="200" alt="" style="display: block; border: 0; padding-top: 15px;" /> </a>
                    </td>
                 <!--   <td>
                        <img src=" UtilSingleton::getInstance()->InlinePicture("assets/badges/baer.png") " height="40" width="auto" alt="" style="display: block; border: 0;" />
                    </td>
                    <td align="left" style="font-family: arial,sans-serif; font-size: 13px; line-height: 17px !important; color: #7f7f7f; padding-top: 5px;">
                       Together we can <br/><b>save</b> his world!
                    </td> -->
                    </tr>
                    </table>
                </td>
                </tr>

                <tr>
                <td  class="headline" width="800" align="center" style="font-family: arial,sans-serif; font-size: 22px; color: #7f7f7f; padding-top: 15px; padding-bottom: 20px; ">
                Your personal amphiro report
                <br>
                </td>
                </tr>

                <tr>
                <td   width="800" align="left" valign="top" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px; padding-left: 30px; padding-right: 30px;">

                <table>
                <tr>
                <td>  <img src="'. UtilSingleton::getInstance()->InlinePicture("assets/priming/baer.png") .'" width="50" alt=""/>
                </td>
                <td>&nbsp; Hello <b>' . $name . '</b>,</td>
                </tr>
                </table>
                We are pleased to provide you with your <b>personal</b> amphiro report.
                <br/>
                You receive information about...

                </td>
                </tr>

                <tr>
                <td  width="800" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px; padding-left: 50px; padding-right: 50px;">

                <lu>
                   <li><strong>your energy consumption compared to other amphiro users</strong></li>
                   <li><strong>your energy saving performance</strong></li>
                   <li><strong>personal energy saving tips</strong></li>
                </lu>
                </td>
                </tr>

                <tr>
                <td  width="800" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px; padding-left: 30px; padding-right: 30px;">
                ...so you can save even more energy!
                </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<br/>';
    }
}



