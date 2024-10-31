<?php

declare(strict_types=1);

namespace App\Shared\Application\Console\Commands;

use App\Products\Application\Queries\GetAll\GetAllProducts;
use App\Shared\Application\Services\EmailService;
use App\Shared\Application\Services\ExcelExportService;
use Illuminate\Console\Command;
use Carbon\Carbon;

class ExportProductsCommand extends Command
{
    protected $signature = 'export:products';
    protected $description = 'Export all products to an Excel file';

    private ExcelExportService $excelExportService;

    public function __construct(ExcelExportService $excelExportService)
    {
        parent::__construct();
        $this->excelExportService = $excelExportService;
    }

    public function handle(): void
    {
        $query = new GetAllProducts();

        // Generate the filename with the current date and time
        $timestamp = Carbon::now()->format('Y_m_d_H_i_s');
        $filePath = storage_path(sprintf('app/private/exports/report_%s.xlsx', $timestamp));
    
        // Generate the Excel and save the file
        $this->excelExportService->generateExcelFromQuery($query, $filePath);
    
        // Send the email
        $emailService = app(EmailService::class); 
        $recipient = 'recipient@example.com'; 

        // Ensure the subject is always a string
        $subject = __('messages.product_report');

        if (!is_string($subject)) {
            $subject = 'Products report'; 
        }

        $data = []; 
        $template = 'emails.report'; 
        $attachments = [$filePath]; 
    
        $emailService->send($template, $data, $recipient, $subject, $attachments);
    
        $this->info(sprintf('Excel report generated %s and emailed to: %s ', $filePath, $recipient));
    }
}

