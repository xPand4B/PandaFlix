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
     * The redirect url after a successful login.
     *
     * @var string
     */
    public const REDIRECT_TO_URL_AFTER_LOGIN = '/';

    /**
     * Returns the component path.
     *
     * @param string|null $path
     * @return string
     */
    public static function ComponentPath(string $path = null): string
    {
        return base_path(
            config('pandaflix.component_path') . DIRECTORY_SEPARATOR . $path
        );
    }

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
