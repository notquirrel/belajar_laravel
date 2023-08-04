<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(){
        $log = ActivityLog::all();
        return view('admin.log',compact('log'));
    }
    public function delete(Request $request){
        $del = ActivityLog::where('id',$request->id)->delete();
        if($del){
            return redirect('admin/log')->with('success', 'Log Berhasil Dihapus');
        }
    }
}
