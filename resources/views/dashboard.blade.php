@extends('layout.admin')

@section('content')
    <!-- Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <div class="container-fluid">
            <!-- Row 1 -->
            {{-- <div class="row">
                <!-- BOOKS -->
                <div class="col-lg-3 col-sm-6">
                    <a href="/">
                        <div class="card">
                            <div class="card-body">
                                <h2>
                                    <i class="ti ti-book"></i>
                                </h2>
                                <h3>
                                     Jumlah Data Surat
                                </h3>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- BOOK STOCK -->
                <div class="col-lg-3 col-sm-6">
                    <a href="/">
                        <div class="card">
                            <div class="card-body">
                                <h2>
                                    <i class="ti ti-database"></i>
                                </h2>
                                <h3>
                                     Jumlah Surat Disposisi
                                </h3>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- RACKS -->
                <div class="col-lg-3 col-6">
                    <a href="/">
                        <div class="card">
                            <div class="card-body">
                                <h2>
                                    <i class="ti ti-columns"></i>
                                </h2>
                                <h3>
                                    Jumlah klasifikasi surat
                                </h3>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- CATEGORIES -->
                <div class="col-lg-3 col-6">
                    <a href="/">
                        <div class="card">
                            <div class="card-body">
                                <h2>
                                    <i class="ti ti-category-2"></i>
                                </h2>
                                <h3>
                                     Tujuan disposisi
                                </h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div> --}}

            <!-- REPORT TODAY -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h3 class="card-title"><b>Laporan Hari Ini</b></h3>
                            {{-- {{ $dateNow->format('d F Y') }} --}}
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-6 col-md-3">
                                    <h4 class="text-success"><b>Surat Masuk</b></h4>
                                    <h3>{{ $jumlahsuratpusat }}</h3>
                                </div>
                                <div class="col-6 col-md-3">
                                    <h4 class="text-info"><b>Surat Keluar</b></h4>
                                    <h3>{{ $jumlahsuratdisposisi }}</h3>
                                </div>
                                <div class="col-6 col-md-3">
                                    <h4 class="text-danger"><b>Surat Keluar</b></h4>
                                    <h3>{{ $jumlahsuratterverifikasi }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grafik Peminjaman Buku -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><b>Surat Disposisi Terverifikasi per Minggu (1 Bulan Terakhir)</b></h3>
                        </div>
                        <div class="card-body">
                            <canvas id="weeklyDisposisiChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <canvas id="multiBarChart" width="400" height="200"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>
<script>
    const labels = {!! json_encode($labels) !!};

    const dataPusat = {!! json_encode($dataPusat) !!};
    const dataDisposisi = {!! json_encode($dataDisposisi) !!};
    const dataTerverifikasi = {!! json_encode($dataTerverifikasi) !!};

    const ctx = document.getElementById('multiBarChart').getContext('2d');
    const multiBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Surat Pusat',
                    data: dataPusat,
                    backgroundColor: 'rgba(75, 192, 192, 0.7)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Surat Keluar (Disposisi)',
                    data: dataDisposisi,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Surat Terverifikasi',
                    data: dataTerverifikasi,
                    backgroundColor: 'rgba(255, 159, 64, 0.7)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>

        </div>
    </div>
@endsection
