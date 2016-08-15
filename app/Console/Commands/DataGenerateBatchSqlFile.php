<?php namespace App\Console\Commands;

use Illuminate\Console\Command;

class DataGenerateBatchSqlFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:generateSqlFile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates Batch Sql File from source data';

    protected $filePath;
    protected $sqlFilePath;
    protected $counter;
    public function __construct()
    {
        parent::__construct();

        $this->filePath = config('data.filePath');
        $this->sqlFilePath = config('data.sqlFilePath');
        $this->counter = new \App\Processors\FileCounterProcessor($this->filePath);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $count = $this->counter->execute() / 1000;
        $bar = $this->output->createProgressBar($count);

        $connection = app('db')->connection();
        $connection->disableQueryLog();

        $csv = new \App\Processors\FileSqlProcessor($this->filePath, $connection->getPDO(), $this->sqlFilePath);
        $csv->execute(function ($i) use ($bar) {
            if ($i % 1000 === 0) {
                $bar->advance();
            }
        });

        $bar->finish();

        $this->info('The data is successfully reloaded.');
    }
}
