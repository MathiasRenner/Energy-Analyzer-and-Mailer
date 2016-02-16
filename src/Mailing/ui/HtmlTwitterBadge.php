<?php

/**
 * Class HtmlTwitterBadge for displaying the twitter and gamification feature
 */
class HtmlTwitterBadge
{
    /**
     *
     * @return string building the html segment
     */
    public function GetTwitterBadge()
    {

        $calc = new Calculations();
        $energy = $calc->CalcEnergyUser();
        $class =  UtilSingleton::GetEfficiencyClass($energy);

        // feature twitter
        $ttext = 'Let\'s+save+more+energy!+My+shower+efficiency+class+is+' . $class . '+with+' . $energy . '+Wh+per+shower!';
        $twittertext = 'https://twitter.com/intent/tweet?url=http%3A%2F%2Famphiro.com&text='. $ttext .'&via=AmphiroAG';

        // feature gamification badge
        $db = DBAccessSingleton::getInstance();

        // get the count off all uploads
        $aryReportedOn = $db->getReportedOnUser();
        // only one upload per day will be used for the upload count
        $aryUniqueReportOn = array_unique($aryReportedOn);
        $reportCount = count($aryUniqueReportOn);
        $upload = 0;

        $rewardHeadingText = '&nbsp; &nbsp; You received a new badge!';
        $badge = "";

        // select the right badge
        if($reportCount < 10)
        {
            $badge = "";
            $upload = 10;
            $rewardHeadingText = "Your first badge will be here!";
        }
        elseif($reportCount >= 10 && $reportCount < 25)
        {
            $badge = '<td width="30%" align="center" valign="top"><img width="90" height="auto" src="'.UtilSingleton::getInstance()->InlinePicture("assets/badges/g1.png").'"></td>';
            $upload = 25;
        }
        elseif($reportCount >= 25 && $reportCount < 75)
        {
            $badge = '<td width="30%" align="center" valign="top"><img width="90" height="auto" src="'.UtilSingleton::getInstance()->InlinePicture("assets/badges/g2.png").'"></td>';
            $upload = 75;
        }
        elseif($reportCount >= 75 && $reportCount < 150)
        {
            $badge = '<td width="30%" align="center" valign="top"><img width="90" height="auto" src="'.UtilSingleton::getInstance()->InlinePicture("assets/badges/g3.png").'"></td>';
            $upload = 150;
        }
        elseif($reportCount >= 150 && $reportCount < 300)
        {
            $badge = '<td width="30%" align="center" valign="top"><img width="90" height="auto" src="'.UtilSingleton::getInstance()->InlinePicture("assets/badges/g4.png").'"></td>';
            $upload = 300;
        }
        elseif($reportCount >= 300)
        {
            $badge = '<td width="30%" align="center" valign="top"><img width="90" height="auto" src="'.UtilSingleton::getInstance()->InlinePicture("assets/badges/g5.png").'"></td>';
        }

        $rewardText = "";
        if($reportCount < 10)
        {
          $rewardHeading = '<td width="70%" colspan="3" class="body_copy" align="center" style="font-family: arial,sans-serif; font-size: 18px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
            '.$rewardHeadingText.'</td>';

        $rewardText = '<td width="40%" class="body_copy" align="center" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
             You have uploaded your data <b>'. $reportCount . '</b> times!<br/>
            Upload your shower data <b>'. $upload .'</b> times <br/> and you will get your first reward!
            </td>';
        }
        elseif($reportCount < 300)
        {
            $rewardHeading = '<td width="70%" colspan="3" class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 18px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
            '.$rewardHeadingText.'</td>';

            $rewardText = '<td width="40%" class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 1px; padding-left: 20px;">
            You have uploaded your data <b>'. $reportCount . '</b> times!<br/>
            Upload your shower data <b>'. $upload .'</b> times to increase the polar bear\'s living space!
            </td>';
        }
        elseif($reportCount >= 300)
        {
            $rewardHeading = '<td width="70%" colspan="3" class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 18px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
            '.$rewardHeadingText.'</td>';

            $rewardText = '<td width="40%" class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 1px; padding-left: 20px;">
            You have uploaded your data <b>'. $reportCount . '</b> times!<br/>
            We thank you very much for being such an awesome customer!
            </td>';
        }


        return '
<table width="820" class=section cellpadding="0" cellspacing="0">

   <tr >
        <td width="30%" class="body_copy" align="center" style="font-family: arial,sans-serif; font-size: 18px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
        </td>
        '. $rewardHeading.'
        <td></td>
   </tr>


   <tr>
            <td width="30%" align="center">
            <a href="' . $twittertext . '">
                <img width="140px" height="auto"   src="'.UtilSingleton::getInstance()->InlinePicture("assets/twitter/twitter_share_2.png").'"/>
            </a>
            </td>


            '. $rewardText .'

            '. $badge .'

    </tr>
</table>
';
    }
}
