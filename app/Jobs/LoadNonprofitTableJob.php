<?php

namespace App\Jobs;

class LoadNonprofitTableJob extends Job
{
    protected $csv;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($path)
    {
        $this->csv = new \App\Processors\FileDatabaseProcessor($path, app('db')->connection()->getPDO());
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->csv->execute(function ($i) {});
    }
}
