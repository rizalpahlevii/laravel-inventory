@extends('layouts.template')
@section('page','Pengembalian')
@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Peminjaman {{$peminjaman->pegawai->nama_pegawai}}</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <b>Data Pegawai :</b>
                        <br>
                        Nama/NIP : {{$peminjaman->pegawai->nama_pegawai}} / @ {{$peminjaman->pegawai->nip}}
                        <br>
                        Kode : {{$peminjaman->pegawai->kode_pegawai}}
                        <br>
                        Alamat : {{$peminjaman->pegawai->alamat}}
                        <br><br>
                    </div>
                    <div class="col-md-6" align="right">
                        <b>Data Peminjaman :</b>
                        <br>
                        Tanggal Pinjam : {{$peminjaman->tanggal_pinjam}} 
                        <br>
                        Tanggal Kembali : {{$peminjaman->tanggal_kembali}}
                        <br>
                        <br>

                    </div>
                </div>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Inventaris</th>
                            <th>Kode Inventaris</th>
                            <th>Jenis</th>
                            <th>Ruang</th>
                            <th>Kondisi Awal</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjaman->detail_pinjam as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->inventaris->nama }}</td>
                                <td>{{ $row->inventaris->kode_inventaris }}</td>
                                <td>{{ $row->inventaris->jenis->nama_jenis }}</td>
                                <td>{{ $row->inventaris->ruang->nama_ruang }}</td>
                                <td>{{ $row->inventaris->kondisi }}</td>
                                <td>{{ $row->inventaris->keterangan }}</td>
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
