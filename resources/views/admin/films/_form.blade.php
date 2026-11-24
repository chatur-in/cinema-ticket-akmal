{{-- Bagian informasi utama --}}
<div class="form-section">
    <h3 class="form-section-title">Informasi Utama</h3>
    <p class="form-section-desc">Judul dan genre akan tampil pada beranda dan detail film.</p>

    <div class="form-grid">

        <div class="form-group full">
            <label for="judul">Judul Film</label>
            <input
                type="text"
                name="judul"
                id="judul"
                class="form-control"
                value="{{ old('judul', $film->judul ?? '') }}"
                placeholder="Contoh: Petualangan Nusantara"
                maxlength="150"
                required
            >
            @error('judul')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="genre">Genre</label>
            <input
                type="text"
                name="genre"
                id="genre"
                class="form-control"
                value="{{ old('genre', $film->genre ?? '') }}"
                placeholder="Contoh: Action, Horror, Romance"
                maxlength="100"
                required
            >
            <span class="form-hint">Pisahkan beberapa genre dengan koma.</span>
            @error('genre')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="durasi_menit">Durasi (menit)</label>
            <input
                type="number"
                name="durasi_menit"
                id="durasi_menit"
                class="form-control"
                min="1"
                max="65535"
                inputmode="numeric"
                value="{{ old('durasi_menit', $film->durasi_menit ?? '') }}"
                placeholder="Contoh: 120"
                required
            >
            <span class="form-hint">Durasi dipakai untuk menghitung jam selesai jadwal.</span>
            @error('durasi_menit')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

    </div>
</div>

{{-- Rating usia --}}
<div class="form-section">
    <h3 class="form-section-title">Rating Usia</h3>
    <p class="form-section-desc">Pilih batas usia penonton sesuai klasifikasi film.</p>

    @php
        $ratingOptions = [
            'SU'  => 'Semua umur',
            '13+' => 'Remaja 13 tahun ke atas',
            '17+' => 'Dewasa 17 tahun ke atas',
            '21+' => 'Dewasa 21 tahun ke atas',
        ];
        $currentRating = old('rating_usia', $film->rating_usia ?? 'SU');
    @endphp

    <div class="choice-grid" role="radiogroup" aria-label="Rating usia">
        @foreach($ratingOptions as $value => $description)
            <label class="choice">
                <input
                    type="radio"
                    name="rating_usia"
                    value="{{ $value }}"
                    @checked($currentRating === $value)
                    required
                >
                <span>
                    <strong>{{ $value }}</strong>
                    <small>{{ $description }}</small>
                </span>
            </label>
        @endforeach
    </div>

    @error('rating_usia')
        <div class="field-error" style="margin-top:8px">{{ $message }}</div>
    @enderror
</div>

{{-- Status tayang --}}
<div class="form-section">
    <h3 class="form-section-title">Status Tayang</h3>
    <p class="form-section-desc">Hanya film berstatus tayang yang bisa dipilih untuk jadwal baru.</p>

    @php
        $currentStatus = old('status', $film->status ?? 'tayang');
    @endphp

    <div class="choice-grid" role="radiogroup" aria-label="Status film">
        <label class="choice">
            <input type="radio" name="status" value="tayang" @checked($currentStatus === 'tayang') required>
            <span>
                <strong>Tayang</strong>
                <small>Tampil di beranda dan bisa dijadwalkan.</small>
            </span>
        </label>

        <label class="choice">
            <input type="radio" name="status" value="tidak_tayang" @checked($currentStatus === 'tidak_tayang') required>
            <span>
                <strong>Tidak tayang</strong>
                <small>Disembunyikan dari beranda dan tidak bisa dijadwalkan.</small>
            </span>
        </label>
    </div>

    @error('status')
        <div class="field-error" style="margin-top:8px">{{ $message }}</div>
    @enderror
</div>

{{-- Sinopsis --}}
<div class="form-section">
    <h3 class="form-section-title">Sinopsis</h3>
    <p class="form-section-desc">Opsional. Ditampilkan pada kartu film dan halaman detail.</p>

    <div class="form-group">
        <label for="sinopsis">Ringkasan cerita</label>
        <textarea
            name="sinopsis"
            id="sinopsis"
            class="form-control"
            rows="5"
            placeholder="Tuliskan sinopsis film..."
        >{{ old('sinopsis', $film->sinopsis ?? '') }}</textarea>
        @error('sinopsis')
            <div class="field-error">{{ $message }}</div>
        @enderror
    </div>
</div>

{{-- Poster --}}
<div class="form-section">
    <h3 class="form-section-title">Poster Film</h3>
    <p class="form-section-desc">Format JPG, JPEG, PNG, atau WEBP dengan ukuran maksimal 2 MB.</p>

    @if(isset($film) && $film->poster)
        <div class="poster-current">
            <img
                src="{{ asset('storage/' . $film->poster) }}"
                class="poster-preview"
                alt="Poster {{ $film->judul }}"
                id="poster-current"
            >
            <div>
                <strong>Poster saat ini</strong>
                <p class="form-hint">Unggah file baru untuk menggantinya. Poster lama akan dihapus.</p>
            </div>
        </div>
    @endif

    <div class="form-group">
        <label for="poster">{{ isset($film) && $film->poster ? 'Ganti poster' : 'Unggah poster' }}</label>
        <input
            type="file"
            name="poster"
            id="poster"
            class="form-control"
            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
        >
        @error('poster')
            <div class="field-error">{{ $message }}</div>
        @enderror
    </div>

    <div id="poster-new-wrap" class="poster-current" hidden style="margin-top:14px">
        <img id="poster-new" class="poster-preview" alt="Pratinjau poster baru">
        <div>
            <strong>Pratinjau poster baru</strong>
            <p class="form-hint">Poster akan disimpan setelah formulir dikirim.</p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('poster');
    const wrap = document.getElementById('poster-new-wrap');
    const preview = document.getElementById('poster-new');

    if (!input || !wrap || !preview) return;

    input.addEventListener('change', function () {
        const file = input.files && input.files[0];

        if (!file || !file.type.startsWith('image/')) {
            wrap.hidden = true;
            preview.removeAttribute('src');
            return;
        }

        preview.src = URL.createObjectURL(file);
        wrap.hidden = false;
    });
});
</script>