<?php

namespace Boolval\Foundation;

class Application
{
    /**
     *
     */
    public static function init() : object
    {
        return new self;
    }

    /**
     *
     */
    public static function set(array $options) : object
    {
        return new self;
    }

    /**
     *
     */
    public static function abort(int $int)
    {
        http_response_code($int);
    }

    /**
     *
     */
    public static function include(string $string, string $extension = '') : object
    {
        include(self::file($string, $extension));

        return new self;
    }

    /**
     *
     */
    public static function path(string $string = '')
    {
        return self::base()->path() . str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $string);
    }

    /**
     *
     */
    public static function url(string $string = '')
    {
        return self::base()->url() . $string;
    }

    /**
     *
     */
    public static function file(string $string = '', string $extension = '')
    {
        return self::path($string) . (empty($extension) ? '.php' : '.' . $extension);
    }

    /**
     *
     */
    public static function base()
    {
        return new class
        {
            /**
             *
             */
            public static function path()
            {
                return dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR;
            }

            /**
             *
             */
            public static function url()
            {
                return str_replace(Request::path(), '', Request::uri());
            }
        };
    }
}
