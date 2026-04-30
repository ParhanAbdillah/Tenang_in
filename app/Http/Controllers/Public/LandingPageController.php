<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Psychologist;
use App\Models\WebConfig;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        // Ambil rentang harga dari WebConfig
        $prices = [
            'basic' => [
                'min' => WebConfig::get('price_basic_min', 20000),
                'max' => WebConfig::get('price_basic_max', 50000),
            ],
            'essential' => [
                'min' => WebConfig::get('price_essential_min', 60000),
                'max' => WebConfig::get('price_essential_max', 150000),
            ],
            'premium' => [
                'min' => WebConfig::get('price_premium_min', 200000),
                'max' => WebConfig::get('price_premium_max', 500000),
            ],
        ];

        // Arahkan ke view landing page kamu (sesuaikan nama path-nya)
        return view('landing_page.index', compact('prices'));
    }

    public function individual()
    {
        // Ambil rentang harga dari WebConfig untuk halaman individual
        $prices = [
            'basic' => [
                'min' => WebConfig::get('price_basic_min', 20000),
                'max' => WebConfig::get('price_basic_max', 50000),
            ],
            'essential' => [
                'min' => WebConfig::get('price_essential_min', 60000),
                'max' => WebConfig::get('price_essential_max', 150000),
            ],
            'premium' => [
                'min' => WebConfig::get('price_premium_min', 200000),
                'max' => WebConfig::get('price_premium_max', 500000),
            ],
        ];

        return view('landing_page.individual', compact('prices'));
    }

    public function listPsikolog(Request $request)
    {
        $min = $request->query('min');
        $max = $request->query('max');
        $category = $request->query('category'); // Opsional: untuk label di view (Basic/Premium)

        // Ambil psikolog yang statusnya 'active' dan harganya masuk rentang
        $psychologists = Psychologist::where('status', 'active')
            ->whereBetween('price_per_session', [$min, $max])
            ->get();

        return view('landing_page.psikolog_list', compact('psychologists', 'category', 'min', 'max'));
    }

    public function detailPsikolog($id)
    {
        // Ambil detail psikolog beserta relasi spesialisasinya (Topik Keahlian)
        $psikolog = Psychologist::with('specializations')->findOrFail($id);
        return view('landing_page.psikolog_detail', compact('psikolog'));
    }
}
