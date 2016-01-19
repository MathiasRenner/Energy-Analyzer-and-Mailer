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
        $extractionUserCount = UtilSingleton::GetExtractionUserCount();

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
          //  $rowD = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/D.png").'" > </td>';
          //  $rowE = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/E.png").'" > </td>';
          //  $rowF = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/F.png").'" > </td>';
          //  $rowG = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/G.png").'" > </td>';

        }
        elseif ($class == 'A') {
            $rowA = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/AY.png").'" > </td>';
            $rowAA = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/AA.png").'" > </td>';
            $rowB = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/B.png").'" > </td>';
            $rowC = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/C.png").'" > </td>';
            $rowD = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/D.png").'" > </td>';
         //   $rowE = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/E.png").'" > </td>';
         //   $rowF = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/F.png").'" > </td>';
         //   $rowG = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/G.png").'" > </td>';

        }
        elseif ($class == 'B') {
            $rowB = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/BY.png").'" > </td>';
            $rowAA = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/AA.png").'" > </td>';
            $rowA = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/A.png").'" > </td>';
            $rowC = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/C.png").'" > </td>';
            $rowD = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/D.png").'" > </td>';
         //   $rowE = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/E.png").'" > </td>';
         //   $rowF = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/F.png").'" > </td>';
         //   $rowG = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/G.png").'" > </td>';

        }
        elseif ($class == 'C') {
            $rowC = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/CY.png").'" > </td>';
            $rowAA = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/AA.png").'" > </td>';
            $rowA = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/A.png").'" > </td>';
            $rowB = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/B.png").'" > </td>';
            $rowD = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/D.png").'" > </td>';
            $rowE = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/E.png").'" > </td>';
         //   $rowF = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/F.png").'" > </td>';
         //   $rowG = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/G.png").'" > </td>';

        }
        elseif ($class == 'D') {
            $rowD = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/DY.png").'" > </td>';
            $rowAA = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/AA.png").'" > </td>';
            $rowA = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/A.png").'" > </td>';
            $rowB = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/B.png").'" > </td>';
            $rowC = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/C.png").'" > </td>';
            $rowE = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/E.png").'" > </td>';
            $rowF = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/F.png").'" > </td>';
        //    $rowG = '<td> <img width="auto" height="40px" src="'.UtilSingleton::getInstance()->InlinePicture("assets/classifications/G.png").'" > </td>';
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
            $savingText1 = 'if you lower your average water consumption by <b style="color:rgb(239,162,112)">'. round($savingVolume)  .' liter</b>';
            $savingText2 = 'if you shorten your showertime by <b style="color:rgb(239,162,112)">'. round($savingTime) .' seconds</b>';
            $savingText3 = 'if you lower your average water consumption by <b style="color:rgb(239,162,112)">'. round($savingVolume / 2) .' liter</b>
                            <br/><b>&nbsp;   &nbsp;  and</b> shorten your showertime by <b  style="color:rgb(239,162,112)">'. round($savingTime / 2) .' seconds</b>';

            $goal = '

        <tr>
            <td align="left" style="padding-left: 68px;">
                <img width="200px" src="'.UtilSingleton::getInstance()->InlinePicture("pictures/volumeSavingChart.png").'"/>
            </td>
        </tr>

        <tr>
            <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px; padding-left: 15px;">
            <b>You can reach the next better efficiency class...</b>
            </td>
        </tr>
        <tr>
           <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">

              <lu>
                   <li>'. $savingText1 .'</li>
                   <li>'. $savingText2 .'</li>
                   <li>'. $savingText3 .'</li>
              </lu>
            </td>
        </tr>

            ';

        }
        else
        {
            $goal = '
            <tr>
                <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px; padding-left: 15px;">
                <b>You are awesome!</b>
                </td>
            </tr>
                            ';
        }

        return $this->GetHtml($extractionUserCount,$energy,$class,$rowAA,$rowA,$rowB,$rowC,$rowD,$rowE,$rowF,$rowG,$goal);
    }

    private function GetHtml($extractionUserCount,$energy,$class,$rowAA,$rowA,$rowB,$rowC,$rowD,$rowE,$rowF,$rowG,$goal)
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

        <table cellpadding="0" cellspacing="0" width="400" style="padding-left: 20px;">

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

        <table cellpadding="0" cellspacing="0" width="400">

        '. $goal .'

        </table>

        </td>
    </tr>

    <tr>
        <td>&nbsp;<br/></td>
    </tr>

</table>

<br/>
';
    }

}


