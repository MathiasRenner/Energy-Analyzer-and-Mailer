<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 08/12/15
 * Time: 14:33
 */

/**
 * Class HtmlFooter
 * creates the footer
 */
class HtmlFooter
{
    public function GetHtmlFooter()
    {
        return
'<table cellpadding="3" cellspacing="3" bgcolor="white">
    <tr>
      <td class="body_copy" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;" width="800" align="center">
      Follow us on:
      </td>
    </tr>
    <tr>
        <td  width="800" align="center">
        <a href="https://twitter.com/amphiroag"><img height="25" width="25" src="'.UtilSingleton::getInstance()->InlinePicture("assets/footer/twitter.png").'"></a>
        <a href="https://plus.google.com/101220642639072243787"><img height="25" width="25" src="'.UtilSingleton::getInstance()->InlinePicture("assets/footer/gplus.png").'"></a>
        <a href="https://www.youtube.com/channel/UC4FJ_KyDmXu4TCGk5Tl33QA"><img height="25" width="25" src="'.UtilSingleton::getInstance()->InlinePicture("assets/footer/youtube.png").'"></a>
        </td>
    </tr>
    <tr>
      <td class="body_copy" width="800" align="center" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;" >
        You can unsubscribe from this report <a href="http://www.example.com">here</a>.
        </td>
    </tr>
</table>
';

    }
}



