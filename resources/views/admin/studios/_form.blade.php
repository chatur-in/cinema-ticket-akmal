{{-- Identitas studio --}}
<div class="form-section">
    <h3 class="form-section-title">Identitas Studio</h3>
    <p class="form-section-desc">Nama harus unik. Nama ini tampil pada jadwal dan tiket.</p>

    <div class="form-grid">

        <div class="form-group">
            <label for="nama">Nama Studio</label>
            <input
                type="text"
                name="nama"
                id="nama"
                class="form-control"
                value="{{ old('nama', $studio->nama ?? '') }}"
                placeholder="Contoh: Studio 1"
                maxlength="100"
                required
            >
            @error('nama')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="tipe">Tipe Studio</label>
            <input
                type="text"
                name="tipe"
                id="tipe"
                class="form-control"
                list="tipe-options"
                value="{{ old('tipe', $studio->tipe ?? 'Reguler') }}"
                placeholder="Reguler, Premium, VIP"
                maxlength="50"
                required
            >
            <datalist id="tipe-options">
                <option value="Reguler">
                <option value="Premium">
                <option value="VIP">
                <option value="Premiere">
            </datalist>
            @error('tipe')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

    </div>
</div>

{{-- Status --}}
<div class="form-section">
    <h3 class="form-section-title">Status Operasional</h3>
    <p class="form-section-desc">Studio nonaktif tidak bisa dipilih untuk jadwal baru.</p>

    @php
        $currentStatus = old('status', $studio->status ?? 'aktif');
    @endphp

    <div class="choice-grid" role="radiogroup" aria-label="Status studio">
        <label class="choice">
            <input type="radio" name="status" value="aktif" @checked($currentStatus === 'aktif') required>
            <span>
                <strong>Aktif</strong>
                <small>Dapat dijadwalkan dan tampil pada pemesanan.</small>
            </span>
        </label>

        <label class="choice">
            <input type="radio" name="status" value="nonaktif" @checked($currentStatus === 'nonaktif') required>
            <span>
                <strong>Nonaktif</strong>
                <small>Sementara tidak digunakan untuk penayangan.</small>
            </span>
        </label>
    </div>

    @error('status')
        <div class="field-error" style="margin-top:8px">{{ $message }}</div>
    @enderror
</div>

{{-- Denah kursi --}}
<div class="form-section">
    <h3 class="form-section-title">Denah Kursi</h3>
    <p class="form-section-desc">Kapasitas dihitung otomatis dari jumlah baris dikali kursi per baris.</p>

    <div class="form-grid-3">

        <div class="form-group">
            <label for="jumlah_baris">Jumlah Baris</label>
            <input
                type="number"
                name="jumlah_baris"
                id="jumlah_baris"
                class="form-control"
                min="1"
                max="255"
                inputmode="numeric"
                value="{{ old('jumlah_baris', $studio->jumlah_baris ?? 5) }}"
                required
            >
            @error('jumlah_baris')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="kursi_per_baris">Kursi per Baris</label>
            <input
                type="number"
                name="kursi_per_baris"
                id="kursi_per_baris"
                class="form-control"
                min="1"
                max="255"
                inputmode="numeric"
                value="{{ old('kursi_per_baris', $studio->kursi_per_baris ?? 8) }}"
                required
            >
            @error('kursi_per_baris')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="preview-box">
            <small>Kapasitas</small>
            <strong id="kapasitas_preview">-</strong>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const baris = document.getElementById('jumlah_baris');
    const kursi = document.getElementById('kursi_per_baris');
    const preview = document.getElementById('kapasitas_preview');

    function updateKapasitas() {
        const jumlahBaris = parseInt(baris.value, 10);
        const kursiPerBaris = parseInt(kursi.value, 10);

        if (!jumlahBaris || !kursiPerBaris || jumlahBaris < 1 || kursiPerBaris < 1) {
            preview.textContent = 'Isi baris dan kursi';
            return;
        }

        const total = jumlahBaris * kursiPerBaris;
        preview.textContent = total + ' kursi';
    }

    baris.addEventListener('input', updateKapasitas);
    kursi.addEventListener('input', updateKapasitas);
    updateKapasitas();
});
</script>