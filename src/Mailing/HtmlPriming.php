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
        $name = $db->username;
        $message = SingletonMessage::Instance();
        $cid = $message->embed(Swift_Image::fromPath('pictures/test.png'));

        $calc = new Calculations();

        $eClass = $calc->GetEfficiencyClass($calc->CalcEnergyUsageUser());
        if($eClass == 'a')
        {
            // take this picture
        }
        elseif($eClass == 'c')
        {
            // take that other picture
        }

        return

            '<table cellpadding="0" cellspacing="0">
    <tr>
        <td class="pattern" width="800" align="center">
            <table class="content-shadow" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="col" width="200" valign="top">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="hero_image"><img src="assets/priming_eisbaer.png" width="200" alt="" style="display: block; border: 0;" /></td>
                            </tr>

                        </table>
                    </td>
                    <td class="spacer" width="20" style="font-size: 1px;">&nbsp;</td>
                    <td class="col" width="400" valign="top">
                        <table cellpadding="0" cellspacing="0">

                            <tr>
                                <td class="headline" align="left" style="font-family: arial,sans-serif; font-size: 22px; color: #333; padding-top: 15px;">
                                    Together we are can save his world!
                                    <hr/>
                                </td>
                            </tr>
                            <tr>
                                <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
                                    Hallo ' .  $name .' </br>
                                    We are pleased to provide you this personal report to help reduce energy consumption.
                                    </br/>
                                    The purpose of this report is to:
                                    <lu>
                                        <li><strong>provide information</strong></li>
                                        <li><strong>help to track your progress</strong></li>
                                        <li><strong>share energy saving tips</strong></li>
                                    </lu>
                                </td>
                            </tr>
                         </table>
                    </td>

                    <td class="spacer" width="20" style="font-size: 1px;">&nbsp;</td>

                    <td class="col" width="200" valign="top">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="hero_image">

                                <img src="assets/logo.png" width="200" alt="" style="display: block; border: 0;" />

                                &nbsp;
                                <hr/>
                                '. $db->email .' <br/>
                                '. $db->firstname . '  '. $db->familyname .' <br/>
                                '. $db->address.' <br/>
                                '. $db->city .' <br/>

                               <!-- link auf amphiro oder einer anderen health care seite -->

                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<hr>';

    }
}



