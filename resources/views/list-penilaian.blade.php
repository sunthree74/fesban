@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
                <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject bold uppercase">Daftar Peserta Lomba Festival Banjari Tahun {{date('Y')}}</span>
                            </div>
                            <div class="tools"> </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover" id="table-grup">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
        </div>
    </div>
<script>
    jQuery(document).ready(function () {
        var table = $('#table-grup').DataTable({
            // dom: 'Bfrtip',
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ url("penilaian/list-peserta") }}'
            },
            columns: [
                { data: 'name', name: 'name' },
                { data: 'alamat', name: 'alamat' },
                { data: 'status', name: 'status' },
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
