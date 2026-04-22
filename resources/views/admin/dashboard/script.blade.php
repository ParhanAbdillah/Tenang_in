{{-- <script>
        // Line Chart (Statistik Konsultasi)
        const ctxLine = document.getElementById('consultationChart').getContext('2d');
        new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'],
                datasets: [{
                    label: 'Sesi Berhasil',
                    data: [150, 220, 180, 250, 310, 240, 480, 320, 280, 520, 310, 450],
                    borderColor: '#6366f1',
                    backgroundColor: 'rgba(99, 102, 241, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 3,
                    pointBackgroundColor: '#6366f1'
                }, {
                    label: 'Pembatalan',
                    data: [20, 45, 30, 40, 50, 25, 60, 40, 35, 70, 45, 55],
                    borderColor: '#f43f5e',
                    borderWidth: 2,
                    borderDash: [5, 5],
                    tension: 0.4,
                    pointRadius: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { borderDash: [2, 2], color: '#f3f4f6' }, border: { display: false }, ticks: { font: { size: 10 } } },
                    x: { grid: { display: false }, border: { display: false }, ticks: { font: { size: 10 } } }
                }
            }
        });

        // Donut Chart (Topic Categories)
        const ctxPie = document.getElementById('topicChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'doughnut',
            data: {
                labels: ['Asmara', 'Karir', 'Sosial', 'Trauma'],
                datasets: [{
                    data: [11084, 2010, 1200, 3422],
                    backgroundColor: ['#4f46e5', '#60a5fa', '#fb923c', '#fb7185'],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                cutout: '75%',
                plugins: { legend: { display: false } }
            }
        });
    </script> --}}