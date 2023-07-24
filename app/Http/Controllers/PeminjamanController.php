<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function home(){
        return view('admin.home');
    }
    public function index(){
        // collection methods example

        // contains & filter
        // $nilai = [2,2,3,5,7,8,8,9,10];
        // $aaa = collect($nlai)->contains(function($value){
        //    return $value < 7;
        // });
        // $bbb = collect($nilai)->filter(function($value){
        //    return $value < 7;
        // })->all();

        // pluck
        // $biodata = [
        //    ['nama' => 'Daffa', 'umur' => 17],
        //    ['nama' => 'Quirrel', 'umur' => 15],
        //    ['nama' => 'Vergil', 'umur' => 20],
        // ];

        // map
        // $number = collect([1,2,3,4,5]);
        // $multiplied = $number->map(function($item,$key){
        //    return $item * 2;
        // })

        // query builder
        // $peminjaman = DB::table('peminjaman')->get();

        // eloquent
        $peminjaman = Peminjaman::with('buku')->get();
        $buku = Buku::orderBy('id', 'asc')->get();
        return view('admin.peminjaman',compact('peminjaman', 'buku'));
    }
    public function store(Request $request){
        $request->validate([
            'nama'         => 'required',
            'id_buku'      => 'required',
            'tgl_pinjam'   => 'required',
            'tgl_kembali'  => 'required',
        ]);

        // query builder
        // DB::table('peminjaman')->insert([
        //     'nama'         => $request->nama,
        //     'id_buku'      => $request->id_buku,
        //     'tgl_pinjam'   => $request->tgl_pinjam,
        //     'tgl_kembali'  => $request->tgl_kembali,
        // ]);

        // eloquent
        Peminjaman::create([
            'nama'         => $request->nama,
            'id_buku'      => $request->id_buku,
            'tgl_pinjam'   => $request->tgl_pinjam,
            'tgl_kembali'  => $request->tgl_kembali,
        ]);
        return redirect('admin/peminjaman')->with('success', 'Peminjaman Berhasil Dibuat');
    }
    public function update(Request $request){
        $request->validate([
            'nama'         => 'required',
            'id_buku'      => 'required',
            'tgl_pinjam'   => 'required',
            'tgl_kembali'  => 'required',
        ]);

        // query builder
        // $atlet = DB::table('peminjaman')->where('id',$request->id)->update([
        //     'nama'         => $request->nama,
        //     'id_buku'      => $request->id_buku,
        //     'tgl_pinjam'   => $request->tgl_pinjam,
        //     'tgl_kembali'  => $request->tgl_kembali,
        // ]);

        // eloquent
        $atlet = Peminjaman::where('id',$request->id)->update([
            'nama'         => $request->nama,
            'id_buku'      => $request->id_buku,
            'tgl_pinjam'   => $request->tgl_pinjam,
            'tgl_kembali'  => $request->tgl_kembali,
        ]);
        if($atlet){
            return redirect('admin/peminjaman')->with('success', 'Peminjaman Berhasil Diedit');
        }
    }
    public function delete(Request $request){
        // query builder
        // $del = DB::table('peminjaman')->where('id',$request->id)->delete();

        // eloquent
        $del = Peminjaman::where('id',$request->id)->delete();
        if($del){
            return redirect('admin/peminjaman')->with('success', 'Peminjaman Berhasil Dihapus');
        }
    }
    public function logout(request $request)
    {
        $request->session()->flush();

        return redirect()->to('/');
    }
}
