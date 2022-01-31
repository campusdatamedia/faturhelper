<?php

namespace Ajifatur\FaturHelper\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;
use Ajifatur\FaturHelper\FaturHelperServiceProvider;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'faturhelper:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install FaturHelper package';

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
     * @return void
     */
    public function handle(Filesystem $filesystem)
    {
        // Installing info
        $this->info('Installing FaturHelper package.');

        // Publish
        $this->call('vendor:publish', ['--provider' => FaturHelperServiceProvider::class, '--tag' => 'config']);
        $this->call('vendor:publish', ['--provider' => FaturHelperServiceProvider::class, '--tag' => 'assets']);
        $this->call('vendor:publish', ['--provider' => FaturHelperServiceProvider::class, '--tag' => 'templates']);

        // Composer dump autoload
        $composer = new Composer($filesystem);
        $composer->dumpAutoloads();

        // Migrate
        $this->call('migrate');

        // Seed
        $this->call('db:seed', ['--class' => \Ajifatur\FaturHelper\Seeders\DatabaseSeeder::class]);
        $this->call('db:seed', ['--class' => \Ajifatur\FaturHelper\Seeders\DummySeeder::class]);

        // Success info
        $this->info('Successfully installing FaturHelper! Enjoy!');
    }
}