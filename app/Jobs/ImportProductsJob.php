<?php

// namespace App\Jobs;

// use App\Imports\ProductImport;
// use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Foundation\Bus\Dispatchable;
// use Illuminate\Queue\InteractsWithQueue;
// use Illuminate\Queue\SerializesModels;
// use Maatwebsite\Excel\Facades\Excel;

// class ImportProductsJob implements ShouldQueue
// {
//     use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

//     protected $filePath;

//     public function __construct(string $filePath)
//     {
//         $this->filePath = $filePath;
//     }

//     public function handle()
//     {
//         Excel::import(new ProductImport, storage_path('app/' . $this->filePath));
//     }
// }

namespace App\Jobs;

use App\Imports\ProductImport;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Foundation\Bus\Dispatchable;

class ImportProductsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function handle()
    {
        if (!in_array(pathinfo($this->path, PATHINFO_EXTENSION), ['xls', 'xlsx', 'csv'])) {
            throw new \Exception('Invalid file extension');
        }

    }


}
