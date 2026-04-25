<div class="container" style="padding: 50px; text-align: center; font-family: sans-serif;">
    <div style="background: white; padding: 40px; border-radius: 20px; shadow: 0 4px 6px rgba(0,0,0,0.1); border: 1px solid #ddd;">
        <h2 style="color: #4f46e5;">Hasil Tes Kesehatan Mental Anda</h2>
        <hr>
        
        <div style="margin: 30px 0;">
            <p style="font-size: 18px; color: #666;">Kategori: <strong>{{ $result->category->name }}</strong></p>
            <h1 style="font-size: 80px; margin: 10px 0; color: #1e1b4b;">{{ $result->total_score }}</h1>
            <p style="text-transform: uppercase; letter-spacing: 2px; font-weight: bold; color: #ef4444;">
                Diagnosa: {{ $result->diagnosis }}
            </p>
        </div>

        <div style="background: #f8fafc; padding: 20px; border-radius: 10px; text-align: left;">
            <h4 style="margin-top: 0;">Saran Tenang.in:</h4>
            <p style="line-height: 1.6; color: #334155;">{{ $result->suggestion }}</p>
        </div>

        <div style="margin-top: 30px;">
            <a href="{{ route('user.test.show', $result->test_category_id) }}" 
               style="text-decoration: none; background: #4f46e5; color: white; padding: 12px 25px; border-radius: 8px; font-weight: bold;">
                Tes Ulang
            </a>
        </div>
    </div>
</div>