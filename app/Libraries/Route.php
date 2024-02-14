<?php

namespace App\Libraries;

class Route 
{        
    public static function get($pattern, $class, $method)
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        $pattern_arr = explode('/', $pattern);
        $url_arr = explode('/', $url);

        $args = [];
        foreach($pattern_arr as $key => $ptrn)
        {
            if (str_contains($ptrn, ':')) 
            {
                $arg = @$url_arr[$key];
                $args[] = $arg;
                $url_arr[$key] = $ptrn;
            }
        }

        if($_SERVER['REQUEST_METHOD'] === 'GET' && $pattern === implode('/', $url_arr))
        {
            $class::$method(...$args);
        }
    }

    public static function post($pattern, $class, $method)
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        $pattern_arr = explode('/', $pattern);
        $url_arr = explode('/', $url);

        $args = [];
        foreach($pattern_arr as $key => $ptrn)
        {
            if (str_contains($ptrn, ':')) 
            {
                $arg = @$url_arr[$key];
                $args[] = $arg;
                $url_arr[$key] = $ptrn;
            }
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST' && $pattern === implode('/', $url_arr))
        {
            $class::$method(...$args);
        }
    }

    public static function put($pattern, $class, $method)
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        $pattern_arr = explode('/', $pattern);
        $url_arr = explode('/', $url);

        $args = [];
        foreach($pattern_arr as $key => $ptrn)
        {
            if (str_contains($ptrn, ':')) 
            {
                $arg = @$url_arr[$key];
                $args[] = $arg;
                $url_arr[$key] = $ptrn;
            }
        }

        if($_SERVER['REQUEST_METHOD'] === 'PUT' && $pattern === implode('/', $url_arr))
        {
            $class::$method(...$args);
        }
    }

    public static function delete($pattern, $class, $method)
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        $pattern_arr = explode('/', $pattern);
        $url_arr = explode('/', $url);

        $args = [];
        foreach($pattern_arr as $key => $ptrn)
        {
            if (str_contains($ptrn, ':')) 
            {
                $arg = @$url_arr[$key];
                $args[] = $arg;
                $url_arr[$key] = $ptrn;
            }
        }

        if($_SERVER['REQUEST_METHOD'] === 'DELETE' && $pattern === implode('/', $url_arr))
        {
            $class::$method(...$args);
        }
    }
}