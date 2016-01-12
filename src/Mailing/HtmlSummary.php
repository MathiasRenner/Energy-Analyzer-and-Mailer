<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 08/12/15
 * Time: 14:33
 */

class HtmlSummary
{
    public function GetHtmlSummary()
    {
        //$message = SingletonMessage::Instance();
        //$cid = $message->embed(Swift_Image::fromPath('assets/priming_eisbaer.png'));

        // getting all the information we have
        $db = DBAccessSingleton::getInstance();
        $uploads = $db->extractionUserCount;

        // calculate all the averages
        $calc = new Calculations();
        $volume = $calc->CalcVolumeAvgUser(TRUE);
        $flowRate = $calc->CalcUserFlowRate(TRUE);
        $temperature = $calc->CalcUserTemperature(TRUE);
        $time = $calc->CalcUserTime(TRUE);

        return
'<table cellpadding="3" cellspacing="3" width="800" bgcolor="white">
       <tr>
            <td colspan="4" class="headline" align="center" style="font-family: arial,sans-serif; font-size: 22px; color: #333; padding-top: 15px;">
            In a nutshell
            </td>
        </tr>

     <tr>

      <td width="160" valign="center" align="center" class="body_copy" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
      <img width="40" src="assets/overview/pvolume.png">
      </td>

      <td width="160" valign="center" align="center" class="body_copy" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
      <img width="40" src="assets/overview/ptime.png">
      </td>

      <td width="160" valign="center" align="center" class="body_copy" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
      <img width="40" src="assets/overview/pflow.png">
      </td>

      <td width="160" valign="center" align="center" class="body_copy" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
      <img width="50" src="assets/overview/ptemp.png">
      </td>

<!--
      <td width="160" valign="center" align="center" class="body_copy" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
      <img width="40" src="assets/overview/pupload_2.png">
      </td>
-->

    </tr>

    <tr>

      <td width="160" valign="center" align="center" class="body_copy" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
      &empty; '. $volume .' liter
      </td>

      <td width="160" valign="center" align="center" class="body_copy" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
      &empty; '. $time .' min
      </td>

      <td width="160" valign="center" align="center" class="body_copy" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
      &empty; '. $flowRate .' liter/min
      </td>

      <td width="160" valign="center" align="center" class="body_copy" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
      &empty; '. $temperature .' C&deg;
      </td>

<!--
      <td width="160" valign="center" align="center" class="body_copy" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
      '. $uploads .' uploads
      </td>
-->

    </tr>
</table>
';

    }
}



