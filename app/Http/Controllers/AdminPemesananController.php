<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminPemesananController extends Controller
{
    /**
     * Menampilkan seluruh data pemesanan.
     */
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'cari' => [
                'nullable',
                'string',
                'max:100',
            ],

            'status' => [
                'nullable',
                'in:booking,lunas,dibatalkan,kedaluwarsa',
            ],

            'tanggal' => [
                'nullable',
                'date_format:Y-m-d',
            ],
        ]);

        $query = Pemesanan::with([
            'jadwal.film',
            'jadwal.studio',
            'detailKursis',
        ]);

        // Pencarian berdasarkan kode, nama, HP, atau judul film.
        if (!empty($filters['cari'])) {

            $keyword = trim($filters['cari']);

            $query->where(function ($q) use ($keyword) {

                $q->where(
                    'kode_booking',
                    'like',
                    "%{$keyword}%"
                )

                ->orWhere(
                    'nama_pemesan',
                    'like',
                    "%{$keyword}%"
                )

                ->orWhere(
                    'no_hp',
                    'like',
                    "%{$keyword}%"
                )

                ->orWhereHas('jadwal.film', function ($filmQuery) use ($keyword) {

                    $filmQuery->where(
                        'judul',
                        'like',
                        "%{$keyword}%"
                    );

                });

            });
        }

        // Filter berdasarkan status pemesanan.
        if (!empty($filters['status'])) {

            $query->where(
                'status',
                $filters['status']
            );

        }

        // Filter berdasarkan tanggal penayangan.
        if (!empty($filters['tanggal'])) {

            $tanggal = $filters['tanggal'];

            $query->whereHas('jadwal', function ($jadwalQuery) use ($tanggal) {

                $jadwalQuery->whereDate(
                    'tanggal_tayang',
                    $tanggal
                );

            });

        }

        // Ambil data terbaru.
        $pemesanans = $query
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        // Ringkasan jumlah transaksi berdasarkan status.
        $statusCounts = Pemesanan::query()
            ->selectRaw('status, COUNT(*) as jumlah')
            ->groupBy('status')
            ->pluck('jumlah', 'status');

        return view('admin.pemesanans.index', compact(
            'pemesanans',
            'statusCounts',
            'filters'
        ));
    }


    /**
     * Menampilkan detail satu pemesanan.
     */
    public function show(Pemesanan $pemesanan): View
    {
        $pemesanan->load([
            'jadwal.film',
            'jadwal.studio',
            'detailKursis',
            'pembayaran',
        ]);

        return view('admin.pemesanans.show', compact(
            'pemesanan'
        ));
    }
}