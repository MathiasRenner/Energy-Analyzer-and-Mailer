<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 08/12/15
 * Time: 14:33
 */

class HtmlPriming
{
    public function GetHtmlPriming()
    {
        $db = DBAccessSingleton::getInstance();

        $message = SingletonMessage::Instance();
        $cid = $message->embed(Swift_Image::fromPath('assets/priming_eisbaer.png'));

        if($db->extractionUserCount >= 200)
        {
            $energyConsumption = round(array_sum($db->energyUser) / 1000,1);
            $textConsumption = 'With your last <b>200</b> showers you have consumed <b>' . $energyConsumption .'</b> kWh energy. ';
        }
        else
        {
            $energyConsumption = (array_sum($db->energyUser) / count($db->energyUser)) * 200 / 1000;
            $textConsumption = "With your predicted <b>200</b> showers you will consume <b>" . round($energyConsumption,1) ."</b> kWh energy. ";
        }


        $textConsEqual = 'Your energy usage corresponds to the annual energy consumption of ';
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
            $textConsEqual = $textConsEqual . '<b>2 laptops</b>.';
        }
        elseif($energyConsumption >= 460)
        {
            $textConsEqual = $textConsEqual . '<b>'. round($energyConsumption/350,1) . ' times your energy usage for lighting</b>.';
        }

        return

'<table cellpadding="0" cellspacing="0">
    <tr>
        <td  width="800" align="center">
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <td class="col" width="200" valign="top">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <a class="hero_image"><a href="http://amphiro.com/"><img src="assets/logo.png" width="200" alt="" style="display: block; border: 0;" /> </a></td>
                            </tr>
                        </table>
                    </td>
                    <td class="spacer" width="20" style="font-size: 1px;">&nbsp;</td>
                    <td class="col" width="600" valign="top">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="400" class="headline" align="left" style="font-family: arial,sans-serif; font-size: 22px; color: #333; padding-top: 15px;">
                                    Together we are can save his world!
                                </td>
                                <td align="center" width="200" class="hero_image"><img src="assets/badges/_baer.png" height="40" width="auto" alt="" style="display: block; border: 0;" />
                                </td>
                            </tr>
                            <tr><td colspan="2" ><br/></td></tr>
                            <tr>
                                <td width="400" class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
                                    Hallo ' . $db->firstname .'! <br/>
                                    We are pleased to provide you your <b>personal</b> report. We want to help you to reduce your energy consumption.
                                    <br/>
                                    With this report we provide you:
                                    <lu>
                                        <li><strong>your energy consumption compared to our customers</strong></li>
                                        <li><strong>personal energy saving tips</strong></li>
                                        <li><strong>your energy saving progress</strong></li>
                                    </lu>
                                </td>
                                <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px; padding-left: 10px" width="200">

                                Our greatest customer<br/>
                                '. $db->firstname . '  '. $db->familyname .' <br/>
                                '. $db->email .' <br/>
                                '. $db->address.' <br/>
                                '. $db->city .' <br/>
                                <br/>
                                <br/>
                                </td>
                            </tr>

                         </table>
                    </td>
                </tr>
            </table>
        </td>
     </tr>
       <tr>
        <td width="800" align="left" class="body_copy" style="font-family: arial,sans-serif; font-size: 17px; line-height: 20px !important; color: #7f7f7f; padding-top: 20px; padding-left: 5px" >
            '. $textConsumption . $textConsEqual .'
        </td>
    </tr>
</table>
<br/>';

    }
}



