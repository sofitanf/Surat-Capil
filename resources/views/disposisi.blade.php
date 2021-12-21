<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Disposisi</title>
    <style type="text/css">
        @page {
          size: 21cm 14.85cm;
          margin: 10;
        }

        .h7{
            color: #111111;
            font-size: 12px;
            text-transform: uppercase;
         }

        p{
            font-size: 11px;
        }

        li{
            font-size: 12px;
        }
   
        td {
            vertical-align: baseline;
        }

        .column {
          float: left;
          width: 49.8%;
          height: 63px; /* Should be removed. Only for demonstration */
          border-collapse: collapse;
          border: 1px solid black;
          margin-left: -0.2px;
        }
        .column1 {
          float: left;
          width:100%;
          height: 50px; /* Should be removed. Only for demonstration */
        }
        .column3 {
          float: left;
          width:49.8%;
          height: 70px; /* Should be removed. Only for demonstration */
          border-collapse: collapse;
          border: 1px solid black;
        }
        .column2 {
          width:50%;
          height: 115px; /* Should be removed. Only for demonstration */
        }
        /* Clear floats after the columns */
        .row:after {
          content: "";
          clear: both;
          margin-top: -50px;
        }
        .column3 {
          width:49.8%;
          height: 110px; /* Should be removed. Only for demonstration */
        }
        .column4 {
          width:80%;
          height: 115px; /* Should be removed. Only for demonstration */
        }
    </style>
</head>
<body> 
        <img src="images/pekalongan.png" alt="image" style="width: 100px; height: 100px; margin-top: 10px; margin-left: 30px" />
         <div style="text-align: center; margin-top: -120px;">
            <h4>PEMERINTAH KABUPATEN PEKALONGAN</h4>
            <h3 style="margin-top: -10px">DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</h3>
            <p class="h7" style="margin-top: -8px">Jl. Sindoro No. 5 Kajen - Pekalongan Telp. / Fax. (0285) 381921</p>
        </div>
        <div style="margin: 5px;border: solid;">
        <h3 style="letter-spacing: 4px;text-align: center; margin: 2px 0 5px 0; margin-bottom: 10px;">LEMBAR DISPOSISI</h3>
        <div class="row">
          <div class="column">
             <table style="font-size: 13px;">
                <tr>
                    <td>Surat dari</td>
                    <td>:</td>
                    <td>{{$surat->pengirim}}</td>
                </tr>
                <tr>
                    <td>No Surat</td>
                    <td>:</td>
                    <td>{{$surat->no_surat}}</td>
                </tr>
                <tr>
                    <td>Tgl Surat</td>
                    <td>:</td>
                    <td>{{TanggalID('j M Y',$surat->tgl_surat)}}</td>
                </tr>
            </table>
          </div>
          <div class="column">
            <table style="font-size: 13px;">
            <tr>
                <td>Diterima tanggal</td>
                <td>:</td>
                <td>{{TanggalID('j M Y',$surat->tgl_diterima)}}</td>
            </tr>
            <tr>
                <td>No Agenda</td>
                <td>:</td>
                <td>{{$surat->id}}</td>
            </tr>
            <tr>
                <td>Sifat</td>
                <td>:</td>
                <td>{{$surat->sifat}}</td>
            </tr>
            </table>
          </div>
        </div>
        <div class="row">
             <div class="column1">
                <table style="font-size: 13px;">
                    <tr>
                        <td>Perihal</td>
                        <td>:</td>
                        <td style="vertical-align:top;">{{$surat->perihal}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="column3">
                <table style="font-size: 13px;">
                     <tr>
                        <td>Ditembuskan kepada Sdr</td>
                        <td>:</td>
                        <ol style="margin-left: -20px;margin-top: -2px;" >
                            <li>Sekretaris</li>
                            <li>Kabid. Pelayanan Pendaftaran Penduduk</li>
                            <li>Kabid. Pelayanan Pencatatan Sipil</li>
                            <li>Kabid. PIAK dan Pemanfaatan Data</li>
                            <li></li>
                        </ol>
                    </tr>
                </table>
                
            </div>
            <div class="column3">
                <table style="font-size: 13px;">
                     <tr>
                        <td>Dengan hormat harap: </td>
                        <td>:</td>
                        <ul style="margin-left: -20px;margin-top: -2px ">
                            <li>Tanggapan dan saran</li>
                            <li>Proses lebih lanjut</li>
                            <li>Koordinasi / konfirmasikan</li>
                            <li></li>
                        </ul>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="column2" style="float: left;">
                <table style="font-size: 13px;">
                     <tr>
                        <td>Catatan</td>
                        <td>:</td>
                    </tr>
                </table>
            </div>
            <div class="column2" style="float: right; text-align: center;">
                <p>KEPALA DINAS <br>
                KEPENDUDUKAN DAN PENCATATAN SIPIL<br>
                KAB. PEKALONGAN</p>
                <br>
                <p><u>ABDUL BAQI, SH, SP.N</u><br>
                NIP. 19650316 199203 1014
                </p>
            </div>
        </div>
    </div>
        
</body>
</html>