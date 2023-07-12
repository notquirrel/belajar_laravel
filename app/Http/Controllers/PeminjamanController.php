<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index(){
        // query builder
        // $peminjaman = DB::table('peminjaman')->get();

        // eloquent
        $peminjaman = Peminjaman::all();
        return view('admin.peminjaman',compact('peminjaman'));
    }
    public function store(Request $request){
        $request->validate([
            'nama'         => 'required',
            'judul_buku'   => 'required',
            'tgl_pinjam'   => 'required',
            'tgl_kembali'  => 'required',
        ]);

        // query builder
        // DB::table('peminjaman')->insert([
        //     'nama'         => $request->nama,
        //     'judul_buku'   => $request->judul_buku,
        //     'tgl_pinjam'   => $request->tgl_pinjam,
        //     'tgl_kembali'  => $request->tgl_kembali,
        // ]);

        // eloquent
        Peminjaman::create([
            'nama'         => $request->nama,
            'judul_buku'   => $request->judul_buku,
            'tgl_pinjam'   => $request->tgl_pinjam,
            'tgl_kembali'  => $request->tgl_kembali,
        ]);
        return redirect('admin/peminjaman')->with('success', 'Peminjaman Berhasil Dibuat');
    }
    public function update(Request $request){
        $request->validate([
            'nama'         => 'required',
            'judul_buku'   => 'required',
            'tgl_pinjam'   => 'required',
            'tgl_kembali'  => 'required',
        ]);

        // query builder
        // $atlet = DB::table('peminjaman')->where('id',$request->id)->update([
        //     'nama'         => $request->nama,
        //     'judul_buku'   => $request->judul_buku,
        //     'tgl_pinjam'   => $request->tgl_pinjam,
        //     'tgl_kembali'  => $request->tgl_kembali,
        // ]);

        // eloquent
        $atlet = Peminjaman::where('id',$request->id)->update([
            'nama'         => $request->nama,
            'judul_buku'   => $request->judul_buku,
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
}
