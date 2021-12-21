<?php 

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use PDF;

class DisposisiController extends Controller
{
    public function cetak($id)
    {
    	$surat = DB::table('surat_masuk')
                    ->select('surat_masuk.*')
                    ->where('surat_masuk.id', $id)
                    ->first();

        $pdf = PDF::loadView('disposisi', compact('surat'));
        return $pdf->stream();

        // return view('disposisi', compact('surat'));
    }
}
