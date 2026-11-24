{{-- Film dan studio --}}
<div class="form-section">
    <h3 class="form-section-title">Film dan Studio</h3>
    <p class="form-section-desc">Hanya film tayang dan studio aktif yang tersedia di daftar pilihan.</p>

    <div class="form-grid">

        <div class="form-group full">
            <label for="film_id">Film</label>
            <select name="film_id" id="film_id" class="form-control" required>
                <option value="">-- Pilih film --</option>
                @foreach($films as $film)
                    <option
                        value="{{ $film->id }}"
                        data-duration="{{ $film->durasi_menit }}"
                        @selected((string) old('film_id', $jadwal->film_id ?? '') === (string) $film->id)
                    >
                        {{ $film->judul }} ({{ $film->durasi_menit }} menit)
                    </option>
                @endforeach
            </select>
            @error('film_id')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group full">
            <label for="studio_id">Studio</label>
            <select name="studio_id" id="studio_id" class="form-control" required>
                <option value="">-- Pilih studio --</option>
                @foreach($studios as $studio)
                    <option
                        value="{{ $studio->id }}"
                        @selected((string) old('studio_id', $jadwal->studio_id ?? '') === (string) $studio->id)
                    >
                        {{ $studio->nama }} ({{ $studio->tipe }}, {{ $studio->kapasitas }} kursi)
                    </option>
                @endforeach
            </select>
            @error('studio_id')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

    </div>
</div>

{{-- Waktu tayang --}}
<div class="form-section">
    <h3 class="form-section-title">Waktu Tayang</h3>
    <p class="form-section-desc">Jam selesai dihitung otomatis dari durasi film. Penayangan yang bentrok di studio yang sama akan ditolak.</p>

    <div class="form-grid-3">

        <div class="form-group">
            <label for="tanggal_tayang">Tanggal Tayang</label>
            <input
                type="date"
                name="tanggal_tayang"
                id="tanggal_tayang"
                class="form-control"
                value="{{ old('tanggal_tayang', isset($jadwal) ? $jadwal->tanggal_tayang : now('Asia/Jakarta')->toDateString()) }}"
                min="{{ now('Asia/Jakarta')->toDateString() }}"
                required
            >
            @error('tanggal_tayang')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="jam_mulai">Jam Mulai</label>
            <input
                type="time"
                name="jam_mulai"
                id="jam_mulai"
                class="form-control"
                value="{{ old('jam_mulai', isset($jadwal) ? substr($jadwal->jam_mulai, 0, 5) : '') }}"
                required
            >
            @error('jam_mulai')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="preview-box">
            <small>Jam Selesai (otomatis)</small>
            <strong id="jam_selesai_preview">
                {{ isset($jadwal) ? substr($jadwal->jam_selesai, 0, 5) : '-' }}
            </strong>
            <small id="durasi_info" style="margin:6px 0 0">
                Pilih film dan jam mulai.
            </small>
        </div>

    </div>
</div>

{{-- Harga dan status --}}
<div class="form-section">
    <h3 class="form-section-title">Harga dan Status</h3>
    <p class="form-section-desc">Harga berlaku per tiket. Jadwal dibatalkan tidak dihitung dalam pengecekan bentrok.</p>

    <div class="form-grid">

        <div class="form-group">
            <label for="harga">Harga Tiket</label>
            <div class="input-affix">
                <span>Rp</span>
                <input
                    type="number"
                    name="harga"
                    id="harga"
                    class="form-control"
                    min="0"
                    max="99999999.99"
                    step="100"
                    inputmode="numeric"
                    value="{{ old('harga', $jadwal->harga ?? '') }}"
                    placeholder="45000"
                    required
                >
            </div>
            @error('harga')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Status Jadwal</label>
            @php $currentJadwalStatus = old('status', $jadwal->status ?? 'aktif'); @endphp
            <div class="choice-grid" role="radiogroup" aria-label="Status jadwal">
                <label class="choice">
                    <input type="radio" name="status" value="aktif" @checked($currentJadwalStatus === 'aktif') required>
                    <span>
                        <strong>Aktif</strong>
                        <small>Tampil dan bisa dipesan.</small>
                    </span>
                </label>
                <label class="choice">
                    <input type="radio" name="status" value="dibatalkan" @checked($currentJadwalStatus === 'dibatalkan') required>
                    <span>
                        <strong>Dibatalkan</strong>
                        <small>Tidak bisa dipesan.</small>
                    </span>
                </label>
            </div>
            @error('status')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const film = document.getElementById('film_id');
    const mulai = document.getElementById('jam_mulai');
    const selesai = document.getElementById('jam_selesai_preview');
    const info = document.getElementById('durasi_info');

    function pad(value) {
        return String(value).padStart(2, '0');
    }

    function hitungJamSelesai() {
        const selected = film.options[film.selectedIndex];
        const durasi = parseInt(selected?.dataset.duration || '0', 10);

        if (!durasi || !mulai.value) {
            selesai.textContent = '-';
            info.textContent = 'Pilih film dan jam mulai.';
            return;
        }

        const [jam, menit] = mulai.value.split(':').map(Number);
        const totalMenit = jam * 60 + menit + durasi;
        const hariBerikutnya = Math.floor(totalMenit / 1440);
        const waktuSelesai = totalMenit % 1440;

        selesai.textContent = pad(Math.floor(waktuSelesai / 60)) + ':' + pad(waktuSelesai % 60)
            + (hariBerikutnya > 0 ? ' (+1 hari)' : '');
        info.textContent = 'Durasi film ' + durasi + ' menit.';
    }

    film.addEventListener('change', hitungJamSelesai);
    mulai.addEventListener('input', hitungJamSelesai);
    hitungJamSelesai();
});
</script>