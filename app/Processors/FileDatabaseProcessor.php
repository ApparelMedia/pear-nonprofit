<?php namespace App\Processors;

class FileDatabaseProcessor
{
    protected $offset;
    protected $limit;
    protected $pdo;
    protected $path;

    function __construct($path, \PDO $pdo) {
        $this->path = $path;
        $this->pdo = $pdo;
    }

    protected function getVectorExpression(array $data, $pdo) {
        $vectorValue = implode(' || \' \' || ', $data);
        return 'to_tsvector(' . $vectorValue . ')';
    }

    protected function getPdo() {
//        if ($this->pdo) return $this->pdo;
//
//        $host = env('DB_HOST');
//        $port = env('DB_PORT');
//        $dbname = env('DB_DATABASE');
//        $user = env('DB_USERNAME');
//        $pass = env('DB_PASSWORD');
//
//        $this->pdo = new \PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $pass);

        return $this->pdo;
    }

    public function execute(\Closure $afterEach = null) {
        $pdo = $this->getPdo();
        $file = fopen($this->path, 'r');
        $i = 0;
        while ( !feof($file) ) {
            $i++;
            $row = fgetcsv($file, 2000, '|');

            if (is_null($row[0])) continue;

            $rowValues = array_map(function ($value) use ($pdo) {
                return $pdo->quote($value);
            }, $row);

            $processedSql = 'INSERT INTO nonprofits (ein, name, city, state, country, deductibility_status_code, nonprofit_vector) VALUES ('
                . $rowValues[0] . ','
                . $rowValues[1] . ','
                . $rowValues[2] . ','
                . $rowValues[3] . ','
                . $rowValues[4] . ','
                . $rowValues[5] . ','
                . $this->getVectorExpression([$rowValues[1], $rowValues[2], $rowValues[3], $rowValues[0]], $pdo) . ')';

            $pdo->exec($processedSql);
            if (is_callable($afterEach)) {
                $afterEach($i);
            }
        }
        return true;
    }
}
