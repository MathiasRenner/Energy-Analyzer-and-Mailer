<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 08/12/15
 * Time: 14:33
 */

require "Calculations.php";

class HtmlClassification
{
    public function GetHtmlClassification()
    {

        $message = SingletonMessage::Instance();
        //$cid = $message->embed(Swift_Image::fromPath('assets/eklasse.png'));

        // feature badge
        $db = DBAccessSingleton::getInstance();
        $aryReportedOn = $db->extractionsUserReportedOn;
        $aryUniqueReportOn = array_unique($aryReportedOn);
        $reportCount = count($aryUniqueReportOn);
        $upload = 0;

        if($db->extractionUserCount < 50)
        {
            $extractionUserCount = $db->extractionUserCount;
        }
        else
        {
            $extractionUserCount = 50;
        }

        $rewardHeading = "Your reward!";
        // select the right badge
        if($reportCount < 10)
        {
            $badge = "";
            $upload = 10;
            $rewardHeading = "Here will be your next award!";
        }
        elseif($reportCount >= 10 && $reportCount < 25)
        {
            $badge = '<td><img width="140" height="82" src="assets/badges/g1.png"></td>';
            $upload = 25;
        }
        elseif($reportCount >= 25 && $reportCount < 75)
        {
            $badge = '<td><img width="140" height="82" src="assets/badges/g2.png"></td>';
            $upload = 75;
        }
        elseif($reportCount >= 75 && $reportCount < 150)
        {
            $badge = '<td><img width="140" height="82" src="assets/badges/g3.png"></td>';
            $upload = 150;
        }
        elseif($reportCount >= 150 && $reportCount < 300)
        {
            $badge = '<td><img width="140" height="82"  src="assets/badges/g4.png"></td>';
            $upload = 300;
        }
        elseif($reportCount >= 300)
        {
            $badge = '<td><img width="140" height="82" src="assets/badges/g5.png"></td>';
        }

        $rewardText = "";
        if($reportCount < 10)
        {
            $rewardText = 'You have uploaded your data <b>'. $reportCount . '</b> times!<br/>
            If you upload your shower data <b>'. $upload .'</b> times you will get your first reward!<br/>';
        }
        elseif($reportCount < 300)
        {
            $rewardText = 'You have uploaded your data <b>'. $reportCount . '</b> times!<br/>
            If you upload your shower data <b>'. $upload .'</b> times the living place of your icebear will increase!<br/>';
        }
        elseif($reportCount >= 300)
        {
            $rewardText = 'You have uploaded your data <b>'. $reportCount . '</b> times!<br/>
            We thank you very much for being such an awesome customer!<br/>';
        }




        // feature classification
        $calc = new Calculations();
        $energy = $calc->CalcEnergyUsageUser();
        $class =  $calc->GetEfficiencyClass($energy);

        $rowAA = '<td> <img width="auto" height="40px" src="assets/classifications/AA.png" > </td>';
        $rowA = '<td> <img width="auto" height="40px" src="assets/classifications/A.png" > </td>';
        $rowB = '<td> <img width="auto" height="40px" src="assets/classifications/B.png" > </td>';
        $rowC = '<td> <img width="auto" height="40px" src="assets/classifications/C.png" > </td>';
        $rowD = '<td> <img width="auto" height="40px" src="assets/classifications/D.png" > </td>';
        $rowE = '<td> <img width="auto" height="40px" src="assets/classifications/E.png" > </td>';
        $rowF = '<td> <img width="auto" height="40px" src="assets/classifications/F.png" > </td>';
        $rowG = '<td> <img width="auto" height="40px" src="assets/classifications/G.png" > </td>';

        if ($class == 'A+') {
            $rowAA = '<td> <img width="auto" height="40px" src="assets/classifications/AAY.png" > </td>';
        }
        if ($class == 'A') {
            $rowA = '<td> <img width="auto" height="40px" src="assets/classifications/AY.png" > </td>';
        }
        if ($class == 'B') {
            $rowB = '<td> <img width="auto" height="40px" src="assets/classifications/BY.png" > </td>';
        }
        if ($class == 'C') {
            $rowC = '<td> <img width="auto" height="40px" src="assets/classifications/CY.png" > </td>';
        }
        if ($class == 'D') {
            $rowD = '<td> <img width="auto" height="40px" src="assets/classifications/DY.png" > </td>';
        }
        if ($class == 'E') {
            $rowE = '<td> <img width="auto" height="40px" src="assets/classifications/EY.png" > </td>';
        }
        if ($class == 'F') {
            $rowF = '<td> <img width="auto" height="40px" src="assets/classifications/FY.png" > </td>';
        }
        if ($class == 'G') {
            $rowG = '<td> <img width="auto" height="40px" src="assets/classifications/GY.png" > </td>';
        }

        if($class != 'A+')
        {
            $savingVolume = $calc->CalcSavingVolumeForBetterEnergyClass($energy);
            $savingTime = $calc->CalcSavingTimeForBetterEnergyClass($energy);
            $savingText =  'If you lower your average water consumption by <b>'. round($savingVolume)  .' liter</b>
                            or you shorten your showertime by <b>'. round($savingTime) .' seconds</b> for each shower you will reach the next better efficiency class!
                            You can also combine both and lower your warter consumption by <b>'. round($savingVolume / 2) .' liter</b>
                            and shorten your showertime by <b>'. round($savingTime / 2) .' seconds</b> for each shower';
        }


        // feature twitter
        $ttext = 'Let\'s+save+the+planet!+My+efficiency+class+for+the+last+showers+were+' . $class . '+with+' . $energy . '+Wh+per+shower!';
        $twittertext = 'https://twitter.com/intent/tweet?url=http%3A%2F%2Famphiro.com&text='. $ttext .'&via=AmphiroAG';



        return
'
<table cellpadding="0" cellspacing="0" width="800px">
    <tr>
        <td colspan="2" class="headline" align="center" style="font-family: arial,sans-serif; font-size: 22px; color: #333; padding-top: 10px;">
        Your position on the efficiency scale
        </td>
    </tr>

    <tr>
        <td colspan="2" class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;
        padding-left: 30px; padding-right: 30px;">
        for the average energy consumption off the last <b>'. $extractionUserCount .'</b> showers.

        Your average energy consumption was <b>'. $energy .' </b>  Wh per shower.
        With this energy usage your energy efficiency class is <b>'. $class .'</b>. <br/> &nbsp;
        </td>
    </tr>

    <tr>
        <td>

        <table cellpadding="0" cellspacing="0" width="500" style="padding-left: 20px;">

        <tr>
        <td>&nbsp;</td>
        </tr>
        <tr>
        '. $rowAA .'
        </tr>
        <tr>
        '. $rowA .'
        </tr>
        <tr>
        '. $rowB .'
        </tr>
        <tr>
        '. $rowC .'
        </tr>
        <tr>
        '. $rowD .'
        </tr>
        <tr>
        '. $rowE .'
        </tr>
        <tr>
        '. $rowF .'
        </tr>
        <tr>
        '. $rowG .'
        </tr>
        </table>

        </td>


        <td>

        <table cellpadding="0" cellspacing="0" width="300">

      <!--
        <tr>
            <td class="body_copy" align="center" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
            <b>Share on Twitter!</b>
            </td>
        </tr>
        -->

        <tr>
        <td>&nbsp;</td>
        </tr>

        <tr>
            <td align="center">
            <a href="' . $twittertext . '">
                <img width="140px" height="80px"   src="assets/twitter/twitter_share.png">
            </a>
            </td>
        </tr>


        <tr>
        <td>&nbsp;</td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        </tr>

        <tr>
            <td class="body_copy" align="center" style="font-family: arial,sans-serif; font-size: 18px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
            <b>'. $rewardHeading . '</b>
            </td>
        </tr>

        <tr>
        <td>&nbsp;</td>
        </tr>

        <tr align="center">
            '. $badge .'
        </tr>

        <tr>
            <td class="body_copy" align="center" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">

            '. $rewardText .'

            </td>
        </tr>

        </table>

        </td>
    </tr>

    <tr>
        <td>&nbsp;<br/></td>
    </tr>

    <tr>
        <td colspan="2" class="body_copy" align="center" style="font-family: arial,sans-serif; font-size: 18px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
        <!--<b>Your Goal for the next report!</b> -->
        <b>You can reach the next better efficiency class!</b>
        </td>
    </tr>

    <tr>
        <td colspan="2" class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;
        padding-left: 30px; padding-right: 30px;">
        '. $savingText .'
        </td>
    </tr>

</table>

<br/>
';
    }
}


