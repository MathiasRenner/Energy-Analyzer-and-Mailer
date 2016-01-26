<?php

/**
 * Class HtmlDescInj
 *
 * Creates the Descriptive and Injunctive feature
 */
class HtmlDescInj
{

    public function GetHtmlDescInj()
    {
        // calc all the needed energy consumptions
        $calc = new Calculations();
        $avgUser = $calc->CalcEnergyUser();
        $avgAll = $calc->CalcEnergyAllUser();
        $avgTop20 = $calc->CalcEnergyTopTwentyPercentUsers();

        // descriptive text for lowest / average / highest consumption
        if($avgUser <= $avgTop20)
        {
            $inj = '<td align="left" class="hero_image"><img src="'.UtilSingleton::getInstance()->InlinePicture("assets/injunctive/inj1.png").'" width="50%" alt="" style="display: block; border: 0;" /></td>';
            $descText = "You are one of the Top 20% user. That's great!<br/>Do not stop being an energy saver";
        }
        elseif($avgUser <= $avgAll)
        {
            $inj = '<td align="left" class="hero_image"><img src="'.UtilSingleton::getInstance()->InlinePicture("assets/injunctive/inj2.png").'" width="45%" alt="" style="display: block; border: 0;" /></td>';
            $descText = "Your average energy consumption for your last showers was above the average.<br/>Well done!";
        }
        else
        {
            $inj = '<td align="left" class="hero_image"><img src="'.UtilSingleton::getInstance()->InlinePicture("assets/injunctive/inj3.png").'" width="52%" alt="" style="display: block; border: 0;" /></td>';
            $descText = "Your average energy consumption for your last showers was below the average.<br/>You are good, but we know you can do better!";
        }

        return '
<table class=section cellpadding="0" cellspacing="0">
    <tr>
        <td width="800" valign="top">
        <table cellpadding="0" cellspacing="0">
        <tr>
               <td class="headline" colspan="2" class="headline" align="center" style="font-family: arial,sans-serif; font-size: 22px; color: #7f7f7f;  padding-top: 10px;">
               How are you doing compared to all amphiro users?
               </td>
        </tr>

        <tr>
        <td>
        <table id="descInj" cellpadding="0" cellspacing="0">
           <tr>
           <td width="600" valign="top">
               <table>
               <tr>
               <td>
               &nbsp; <br/>
               </td>
               </tr>
               <tr>
                   <td class="hero_image"><img src="'.UtilSingleton::getInstance()->InlinePicture("pictures/descChart.png").'" width="500" alt="" style="display: block; border: 0;"> </td>
               </tr>

               <tr>
                   <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
                   '. $descText .'
                   </td>
               </tr>
               </table>
           </td>

           <td class="spacer" width="20" style="font-size: 1px;">&nbsp;
           </td>

           <td width="200" valign="top" align="center">

               <table cellpadding="0" cellspacing="0">
               <tr>
                    <td class="headline" align="left" style="font-family: arial,sans-serif; font-size: 22px; color: #333; padding-top: 15px;">
                    &nbsp;
                    </td>
               </tr>
               <tr>
               '. $inj .'
               </tr>
               </table>
           </td>
        </tr>
        </table>
        </td>

        </tr>
        </table>
        </td>
    </tr>
</table>

<br/>
';
    }
}


