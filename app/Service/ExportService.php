<?php

namespace App\Service;

use League\Csv\Writer;
use Illuminate\Support\Facades\Storage;


class ExportService
{
    public function convertToCSV($request)
    {
        $filePath = $request->file('json-file')->store('temp');

        $jsonData = file_get_contents(storage_path('app/' . $filePath));
        $data = json_decode($jsonData, true);

        if ($data === null) {
            return response()->json(['error' => 'Invalid JSON file.']);
        }

        $csvData = [];
        foreach ($data as $row) {
            $csvData[] = array_values($row);
        }

        $csv = Writer::createFromString('');
        $csv->insertAll($csvData);

        $csvFilePath = 'temp/' . uniqid() . '.csv';
        Storage::disk('local')->put($csvFilePath, $csv->getContent());

        return $csvFilePath;
    }
}
