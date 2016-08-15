<?php namespace App\Console\Commands;

use Illuminate\Console\Command;

class DataImportFromSource extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Data from Source (likely IRS website)';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('data:downloadFile');
        $this->info('downloaded csv file');
        $this->call('data:generateSqlFile');
        $this->info('generated Batch Sql File');
        $this->call('data:batchReloadTable', ['--force' => true]);
        $count = app('db')->connection()->query()->from('nonprofits_staging')->count();
        $this->info('Reloaded staging table with ' . $count . ' rows');

        $this->call('data:renameTable');
        $this->info('renamed staging table to prod table');

        $executionTime = ceil(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']);
        $minutes = $executionTime / 60;
        $finalNotification = "The entire process took $executionTime seconds or ({$minutes} minutes) to complete";
        $this->info($finalNotification);
        app('log')->info($finalNotification);
    }
}
