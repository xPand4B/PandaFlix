<?php

namespace App\Console\Commands;

use Illuminate\Foundation\Console\TestMakeCommand;
use Illuminate\Support\Str;

class MakeTestCommand extends TestMakeCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'make:test {name : The name of the class}
                                      {component : The name of the component}
                                      {--unit : Create a unit test}';

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
        if ($this->option('unit')) {
            return __DIR__ . '/stubs/unit-test.stub';
        }

        return __DIR__ . '/stubs/test.stub';
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return base_path('app/Components/').str_replace('\\', '/', $name).'.php';
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

        if ($this->option('unit')) {
            return $rootNamespace.'\\'.$this->component.'\tests\Unit';
        } else {
            return $rootNamespace.'\\'.$this->component.'\tests\Feature';
        }
    }

    /**
     * Build the class with the given name.
     */
    protected function buildClass($name)
    {
        return str_replace(
            'Dummy', $this->component, parent::buildClass($name)
        );
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return 'App\Components';
    }
}
