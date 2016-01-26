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
                    <td class="headline" width="800" style="font-family: arial,sans-serif; font-size: 22px; color: #7f7f7f; padding-top: 10px;">
                    Personal tips how you can improve
                    </td>
                </tr>
                </tr>
                <td> </td>
                <td> </td>
                ' . $recommendations . '
                </tr>
                <tr>
                <td> </td>
                <td> </td>
                </tr>
            </table>
            <br/>
        ';
    }
}
