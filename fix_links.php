<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$appointments = App\Models\Appointment::where('status', 'dijadwalkan')->whereNull('link_video_call')->get();
foreach($appointments as $janji) {
    $janji->update(['link_video_call' => 'https://meet.jit.si/TenangIn-'.$janji->id.'-'.Illuminate\Support\Str::random(10)]);
    echo "Updated " . $janji->id . "\n";
}
