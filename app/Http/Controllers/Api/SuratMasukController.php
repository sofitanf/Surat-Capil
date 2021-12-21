<?php

namespace App\Http\Controllers\Api;

use App\Exports\SuratMasukExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Resource;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Carbon\Carbon as CarbonCarbon;
use Maatwebsite\Excel\Facades\Excel;

class SuratMasukController extends Controller
{
    public function index()
    {
        $data = SuratMasuk::all();

        return response()->json([
            'data' => $data
        ]);
    }

    public function surat($id)
    {
        $data = SuratMasuk::find($id);

        return response()->json([
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $surat = SuratMasuk::create([
            'no_surat' => $request->no_surat,
            'pengirim' => $request->pengirim,
            'penerima' => auth()->user()->id,
            'perihal' => $request->perihal,
            'sifat' => $request->sifat,
            'tgl_surat' => $request->tgl_surat,
            'tgl_diterima' => $request->tgl_diterima,
        ]);

        $controller = new Resource;
        $controller->upload($request, 'lampiran', $surat, '/suratMasuk/');

        $surat->save();

        return response()->json([
            'message' => 'Berhasil ditambahkan!',
            'id' => $surat->id
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = SuratMasuk::findOrFail($id);
        $data->no_surat=$request->no_surat;
        $data->tgl_diterima=$request->tgl_diterima;
        $data->perihal=$request->perihal;
        $data->tgl_surat=$request->tgl_surat;
        $data->pengirim=$request->pengirim;
        $data->sifat=$request->sifat;
        $data->pengolah=$request->pengolah;
        $data->kepada=$request->kepada;

        $controller = new Resource;

        $controller->delete($data, 'lampiran', '/suratMasuk/');
        $controller->upload($request, 'lampiran', $data, '/suratMasuk/');

        $data->save();

        return response()->json([
            'message' => 'Berhasil diupdate!',
            'data' => $data
        ]);
    }

    public function laporanTgl($daterange)
    {
        $date = explode('+', $daterange);
        $start = CarbonCarbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';

        return Excel::download(new SuratMasukExport($daterange), 'Laporan Surat Masuk Bulan '.TanggalID('M Y',$start).'.xlsx');
    }
}
