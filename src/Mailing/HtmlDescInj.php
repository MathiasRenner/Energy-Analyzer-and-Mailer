<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 08/12/15
 * Time: 14:33
 */
class HtmlDescInj
{

    public function GetHtmlDescInj()
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
                    <td class="col" width="600" valign="top">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="headline" align="left" style="font-family: arial,sans-serif; font-size: 22px; color: #333; padding-top: 15px;">
                                    Desc Heading
                                </td>
                            </tr>
                            <tr>
                                <td class="hero_image"><img src="pictures/descChart.png" width="500" alt="" style="display: block; border: 0;" /></td>
                            </tr>
                            <tr>
                                <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
                                Genauerer beschreibung desc
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td class="spacer" width="20" style="font-size: 1px;">&nbsp;</td>
                    <td class="col" width="190" valign="top">
                      <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="headline" align="left" style="font-family: arial,sans-serif; font-size: 22px; color: #333; padding-top: 15px;">
                                   Inj heading
                                </td>
                            </tr>
                            <tr>
                                <td class="hero_image"><img src="pictures/injBelow.png.png" width="190" alt="" style="display: block; border: 0;" /></td>
                            </tr>
                            <tr>
                                <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
                                Genauerer beschreibung des smileys
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


