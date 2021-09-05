<?php

use Illuminate\Support\Str;

if (!function_exists('generateUuid')) {

    /**
     * Generate a UUID
     *
     * @return string
     */
    function generateUuid()
    {
        return (string) Str::uuid();
    }
}

if (!function_exists('getOnlyLetter')) {

    /**
     * Get data query from URL string
     *
     * @param string $string
     *
     * @return string
     */
    function getOnlyLetter(string $string)
    {
        return preg_replace("/[^a-zA-Z0-9]+/", "", $string);
    }
}

if (!function_exists('getOnlyWord')) {

    /**
     * Get data query from URL string
     *
     * @param string $string
     *
     * @return string
     */
    function getOnlyWord(string $string)
    {
        return preg_replace("/[^a-zA-Z0-9 ]+/", " ", $string);
    }
}
