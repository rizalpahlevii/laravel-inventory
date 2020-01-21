@extends('layouts.template')
@section('page','Laporan')
@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Laporan</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        @if (Session::has('message'))
                            <div class="alert alert-<?=Session::get('message_type')?>">{{Session::get('message')}}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <form action="" method="GET">

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="bulan">Bulan</label>
                                        <select name="bulan" id="bulan" class="form-control">
                                            <option disabled selected>Pilih Bulan</option>
                                            <option value="1" <?php echo set_selected_month(1) ?>>Januari</option>
                                            <option value="2" <?php echo set_selected_month(2) ?>>Februari</option>
                                            <option value="3" <?php echo set_selected_month(3) ?>>Maret</option>
                                            <option value="4" <?php echo set_selected_month(4) ?>>April</option>
                                            <option value="5" <?php echo set_selected_month(5) ?>>Mei</option>
                                            <option value="6" <?php echo set_selected_month(6) ?>>Juni</option>
                                            <option value="7" <?php echo set_selected_month(7) ?>>Juli</option>
                                            <option value="8" <?php echo set_selected_month(8) ?>>Agustus</option>
                                            <option value="9" <?php echo set_selected_month(9) ?>>September</option>
                                            <option value="10" <?php echo set_selected_month(10) ?>>Oktober</option>
                                            <option value="11" <?php echo set_selected_month(11) ?>>November</option>
                                            <option value="12" <?php echo set_selected_month(12) ?>>Desember</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="tahun">Tahun</label>
                                        <select name="tahun" id="tahun" class="form-control">
                                            <option disabled selected>Pilih Tahun</option>
                                            @foreach ($years as $y)
                                                <option value="{{$y->year}}" <?php echo set_selected_year($y->year) ?>>{{$y->year}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary"  style="margin-top: 23px;">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Peminjaman</th>
                            <th>Tgl Pinjam</th>
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
    </div>
</div>
@endsection
@push('script')

    <script src="{{ asset('assets') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(()=>{
            $('#example1').dataTable();
            
        });
    </script>
@endpush
