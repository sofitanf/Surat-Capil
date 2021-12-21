<table>
    <thead>
    <tr> 
        <th colspan="10" style="text-align: center;">DAFTAR REGISTRASI ARSIP SURAT KELUAR</th>
    </tr>
    <tr>
        
    </tr>
    <tr> 
        <th colspan="4">UNIT CIPTA : SEKRETARIAT</th>
    </tr>
     <tr> 
        <th colspan="4">Bulan {{ TanggalID('M Y', $bulan)}}</th>
    </tr>
    <tr>
        <th rowspan="2">NO</th>
        <th rowspan="2">TANGGAL</th>
        <th rowspan="2">NOMOR DAN <br> TANGGAL SURAT</th>
        <th rowspan="2">KODE <br> KLASIFIKASI</th>
        <th rowspan="2">ISI RINGKAS</th>
        <th rowspan="2">DARI</th>
        <th rowspan="2">KEPADA</th>
        <th rowspan="2">KET</th>
    </tr>
    <tr></tr>
    <tr></tr>
    </thead>
    <tbody>
    @foreach($surat as $index => $data)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ TanggalID('j M Y',$data->tgl_surat) }}</td>
            <td>{{ $data->no_surat }} tgl {{ TanggalID('j M Y',$data->tgl_surat) }}</td>
            <td>{{ $data->no_surat }}</td>
            <td>{{ $data->perihal }}</td>
            <td>{{ $data->alamat_pengirim }}</td>
            <td>{{ $data->kepada }}</td>
            <td></td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
        <tr></tr>
        <tr></tr>
        <tr>
            <td></td>
            <td rowspan="5" colspan="2" style="text-align: center;">
                ARSIPARIS
            </td>
            <td></td>
            <td></td>
            <td rowspan="5" colspan="3" style="text-align: center;">
                MENGETAHUI: <br>
                KEPALA DINAS <br>
                KEPENDUDUKAN DAN PENCATATAN SIPIL <br>
                KABUPATEN PEKALONGAN
            </td>
        </tr>
        <tr></tr>
        <tr></tr><tr></tr>
        <tr></tr><tr></tr>
        <tr></tr><tr></tr>
        <tr></tr>
        <tr>
            <td></td>
            <td rowspan="3" colspan="2" style="text-align: center;">
                NOVITA DIANASARI,A.Md <br>
                NIP. 19761113 201001 2 007
            </td>
            <td></td>
            <td></td>
            <td rowspan="3" colspan="3" style="text-align: center;">
                ABDUL BAQI,SH.Sp.N <br>
                PEMBINA UTAMA MUDA <br>
                NIP. 19650316 199203 1 014
            </td>
        </tr>
    </tfoot>
</table>
