@extends('layouts.template')
@section('page','Inventaris')
@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Input Inventaris</h3>
            </div>
            <div class="box-body">
                <form id="form-inventaris">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_register">Tanggal Register</label>
                                <input type="text" id="tanggal_register" name="tanggal_register" class="form-control" value="{{date('Y-m-d')}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" id="nama" name="nama" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="kondisi">Kondisi</label>
                                <select name="kondisi" id="kondisi" class="form-control">
                                    <option disabled selected>-- Pilih Kondisi --</option>
                                    <option value="Baik">Baik</option>
                                    <option value="Sedang di perbaiki">Sedang di perbaiki</option>
                                    <option value="Rusak">Rusak</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" id="jumlah" name="jumlah" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kode_inventaris">Kode Inventaris</label>
                                <input type="text" id="kode_inventaris" name="kode_inventaris" class="form-control" readonly value="{{'INV'.date('YmdHis')}}">
                            </div>
                            <div class="form-group">
                                <label for="ruang">Ruang</label>
                                <select name="ruang" id="ruang" class="form-control">
                                    <option disabled selected>-- Pilih Ruang -- </option>
                                    @foreach ($ruang as $r_row)
                                    <option value="{{$r_row->id}}">{{$r_row->nama_ruang}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="jenis">Jenis</label>
                                <select name="jenis" id="jenis" class="form-control">
                                    <option disabled selected>-- Pilih jenis -- </option>
                                    @foreach ($jenis as $j_row)
                                    <option value="{{$j_row->id}}">{{$j_row->nama_jenis}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" cols="10" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="button" class="btn btn-primary btn-block btn-save" value="Simpan">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Inventaris</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped" id="example1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Kondisi</th>
                            <th>Keterangan</th>
                            <th>Jumlah</th>
                            <th>Nama Jenis</th>
                            <th>Tanggal Register</th>
                            <th>Nama Ruang</th>
                            <th>Kode Inventaris</th>
                            <th>Nama Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inventaris as $inventari)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$inventari->nama}}</td>
                                <td>{{$inventari->kondisi}}</td>
                                <td>{{$inventari->keterangan}}</td>
                                <td>{{$inventari->jumlah}}</td>
                                <td>{{$inventari->jenis->nama_jenis}}</td>
                                <td>{{$inventari->tanggal_register}}</td>
                                <td>{{$inventari->ruang->nama_ruang}}</td>
                                <td>{{$inventari->kode_inventaris}}</td>
                                <td>{{$inventari->petugas->name}}</td>
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
    <script src="{{asset('assets')}}/iziToast/dist/js/iziToast.min.js"></script>
    <script>
        $(document).ready(()=>{
            $('#example1').dataTable();
            $('.btn-save').click(function(){
                const formData = $('#form-inventaris').serialize();
                $.ajax({
                    url : "{{request()->segment(1)}}/store",
                    method : "POST",
                    dataType : "json",
                    data : formData,
                    success:(response)=>{
                        if(response="berhasil"){
                            iziToast.success({
                                title : 'Success',
                                message : 'Inventaris berhasil disimpan!',
                                progressBarColor: 'rgb(0, 255, 184)',
                                color : 'blue',
                                position : 'topRight',
                                closeOnClick : true,
                                onClosed: function(){
                                    location.reload();
                                },
                                onClosing:function(instance,toast,closedBy){
                                    location.reload();
                                },
                                buttons : [
                                    ['<button>Ok</button>', function (instance, toast) {
                                        location.reload();
                                    },true],
                                ]
                            });
                        }else{
                            iziToast.error({
                                title : 'Error',
                                message : 'Inventaris gagal disimpan!',
                                progressBarColor: 'rgb(0, 255, 184)',
                                color : 'blue',
                                position : 'topRight',
                                closeOnClick : true,
                                onClosed: function(){
                                    location.reload();
                                },
                                onClosing:function(instance,toast,closedBy){
                                    location.reload();
                                },
                                buttons : [
                                    ['<button>Ok</button>', function (instance, toast) {
                                        location.reload();
                                    },true],
                                ]
                            });
                        }
                    },
                    error:(error)=>{
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endpush
