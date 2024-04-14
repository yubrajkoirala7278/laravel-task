<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service\ExportService;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    private $exportService;
    public function __construct()
    {
        $this->exportService = new ExportService();
    }

    public function index()
    {
        return view('admin.dashboard.index');
    }

    public function convertJsonToCsv(Request $request)
    {
        try {
            if ($request->hasFile('json-file') && $request->file('json-file')->isValid()) {
                $extension = $request->file('json-file')->getClientOriginalExtension();

                // check if the file format is json or not
                if ($extension !== 'json') {
                    return response()->json(['error' => 'Invalid file format. Please upload a JSON file.']);
                }
                // =====if you want to validate eack key value then remove comment====
                // $jsonData = json_decode(file_get_contents($request->file('json-file')->path()), true);

                // // Validate each key
                // foreach ($jsonData as $key => $value) {
                //     if (!isset($value['name']) || strlen($value['name']) > 255) {
                //         return response()->json(['error' => 'Invalid data: name is required and should be maximum 255 characters.']);
                //     }
                //     // You can add similar validations for other keys like email, phone, address here
                // }
                // ================================

                $csvFilePath = $this->exportService->convertToCSV($request);

                return response()->json(['csv_file' => $csvFilePath]);
            }

            return response()->json(['error' => 'No file uploaded or file is not valid.']);
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }



    public function downloadCsv(Request $request)
    {
        try {
            $filePath = $request->get('csv_file');

            return response()->download(storage_path('app/' . $filePath))->deleteFileAfterSend();
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
