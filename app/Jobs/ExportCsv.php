<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use League\Csv\Writer;

class ExportCsv implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $csvData = [];
        foreach ($this->data as $row) {
            $csvData[] = array_values($row);
        }

        $csv = Writer::createFromString('');
        $csv->insertAll($csvData);

        $filePath = 'temp/' . uniqid() . '.csv';
        Storage::disk('local')->put($filePath, $csv->getContent());

        return $filePath;
    }
}
