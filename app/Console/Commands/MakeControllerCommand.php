<?php

namespace App\Console\Commands;

use Illuminate\Routing\Console\ControllerMakeCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeControllerCommand extends ControllerMakeCommand
{
    /**
     * @var string
     */
    private $component;

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $stub = null;

        if ($this->option('parent')) {
            $stub = '/stubs/controller.nested.stub';
        } elseif ($this->option('model')) {
            $stub = '/stubs/controller.model.stub';
        } elseif ($this->option('invokable')) {
            $stub = '/stubs/controller.invokable.stub';
        } elseif ($this->option('resource')) {
            $stub = '/stubs/controller.stub';
        }

        if ($this->option('api') && is_null($stub)) {
            $stub = '/stubs/controller.api.stub';
        } elseif ($this->option('api') && ! is_null($stub) && ! $this->option('invokable')) {
            $stub = str_replace('.stub', '.api.stub', $stub);
        }

        $stub = $stub ?? '/stubs/controller.plain.stub';

        return __DIR__.$stub;
    }

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

        return $rootNamespace.'\Components\\'.$this->component.'\Http\Controllers';
    }

    /**
     * Build the class with the given name.
     *
     * Remove the base controller import if we are already in base namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $controllerNamespace = 'App\\Components\\'.$this->component.'\\Http\\Controllers';

        $replace = [];

        if ($this->option('parent')) {
            $replace = $this->buildParentReplacements();
        }

        if ($this->option('model')) {
            $replace = $this->buildModelReplacements($replace);
        }

        $replace = $this->buildReplacements();

        $replace["use {$controllerNamespace}\Controller;\n"] = '';

        $this->call('make:test', [
            'name' => 'Http/Controllers/'.$this->argument('name').'Test',
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
            'DummyModelClass' => ucfirst(strtolower($this->argument('component'))),
            'DummyModelVariable' => strtolower($this->argument('component')),
        ];
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array_merge(parent::getArguments(),[
            ['component', InputArgument::REQUIRED, 'The name of the component'],
        ]);
    }
}
