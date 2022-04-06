<?php

namespace App\Http\Controllers\Api;

use App\Exports\SuratKeluarExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Resource;
use App\Models\SuratKeluar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class SuratKeluarController extends Controller
{
    public function index(SuratKeluar $surat)
    {
        return response()->json([
            'data' => $surat->surat()
        ]);
    }

    public function surat($id)
    {
        $data = SuratKeluar::find($id);

        return response()->json([
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'unique:surat_keluar|required',
            'no_surat' => 'required',
            'alamat_pengirim' => 'required',
            'pengirim' => 'required',
            'perihal' => 'required',
            'tgl_surat' => 'required',
            'kepada' => 'required',
        ],[
            'id.unique' => 'Nomor urut sudah ada',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

         $surat = SuratKeluar::create([
            'id' => $request->id, 
            'no_surat' => $request->no_surat,
            'alamat_pengirim' => $request->alamat_pengirim,
            'pengirim' => auth()->user()->id,
            'perihal' => $request->perihal,
            'tgl_surat' => $request->tgl_surat,
            'kepada' => $request->kepada,
        ]);

        $controller = new Resource;
        $controller->upload($request, 'lampiran', $surat, '/suratKeluar/');
        
        $surat->save();

        return response()->json([
            'message' => 'Berhasil ditambhakan!',
            'data' => $surat
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'unique:surat_keluar|required',
            'no_surat' => 'required',
            'alamat_pengirim' => 'required',
            'pengirim' => 'required',
            'perihal' => 'required',
            'tgl_surat' => 'required',
            'kepada' => 'required',
        ],[
            'id.unique' => 'Nomor urut sudah ada',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $surat = SuratKeluar::findOrFail($id);

        if($surat->id === $request->id) {
            $surat->id=$request->get('id');
            $surat->no_surat=$request->get('no_surat');
            $surat->alamat_pengirim=$request->get('alamat_pengirim');
            $surat->perihal=$request->get('perihal');
            $surat->tgl_surat=$request->get('tgl_surat');
            $surat->kepada=$request->get('kepada');
            $surat->save();

            $controller = new Resource;
            $controller->delete($surat, 'lampiran', '/suratKeluar/');
            $controller->upload($request, 'lampiran', $surat, '/suratKeluar/');

            $surat->save();

            return response()->json([
                'message' => 'Berhasil diupdate!',
                'data' => $surat
            ]);
        } else {
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
        }
    }

    public function laporanTgl($daterange)
    {
        $date = explode('+', $daterange);
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';

        return Excel::download(new SuratKeluarExport($daterange), 'Laporan Surat Keluar Bulan '.TanggalID('M Y',$start).'.xlsx');
    }
}
