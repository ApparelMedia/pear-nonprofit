<?php namespace App\Console\Commands;

use Illuminate\Console\Command;

class DataDownloadNonprofitFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:downloadFile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download File From IRS Website';

    protected $zipPath;
    protected $extractPath;
    protected $filePath;
    protected $backupPath;
    protected $url;

    /**
     * Create a new command instance.
     *
     * @param  DripEmailer  $drip
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->zipPath = config('data.zipPath');
        $this->extractPath = config('data.extractPath');
        $this->filePath = config('data.filePath');
        $this->backupPath = config('data.backupPath');
        $this->url = config('data.downloadUrl');

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('downloading zip file...');
        $unzip = new \App\Processors\ZipUnpackProcessor($this->url, $this->zipPath, $this->extractPath, app('files'));
        $successful = $unzip->execute(function () {
            $this->info('zip downloaded and extracted to ' . $this->extractPath);
        }, function () {
            $this->error('zip not downloaded. please double check downloadUrl in config/data.php');
        });

        if ( ! $successful) {
            return;
        }

        $moveFile = new \App\Processors\FileMoveUnpackedProcessor($this->extractPath, $this->filePath, $this->backupPath, app('files'));
        $moveFile->execute(function () {
            $this->info('original data backed up. data file copied.');
        }, function () {
            $this->error('there is no downloaded file');
        });
    }
    
}