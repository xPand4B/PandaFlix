<?php

namespace App\Console\Commands;

use Illuminate\Foundation\Console\ResourceMakeCommand;
use Symfony\Component\Console\Input\InputArgument;

class MakeResourceCommand extends ResourceMakeCommand
{
    /**
     * @var string
     */
    private $component;

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        $this->component = strtolower($this->argument('component'));
        $this->component = ucfirst($this->component);

        return $rootNamespace.'\Components\\'.$this->component.'\\Resources';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->collection()
            ? __DIR__ . '/stubs/resource-collection.stub'
            : __DIR__.'/stubs/resource.stub';
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($name)
    {
        $replace = $this->buildReplacements();

        $this->call('make:test', [
            'name' => 'Resources/'.$this->argument('name').'Test',
            'component' => $this->component
        ]);

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }

    /**
     * Build the replacements for a controller.
     *
     * @return array
     */
    protected function buildReplacements()
    {
        return [
            'DummyComponent' => $this->component
        ];
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array_merge(parent::getArguments(), [
            ['component', InputArgument::REQUIRED, 'The name of the component'],
        ]);
    }
}
