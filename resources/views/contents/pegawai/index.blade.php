@extends('layouts.template')
@section('page','Pegawai')
@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Pegawai</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        @if (Session::has('message'))
                            <div class="alert alert-<?=Session::get('message_type')?>">{{Session::get('message')}}</div>
                        @endif
                    </div>
                </div>
                <button class="btn btn-primary btn-add" style="margin-bottom:10px;" data-toggle="modal" data-target="#modal-default">Tambah</button>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Pegawai</th>
                            <th>Kode Pegawai</th>
                            <th>NIP</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawai as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->nama_pegawai }}</td>
                                <td>{{ $row->kode_pegawai }}</td>
                                <td>{{ $row->nip }}</td>
                                <td>{{ $row->alamat }}</td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-edit" data-coba="{{$row->id}}">Edit</a>
                                    <a href="{{route('pegawai.delete',$row->id)}}" class="btn btn-danger btn-hapus" onclick="return confirm('yakin ingin menghapus ?')">Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <form action="{{route('pegawai.store')}}" method="post" id="form-pegawai">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Pegawai</h4>
                </div>
                <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="hidden" name="id" id="id">
                            <label for="kode_pegawai">Kode Pegawai</label>
                            <input type="text" class="form-control" name="kode_pegawai" id="kode_pegawai" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nama_pegawai">Nama Pegawai</label>
                            <input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" class="form-control" name="nip" id="nip" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" cols="20" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-save">Simpan</button>
                </div>
            </div>
        </form>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection
@push('script')

    <script src="{{ asset('assets') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(()=>{
            $('#example1').dataTable();
            
            $('.btn-add').click(()=>{
                $('.modal-title').html('Tambah Data');
                $('#form-pegawai').attr('action',"{{route('pegawai.store')}}");
            });
            $(document).on('click','.btn-edit',function(){
                const kode = $(this).data('coba');
                $('#form-pegawai').attr('action',`{{route('pegawai.update')}}`);
                
                $.ajax({
                    url : "{{request()->segment(1)}}/"+kode,
                    method : "GET",
                    dataType : "JSON",
                    success : (response)=>{
                        $('.modal-title').html('Edit Data ' + response.nama_pegawai);
                        $('#kode_pegawai').val(response.kode_pegawai);
                        $('#nip').val(response.nip);
                        $('#nama_pegawai').val(response.nama_pegawai);
                        $('#alamat').val(response.alamat);
                        $('#id').val(response.id);
                        $('#modal-default').modal('show');
                    },
                    error:(error)=>{
                        console.log(error);
                    }
                });
            });
            
        });
    </script>
@endpush
