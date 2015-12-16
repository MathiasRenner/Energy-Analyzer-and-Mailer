<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 08/12/15
 * Time: 14:33
 */

require "Calculations.php";

class HtmlClassification
{
    public function GetHtmlClassification()
    {

        // feature badge
        $db = DBAccessSingleton::getInstance();
        $aryReportedOn = $db->extractionsUserReportedOn;
        $aryUniqueReportOn = array_unique($aryReportedOn);
        $reportCount = count($aryUniqueReportOn);
        // select the right badge

        // feature classification
        $calc = new Calculations();
        $energy = $calc->CalcEnergyUsageUser();
        $class =  $calc->GetEfficiencyClass($energy);

        echo $energy;
        echo $class;

        $energyAll = $calc->CalcEnergyUsageAllUser();
        $classAll = $calc->GetEfficiencyClass($energyAll);

        echo '<hr>';
        echo $energyAll;
        echo $classAll;

        $energytw = $calc->CalcEnergyUsageTopTwentyPercentUser();
        $classtw = $calc->GetEfficiencyClass($energytw);

        echo '<hr>';
        echo $energytw;
        echo $classtw;


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

        // feature twitter
        $ttext = 'Let\'s+save+the+planet!+My+efficiency+class+for+the+last+showers+were+' . strtoupper($class) . '+with+' . $energy . '+Wh+per+shower!';
        $twittertext = 'https://twitter.com/intent/tweet?url=http%3A%2F%2Famphiro.com&text='. $ttext .'&via=AmphiroAG';



        return

            '
<table cellpadding="0" cellspacing="0">
    <tr>
        <td class="pattern" width="500" align="center">

  <table class="content-shadow" cellpadding="0" cellspacing="0" style="width: 500px" >
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
                        <table class="content-shadow" cellpadding="0" cellspacing="0">

                            <tr>
                                <td class="headline" align="left" style="font-family: arial,sans-serif; font-size: 22px; color: #333; padding-top: 15px;">
                                    Infos
                                </td>
                            </tr>
                            <tr>
                                <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
                                   Your average efficiency-class for the last 10 <br/> showers were <b>'. strtoupper($class) .' </b> with <b>'. $energy .' </b>  Wh per shower!
                                    </td>
                            </tr>
                            <tr>
                                <td > <a class="buttonshare" href="' . $twittertext . '"> Share your efficiency </a>  </td>
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
                                   Upload more data via the app to get more badges!
                                    </td>
                            </tr>
                            <tr>
                                <td > <a style="display: block;
    width: 150px;
    height: 50px;
    background: #4E9CAF;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    color: white;
    font-weight: bold;"> You have uploaded your data '. $reportCount . ' times!</a>  </td>
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


