<?php

namespace App\Console\Commands;

use App\Components\Common\PandaFlix;
use Illuminate\Database\Console\Migrations\MigrateMakeCommand;

class MakeMigrationCommand extends MigrateMakeCommand
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'make:migration {name : The name of the migration} {component : The name of the component}
        {--create= : The table to be created}
        {--table= : The table to migrate}
        {--path= : The location where the migration file should be created}
        {--realpath : Indicate any provided migration file paths are pre-resolved absolute paths}
        {--fullpath : Output the full path of the migration}';

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
     * Get migration path.
     *
     * @return string
     */
    protected function getMigrationPath()
    {
        $path = PandaFlix::ComponentPath(
            $this->component.'/'.config('pandaflix.path.migrations')
        );

        if (!is_dir($path)) {
            mkdir($path);
        }

        return $path;
    }
}
