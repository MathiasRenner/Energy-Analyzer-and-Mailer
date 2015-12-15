<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 08/12/15
 * Time: 14:33
 */
class HtmlRecommendations
{

    public function GetHtmlRecommendations()
    {
        $db = DBAccessSingleton::getInstance();
        $name = $db->username;
        //$message = SingletonMessage::Instance();
        //$cid = $message->embed(Swift_Image::fromPath('pictures/test.png'));

        return '

<table cellpadding="0" cellspacing="0">
    <tr>
        <td class="pattern" width="800" align="center">
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <td class="col" width="800" valign="top">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="headline" align="left" style="font-family: arial,sans-serif; font-size: 22px; color: #333; padding-top: 15px;">
                                    Let\'s take action! These are your personal tips of how you can improve:
                                </td>
                            </tr>
                            <tr>
                               <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
                               <ul>
                               <li>
                                    <b>Invest less time in showering! You probably have more important things to do!</b><br />
                                    Your exposition to a constant stream of water is much higher compared to others. A shorter shower duration also means much water conservation.
                                </li>
                                </ul>
                                </td>
                            </tr>
                            <tr>
                               <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
                               <ul>
                               <li>
                                    <b>Turning on the tap only half way - for the sake for the environment! (+ special tip!)</b><br />
                                    Showering accounts for about 25% of total water consumption in a household. A lower flow rate saves reasonable a amount of water and takes you in control on conservating the most valuable resource for life of our planet. Special tip: Investing in a water efficient shower head makes this goal as easy as it gets!
                                </li>
                                </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
                                 <ul>
                                 <li>
                                   <b>Hold on! Do you need water during shampooing?</b><br />
                                   Stop the water when putting soap on your skin. Better take some seconds and give your body a little massage rather than letting the soap immediately rubbing down again.
                                </li>
                                </ul>
                                </td>
                            </tr>
                            <tr>
                               <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
                               <ul>
                               <li>
                                    <b>Don\'t take a shower too often. It can have negative impacts on your health!</b><br />
                                    Resource consumption in terms of heat energy generates large amounts of CO2 at the power plant generating this heat. If you do not exaggerate in taking showers, you can have strong impacts on conservating CO2 and reduce polluting the air, which you breath every other second.
                                </li>
                                </ul>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<hr>
';
    }
}


