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

        /*
        |--------------------------------------------------------------------------
        | Make default repository
        |--------------------------------------------------------------------------
        */
        $this->call('make:repository', [
            'name' => $componentName.'Repository',
            'component' => $componentName
        ]);

        /*
        |--------------------------------------------------------------------------
        | Make default resource collection
        |--------------------------------------------------------------------------
        */
        $this->call('make:resource', [
            'name' => $componentName.'Collection',
            'component' => $componentName,
            '--collection'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Make default resource
        |--------------------------------------------------------------------------
        */
        $this->call('make:resource', [
            'name' => $componentName.'Resource',
            'component' => $componentName
        ]);

        /*
        |--------------------------------------------------------------------------
        | Make default api controller
        |--------------------------------------------------------------------------
        */
        $this->call('make:controller', [
            'name' => $componentName.'ApiController',
            'component' => $componentName,
            '--api' => 'default'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Make default request
        |--------------------------------------------------------------------------
        */
        $this->call('make:request', [
            'name' => $componentName.'Request',
            'component' => $componentName
        ]);

        /*
        |--------------------------------------------------------------------------
        | Make default api route file
        |--------------------------------------------------------------------------
        */
        $this->call('add:api-routes', [
            'component' => $componentName,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Make default web route file
        |--------------------------------------------------------------------------
        */
        $this->call('add:web-routes', [
            'component' => $componentName,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Make default component tests
        |--------------------------------------------------------------------------
        */
        $this->call('make:test', [
            'name' => $componentName.'ApiControllerTest',
            'component' => $componentName
        ]);

        $this->call('make:test', [
            'name' => $componentName.'RepositoryTest',
            'component' => $componentName
        ]);

        $this->call('make:test', [
            'name' => $componentName.'CollectionTest',
            'component' => $componentName,
            '--unit' => 'default'
        ]);

        $this->call('make:test', [
            'name' => $componentName.'RequestTest',
            'component' => $componentName,
            '--unit' => 'default'
        ]);

//        $this->call('make:test', [
//            'name' => $componentName.'ResourceTest',
//            'component' => $componentName,
//            '--unit' => 'default'
//        ]);

        return;
    }
}
