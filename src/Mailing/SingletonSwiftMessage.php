<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 28/11/15
 * Time: 15:34
 */
final class SingletonMessage extends Swift_Message
{
    /**
     * Call this method to get singleton
     *
     * @return Swift_Message
     */
    public static function Instance()
    {
        static $inst = null;
        if ($inst === null) {
            $subject = 'This is your Amphiro report. Together we can save the planet!';
            $inst = new Swift_Message($subject);
        }
        return $inst;
    }


}