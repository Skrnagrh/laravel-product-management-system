<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\ProductExport;
use App\Imports\ProductImport;
use App\Jobs\ExportProductsJob;
use App\Jobs\ImportProductsJob;
use Illuminate\Support\Facades\Bus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with(['category', 'supplier']);

        // Filtering by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Sorting
        if ($request->filled('sort_by') && in_array($request->sort_by, ['name', 'price', 'available_since'])) {
            $sortDirection = $request->input('sort_direction', 'asc') === 'desc' ? 'desc' : 'asc';
            $query->orderBy($request->sort_by, $sortDirection);
        } else {
            $query->latest();
        }

        $products = $query->paginate(10)->appends($request->query());
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('dashboard.products.index', compact('products', 'categories', 'suppliers'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        $suppliers = Supplier::pluck('name', 'id');
        return view('dashboard.products.create', compact('categories', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'category_id' => 'required|uuid|exists:categories,id',
                'supplier_id' => 'required|uuid|exists:suppliers,id',
                'price' => 'required|numeric|min:0',
                // 'is_active' => 'nullable',
                'is_active' => 'required|in:0,1',
                'available_since' => 'required|date',
                'attachment' => 'nullable|file|mimes:pdf|between:100,500',
            ]);

            $validated['id'] = (string) Str::uuid();
            $validated['is_active'] = $request->input('is_active') == '1';

            // Ambil nama kategori dan supplier untuk metadata
            $category = Category::find($validated['category_id']);
            $supplier = Supplier::find($validated['supplier_id']);


            if ($request->hasFile('attachment')) {
                $validated['attachment'] = $request->file('attachment')->store('attachments', 'public');
            }

            // Buat metadata
            $validated['metadata'] = json_encode([
                'name' => $validated['name'],
                'category' => $category->name ?? null,
                'supplier' => $supplier->name ?? null,
                'price' => $validated['price'],
                'is_active' => $validated['is_active'],
                'attachment' => $validated['attachment'] ?? null,
            ]);

            Product::create($validated);

            return redirect()->route('products.index')->with('success', 'Product created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $product = Product::with('audits.user')->findOrFail($id);
        // return view('dashboard.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::pluck('name', 'id');
        $suppliers = Supplier::pluck('name', 'id');

        // $product->load('audits.user');
        $product->load(['audits.user' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }]);

        // Tapi yang benar, sorting itu bukan di relasi user, tapi di audits.
        // Jadi ganti jadi:
        $product->load('audits.user');
        $product->audits = $product->audits->sortByDesc('created_at')->values();


        return view('dashboard.products.edit', compact('product', 'categories', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|uuid|exists:categories,id',
            'supplier_id' => 'required|uuid|exists:suppliers,id',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
            'available_since' => 'required|date',
            'attachment' => 'nullable|file|mimes:pdf|between:100,500',
        ]);

        // Ambil data relasi untuk metadata
        $category = Category::find($validated['category_id']);
        $supplier = Supplier::find($validated['supplier_id']);

        if ($request->hasFile('attachment')) {
            if ($product->attachment) {
                Storage::disk('public')->delete($product->attachment);
            }
            $validated['attachment'] = $request->file('attachment')->store('attachments', 'public');
        } else {
            // <-- Tambahkan ini supaya file lama dipertahankan
            $validated['attachment'] = $product->attachment;
        }

        $validated['metadata'] = json_encode([
            'name' => $validated['name'],
            'category' => $category->name ?? null,
            'supplier' => $supplier->name ?? null,
            'price' => $validated['price'],
            'is_active' => $validated['is_active'],
            'attachment' => $validated['attachment'] ?? null,
        ]);

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->attachment) {
            Storage::disk('public')->delete($product->attachment);
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function updateCategory(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $product->category_id = $request->category_id;
        $product->save();

        return response()->json(['success' => true]);
    }

    public function updateSupplier(Request $request, Product $product)
{
    $request->validate([
        'supplier_id' => 'nullable|exists:suppliers,id',
    ]);

    $product->supplier_id = $request->supplier_id;
    $product->save();

    return response()->json(['success' => true]);
}

public function export(Request $request)
{
    $fields = $request->input('fields', ['id', 'name', 'price', 'created_at', 'updated_at']);

    // Dispatch ke queue
    $user = Auth::user();

    Bus::dispatch(new \App\Jobs\ExportProductsJob($fields, $user));

    return back()->with('success', 'Export sedang diproses, akan dikirim setelah selesai.');
}



public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls'
    ]);

    Excel::import(new ProductImport, $request->file('file'));

    return back()->with('success', 'Produk berhasil diimport!');
}


}










