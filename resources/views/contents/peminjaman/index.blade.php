@extends('layouts.template')
@section('page','Peminjaman')
@section('content')
<form id="form-pmj" method="POST">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Input Peminjaman</h3>
                </div>
                <div class="box-body">
                    <form id="form-inventaris">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kode_peminjaman">Kode Peminjaman</label>
                                            <input type="text" name="kode_peminjaman" id="kode_peminjaman" class="form-control" readonly value="{{$kode}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tanggal_pinjam">Tanggal Pinjam</label>
                                            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" readonly value="{{date('Y-m-d')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <button style="cursor:pointer;margin-top:23px;" class="btn btn-primary" id="plh-inventaris" type="button">Pilih Inventaris</button>
                                            <input type="hidden" name="id_inventaris" id="id_inventaris" class="form-control" readonly style="cursor:pointer;" placeholder="ID Inventaris">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nama_inventaris">Nama Inventaris</label>
                                            <input type="text" name="nama_inventaris" id="nama_inventaris" class="form-control" readonly placeholder="Nama Inventaris" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kode_inventaris">Kode Inventaris</label>
                                            <input type="text" name="kode_inventaris" id="kode_inventaris" class="form-control" readonly placeholder="kode Inventaris" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="jenis">Nama Jenis</label>
                                            <input type="text" name="jenis" id="jenis" class="form-control" readonly placeholder="Nama Jenis" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ruang">Nama Ruang</label>
                                            <input type="text" name="ruang" id="ruang" class="form-control" readonly placeholder="Nama Ruang" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="jumlah">Jumlah Inventaris</label>
                                            <input type="text" name="jumlah" id="jumlah" class="form-control" readonly placeholder="Jumlah Inventaris" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan Inventaris</label>
                                            <input type="text" name="keterangan" id="keterangan" class="form-control" readonly placeholder="keterangan Inventaris">
                                        </div>
                                    </div>
                                </div><hr>
                                <div class="row">
                                    <div class="col-md-2">
                                        <button class="btn btn-primary plh-pegawai btn-block" style="cursor:pointer;margin-top:23px;" type="button">Pilih Pegawai</button>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nama_pegawai">Nama Pegawai</label>
                                            <input type="text" name="nama_pegawai" id="nama_pegawai" class="form-control" readonly placeholder="Nama Pegawai" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="kode_pegawai">Kode Pegawai</label>
                                            <input type="text" name="kode_pegawai" id="kode_pegawai" class="form-control" readonly placeholder="Kode Pegawai">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nip">NIP</label>
                                            <input type="text" name="nip" id="nip" class="form-control" readonly placeholder="Nama Pegawai">
                                            <input type="hidden" name="id_pegawai" id="id_pegawai">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="jumlah_pinjam">Jumlah Pinjam</label>
                                            <input type="number" name="jumlah_pinjam" id="jumlah_pinjam" class="form-control"  placeholder="Jumlah Pinjam" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="tanggal_kembali">Tanggal Kembali</label>
                                            <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control"  placeholder="Tanggal Kembali">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="status_detail">Status</label>
                                            <input type="text" name="status_detail" id="status_detail" class="form-control"  placeholder="Status Detail">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-block btn-primary btn-save" style="cursor:pointer;margin-top:23px;" >Simpan</button>
                                    </div>
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
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Data Detail Pinjam</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-hover" id="example1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Inventaris</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Kondisi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detail_pinjam as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->inventaris->nama}}</td>
                                    <td>{{$item->jumlah}}</td>
                                    <td>{{$item->status}}</td>
                                    <td>{{$item->kondisi}}</td>
                                    <td>
                                        <a href="#" class="btn btn-danger btn-hapus" data-kode="{{$item->id}}"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="modal fade" id="modal-inventaris">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Data Inventaris</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Kondisi</th>
                                    <th>Keterangan</th>
                                    <th>Jumlah</th>
                                    <th>Nama Jenis</th>
                                    <th>Nama Ruang</th>
                                    <th>Kode Inventaris</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventaris as $inventari)
                                    <tr style="cursor:pointer;" data-kode="{{$inventari->id}}" id="rowInventory">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$inventari->nama}}</td>
                                        <td>{{$inventari->kondisi}}</td>
                                        <td>{{$inventari->keterangan}}</td>
                                        <td>{{$inventari->jumlah}}</td>
                                        <td>{{$inventari->jenis->nama_jenis}}</td>
                                        <td>{{$inventari->ruang->nama_ruang}}</td>
                                        <td>{{$inventari->kode_inventaris}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-pegawai">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Data Inventaris</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Kode</th>
                                    <th>NIP</th>
                                    <th>Alamat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pegawai as $rowp)
                                    <tr style="cursor:pointer;" data-kode="{{$rowp->id}}" id="rowPegawai">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$rowp->nama_pegawai}}</td>
                                        <td>{{$rowp->kode_pegawai}}</td>
                                        <td>{{$rowp->nip}}</td>
                                        <td>{{$rowp->alamat}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection
@push('script')

    <script src="{{ asset('assets') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="{{asset('assets')}}/iziToast/dist/js/iziToast.min.js"></script>
    <script>
        $(document).ready(()=>{
            $('#example1').dataTable();

            $('#plh-inventaris').click(function(){
                $('#modal-inventaris').modal('show');
            });
            $('.plh-pegawai').click(function(){
                $('#modal-pegawai').modal('show');
            });
            $(document).on('click','#rowInventory',function(){
                $.ajax({
                    url : "{{request()->segment(1)}}/" + $(this).data('kode') + '/inventory',
                    method : "GET",
                    dataType : "json",
                    success:(response)=>{
                        console.log(response);
                        $('#id_inventaris').val(response.id);
                        $('#nama_inventaris').val(response.nama);
                        $('#kode_inventaris').val(response.kode_inventaris);
                        $('#jenis').val(response.jenis.nama_jenis);
                        $('#ruang').val(response.ruang.nama_ruang);
                        $('#jumlah').val(response.jumlah);
                        $('#keterangan').val(response.keterangan);
                        $('#modal-inventaris').modal('hide');
                    },
                    error:(error)=>{
                        console.log(error);
                    }
                });
            });
            $(document).on('click','#rowPegawai',function(){
                $.ajax({
                    url : "{{request()->segment(1)}}/" + $(this).data('kode') + '/pegawai',
                    method : "GET",
                    dataType : "json",
                    success:(response)=>{
                        $('#nama_pegawai').val(response.nama_pegawai);
                        $('#kode_pegawai').val(response.kode_pegawai);
                        $('#nip').val(response.nip);
                        $('#id_pegawai').val(response.id);
                        $('#modal-pegawai').modal('hide');
                    },
                    error:(error)=>{
                        console.log(error);
                    }
                });
            });
            $('.btn-save').click(function(){
                var formData = $('#form-pmj').serialize();
                console.log(formData);
                $.ajax({
                    url : "{{request()->segment(1)}}/store/detailPinjam",
                    method : "POST",
                    dataType : "json",
                    data : formData,
                    success:(response)=>{
                        if(response="berhasil"){
                            iziToast.success({
                                title : 'Success',
                                message : 'Berhasil disimpan!',
                                progressBarColor: 'rgb(0, 255, 184)',
                                color : 'blue',
                                position : 'topRight',
                                timeOut : 3000,
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
                                message : 'Gagal disimpan!',
                                progressBarColor: 'rgb(0, 255, 184)',
                                color : 'blue',
                                timeOut : 3000,
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
                    error:(xhr,status,error)=>{
                        alert(xhr.responseText);
                    }
                });
            });
            $(document).on('click','.btn-hapus',function(){
                kode = $(this).data('kode');
                const conf = confirm('Yakin Ingin menghapus?');
                if(conf){
                    $.ajax({
                        url : " {{request()->segment(1)}}/delete/"+kode,
                        method : "GET",
                        dataType : "json",
                        error:(xhr,status,error)=>{
                            alert(chr.responseText);
                        },
                        success:(response)=>{
                            if(response="berhasil"){
                                iziToast.success({
                                    title : 'Success',
                                    message : 'Berhasil dihapus!',
                                    progressBarColor: 'rgb(0, 255, 184)',
                                    color : 'blue',
                                    position : 'topRight',
                                    timeOut : 3000,
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
                                    message : 'Gagal dihapus!',
                                    progressBarColor: 'rgb(0, 255, 184)',
                                    color : 'blue',
                                    timeOut : 3000,
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
                        }
                    }); 
                }
            });
        });
    </script>
@endpush
