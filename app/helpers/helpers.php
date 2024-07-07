<?php

use Carbon\Carbon;

if (!function_exists('convertNumberToShortFormat')) {
    function convertNumberToShortFormat($number)
    {
        $suffix = '';

        if ($number >= 1000) {
            $suffix = 'k';
            $number = round($number / 1000, 1);
        }

        return $number . $suffix;
    }
}
if (!function_exists('dateFormatFromTimestamp')) {
    function dateFormatFromTimestamp($format, $timestamp)
    {
        Carbon::setLocale('id');
        $formateDate = Carbon::createFromTimestamp($timestamp)->translatedFormat($format);
        return $formateDate;
    }
}
if (!function_exists('simpleTimeDiffFromTimestamp')) {
    function simpleTimeDiffFromTimestamp($timestamp_start, $timestamp_end)
    {
        $timestamp_start = Carbon::createFromTimestamp($timestamp_start);
        $timestamp_end = Carbon::createFromTimestamp($timestamp_end);

        $diff = $timestamp_start->diff($timestamp_end);
        $tahun = $diff->y;
        $bulan = $diff->m;
        $hari = $diff->d;
        $jam = $diff->h;
        $menit = $diff->i;

        $diff = 0;
        if ($tahun > 0) {
            $diff = $tahun . 'tahun';
        } else if ($bulan > 0) {
            $diff = $bulan . ' bulan';
        } else if ($hari > 0) {
            $diff = $hari . ' hari';
        } else if ($jam > 0) {
            $diff = $jam . ' jam';
        } else if ($menit > 0) {
            $diff = $menit . ' menit';
        } else {
            $diff = 0;
        }

        return $diff;
    }
}
