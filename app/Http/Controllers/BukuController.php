<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index(){
        $buku = Buku::all();
        return view('admin.buku',compact('buku'));
    }
    public function store(Request $request){
        $request->validate([
            'judul_buku'   => 'required',
        ]);

        Buku::create([
            'judul_buku'   => $request->judul_buku,
        ]);
        return redirect('admin/buku')->with('success', 'Buku Berhasil Dibuat');
    }
    public function update(Request $request){
        $request->validate([
            'judul_buku'   => 'required',
        ]);

        $atlet = Buku::where('id',$request->id)->update([
            'judul_buku'   => $request->judul_buku,
        ]);
        if($atlet){
            return redirect('admin/buku')->with('success', 'Buku Berhasil Diedit');
        }
    }
    public function delete(Request $request){
        $del = Buku::where('id',$request->id)->delete();
        if($del){
            return redirect('admin/buku')->with('success', 'Buku Berhasil Dihapus');
        }
    }
}
