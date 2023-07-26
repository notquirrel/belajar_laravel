<?php

namespace App\Imports;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PeminjamanImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row){
            $buku = Buku::where('judul_buku', $row['judul_buku'])->first();

            if($buku != null){
                Peminjaman::create([
                    'nama'         => $row['nama'],
                    'id_buku'      => $buku['id'],
                    'tgl_pinjam'   => date($row['tgl_pinjam']),
                    'tgl_kembali'  => date($row['tgl_kembali']),
                ]);
            }
        }
    }
}
