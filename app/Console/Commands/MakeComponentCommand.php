<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeComponentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:component {name : The name of the component}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new component';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $componentName = \ucfirst(\strtolower($this->argument('name')));

        $this->call('make:controller', [
            'name' => $componentName.'CrudController',
            'component' => $componentName,
            '--crud' => 'default'
        ]);

        $this->call('make:repository', [
            'name' => $componentName.'Repository',
            'component' => $componentName
        ]);

        // TODO: Add custom resource maker command
//        $this->call('make:resource', [
//            'name' => $componentName.'Resource'
//        ]);

        $testPath = __DIR__.'/../../Components/'.$componentName.'/tests/';

        if (! \is_dir($testPath)) {
            \mkdir($testPath.'Feature', 0755, true);
            \mkdir($testPath.'Unit', 0755);
        }

        return;
    }
}
