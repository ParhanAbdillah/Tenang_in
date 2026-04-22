<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    public function index()
    {
        $specializations = Specialization::latest()->get();
        return view('admin.specialization.index', compact('specializations'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required', 'code' => 'required|unique:specializations']);
        Specialization::create($request->all());
        return back()->with('success', 'Kategori Spesialis Berhasil Ditambah!');
    }

    public function show($id)
    {
        return redirect()->route('admin.specialization.index');
    }

   public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:specializations,code,' . $id
        ]);

        $spec = Specialization::findOrFail($id);
        $spec->update([
            'name' => $request->name,
            'code' => strtoupper($request->code), // Opsional: agar kode selalu uppercase
        ]);

        return back()->with('success', 'Kategori Spesialis Berhasil Diperbarui!');
    }

    public function destroy($id)
    {
        Specialization::findOrFail($id)->delete();
        return back()->with('success', 'Kategori Berhasil Dihapus!');
    }
}
