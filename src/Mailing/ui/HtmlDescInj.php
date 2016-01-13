<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 08/12/15
 * Time: 14:33
 */

/**
 * Class HtmlDescInj
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
            $inj = '<td align="center" class="hero_image"><img src="'.UtilSingleton::getInstance()->InlinePicture("assets/injunctive/inj1.png").'" width="50%" alt="" style="display: block; border: 0;" /></td>';
            $injtext = "Nice work! You are great, but do not stop being an environment saver!";
            if($avgUser <= $avgTop20)
            {
                $descText = "You are one of the Top 20% user. That's great!";
            }
            else
            {
                $descText = "Your average energy consumption for your last shower was near the Top 20% user. That's great!";
            }
        }
        elseif($avgUser <= $avgAll)
        {
            $inj = '<td align="center" class="hero_image"><img src="'.UtilSingleton::getInstance()->InlinePicture("assets/injunctive/inj2.png").'" width="50%" alt="" style="display: block; border: 0;" /></td>';
            $injtext = "Nice work! You are good, but do not stop being an water saver!";
            $descText = "Your average energy consumption for your last shower was above the average. That's good!";
        }
        else
        {
            $inj = '<td align="center" class="hero_image"><img src="'.UtilSingleton::getInstance()->InlinePicture("assets/injunctive/inj3.png").'" width="50%" alt="" style="display: block; border: 0;" /></td>';
            $injtext = "You are good, but we know you can do better!";
            $descText = "Your average energy consumption for your last shower was below the average.";
        }

        return $this->GetHtml($descText,$inj,$injtext);
    }

    private function GetHtml($descText,$inj,$injtext)
    {
        return '
<table cellpadding="0" cellspacing="0">
    <tr>
        <td width="800" valign="top">
        <table cellpadding="0" cellspacing="0">
        <tr>
               <td colspan="2" class="headline" align="center" style="font-family: arial,sans-serif; font-size: 22px; color: #333; padding-top: 15px;">
               How are you doing compared to all Amphiro users?
               </td>
        </tr>

        <tr>
        <td>
        <table cellpadding="0" cellspacing="0">
           <tr>
           <td width="500" valign="top">
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
                   We compared you with all Amphio users. '. $descText .'
                   </td>
               </tr>
               </table>
           </td>

           <td class="spacer" width="20" style="font-size: 1px;">&nbsp;
           </td>

           <td width="253" valign="top" align="center">

               <table cellpadding="0" cellspacing="0">
               <tr>
                    <td class="headline" align="left" style="font-family: arial,sans-serif; font-size: 22px; color: #333; padding-top: 15px;">
                    &nbsp;
                    </td>
               </tr>
               <tr>
               '. $inj .'
               </tr>
               <tr>
               <td>
                 &nbsp;
               </td>
               </tr>
               <tr>
                   <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
                   '. $injtext .'
                   </td>
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


