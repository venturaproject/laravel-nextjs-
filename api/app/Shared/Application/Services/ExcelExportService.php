<?php

declare(strict_types=1);

namespace App\Shared\Application\Services;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Shared\Application\Bus\Query\QueryBus;
use Illuminate\Support\Facades\Storage;

class ExcelExportService
{
    protected QueryBus $queryBus;
    protected string $fileName;

    public function __construct(QueryBus $queryBus, string $fileName = 'report.xlsx')
    {
        $this->queryBus = $queryBus;
        $this->fileName = $fileName;
    }

    /**
     * Generates an Excel file based on the provided query and saves it to the specified path.
     *
     * @param object $query The query object to execute and retrieve data.
     * @param string $path The path to save the generated Excel file.
     * @return void
     */
    public function generateExcelFromQuery(object $query, string $path): void
    {
        // Execute the query to retrieve the data
        $dataCollection = $this->queryBus->handle($query);

        // Create the Excel file in memory
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Automatically detect headers
        if ($dataCollection->isNotEmpty()) {
            $headers = array_keys($dataCollection->first()->toArray());
            $col = 'A';

            // Write headers
            foreach ($headers as $header) {
                // Ensure the header is a string before passing to ucfirst
                $sheet->setCellValue("{$col}1", ucfirst((string)$header)); // Cast to string
                $col++;
            }

            // Write data
            $row = 2;
            foreach ($dataCollection as $item) {
                $col = 'A';
                foreach ($item->toArray() as $value) {
                    $sheet->setCellValue("{$col}{$row}", $value);
                    $col++;
                }
                $row++;
            }
        }

        // Save the Excel file to the filesystem
        $writer = new Xlsx($spreadsheet);
        $writer->save($path);
    }
}


