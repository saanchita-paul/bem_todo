<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class CsvExportService
{
    public static function generateCsv(array $data, array $headers, string $fileName): string
    {
        $filePath = storage_path('app/' . $fileName);

        $file = fopen($filePath, 'w');
        fputcsv($file, $headers);

        foreach ($data as $row) {
            fputcsv($file, $row);
        }

        fclose($file);

        return $filePath;
    }
}
