<?php

namespace App\Components\Common\Testing\Traits;

use App\Components\Common\Helper\ComponentHelper;
use App\Components\Common\PandaFlix;
use Illuminate\Support\Facades\File;

trait ComponentTestTrait
{
    /**
     * @var string
     */
    public $sampleComponentName = 'Sample';

    /**
     * @var array
     */
    public $sampleComponentFiles = [
        'Sample',
        'SampleRepository',
        'SampleCollection',
        'SampleResource',
        'SampleApiController',
        'SampleRequest',
        'SampleRepositoryTest',
        'SampleCollectionTest',
        'SampleResourceTest',
        'SampleApiControllerTest',
        'SampleRequestTest',
    ];

    /**
     * Returns the count of the specified filename.
     *
     * @param string $filename
     * @return int
     */
    public function countFilesByName(string $filename): int
    {
        return sizeof(ComponentHelper::getFilesByName($filename));
    }

    /**
     * Runs ComponentHelper and deletes the component.
     *
     * @param string $componentName
     * @return array
     */
    public function getComponentFiles(string $componentName): array
    {
        $files = ComponentHelper::getFilesByName($componentName);

        for ($i = 0; $i < sizeof($files); $i++) {
            $files[$i] = basename($files[$i]);
            $files[$i] = str_replace('.php', '', $files[$i]);
        }

        return $files;
    }

    /**
     * Deletes a component.
     */
    public function deleteSampleComponent(): void
    {
        File::deleteDirectory(
            PandaFlix::ComponentPath() . DIRECTORY_SEPARATOR . $this->sampleComponentName
        );
    }
}
