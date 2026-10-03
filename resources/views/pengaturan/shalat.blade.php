@extends('layouts.app')

@section('content')

    <!-- =========================================
         HEADER & NAVIGASI
    ========================================== -->
    <div class="navbar-custom d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 text-success fw-bold">
                <i class="fa fa-sliders-h me-2"></i> Pengaturan Presensi Shalat
            </h4>
            <p class="text-muted small mb-0">
                Sesuaikan jeda dzikir/iqamah, toleransi hadir tepat waktu, dan jendela scan RFID untuk setiap waktu shalat berjamaah.
            </p>
        </div>
        <div>
            <span class="badge bg-light text-dark border p-2 px-3">
                <i class="fa fa-calendar-alt text-success me-1"></i>
                {{ $sekarang->translatedFormat('l, d F Y') }}
            </span>
        </div>
    </div>

    <!-- Alert Notifikasi -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
            <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(isset($errors) && $errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
            <div class="fw-bold mb-1"><i class="fa fa-exclamation-triangle me-2"></i> Periksa kembali isian formulir:</div>
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Panduan Logika -->
    <div class="card mb-4 bg-white border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <h6 class="fw-bold text-dark mb-3">
                <i class="fa fa-info-circle text-primary me-2"></i> Panduan Konfigurasi Waktu Presensi:
            </h6>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="p-3 rounded-3 bg-light border">
                        <div class="fw-bold text-success mb-1">
                            <i class="fa fa-hourglass-start me-1"></i> 1. Jeda Adzan (Iqamah/Dzikir)
                        </div>
                        <small class="text-muted">
                            Waktu jeda setelah adzan berkumandang sebelum pintu presensi RFID dibuka. Selama jeda ini, santri belum bisa scan (sedang wudhu/dzikir).
                        </small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded-3 bg-light border">
                        <div class="fw-bold text-primary mb-1">
                            <i class="fa fa-user-check me-1"></i> 2. Batas Hadir Tepat Waktu
                        </div>
                        <small class="text-muted">
                            Durasi menit pertama setelah presensi dibuka yang dinyatakan berstatus <strong>HADIR</strong>. Lewat dari menit ini otomatis <strong>TERLAMBAT</strong>.
                        </small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded-3 bg-light border">
                        <div class="fw-bold text-danger mb-1">
                            <i class="fa fa-door-closed me-1"></i> 3. Durasi Jendela Scan
                        </div>
                        <small class="text-muted">
                            Total menit presensi shalat dibuka hingga ditutup. Setelah shalat selesai dan waktu habis, scan RFID akan <strong>DITOLAK</strong>.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FORM PENGATURAN -->
    <form action="{{ route('pengaturan.shalat.update') }}" method="POST">
        @csrf

        <div class="row g-4">
            @foreach($pengaturans as $index => $item)
                @php
                    $sim = $simulasiJadwal[$item->nama_shalat] ?? null;
                    $adzanStr = $waktuAdzan[$item->nama_shalat] ?? '12:00:00';
                @endphp
                <div class="col-lg-6 col-xl-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden prayer-card"
                         data-shalat="{{ $item->nama_shalat }}"
                         data-adzan="{{ $adzanStr }}">
                        
                        <div class="card-header bg-white border-bottom p-3 d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="fw-bold text-dark mb-0">
                                    <i class="fa fa-mosque text-success me-2"></i> {{ $item->label }}
                                </h5>
                                <small class="text-muted">
                                    Waktu Adzan Hari Ini: <span class="badge bg-success-subtle text-success border border-success fw-bold">{{ substr($adzanStr, 0, 5) }} WIB</span>
                                </small>
                            </div>
                            <div class="form-check form-switch m-0">
                                <input type="hidden" name="settings[{{ $index }}][id]" value="{{ $item->id }}">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="settings[{{ $index }}][status_aktif]"
                                       id="aktif_{{ $item->id }}"
                                       value="1"
                                       {{ old("settings.{$index}.status_aktif", $item->status_aktif) ? 'checked' : '' }}>
                            </div>
                        </div>

                        <div class="card-body p-3">
                            <div class="mb-3">
                                <label class="form-label small fw-semibold text-secondary mb-1">
                                    Jeda Dzikir/Iqamah Setelah Adzan:
                                </label>
                                <div class="input-group input-group-sm">
                                    <input type="number"
                                           class="form-control input-delay"
                                           name="settings[{{ $index }}][delay_adzan_menit]"
                                           value="{{ old("settings.{$index}.delay_adzan_menit", $item->delay_adzan_menit) }}"
                                           min="0"
                                           max="120"
                                           required>
                                    <span class="input-group-text bg-light text-muted">Menit</span>
                                </div>
                                <div class="form-text text-xs text-muted">Presensi dibuka X menit setelah adzan.</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-semibold text-secondary mb-1">
                                    Batas Hadir Tepat Waktu:
                                </label>
                                <div class="input-group input-group-sm">
                                    <input type="number"
                                           class="form-control input-toleransi"
                                           name="settings[{{ $index }}][toleransi_hadir_menit]"
                                           value="{{ old("settings.{$index}.toleransi_hadir_menit", $item->toleransi_hadir_menit) }}"
                                           min="1"
                                           max="60"
                                           required>
                                    <span class="input-group-text bg-light text-muted">Menit</span>
                                </div>
                                <div class="form-text text-xs text-muted">Scan pada menit ini tercatat Hadir.</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-semibold text-secondary mb-1">
                                    Total Durasi Jendela Scan Dibuka:
                                </label>
                                <div class="input-group input-group-sm">
                                    <input type="number"
                                           class="form-control input-jendela"
                                           name="settings[{{ $index }}][durasi_jendela_menit]"
                                           value="{{ old("settings.{$index}.durasi_jendela_menit", $item->durasi_jendela_menit) }}"
                                           min="1"
                                           max="180"
                                           required>
                                    <span class="input-group-text bg-light text-muted">Menit</span>
                                </div>
                                <div class="form-text text-xs text-muted">Pintu scan ditutup setelah durasi ini.</div>
                            </div>

                            <!-- Simulasi Visual Timeline -->
                            <div class="p-3 bg-light rounded-3 border preview-box mt-3">
                                <div class="fw-bold small text-dark mb-2">
                                    <i class="fa fa-clock text-warning me-1"></i> Simulasi Waktu Hari Ini:
                                </div>
                                <div class="d-flex flex-column gap-1 small timeline-text">
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">Adzan:</span>
                                        <span class="fw-semibold text-dark preview-adzan">{{ substr($adzanStr, 0, 5) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">Presensi Dibuka:</span>
                                        <span class="fw-bold text-success preview-mulai">{{ $sim['mulai'] ?? '-' }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">Status Hadir:</span>
                                        <span class="text-success preview-hadir">{{ $sim['mulai'] ?? '-' }} s/d {{ $sim['batas_hadir'] ?? '-' }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">Status Terlambat:</span>
                                        <span class="text-warning preview-terlambat">> {{ $sim['batas_hadir'] ?? '-' }} s/d {{ $sim['tutup'] ?? '-' }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">Scan Ditutup:</span>
                                        <span class="fw-bold text-danger preview-tutup">{{ $sim['tutup'] ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-end align-items-center mt-4 mb-5">
            <button type="submit" class="btn btn-success px-4 py-2 rounded-3 shadow fw-bold">
                <i class="fa fa-save me-2"></i> Simpan Semua Pengaturan
            </button>
        </div>
    </form>

@endsection

@push('style')
<style>
    .prayer-card {
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .prayer-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,.08) !important;
    }
    .text-xs {
        font-size: 11px;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function pad(n) {
            return n < 10 ? '0' + n : n;
        }

        function formatTime(date) {
            return pad(date.getHours()) + ':' + pad(date.getMinutes());
        }

        function updateCardPreview(card) {
            const adzanStr = card.getAttribute('data-adzan');
            if (!adzanStr) return;

            const parts = adzanStr.split(':');
            const now = new Date();
            const adzanDate = new Date(now.getFullYear(), now.getMonth(), now.getDate(), parseInt(parts[0]), parseInt(parts[1]), parseInt(parts[2] || 0));

            const delay = parseInt(card.querySelector('.input-delay').value) || 0;
            const toleransi = parseInt(card.querySelector('.input-toleransi').value) || 0;
            const jendela = parseInt(card.querySelector('.input-jendela').value) || 0;

            const mulaiDate = new Date(adzanDate.getTime() + delay * 60000);
            const hadirDate = new Date(mulaiDate.getTime() + toleransi * 60000);
            const tutupDate = new Date(mulaiDate.getTime() + jendela * 60000);

            const mulaiStr = formatTime(mulaiDate);
            const hadirStr = formatTime(hadirDate);
            const tutupStr = formatTime(tutupDate);

            card.querySelector('.preview-mulai').textContent = mulaiStr;
            card.querySelector('.preview-hadir').textContent = mulaiStr + ' s/d ' + hadirStr;
            card.querySelector('.preview-terlambat').textContent = '> ' + hadirStr + ' s/d ' + tutupStr;
            card.querySelector('.preview-tutup').textContent = tutupStr;
        }

        document.querySelectorAll('.prayer-card').forEach(function (card) {
            card.querySelectorAll('input[type="number"]').forEach(function (input) {
                input.addEventListener('input', function () {
                    updateCardPreview(card);
                });
            });
        });
    });
</script>
@endpush
