<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Psychologist;
use App\Models\PsychologistSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class BookingController extends Controller
{
    /**
     * Menangani proses checkout booking melalui AJAX dengan integrasi Midtrans.
     */
    public function checkout(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'psychologist_id' => 'required|exists:psychologists,id',
            'schedule_id' => 'required|exists:psychologist_schedules,id',
            'selected_date' => 'required|date',
            'selected_time' => 'required',
        ]);

        try {
            $user = Auth::user();
            $psychologist = Psychologist::findOrFail($request->psychologist_id);

            // 2. Buat Order ID Unik
            $orderId = 'TRX-' . strtoupper(Str::random(10));
            $grossAmount = $psychologist->price_per_session ?? 299000;

            // 3. Simpan data ke tabel janji_temu (Status Menunggu Pembayaran)
            $appointment = Appointment::create([
                'id_pasien' => $user->id,
                'id_psikolog' => $psychologist->id,
                'tanggal_janji' => $request->selected_date,
                'jam_janji' => $request->selected_time,
                'status' => 'menunggu',
                'order_id' => $orderId,
                'gross_amount' => $grossAmount,
            ]);

            // 4. Konfigurasi Midtrans
            Config::$serverKey = config('services.midtrans.serverKey');
            Config::$clientKey = config('services.midtrans.clientKey');
            Config::$isProduction = (bool) config('services.midtrans.isProduction', false);
            Config::$isSanitized = (bool) config('services.midtrans.isSanitized', true);
            Config::$is3ds = (bool) config('services.midtrans.is3ds', true);

            // 5. Buat Parameter untuk Midtrans
            $params = [
                'transaction_details' => [
                    'order_id' => $appointment->order_id,
                    'gross_amount' => (int)$appointment->gross_amount,
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                ],
                'enabled_payments' => ['qris', 'bank_transfer', 'gopay', 'shopeepay'],
            ];

            // 6. Dapatkan Snap Token dari Midtrans
            $snapToken = Snap::getSnapToken($params);

            // 7. Simpan Snap Token ke database
            $appointment->update(['snap_token' => $snapToken]);

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dibuat.',
                'order_id' => $appointment->order_id,
                'snap_token' => $snapToken,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memproses pembayaran: ' . $e->getMessage()
            ], 500);
        }
    }
}
