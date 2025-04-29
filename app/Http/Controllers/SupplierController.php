<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::latest()->paginate(10);
        return view('dashboard.supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'is_active' => 'required|boolean',
        ]);

        // $validated['contact_info'] = json_encode([
        //     'whatsapp' => $request->input('whatsapp'),
        //     'website' => $request->input('website'),
        // ]);
        $validated['contact_info'] = [
            'whatsapp' => $validated['whatsapp'] ?? null,
            'website' => $validated['website'] ?? null,
        ];

        unset($validated['whatsapp'], $validated['website']); // hapus supaya ga error

        Supplier::create($validated);

        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        if (is_string($supplier->contact_info)) {
            $supplier->contact_info = json_decode($supplier->contact_info, true);
        }
        return view('dashboard.supplier.show', compact('supplier'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id)
    // {
    //     $supplier = Supplier::findOrFail($id);
    //     dd($supplier->contact_info);
    //     return view('dashboard.supplier.edit', compact('supplier'));
    // }
    public function edit(string $id)
    {
        $supplier = Supplier::findOrFail($id);

        if (is_string($supplier->contact_info)) {
            $supplier->contact_info = json_decode($supplier->contact_info, true);
        }

        return view('dashboard.supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'is_active' => 'required|boolean',
        ]);

        $validated['contact_info'] = json_encode([
            'whatsapp' => $request->input('whatsapp'),
            'website' => $request->input('website'),
        ]);

        $supplier->update($validated);

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.');
    }
}
