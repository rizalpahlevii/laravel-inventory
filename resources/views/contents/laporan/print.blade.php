<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan</title>
    <link rel="stylesheet" href="{{asset('assets')}}/bower_components/bootstrap/dist/css/bootstrap.min.css">

</head>
<body>
    <div class="container">
        <h3 class="text-center" style="margin-bottom:40px;">Laporan Bulan {{$_GET['bulan']}} dan Tahun {{$_GET['tahun']}}</h3>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Peminjaman</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Nama Pegawai</th>
                            <th>Inventaris</th>
                            <th>Jumlah Pinjam</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporan as $row)
                            @php
                                $rowspan = count($row->detail_pinjam);
                            @endphp
                            <tr>
                                <td rowspan="{{$rowspan}}" style="vertical-align:middle;" align="center">{{ $loop->iteration }}</td>
                                <td rowspan="{{$rowspan}}" style="vertical-align:middle;" align="center">{{ $row->kode_peminjaman }}</td>
                                <td rowspan="{{$rowspan}}" style="vertical-align:middle;" align="center">{{ $row->tanggal_pinjam }}</td>
                                <td rowspan="{{$rowspan}}" style="vertical-align:middle;" align="center">{{ $row->tanggal_kembali }}</td>
                                <td rowspan="{{$rowspan}}" style="vertical-align:middle;" align="center">{{ $row->pegawai->nama_pegawai }}</td>
                                @php
                                    $rowsInven ='';
                                    $rowsJumlah = '';
                                @endphp
                                @foreach ($row->detail_pinjam as $key_d => $detail)
                                
                                    @php
                                    $rowsInven .= ($key_d+1==$rowspan) ? '<td>'.$detail->inventaris->nama.'</td>' : '<td>'.$detail->inventaris->nama.'</td>?' ;

                                    $rowsJumlah .= ($key_d+1==$rowspan) ? '<td>'.$detail->jumlah.'</td>' : '<td>'.$detail->jumlah.'</td>?' ;
                                    @endphp
                                @endforeach
                                @php
                                    $explodeInven = explode('?',$rowsInven);
                                    echo $explodeInven[0];
                                    $countExplodedInven = count($explodeInven);



                                    $explodeJumlah = explode('?',$rowsJumlah);
                                    echo $explodeJumlah[0];
                                    $countExplodedJumlah = count($explodeJumlah);
                                @endphp
                            </tr>
                            @for ($i = 1; $i < $countExplodedInven; $i++)
                                <tr>
                                    @if ($i <= $countExplodedInven)
                                        <?= $explodeInven[$i];?>
                                        <?= $explodeJumlah[$i];?>
                                    @endif 
                                </tr>
                            @endfor
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3" style="float:right;">
                <h4 class="text-center">{{Auth::user()->name}}</h4>
                <br><br><br>
                <p class="text-center">{{Auth::user()->myLevel(Auth::user()->id_level)}}</p>
            </div>
        </div>
    </div>
<script src="{{asset('assets')}}/bower_components/jquery/dist/jquery.min.js"></script>

<script src="{{asset('assets')}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>