<?php

namespace App\Components\Common;

class PandaFlix
{
    /**
     * PandaFlix Version.
     *
     * @var string
     */
    public const VERSION = "1.0.0";

    /**
     * Add data to resources.
     *
     * @return array
     */
    public static function ResourceAdditions(): array
    {
        return [
            'version' => self::VERSION,
            'success' => (boolean)true
        ];
    }
}
