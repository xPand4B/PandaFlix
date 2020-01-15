<?php

namespace App\Console\Commands;

use App\Components\Common\PandaFlix;
use Illuminate\Database\Console\Factories\FactoryMakeCommand;
use Symfony\Component\Console\Input\InputArgument;

class MakeFactoryCommand extends FactoryMakeCommand
{
    /**
     * @var string
     */
    private $component;

    /**
     * Execute the console command.
     *
     * @return bool|null
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $this->component = strtolower($this->argument('component'));
        $this->component = ucfirst($this->component);

        return parent::handle();
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $this->call('make:test', [
            'name' => 'Database/'.$this->argument('name').'Test',
            'component' => $this->component
        ]);

        return parent::buildClass($name);
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
            $this->component.'/'.config('pandaflix.path.factories').'/'.$name.'.php'
        );
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
