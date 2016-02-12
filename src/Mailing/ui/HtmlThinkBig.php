<?php

/**
 * Class HtmlThinkBig
 *
 * crates the thinkbig feature
 * to say something big at the beginning
 */
class HtmlThinkBig
{
    public function GetHtmlThinkBig()
    {
        // feature say something big
        $db = DBAccessSingleton::getInstance();
        $extractionUserCount = $db->getExtractionsCountUser();

        if($extractionUserCount >= 200)
        {
            $energyConsumption = round(array_sum(array_slice($db->getEnergyUser(),200*(-1),200))); /// 1000;
            $diff = "is";
        }
        else
        {
            $energyConsumption = round(array_sum(array_slice($db->getEnergyUser(),$extractionUserCount *(-1),$extractionUserCount))
                    / count(array_slice($db->getEnergyUser(),$extractionUserCount*(-1),$extractionUserCount))) * 200; //(200 / 1000);
            $diff = "will be";
        }

        $consHomeOffice = round($energyConsumption / 80000,1); // 150 = Homeoffice | 80 = notebook
        $consWashingMachine = round($energyConsumption / 250000,1);;
        $consLightning = round($energyConsumption / 500000,1);
        //$consHouseHold = round($energyConsumption / 3500,2) * 100;

        $textConsumption = 'Your energy consumption <br/>after <b>200</b> showers ' . $diff;
        $textConsumptionVar = 'This amount of energy corresponds to the <b>annual</b> energy consumption of <br/> &nbsp;';

        $energyConsumption = number_format($energyConsumption,0,",",".");

        return
'
<table class=section cellpadding="3" cellspacing="3" width="820" bgcolor="white">
       <tr>
            <td  width="160" valign="center" align="center" class="body_copy" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px; ;">
             '.$textConsumption.'
            </td>
            <td colspan="3" valign="center" align="center" class="body_copy" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;  ">
             '.$textConsumptionVar.'
            </td>
        </tr>

    <tr>

      <td valign="center" align="center" class="body_copy" style="font-family: arial,sans-serif; font-size: 35px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
      '.$energyConsumption.' Wh
      </td>

      <td width="160" valign="center" align="center" class="body_copy" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
      <img width="40" src="'.UtilSingleton::getInstance()->InlinePicture("assets/thinkbig/tb_nb.png").'">
      </td>

      <td width="160" valign="center" align="center" class="body_copy" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
      <img width="40" src="'.UtilSingleton::getInstance()->InlinePicture("assets/thinkbig/tb_wm.png").'">
      </td>

      <td width="160" valign="center" align="center" class="body_copy" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
      <img width="40" src="'.UtilSingleton::getInstance()->InlinePicture("assets/thinkbig/tb_light.png").'">
      </td>

    </tr>

    <tr>

      <td width="160" valign="center" align="center" class="body_copy" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
       <b></b>
      </td>

      <td width="160" valign="center" align="center" class="body_copy" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
       <b>'. $consHomeOffice .'</b><br/> notebooks
      </td>

      <td width="160" valign="center" align="center" class="body_copy" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
      <b>'. $consWashingMachine .'</b><br/> washing machines
      </td>

      <td width="160" valign="center" align="center" class="body_copy" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
      <b>'. $consLightning .'</b><br/> domestic lighting
      </td>

    </tr>
</table>
<br/>';
    }
}



