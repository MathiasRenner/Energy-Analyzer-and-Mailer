<?php


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
        $this->CreateGoalChart();
    }

    /**
     *  Wrapper for the creation of the pie charts for the goal feature
     */
    public function CreateGoalChart()
    {
        $calculations = new Calculations();
        $actualConsEnergy = $calculations->CalcEnergyUser(TRUE);

        $actualConsVolume = $calculations->CalcVolumeAvgUser(TRUE);

        $savingConsVolume = $calculations->CalcSavingVolumeForBetterEnergyClass($actualConsEnergy);

        $this->CreateGoalChartPicture(1-($savingConsVolume / $actualConsVolume), $savingConsVolume / $actualConsVolume, "volumeSavingChart.png");

    }

    /**
     * Create the pie charts for the goal feature
     *
     * @param $actual | int actual value first section
     * @param $saving | int saving value second section
     * @param $name | string the name of the chart
     * @internal param int $saving2 | int optional third section
     */
    private function CreateGoalChartPicture($actual, $saving, $name)
    {
        /* Create and populate the pData object */
        $MyData = new pData();

        $calc = new Calculations();
        $percent = round($calc->CalcPercentageSavings($calc->CalcEnergyUser()) * 100);

        // define the color
        $col_mid = array("R"=>138,"G"=>171,"B"=>188,"Alpha"=>100);
        $col_light = array("R"=>205,"G"=>219,"B"=>226,"Alpha"=>100);
        $col_orange = array("R"=>239,"G"=>162, "B"=>112);

        $font2 = "libs/charts/pChart2_1_4/fonts/verdana.ttf";

        $MyData->addPoints(array($actual,$saving),"ScoreA");

        $MyData->setSerieDescription("ScoreA","Application A");
        /* Define the absissa serie */
        $MyData->addPoints(array("Volume","Saving", "C2"),"Labels");
        $MyData->setAbscissa("Labels");
        /* Create the pChart object */
        $myPicture = new pImage(300,260,$MyData);
        /* Write the picture title */
        $myPicture->setFontProperties(array("FontName"=>$font2,"FontSize"=>6));
        /* Create the pPie object */
        $PieChart = new pPie($myPicture,$MyData);

        $PieChart->setSliceColor(0, $col_mid);
        $PieChart->setSliceColor(1, $col_orange);
        //$PieChart->setSliceColor(1, array("R"=>255,"G"=>255,"B"=>255,"Alpha"=>100));
        $PieChart->setSliceColor(2, $col_light);


        /* Draw an AA pie chart */
        $PieChart->draw2DRing(160,140,array("DrawLabels"=>FALSE,"LabelStacked"=>FALSE,"Border"=>TRUE));

        $myPicture->drawText(160,146,100-$percent . "%",array("FontSize"=>14,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE, "R"=>79,"G"=>122,"B"=>149));

        $myPicture->setShadow(FALSE);
        /* Render the picture (choose the best way) */
        $myPicture->render("pictures/".$name);
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
        $col_orange = array("R"=>239,"G"=>162, "B"=>112);

        $palette = array("0"=>$col_light, "1"=>$col_orange, "2"=>$col_dark);

        // the chart data object
        $myDescData = new pData();

        // case: order the bars
        if($energy_user <= $energy_top20)
        {
            $descValuesArray = array($energy_user, $energy_top20, $energy_all );
            $myDescData-> addPoints($descValuesArray, "Compare yourself!");
            $myDescData->addPoints(array("You ", "Top 20% ", "Average "),"Labels");
            $palette =  array("0"=>$col_orange, "1"=>$col_mid, "2"=>$col_dark);

        }
        elseif($energy_user > $energy_top20 & $energy_user <= $energy_all)
        {
            $descValuesArray = array($energy_top20,$energy_user, $energy_all );
            $myDescData-> addPoints($descValuesArray, "Compare yourself!");
            $myDescData->addPoints(array("Top 20% ","You ", "Average "),"Labels");
            $palette =  array("0"=>$col_light, "1"=>$col_orange, "2"=>$col_dark);

        }
        elseif($energy_user > $energy_all)
        {
            $descValuesArray = array($energy_top20, $energy_all, $energy_user);
            $myDescData-> addPoints($descValuesArray, "Compare yourself!");
            $myDescData->addPoints(array("Top 20% ", "Average ","You " ),"Labels");
            $palette =  array("0"=>$col_light, "1"=>$col_mid, "2"=>$col_orange);
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

        // function for a custom y axis format
        if (!function_exists('YAxisFormat')) {
            function YAxisFormat($Value) { return(" ".  $Value .""); }
            // ... proceed to declare your function
        }


        // create the chart
        $myDescChart->drawBarChart(array("DisplayValues"=>TRUE,"Surrounding"=>30,"OverrideColors"=>$palette));

        // workaround to hide the Y-axis
        $RectangleSettings = array("R"=>255,"G"=>255,"B"=>255);
        $myDescChart->drawFilledRectangle(10,30, 1000,80,$RectangleSettings);

        // draws an heading text
        $myDescChart->drawText(270,50,"consumption in Wh",array("FontSize"=>20,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));

        // save the picture to file
        $myDescChart->render("pictures/descChart.png");
    }

    /**
     * creates the time comparison chart
     */
    public function CreateTimeCompChart()
    {
        $db = DBAccessSingleton::getInstance();
        $username = $db->getUsername();
        $userEnergy= $db->getEnergyUser();

        // select max 30 elements or lower if not enough data is available
        if(count($userEnergy) >= 30)
            $countEnergyUser = 30;
        else
            $countEnergyUser = count($userEnergy);

        // select the font
        $font2 = "libs/charts/pChart2_1_4/fonts/verdana.ttf";

        /* Create and populate the pData object */
        $MyData = new pData();
        $MyData->addPoints(array_slice($userEnergy,(-1)*$countEnergyUser,$countEnergyUser),$username);
        // setting the series color
        $serieSettings = array("R"=>66,"G"=>106,"B"=>131);
        $MyData->setPalette($username,$serieSettings);

        $MyData->setSerieWeight($username, 1);

        //show values in " Wh"
        $MyData->setAxisUnit(0," Wh");

        $MyData->setAxisName(0,"");

        /* Create the pChart object */
        $myTimeCompChart = new pImage(700,230,$MyData);

        /* Turn of Antialiasing */
        $myTimeCompChart->Antialias = FALSE;

        /* Set the default font */
        $myTimeCompChart->setFontProperties(array("FontName"=>$font2,"FontSize"=>9,"R"=>0,"G"=>0,"B"=>0));

        /* Define the chart area */
        //$myPicture->setGraphArea(60,40,650,200);
        $myTimeCompChart->setGraphArea(60,30,680,200);

        /* Draw the scale */
        //$scaleSettings = array("XMargin"=>10,"YMargin"=>10,"Floating"=>TRUE,"GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE);
        //$myPicture->drawScale($scaleSettings);
        /* Draw the scale */
        //$myTimeCompChart->drawScale(array("DrawSubTicks"=>TRUE));
        /* Draw two thresholds */

        /* set bar boundaries */
        $AxisBoundaries = array(0=>array("Min"=>0,"Max"=>max(array_slice($userEnergy,(-1)*$countEnergyUser,$countEnergyUser))));
        $myTimeCompChart->drawScale(array("InnerTickWidth"=>-1,"OuterTickWidth"=>5,"TickR"=>255,"TickG"=>255,"TickB"=>255,"Mode"=>SCALE_MODE_MANUAL,"ManualScale"=>$AxisBoundaries,"LabelRotation"=>45,"DrawXLines"=>FALSE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridTicks"=>0,"GridAlpha"=>30,"AxisAlpha"=>0));

        /* Enable shadow computing */
        $myTimeCompChart->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

        $myTimeCompChart->drawBarChart();
        /* Write the chart legend */
        // legend is just the email of the user, which is already  shown in the header of the mailing
        //$myPicture->drawLegend(590,9,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL,"FontR"=>255,"FontG"=>255,"FontB"=>255));

        $RectangleSettings = array("R"=>255,"G"=>255,"B"=>255);
        $myTimeCompChart->drawFilledRectangle(61,201,720,230,$RectangleSettings);

        /* draw the gradient under the chart*/
        $GradientAreaSettings = array("StartR"=>255,"StartG"=>255,"StartB"=>255,"Alpha"=>100,
            "EndR"=>11, "EndG"=>71, "EndB"=>101);
        $myTimeCompChart->drawGradientArea(140,205,676,218, DIRECTION_HORIZONTAL, $GradientAreaSettings);

        $myTimeCompChart->drawText(631,215,"latest showers",array("R"=>255, "G"=>255, "B"=>255,"FontSize"=>8,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));

       // $myTimeCompChart->drawThreshold($avgCons,array("Alpha"=>100,"R"=>0,"G"=>0,"B"=>255, "WriteCaption"=>TRUE,"Caption"=>"Your Average"));

        /* Render the picture (choose the best way) */
        $myTimeCompChart->render("pictures/timeCompChart.png");


    }

}