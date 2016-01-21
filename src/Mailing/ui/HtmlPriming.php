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
        $extractionUserCount = $db->getExtractionsCountUser();

        if($extractionUserCount >= 200)
        {
            $energyConsumption = round(array_sum(array_slice($db->getEnergyUser(),200*(-1),200))) / 1000;
            $diff = "is";
        }
        else
        {
            $energyConsumption = round(array_sum(array_slice($db->getEnergyUser(),$extractionUserCount *(-1),$extractionUserCount))
            / count(array_slice($db->getEnergyUser(),$extractionUserCount*(-1),$extractionUserCount))) * (200 / 1000);
            $diff = "will be";
        }

        $consHomeOffice = round($energyConsumption / 150,1);
        $consWashingMaschine = round($energyConsumption / 250,1);;
        $consLightning = round($energyConsumption / 500,1);

        $textConsumption = '<b>'.$energyConsumption. ' kWh!</b> This '. $diff .' your energy consumption with <b>200</b> showers!
        <br/>This energy consumption corresponds to the <b>annual</b> energy consumption of';
        $textConsumptionComp = '
            <lu>
            <li><b>'.$consHomeOffice.'</b> laptops</li>
            <li><b>'.$consWashingMaschine.'</b> wasching machines</li>
            <li><b>'.$consLightning.'</b> times lightning a household</li>
            </lu>
        ';


        // if the user has not given a name take the mail address
        if(strlen($db->getFirstname()) == 0)
        {
            $name = $db->getEmail();
        }
        else
        {
            $name = $db->getFirstname();
        }

        return $this->GetHtml($name,$textConsumption, $textConsumptionComp);
    }

    private function GetHtml($name,$textConsumption, $textConsumptionComp)
    {
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
                Your personal amphiro report
                <br>
                </td>
                </tr>

                <tr>
                <td   width="800" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px; padding-left: 30px; padding-right: 30px;">
                Hello <b>' . $name . '</b>, <br/>
                <br>
                We are pleased to provide you your <b>personal</b> amphiro report.
                <br/>
                We provide you information about...

                </td>
                </tr>

                <tr>
                <td  width="800" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px; padding-left: 50px; padding-right: 50px;">

                <lu>
                   <li><strong>your energy consumption compared to our other customers</strong></li>
                   <li><strong>your energy saving performance</strong></li>
                   <li><strong>personal energy saving tips</strong></li>
                </lu>
                </td>
                </tr>

                <tr>
                <td  width="800" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px; padding-left: 30px; padding-right: 30px;">
                ...so you can even save more energy!
                </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<br/>

<table class=section cellpadding="0" cellspacing="0">
    <tr>
        <td width="800" align="left" style="font-family: arial,sans-serif; font-size: 15px; line-height: 20px !important; color: #7f7f7f; padding-top: 20px; padding-left: 30px; padding-right: 30px;" >
            '. $textConsumption .'
        </td>
    </tr>
    <tr>
     <td width="800" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 20px; padding-left: 50px; padding-right: 50px;">
        '. $textConsumptionComp .'
    </td>
    </tr>
</table>

<br/>';
    }
}



