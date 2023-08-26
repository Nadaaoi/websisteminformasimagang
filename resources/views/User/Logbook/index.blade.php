@extends('Template.main')

@section('css')
<style>
    /* Global Styles */
    .fs-x {
        font-size: 14px; /* Menggunakan ukuran font yang lebih spesifik */
        padding: 2px 1.2rem; /* Menggunakan unit ukuran relatif rem */
    }

    /* Layout Styles */
    .row {
        max-width: 1200px;
        margin: 0 auto;
    }

    .col-md-5,
    .col-md-7 {
        display: flex;
        flex-direction: column;
        align-items: stretch;
    }

    .card {
        width: 100%;
        max-width: 100%;
        height: auto;
    }

    .card-body {
        font-size: 16px; /* Ukuran font tetap di 16px */
    }

    @media (max-width: 768px) {
        .col-md-5,
        .col-md-7 {
            flex-direction: column;
            align-items: center;
        }
    }

    /* Text Styles */
    .text-success {
        color: green;
    }

    .text-danger {
        color: red;
    }
</style>


@endsection

@section('content')
<div class="container">

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    
    @if(session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
    @endif
    
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    
    <h2 class="mt-4">Log Book Mahasiswa</h2>
    
    <h5 class="breadcrumb-item active">Dashboard &raquo; Log book</h5>

    <div class="mb-3">
        
    </div>

    <div class="row">
        <div class="col-md-5 mb-3">
            <div class="card" style="background-color: #00923F">
                <div class="card-body" style="color: #ffff">
                    <h5 class="card-title" style="color: #ffff">Jejak laporan harian</h5>
                    <p class="card-subtitle mb-2" style="color: #ffff"><strong>{{ $dateRange }}</strong></p>
                    <p class="card-text">Berikut merupakan pengisian log book mu dalam waktu seminggu! 😄 = Sudah di isi, 😞 = Belum di isi</p>
                    @foreach ($days as $day)
                        <div class="d-flex align-items-center mb-3">
                            <div class="mr-3" style="font-size: 24px;">{!! $day['emoji'] !!}</div>
                            <p class="mb-0">{{ $day['start_date'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-7">
            @foreach ($days as $day)
            <?php
            // Konversi string tanggal ke format timestamp untuk perbandingan
                $currentDate = strtotime(date('Y-m-d'));
                $selectedDate = strtotime($day['date']);
                $isFutureDate = $selectedDate > $currentDate;
            ?>
            <div class="card mb-3" style="max-width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">Log book harian - {{ $day['start_day'] }}</h5>
                    <p class="card-subtitle mb-2 text-muted">{{ $day['start_date'] }}</p>

                    @if ($day['logbook_count'] > 0)
                    <p class="card-text" style="color: #00923F"><strong>Selamat! log book harian mu pada tanggal ini sudah terisi!</strong></p>
                    <p class="card-text">Status Kehadiran: {{ $day['status_kehadiran'] }}</p>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalViewLogbook" onclick="viewLogbook('{{ $day['status_kehadiran'] }}', '{{ $day['deskripsi_tugas'] }}', '{{ $day['alasan_ketidakhadiran'] }}')">
                            Lihat Kegiatan
                        </button>                        
                    @else
                        @if ($isFutureDate)
                            <!-- Jika tanggal esok, maka tombol "Buat laporan harian" dinonaktifkan -->
                            <p class="card-text" style="color: #ff0000"><strong>Isilah logbook harian berdasarkan waktu yang telah ditentukan!</strong></p>
                            <p class="card-text">Status Kehadiran: - </p>
                            <button type="button" class="btn btn-primary logbook-entry" disabled>
                                Buat laporan harian
                            </button>
                        @else
                            <p class="card-text" style="color: #ff0000"><strong>Isilah logbook harian berdasarkan waktu yang telah ditentukan!</strong></p>
                            <p class="card-text">Status Kehadiran: - </p>
                            <button type="button" class="btn btn-primary logbook-entry" data-toggle="modal" data-target="#modalExample-{{ $loop->index }}">
                                Buat laporan harian
                            </button>
                        @endif
                    @endif
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modalExample-{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel-{{ $loop->index }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel-{{ $loop->index }}">Logbook Harian - {{ $day['start_date'] }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <form action="/logbook/store" method="POST">
                                @csrf
                                
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                {{-- <input type="hidden" name="name" value="{{ Auth::user()->name }}"> --}}
                                <input type="hidden" name="date" value="{{ $day['date'] }}">

                                <div class="form-group">
                                    <label for="logbook-{{ $loop->index }}">Nama:</label>
                                    <input type="text" class="form-control" name="name" id="logbook-{{ $loop->index }}" value="{{ Auth::user()->name }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="logbook-{{ $loop->index }}">Tanggal:</label>
                                    <input type="text" class="form-control" name="date" id="logbook-{{ $loop->index }}" value="{{ $day['start_date'] }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="status-{{ $loop->index }}">Status Kehadiran:</label>
                                    <select class="form-control" name="status_kehadiran" id="status-{{ $loop->index }}" onchange="showHideForm({{ $loop->index }})">
                                        <option value="Hadir">Hadir</option>
                                        <option value="Tidak hadir">Tidak Hadir</option>
                                    </select>
                                </div>

                                <div class="form-group" id="kegiatan-form-{{ $loop->index }}">
                                    <label for="description-{{ $loop->index }}">Deskripsi Tugas:</label>
                                    <textarea name="deskripsi_tugas" class="form-control" id="description-{{ $loop->index }}" rows="4"></textarea>
                                </div>

                                <div class="form-group" id="alasan-form-{{ $loop->index }}" style="display: none;">
                                    <label for="absent_reason-{{ $loop->index }}">Alasan Ketidakhadiran:</label>
                                    <select class="form-control" name="alasan_ketidakhadiran" id="absent_reason-{{ $loop->index }}">
                                        <option value="-">-</option>
                                        <option value="Sakit">Sakit</option>
                                        <option value="Izin">Izin</option>
                                        <option value="Alpa">Alpa</option>
                                        <option value="Libur Nasional">Hari libur nasional</option>
                                    </select>
                                </div>
                        </div>

                        <div class="modal-footer">
                             <button type="submit" class="btn btn-primary">Simpan</button>
                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>  

                        </form>                      
                    </div>
                </div>
            </div>

        <div class="modal fade" id="modalViewLogbook" tabindex="-1" role="dialog" aria-labelledby="modalViewLogbookLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalViewLogbookLabel">Logbook Harian - {{ $day['date'] }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Tampilkan isi logbook di sini dengan status readonly -->
                        <p>Status Kehadiran: <span id="viewStatusKehadiran" class="status-kehadiran"></span></p>
                        <p id="deskripsiTugasWrapper" class="deskripsi-tugas">Deskripsi Tugas: <span id="viewDeskripsiTugas" class="deskripsi-tugas-value"></span></p>
                        <p id="alasanKetidakhadiranWrapper" class="alasan-ketidakhadiran">Alasan Ketidakhadiran: <span id="viewAlasanKetidakhadiran" class="alasan-ketidakhadiran-value"></span></p>
                    </div>                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> --}}

<script>
    function viewLogbook(status, deskripsiTugas, alasanKetidakhadiran) {
        const viewStatusKehadiran = document.getElementById('viewStatusKehadiran');
        const viewDeskripsiTugas = document.getElementById('viewDeskripsiTugas');
        const viewAlasanKetidakhadiran = document.getElementById('viewAlasanKetidakhadiran');
        const deskripsiTugasWrapper = document.getElementById('deskripsiTugasWrapper');
        const alasanKetidakhadiranWrapper = document.getElementById('alasanKetidakhadiranWrapper');

        viewStatusKehadiran.textContent = status;
        viewStatusKehadiran.classList.remove('text-success', 'text-danger'); // Remove existing classes

        if (status === 'Hadir') {
            viewDeskripsiTugas.textContent = deskripsiTugas;
            viewDeskripsiTugas.style.display = 'inline'; // Show Deskripsi Tugas
            deskripsiTugasWrapper.style.display = 'block'; // Show the entire row containing Deskripsi Tugas
            viewAlasanKetidakhadiran.textContent = ''; // Clear Alasan Ketidakhadiran
            viewAlasanKetidakhadiran.style.display = 'none'; // Hide Alasan Ketidakhadiran
            alasanKetidakhadiranWrapper.style.display = 'none'; // Hide the entire row containing Alasan Ketidakhadiran

            // Add text color class for "Hadir" (green)
            viewStatusKehadiran.classList.add('text-success');
        } else if (status === 'Tidak hadir') {
            viewAlasanKetidakhadiran.textContent = alasanKetidakhadiran;
            viewAlasanKetidakhadiran.style.display = 'inline'; // Show Alasan Ketidakhadiran
            alasanKetidakhadiranWrapper.style.display = 'block'; // Show the entire row containing Alasan Ketidakhadiran
            viewDeskripsiTugas.textContent = ''; // Clear Deskripsi Tugas
            viewDeskripsiTugas.style.display = 'none'; // Hide Deskripsi Tugas
            deskripsiTugasWrapper.style.display = 'none'; // Hide the entire row containing Deskripsi Tugas

            // Add text color class for "Tidak hadir" (red)
            viewStatusKehadiran.classList.add('text-danger');
        }

        // Additional code here (if any)
        // ...
    }
</script>

<script>
    function showHideForm(index) {
            const status = document.getElementById(`status-${index}`).value;
            const kegiatanForm = document.getElementById(`kegiatan-form-${index}`);
            const alasanForm = document.getElementById(`alasan-form-${index}`);
    
            if (status === 'Hadir') {
                kegiatanForm.style.display = 'block';
                alasanForm.style.display = 'none';
            } else if (status === 'Tidak hadir') {
                kegiatanForm.style.display = 'none';
                alasanForm.style.display = 'block';
            }
        }
    
    </script>
@endsection