<?php

namespace App\Components\Common;

use App\Components\Common\Helper\ComponentHelper;
use Illuminate\Support\Facades\File;

class PandaFlix
{
    /**
     * PandaFlix Version.
     *
     * @var string
     */
    public const VERSION = "v1.0.0-dev";

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
        if (!is_null($path)) {

            $path = str_replace('/', DIRECTORY_SEPARATOR, $path);
            $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);

            if ($path[0] !== '/' || $path[0] !== '\\') {
                $path = DIRECTORY_SEPARATOR . $path;
            }
        }

        return base_path(
            config('pandaflix.path.component') . $path
        );
    }

    /**
     * Returns all migration directories.
     *
     * @return array
     */
    public static function getMigrationDirectories(): array
    {
        return ComponentHelper::getComponentNames(
            config('pandaflix.path.migrations'), true
        );
    }

    /**
     * Get all component seeder classes.
     *
     * @return array
     */
    public static function getComponentSeeders(): array
    {
        $seederPaths = ComponentHelper::getComponentNames(config('pandaflix.path.seeds'));
        $seeders = [];

        foreach ($seederPaths as $path) {
            if (is_dir($path)) {
                $files = File::allFiles($path);

                foreach ($files as $file) {
                    $classname = $file->getFilenameWithoutExtension();
                    $component = explode(DIRECTORY_SEPARATOR, $file->getRealPath());
                    $component = $component[sizeof($component) - 4];

                    $namespace = 'App\Components\\' . $component . '\Database\Seeds\\' . $classname;

                    array_push($seeders, $namespace);
                }
            }
        }

        return $seeders;
    }

    /**
     * Return additional data for resources.
     *
     * @return array
     */
    public static function ResourceAdditions(): array
    {
        return [
            'version' => self::VERSION,
        ];
    }
}
