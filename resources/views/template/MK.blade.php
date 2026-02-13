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
            margin-top: 4.7cm;
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
        <tr height="25">
            <td>Nomor </td>
            <td>: {!! $letter->necessity == 'internal' ? $letter->ref_no : str_repeat('&nbsp;', 27) . $letter->ref_no !!}</td>
        </tr>
        <tr height="25">
            <td>Lampiran </td>
            <td>: -</td>
        </tr>
        <tr height="25">
            <td>Perihal </td>
            <td>: Permohonan Izin Survei</td>
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
            <td>{{ $letter->address }}, {{ $letter->subdistrict }}, {{ $letter->regency }}</td>
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
            <td style="padding-bottom: 10px">
                Sehubungan dengan adanya tugas mata kuliah maka bersama ini kami menugaskan mahasiswa Jurusan Teknologi 
                Informasi untuk melakukan survei pada perusahaan/instansi yang Bapak/Ibu pimpin.
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
                    <tr align="center" id="header">
                        <th width="5%"><strong>No.</strong></th>
                        <th><strong>Nama Mahasiswa</strong></th>
                        <th width="13%"><strong>NIM</strong></th> 
                        <th width="29%"><strong>Jurusan/Program Studi</strong></th> 
                        <th width="17%"><strong>No. Telp</strong></th> 
                    </tr>
                    @php $no = 1; @endphp
                    @foreach($letter->members as $member)
                    <tr >                                
                        <td align="center">{{ $no++ }}</td>                                
                        <td align="left">&nbsp;{{ $member->user->name }}</td>                                                               
                        <td align="center">{{ $member->user->identity_no }}</td>                                
                        <td align="center">Teknologi Informasi / {{ $member->user->study_program_name }}</td>                                
                        <td align="center">{{ $member->user->phone_number }}</td>                                
                    </tr>
                    @endforeach
                </table>
            </td>
        </tr>
        <!-- <tr>
            <td style="padding-bottom: 5px">
                Konfirmasi izin survei mahasiswa kami dapat disampaikan pada 
                {{ $lecturer['label'] ?? null }}  
                selaku Dosen Pengampu Mata Kuliah {{ $letter->course }} di Jurusan Teknologi Informasi melalui 
                nomor telepon {{ $letter->lecturer_phone }} 
                {{ !is_null($letter->lecturer_email) ? 'dan email '.$letter->lecturer_email.'.' : '' }}
            </td>
        </tr> -->
        <tr>
            <td style="padding-bottom: 25px">
                Demikian atas kebijakan dan kerjasama yang baik dari Bapak/Ibu dalam turut serta menunjang
                peningkatan keterampilan anak didik kami, diucapkan terima kasih.
            </td>
        </tr>
    </table>
    @if ($letter->kebutuhan == 'eksternal')
    <table align="right">
        <tr>
            <td>A.n Direktur</td>
        </tr>
        <tr>
            <td>Wakil Direktur Bidang Akademik dan Perencanaan</td>
        </tr>
        
        <tr height="110">
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
        
        <tr height="110">
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