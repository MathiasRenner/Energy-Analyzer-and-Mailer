<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 08/12/15
 * Time: 14:33
 */
class HtmlTimeComp
{

    public function GetHtmlTimeComp()
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
                                    Time Heading
                                </td>
                            </tr>
                            <tr>
                                <td class="hero_image"><img src="assets/time.png" width="800" alt="" style="display: block; border: 0;" /></td>
                            </tr>
                            <tr>
                                <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
                                Genauerer beschreibung desc
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


