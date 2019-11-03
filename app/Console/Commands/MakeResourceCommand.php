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

    protected function buildClass($name)
    {
        $replace = $this->replaceComponent();

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }

    protected function replaceComponent()
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
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],
            ['component', InputArgument::REQUIRED, 'The name of the component'],
        ];
    }
}
