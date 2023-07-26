<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PeminjamanExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Peminjaman::all();
        // return Peminjaman::query()->where('id_buku', 1);
    }
    public function map($peminjaman): array
    {
        return [
            $peminjaman->nama,
            $peminjaman->buku->judul_buku,
            $peminjaman->tgl_pinjam,
            $peminjaman->tgl_kembali,
        ];
    }
    public function headings(): array
    {
        return [
            'Nama',
            'Judul Buku',
            'Tgl Pinjam',
            'Tgl Kembali',
        ];
    }
}
