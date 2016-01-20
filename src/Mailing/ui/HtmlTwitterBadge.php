<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 19/01/16
 * Time: 15:18
 */

class HtmlTwitterBadge
{

    public function GetTwitterBadge()
    {

        $calc = new Calculations();
        $energy = $calc->CalcEnergyUser();
        $class =  UtilSingleton::GetEfficiencyClass($energy);

        // feature twitter
        $ttext = 'Let\'s+save+the+planet!+My+efficiency+class+for+the+last+showers+were+' . $class . '+with+' . $energy . '+Wh+per+shower!';
        $twittertext = 'https://twitter.com/intent/tweet?url=http%3A%2F%2Famphiro.com&text='. $ttext .'&via=AmphiroAG';

        // feature gamification badge
        $db = DBAccessSingleton::getInstance();

        // get the count off all uploads
        $aryReportedOn = $db->reportedOnUser;
        $aryUniqueReportOn = array_unique($aryReportedOn);
        $reportCount = count($aryUniqueReportOn);
        $upload = 0;

        $rewardHeading = "Your reward!";
        $badge = "";

        // select the right badge
        if($reportCount < 10)
        {
            $badge = "";
            $upload = 10;
            $rewardHeading = "Your next reward will be here!";
        }
        elseif($reportCount >= 10 && $reportCount < 25)
        {

            $badge = '<td width="30%" align="center"><img width="140" height="82" src="'.UtilSingleton::getInstance()->InlinePicture("assets/badges/g1.png").'"></td>';
            $upload = 25;
        }
        elseif($reportCount >= 25 && $reportCount < 75)
        {
            $badge = '<td width="30%" align="center"><img width="140" height="82" src="'.UtilSingleton::getInstance()->InlinePicture("assets/badges/g2.png").'"></td>';
            $upload = 75;
        }
        elseif($reportCount >= 75 && $reportCount < 150)
        {
            $badge = '<td width="30%" align="center"><img width="140" height="82" src="'.UtilSingleton::getInstance()->InlinePicture("assets/badges/g3.png").'"></td>';
            $upload = 150;
        }
        elseif($reportCount >= 150 && $reportCount < 300)
        {
            $badge = '<td width="30%" align="center"><img width="140" height="82"  src="'.UtilSingleton::getInstance()->InlinePicture("assets/badges/g4.png").'"></td>';
            $upload = 300;
        }
        elseif($reportCount >= 300)
        {
            $badge = '<td width="30%" align="center"><img width="140" height="82" src="'.UtilSingleton::getInstance()->InlinePicture("assets/badges/g5.png").'"></td>';
        }

        $rewardText = "";
        if($reportCount < 10)
        {
            $rewardText = 'You have uploaded your data <b>'. $reportCount . '</b> times!<br/>
            Upload your shower data <b>'. $upload .'</b> times and you will get your first reward!<br/>';
        }
        elseif($reportCount < 300)
        {
            $rewardText = 'You have uploaded your data <b>'. $reportCount . '</b> times!<br/>
            Upload your shower data <b>'. $upload .'</b> times and the living place increases!<br/>';
        }
        elseif($reportCount >= 300)
        {
            $rewardText = 'You have uploaded your data <b>'. $reportCount . '</b> times!<br/>
            We thank you very much for being such an awesome customer!<br/>';
        }


        return '
<table class=section cellpadding="0" cellspacing="0">

   <tr>
        <td width="30%" class="body_copy" align="center" style="font-family: arial,sans-serif; font-size: 18px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
        Share it!</td>
        <td width="70%" colspan="3" class="body_copy" align="center" style="font-family: arial,sans-serif; font-size: 18px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
        '.$rewardHeading.'</td>
        <td></td>
   </tr>

   <tr>
        <td>&nbsp;</td>
   </tr>

   <tr>
            <td width="30%" align="center">
            <a href="' . $twittertext . '">
                <img width="140px" height="80px"   src="'.UtilSingleton::getInstance()->InlinePicture("assets/twitter/twitter_share_2.png").'"/>
            </a>
            </td>

            '. $badge .'

            <td width="40%" class="body_copy" align="center" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
            '. $rewardText .'
            </td>

    </tr>
</table>
';
    }
}
