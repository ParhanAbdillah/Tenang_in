<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClinicalType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClinicalTypeController extends Controller
{
    public function index()
    {
        $clinicalTypes = ClinicalType::latest()->get();
        return view('admin.clinical_type.index', compact('clinicalTypes'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:clinical_types']);
        
        ClinicalType::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        
        return back()->with('success', 'Tipe Klinis Berhasil Ditambah!');
    }

    public function show($id)
    {
        return redirect()->route('admin.clinical_type.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:clinical_types,name,' . $id
        ]);

        $clinicalType = ClinicalType::findOrFail($id);
        $clinicalType->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return back()->with('success', 'Tipe Klinis Berhasil Diperbarui!');
    }

    public function destroy($id)
    {
        ClinicalType::findOrFail($id)->delete();
        return back()->with('success', 'Tipe Klinis Berhasil Dihapus!');
    }
}
