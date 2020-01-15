<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class AddApiRoutesCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'add:api-routes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new api routes file';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Api Route File';

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
        $stub = '/stubs/route.api.stub';

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
        return $rootNamespace.'\Components\\'.$this->component.'\\Routes';
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

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }

    protected function getNameInput()
    {
        $this->component = strtolower($this->argument('component'));
        $this->component = ucfirst($this->component);

        return 'App\Components\\'.$this->component.'\\Routes\api';
    }

    /**
     * Build the replacements for the file.
     *
     * @return array
     */
    protected function buildReplacements()
    {
        return [
            'DummyComponent' => $this->component,
            'DummyRoute' => strtolower($this->component),
            'DummyModel' => ucfirst(strtolower($this->component)),
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
            ['component', InputArgument::REQUIRED, 'The name of the component'],
        ];
    }
}
