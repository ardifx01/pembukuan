<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::orderBy('name')->paginate(10);
        return view('supplier.index', compact('suppliers'));
    }

    public function create()
    {
        return view('supplier.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:suppliers',
            'name' => 'required|string',
            'contact_person' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        Supplier::create($request->all());

        return redirect()->route('supplier.index')
            ->with('success', 'Supplier berhasil ditambahkan');
    }

    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'code' => 'required|string|unique:suppliers,code,' . $supplier->id,
            'name' => 'required|string',
            'contact_person' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $supplier->update($request->all());

        return redirect()->route('supplier.index')
            ->with('success', 'Supplier berhasil diperbarui');
    }

    public function destroy(Supplier $supplier)
    {
        // Cek apakah supplier memiliki produk
        if ($supplier->furniture()->count() > 0) {
            return redirect()->route('supplier.index')
                ->with('error', 'Supplier tidak bisa dihapus karena masih memiliki produk');
        }

        $supplier->delete();

        return redirect()->route('supplier.index')
            ->with('success', 'Supplier berhasil dihapus');
    }
}