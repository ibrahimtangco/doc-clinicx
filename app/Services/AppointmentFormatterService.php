<?php

namespace App\Services;

use DateTime;

class AppointmentFormatterService
{
    public static function getFormattedDate($date)
    {
        $date = new DateTime($date);
        return $date->format('F j, Y');
    }

    public static function getFormattedTime($time)
    {
        $time = new DateTime($time);

        return $time->format('g:i A');
    }

    public static function getFormattedDuration($duration)
    {
        $hours = floor($duration / 60);
        $minutes = $duration % 60;

        if ($hours > 0 && $minutes > 0) {
            return "{$hours} hr {$minutes} mins";
        } elseif ($hours > 0) {
            return "{$hours} hr";
        } else {
            return "{$minutes} mins";
        }
    }
}
