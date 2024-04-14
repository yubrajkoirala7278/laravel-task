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
