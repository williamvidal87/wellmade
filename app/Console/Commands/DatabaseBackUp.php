<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class DatabaseBackUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
          
            
        // Checking whether a file is directory or not
        if (!is_dir(storage_path(). '/app/backup/')){
            mkdir(storage_path(). '/app/backup/');
        }

        $filename = "backup_".Carbon::now()->format('Y-m-d'). "_".strtotime(Carbon::now()->format('Y-m-d H:i:s')).".sql";
        $command = "mysqldump --user=". env('DB_USERNAME') . " --password=". env('DB_PASSWORD') . " --host=". env('DB_HOST') ." ". env('DB_DATABASE') ." > ". storage_path(). "/app/backup/".$filename;
        $returnVar = NULL;
        $output  = NULL;

        exec($command, $output, $returnVar);
    }
}
