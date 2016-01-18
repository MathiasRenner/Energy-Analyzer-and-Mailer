<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 08/12/15
 * Time: 14:33
 */

/**
 * Class HtmlTimeComp
 *
 * creates the comparison over time feature
 */
class HtmlTimeComp
{

    public function GetHtmlTimeComp()
    {
        return '
<table class=section cellpadding="0" cellspacing="0">
    <tr>
        <td class="pattern" width="800" align="center">
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <td class="col" width="800" valign="top">
                        <table id="timecomp" cellpadding="0" cellspacing="0" >
                            <tr>
                                <td class="headline" align="left" style="font-family: arial,sans-serif; font-size: 22px; color: #333; padding-top: 15px;">
                                    See the consumption of your last 30 showers
                                </td>
                            </tr>
                            <tr>
                                <td class="hero_image"><img src="'.UtilSingleton::getInstance()->InlinePicture("pictures/timeCompChart.png").'" width="720" alt="" align="center" style="display: block; border: 0; padding-top: 10px;" /></td>
                            </tr>
                            <tr>
                                <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
                                With 100 Wh you can work on your notebook for 5 hours.
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


