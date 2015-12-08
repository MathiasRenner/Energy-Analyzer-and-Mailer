<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 25/11/15
 * Time: 17:56
 */
//include "CreateCharts.php";
include_once "libs/swiftmailer/lib/swift_required.php";

class CreateHtmlMail
{
    /**
     * @param $cid
     * @return string
     */
    public function CreateHTMLMailing()
    {
        // Example code for accessing db values
        //$db = DBAccessSingleton::getInstance(9);
        //echo $test = $db->address;
        //echo $db->username;

        // If placing the embed() code inline becomes cumbersome
        // it's easy to do this in two steps
        //$message = SingletonMessage::Instance();
        //$cid = $message->embed(Swift_Image::fromPath('pictures/test.png'));

        $style = $this->GetStyle();
        $priming = $this->GetPriming();
        $classification = $this->GetClassification();
        $descinjunctive = $this->GetDescInj();
        $time = $this->GetTimeComparison();
        $recommendations = $this->GetRecommendations();
        $dummytext = $this->GetDummyHtml();

        return $dummytext;
       // return $style .''. $priming .''. $descinjunctive  .''. $classification . '' . $time . '' . $recommendations;
        //return  $priming .''. $descinjunctive  .''. $classification . '' . $time . '' . $recommendations;
        //. '' . $dummytext;


    }

    public function GetCss()
    {
        return $this->GetStyle();
    }

    private function GetRecommendations()
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
                                    Let\'s take action! These are your personal tips of how you can improve:
                                </td>
                            </tr>
                            <tr>
                               <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
                               <ul>
                               <li>
                                    <b>Invest less time in showering! You probably have more important things to do!</b><br />
                                    Your exposition to a constant stream of water is much higher compared to others. A shorter shower duration also means much water conservation.
                                </li>
                                </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
                                 <ul>
                                 <li>
                                   <b>Hold on! Do you need water during shampooing?</b><br />
                                   Stop the water when putting soap on your skin. Better take some seconds and give your body a little massage rather than letting the soap immediately rubbing down again.
                                </li>
                                </ul>
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

    private function GetTimeComparison()
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

    private function GetPriming()
    {
    //    $db = DBAccessSingleton::getInstance();
        //$name = 'MAX'; // $db->username;
        //$message = SingletonMessage::Instance();
        //$cid = $message->embed(Swift_Image::fromPath('pictures/test.png'));


        return include("priming.php");
    }

    private function GetClassification()
    {

        $db = DBAccessSingleton::getInstance();
        $name = $db->username;


        $class = 'b';
        $aa = '&nbsp;';
        $a = '&nbsp;';
        $b = '&nbsp;';
        $c = '&nbsp;';
        $d = '&nbsp;';
        $e = '&nbsp;';
        $f = '&nbsp;';
        $g = '&nbsp;';


        if($class == 'aa')
        {
            $aa = 'Your here';
        }
        if($class == 'a')
        {
            $a = 'Your here';
        }
        if($class == 'b')
        {
            $b = 'Your here';
        }
        if($class == 'c')
        {
            $c = 'Your here';
        }
        if($class == 'd')
        {
            $d = 'Your here';
        }
        if($class == 'e')
        {
            $e = 'Your here';
        }
        if($class == 'f')
        {
            $f = 'Your here';
        }
        if($class == 'g')
        {
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
     <td align="left"> '. $aa . '  </td>
    </tr>
    <tr>
        <td> '. $a . '</td>

    </tr>
    <tr>
        <td>'. $b . '</td>

    </tr>
    <tr>
        <td>'. $c . '</td>

    </tr>
    <tr>
        <td>'. $d . '</td>
    </tr>
    <tr>
    <td>'. $e . '</td>
    </tr>
    <tr>
    <td>'. $f . '</td>
    </tr>
    <tr>
    <td>'. $g . '</td>
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
                        </table>
                    </td>
</tr>
</table>
<hr>';
    }

    private function GetStyle()
    {
       return

           '<style>
    /* First Section (Header), 1 Column */
	@media only screen and (max-width: 599px) {
        td[class="hero1"] img {
            width: 100%;
            height: auto !important;
        }
	    td[class="pattern1"] td{
	        width: 100%;
	    }
	}

	/* Middle Section, 2 Columns */
	@media only screen and (max-width: 599px) {
        td[class="pattern2"] table { width: 100%; }
        td[class="pattern2"] .hero_image img {
            width: 100%;
            height: auto !important;
        }
	}
    @media only screen and (max-width: 450px) {
        td[class="pattern2"] .spacer { display: none; }
        td[class="pattern2"] .col{
            width: 100%;
            display: block;
        }
        td[class="pattern2"] .col:first-child { margin-bottom: 30px; }
        td[class="pattern2"] .hero_image img { width: 100%; }
    }

     .buttonshare {
        display: block;
        width: 150px;
        height: 20px;
        background: #4E9CAF;
        padding: 10px;
        text-align: center;
        border-radius: 5px;
        color: white;
        font-weight: bold;
        }

    </style>
    ';


    }

    private function GetDescInj()
    {

        //$db = DBAccessSingleton::getInstance();
        //$name = $db->username;
        //$message = SingletonMessage::Instance();
        //$cid = $message->embed(Swift_Image::fromPath('pictures/test.png'));



        return '
<table cellpadding="0" cellspacing="0">
    <tr>
        <td class="pattern" width="800" align="center">
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <td class="col" width="600" valign="top">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="headline" align="left" style="font-family: arial,sans-serif; font-size: 22px; color: #333; padding-top: 15px;">
                                    Desc Heading
                                </td>
                            </tr>
                            <tr>
                                <td class="hero_image"><img src="assets/desc.png" width="600" alt="" style="display: block; border: 0;" /></td>
                            </tr>
                            <tr>
                                <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
                                Genauerer beschreibung desc
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td class="spacer" width="20" style="font-size: 1px;">&nbsp;</td>
                    <td class="col" width="190" valign="top">
                      <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="headline" align="left" style="font-family: arial,sans-serif; font-size: 22px; color: #333; padding-top: 15px;">
                                   Inj heading
                                </td>
                            </tr>
                            <tr>
                                <td class="hero_image"><img src="assets/injunctive.png" width="190" alt="" style="display: block; border: 0;" /></td>
                            </tr>
                            <tr>
                                <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
                                Genauerer beschreibung des smileys
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

    private function GetDummyHtml()
    {
        return '
<html>

<head>

<style>

  .buttonshare {
        display: block;
        width: 150px;
        height: 20px;
        background: #4E9CAF;
        padding: 10px;
        text-align: center;
        border-radius: 5px;
        color: white;
        font-weight: bold;
        }


</style>
</head>

<body>
<table cellpadding="0" cellspacing="0">
    <tr>
        <td class="pattern" width="600" align="center">
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <td class="col" width="290" valign="top">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="hero_image"><img src="http://placehold.it/450x150" width="290" alt="" style="display: block; border: 0;" /></td>
                            </tr>
                            <tr>
                                <td class="headline" align="left" style="font-family: arial,sans-serif; font-size: 22px; color: #333; padding-top: 15px;">
                                  <a class="buttonshare" href="www.google.de">butttttoooon</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
                                    Virtual computing via the cloud is all the rage these days but blade servers, which make up the bulk of the infrastructure for cloud computing systems, require specific fusing for high reliability and uptime. The Littelfuse 456 Series--- NANO2 Subminature Surface Mount Fuse - is perfect for this.
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="padding-top: 15px;"><img src="http://placehold.it/118x34/333&text=Learn+More" alt="Learn More" style="display: block; border: 0;" /></td>
                            </tr>
                        </table>
                    </td>
                    <td class="spacer" width="20" style="font-size: 1px;">&nbsp;</td>
                    <td class="col" width="290" valign="top">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="hero_image"><img src="http://placehold.it/450x150" width="290" alt="" style="display: block; border: 0;" /></td>
                            </tr>
                            <tr>
                                <td class="headline" align="left" style="font-family: arial,sans-serif; font-size: 22px; color: #333; padding-top: 15px;">
                                    This is a story headline
                                </td>
                            </tr>
                            <tr>
                                <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #7f7f7f; padding-top: 10px;">
                                    Virtual computing via the cloud is all the rage these days but blade servers, which make up the bulk of the infrastructure for cloud computing systems, require specific fusing for high reliability and uptime. The Littelfuse 456 Series--- NANO2 Subminature Surface Mount Fuse - is perfect for this.
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="padding-top: 15px;"><img src="http://placehold.it/118x34/333&text=Learn+More" alt="Learn More" style="display: block; border: 0;" /></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<table cellpadding="0" cellspacing="0">
    <tr>
        <td class="pattern1" width="600">
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <td class="hero1">
                        <img src="http://placehold.it/600x200&text=Hero+Image" alt="" style="display: block; border: 0;" />
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-family: arial,sans-serif; color: #333;">
                        <h1>Header Text</h1>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #666; padding-bottom: 20px;">
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa. Sed eleifend nonummy diam. Praesent mauris ante, elementum et, bibendum at, posuere sit amet, nibh. Duis tincidunt lectus quis dui viverra vestibulum. Suspendisse vulputate aliquam dui. Nulla elementum dui ut augue. Aliquam vehicula mi at mauris. Maecenas placerat, nisl at consequat rhoncus, sem nunc gravida justo, quis eleifend arcu velit quis lacus. Morbi magna magna, tincidunt a, mattis non, imperdiet vitae, tellus. Sed odio est, auctor ac, sollicitudin in, consequat vitae, orci. Fusce id felis. Vivamus sollicitudin metus eget eros.
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        <a href="#"><img src="http://placehold.it/200x50/333&text=CTA+»" alt="CTA" style="display: block; border: 0;" /></a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
';
    }
}