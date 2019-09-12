@extends('layouts.app')

@section('content')
@if (!isset(Auth::user()->klub))
    <div class="alert alert-block alert-danger fade in">
        <h4 class="alert-heading">Peringatan!</h4>
        <p> Anda Belum Mendata Grup Hadroh, Segera Daftarkan Grup Hadroh Anda! </p>
        <p>
            <a class="btn blue" href="{{url('grup/create')}}"> Daftarkan Grup </a>
            {{-- <a class="btn blue" href="javascript:;"> Cancel </a> --}}
        </p>
    </div>
@elseif (Auth::user()->klub->anggotas->count() == 0)
    <div class="alert alert-block alert-danger fade in">
        <h4 class="alert-heading">Peringatan!</h4>
        <p> Anda Belum Mendata Anggota Grup Hadroh, Segera Daftarkan Anggota Grup Hadroh Anda! </p>
        <p>
            <a class="btn blue" href="{{url('anggota/create')}}"> Daftarkan Anggota </a>
            {{-- <a class="btn blue" href="javascript:;"> Cancel </a> --}}
        </p>
    </div>
@endif

    <div class="row">
        <div class="col-md-12">
            <div class="portlet">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">DAFTAR GRUP HADROH</span>
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="table-grup">
                            <thead>
                                <tr>
                                    <th class="all">NAMA</th>
                                    <th class="all">NO HP</th>
                                    <th class="all">EMAIL</th>
                                    <th class="all">ALAMAT</th>
                                    <th class="all">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Catat Nomor Urut</h4>
            </div>
            <div class="modal-body"> 
                <form action="" method="post" id="pembayaranform">
                    @csrf
                    <input type="hidden" name="klub_id" id="id">
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input form-md-floating-label">
                                            <label for="namaPembayar">Nomor Urut</label>
                                            <select class="form-control" name="nomorurut">
                                                <option value=""> -- Pilih Nomor Urut --</option>
                                                @for ($i = 1; $i < 40; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <button type="reset" class="btn default">BATAL</button>
                                                    <button type="button" id="save" class="btn blue">SIMPAN</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn green">Save changes</button> --}}
                </div>
        </div>
            <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>
<script>
    jQuery(document).ready(function () {
        var table = $('#table-grup').DataTable({
            // dom: 'Bfrtip',
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ url("get-grup") }}'
            },
            columns: [
                { data: 'name', name: 'name' },
                { data: 'nohp', name: 'nohp' },
                { data: 'email', name: 'email' },
                { data: 'alamat', name: 'alamat' },
                { data: 'action', name: 'action', orderable: false, searchable: false, exportable: false },
            ],
            "pageLength": 10, // default records per page
            "language": { // language settings
                // metronic spesific
                "metronicGroupActions": "_TOTAL_ grup selected:  ",
                "metronicAjaxRequestGeneralError": "Could not complete request. Please check your internet connection",

                // data tables spesific
                "lengthMenu": "Menampilkan _MENU_ Grup",
                "info": "Menampilkan total _TOTAL_ Grup",
                "infoEmpty": "Tidak Ada Grup Yang Ditampilkan",
                "emptyTable": "Tidak Ada Grup",
                "zeroRecords": "Grup Tidak Ditemukan",
                "loadingRecords": "Memuat Grup...",
                "processing": "Mencari Grup...",
                "infoFiltered": "(difilter dari _MAX_ total grup)",
                "thousands": ",",
                "search": "Cari:",
                "paginate": {
                    "previous": "Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First",
                    "page": "Page",
                    "pageOf": "of"
                }
            },
        });
        $("#table-grup").on("click", "#edit", function (e) {
                var csrf_token = $('meta[name="csrf-token"]').attr("content");
                var id = $(this).data("value");
                $("#id").val(id);
        });
        $("#table-grup").on("click", "#siap", function (e) {
                var csrf_token = $('meta[name="csrf-token"]').attr("content");
                var id = $(this).data("value");
                $.ajax({
                    url: "{{ url('lomba/ready') }}"+"/"+id,
                    type: "GET",
                    success : function(a){
                        alert('ready');
                        // $("#basic").modal('hide');
                        // table.ajax.reload();
                        // swal("Updated!", "Pembayaran berhasil diupdate.", "success");
                    },
                    error : function () {
                        alert('error');
                        // $("#basic").modal('hide');
                        // swal("Error!", "Ada Kesalahan Sistem.", "error");
                    }
                })
        });
        $("#table-grup").on("click", "#play", function (e) {
                var csrf_token = $('meta[name="csrf-token"]').attr("content");
                var id = $(this).data("value");
                $.ajax({
                    url: "{{ url('lomba/play') }}"+"/"+id,
                    type: "GET",
                    success : function(a){
                        alert('timer dimulai');
                    },
                    error : function () {
                        alert('error');
                    }
                })
        });
        $("#table-grup").on("click", "#stop", function (e) {
                var csrf_token = $('meta[name="csrf-token"]').attr("content");
                var id = $(this).data("value");
                $.ajax({
                    url: "{{ url('lomba/stop') }}"+"/"+id,
                    type: "GET",
                    success : function(a){
                        alert('timer berhenti');
                    },
                    error : function () {
                        alert('error');
                    }
                })
        });
        $("#save").on("click", function (e) {
                var csrf_token = $('meta[name="csrf-token"]').attr("content");
                var id = $(this).data("value");
                $.ajax({
                    url: "{{ url('nomor-urut') }}",
                    type: "PUT",
                    data : $('#pembayaranform').serialize(),
                    success : function(a){
                        $("#basic").modal('hide');
                        // table.ajax.reload();
                        // swal("Updated!", "Pembayaran berhasil diupdate.", "success");
                    },
                    error : function () {
                        $("#basic").modal('hide');
                        // swal("Error!", "Ada Kesalahan Sistem.", "error");
                    }
                })
            });
    });
</script>
@endsection
