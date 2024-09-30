<?php

function strToMinutes(string $str): int{
    $timePattern = '/(\d+)h(\d+)m/';
    preg_match($timePattern, $str, $matches);
    return ((int)$matches[1]*60) + ((int)$matches[2]);
}

function minutesToStr(int $minutes): string{
    $hours = floor($minutes / 60);
    $minutes = floor($minutes % 60);
    return $hours . "h" . ($minutes < 10 ? "0" . $minutes : $minutes) . "m";
}