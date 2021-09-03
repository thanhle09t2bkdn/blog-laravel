<?php

use Carbon\Carbon;

if (!function_exists('getConditionLast12Months')) {

    /**
     * Generate a UUID
     *
     * @return array
     */
    function getConditionLast12Months()
    {
        $time = Carbon::today()->subMonth(11);
        $month = $time->format('m');
        $year = $time->format('Y');

        return [
            'from' => $year . '-' . $month . '-01',
            'to' => Carbon::now()->endOfMonth()->format('Y-m-d'),
            'step' => '1 month',
            'format' => 'YYYY-MM'
        ];
    }
}

if (!function_exists('getConditionLast7Days')) {

    /**
     * Generate a UUID
     *
     * @return array
     */
    function getConditionLast7Days()
    {
        $time = Carbon::today()->subDay(6);
        $day = $time->format('d');
        $month = $time->format('m');
        $year = $time->format('Y');

        return [
            'from' => $year . '-' . $month . '-' . $day,
            'to' => Carbon::now()->format('Y-m-d'),
            'step' => '1 day',
            'format' => 'YYYY-MM-DD'
        ];
    }
}
