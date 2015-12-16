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

        $message = SingletonMessage::Instance();
        $cid = $message->embed(Swift_Image::fromPath('assets/eklasse.png'));

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
        echo '<hr>';


        $aa = '&nbsp;';
        $a = '&nbsp;';
        $b = '&nbsp;';
        $c = '&nbsp;';
        $d = '&nbsp;';
        $e = '&nbsp;';
        $f = '&nbsp;';
        $g = '&nbsp;';


        if ($class == 'aa') {
            $aa = '<h2>You&apos;re here</h2>';
        }
        if ($class == 'a') {
            $a = '<h2>You&apos;re here</h2>';
        }
        if ($class == 'b') {
            $b = '<h2>You&apos;re here</h2>';
        }
        if ($class == 'c') {
            $c = '<h2>You&apos;re here</h2>';
        }
        if ($class == 'd') {
            $d = '<h2>You&apos;re here</h2>';
        }
        if ($class == 'e') {
            $e = '<h2>You&apos;re here</h2>';
        }
        if ($class == 'f') {
            $f = '<h2>You&apos;re here</h2>';
        }
        if ($class == 'g') {
            $g = '<h2>You&apos;re here</h2>';
        }

        // feature twitter
        $ttext = 'Let\'s+save+the+planet!+My+efficiency+class+for+the+last+showers+were+' . strtoupper($class) . '+with+' . $energy . '+Wh+per+shower!';
        $twittertext = 'https://twitter.com/intent/tweet?url=http%3A%2F%2Famphiro.com&text='. $ttext .'&via=AmphiroAG';



        return

            '
<table cellpadding="0" cellspacing="0">
    <tr>
        <td class="pattern" width="500" align="center">

  <table class="content-shadow" cellpadding="0" cellspacing="0" width="500">
    <tr>
       <td class="headline" align="left" style="font-family: arial,sans-serif; font-size: 22px; color: #333; padding-top: 10px;">
       Your position on the efficiency scale
       </td>
    </tr>
    <tr>
     <!-- <td rowspan="8" width="250px"> <img width="200px" src="assets/eklasse.png" > </td> -->

     <td rowspan="8" width="250px"> <img width="200px" src="'.$cid.'"> </td>
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
                                    Share your achievement!
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
                                    Your wall of badges
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


