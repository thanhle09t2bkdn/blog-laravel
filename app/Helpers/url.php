<?php

if (!function_exists('getHost')) {

    /**
     * Get only host
     *
     * @param string $url
     *
     * @return string
     */
    function getHost(string $url)
    {
        $parse = parse_url($url);

        return str_ireplace('www.', '', $parse['host']);
    }
}

if (!function_exists('getSchemeHost')) {

    /**
     * Get scheme and host
     *
     * @param string $url
     * @param string $defaultSchema
     *
     * @return string
     */
    function getSchemeHost(string $url, string $defaultSchema = 'https')
    {
        $parse = parse_url($url);
        if (empty($parse['scheme'])) {
            $parse['scheme'] = $defaultSchema;
        }

        return "{$parse['scheme']}://{$parse['host']}";
    }
}

if (!function_exists('getUrlWithoutQuery')) {

    /**
     * Get url without query
     *
     * @param string $url
     * @param string $website
     * @param string $defaultSchema
     *
     * @return string
     */
    function getUrlWithoutQuery(string $url, string $website, string $defaultSchema = 'https')
    {
        $parse = parse_url($url);
        if (empty($parse['scheme'])) {
            $parse['scheme'] = $defaultSchema;
        }

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            if (substr($parse['path'], 0, 1) === '/') {
                return $website . $parse['path'];
            } else {
                return $website . '/' . $parse['path'];
            }
        }

        return "{$parse['scheme']}://{$parse['host']}{$parse['path']}";
    }
}

if (!function_exists('getDataQuery')) {

    /**
     * Get data query from URL string
     *
     * @param string $url
     * @param string $variable
     *
     * @return mixed|null
     */
    function getDataQuery(string $url, string $variable)
    {
        $parts = parse_url($url);
        parse_str($parts['query'], $query);
        return $query[$variable] ?? null;
    }
}

if (!function_exists('addDataQuery')) {

    /**
     * Get data query from URL string
     *
     * @param string $url
     * @param string $key
     * @param string $value
     *
     * @return string
     */
    function addDataQuery(string $url, string $key, string $value)
    {
        $query = parse_url($url, PHP_URL_QUERY);

        if ($query) {
            parse_str($query, $queryParams);
            $queryParams[$key] = $value;
            $url = str_replace("?$query", '?' . http_build_query($queryParams), $url);
        } else {
            $url .= '?' . urlencode($key) . '=' . urlencode($value);
        }

        return str_replace('??', '?', $url);
    }
}

if (!function_exists('addParamsQuery')) {

    /**
     * Get data query from URL string
     *
     * @param string $url
     * @param array  $params
     *
     * @return string
     */
    function addParamsQuery(string $url, array $params)
    {
        foreach ($params as $key => $value) {
            $url = addDataQuery($url, $key, $value);
        }

        return $url;
    }
}

if (!function_exists('getFullUrl')) {

    /**
     * Get full URL
     *
     * @param string $link
     * @param string $host
     *
     * @return string
     */
    function getFullUrl(string $link, string $host)
    {
        if (!filter_var($link, FILTER_VALIDATE_URL)) {
            if (substr($link, 0, 1) === '/') {
                $link = $host . $link;
            } else {
                $link = $host . '/' . $link;
            }
        }

        return $link;
    }
}
