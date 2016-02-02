<?php

/**
 * Class HtmlRecommendations
 *
 * creates the recommendation feature
 * which shows recommendations of how user can improve savings
 * according to his data
 */
class HtmlRecommendations
{
    public function GetHtmlRecommendations()
    {
        // fill an array with recommendations according to the user's behaviour
        $calc = new Calculations();

        // initiate array
        $array = array();


        // calculate shower time
        $calcAllUserTime = $calc->CalcAllUserTime();
        $calcUserTime = $calc->CalcUserTime();

        // compare shower time
        if ($calcUserTime > $calcAllUserTime) {
            $textReduceTime = "<b>Invest less time in showering!</b><br />Your showertime is high compared to others.";
            array_push($array, $textReduceTime);
        }


        // calculate flow rate
        $avgflowRate = $calc->CalcFlowRateAllUser();
        $UserflowRate = $calc->CalcFlowRateUser(TRUE);

        // compare flow rate
        if ($UserflowRate > $avgflowRate) {
            $textReduceWater = "<b>Turn on the tap only half way!</b><br />Compared to others, you have a high flow rate.";
            array_push($array, $textReduceWater);
        }


        // calculate number of showers
        $AvgNumberOfShowers = $calc->CalcAvgNumberOfShowers();
        $UserAvgNumberOfShowers = UtilSingleton::GetExtractionUserCount(TRUE);

        // compare number of showers
        if ($UserAvgNumberOfShowers > $AvgNumberOfShowers) {
            $textReduceFrequency = "<b>Don't take a shower too often!</b><br />You take showers more ofthen than others.";
            array_push($array, $textReduceFrequency);
        }


        // instanciate global variable for beeing accessible
        $textReduceShampooing = '<b>Stop water during shampooing!</b><br />Take a short break rather than letting the soap immediately rubbing down again.';
        // analysing shower breaks is not yet available from the data, show randomly instead
        if (round(rand(0, 1))) {
            array_push($array, $textReduceShampooing);
        }


        // if data say that no recommendations are necessary, show at least one recommendation
        if (count($array) - 1 == 0) {
            array_push($array, $textReduceShampooing);
        }

        // create array that contains all recommendations
        $recommendationArray = array();

        // build HTML for all user specific recommendations from the array
        foreach ($array as $item)
        {

        //for ($i = 1; $i <= count($array) - 1; $i++) {
            $recommendation = '
                        <ul>
                            <li>
                                '.  $item . '
                            </li>
                        </ul>
            ';
            array_push($recommendationArray, $recommendation);
        }

        // define recommendation variable and assign only if the recommendation exists to avoid warnings
        $rec1 = "";$rec2 = "";$rec3 = "";$rec4 = "";
        if(count($recommendationArray) > 0)
        {
            $rec1 = $recommendationArray[0];
        }
        if(count($recommendationArray) > 1)
        {
            $rec2 = $recommendationArray[1];
        }
        if(count($recommendationArray) > 2)
        {
            $rec3 = $recommendationArray[2];
        }
        if(count($recommendationArray) > 3)
        {
            $rec4 = $recommendationArray[3];
        }


        return '
            <table class=section cellpadding="0" cellspacing="0" >
                <tr>
                    <td class="headline" width="800" colspan="2" style="font-family: arial,sans-serif; font-size: 22px; color: #7f7f7f; padding-top: 10px;">
                    Personal tips how you can improve
                    </td>
                </tr>

                <tr>
                    <td width="400" height="50" valign="top" class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-left: 20px;"> ' .  $rec1 . '  </td>
                     <td class="body_copy" align="left" valign="top" height="50" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-left: 20px;"> ' . $rec2 . ' </td>
                </tr>

                <tr>
                      <td width="50" class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-left: 20px;"> ' . $rec3 . ' </td>
                      <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-left: 20px;"> ' . $rec4. '</td>
                </tr>

            </table>
            <br/>
        ';
    }
}
