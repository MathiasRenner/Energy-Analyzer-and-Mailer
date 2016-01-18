<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 25/11/15
 * Time: 17:44
 */


/**
 * Class CreateCharts
 *
 * all functions for the chart creations
 */
class CreateCharts
{
    /**
     * CreateCharts constructor.
     */
    public function __construct(){}

    /**
     * Wrapper to create all charts
     */
    public function CreateAllCharts()
    {
        $this->CreateDescChart();
        $this->CreateTimeCompChart();
    }

    /**
     * Creates the chart for the descriptive feature
     */
    public function CreateDescChart()
    {
        $calculations = new Calculations();

        $energy_user = $calculations->CalcEnergyUser();
        $energy_all = $calculations->CalcEnergyAllUser();
        $energy_top20 = $calculations->CalcEnergyTopTwentyPercentUsers();

        $font2 = "libs/charts/pChart2_1_4/fonts/verdana.ttf";

        // define the color
        $col_dark = array("R"=>79,"G"=>122,"B"=>149,"Alpha"=>100);
        $col_mid = array("R"=>138,"G"=>171,"B"=>188,"Alpha"=>100);
        $col_light = array("R"=>205,"G"=>219,"B"=>226,"Alpha"=>100);

        $palette = array("0"=>$col_light, "1"=>$col_mid, "2"=>$col_dark);

        // the chart data object
        $myDescData = new pData();

        // case: order the bars
        if($energy_user <= $energy_top20)
        {
            $descValuesArray = array($energy_user, $energy_top20, $energy_all );
            $myDescData-> addPoints($descValuesArray, "Compare yourself!");
            $myDescData->addPoints(array("You ", "Top 20% ", "Average "),"Labels");

        }
        elseif($energy_user > $energy_top20 & $energy_user <= $energy_all)
        {
            $descValuesArray = array($energy_top20,$energy_user, $energy_all );
            $myDescData-> addPoints($descValuesArray, "Compare yourself!");
            $myDescData->addPoints(array("Top 20% ","You ", "Average "),"Labels");

        }
        elseif($energy_user > $energy_all)
        {
            $descValuesArray = array($energy_top20, $energy_all, $energy_user);
            $myDescData-> addPoints($descValuesArray, "Compare yourself!");
            $myDescData->addPoints(array("Top 20% ", "Average ","You " ),"Labels");
        }

        $myDescData->setAbscissa("Labels");

        // set a custom y axis format
        $myDescData->setAxisDisplay(0,AXIS_FORMAT_CUSTOM,"YAxisFormat");

        // an image objekt to visualise $myDescData
        $myDescChart = new pImage(1000, 500, $myDescData);

        // set the font properties
        $myDescChart->setFontProperties(array("FontName"=>$font2,"FontSize"=>21,"R"=>80,"G"=>80,"B"=>80));

        // set the graph are but it should be smaller than the chart
        $myDescChart->setGraphArea(140,70, 860, 450);

        // set the scale values
        $myDescChart->drawScale(array(
            // x axis margin
            'XAxisTitleMargin'=>10,
            //"MinDivHeight"=>$minDivHeight,
            // white background
            "CycleBackground"=>FALSE,
            // hide ticks
            "DrawSubTicks"=>FALSE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridAlpha"=>1,
            // chance the scale position to topbottom
            "Pos"=>SCALE_POS_TOPBOTTOM,
            // start from zero
            "Mode" => SCALE_MODE_START0));

        // funtion for a custom y axis format
        if (!function_exists('YAxisFormat')) {
            function YAxisFormat($Value) { return(" ".  $Value ." Wh"); }
            // ... proceed to declare your function
        }

        // draws an headin text
        $myDescChart->drawText(450,28,"consumption in wH",array("FontSize"=>20,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));

        // create the chart
        $myDescChart->drawBarChart(array("DisplayValues"=>TRUE,"Surrounding"=>30,"OverrideColors"=>$palette));

        // workaround to hide the Y-axis
        $RectangleSettings = array("R"=>255,"G"=>255,"B"=>255);
        $myDescChart->drawFilledRectangle(10,30, 1000,80,$RectangleSettings);

        // save the picture to file
        $myDescChart->render("pictures/descChart.png");
    }

    /**
     * creates the time comparison chart
     * TODO: update comments
     */
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
        $myTimeCompChart = new pImage(700,230,$MyData);

        /* Turn of Antialiasing */
        $myTimeCompChart->Antialias = FALSE;


        /* Set the default font */
        $myTimeCompChart->setFontProperties(array("FontName"=>$font2,"FontSize"=>9,"R"=>0,"G"=>0,"B"=>0));

        /* Define the chart area */
        //$myPicture->setGraphArea(60,40,650,200);
        $myTimeCompChart->setGraphArea(60,30,680,200);

        //$myPicture->drawText(40,20,"Wh");

        /* Draw the scale */
        $scaleSettings = array("XMargin"=>10,"YMargin"=>10,"Floating"=>TRUE,"GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE);
        //$myPicture->drawScale($scaleSettings);
        $AxisBoundaries = array(0=>array("Min"=>0,"Max"=>max(array_slice($userExtractions,-30,30))));
        $myTimeCompChart->drawScale(array("InnerTickWidth"=>-1,"OuterTickWidth"=>5,"TickR"=>255,"TickG"=>255,"TickB"=>255,"Mode"=>SCALE_MODE_MANUAL,"ManualScale"=>$AxisBoundaries,"LabelRotation"=>45,"DrawXLines"=>FALSE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridTicks"=>0,"GridAlpha"=>30,"AxisAlpha"=>0));

        /* Enable shadow computing */
        $myTimeCompChart->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

        /* Draw the line chart
        $myPicture->drawLineChart(array("DisplayColor"=>DISPLAY_MANUAL));
        $myPicture->drawPlotChart(array("DisplayValues"=>TRUE,"PlotBorder"=>TRUE,"BorderSize"=>2,"Surrounding"=>-60,"BorderAlpha"=>80));
        */

        $myTimeCompChart->drawBarChart();
        /* Write the chart legend */
        // legend is just the email of the user, which is already  shown in the header of the mailing
        //$myPicture->drawLegend(590,9,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL,"FontR"=>255,"FontG"=>255,"FontB"=>255));

        $RectangleSettings = array("R"=>255,"G"=>255,"B"=>255);
        $myTimeCompChart->drawFilledRectangle(61,201,720,230,$RectangleSettings);


        $GradientAreaSettings = array("StartR"=>255,"StartG"=>255,"StartB"=>255,"Alpha"=>100,
            "EndR"=>11, "EndG"=>71, "EndB"=>101);
        $myTimeCompChart->drawGradientArea(140,205,676,218, DIRECTION_HORIZONTAL, $GradientAreaSettings);

        $myTimeCompChart->drawText(631,215,"latest showers",array("R"=>255, "G"=>255, "B"=>255,"FontSize"=>8,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));

        /* Render the picture (choose the best way) */
        $myTimeCompChart->render("pictures/timeCompChart.png");


    }

}