<?php namespace App\Processors;

class ZipUnpackProcessor
{
    protected $zipPath;
    protected $extractPath;
    protected $url;
    protected $files;
    protected $archive;

    function __construct($url, $zipPath, $extractPath, $filesystem) {
        $this->url = $url;
        $this->zipPath = $zipPath;
        $this->extractPath = $extractPath;
        $this->files = $filesystem;
        $this->setZipArchive(new \ZipArchive());
    }

    public function setZipArchive(\ZipArchive $archive) {
        $this->archive = $archive;
    }

    protected function getZipArchive() {
        return $this->archive;
    }

    public function execute(\Closure $success = null, \Closure $error = null) {
        $this->files->put($this->zipPath , fopen($this->url, 'r'));

        $zip = $this->getZipArchive();

        $result = $zip->open($this->zipPath);

        if ($result === true) {
            $zip->extractTo($this->extractPath);
            $zip->close();

            if (is_callable($success)) {
                $success();
            }

            $this->files->delete($this->zipPath);
            return true;
        } else {
            if (is_callable($error)) {
                $error();
            }
        }

        return false;
    }
}