<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View; 
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Carbon;

class SuratKeluarExport implements FromView
{
   protected $daterange;
    
    public function __construct($daterange)
    {
        $this->daterange = $daterange;
    }

    public function view(): View
    {
        $date = explode('+', $this->daterange);
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

        return view('exports.surat_keluar', ['surat' => DB::table('surat_keluar')
                    ->select('surat_keluar.*')
                    ->whereBetween('surat_keluar.created_at', [$start, $end])
                    ->get()
                ], ['bulan' => $start]);
    }
}