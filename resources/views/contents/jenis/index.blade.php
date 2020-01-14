@extends('layouts.template')
@section('page','Jenis')
@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Jenis</h3>
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
                            <th>Nama Jenis</th>
                            <th>Kode Jenis</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jenis as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->nama_jenis }}</td>
                                <td>{{ $row->kode_jenis }}</td>
                                <td>{!! $row->keterangan !!}</td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-edit" data-coba="{{$row->id}}">Edit</a>
                                    <a href="{{route('jenis.delete',$row->id)}}" class="btn btn-danger btn-hapus" onclick="return confirm('yakin ingin menghapus ?')">Hapus</a>
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
        <form action="{{route('jenis.store')}}" method="post" id="form-jenis">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Jenis</h4>
                </div>
                <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="hidden" name="id" id="id">
                            <label for="kode_jenis">Kode Jenis</label>
                            <input type="text" class="form-control" name="kode_jenis" id="kode_jenis" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nama_jenis">Nama Jenis</label>
                            <input type="text" class="form-control" name="nama_jenis" id="nama_jenis" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control"></textarea>
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
                $('#form-jenis').attr('action',"{{route('jenis.store')}}");
            });
            $(document).on('click','.btn-edit',function(){
                const kode = $(this).data('coba');
                $('#form-jenis').attr('action',`{{route('jenis.update')}}`);
                
                $.ajax({
                    url : "{{request()->segment(1)}}/"+kode,
                    method : "GET",
                    dataType : "JSON",
                    success : (response)=>{
                        $('.modal-title').html('Edit Data ' + response.nama_jenis);
                        $('#nama_jenis').val(response.nama_jenis);
                        $('#kode_jenis').val(response.kode_jenis);
                        $('#keterangan').val(response.keterangan);
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
