<?php namespace App\Processors;

class FileMoveUnpackedProcessor
{
    function __construct($fromDir, $toPath, $backupPath, $filesystem)
    {
        $this->fromDir = $fromDir;
        $this->toPath = $toPath;
        $this->backupPath = $backupPath;
        $this->files = $filesystem;
    }

    function execute(\Closure $success = null, \Closure $error = null) {
        $names = $this->files->glob($this->fromDir . '/*.txt');

        if ($names === false) {
            if (is_callable($error)) {
                $error();
            }
            return false;
        }

        $this->files->move($this->toPath, $this->backupPath);
        $this->files->copy($names[0], $this->toPath);
        $this->files->delete($names[0]);
        if (is_callable($success)) {
            $success();
        }
        return true;
    }
}