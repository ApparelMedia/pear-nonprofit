<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Symfony\Component\Console\Input\InputOption;

class DataBatchReloadTable extends Command
{
    use ConfirmableTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:batchReloadTable 
                            {--force : Force the operation to run when in production.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reload Nonprofit Table Via Batch Sql File';

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

        $this->filePath = config('data.sqlFilePath');
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

//        $csv = new \App\Processors\FileDatabaseProcessor($this->filePath, $connection->getPDO());
        $host = config('database.connections.mysql.host');
        $db = config('database.connections.mysql.database');
        $port = config('database.connections.mysql.port');
        $user = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');

        $command = "mysql --host=$host --port=$port --user=$user --password={$password} --database=$db < {$this->filePath}";
        exec($command);
        $this->info('The data is successfully reloaded.');
    }
}
