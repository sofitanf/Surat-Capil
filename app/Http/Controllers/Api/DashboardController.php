<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $surat_keluar = DB::table('surat_keluar')->count();
    	$surat_masuk = DB::table('surat_masuk')->count();

        return response()->json([
            'surat_masuk' => $surat_masuk,
            'surat_keluar' => $surat_keluar
        ]);
    }
}
