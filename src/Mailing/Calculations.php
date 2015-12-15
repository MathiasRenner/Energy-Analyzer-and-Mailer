<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 09/12/15
 * Time: 13:58
 */

class Calculations
{
    public function GetEfficiencyClass($energy)
    {
        if($energy < 350)
        {
            return 'aa';
        }
        elseif($energy < 700)
        {
            return 'a';
        }
        elseif ($energy < 1225)
        {
            return 'b';
        }
        elseif ($energy < 1750)
        {
            return 'c';
        }
        elseif ($energy < 2275)
        {
            return 'd';
        }
        elseif ($energy < 2800)
        {
            return 'e';
        }
        elseif ($energy < 3325)
        {
            return 'f';
        }
        elseif ($energy >= 3325)
        {
            return 'g';
        }
    }


    public function CalcEnergyUsageUser()
    {
        $db = DBAccessSingleton::getInstance();

        $avgEnergyUser = array_sum(array_slice($db->energyUser,-10,10)) / count(array_slice($db->energyUser,-10,10));

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
}