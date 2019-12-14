<?php

namespace App\Console\Commands;

use Illuminate\Foundation\Console\RequestMakeCommand;
use Symfony\Component\Console\Input\InputArgument;

class MakeRequestCommand extends RequestMakeCommand
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

        return $rootNamespace.'\Components\\'.$this->component;
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
        $this->call('make:test', [
            'name' => $this->argument('name').'Test',
            'component' => $this->component
        ]);

        return parent::buildClass($name);
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
