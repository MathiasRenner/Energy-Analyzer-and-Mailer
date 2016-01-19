<?php

/**
 * Class HtmlClassification
 *
 * Creates
 *  - the Classification-Feature
 *  - the twitter feature
 *  - the reward-feature
 */
class HtmlClassification
{
    public function GetHtmlClassification()
    {
        // feature gamification badge
        $db = DBAccessSingleton::getInstance();

        // get the count off all uploads
        $aryReportedOn = $db->reportedOnUser;
        $aryUniqueReportOn = array_unique($aryReportedOn);
        $reportCount = count($aryUniqueReportOn);
        $upload = 0;

        $extractionUserCount = UtilSingleton::GetExtractionUserCount();

        $rewardHeading = "Your reward!";
        $badge = "";

        // select the right badge
        if($reportCount < 10)
        {
            $badge = "";
            $upload = 10;
            $rewardHeading = "Here will be your next award!";
        }
        elseif($reportCount >= 10 && $reportCount < 25)
        {

            $badge = '<td><img width="140" height="82" src="'.UtilSingleton::getInstance()->InlinePicture("assets/badges/g1.png").'"></td>';
            $upload = 25;
        }
        elseif($reportCount >= 25 && $reportCount < 75)
        {
            $badge = '<td><img width="140" height="82" src="'.UtilSingleton::getInstance()->InlinePicture("assets/badges/g2.png").'"></td>';
            $upload = 75;
        }
        elseif($reportCount >= 75 && $reportCount < 150)
        {
            $badge = '<td><img width="140" height="82" src="'.UtilSingleton::getInstance()->InlinePicture("assets/badges/g3.png").'"></td>';
            $upload = 150;
        }
        elseif($reportCount >= 150 && $reportCount < 300)
        {
            $badge = '<td><img width="140" height="82"  src="'.UtilSingleton::getInstance()->InlinePicture("assets/badges/g4.png").'"></td>';
            $upload = 300;
        }
        elseif($reportCount >= 300)
        {
            $badge = '<td><img width="140" height="82" src="'.UtilSingleton::getInstance()->InlinePicture("assets/badges/g5.png").'"></td>';
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


        // feature energy efficiency classification
        $calc = new Calculations();
        $energy = $calc->CalcEnergyUser();
        $class =  UtilSingleton::GetEfficiencyClass($energy);

        $rowAA = "";
        $rowA  = "";
        $rowB  = "";
        $rowC  = "";
        $rowD  = "";
        $rowE  = "";
        $rowF  = "";
        $rowG  = "";

        // set the user row
        if ($class == 'A+') {
            $rowAA = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/AAY.png").'" > </td>';
            $rowA = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/A.png").'" > </td>';
            $rowB = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/B.png").'" > </td>';
            $rowC = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/C.png").'" > </td>';
            $rowD = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/D.png").'" > </td>';
            $rowE = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/E.png").'" > </td>';
            $rowF = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/F.png").'" > </td>';
            $rowG = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/G.png").'" > </td>';

        }
        elseif ($class == 'A') {
            $rowA = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/AY.png").'" > </td>';
            $rowAA = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/AA.png").'" > </td>';
            $rowB = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/B.png").'" > </td>';
            $rowC = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/C.png").'" > </td>';
            $rowD = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/D.png").'" > </td>';
            $rowE = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/E.png").'" > </td>';
            $rowF = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/F.png").'" > </td>';
            $rowG = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/G.png").'" > </td>';

        }
        elseif ($class == 'B') {
            $rowB = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/BY.png").'" > </td>';
            $rowAA = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/AA.png").'" > </td>';
            $rowA = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/A.png").'" > </td>';
            $rowC = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/C.png").'" > </td>';
            $rowD = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/D.png").'" > </td>';
            $rowE = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/E.png").'" > </td>';
            $rowF = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/F.png").'" > </td>';
            $rowG = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/G.png").'" > </td>';

        }
        elseif ($class == 'C') {
            $rowC = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/CY.png").'" > </td>';
            $rowAA = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/AA.png").'" > </td>';
            $rowA = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/A.png").'" > </td>';
            $rowB = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/B.png").'" > </td>';
            $rowD = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/D.png").'" > </td>';
            $rowE = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/E.png").'" > </td>';
            $rowF = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/F.png").'" > </td>';
            $rowG = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/G.png").'" > </td>';

        }
        elseif ($class == 'D') {
            $rowD = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/DY.png").'" > </td>';
            $rowAA = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/AA.png").'" > </td>';
            $rowA = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/A.png").'" > </td>';
            $rowB = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/B.png").'" > </td>';
            $rowC = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/C.png").'" > </td>';
            $rowE = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/E.png").'" > </td>';
            $rowF = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/F.png").'" > </td>';
            $rowG = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/G.png").'" > </td>';
        }
        elseif ($class == 'E') {
            $rowE = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/EY.png").'" > </td>';
            $rowAA = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/AA.png").'" > </td>';
            $rowA = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/A.png").'" > </td>';
            $rowB = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/B.png").'" > </td>';
            $rowC = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/C.png").'" > </td>';
            $rowD = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/D.png").'" > </td>';
            $rowF = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/F.png").'" > </td>';
            $rowG = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/G.png").'" > </td>';
        }
        elseif ($class == 'F') {
            $rowF = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/FY.png").'" > </td>';
            $rowAA = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/AA.png").'" > </td>';
            $rowA = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/A.png").'" > </td>';
            $rowB = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/B.png").'" > </td>';
            $rowC = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/C.png").'" > </td>';
            $rowD = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/D.png").'" > </td>';
            $rowE = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/E.png").'" > </td>';
            $rowG = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/G.png").'" > </td>';

        }
        elseif ($class == 'G') {
            $rowG = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/GY.png").'" > </td>';
            $rowAA = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/AA.png").'" > </td>';
            $rowA = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/A.png").'" > </td>';
            $rowB = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/B.png").'" > </td>';
            $rowC = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/C.png").'" > </td>';
            $rowD = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/D.png").'" > </td>';
            $rowE = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/E.png").'" > </td>';
            $rowF = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/F.png").'" > </td>';
        }

        // feature goal setting
        // only for efficiency classes != "A+"
        $goal = "";

        if($class != "A+")
        {
            $savingVolume = $calc->CalcSavingVolumeForBetterEnergyClass($energy);
            $savingTime = $calc->CalcSavingTimeForBetterEnergyClass($energy);
            $savingText1 = '...if you lower your average water consumption by <b>'. round($savingVolume)  .' liter</b>
                            <br/>
                            <b>or</b> you shorten your showertime by <b>'. round($savingTime) .' seconds.</b>';
            $savingText2 = '...if you lower your average water consumption by <b>'. round($savingVolume / 2) .' liter</b>
                            <br/>
                            <b>and</b> shorten your showertime by <b>'. round($savingTime / 2) .' seconds</b>';

            $goal = '
              <tr>
            <td colspan="4" class="body_copy" align="center" style="font-family: arial,sans-serif; font-size: 18px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
            <!--<b>Your Goal for the next report!</b> -->
            <b>You can reach the next better efficiency class...</b>
            </td>
        </tr>

        <tr>
            <td colspan="4">

            <table width="100%">
            <tr>
            <td width="20%"><img align="left" src="'.UtilSingleton::getInstance()->InlinePicture("pictures/volumeSavingChart.png").'" > </td>
            <td width="30%" class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;
            padding-left: 3px; padding-right: 3px;">
            '. $savingText1 .'
            </td>
            <td width="30%" class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;
            padding-left: 3px; padding-right: 3px;">
            '. $savingText2 .'
            </td>
            <td width="20%"> <img align="left" src="'.UtilSingleton::getInstance()->InlinePicture("pictures/combinedSavingChart.png").'" > </td>
            </tr>
            </table>

            </td>
        </tr>
            ';

        }

        // feature twitter
        $ttext = 'Let\'s+save+the+planet!+My+efficiency+class+for+the+last+showers+were+' . $class . '+with+' . $energy . '+Wh+per+shower!';
        $twittertext = 'https://twitter.com/intent/tweet?url=http%3A%2F%2Famphiro.com&text='. $ttext .'&via=AmphiroAG';

        return $this->GetHtml($extractionUserCount,$energy,$class,$rowAA,$rowA,$rowB,$rowC,$rowD,$rowE,$rowF,$rowG,
            $twittertext,$rewardHeading,$badge,$rewardText,$goal);
    }

    private function GetHtml($extractionUserCount,$energy,$class,$rowAA,$rowA,$rowB,$rowC,$rowD,$rowE,$rowF,$rowG,
                             $twittertext,$rewardHeading,$badge,$rewardText,$goal)
    {
        return
            '
<table class=section cellpadding="0" cellspacing="0">
    <tr>
        <td class="headline" colspan="2" class="headline" align="center" style="font-family: arial,sans-serif; font-size: 22px; color: #333; padding-top: 10px;">
        Your position on the efficiency scale
        </td>
    </tr>

    <tr>
        <td colspan="2" class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;
        padding-left: 30px; padding-right: 30px;">
        ... for the average energy consumption of the last <b>'. $extractionUserCount .'</b> showers: <br />

        In average, you consumed <b>'. $energy .' </b>  Wh per shower.
        With this energy usage your energy efficiency class is <b>'. $class .'</b>. <br/> &nbsp;
        </td>
    </tr>

    <tr>
        <td>

        <table cellpadding="0" cellspacing="0" width="480" style="padding-left: 20px;">

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
                <img width="140px" height="80px"   src="'.UtilSingleton::getInstance()->InlinePicture("assets/twitter/twitter_share_2.png").'"/>
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

</table>

<br/>

<table class=section cellpadding="0" cellspacing="0">
    '. $goal .'

</table>

<br/>
';
    }

}


