<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumen Pengajuan Surat PKL</title>
    <link rel="stylesheet" href="">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <style>
    @media print {
        html{
            height: 29.7cm;
            width: 21cm;
        }
        body{
            margin-top: 4.5cm;
            margin-bottom: 2cm;
            margin-left: 2cm;
            margin-right: 2cm;
            font-size: 12pt;
            line-height: 1.15;
            text-align: justify;
            }
        table.center {
            margin-left: auto; 
            margin-right: auto;
        }
        }
    </style>

</head>
<body>
    @php use Illuminate\Support\Carbon; @endphp
    <table>
        <tr height="25">
            <td>Nomor </td>
            <td>: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; / 
                {{ $surat->kebutuhan == 'Eksternal' ? 'PL17' : 'PL17.3.5'}} / PP / {{ date('Y') }}</td>
        </tr>
        <tr height="25">
            <td>Lampiran </td>
            <td>: -</td>
        </tr>
        <tr height="25">
            <td>Perihal </td>
            <td>: Permohonan Izin Magang</td>
        </tr>
        <tr>
            <td height="10"></td>
        </tr>
    </table>
    <table width="55%">  
        <tr>
            <td>Yth.</td>
        </tr>
        @if (!is_null($surat->kepada))
        <tr>
            <td>{{ $surat->kepada }}</td>
        </tr>
        @endif
        <tr>
            <td>{{ $surat->mitra }}</td>
        </tr>
        <tr>
            <td>{{ $surat->alamat }}, {{ $surat->kecamatan }}, {{ $surat->kabupaten }}</td>
        </tr>
        <tr>
            <td>{{ $surat->provinsi }}</td>
        </tr>
        <tr>
            <td height="10"></td>
        </tr>
    </table>
    <table>
        <tr>
            <td style="padding-bottom: 5px">
                Dengan hormat,
            </td>
        </tr>
        <tr>
            <td style="padding-bottom: 5px">
                Dalam rangka penyelenggaraan pendidikan vokasional di Politeknik Negeri Jember, 
                maka mahasiswa wajib melaksanakan Magang/Praktek Kerja Lapangan (PKL) di perusahaan/industri/instansi/
                <i>strategic business unit</i> selama 1(satu) semester sebagai salah satu syarat wajib kelulusan.
            </td>
        </tr>
        <tr>
            <td style="padding-bottom: 10px">
                Sehubungan dengan hal tersebut mohon perkenan untuk mengizinkan mahasiswa kami dari Program Studi 
                Sarjana Terapan Teknik Informatika guna melaksanakan Magang/PKL di perusahaan yang Bapak/Ibu pimpin
                mulai dari tanggal 20 September 2025 s.d. 14 Januari 2026.
            </td>
        </tr>
        <tr>
            <td style="padding-bottom: 5px">
                Adapun nama mahasiswa tersebut adalah sebagai berikut:
            </td>
        </tr>
        <tr>
            <td style="padding-bottom: 15px">
                <table border="1 solid" cellspacing="0" class="center" width="65%">
                    <tr align="center" id="header">
                        <th width="5%"><strong>No.</strong></th>
                        <th><strong>Nama Mahasiswa</strong></th>
                        <th width="25%"><strong>NIM</strong></th>                                  
                    </tr>
                    <tr >                                
                        <td align="center">1</td>                                
                        <td align="left">&nbsp;Riska Virliana Maharanti H.</td>                                                               
                        <td align="center">E31192024</td>                                
                    </tr>
                    <tr>                                
                        <td align="center">2</td>                                
                        <td align="left">&nbsp;Daniel Pugoh Wicaksono</td>                                                               
                        <td align="center">E32161765</td>                                
                    </tr>
                    <tr>                                
                        <td align="center">3</td>                                
                        <td align="left">&nbsp;Muhammad Beni Fajri</td>                                                               
                        <td align="center">E41180839</td>                                
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding-bottom: 5px">
                Konfirmasi penerimaan kegiatan Magang/PKL dapat disampaikan pada 
                {{ $surat->id_dosen == $dosen->KODE_DOSEN ? $dosen->NAMA_DOSEN : '-' }} 
                selaku Koordinator Magang Program Studi Teknik Informatika Jurusan Teknologi 
                Informasi melalui nomor telepon {{ $surat->id_dosen == $dosen->KODE_DOSEN ? $dosen->NO_HP : '-' }} 
                {{ ($surat->id_dosen == $dosen->KODE_DOSEN && !is_null($dosen->EMAIL)) ? 'dan email '.$dosen->EMAIL : '' }}
            </td>
        </tr>
        <tr>
            <td style="padding-bottom: 5px">
                Demikian surat permohonan izin magang ini disampaikan, atas perhatian dan kerjasama yang baik diucapkan terima kasih.
            </td>
        </tr>
    </table>
    @if ($surat->kebutuhan == 'Eksternal')
    <table align="right">
        <tr>
            <td>A.n Direktur</td>
        </tr>
        <tr>
            <td>Wakil Direktur Bidang Akademik</td>
        </tr>
        
        <tr height="110">
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Surateno, S.Kom, M.Kom</td>
        </tr>
        <tr>
            <td>NIP. 19790703 200312 1 001</td>
        </tr>                         
    </table>
    @else
    <table align="right">
        <tr>
            <td>Jember, {{ Carbon::now()->locale('id')->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td>Ketua Jurusan Teknologi Informasi</td>
        </tr>
        
        <tr height="110">
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Hendra Yufit Riskiawan, S.Kom, M.Cs</td>
        </tr>
        <tr>
            <td>NIP. 19830203 200604 1 003</td>
        </tr>                         
    </table>
    @endif
</body>

</html>
<script>
		window.print();
	</script>