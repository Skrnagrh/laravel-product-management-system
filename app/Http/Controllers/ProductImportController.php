<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ImportProductsJob;

class ProductImportController extends Controller
{
    public function showImportForm()
    {
        return view('import');
    }

    // public function import(Request $request)
    // {
    //     $request->validate([
    //         'file' => 'required|mimes:xlsx',
    //     ]);

    //     // Simpan file ke storage/app/imports
    //     $path = $request->file('file')->store('imports');

    //     // Dispatch job ke queue
    //     ImportProductsJob::dispatch($path);

    //     return redirect()->route('products.import.form')->with('success', 'Import file sedang diproses di background...');
    // }
    public function import(Request $request)
    {
        $file = $request->file('file');
        $path = $file->store('imports'); // <-- simpan ke storage/app/imports/

        ImportProductsJob::dispatch($path); // kirim path ini ke Job
        return redirect()->back()->with('success', 'Import sedang diproses.');
    }

}
