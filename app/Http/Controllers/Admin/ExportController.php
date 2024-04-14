<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Csv\Writer;

class ExportController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index');
    }
    public function convertJsonToCsv(Request $request)
    {
        if ($request->hasFile('json-file') && $request->file('json-file')->isValid()) {
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

            return response()->json(['csv_file' => $csvFilePath]);
        }

        return response()->json(['error' => 'No file uploaded or file is not valid.']);
    }

    public function downloadCsv(Request $request)
    {
        $filePath = $request->get('csv_file');

        return response()->download(storage_path('app/' . $filePath))->deleteFileAfterSend();
    }
}
