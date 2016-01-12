<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 25/11/15
 * Time: 17:44
 */

/* pChart library inclusions */
include("libs/charts/pChart2_1_4/class/pData.class.php");
include("libs/charts/pChart2_1_4/class/pDraw.class.php");
include("libs/charts/pChart2_1_4/class/pImage.class.php");
//include("libs/charts/pChart2_1_4/class/pCache.class.php");


class CreateCharts
{
    public function __construct(){
       }

    public function CreateAllCharts()
    {
        //$this->CreateDummyChart();
        $this->CreateDescChart();
        $this->CreateTimeCompChart();
    }

    public function CreateDescChart()
    {
        $calculations = new Calculations();

        $energy_user = $calculations->CalcEnergyUsageUser();
        $energy_all = $calculations->CalcEnergyUsageAllUser();
        $energy_top20 = $calculations->CalcEnergyUsageTopTwentyPercentUser();

        //$font1 = "libs/charts/pChart2_1_4/fonts/calibri.ttf";
        $font2 = "libs/charts/pChart2_1_4/fonts/verdana.ttf";

        //Farbschema
        $color_top20 = array("R"=>11,"G"=>71,"B"=>101,"Alpha"=>100);
        $color_average = array("R"=>48,"G"=>107,"B"=>136,"Alpha"=>100);
        $color_user = array("R"=>95,"G"=>142,"B"=>164,"Alpha"=>100);

        $myDescData = new pData();
        //$myDescData->setAxisName(0,"consumption in wH");

        // Fallunterscheidung: Anordnung der Balken
        if($energy_user < $energy_top20){

            $descValuesArray = array($energy_user, $energy_top20, $energy_all );
            $myDescData-> addPoints($descValuesArray, "Compare yourself!");
            $myDescData->addPoints(array("You ", "Top 20% ", "Average "),"Labels");

            $Palette = array(   "0"=> $color_user,
                                "1"=> $color_top20,
                                "2"=> $color_average);

        }elseif($energy_user > $energy_top20 & $energy_user < $energy_all){

            $descValuesArray = array($energy_top20,$energy_user, $energy_all );
            $myDescData-> addPoints($descValuesArray, "Compare yourself!");
            $myDescData->addPoints(array("Top 20% ","You ", "Average "),"Labels");

            $Palette = array(   "0"=>$color_top20,
                                "1"=>$color_user,
                                "2"=>$color_average);

        }elseif($energy_user > $energy_all){

            $descValuesArray = array($energy_top20, $energy_all, $energy_user);
            $myDescData-> addPoints($descValuesArray, "Compare yourself!");
            $myDescData->addPoints(array("Top 20% ", "Average ","You " ),"Labels");

            $Palette = array(   "0"=>$color_top20,
                                "1"=>$color_average,
                                "2"=>$color_user);
        }

        // TODO besser darstellen und i
        if($energy_top20 >= 2000 || $energy_all >= 2000 || $energy_user >= 2000)
        {
            $minDivHeight = 100;
        }
        else
        {
            $minDivHeight = 60;
        }

        $myDescData->setAbscissa("Labels");
        // Ein image Objekt erzeugen, um $myDescData zu visualisieren
        $myDescChart = new pImage(1000, 600, $myDescData);
        // Hier ggf. die Schriftart und Größe ändern
        $myDescChart->setFontProperties(array("FontName"=>$font2,"FontSize"=>21,"R"=>80,"G"=>80,"B"=>80));
        // Die Daten-Area in der Grafik muss kleiner sein, als die Grafik selbst
        $myDescChart->setGraphArea(140,70, 920, 550);
        // Horizontale und vertikale Skalierung (in diesem Fall ohne Parameter = Standard)
        $myDescChart->drawScale(array('XAxisTitleMargin'=>10,"MinDivHeight"=>$minDivHeight,
            "CycleBackground"=>FALSE,"DrawSubTicks"=>FALSE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridAlpha"=>1,
            "Pos"=>SCALE_POS_TOPBOTTOM,
            // start from zero
            "Mode" => SCALE_MODE_START0));

        $myDescChart->drawText(550,27,"consumption in wH",array("FontSize"=>20,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));

        // Chart erzeugen
        $myDescChart->drawBarChart(array("DisplayValues"=>TRUE,"Surrounding"=>30,"OverrideColors"=>$Palette));
        // Bilddatei ausgeben
        $myDescChart->render("pictures/descChart.png");
    }

    public function CreateTimeCompChart()
    {
        $db = DBAccessSingleton::getInstance();
        $usern = $db->username;
        $userExtractions = $db-> energyUser;

        $font2 = "libs/charts/pChart2_1_4/fonts/verdana.ttf";

        /* Create and populate the pData object */
        $MyData = new pData();
        $MyData->addPoints(array_slice($userExtractions,-30,30),$usern);

        $serieSettings = array("R"=>66,"G"=>106,"B"=>131);
        $MyData->setPalette($usern,$serieSettings);

        $MyData->setSerieWeight($usern, 1);

        //Einheit "Wh" anzeigen
        $MyData->setAxisUnit(0,"Wh");

        $MyData->setAxisName(0,"");
        //TODO: x-Achsenbezeichnung an Daten anpassen
        //$MyData->addPoints(range(-30,-1),"Labels");
        //$MyData->setSerieDescription("Labels","Months");
        //$MyData->setAbscissa("Labels");

        /* Create the pChart object */
        $myPicture = new pImage(700,230,$MyData);

        /* Turn of Antialiasing */
        $myPicture->Antialias = FALSE;


        /* Set the default font */
        $myPicture->setFontProperties(array("FontName"=>$font2,"FontSize"=>9,"R"=>0,"G"=>0,"B"=>0));

        /* Define the chart area */
        //$myPicture->setGraphArea(60,40,650,200);
        $myPicture->setGraphArea(60,30,680,200);

        //$myPicture->drawText(40,20,"Wh");

        /* Draw the scale */
        $scaleSettings = array("XMargin"=>10,"YMargin"=>10,"Floating"=>TRUE,"GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE);
        //$myPicture->drawScale($scaleSettings);
        $AxisBoundaries = array(0=>array("Min"=>0,"Max"=>max(array_slice($userExtractions,-30,30))));
        $myPicture->drawScale(array("InnerTickWidth"=>-1,"OuterTickWidth"=>5,"TickR"=>255,"TickG"=>255,"TickB"=>255,"Mode"=>SCALE_MODE_MANUAL,"ManualScale"=>$AxisBoundaries,"LabelRotation"=>45,"DrawXLines"=>FALSE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridTicks"=>0,"GridAlpha"=>30,"AxisAlpha"=>0));

        /* Enable shadow computing */
        $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

        /* Draw the line chart
        $myPicture->drawLineChart(array("DisplayColor"=>DISPLAY_MANUAL));
        $myPicture->drawPlotChart(array("DisplayValues"=>TRUE,"PlotBorder"=>TRUE,"BorderSize"=>2,"Surrounding"=>-60,"BorderAlpha"=>80));
        */

        $myPicture->drawBarChart();
        /* Write the chart legend */
        // legend is just the email of the user, which is already  shown in the header of the mailing
        //$myPicture->drawLegend(590,9,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL,"FontR"=>255,"FontG"=>255,"FontB"=>255));

        $RectangleSettings = array("R"=>255,"G"=>255,"B"=>255);
        $myPicture->drawFilledRectangle(61,201,720,230,$RectangleSettings);
        /* Render the picture (choose the best way) */
        $myPicture->render("pictures/timeCompChart.png");


    }
}