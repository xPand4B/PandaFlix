<?php

namespace App\Console\Commands;

use App\Components\Common\PandaFlix;
use Illuminate\Database\Console\Seeds\SeederMakeCommand;
use Symfony\Component\Console\Input\InputArgument;

class MakeSeederCommand extends SeederMakeCommand
{
    /**
     * @var string
     */
    private $component;

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->component = strtolower($this->argument('component'));
        $this->component = ucfirst($this->component);

        parent::handle();
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/seeder.stub';
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = str_replace(
            ['\\', '/'], '', $this->argument('name')
        );

        return PandaFlix::ComponentPath(
            $this->component.'/'.config('pandaflix.path.seeds').'/'.$name.'.php'
        );
    }

    protected function buildClass($name)
    {
        $replace = $this->buildReplacements();

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
            'SeederNamespace' => 'App\Components\\'.$this->component.'\\Database\Seeds',
            'DummyModel' => $this->component
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
