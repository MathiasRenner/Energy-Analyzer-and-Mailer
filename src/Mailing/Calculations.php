<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 09/12/15
 * Time: 13:58
 */

class Calculations
{
    /**
     * Calculates the Efficiency for the user of the last 10 showers
     *
    1) Berechnung der Energie pro Dusche:
    E =  c * Volumen * (Durchschnittstemp. - 10°C) / n
    c: spezifische Wärmekapazität von Wasser
    Grundtemperatur Wasser: Kann konfiguriert werden, ist aber standardmäßig auf 10°C festgeleget
    n:  Effizienz = 100% (ist standardmäßig so festgelegt, kann aber konfiguriert werden bei Bedarf)

     *
     *
     *
     */
    public function CalcEnergy($volume, $hotWater, $coldWater, $heat)
    {
        $c = 4200/3600; // 1
        $energy =  $c * $volume * ($hotWater - $coldWater) / $heat;

        $energy = round($energy);

        return $energy;
    }

    public function GetEfficiencyClass($energy)
    {
        if($energy < 350)
        {
            return 'A+';
        }
        elseif($energy < 700)
        {
            return 'A';
        }
        elseif ($energy < 1225)
        {
            return 'B';
        }
        elseif ($energy < 1750)
        {
            return 'C';
        }
        elseif ($energy < 2275)
        {
            return 'D';
        }
        elseif ($energy < 2800)
        {
            return 'E';
        }
        elseif ($energy < 3325)
        {
            return 'F';
        }
        elseif ($energy >= 3325)
        {
            return 'G';
        }
    }

    public function CalcEnergyUsageUser()
    {
        $db = DBAccessSingleton::getInstance();

        if($db->extractionUserCount < 50)
        {
            $extractionUserCount = $db->extractionUserCount;
        }
        else
        {
            $extractionUserCount = 50;
        }

        $avgEnergyUser = array_sum(array_slice($db->energyUser,$extractionUserCount*(-1),$extractionUserCount))
            / count(array_slice($db->energyUser,$extractionUserCount*(-1),$extractionUserCount));

        return round($avgEnergyUser);
    }

    public function CalcEnergyUsageTopTwentyPercentUser()
    {
        $db = DBAccessSingleton::getInstance();
        $temp = array();

        foreach ($db->energyAllUser as $item)
        {
            $avgEnergyUser = array_sum($item) / count($item);
            array_push($temp, $avgEnergyUser);
        }
        asort($temp);

        $energyAvgTwentyPercent = array_sum(array_slice($temp,0, count($temp)*0.2)) / count($temp)*0.2;

        return round($energyAvgTwentyPercent);

    }

    public function CalcEnergyUsageAllUser()
    {
        $db = DBAccessSingleton::getInstance();
        $temp = array();

        foreach ($db->energyAllUser as $item)
        {
            $avgEnergyUser = array_sum($item) / count($item);
            array_push($temp, $avgEnergyUser);
        }

        $avgEnergyAllUser = array_sum($temp) / count($temp);

        return round($avgEnergyAllUser);
    }

    public function CalcSavingTimeForBetterEnergyClass($actualConsumption)
    {
        $betterConsumption = $this->GetConsumptionForBetterEfficiencyClass($actualConsumption);

        $percent = ($actualConsumption - $betterConsumption)/$actualConsumption;

        $avgUserVolume = $this->CalcVolumeAvgUser();

        $flowRate = $this->CalcUserFlowRate();

        $time = $avgUserVolume / $flowRate;

        $time = $time * 60 * $percent;

        return round($time,1);
    }

    public function CalcVolumeAvgUser()
    {
        $db = DBAccessSingleton::getInstance();

        $extractionUserCount = $this->GetExtractionUserCount();

        $avgUserVolume = array_sum(array_slice($db->extractionsUserVolume,$extractionUserCount*(-1),$extractionUserCount))
            / count(array_slice($db->extractionsUserVolume,$extractionUserCount*(-1),$extractionUserCount));

        return $avgUserVolume;
    }


    public function CalcSavingVolumeForBetterEnergyClass($actualConsumption)
    {
        $betterConsumption = $this->GetConsumptionForBetterEfficiencyClass($actualConsumption);

        $percent = ($actualConsumption - $betterConsumption)/$actualConsumption;

        $avgUserVolume = $this->CalcVolumeAvgUser();

        return round($avgUserVolume * $percent,1);
    }

    public function CalcUserFlowRate()
    {
        $db = DBAccessSingleton::getInstance();
        $extractionUserCount = $this->GetExtractionUserCount();

        $avgUserFlowRate = array_sum(array_slice($db->extractionsUserFlowRate,$extractionUserCount*(-1),$extractionUserCount))
            / count(array_slice($db->extractionsUserFlowRate,$extractionUserCount*(-1),$extractionUserCount));

        return round($avgUserFlowRate,1);
    }

    private function GetExtractionUserCount()
    {
        $db = DBAccessSingleton::getInstance();
        if($db->extractionUserCount < 50)
        {
            $extractionUserCount = $db->extractionUserCount;
        }
        else
        {
            $extractionUserCount = 50;
        }
        return $extractionUserCount;
    }

    private function GetConsumptionForBetterEfficiencyClass($actualConsumption)
    {
        if($actualConsumption >= 350 && $actualConsumption <= 700)
        {
            $betterConsumption = 349;
        }
        elseif($actualConsumption > 700 && $actualConsumption <= 1225)
        {
            $betterConsumption = 699;
        }
        elseif($actualConsumption > 1225 && $actualConsumption <= 1750)
        {
            $betterConsumption = 1224;
        }
        elseif($actualConsumption > 1750 && $actualConsumption <= 2275)
        {
            $betterConsumption = 1749;
        }
        elseif($actualConsumption > 2275 && $actualConsumption <= 2800)
        {
            $betterConsumption = 2274;
        }
        elseif($actualConsumption > 2800 && $actualConsumption <= 3325)
        {
            $betterConsumption = 2799;
        }
        elseif($actualConsumption > 3325)
        {
            $betterConsumption = 3324;
        }
        return $betterConsumption;
    }
}