<?php

namespace App\Components\Common\Helper;

use App\Components\Common\PandaFlix;
use Illuminate\Support\Facades\File;

class ComponentHelper
{

    public static function getCount(): int
    {
        return sizeof(self::getComponentDirectories());
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
                if (strpos($file->getFilename(), $search) !== false) {
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
        $components = File::directories(PandaFlix::ComponentPath());

        foreach ($components as $key => $component) {
            if (strpos($component, 'Common')) {
                unset($components[$key]);
                break;
            }
        }

        return $components;
    }
}
