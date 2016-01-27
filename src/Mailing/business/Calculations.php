<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 09/12/15
 * Time: 13:58
 */


/**
 * Class Calculations
 *
 * all calculations for the report
 */
class Calculations
{
    /**
     *
     *  Calculates the Efficiency for the user
     *
     *  E =  c * Volumen * (Durchschnittstemp. - 10°C) / n
     *  c: spezifische Wärmekapazität von Wasser
     *  Grundtemperatur Wasser: Kann konfiguriert werden, ist aber standardmäßig auf 10°C festgeleget
     *  n:  Effizienz = 100% (ist standardmäßig so festgelegt, kann aber konfiguriert werden bei Bedarf)
     *
     * @param $volume
     * @param $hotWater
     * @param $coldWater
     * @param $heat
     * @return float the calculated energy consumption of one shower
     */
    public function CalcEnergy($volume, $hotWater, $coldWater, $heat)
    {
        $c = 4200/3600;
        $energy =  $c * $volume * ($hotWater - $coldWater) / $heat;

        $energy = round($energy);

        return $energy;
    }


    /**
     * Calculates the average energy usage for the user
     *
     * @param bool $ignoreLimit false to calculate only the last 50 showers, true for all
     * @return float the average energy usage
     */
    public function CalcEnergyUser($ignoreLimit = FALSE)
    {
        $db = DBAccessSingleton::getInstance();

        $extractionUserCount = UtilSingleton::GetExtractionUserCount($ignoreLimit);

        $avgEnergyUser = array_sum(array_slice($db->getEnergyUser(),$extractionUserCount*(-1),$extractionUserCount))
            / count(array_slice($db->getEnergyUser(),$extractionUserCount*(-1),$extractionUserCount));

        return round($avgEnergyUser);
    }


    /**
     * the average energy usage for the top 20 % user
     *
     * @return float the average energy usage for the top 20 % user
     */
    public function CalcEnergyTopTwentyPercentUsers()
    {
        $db = DBAccessSingleton::getInstance();
        $temp = array();

        foreach ($db->getEnergyAllUser() as $item)
        {
            $avgEnergyUser = array_sum($item) / count($item);
            array_push($temp, $avgEnergyUser);
        }
        asort($temp);

        $energyAvgTwentyPercent = array_sum(array_slice($temp,0, count($temp)*0.2)) / (count($temp)*0.2);

        return round($energyAvgTwentyPercent);
    }


    /**
     * the average energy usage for all user
     *
     * @return float the average energy usage for all user
     */
    public function CalcEnergyAllUser()
    {
        $db = DBAccessSingleton::getInstance();
        $temp = array();

        foreach ($db->getEnergyAllUser() as $item)
        {
            $avgEnergyUser = array_sum($item) / count($item);
            array_push($temp, $avgEnergyUser);
        }

        $avgEnergyAllUser = array_sum($temp) / count($temp);

        return round($avgEnergyAllUser);
    }

    /**
     * Calculates the average volume usage for the user
     *
     * @param bool $ignoreLimit false to calculate only the last 50 showers, true for all
     * @return float the average volume usage
     */
    public function CalcVolumeAvgUser($ignoreLimit = FALSE)
    {
        $db = DBAccessSingleton::getInstance();

        $extractionUserCount = UtilSingleton::GetExtractionUserCount($ignoreLimit);

        $avgUserVolume = array_sum(array_slice($db->getVolumeUser(),$extractionUserCount*(-1),$extractionUserCount))
            / count(array_slice($db->getVolumeUser(),$extractionUserCount*(-1),$extractionUserCount));

        return round($avgUserVolume,1);
    }

    /**
     * the average water usage for all user
     *
     * @return float the average water usage for all user
     */
    public function CalcVolumeAllUser()
    {
        $db = DBAccessSingleton::getInstance();

        $temp = array();
        foreach ($db->getVolumeAllUser() as $item)
        {
            $avgVolume = array_sum($item) / count($item);
            array_push($temp, $avgVolume);
        }

        $avgVolumeTotal = array_sum($temp) / count($temp);

        return round($avgVolumeTotal,1);
    }


    /**
     * Calculates the average flow rate for the user
     *
     * @param bool $ignoreLimit false to calculate only the last 50 showers, true for all
     * @return float the average flow rate
     */
    public function CalcFlowRateUser($ignoreLimit = FALSE)
    {
        $db = DBAccessSingleton::getInstance();
        $extractionUserCount = UtilSingleton::GetExtractionUserCount($ignoreLimit);

        $avgUserFlowRate = array_sum(array_slice($db->getFlowRateUser(),$extractionUserCount*(-1),$extractionUserCount))
            / count(array_slice($db->getFlowRateUser(),$extractionUserCount*(-1),$extractionUserCount));

        return round($avgUserFlowRate,1);
    }

    /**
     * the average flow rate for all user
     *
     * @return float the average flow rate for all user
     */
    public function CalcFlowRateAllUser()
    {
        $db = DBAccessSingleton::getInstance();
        $temp = array();

        foreach ($db->getFlowRateAllUser() as $item)
        {
            $avgFlowRateUser = array_sum($item) / count($item);
            array_push($temp, $avgFlowRateUser);
        }

        $avgFlowRateAllUser = array_sum($temp) / count($temp);

        return round($avgFlowRateAllUser,1);
    }

    /**
     * Calculates the average temperature for the user
     *
     * @param bool $ignoreLimit false to calculate only the last 50 showers, true for all
     * @return float the average temperature
     */
    public function CalcUserTemperature($ignoreLimit = FALSE)
    {
        $db = DBAccessSingleton::getInstance();
        $extractionUserCount = UtilSingleton::GetExtractionUserCount($ignoreLimit);

        $avgUserTemperature = array_sum(array_slice($db->getTemperatureUser(),$extractionUserCount*(-1),$extractionUserCount))
            / count(array_slice($db->getTemperatureUser(),$extractionUserCount*(-1),$extractionUserCount));

        return round($avgUserTemperature,1);
    }


    /**
     * Calculates the average shower time for the user
     *
     * @param bool $ignoreLimit false to calculate only the last 50 showers, true for all
     * @return float the average shower time
     */
    public function CalcUserTime($ignoreLimit = FALSE)
    {
        $vol = $this->CalcVolumeAvgUser($ignoreLimit);
        $flowRate = $this->CalcFlowRateUser($ignoreLimit);

        $time = round($vol / $flowRate, 1);
        return $time;
    }


    /**
     * the average shower time for all user
     *
     * @return float the average shower time for all user
     */
    public function CalcAllUserTime()
    {
        $vol = $this->CalcVolumeAllUser();
        $flowRate = $this->CalcFlowRateAllUser();

        $time = round($vol / $flowRate, 1);
        return $time;
    }


    /**
     * calc the average number of showers by all user
     *
     * @return float average shower all user
     */
    public function CalcAvgNumberOfShowers()
    {
        $db = DBAccessSingleton::getInstance();

        return  ($db->GetNumberOfExtractions() / $db->GetNumberOfUsers() );
    }


    /**
     *
     * Cals the saving in percent to reach the next better energy class
     * @param $actualConsumption | int use the energyconsumption
     * @return float percent to save
     */
    public function CalcPercentageSavings($actualConsumption)
    {
        $betterConsumption = UtilSingleton::GetConsumptionForBetterEfficiencyClass($actualConsumption);

        $percent = ($actualConsumption - $betterConsumption)/$actualConsumption;

        return $percent;
    }

    /**
     * Cals the saving time to reach the next better energy class
     *
     * @param $actualConsumption | int use the energyconsumption
     * @return float time too save
     */
    public function CalcSavingTimeForBetterEnergyClass($actualConsumption)
    {
        $betterConsumption = UtilSingleton::GetConsumptionForBetterEfficiencyClass($actualConsumption);

        $percent = ($actualConsumption - $betterConsumption)/$actualConsumption;

        $avgUserVolume = $this->CalcVolumeAvgUser();

        $flowRate = $this->CalcFlowRateUser();

        $time = $avgUserVolume / $flowRate;

        $time = $time * 60 * $percent;

        return round($time,1);
    }



    /**
     * Cals the volume to save to reache the next better energy class
     *
     * @param $actualConsumption| int use the energyconsumption
     * @return float volume to save
     */
    public function CalcSavingVolumeForBetterEnergyClass($actualConsumption)
    {
        $betterConsumption = UtilSingleton::GetConsumptionForBetterEfficiencyClass($actualConsumption);

        $percent = ($actualConsumption - $betterConsumption)/$actualConsumption;

        $avgUserVolume = $this->CalcVolumeAvgUser();

        return round($avgUserVolume * $percent,1);
    }
}