<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Symfony\Component\Console\Input\InputOption;

class DataReloadNonprofitTable extends Command
{
    use ConfirmableTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:reloadStagingTable 
                            {--force : Force the operation to run when in production.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reload Nonprofit Table';

    protected $counter;
    protected $filePath;

    /**
     * Create a new command instance.
     *
     * @param  DripEmailer  $drip
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->filePath = config('data.filePath');
        $this->counter = new \App\Processors\FileCounterProcessor($this->filePath);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (! $this->confirmToProceed()) {
            return;
        }

        $this->info('truncating nonprofits_staging table');
        $connection = app('db')->connection();
        $connection->disableQueryLog();
        app('db')->table('nonprofits_staging')->truncate();

        $this->info('importing data from ' . $this->filePath . ' to nonprofits_staging table');

        $count = $this->counter->execute() / 1000;
        $bar = $this->output->createProgressBar($count);

        $csv = new \App\Processors\FileDatabaseProcessor($this->filePath, $connection->getPDO());
        $csv->execute(function ($i) use ($bar) {
            if ($i % 1000 === 0) {
                $bar->advance();
            }
        });

        $bar->finish();

        $this->info('The data is successfully reloaded.');
    }
}
