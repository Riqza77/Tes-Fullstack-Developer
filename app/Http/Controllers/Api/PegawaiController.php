<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function get()
    {
        
        return response()->json(
            [
                'message' => 'Method Get Berhasil',
                'data'    => Pegawai::orderBy('id', 'desc')->get(),
            ]
        );
    }
    public function getbyDate(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $data = Pegawai::whereBetween('tgl_bergabung', [$startDate, $endDate])->orderBy('id', 'desc')->get();
        
        if ($data->isEmpty()) {
            return response()->json(
                [
                    'success' => 0,
                    'message' => 'Method Get Gagal Karena Data Tidak Ditemukan',
                ]
            );
           
        }
        return response()->json(
            [
                'success' => 1,
                'message' => 'Method Get Dengan Tanggal Berhasil',
                'data' => $data,
            ]
        );
    }
}
