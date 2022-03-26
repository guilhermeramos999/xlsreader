<?php

namespace Project\Pdo\Model;

require_once __DIR__ . '/../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class FileReader
{
    public function readFile()
    {
        $xlsPath = __DIR__. '/Xls/teste.xlsx';
        $reader = IOFactory::createReaderForFile($xlsPath);
        $reader->setReadDataOnly('true');
        $spreadsheet = $reader->load($xlsPath);

        $this->writeCsv($spreadsheet);
    }

    private function writeCsv($spreadsheet)
    {
        $csvPath = __DIR__. '/Csv/arquivo.csv';
        $write = new Csv($spreadsheet);
        $write->setDelimiter(';');
        $write->save($csvPath);
    }
}