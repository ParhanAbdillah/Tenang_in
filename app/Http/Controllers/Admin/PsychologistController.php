<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Psychologist;
use App\Models\Specialization;
use App\Models\ClinicalType;
use Illuminate\Http\Request;

class PsychologistController extends Controller
{
    public function index()
    {
        $psychologists = Psychologist::with(['specializations', 'clinicalType'])->get();
        $specializations = Specialization::all(); 
        $clinicalTypes = ClinicalType::all();
        return view('admin.psychologist.index', compact('psychologists', 'specializations', 'clinicalTypes'));
    }

    public function userIndex(Request $request)
    {
        $prices = [
            'basic' => [
                'min' => \App\Models\WebConfig::get('price_basic_min', 20000),
                'max' => \App\Models\WebConfig::get('price_basic_max', 50000),
            ],
            'essential' => [
                'min' => \App\Models\WebConfig::get('price_essential_min', 60000),
                'max' => \App\Models\WebConfig::get('price_essential_max', 150000),
            ],
            'premium' => [
                'min' => \App\Models\WebConfig::get('price_premium_min', 200000),
                'max' => \App\Models\WebConfig::get('price_premium_max', 500000),
            ],
        ];

        // Filter by active status and eager load all necessary relationships including schedules
        $psychologists = Psychologist::with(['clinicalType', 'specializations', 'schedules' => function($q) {
            $q->where('is_active', true);
        }])
        ->where('status', 'active')
        ->get();

        foreach($psychologists as $p) {
            if ($p->price_per_session >= $prices['premium']['min']) {
                $p->service_type = 'premium';
            } elseif ($p->price_per_session >= $prices['essential']['min']) {
                $p->service_type = 'essential';
            } else {
                $p->service_type = 'basic';
            }
        }
        
        $clinicalTypes = ClinicalType::all();
        $specializations = Specialization::all();
        // File: resources/views/landing_page/list_psikolog/index.blade.php
        return view('landing_page.list_psikolog.index', compact('psychologists', 'clinicalTypes', 'specializations', 'prices'));
    }

    public function userDetail($id)
    {
        $psychologist = Psychologist::with(['clinicalType', 'specializations', 'schedules' => function($q) {
            $q->where('is_active', true);
        }])
        ->where('status', 'active')
        ->findOrFail($id);

        return view('landing_page.list_psikolog.detail', compact('psychologist'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:psychologists,email',
            'phone' => 'required',
            'specializations' => 'required|array',
            'clinical_type_id' => 'nullable|exists:clinical_types,id',
            'educational_background' => 'nullable|string',
            'total_sessions' => 'nullable|numeric',
            'satisfaction_rate' => 'nullable|numeric',
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

        $psychologist = Psychologist::create($validated);
        
        if ($request->has('specializations')) {
            $psychologist->specializations()->sync($request->specializations);
        }

        return redirect()->back()->with('success', 'Psikolog berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $psy = Psychologist::findOrFail($id);

        $request->validate([
            'email' => 'required|email|unique:psychologists,email,' . $id,
            'license_number' => 'required|unique:psychologists,license_number,' . $id,
            'specializations' => 'nullable|array',
            'clinical_type_id' => 'nullable|exists:clinical_types,id',
            'educational_background' => 'nullable|string',
            'total_sessions' => 'nullable|numeric',
            'satisfaction_rate' => 'nullable|numeric',
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
        
        // Update specializations via pivot table
        $psy->specializations()->sync($request->input('specializations', []));

        return back()->with('success', 'Data Psikolog Berhasil Diperbarui!');
    }

    public function destroy($id)
    {
        $psychologist = Psychologist::findOrFail($id);
        $psychologist->delete();

        return redirect()->route('admin.psychologist.index')->with('success', 'Psikolog berhasil dihapus.');
    }
}
