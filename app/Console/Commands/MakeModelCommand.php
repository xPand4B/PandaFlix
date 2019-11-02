<?php

namespace App\Console\Commands;

use Illuminate\Foundation\Console\ModelMakeCommand;
use Symfony\Component\Console\Input\InputArgument;

class MakeModelCommand extends ModelMakeCommand
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

        return $rootNamespace.'\Components\\'.$this->component.'\Database';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('pivot')) {
            return __DIR__.'/stubs/pivot.model.stub';
        }

        return __DIR__ . '/stubs/model.stub';
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
