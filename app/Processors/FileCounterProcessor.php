<?php namespace App\Processors;

class FileCounterProcessor
{
    protected $filePath;

    function __construct($path)
    {
        $this->filePath = $path;
    }
    
    public function execute() {
        $f = fopen($this->filePath, 'rb');
        $lines = 0;

        while (!feof($f)) {
            $lines += substr_count(fread($f, 8192), PHP_EOL);
        }

        fclose($f);

        return $lines;
    }
}
