<?php
/**
 * Created by PhpStorm.
 * User: smbar
 * Date: 10-Aug-18
 * Time: 1:46 PM
 */

namespace common\helper;


class TimelineHelper
{

    /**
     * Get range of years starting from previous year back to 10 years ago
     * @param int $range_difference
     * @return array
     */
    public static function getYearRange($range_difference = 10)
    {
        $prevYear = date('Y') - 1;
        $endYear = $prevYear - $range_difference;

        $number = range($prevYear, $endYear);

        $yearRange = [];
        foreach ($number as $key => $value) {
            $yearRange[$value] = $value;
        }


        return $yearRange;
    }
}