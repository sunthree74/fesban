@extends('layouts.app')

@section('content')
    <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <h1 class="page-title"> Pengaturan
                        {{-- <small>blank page layout</small> --}}
                    </h1>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-speech"></i>
                                    <span class="caption-subject bold uppercase"> Konfigurasi Fesban Tahun {{date('Y')}}</span>
                                        {{-- <span class="caption-helper">Data Pembayar</span> --}}
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                <form action="{{route('pengaturan.store')}}" method="post">
                                        @csrf
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="text" class="form-control input-sm only-num" name="jumlah" id="jumlah">
                                                <label for="jumlah">Nominal Uang Registrasi</label>
                                            </div>
                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="text" class="form-control input-sm tgl-picker" name="jumlah" id="tgl-acara">
                                                <input type="hidden" name="formattedacara" id="formattedacara">
                                                <label for="jumlah">Tanggal Lomba</label>
                                            </div>
                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="text" class="form-control input-sm tgl-picker" name="jumlah" id="tgl-tm">
                                                <input type="hidden" name="formattedtm" id="formattedtm">
                                                <label for="jumlah">Tanggal Technical Meeting</label>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <button type="reset" class="btn default">BATAL</button>
                                                        <button type="submit" class="btn blue">SIMPAN</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
    </div>
    <script>
        $(document).ready(function () {
            $('.tgl-picker').datepicker({
                    autoclose: true,
                    language: 'id',
                    format: 'DD, d MM yyyy',
                    clearBtn: true,
                    todayHighlight: true
            }).on('changeDate', function(e) {
                var idelement = this.id;
                var da = $('#'+idelement).datepicker('getUTCDate');
                var name = idelement.substring(4);
                $('#formatted'+name).val(moment(da).format('YYYY-MM-D'));
            });
        })
    </script>
@endsection
