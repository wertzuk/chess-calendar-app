<?php

namespace App\Console\Commands;

use App\Models\Tournament;
use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ImportChessResultsData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:csv {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import specific columns from a CSV file into the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        function convertDate(string $dateString)
        {
            $date = DateTime::createFromFormat('Ymd', $dateString);
            $formattedDate = $date->format('Y-m-d');

            return $formattedDate;
        }

        $file = $this->argument('file');

        // Check if the file exists
        if (! File::exists($file)) {
            $this->error("The file {$file} does not exist.");

            return;
        }

        // Read the CSV file
        $csvData = array_map('str_getcsv', file($file));

        // Ignore the first 4 lines
        $csvData = array_slice($csvData, 4);

        // Process each row
        foreach ($csvData as $row) {
            // Extract columns 1, 2, 3, 10, 11, 12 (indexes 0, 1, 2, 9, 10, 11)
            $extractedData = [
                'user_id' => 1,
                'chess_type' => 'Klassisch', // To be edited manually
                'title' => $row[0] ?? null,
                'time_control' => $row[10] ?? null,
                'start_date' => convertDate($row[1]) ?? null,
                'end_date' => convertDate($row[2]) ?? null,
                'city' => $row[9] ?? null,
                'number_of_rounds' => $row[16] ?? null,
                'chess_results_link' => "https://chess-results.com/tnr{$row[18]}.aspx?lan=0",
            ];

            // Insert into the database
            Tournament::create($extractedData);

            // dd($extractedData);
        }

        $this->info('CSV data imported successfully.');

    }
}
