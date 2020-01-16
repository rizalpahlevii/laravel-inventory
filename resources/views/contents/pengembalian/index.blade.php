@extends('layouts.template')
@section('page','Pengembalian')
@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Peminjaman</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        @if (Session::has('message'))
                            <div class="alert alert-<?=Session::get('message_type')?>">{{Session::get('message')}}</div>
                        @endif
                    </div>
                </div>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Peminjaman</th>
                            <th>Tgl Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Jumlah Pinjam Inventaris</th>
                            <th>Nama Pegawai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjaman as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->kode_peminjaman }}</td>
                                <td>{{ $row->tanggal_pinjam }}</td>
                                <td>{{ $row->tanggal_kembali }}</td>
                                @php
                                    $jmlInven = count($row->detail_pinjam);
                                @endphp
                                <td>{{ $jmlInven }}</td>
                                <td>{{ $row->pegawai->name }}</td>
                                <td>
                                    <a href="{{route('pengembalian.detail',$row->id)}}" class="btn btn-info">Detail</a>
                                    <a href="#" class="btn btn-warning btn-edit" data-coba="{{$row->id}}">Edit</a>
                                </td>
                            </tr>
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
