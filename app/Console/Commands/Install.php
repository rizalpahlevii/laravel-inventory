<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup project installation';

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
        $this->header();
        $this->info('Installing: ');

        if ($this->confirm('Do you have setting the database configuration at .env ?')) {
            $this->call('optimize');
            $this->info('Migrating database...');
            $this->call('migrate:fresh');
            $this->call('db:seed');
            $this->call('key:generate');
            $this->info('Installing Is Completed ! Thank You :)');
            $this->info('--');
            $this->info("::Administrator Credential::\nURL Login: http://localhost:8000/login\nUsername: admin\nPassword: 123456");
        } else {
            $this->info('Setup Aborted !');
            $this->info('Please setting the database configuration for first !');
        }

        $this->footer();
    }

    private function header()
    {
        $this->info('--------- :===: By @rizalpahlevii :==: ---------------');
        $this->info('====================================================================');
    }

    private function footer()
    {
        $this->info('====================================================================');
        $this->info('------------------- :===: Completed !! :===: ------------------------');
        exit;
    }
}
