<?php

namespace App\Jobs;

use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ExportProductsJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $fields;
    protected $user;

    public function __construct(array $fields, $user)
    {
        $this->fields = $fields;
        $this->user = $user;
    }

    public function handle()
    {
        $filename = 'products_export_' . now()->format('YmdHis') . '.xlsx';

        Excel::store(new ProductExport($this->fields), 'exports/' . $filename, 'public');
    }
}

