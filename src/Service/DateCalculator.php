<?php


namespace App\Service;


class DateCalculator
{
    public function yearsDiffrence($year)
    {
        $curYear = date('Y');
        $diff = $curYear - $year;
        return $diff;
    }
}
