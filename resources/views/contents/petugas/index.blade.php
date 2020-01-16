@extends('layouts.template')
@section('page','Petugas')
@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Petugas</h3>
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
                    <div class="col-md-6">
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
                <button class="btn btn-primary btn-add" style="margin-bottom:10px;" data-toggle="modal" data-target="#modal-default">Tambah</button>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Petugas</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($petugas as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->level->nama_level }}</td>
                                <td>
                                <a href="#" data-coba="{{$row->id}}" class="btn btn-warning btn-edit" >Edit</a>
                                    <a href="{{route('petugas.delete',$row->id)}}" class="btn btn-danger btn-hapus" onclick="return confirm('yakin ingin menghapus ?')">Hapus</a>
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
        <form action="{{route('petugas.store')}}" method="post" id="form-jenis">
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
                            <label for="nama_petugas">Nama Petugas</label>
                            <input type="text" class="form-control" name="nama_petugas" id="nama_petugas" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="level">Level</label>
                            <select name="level" id="level" class="form-control">
                                <option disabled selected>--Pilih Level--</option>
                                @foreach ($level as $item)
                                <option value="{{$item->id}}">{{$item->nama_level}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 ganti-password">
                        <div class="form-group">
                            <label for="ganti_password">Ganti Password</label>
                            <input type="checkbox" name="ganti_password" id="ganti_password">
                        </div>
                    </div>
                    <div class="col-md-12 password-add">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" >
                        </div>
                    </div>
                    <div class="kotak-password">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="old_password">Password Lama</label>
                                <input type="password" class="form-control" name="old_password" id="old_password" >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="new_password">Password Baru</label>
                                <input type="password" class="form-control" name="new_password" id="new_password" >
                            </div>
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
            $('#ganti_password').click(function(){
                if($(this).is(':checked')){
                    $('.kotak-password').show();
                }else{
                    $('.kotak-password').hide();
                }
            });
            $('.btn-add').click(()=>{
                $('.ganti-password').hide();
                $('.password-add').show();
                $('.kotak-password').hide();
                $('.modal-title').html('Tambah Data');
                $('#form-jenis').attr('action',"{{route('petugas.store')}}");
            });
            $(document).on('click','.btn-edit',function(){
                const kode = $(this).data('coba');
                $('#form-jenis').attr('action',`{{route('petugas.update')}}`);
                $('.ganti-password').show();
                $('.kotak-password').hide();
                $('.password-add').hide();
                $.ajax({
                    url : "{{request()->segment(1)}}/"+kode,
                    method : "GET",
                    dataType : "JSON",
                    success : (response)=>{
                        $('.modal-title').html('Edit Data ' + response.name);
                        $('#nama_petugas').val(response.name);
                        $('#email').val(response.email);
                        $('#level').val(response.id_level);
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
