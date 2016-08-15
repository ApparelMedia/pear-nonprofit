<?php namespace App\Processors;

class FileSqlProcessor
{
    protected $filePath;
    protected $pdo;
    protected $sqlFilePath;

    function __construct($path, $pdo, $sqlFilePath)
    {
        $this->filePath = $path;
        $this->pdo = $pdo;
        $this->sqlFilePath = $sqlFilePath;

    }
    
    public function execute(\Closure $afterEach = null) {
        $file = fopen($this->filePath, 'rb');
        $backupPath = $this->sqlFilePath . '.bkp';
        $pdo = $this->pdo;

        if (file_exists($backupPath)) {
            unlink($backupPath);
        }
        if (file_exists($this->sqlFilePath)){
            rename($this->sqlFilePath, $backupPath);
        }

        $sqlFile = fopen($this->sqlFilePath, 'w');

        $i = 0;
        fwrite($sqlFile, "INSERT INTO nonprofits_staging (ein, name, city, state, country, deductibility_status_code) VALUES \n");
        $lineStart = '';
        while ( !feof($file) ) {

            $i++;

            if ($i % 1000 === 0) {
                $lineStart = "; \n\n INSERT INTO nonprofits_staging (ein, name, city, state, country, deductibility_status_code) VALUES ";
            }

            $row = fgetcsv($file, 2000, '|');

            if (is_null($row[0])) continue;

            $rowValues = array_map(function ($value) use ($pdo) {
                return $pdo->quote($value);
            }, $row);

            $processedSql = $lineStart . '('
                . $rowValues[0] . ','
                . $rowValues[1] . ','
                . $rowValues[2] . ','
                . $rowValues[3] . ','
                . $rowValues[4] . ','
                . $rowValues[5] . ") \n";

            fwrite($sqlFile, $processedSql);

            $lineStart = ',';

            if (is_callable($afterEach)) {
                $afterEach($i);
            }
        }
        fwrite($sqlFile, ';');

        fclose($sqlFile);
        fclose($file);

        return true;
    }
}
