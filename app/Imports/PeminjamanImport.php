<?php

namespace App\Imports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PeminjamanImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Peminjaman([
            'nama'         => $row['nama'],
            'id_buku'      => $row['judul_buku'],
            'tgl_pinjam'   => date($row['tgl_pinjam']),
            'tgl_kembali'  => date($row['tgl_kembali']),
        ]);
    }
}
