<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Psychologist;
use App\Models\Specialization;
use Illuminate\Http\Request;

class PsychologistController extends Controller
{
    public function index()
    {
        $psychologists = Psychologist::all();
        $specializations = Specialization::all(); // Pastikan ini ada untuk dropdown
        return view('admin.psychologist.index', compact('psychologists', 'specializations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:psychologists,email',
            'phone' => 'required',
            'specialization' => 'required',
            'license_number' => 'required',
            'price_per_session' => 'required|numeric',
            'experience_years' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            // File disimpan ke storage/app/public/psychologists
            $path = $request->file('photo')->store('psychologists', 'public');
            $validated['photo'] = $path;
        }

        Psychologist::create($validated);

        return redirect()->back()->with('success', 'Psikolog berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $psy = Psychologist::findOrFail($id);

        $request->validate([
            'email' => 'required|email|unique:psychologists,email,' . $id,
            'license_number' => 'required|unique:psychologists,license_number,' . $id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($psy->photo && file_exists(public_path('uploads/psychologists/' . $psy->photo))) {
                unlink(public_path('uploads/psychologists/' . $psy->photo));
            }

            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/psychologists'), $filename);
            $data['photo'] = $filename;
        }

        $psy->update($data);

        return back()->with('success', 'Data Psikolog Berhasil Diperbarui!');
    }

    public function destroy($id)
    {
        $psychologist = Psychologist::findOrFail($id);
        $psychologist->delete();

        return redirect()->route('admin.psychologist.index')->with('success', 'Psikolog berhasil dihapus.');
    }
}
