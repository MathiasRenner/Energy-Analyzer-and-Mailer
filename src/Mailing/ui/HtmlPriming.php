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
        $db = DBAccessSingleton::getInstance();

        // feature say something big
        if($db->extractionsCountUser >= 200)
        {
            $energyConsumption = round(array_sum($db->energyUser) / 1000,1);
            $textConsumption = 'With your last <b>200</b> showers you have consumed <b>' . $energyConsumption .'</b> kWh energy. ';
        }
        else
        {
            $energyConsumption = (array_sum($db->energyUser) / count($db->energyUser)) * 200 / 1000;
            $textConsumption = "You have uploaded ". $db->extractionsCountUser ." showers. When you have showered <b>200</b> times you will have consumed <b>" . round($energyConsumption,1) ."</b> kWh energy. ";
        }

        $textConsEqual = 'This energy usage corresponds to the annual energy consumption of ';
        if($energyConsumption > 0 && $energyConsumption < 165)
        {
            $textConsEqual = $textConsEqual . '<b>2 laptops</b>.';
        }
        elseif($energyConsumption >= 165 && $energyConsumption < 240)
        {
            $textConsEqual = $textConsEqual . '<b>1 washing machine</b>.';
        }
        elseif($energyConsumption >= 240 && $energyConsumption < 330)
        {
            $textConsEqual = $textConsEqual . '<b>1 fridge</b>.';
        }
        elseif($energyConsumption >= 330 && $energyConsumption < 460)
        {
            $textConsEqual = $textConsEqual . '<b>3 laptops</b>.';
        }
        elseif($energyConsumption >= 460)
        {
            $textConsEqual = $textConsEqual . '<b>'. round($energyConsumption/350,1) . ' times your energy usage for lighting</b>.';
        }

        // if the user has not given a name take the mail address
        if(strlen($db->firstname) == 0)
        {
            $name = $db->email;
        }
        else
        {
            $name = $db->firstname;
        }

        return $this->GetHtml($name,$textConsumption,$textConsEqual);
    }

    private function GetHtml($name,$textConsumption,$textConsEqual)
    {
        return
'<table class=section cellpadding="0" cellspacing="0">
    <tr>
        <td  width="800" align="center">
            <table cellpadding="0" cellspacing="0">
                <tr>
                <td width="800" align="center" valign="top">
                    <table cellpadding="0" cellspacing="0">
                    <tr>
                    <td> <a class="hero_image"><a href="http://amphiro.com/"><img src="'. UtilSingleton::getInstance()->InlinePicture("assets/badges/logo.png") .'" width="200" alt="" style="display: block; border: 0;" /> </a>
                    </td>
                    <td>
                        <img src="'. UtilSingleton::getInstance()->InlinePicture("assets/badges/_baer.png") .'" height="40" width="auto" alt="" style="display: block; border: 0;" />
                    </td>
                    <td align="left" style="font-family: arial,sans-serif; font-size: 13px; line-height: 17px !important; color: #7f7f7f; padding-top: 5px;">
                       Together we can <br/><b>save</b> his world!
                    </td>
                    </tr>
                    </table>
                </td>
                </tr>

                <tr>
                <td  class="headline" width="800" align="center" style="font-family: arial,sans-serif; font-size: 22px; color: #333; padding-top: 15px; padding-bottom: 20px; ">
                Your personal Amphiro report
                <br>
                </td>
                </tr>

                <tr>
                <td   width="800" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px; padding-left: 30px; padding-right: 30px;">
                Hello <b>' . $name . '</b>, <br/>
                <br>
                We are pleased to provide you your <b>personal</b> report. We want to help you to reduce your energy.
                With this report we provide you:


                </td>
                </tr>

                <tr>
                <td  width="800" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px; padding-left: 50px; padding-right: 50px;">

                <lu>
                   <li><strong>your energy consumption compared to our customers</strong></li>
                   <li><strong>personal energy saving tips</strong></li>
                   <li><strong>your energy saving progress</strong></li>
                </lu>
                </td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td width="800" align="left" style="font-family: arial,sans-serif; font-size: 17px; line-height: 20px !important; color: #7f7f7f; padding-top: 20px; padding-left: 30px; padding-right: 30px;" >
            '. $textConsumption . $textConsEqual .'
        </td>
    </tr>
</table>

<br/>';
    }
}



