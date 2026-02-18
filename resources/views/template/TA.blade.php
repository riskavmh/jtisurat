<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TA_{{ $letter->id }}</title>
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
            margin-bottom: 0.5cm;
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
        <tr>
            <td>Nomor </td>
            <td>: {!! $letter->necessity == 'internal' ? $letter->ref_no : str_repeat('&nbsp;', 27) . ' / PL17.3.5 / PP / '.date('Y') !!}</td>
        </tr>
        <tr>
            <td>Lampiran </td>
            <td>: -</td>
        </tr>
        <tr>
            <td>Perihal </td>
            <td>: Permohonan Izin Survey dan Pengambilan Data</td>
        </tr>
        <tr>
            <td height="10"></td>
        </tr>
    </table>
    <table width="57%">  
        <tr>
            <td>Yth.</td>
        </tr>
        @if (!is_null($letter->to))
        <tr>
            <td>{{ $letter->to }}</td>
        </tr>
        @endif
        <tr>
            <td>{{ $letter->company }}</td>
        </tr>
        <tr>
            <td>{{ $letter->address }}, {!! str_replace(' ', '&nbsp;', $letter->subdistrict) !!}s <span style="white-space: nowrap;">{{ $letter->regency }}</span></td>
        </tr>
        <tr>
            <td>{{ $letter->province }}</td>
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
                maka mahasiswa wajib melaksanakan Tugas Akhir/Skripsi sebagai salah satu syarat
                wajib kelulusan.
            </td>
        </tr>
        <tr>
            <td style="padding-bottom: 10px">
                Sehubungan dengan hal tersebut mohon perkenan untuk mengizinkan mahasiswa kami dari Program Studi 
                {{ $letter->members->first()->user->study_program_name }} melakukan survei guna mendapatkan data dan informasi yang kompeten
                sesuai dengan bidang kajiannya di perusahaan Bapak/Ibu.
            </td>
        </tr>
        <tr>
            <td style="padding-bottom: 5px">
                Adapun nama mahasiswa tersebut adalah sebagai berikut:
            </td>
        </tr>
        <tr>
            <td style="padding-bottom: 15px">
                <table border="1 solid" cellspacing="0" class="center" width="100%">
                    <tr align="center" id="header" class="text-bold">
                        <th width="35%">Nama Mahasiswa</th>
                        <th width="14%">NIM</th>                                  
                        <th>Judul Skripsi</th>                                  
                    </tr>
                    <tr align="center">                                                               
                        <td>{{ $letter->members->first()->user->name }}</td>                                                               
                        <td>{{ $letter->members->first()->user->identity_no }}</td>                                
                        <td>{{ $letter->research_title }}</td>                                
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding-bottom: 5px">
                Konfirmasi kesediaan Bapak/Ibu untuk menerima izin survei mahasiswa kami dapat disampaikan 
                pada {{ $lecturer['label'] }} selaku Koordinator Tugas Akhir Program Studi 
                {{ $letter->members->first()->user->study_program_name }} 
                Jurusan Teknologi Informasi melalui nomor telepon {{ $letter->lecturer_phone }} 
                {{ !is_null($letter->lecturer_email) ? 'dan email'.$letter->lecturer_email.'.' : '' }}
            </td>
        </tr>
        <tr>
            <td style="padding-bottom: 5px">
                Demikian atas kebijakan dan kerjasama yang baik dari Bapak/Ibu dalam turut serta menunjang
                    peningkatan keterampilan anak didik kami, diucapkan terima kasih.
            </td>
        </tr>
    </table>
    @if ($letter->necessity == 'Eksternal')
    <table align="right">
        <tr>
            <td>A.n Direktur</td>
        </tr>
        <tr>
            <!-- <td>Wakil Direktur Bidang Akademik<br>dan Perencanaan</td> -->
            <td>Wadir Bid. Akademik dan Perencanaan</td>
        </tr>
        
        <tr height="100">
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Ir. Surateno, S.Kom, M.Kom</td>
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
        
        <tr height="100">
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Ir. Hendra Yufit Riskiawan, S.Kom, M.Cs</td>
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