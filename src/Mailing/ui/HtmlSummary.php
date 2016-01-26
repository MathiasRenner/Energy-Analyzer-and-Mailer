<?php

/**
 * Class HtmlSummary
 *
 * creates the summary
 */
class HtmlSummary
{
    public function GetHtmlSummary()
    {
        // get all the averages for the summary
        $calc = new Calculations();
        $volume = $calc->CalcVolumeAvgUser(TRUE);
        $flowRate = $calc->CalcFlowRateUser(TRUE);
        $temperature = $calc->CalcUserTemperature(TRUE);
        $time = $calc->CalcUserTime(TRUE);

        return $this->GetHtml($volume, $flowRate, $temperature, $time);
    }

    private function GetHtml($volume, $flowRate, $temperature, $time)
    {
        return
            '
<table class=section cellpadding="3" cellspacing="3" width="820" bgcolor="white">
       <tr>
            <td colspan="4" class="headline" align="center" style="font-family: arial,sans-serif; font-size: 22px; color: #7f7f7f; padding-top: 10px;">
            Your average shower
            </td>
        </tr>

    <tr>

      <td width="160" valign="center" align="center" class="body_copy" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
      <img width="40" src="'.UtilSingleton::getInstance()->InlinePicture("assets/overview/pvolume.png").'">
      </td>

      <td width="160" valign="center" align="center" class="body_copy" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
      <img width="40" src="'.UtilSingleton::getInstance()->InlinePicture("assets/overview/ptime.png").'">
      </td>

      <td width="160" valign="center" align="center" class="body_copy" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
      <img width="40" src="'.UtilSingleton::getInstance()->InlinePicture("assets/overview/pflow.png").'">
      </td>

      <td width="160" valign="center" align="center" class="body_copy" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
      <img width="40" src="'.UtilSingleton::getInstance()->InlinePicture("assets/overview/ptemp.png").'">
      </td>

    </tr>

    <tr>

      <td width="160" valign="center" align="center" class="body_copy" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
       <b> '. $volume .' liter </b>
      </td>

      <td width="160" valign="center" align="center" class="body_copy" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
       <b> '. $time .' min </b>
      </td>

      <td width="160" valign="center" align="center" class="body_copy" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
      <b>  '. $flowRate .' liter/min </b>
      </td>

      <td width="160" valign="center" align="center" class="body_copy" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
      <b>  '. $temperature .' C&deg; </b>
      </td>

    </tr>
</table>

<br/>
';
    }
}



