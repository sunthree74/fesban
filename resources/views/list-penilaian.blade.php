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
                            {{-- <div class="tools"> </div> --}}
                            <div class="actions">
                                <a class="btn btn-circle btn-default" href="{{url('penilaian/final')}}" target="_blank">Nilai Final</a>
                            </div>
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
    <div class="portlet box blue ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i> Pengurangan Nilai </div>
                <div class="tools">
                    <a href="" class="collapse"> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form role="form" method="POST" action="{{route('nilai.pengurangan.manual')}}">
                    @csrf
                    <div class="form-body">
                        <div class="form-group @error('klub_id') has-error @enderror">
                                <label class="control-label">Nama Grup</label>
                                <select class="form-control" name="klub_id">
                                    <option value="">-- Pilih Grup --</option>
                                    @foreach ($grup as $g)
                                        <option value="{{$g->id}}">{{$g->name}}</option>
                                    @endforeach
                                </select>
                                @error('klub_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group @error('jenis') has-error @enderror">
                                <label class="control-label">Jenis Pengurangan</label>
                                <select class="form-control" name="jenis">
                                        <option value="">-- Pilih Jenis Pengurangan Nilai --</option>
                                        <option value="melebihi batas waktu">Penampilan Melebihi Batas Waktu</option>
                                        <option value="telat daftar atau datang">Telat Daftar Atau Datang</option>
                                        <option value="latihan di area lomba">Memukul Alat di Area Lomba</option>
                                        <option value="tidak membawa teks">Tidak Membawa Teks Sholawat</option>
                                </select>
                                @error('jenis')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn blue">Submit</button>
                    </div>
                </form>
                <form action="" method="POST" id="pengurangan-form">
                    <input type="hidden" name="jenis" value="tidak membawa teks">
                    <input type="hidden" name="id" class="klub_id" required>
                </form>
            </div>
        </div>
<script>
    var table;
    jQuery(document).ready(function () {
        table = $('#table-grup').DataTable({
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
    });
    var pusher = new Pusher('394571fe7210979dd5ac', {
                cluster: 'ap1',
                forceTLS: true,
            });
    var refreshTable = pusher.subscribe('refresh-table');
    refreshTable.bind('App\\Events\\RefreshTable', function(data) {
        table.ajax.reload();
    });
</script>
@endsection
