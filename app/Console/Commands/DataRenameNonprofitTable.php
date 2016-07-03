<?php namespace App\Console\Commands;

use Illuminate\Console\Command;

class DataRenameNonprofitTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:renameTable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rename Nonprofit Table';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \Schema::rename('nonprofits','nonprofits_temp');
        \Schema::rename('nonprofits_staging','nonprofits');
        \Schema::rename('nonprofits_temp','nonprofits_staging');
    }
}
