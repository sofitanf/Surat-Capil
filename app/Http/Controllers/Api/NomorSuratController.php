<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NomorSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NomorSuratController extends Controller
{
    public function index(NomorSurat $nomor)
    {
        return response()->json([
            'data' => $nomor->data()
        ]);
    }

    public function nomor($id)
    {
        $nomor = NomorSurat::find($id);

        return response()->json([
            'data' => $nomor
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nomor_surat' => 'unique:nomor_surat',
        ],[
            'nomor_surat.unique' => 'nomor surat sudah ada',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $data = NomorSurat::create($request->all());

        return response()->json([
            'message' => 'Berhasil ditambahkan!',
            'data' => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nomor_surat' => 'unique:nomor_surat',
        ],[
            'nomor_surat.unique' => 'nomor surat sudah ada',
        ]);

        $nomor = NomorSurat::find($id);

        if($nomor->nomor_surat === $request->nomor_surat) {
            $nomor->update($request->all());
            return response()->json([
                'message' => 'Berhasil diupdate!',
                'data' => $nomor
            ]);
        } else {
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
        }
    }
}
