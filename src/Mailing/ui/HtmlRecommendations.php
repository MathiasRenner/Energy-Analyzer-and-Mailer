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
        $array = array("");


        // calculate shower time
        $calcAllUserTime = $calc->CalcAllUserTime();
        $calcUserTime = $calc->CalcUserTime();

        // compare shower time
        if ($calcUserTime > $calcAllUserTime) {
            $textReduceTime = "<b>Invest less time in showering! You probably have more important things to do!</b><br />Your exposition to a constant stream of water is much higher compared to others. A shorter shower duration also means much water conservation.";
            array_push($array, $textReduceTime);
        }


        // calculate flow rate
        $avgflowRate = $calc->CalcFlowRateAllUser();
        $UserflowRate = $calc->CalcFlowRateUser(TRUE);

        // compare flow rate
        if ($UserflowRate > $avgflowRate) {
            $textReduceWater = "<b>Turning on the tap only half way - for the sake for the environment! (+ special tip!)</b><br />Showering accounts for about 25% of total water consumption in a household. A lower flow rate saves reasonable a amount of water and takes you in control on conservating the most valuable resource for life of our planet. Special tip: Investing in a water efficient shower head makes this goal as easy as it gets!";
            array_push($array, $textReduceWater);
        }


        // calculate number of showers
        $AvgNumberOfShowers = $calc->CalcAvgNumberOfShowers();
        $UserAvgNumberOfShowers = UtilSingleton::GetExtractionUserCount(TRUE);

        // compare number of showers
        if ($UserAvgNumberOfShowers > $AvgNumberOfShowers) {
            $textReduceFrequency = "<b>Don't take a shower too often. It can have negative impacts on your health!</b><br />Resource consumption in terms of heat energy generates large amounts of CO2 at the power plant generating this heat. If you do not exaggerate in taking showers, you can have strong impacts on conservating CO2 and reduce polluting the air, which you breath every other second.";
            array_push($array, $textReduceFrequency);
        }

        // instanciate global variable for beeing accessible
        $textReduceShampooing = '<b>Hold on! Do you need water during shampooing?</b><br />Stop the water when putting soap on your skin. Better take some seconds and give your body a little massage rather than letting the soap immediately rubbing down again.';
        // analysing shower breaks is not yet available from the data, show randomly instead
        if (round(rand(0, 1))) {
            array_push($array, $textReduceShampooing);
        }


        // if data say that no recommendations are necessary, show at least one recommendation
        if (count($array) - 1 == 0) {
            array_push($array, $textReduceShampooing);
        }


        // instanciate global variable for beeing accessible
        $recommendations = "";

        // build HTML for all user specific recommendations from the array
        for ($i = 1; $i <= count($array) - 1; $i++) {
            $recommendations .= '
                <tr>
                    <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; ">
                        <ul>
                            <li>
                                ' . $array[$i] . '
                            </li>
                        </ul>
                    </td>
                </tr>
            ';
        }

        return $this->GetHtml($recommendations);
    }

    // creates all HTML output for all recommendations
    private function GetHtml($recommendations)
    {
        return '
            <table class=section cellpadding="0" cellspacing="0">
                <tr>
                    <td class="pattern" width="800" align="center">
                        <table id="recommendations" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="col" width="800" valign="top">
                                    <table cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td class="headline" align="left" style="font-family: arial,sans-serif; font-size: 22px; color: #333; padding-top: 15px;">
                                                Personal tips how you can improve
                                            </td>
                                        </tr>
                                            <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
                                                When we had a look at your data, we figured out that you can save most if you follow these recommendations: <br />
                                            </td>
                                        </tr>
                                        ' . $recommendations . '
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
