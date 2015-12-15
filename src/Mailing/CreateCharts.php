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
        $db = DBAccessSingleton::getInstance();
        $usern = $db->username;

        $calculations = new Calculations();

        $energy_user = $calculations->CalcEnergyUsageUser();
        $energy_all = $calculations->CalcEnergyUsageAllUser();
        $energy_top20 = $calculations->CalcEnergyUsageTopTwentyPercentUser();

        //$font1 = "libs/charts/pChart2_1_4/fonts/calibri.ttf";
        $font2 = "libs/charts/pChart2_1_4/fonts/calibri.ttf";

        //Farbschema
        $color_top20 = array("R"=>11,"G"=>71,"B"=>101,"Alpha"=>100);
        $color_average = array("R"=>48,"G"=>107,"B"=>136,"Alpha"=>100);
        $color_user = array("R"=>95,"G"=>142,"B"=>164,"Alpha"=>100);

        $myDescData = new pData();

        // Fallunterscheidung: Anordnung der Balken
        if($energy_user < $energy_top20){

            $descValuesArray = array($energy_user, $energy_top20, $energy_all );
            $myDescData-> addPoints($descValuesArray, "Compare yourself!");
            $myDescData->addPoints(array("You", "Top 20%", "Average"),"Labels");

            $Palette = array(   "0"=> $color_user,
                                "1"=> $color_top20,
                                "2"=> $color_average);

        }elseif($energy_user > $energy_top20 & $energy_user < $energy_all){

            $descValuesArray = array($energy_top20,$energy_user, $energy_all );
            $myDescData-> addPoints($descValuesArray, "Compare yourself!");
            $myDescData->addPoints(array("Top 20%","You", "Average"),"Labels");

            $Palette = array(   "0"=>$color_top20,
                                "1"=>$color_user,
                                "2"=>$color_average);

        }elseif($energy_user > $energy_all){

            $descValuesArray = array($energy_top20, $energy_all, $energy_user);
            $myDescData-> addPoints($descValuesArray, "Compare yourself!");
            $myDescData->addPoints(array("Top 20%", "Average","You" ),"Labels");

            $Palette = array(   "0"=>$color_top20,
                                "1"=>$color_average,
                                "2"=>$color_user);
        }

        $myDescData->setAbscissa("Labels");
        // Ein image Objekt erzeugen, um $myDescData zu visualisieren
        $myDescChart = new pImage(500, 300, $myDescData);
        // Hier ggf. die Schriftart und Größe ändern
        $myDescChart->setFontProperties(array("FontName"=>$font2,"FontSize"=>11,"R"=>80,"G"=>80,"B"=>80));
        // Die Daten-Area in der Grafik muss kleiner sein, als die Grafik selbst
        $myDescChart->setGraphArea(70,35, 475, 275);
        // Horizontale und vertikale Skalierung (in diesem Fall ohne Parameter = Standard)
        $myDescChart->drawScale(array("CycleBackground"=>TRUE,"DrawSubTicks"=>TRUE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridAlpha"=>10, "Pos"=>SCALE_POS_TOPBOTTOM));
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

        $font2 = "libs/charts/pChart2_1_4/fonts/calibri.ttf";

        /* Create and populate the pData object */
        $MyData = new pData();
        $MyData->addPoints($userExtractions,$usern);

        $serieSettings = array("R"=>66,"G"=>106,"B"=>131);
        $MyData->setPalette($usern,$serieSettings);

        $MyData->setSerieWeight($usern, 1);
        //$MyData->setSerieTicks("Probe 2",4);
        $MyData->setAxisName(0,"");
        //TODO: x-Achsenbezeichnung an Daten anpassen
        $MyData->addPoints(range(1,10),"Labels");
        //$MyData->setSerieDescription("Labels","Months");
        $MyData->setAbscissa("Labels");

        /* Create the pChart object */
        $myPicture = new pImage(700,230,$MyData);

        /* Turn of Antialiasing */
        $myPicture->Antialias = TRUE;

        /* Draw the background */
        $Settings = array("R"=>150, "G"=>169, "B"=>180, "Dash"=>0, "DashR"=>36, "DashG"=>81, "DashB"=>107);
        $myPicture->drawFilledRectangle(0,0,700,230,$Settings);

        /* Overlay with a gradient */
        //$Settings = array("StartR"=>219, "StartG"=>231, "StartB"=>139, "EndR"=>1, "EndG"=>138, "EndB"=>68, "Alpha"=>50);
        //$myPicture->drawGradientArea(0,0,700,230,DIRECTION_VERTICAL,$Settings);
        //$myPicture->drawGradientArea(0,0,700,20,DIRECTION_VERTICAL,array("StartR"=>0,"StartG"=>0,"StartB"=>0,"EndR"=>50,"EndG"=>50,"EndB"=>50,"Alpha"=>80));

        /* Add a border to the picture */
        $myPicture->drawRectangle(0,0,699,229,array("R"=>0,"G"=>0,"B"=>0));

        /* Write the chart title */
        $myPicture->setFontProperties(array("FontName"=>$font2,"FontSize"=>8,"R"=>255,"G"=>255,"B"=>255));
        $myPicture->drawText(10,16,"Energy Consumption per Shower",array("FontSize"=>13,"Align"=>TEXT_ALIGN_BOTTOMLEFT));

        /* Set the default font */
        $myPicture->setFontProperties(array("FontName"=>$font2,"FontSize"=>11,"R"=>0,"G"=>0,"B"=>0));

        /* Define the chart area */
        $myPicture->setGraphArea(60,40,650,200);

        /* Draw the scale */
        $scaleSettings = array("XMargin"=>10,"YMargin"=>10,"Floating"=>TRUE,"GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE);
        $myPicture->drawScale($scaleSettings);

        /* Turn on Antialiasing */
        $myPicture->Antialias = TRUE;

        /* Enable shadow computing */
        $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

        /* Draw the line chart */
        $myPicture->drawLineChart(array("DisplayColor"=>DISPLAY_MANUAL));
        $myPicture->drawPlotChart(array("DisplayValues"=>TRUE,"PlotBorder"=>TRUE,"BorderSize"=>2,"Surrounding"=>-60,"BorderAlpha"=>80));

        /* Write the chart legend */
        $myPicture->drawLegend(590,9,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL,"FontR"=>255,"FontG"=>255,"FontB"=>255));

        /* Render the picture (choose the best way) */
        $myPicture->render("pictures/timeCompChart.png");


    }


    private function CreateDummyChart() {

        $db = DBAccessSingleton::getInstance();
        $usern = $db->username;
        
        $MyData = new pData();
        $MyData->addPoints(array(13251,4118,3087,1460,1248,156,26,9,8),"Hits");
        $MyData->setAxisName(0,"Hits");
        $MyData->addPoints(array("Firefox","Chrome","Internet Explorer","Opera","Safari","Mozilla","SeaMonkey","Camino","Lunascape"),"Browsers");
        $MyData->setSerieDescription("Browsers","Browsers");
        $MyData->setAbscissa("Browsers");
        $MyData->setAbscissaName("Browsers");

        /* Create the pChart object */
        $myPicture = new pImage(500,500,$MyData);
        $myPicture->drawGradientArea(0,0,500,500,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100));
        $myPicture->drawGradientArea(0,0,500,500,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20));
        $myPicture->setFontProperties(array("FontName"=>"libs/charts/pChart2_1_4/fonts/pf_arma_five.ttf","FontSize"=>6));

        /* Draw the chart scale */
        $myPicture->setGraphArea(100,30,480,480);
        $myPicture->drawScale(array("CycleBackground"=>TRUE,"DrawSubTicks"=>TRUE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridAlpha"=>10,"Pos"=>SCALE_POS_TOPBOTTOM));

        /* Turn on shadow computing */
        $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

        /* Create the per bar palette */
        $Palette = array("0"=>array("R"=>188,"G"=>224,"B"=>46,"Alpha"=>100),
            "1"=>array("R"=>224,"G"=>100,"B"=>46,"Alpha"=>100),
            "2"=>array("R"=>224,"G"=>214,"B"=>46,"Alpha"=>100),
            "3"=>array("R"=>46,"G"=>151,"B"=>224,"Alpha"=>100),
            "4"=>array("R"=>176,"G"=>46,"B"=>224,"Alpha"=>100),
            "5"=>array("R"=>224,"G"=>46,"B"=>117,"Alpha"=>100),
            "6"=>array("R"=>92,"G"=>224,"B"=>46,"Alpha"=>100),
            "7"=>array("R"=>224,"G"=>176,"B"=>46,"Alpha"=>100));

        /* Draw the chart */
        $myPicture->drawBarChart(array("DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>TRUE,"Rounded"=>TRUE,"Surrounding"=>30,"OverrideColors"=>$Palette));

        /* Write the legend */
        $myPicture->drawLegend(570,215,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));

        /* Render the picture (choose the best way) */
        //$myPicture->autoOutput("pictures/test.png");
        $myPicture->render("pictures/test.png");
    }
}