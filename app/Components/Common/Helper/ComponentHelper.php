<?php

namespace App\Components\Common\Helper;

use Illuminate\Support\Facades\File;

class ComponentHelper
{
    /**
     * Get all api route files.
     *
     * @return array|null
     */
    public static function getApiRouteFiles(): ?array
    {
        return self::getFilesByName('api.php');
    }

    /**
     * Get all web route files.
     *
     * @return array|null
     */
    public static function getWebRouteFiles(): ?array
    {
        return self::getFilesByName('web.php');
    }

    /**
     * Returns all component files matching the search term.
     *
     * @param string $search
     * @return array
     */
    public static function getFilesByName(string $search): array
    {
        $files = [];

        foreach (self::getComponentDirectories() as $component_directory) {
            $component_files = File::allFiles($component_directory);
            foreach ($component_files as $file) {
                if ($search === $file->getFilename()) {
                    array_push($files, $file->getPathname());
                }
            }
        }

        return $files;
    }

    /**
     * Get all component directories except Common.
     *
     * @return array
     */
    private static function getComponentDirectories(): array
    {
        $components = File::directories(app_path('Components'));

        foreach ($components as $key => $component) {
            if (strpos($component, 'Common')) {
                unset($components[$key]);
                break;
            }
        }

        return $components;
    }
}
