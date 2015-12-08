<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 08/12/15
 * Time: 14:33
 */
class HtmlClassification
{
    public function GetHtmlClassification()
    {
        $db = DBAccessSingleton::getInstance();
        $name = $db->username;
        //$message = SingletonMessage::Instance();
        //$cid = $message->embed(Swift_Image::fromPath('pictures/test.png'));

        $class = 'b';
        $aa = '&nbsp;';
        $a = '&nbsp;';
        $b = '&nbsp;';
        $c = '&nbsp;';
        $d = '&nbsp;';
        $e = '&nbsp;';
        $f = '&nbsp;';
        $g = '&nbsp;';


        if ($class == 'aa') {
            $aa = 'Your here';
        }
        if ($class == 'a') {
            $a = 'Your here';
        }
        if ($class == 'b') {
            $b = 'Your here';
        }
        if ($class == 'c') {
            $c = 'Your here';
        }
        if ($class == 'd') {
            $d = 'Your here';
        }
        if ($class == 'e') {
            $e = 'Your here';
        }
        if ($class == 'f') {
            $f = 'Your here';
        }
        if ($class == 'g') {
            $g = 'Your here';
        }


        return

            '
<table cellpadding="0" cellspacing="0">
    <tr>
        <td class="pattern" width="500" align="center">

  <table cellpadding="0" cellspacing="0" style="width: 500px" >
    <tr>
       <td class="headline" align="left" style="font-family: arial,sans-serif; font-size: 22px; color: #333; padding-top: 10px;">
       efficiency clustering
       </td>
    </tr>
    <tr>
     <td rowspan="8" width="250px"> <img width="200px" src="assets/eklasse.png" > </td>
     <td align="left"> ' . $aa . '  </td>
    </tr>
    <tr>
        <td> ' . $a . '</td>

    </tr>
    <tr>
        <td>' . $b . '</td>

    </tr>
    <tr>
        <td>' . $c . '</td>

    </tr>
    <tr>
        <td>' . $d . '</td>
    </tr>
    <tr>
    <td>' . $e . '</td>
    </tr>
    <tr>
    <td>' . $f . '</td>
    </tr>
    <tr>
    <td>' . $g . '</td>
    </tr>
</table>
</td>
 <td class="col" width="290" valign="top">
                        <table cellpadding="0" cellspacing="0">

                            <tr>
                                <td class="headline" align="left" style="font-family: arial,sans-serif; font-size: 22px; color: #333; padding-top: 15px;">
                                    Infos
                                </td>
                            </tr>
                            <tr>
                                <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
                                   More infos
                                    </td>
                            </tr>
                            <tr>
                                <td > <a class="buttonshare" href="https://www.google.de"> Share your efficiency </a>  </td>
                            </tr>
                            <tr>
                                <td align="left" style="padding-top: 15px;"><img src="http://placehold.it/118x34/333&text=Learn+More" alt="Learn More" style="display: block; border: 0;" /></td>
                            </tr>

                              <tr>
                                <td class="headline" align="left" style="font-family: arial,sans-serif; font-size: 22px; color: #333; padding-top: 15px;">
                                    Gamification
                                </td>
                            </tr>
                            <tr>
                                <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
                                   More infos gamification
                                    </td>
                            </tr>
                            <tr>
                                <td > <a class="buttonshare" href="https://www.google.de"> Here is the badge</a>  </td>
                            </tr>
                            <tr>
                                <td align="left" style="padding-top: 15px;"><img src="http://placehold.it/118x34/333&text=Learn+More" alt="Learn More" style="display: block; border: 0;" /></td>
                            </tr>

                        </table>
                    </td>
</tr>
</table>
<hr>';
    }
}


